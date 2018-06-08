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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 43);
/******/ })
/************************************************************************/
/******/ ({

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(44);


/***/ }),

/***/ 44:
/***/ (function(module, exports) {

// 无限极评论
;(function ($, window, document, undefined) {
  var pluginName = "comment";
  var defaults = {};

  // 构造函数
  function Comment(element, options) {
    this.element = element;
    this.settings = $.extend({}, defaults, options);

    // 初始化
    this.init();
  }

  // 初始化
  Comment.prototype.init = function () {
    var _this = $(this.element),
        // 指向当前调用元素
    _self = this; // 指向本构造函数
    // 发送一级评论
    var TopBtn = _this.find('.js_top_send');
    var TopText = _this.find('.js_top_text');
    var comment_box = $('.js_comment_box');

    TopBtn.on('click', function (evt) {
      evt.preventDefault();
      evt.stopPropagation();

      var btnSelf = $(this);
      // 获取Ajax参数
      var data_params = _self.getParams(btnSelf);

      data_params.body = TopText.val();

      // 发送Ajax
      var ele_str = _self.sendAjax(data_params, comment_box);
    });

    // 点击一级回复按钮
    _this.on('click', '.js_sub_show', function (evt) {
      evt.preventDefault();
      evt.stopPropagation();

      var btnSelf = $(this);
      var parent_comment = btnSelf.parents('.comment');
      var form = parent_comment.find('.new-comment');

      form.show(200);
    });

    _this.on('click', '.js_num_comment', function (evt) {
      evt.preventDefault();
      evt.stopPropagation();

      var btnSelf = $(this);
      var parent_comment = btnSelf.parents('.comment');
      var form = parent_comment.find('.new-comment');

      form.find('textarea').val('@' + $(this).parents('.sub-comment').find('.v-tooltip-content a').html() + ' ');
      console.log($(this).parents('.sub-comment').find('.v-tooltip-content a').html());
      form.show(200);
    });

    // 点击二级回复
    _this.on('click', '.js_sub_send', function (evt) {
      evt.preventDefault();
      evt.stopPropagation();

      var btnSelf = $(this);
      var parent_comment = btnSelf.parents('.sub-comment-list');
      var form = parent_comment.find('textarea');
      // 获取Ajax参数
      var data_params = _self.getParams(btnSelf);

      data_params.parent_id = btnSelf.attr('data-comment_id');
      data_params.body = form.val();

      // 发送Ajax
      var ele_str = _self.sendAjax(data_params, parent_comment);
    });
  };

  // 获取参数
  Comment.prototype.getParams = function (dom) {
    if (dom === 'undefined') {
      return {};
    }

    var user_id = dom.attr('data-user_id');
    var article_id = dom.attr('data-article_id');
    var parent_id = dom.attr('data-parent_id') ? dom.attr('data-parent_id') : 0;

    // 返回所需参数
    return {
      user_id: user_id,
      article_id: article_id,
      parent_id: parent_id
    };
  };

  // 发送Ajax
  Comment.prototype.sendAjax = function (data, box) {
    var self = this;
    var ajax_data = data ? data : {};

    // CSRF保护
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "post",
      dataType: "json",
      url: "/comments",
      async: false,
      data: ajax_data,
      success: function success(res) {
        if (res && res.code === '200') {
          var res_data = res.msg;
          var tel = '';
          res_data.created_at = res_data.created_at.date;

          if (res_data.parent_id == 0) {
            // 一级评论
            var tel = $('#js_top_comment_tel').html();
          } else {
            // 二级评论
            var tel = $('#js_sub_comment_tel').html();
          }

          if (typeof tel == 'string') {
            var tel_str = self.template(tel, res_data);
          }

          box.append(tel_str);
        }
      },
      error: function error(err) {
        return false;
      }
    });
  };

  // 模板函数
  Comment.prototype.template = function (tpl, hash) {
    var regex = /\{.*?\}/gi;

    return tpl.replace(regex, function replacer(str, pos, tpl) {
      var properties = str.replace('{', '').replace('}', '').trim().split(' ');
      var tag = properties[0];
      if (!tag || !hash.hasOwnProperty(tag)) {
        return '';
      }
      if (typeof hash[tag] === 'function') {
        return hash[tag].apply(tpl, properties);
      }
      if (typeof hash[tag] === 'string' || typeof hash[tag] === 'number' && isFinite(hash[tag])) {
        return hash[tag];
      }
      return '';
    });
  };

  $.fn[pluginName] = function (options) {
    var ele = this;

    return this.each(function () {
      new Comment(ele, options);
    });
  };
})(jQuery, window, document);

/***/ })

/******/ });