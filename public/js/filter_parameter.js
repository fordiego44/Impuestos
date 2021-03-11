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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/delivery/index_app.js":
/*!********************************************!*\
  !*** ./resources/js/delivery/index_app.js ***!
  \********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _services_parameterSearch__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./services/parameterSearch */ "./resources/js/delivery/services/parameterSearch.js");
/* harmony import */ var _user_interface_Li__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./user-interface/Li */ "./resources/js/delivery/user-interface/Li.js");
/* harmony import */ var _slug_querySluglify__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./slug/querySluglify */ "./resources/js/delivery/slug/querySluglify.js");
/* harmony import */ var _slug_getQueries__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./slug/getQueries */ "./resources/js/delivery/slug/getQueries.js");




var HOST = "".concat(location.protocol, "//").concat(location.host);
localStorage.removeItem('parameter_search_tacna');
Object(_services_parameterSearch__WEBPACK_IMPORTED_MODULE_0__["getSearchParameter"])({
  url: "".concat(HOST, "/api/parameter_search")
}).then(function (result) {
  localStorage.setItem("parameter_search_tacna", JSON.stringify(result));
});
document.addEventListener("DOMContentLoaded", function (event) {
  if (document.getElementById('search-list')) {
    document.getElementById('search-list').addEventListener('mouseover', function (e) {
      var _e$target$dataset = e.target.dataset,
          search = _e$target$dataset.search,
          id = _e$target$dataset.id,
          name = _e$target$dataset.name,
          type = _e$target$dataset.type,
          type_filter = _e$target$dataset.type_filter;

      if (search === 'location') {
        var locationSearch = document.getElementById('params-search');
        var type_ = document.getElementById('type');
        locationSearch.value = name;
        locationSearch.dataset.id = id;
        locationSearch.dataset.type = type;
        locationSearch.dataset.name = name;
        type_.value = type_filter;
      }
    });
  }

  if (document.getElementById('params-search')) {
    document.getElementById('params-search').addEventListener("input", function (e) {
      var value = e.target.value;
      var showingLocation = value === '' ? '' : JSON.parse(localStorage.getItem('parameter_search_tacna')).filter(function (c) {
        return c.filter_name.toString().toLowerCase().includes(value.toLowerCase());
      }).slice(0, 7);
      var liTags = new _user_interface_Li__WEBPACK_IMPORTED_MODULE_1__["default"]('params-search', 'Location Filters', showingLocation);
      liTags.appentToElement('search-list');
    });
  }

  document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();
    var queries = Object(_slug_getQueries__WEBPACK_IMPORTED_MODULE_3__["getQueriesForIndex"])();
    window.location.href = Object(_slug_querySluglify__WEBPACK_IMPORTED_MODULE_2__["appendQuery"])(queries);
  });
});

/***/ }),

/***/ "./resources/js/delivery/services/parameterSearch.js":
/*!***********************************************************!*\
  !*** ./resources/js/delivery/services/parameterSearch.js ***!
  \***********************************************************/
/*! exports provided: getSearchParameter */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getSearchParameter", function() { return getSearchParameter; });
/* harmony import */ var _request_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./request.js */ "./resources/js/delivery/services/request.js");

var HOST = "".concat(location.protocol, "//").concat(location.host);
var getSearchParameter = function getSearchParameter(options) {
  return Object(_request_js__WEBPACK_IMPORTED_MODULE_0__["default"])(options).then(function (data) {
    return JSON.parse(data);
  });
};

/***/ }),

/***/ "./resources/js/delivery/services/request.js":
/*!***************************************************!*\
  !*** ./resources/js/delivery/services/request.js ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = (function (obj) {
  return new Promise(function (resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.open(obj.method || "GET", obj.url);

    if (obj.headers) {
      Object.keys(obj.headers).forEach(function (key) {
        xhr.setRequestHeader(key, obj.headers[key]);
      });
    }

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        resolve(xhr.response);
      } else {
        reject(xhr.statusText);
      }
    };

    xhr.onerror = function () {
      return reject(xhr.statusText);
    };

    xhr.send(obj.body);
  });
});

/***/ }),

/***/ "./resources/js/delivery/slug/getQueries.js":
/*!**************************************************!*\
  !*** ./resources/js/delivery/slug/getQueries.js ***!
  \**************************************************/
/*! exports provided: getQueriesForIndex */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getQueriesForIndex", function() { return getQueriesForIndex; });
var getQueriesForIndex = function getQueriesForIndex() {
  var search = string_to_slug(document.querySelector('[name="ctg"]').dataset.name);
  return [{
    type: 'department',
    value: document.querySelector('[name="department"]').value
  }, {
    type: 'business',
    value: document.querySelector('[name="business"]').value
  }, {
    type: 'search',
    value: search
  }];
};

function string_to_slug(str) {
  str = str.replace(/^\s+|\s+$/g, ""); // trim

  str = str.toLowerCase(); // remove accents, swap ñ for n, etc

  var from = "åàáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
  var to = "aaaaaaeeeeiiiioooouuuunc------";

  for (var i = 0, l = from.length; i < l; i++) {
    str = str.replace(new RegExp(from.charAt(i), "g"), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9 -]/g, "") // remove invalid chars
  .replace(/\s+/g, "-") // collapse whitespace and replace by -
  .replace(/-+/g, "-"); // collapse dashes

  return str;
}

/***/ }),

/***/ "./resources/js/delivery/slug/querySluglify.js":
/*!*****************************************************!*\
  !*** ./resources/js/delivery/slug/querySluglify.js ***!
  \*****************************************************/
/*! exports provided: getParams, appendQuery, removeQuery */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getParams", function() { return getParams; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "appendQuery", function() { return appendQuery; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "removeQuery", function() { return removeQuery; });
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

var getParams = function getParams() {
  var queryParams = document.location.search;

  if (document.location.search) {
    var keyRegex = new RegExp('([a-zA-Z]*[^&]*)', 'gi');
    var params = {};
    queryParams.match(keyRegex).map(function (val) {
      if (val === '') return;

      if (val.includes('&') || val.includes('?')) {
        val = val.substr(1);
      }

      var _val$split = val.split('='),
          _val$split2 = _slicedToArray(_val$split, 2),
          query = _val$split2[0],
          value = _val$split2[1];

      Object.assign(params, _defineProperty({}, decodeURIComponent(query), decodeURIComponent(value)));
    });
    return params;
  }

  return {};
};
var appendQuery = function appendQuery(key, value) {
  if (typeof value === 'undefined') return;
  var baseUrl = "".concat(location.protocol, "//").concat(location.host).concat(location.pathname);
  var urlQueryString = document.location.search;
  var newParam = key + '=' + encodeURIComponent(value),
      params = '?' + newParam;

  if (urlQueryString) {
    var keyRegex = new RegExp('([\?&])' + key + '[^&]*', 'gi'); // const keyValueQueryRegex = new RegExp(`(?<=${key}=)([\\d|,]+)[^&]*`, 'gi');

    var keyValueQueryRegex = new RegExp("".concat(key, "=([\\d|,]+)[^&]*"), 'gi');
    var regexSolveKeyValue = urlQueryString.match(keyValueQueryRegex);
    var queryStringMatch = regexSolveKeyValue != null ? regexSolveKeyValue[0].split('=')[1] : null;

    if (queryStringMatch !== null) {
      var valuesQuery = "".concat(queryStringMatch, ",").concat(encodeURIComponent(value)).split(',').sort(function (a, b) {
        return a - b;
      }).join(',');
      newParam = "".concat(key, "=").concat(valuesQuery);
      params = urlQueryString.replace(keyRegex, '$1' + newParam);
    } else {
      if ('&' === urlQueryString[urlQueryString.length - 1]) {
        params = urlQueryString + newParam;
      } else {
        params = urlQueryString + '&' + newParam;
      }
    }
  }

  params = params.replace(/&{2,}/, '&');
  return "".concat(baseUrl).concat(params);
};
var removeQuery = function removeQuery(key, value) {
  var baseUrl = "".concat(location.protocol, "//").concat(location.host).concat(location.pathname);
  var urlQueryString = document.location.search;
  var params = urlQueryString;

  if (urlQueryString) {
    // const keyValueQueryRegex = new RegExp(`(?<=${key}=)([\\d|,|%2B|\\w]+)[^&]*`, 'gi');
    var keyValueQueryRegex = new RegExp("".concat(key, "=([\\d|,|%2B|\\w]+)[^&]*"), 'gi');
    var keyRegex = new RegExp(key + '=' + '[\\d|,|%2B|\\w]*', 'gi');
    var regexResolveKeyValue = urlQueryString.match(keyValueQueryRegex);
    var queryStringMatch = regexResolveKeyValue != null ? regexResolveKeyValue[0].split('=')[1] : null;

    if (typeof value === 'undefined') {
      if (urlQueryString.match(keyRegex) !== null) {
        params = urlQueryString.replace(keyRegex, '');
      }
    } else {
      if (queryStringMatch !== null) {
        var valueQuery = queryStringMatch.split(',').filter(function (val) {
          return val !== value;
        }).join(',');
        var replaceValueQuery = valueQuery === '' ? '' : "".concat(key, "=").concat(valueQuery);
        params = urlQueryString.replace(keyRegex, replaceValueQuery);

        if (params[params.length - 1] === '&') {
          params = params.substring(0, params.length - 1);
        }
      } else {}
    }
  }

  params = params.replace(/&{2,}/, '&');
  return "".concat(baseUrl).concat(params);
};

/***/ }),

/***/ "./resources/js/delivery/user-interface/BaseElement.js":
/*!*************************************************************!*\
  !*** ./resources/js/delivery/user-interface/BaseElement.js ***!
  \*************************************************************/
/*! exports provided: BaseElement */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "BaseElement", function() { return BaseElement; });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var BaseElement = /*#__PURE__*/function () {
  function BaseElement() {
    _classCallCheck(this, BaseElement);

    this.element = null;
  }

  _createClass(BaseElement, [{
    key: "appentToElement",
    value: function appentToElement(el) {
      this.createElement();
      document.getElementById(el).innerHTML = this.element;
    }
  }, {
    key: "insertAfterToElement",
    value: function insertAfterToElement(el) {
      this.createElement();
      var elem = document.createElement('div');
      elem.innerHTML = this.element;
      document.getElementById(el).appendChild(elem);
    }
  }, {
    key: "insertDeleteAfterToElement",
    value: function insertDeleteAfterToElement(el) {
      this.createElement();
      var elem = document.createElement('div');
      elem.innerHTML = this.element;
      document.getElementById(el).appendChild(elem);
    }
  }, {
    key: "createElement",
    value: function createElement() {
      var stringElement = this.getElementString();
      this.element = stringElement;
    }
  }, {
    key: "getElementString",
    value: function getElementString() {
      throw 'Override';
    }
  }, {
    key: "enableJS",
    value: function enableJS() {
      componentHandler.upgradeElement(this.element[0]);
    }
  }]);

  return BaseElement;
}();

/***/ }),

/***/ "./resources/js/delivery/user-interface/Li.js":
/*!****************************************************!*\
  !*** ./resources/js/delivery/user-interface/Li.js ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Li; });
/* harmony import */ var _BaseElement__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./BaseElement */ "./resources/js/delivery/user-interface/BaseElement.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _createForOfIteratorHelper(o) { if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (o = _unsupportedIterableToArray(o))) { var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var it, normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function () { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }



var Li = /*#__PURE__*/function (_BaseElement) {
  _inherits(Li, _BaseElement);

  var _super = _createSuper(Li);

  function Li(category, title, data) {
    var _this;

    _classCallCheck(this, Li);

    _this = _super.call(this);
    _this._id = category;
    _this.title = title;
    _this.data = data;
    return _this;
  }

  _createClass(Li, [{
    key: "getElementString",
    value: function getElementString() {
      var liTag = '';

      if (this.data.length == 0) {
        liTag += "<li class=\"li_location_mouse\" data-id=\"\" data-fullname=\"\" data-name=\"\" data-type=\"\" data-type_filter=\"\" data-search=\"location\">\n                            <a data-id=\"\" data-fullname=\"\" data-name=\"\" data-type=\"\" data-type_filter=\"\" data-search=\"location\">\n                                 \n                            <i class=\"fa fa-times\" aria-hidden=\"true\"></i>\n                            No se encontraron resultados \n                            </a>\n                        </li>";
      } else {
        var _iterator = _createForOfIteratorHelper(this.data),
            _step;

        try {
          for (_iterator.s(); !(_step = _iterator.n()).done;) {
            var data = _step.value;
            liTag += "<li class=\"li_location_mouse\" data-id=\"".concat(data.id, "\" data-fullname=\"").concat(data.filter_name, "\" data-name=\"").concat(data.filter_name, "\" data-type=\"").concat(data.type, "\" data-type_filter=\"").concat(data.type_filter, "\" data-search=\"location\">\n                            <a data-id=\"").concat(data.id, "\" data-fullname=\"").concat(data.filter_name, "\" data-name=\"").concat(data.filter_name, "\" data-type=\"").concat(data.type, "\" data-type_filter=\"").concat(data.type_filter, "\" data-search=\"location\">\n                            ").concat(data.filter_name, " ").concat(data.type ? '(' + data.type + ')' : '', "</a>\n                          </li>");
          }
        } catch (err) {
          _iterator.e(err);
        } finally {
          _iterator.f();
        }
      }

      return liTag;
    }
  }]);

  return Li;
}(_BaseElement__WEBPACK_IMPORTED_MODULE_0__["BaseElement"]);



/***/ }),

/***/ 0:
/*!**************************************************!*\
  !*** multi ./resources/js/delivery/index_app.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Julio\Documents\WORK\ZOFRA-TACNA\delivery-v2\resources\js\delivery\index_app.js */"./resources/js/delivery/index_app.js");


/***/ })

/******/ });