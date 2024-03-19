# VerDatAsBot Plugin

The chatbot ILIAS plugin for the assistance system developed as part of the VerDatAs project.

The following requirements should be met:

* ILIAS 8.0 - 8.x
* PHP >= 8.0

## Installation

``` shell
# execute the following commands from your ILIAS root
mkdir -p Customizing/global/plugins/Services/UIComponent/UserInterfaceHook
cd Customizing/global/plugins/Services/UIComponent/UserInterfaceHook
git clone https://github.com/VerDatAs/tud-chatbot-plugin.git VerDatAsBot
# navigate back to your ILIAS root
cd /var/www/html
composer du
```

Locate to `Administration | Extending ILIAS | Plugins` and install, configure and activate `VerDatAsBot`.

## Configuration

Define the following settings:

* Backend URL (e.g., `https://tud-tas.example.com`)
* LRS-Type (i.e., an LRS type created in `Administration | Extending ILIAS | LRS`)

## Usage

* After successfully configuring and activating the plugin, the chatbot should open automatically.
* If this is not the case, log out and log back in again.
* If all components of the assistance system are linked correctly, the chatbot should greet you or welcome you back.

## Development

* If you use the ILIAS docker setup described [here](https://github.com/VerDatAs/all-ilias), which is located within the
  same folder such as `tud-chatbot-plugin`, you can run `sh local_development.sh` to reload your changes made.

## License

This plugin is licensed under the GPL v3 License (for further information, see [LICENSE](LICENSE)).

## Libraries used by this plugin

* Guzzle: an extensible PHP HTTP client – MIT license
* VerDatAs-Chatbot: the frontend application of the chatbot for the assistance system – (extended) GPL v3 license – retrieve the code and license information here: [templates/main.js](templates/main.js)
  * Please find the licenses of the third-party libraries used by the VerDatAs-Chatbot here: [templates/vendor.LICENSE.txt](templates/vendor.LICENSE.txt)
