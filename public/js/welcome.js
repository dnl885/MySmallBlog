/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/welcome.js":
/*!*********************************!*\
  !*** ./resources/js/welcome.js ***!
  \*********************************/
/***/ (() => {

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

var Welcome = {
  LogInSignUpBtn: null,
  LogInSignUpOverlay: null,
  LogInSignUpOverlayCloseBtn: null,
  LogInSignUpTab: null,
  LogInSignUpSubmitBtn: null,
  ActiveTab: null,
  EmailVerificationModal: null,
  init: function init() {
    this.LogInSignUpBtn = $('.btn-login-signup');
    this.LogInSignUpOverlayCloseBtn = $('.close-overlay');
    this.LogInSignUpOverlay = $('.overlay');
    this.LogInSignUpTab = $('.tab');
    this.LogInSignUpSubmitBtn = $('.btn-submit');
    this.ActiveTab = $('.login-screen');
    this.EmailVerificationModal = $('.bd-verification-modal-sm');
    this.bindOverlayClickActions();
    this.showEmailVerifiedModal();
  },
  showEmailVerifiedModal: function showEmailVerifiedModal() {
    if (this.EmailVerificationModal.length) {
      this.EmailVerificationModal.modal();
    }
  },
  appendValidationErrorsToInput: function appendValidationErrorsToInput(ctx, errors) {
    ctx.ActiveTab.find('input').removeClass('is-invalid');
    ctx.ActiveTab.find('input').siblings('.is-invalid-message').remove();

    for (var _i = 0, _Object$entries = Object.entries(errors); _i < _Object$entries.length; _i++) {
      var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
          key = _Object$entries$_i[0],
          value = _Object$entries$_i[1];

      var inputClass = "input[name=\"".concat(key, "\"]");
      var input = ctx.ActiveTab.find(inputClass);
      input.addClass('is-invalid');
      input.parent().append("<div class=\"is-invalid-message\">".concat(value, "</div>"));
    }
  },
  bindOverlayClickActions: function bindOverlayClickActions() {
    var self = this;

    var showIcons = function showIcons() {
      var iconToShowClass = ".icon-" + $(this).attr('name');
      var activeScreen = $('.' + self.ActiveTab.attr('class'));
      activeScreen.find('.icon').hide();
      activeScreen.find(iconToShowClass).show();
    };

    this.LogInSignUpBtn.on('click', function (e) {
      e.preventDefault();
      self.LogInSignUpOverlay.fadeIn();
      $('body').addClass('no-scroll');
    });
    this.LogInSignUpOverlayCloseBtn.on('click', function () {
      self.LogInSignUpOverlay.fadeOut();
      $('body').removeClass('no-scroll');
    });
    this.LogInSignUpTab.on('click', function () {
      var toInactivate = $(this).siblings();
      var toActivate = $(this);
      toInactivate.removeClass('tab-active').addClass('tab-inactive');
      toActivate.removeClass('tab-inactive').addClass('tab-active');
      var screenToShowD = toActivate.attr('data-screen');
      var screenToHideD = toInactivate.attr('data-screen');
      var activeTabInput = self.ActiveTab.find('input');
      activeTabInput.off('focus');
      activeTabInput.removeClass('is-invalid');
      activeTabInput.siblings('.is-invalid-message').remove();
      activeTabInput.not(':input[type=submit], :input[type=hidden]').val("");
      self.ActiveTab.find('.icon').hide();
      self.ActiveTab = $('.' + toActivate.attr('data-screen'));
      self.ActiveTab.find('input').not(':input[type=submit]').on('focus', showIcons);
      $(".".concat(screenToHideD)).hide();
      $(".".concat(screenToShowD)).show();
    });
    this.LogInSignUpSubmitBtn.on('click', function (e) {
      e.preventDefault();
      var $form = $(this).closest('form');
      var url = $form.attr('action');
      var data = $form.serialize();
      var button = $(this);
      var settings = {
        'url': url,
        'method': 'POST',
        'data': data,
        'beforeSend': function beforeSend() {
          button.addClass('button-disabled');
          button.prop('disabled', true);
        },
        'error': function error(xhr) {
          var respJson = xhr.responseJSON;
          button.removeClass('button-disabled');
          button.prop('disabled', false);

          if (respJson) {
            self.appendValidationErrorsToInput(self, respJson.errors);
          }
        },
        'success': function success(resp) {
          if (resp.success) {
            location.href = resp.redirect;
          }
        }
      };
      $.ajax(settings);
    });
    this.ActiveTab.find('input').not(':input[type=submit]').on('focus', showIcons);
  }
};
window.Welcome = Welcome;

/***/ }),

/***/ "./resources/css/blog.css":
/*!********************************!*\
  !*** ./resources/css/blog.css ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/welcome": 0,
/******/ 			"css/blog": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/blog"], () => (__webpack_require__("./resources/js/welcome.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/blog"], () => (__webpack_require__("./resources/css/blog.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;