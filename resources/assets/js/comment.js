// 无限极评论
;(function ($, window, document, undefined) {
   // 组件名称
   var pluginName = "comment";
   // 默认参数
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
     var _this = $(this.element), // 指向当前调用元素
         _self = this; // 指向本构造函数

     // 发送一级评论
     var TopBtn = _this.find('.js_top_send'); // 一级评论按钮
     var TopText = _this.find('.js_top_text'); // 二级品管理
     var comment_box = $('.js_comment_box'); // 顶级元素

     TopBtn.on('click', function (evt) {
       evt.preventDefault();
       evt.stopPropagation();

       var btnSelf = $(this);

       // 获取Ajax参数
       var data_params = _self.getParams( btnSelf );

       data_params.body = TopText.val();

       // 发送Ajax
       var ele_str = _self.sendAjax( data_params, comment_box );
     });

     // 点击一级回复按钮
     _this.on('click', '.js_sub_show', function (evt) {
       evt.preventDefault();
       evt.stopPropagation();

       var btnSelf = $(this);
       var parent_comment = btnSelf.parents('.comments');
       var form = parent_comment.find('.new-comment');

       form.show(200);
     });

     // 取消按钮
     _this.on('click', '.cancel', function (evt) {
       evt.preventDefault();
       evt.stopPropagation();

       var btnSelf = $(this);
       var parent_comment = btnSelf.parents('.comment');
       var form = parent_comment.find('.new-comment');

       form.find('textarea').val('');
       form.hide(200);
     });

     // 无限极恢复按钮
     _this.on('click', '.js_num_comment', function (evt) {
       evt.preventDefault();
       evt.stopPropagation();

       var btnSelf = $(this);
       var parent_comment = btnSelf.parents('.comment');
       var form = parent_comment.find('.new-comment');

       form.find('textarea').val('@' + $(this).parents('.sub-comment').find('.v-tooltip-content a').html() + ': ');
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
       var data_params = _self.getParams( btnSelf );

       data_params.parent_id = btnSelf.attr('data-comment_id');
       data_params.body = form.val();

       // 发送Ajax
       var ele_str = _self.sendAjax( data_params, parent_comment );
     });
   }

   // 获取参数
   Comment.prototype.getParams = function ( dom ) {
     if ( dom === 'undefined' ) {
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
   }

   // 发送Ajax
   Comment.prototype.sendAjax = function ( data, box ) {
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
       success: function ( res ) {
         if ( res && res.code === '200' ) {
           console.log(res);
           var res_data = res.msg;
           var tel = '';
           res_data.created_at = res_data.created_at.date;

           if ( res_data.parent_id == 0 ) {
             // 一级评论
             var tel = $('#js_top_comment_tel').html();
           } else {
             // 二级评论
             var tel = $('#js_sub_comment_tel').html();
           }

           if ( typeof tel == 'string' ) {
              var tel_str = self.template(tel, res_data);
           }

           box.prepend(tel_str);
         }
       },
       error: function ( err ) {
         return false;
       }
     });
   }

   // 模板函数
   Comment.prototype.template = function(tpl, hash) {
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
            if ( typeof hash[tag] === 'string' || typeof hash[tag] === 'number' && isFinite(hash[tag]) ) {
                return hash[tag];
            }
            return '';
        });
    };

   $.fn[ pluginName ] = function (options) {
     var ele = this;

     return this.each(function () {
       new Comment(ele, options)
     })
   };
})(jQuery, window, document);
