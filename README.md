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

## Development

* If you use the ILIAS docker setup described [here](https://github.com/VerDatAs/all-ilias), which is located within the
  same folder such as `tud-chatbot-plugin`, you can run `sh local_development.sh` to reload your changes made.

## License

This plugin is licensed under the GPL v3 License (for further information, see [LICENSE](LICENSE)).

## Libraries used

* Guzzle: an extensible PHP HTTP client – MIT license – https://github.com/guzzle/guzzle
* [tud-chatbot](https://github.com/VerDatAs/tud-chatbot): the frontend application of the chatbot for the assistance system – GPL v3 license
  * Retrieve the code and license information here: [templates/main.js](templates/main.js)
  * The following libraries are used by [tud-chatbot](https://github.com/VerDatAs/tud-chatbot):

|    Name    |   Version  |   License  |     URL    |
| ---------- | ---------- | ---------- | ---------- |
| @babel/parser | 7.23.0 | MIT | https://github.com/babel/babel |
| @esbuild/darwin-arm64 | 0.18.20 | MIT | https://github.com/evanw/esbuild |
| @jridgewell/gen-mapping | 0.3.3 | MIT | https://github.com/jridgewell/gen-mapping |
| @jridgewell/resolve-uri | 3.1.1 | MIT | https://github.com/jridgewell/resolve-uri |
| @jridgewell/set-array | 1.1.2 | MIT | https://github.com/jridgewell/set-array |
| @jridgewell/source-map | 0.3.5 | MIT | https://github.com/jridgewell/source-map |
| @jridgewell/sourcemap-codec | 1.4.15 | MIT | https://github.com/jridgewell/sourcemap-codec |
| @jridgewell/trace-mapping | 0.3.20 | MIT | https://github.com/jridgewell/trace-mapping |
| @types/node | 18.18.9 | MIT | https://github.com/DefinitelyTyped/DefinitelyTyped |
| @vue/compiler-core | 3.3.7 | MIT | https://github.com/vuejs/core |
| @vue/compiler-dom | 3.3.7 | MIT | https://github.com/vuejs/core |
| @vue/compiler-sfc | 3.3.7 | MIT | https://github.com/vuejs/core |
| @vue/compiler-ssr | 3.3.7 | MIT | https://github.com/vuejs/core |
| @vue/devtools-api | 6.5.1 | MIT | https://github.com/vuejs/vue-devtools |
| @vue/reactivity-transform | 3.3.7 | MIT | https://github.com/vuejs/core |
| @vue/reactivity | 3.3.7 | MIT | https://github.com/vuejs/core |
| @vue/runtime-core | 3.3.7 | MIT | https://github.com/vuejs/core |
| @vue/runtime-dom | 3.3.7 | MIT | https://github.com/vuejs/core |
| @vue/server-renderer | 3.3.7 | MIT | https://github.com/vuejs/core |
| @vue/shared | 3.3.7 | MIT | https://github.com/vuejs/core |
| @vueuse/core | 7.7.1 | MIT | https://github.com/vueuse/vueuse |
| @vueuse/shared | 7.7.1 | MIT | https://github.com/vueuse/vueuse |
| acorn | 8.11.2 | MIT | https://github.com/acornjs/acorn |
| animate.css | 4.1.1 | MIT | https://github.com/animate-css/animate.css |
| anymatch | 3.1.3 | ISC | https://github.com/micromatch/anymatch |
| asynckit | 0.4.0 | MIT | https://github.com/alexindigo/asynckit |
| axios | 1.6.0 | MIT | https://github.com/axios/axios |
| binary-extensions | 2.2.0 | MIT | https://github.com/sindresorhus/binary-extensions |
| braces | 3.0.2 | MIT | https://github.com/micromatch/braces |
| buffer-from | 1.1.2 | MIT | https://github.com/LinusU/buffer-from |
| chokidar | 3.5.3 | MIT | https://github.com/paulmillr/chokidar |
| combined-stream | 1.0.8 | MIT | https://github.com/felixge/node-combined-stream |
| commander | 2.20.3 | MIT | https://github.com/tj/commander.js |
| csstype | 3.1.2 | MIT | https://github.com/frenic/csstype |
| de-indent | 1.0.2 | MIT | https://github.com/yyx990803/de-indent |
| delayed-stream | 1.0.0 | MIT | https://github.com/felixge/node-delayed-stream |
| esbuild | 0.18.20 | MIT | https://github.com/evanw/esbuild |
| estree-walker | 2.0.2 | MIT | https://github.com/Rich-Harris/estree-walker |
| fill-range | 7.0.1 | MIT | https://github.com/jonschlinkert/fill-range |
| follow-redirects | 1.15.3 | MIT | https://github.com/follow-redirects/follow-redirects |
| form-data | 4.0.0 | MIT | https://github.com/form-data/form-data |
| fsevents | 2.3.3 | MIT | https://github.com/fsevents/fsevents |
| glob-parent | 5.1.2 | ISC | https://github.com/gulpjs/glob-parent |
| he | 1.2.0 | MIT | https://github.com/mathiasbynens/he |
| immutable | 4.3.4 | MIT | https://github.com/immutable-js/immutable-js |
| is-binary-path | 2.1.0 | MIT | https://github.com/sindresorhus/is-binary-path |
| is-extglob | 2.1.1 | MIT | https://github.com/jonschlinkert/is-extglob |
| is-glob | 4.0.3 | MIT | https://github.com/micromatch/is-glob |
| is-number | 7.0.0 | MIT | https://github.com/jonschlinkert/is-number |
| magic-string | 0.30.5 | MIT | https://github.com/rich-harris/magic-string |
| mime-db | 1.52.0 | MIT | https://github.com/jshttp/mime-db |
| mime-types | 2.1.35 | MIT | https://github.com/jshttp/mime-types |
| nanoid | 3.3.6 | MIT | https://github.com/ai/nanoid |
| normalize-path | 3.0.0 | MIT | https://github.com/jonschlinkert/normalize-path |
| picocolors | 1.0.0 | ISC | https://github.com/alexeyraspopov/picocolors |
| picomatch | 2.3.1 | MIT | https://github.com/micromatch/picomatch |
| pinia-plugin-persistedstate | 3.2.0 | MIT | https://github.com/prazdevs/pinia-plugin-persistedstate |
| pinia | 2.1.7 | MIT | https://github.com/vuejs/pinia |
| postcss | 8.4.31 | MIT | https://github.com/postcss/postcss |
| proxy-from-env | 1.1.0 | MIT | https://github.com/Rob--W/proxy-from-env |
| readdirp | 3.6.0 | MIT | https://github.com/paulmillr/readdirp |
| rollup | 3.29.4 | MIT | https://github.com/rollup/rollup |
| sass | 1.69.5 | MIT | https://github.com/sass/dart-sass |
| source-map-js | 1.0.2 | BSD-3-Clause | https://github.com/7rulnik/source-map-js |
| source-map-support | 0.5.21 | MIT | https://github.com/evanw/node-source-map-support |
| source-map | 0.6.1 | BSD-3-Clause | https://github.com/mozilla/source-map |
| terser | 5.24.0 | BSD-2-Clause | https://github.com/terser/terser |
| to-regex-range | 5.0.1 | MIT | https://github.com/micromatch/to-regex-range |
| typescript | 5.2.2 | Apache-2.0 | https://github.com/Microsoft/TypeScript |
| undici-types | 5.26.5 | MIT | https://github.com/nodejs/undici |
| vite-plugin-css-injected-by-js | 3.3.0 | MIT | https://github.com/marco-prontera/vite-plugin-css-injected-by-js |
| vite | 4.5.0 | MIT | https://github.com/vitejs/vite |
| vue-demi | 0.13.11 | MIT | https://github.com/antfu/vue-demi |
| vue-demi | 0.14.6 | MIT | https://github.com/antfu/vue-demi |
| vue-template-compiler | 2.7.15 | MIT | https://github.com/vuejs/vue |
| vue | 3.3.7 | MIT | https://github.com/vuejs/core |
| vuejs-confirm-dialog | 0.5.1 | MIT | https://github.com/harmyderoman/vuejs-confirm-dialog |
