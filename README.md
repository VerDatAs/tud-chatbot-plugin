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

* TAS-Backend URL (e.g., `https://tud-tas.example.com`)
* LRS-Type (i.e., an LRS type created in `Administration | Extending ILIAS | LRS`)

## Usage

* After successfully configuring and activating the plugin, the chatbot should open automatically.
* If this is not the case, log out and log back in again.
* If all components of the assistance system are linked correctly, the chatbot should greet you or welcome you back.

## License

This plugin is licensed under the GPL v3 License (for further information, see [LICENSE](LICENSE)).

## Libraries used

* Guzzle: an extensible PHP HTTP client – MIT license – https://github.com/guzzle/guzzle
* [tud-chatbot](https://github.com/VerDatAs/tud-chatbot) (version [0.0.3](https://github.com/VerDatAs/tud-chatbot/releases/tag/0.0.3)): the frontend application of the chatbot for the assistance system – GPL v3 license
  * Retrieve the code and license information here: [templates/main.js](templates/main.js)
  * The following libraries are used by [tud-chatbot (version 0.0.3)](https://github.com/VerDatAs/tud-chatbot/releases/tag/0.0.3):

|    Name    |   Version  |   License  |     URL    |
| ---------- | ---------- | ---------- | ---------- |
| @babel/helper-string-parser | 7.24.8 | MIT | https://github.com/babel/babel |
| @babel/helper-validator-identifier | 7.24.7 | MIT | https://github.com/babel/babel |
| @babel/parser | 7.25.3 | MIT | https://github.com/babel/babel |
| @babel/types | 7.25.2 | MIT | https://github.com/babel/babel |
| @jridgewell/sourcemap-codec | 1.5.0 | MIT | https://github.com/jridgewell/sourcemap-codec |
| @vue/compiler-core | 3.4.38 | MIT | https://github.com/vuejs/core |
| @vue/compiler-dom | 3.4.38 | MIT | https://github.com/vuejs/core |
| @vue/compiler-sfc | 3.4.38 | MIT | https://github.com/vuejs/core |
| @vue/compiler-ssr | 3.4.38 | MIT | https://github.com/vuejs/core |
| @vue/devtools-api | 6.6.3 | MIT | https://github.com/vuejs/vue-devtools |
| @vue/reactivity | 3.4.38 | MIT | https://github.com/vuejs/core |
| @vue/runtime-core | 3.4.38 | MIT | https://github.com/vuejs/core |
| @vue/runtime-dom | 3.4.38 | MIT | https://github.com/vuejs/core |
| @vue/server-renderer | 3.4.38 | MIT | https://github.com/vuejs/core |
| @vue/shared | 3.4.38 | MIT | https://github.com/vuejs/core |
| @vueuse/core | 7.7.1 | MIT | https://github.com/vueuse/vueuse |
| @vueuse/shared | 7.7.1 | MIT | https://github.com/vueuse/vueuse |
| animate.css | 4.1.1 | MIT | https://github.com/animate-css/animate.css |
| asynckit | 0.4.0 | MIT | https://github.com/alexindigo/asynckit |
| axios | 1.7.4 | MIT | https://github.com/axios/axios |
| combined-stream | 1.0.8 | MIT | https://github.com/felixge/node-combined-stream |
| csstype | 3.1.3 | MIT | https://github.com/frenic/csstype |
| delayed-stream | 1.0.0 | MIT | https://github.com/felixge/node-delayed-stream |
| entities | 4.5.0 | BSD-2-Clause | https://github.com/fb55/entities |
| estree-walker | 2.0.2 | MIT | https://github.com/Rich-Harris/estree-walker |
| follow-redirects | 1.15.6 | MIT | https://github.com/follow-redirects/follow-redirects |
| form-data | 4.0.0 | MIT | https://github.com/form-data/form-data |
| magic-string | 0.30.11 | MIT | https://github.com/rich-harris/magic-string |
| mime-db | 1.52.0 | MIT | https://github.com/jshttp/mime-db |
| mime-types | 2.1.35 | MIT | https://github.com/jshttp/mime-types |
| nanoid | 3.3.7 | MIT | https://github.com/ai/nanoid |
| picocolors | 1.1.0 | ISC | https://github.com/alexeyraspopov/picocolors |
| pinia-plugin-persistedstate | 3.2.1 | MIT | https://github.com/prazdevs/pinia-plugin-persistedstate |
| pinia | 2.2.1 | MIT | https://github.com/vuejs/pinia |
| postcss | 8.4.47 | MIT | https://github.com/postcss/postcss |
| proxy-from-env | 1.1.0 | MIT | https://github.com/Rob--W/proxy-from-env |
| source-map-js | 1.2.1 | BSD-3-Clause | https://github.com/7rulnik/source-map-js |
| to-fast-properties | 2.0.0 | MIT | https://github.com/sindresorhus/to-fast-properties |
| typescript | 5.4.5 | Apache-2.0 | https://github.com/Microsoft/TypeScript |
| vue-demi | 0.13.11 | MIT | https://github.com/antfu/vue-demi |
| vue-demi | 0.14.10 | MIT | https://github.com/antfu/vue-demi |
| vue | 3.4.38 | MIT | https://github.com/vuejs/core |
| vuejs-confirm-dialog | 0.5.2 | MIT | https://github.com/harmyderoman/vuejs-confirm-dialog |
