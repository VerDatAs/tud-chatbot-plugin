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
 * Class ilVerDatAsBotPlugin
 *
 * @author TU Dresden <tommy.kubica@tu-dresden.de>
 */
class ilVerDatAsBotPlugin extends ilUserInterfaceHookPlugin
{
    const PLUGIN_ID = "vbot";
    const PLUGIN_NAME = "VerDatAsBot";
    protected static ilVerDatAsBotPlugin $instance;

    /**
     * Retrieve the name of the plugin.
     */
    public function getPluginName(): string
    {
        return self::PLUGIN_NAME;
    }

    /**
     * Retrieve the instance of the ilVerDatAsBotPlugin.
     *
     * @return ilVerDatAsBotPlugin
     */
    public static function getInstance(): ilVerDatAsBotPlugin
    {
        if (!isset(self::$instance)) {
            global $DIC;
            $componentRepository = $DIC['component.repository'];
            $pluginInfo = $componentRepository->getComponentByTypeAndName('Services', 'UIComponent')->getPluginSlotById('uihk')->getPluginByName(self::PLUGIN_NAME);
            $componentFactory = $DIC['component.factory'];
            self::$instance = $componentFactory->getPlugin($pluginInfo->getId());
        }
        return self::$instance;
    }
}
