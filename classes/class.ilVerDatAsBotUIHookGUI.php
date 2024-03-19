<?php

/**
 * Chatbot ILIAS plugin for the assistance system developed as part of the VerDatAs project
 * Copyright (C) 2023-2024 TU Dresden (Tommy Kubica)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Class ilVerDatAsBotUIHookGUI
 *
 * @author tud <tommy.kubica@tu-dresden.de>
 * @ilCtrl_isCalledBy ilVerDatAsBotUIHookGUI: ilPCPluggedGUI
 */
class ilVerDatAsBotUIHookGUI extends ilUIHookPluginGUI
{
    private \ILIAS\DI\Container $dic;
    protected ilVerDatAsBotPlugin $pl;

    /**
     * The constructor of ilVerDatAsBotUIHookGUI that retrieves several parameters and the instance of the ilVerDatAsBotPlugin.
     */
    public function __construct()
    {
        global $DIC;
        $this->dic = $DIC;
        $this->pl = ilVerDatAsBotPlugin::getInstance();
    }

    /**
     * Modify the HTML output to include the chatbot for the assistance system
     *
     * Modifications modes are:
     *  - ilUIHookPluginGUI::KEEP (No modification)
     *  - ilUIHookPluginGUI::REPLACE (Replace default HTML with your HTML)
     *  - ilUIHookPluginGUI::APPEND (Append your HTML to the default HTML)
     *  - ilUIHookPluginGUI::PREPEND (Prepend your HTML to the default HTML)
     *
     * @param string $a_comp string that identifies the component
     * @param string $a_part string that identifies the part of the UI that is handled
     * @param array  $a_par  array of parameters (depends on $a_comp and $a_part), e.g. name of the template used
     * @return array array with entries "mode" => modification mode, "html" => your html
     */
    function getHTML(string $a_comp, string $a_part, array $a_par = array()): array
    {
        // Currently, the inclusion should only be triggered, if $a_comp is not empty
        // Early return to avoid unnecessary further checks
        if (empty($a_comp)) {
            return array("mode" => ilUIHookPluginGUI::KEEP, "html" => "");
        }

        // Check, whether the user is logged in
        $isLoggedIn = !$this->dic->user()->isAnonymous() && $this->dic->user()->getId() !== 0;

        // Ensure that the function is only called once, as the MainMenu is just included once, too
        $callOnlyOnce = $a_comp === 'Services/MainMenu';

        // Exclude several components from displaying the chatbot
        $componentsWithoutChatbot = array('ilpersonalprofilegui', 'iluserprivacysettingsgui', 'ilpersonalsettingsgui', 'ilmailoptionsgui');

        // Include the chatbot (one time), if the user is logged in and the currently component is not excluded
        if ($isLoggedIn && $callOnlyOnce && !in_array($_GET['cmdClass'], $componentsWithoutChatbot)) {
            // BEGIN: Retrieve token
            // Retrieve the settings of the plugin
            $settings = new ilSetting(ilVerDatAsBotPlugin::PLUGIN_ID);
            $lrsTypeId = $settings->get('lrs_type_id', 0);
            $backendURL = $settings->get('backend_url', 0);
            // Early return, if either the lrsType or the backendURL is not set
            if (!$lrsTypeId || !$backendURL) {
                return array("mode" => ilUIHookPluginGUI::KEEP, "html" => "");
            }
            // Retrieve the selected LRS type
            $lrsType = new ilCmiXapiLrsType($lrsTypeId);

            // Retrieve the name mode defined within the LRS type
            $nameMode = isset(array_flip(get_class_methods($lrsType))['getPrivacyName']) ? $lrsType->getPrivacyIdent() : $lrsType->getUserIdent();
            // Retrieve the user ident for this name mode
            $userIdent = ilCmiXapiUser::getIdent($nameMode, $this->dic->user());

            // Check, whether an expireDate has been set and, if so, whether it has been exceeded
            if (!empty($_SESSION['expireDate'])) {
                if ($_SERVER['REQUEST_TIME'] > $_SESSION['expireDate']) {
                    $_SESSION['userIdent'] = null;
                    $_SESSION['jwt'] = null;
                    $_SESSION['expireDate'] = null;
                }
            }

            // Check, whether at least one session variable is not set
            // Note: As the session terminates on logout, it is not required to check the userIdent for a new logged-in user
            if (empty($_SESSION['userIdent']) || empty($_SESSION['jwt'])) {
                // Prevent a crash, if the VerDatAs-Backend cannot be reached
                try {
                    // Make a request to the VerDatAs-Backend to retrieve the user token, as we need the user ID
                    $verDatAsBackendRequest = new ilVerDatAsBotHttpRequest(
                        $backendURL
                    );
                    $responseBody = $verDatAsBackendRequest->sendPost('/api/v1/auth/login', ['actorAccountName' => $userIdent]);

                    // Decode JWT Token
                    // https://www.converticacommerce.com/support-maintenance/security/php-one-liner-decode-jwt-json-web-tokens/
                    $arr_body = json_decode($responseBody);
                    $token = $arr_body->token;
                    $parsedToken = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $token)[1]))));
                    $ident = $parsedToken->sub;
                    $expireDate = $parsedToken->exp;

                    // Define session variables
                    $_SESSION['jwt'] = $token;
                    $_SESSION['userIdent'] = $ident;
                    $_SESSION['expireDate'] = $expireDate;
                } catch (Exception $e) {
                    file_put_contents('console.log', $e->getMessage() . "\n", FILE_APPEND);
                }
            } else {
                // Reuse the existing user ident
                $ident = $_SESSION['userIdent'];
            }

            // Do not show the chatbot, when the VerDatAs-Backend cannot be accessed
            if (!isset($ident)) {
                return array("mode" => ilUIHookPluginGUI::KEEP, "html" => "");
            }
            // END: Retrieve token

            // Reset the session variable for botActedAfterUserLogin, when the difference of the current and last request time exceeds 30 minutes
            if (!empty($_SESSION['requestTime'])) {
                if (($_SERVER['REQUEST_TIME'] - 1800) > $_SESSION['requestTime']) {
                    $_SESSION['botActedAfterUserLogin'] = null;
                }
            }
            $_SESSION['requestTime'] = $_SERVER['REQUEST_TIME'];

            // Send an "afterUserLoginAction" after logging into the system
            $afterUserLoginAction = false;
            $loginName = $this->dic->user()->getLogin();
            $isAnonymous = !strlen(str_replace(['anonymous'], '', $loginName));
            $botActedAfterUserLogin = !empty($_SESSION['botActedAfterUserLogin']);
            $serverParam = explode('/', $this->dic->http()->request()->getServerParams()['SCRIPT_FILENAME']);
            $scriptFileName = array_pop($serverParam);
            $hasLoggedOut = 'logout.php' === $scriptFileName;
            if (!$isAnonymous && !$botActedAfterUserLogin && !$hasLoggedOut) {
                $_SESSION['botActedAfterUserLogin'] = $afterUserLoginAction = true;
            }
            $pluginPath = './' . $this->pl->getDirectory();
            return $this->includeChatbot($userIdent, $_SESSION['jwt'], $backendURL, $afterUserLoginAction, $pluginPath);
        }
        return array("mode" => ilUIHookPluginGUI::KEEP, "html" => "");
    }

    /**
     * Append the necessary script tags to the existing HTML code
     *
     * @param string $userIdent
     * @param string $token
     * @param string $backendURL
     * @param bool   $hasJustLoggedIn
     * @param string $pluginPath
     * @return array
     */
    function includeChatbot(string $userIdent, string $token, string $backendURL, bool $hasJustLoggedIn, string $pluginPath): array
    {
        return array("mode" => ilUIHookPluginGUI::APPEND,
                     "html" => "
            <script type='text/javascript'>
                // If not already existing, create a new div with the ID 'chatbotApp' that is used to include the chatbot
                if (!document.getElementById('chatbotApp')) {
                    const elemDiv = document.createElement('div');
                    elemDiv.id='chatbotApp';
                    elemDiv.style.cssText = 'position: fixed; bottom: 0; right: 0; z-index: 998;';
                    document.body.appendChild(elemDiv);
                }
            </script>
            <script type='module' crossorigin src='" . $pluginPath . "/templates/main.js'></script>
            <script type='text/javascript'>
                const backendUrlDefined = '$backendURL';
                const userIdent = '$userIdent';
                const token = '$token';
                let hasJustLoggedIn = " . json_encode($hasJustLoggedIn) . ";
                const initVerDatAsChatbot = (maxAttempts) => {
                    setTimeout(() => {
                        if (typeof VerDatAsChatbot !== 'undefined') {
                            VerDatAsChatbot.init({
                                pluginPath: '" . $pluginPath . "',
                                backendUrl: backendUrlDefined,
                                pseudoId: userIdent,
                                token,
                                hasJustLoggedIn
                            });
                        }
                        else {
                            maxAttempts --;
                            if (maxAttempts > 0) {
                                initVerDatAsChatbot(maxAttempts);
                            } else {
                                console.log('The chatbot could not be loaded.')
                            }
                        }
                    }, 1000);
                };
                // Make one or multiple attempts to initialize the VerDatAs chatbot, if necessary
                initVerDatAsChatbot(25);
            </script>
        "
        );
    }
}
