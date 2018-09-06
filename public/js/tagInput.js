/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 45);
/******/ })
/************************************************************************/
/******/ ({

/***/ 45:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(46);


/***/ }),

/***/ 46:
/***/ (function(module, exports) {

$.fn.tagInput = function (options) {

	return this.each(function () {

		var settings = $.extend({}, { labelClass: "label label-success" }, options);

		var tagInput = $(this);
		var hiddenInput = $(this).children('input[type=hidden]');
		var textInput = $(this).children('input[type=text]');

		cleanUpHiddenField();

		var defaultValues = hiddenInput.val().split(',');
		if (hiddenInput.val() != "") {
			for (i = 0; i < defaultValues.length; i++) {
				addLabel(defaultValues[i]);
			}
		}
		textInput.keydown(function (event) {
			var str = $(this).val();
			if (event.keyCode == 8) {
				//Backspace
				if (str.length == 0) {
					closeLabel(-1);
				}
			} else if (event.keyCode == 13) {
				//Enter
				makeBadge();
				event.preventDefault();
				return false;
			}
		});

		textInput.keyup(function (event) {
			var str = $(this).val();
			if (event.keyCode == 27) {
				//Escape
				textInput.val("");
				textInput.blur();
			} else if (event.keyCode == 13) {
				//Enter
				makeBadge();
				event.preventDefault();
				return false;
			}
			if (str.indexOf(",") >= 0) {
				makeBadge();
			}
		});

		textInput.change(function () {
			makeBadge();
		});

		function makeBadge() {
			str = textInput.val();
			if (/\S/.test(str)) {
				str = str.replace(',', '');
				str = str.trim();
				textInput.val("");
				addLabel(str);
				var result = textInput.next();
				result.val(result.val() + ',' + str);
				cleanUpHiddenField();
			}
		}

		function closeLabel(id) {
			if (id > 0) {
				label = tagInput.children('span.tagLabel[data-badge=' + id + ']');
			} else {
				label = tagInput.children('span.tagLabel').last();
			}
			hiddenInput.val(hiddenInput.val().replace(label.text().slice(0, -2), ''));
			cleanUpHiddenField();
			label.remove();
		}

		function addLabel(str) {
			if (tagInput.children('span.tagLabel').length > 0) {
				badge = textInput.prev();
				var id = badge.data('badge') + 1;
				label = $('<span class="' + settings.labelClass + ' tagLabel" data-badge="' + id + '">' + str + ' <a href="#" data-badge="' + id + '" aria-label="close" class="closelabel">&times;</a></span> ').insertAfter(badge);
			} else {
				label = $('<span class="' + settings.labelClass + ' tagLabel" data-badge="1">' + str + ' <a href="#" data-badge="1" aria-label="close" class="closelabel">&times;</a></span> ').insertBefore(textInput);
			}
			label.children('.closelabel').click(function () {
				closeLabel($(this).data('badge'));
			});
		}

		function cleanUpHiddenField() {
			s = hiddenInput.val();
			s = s.replace(/^( *, *)+|(, *(?=,|$))+/g, '');
			hiddenInput.val(s);
		}
	});
};

/***/ })

/******/ });