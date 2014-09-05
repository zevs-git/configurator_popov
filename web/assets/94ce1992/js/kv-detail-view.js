/*!
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @version 1.0.0
 *
 * Client extension for the yii2-detail-view extension 
 * 
 * Author: Kartik Visweswaran
 * Copyright: 2014, Kartik Visweswaran, Krajee.com
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */

(function ($) {

    var KvDetailView = function (element, options) {
        this.$element = $(element);
        this.mode = options.mode;
        this.initElements();
        this.init();
    };

    KvDetailView.prototype = {
        constructor: KvDetailView,
        init: function () {
            var self = this;
            self.setMode(self.mode);
            self.$btnUpdate.on('click', function (e) {
                self.setMode('edit');
            });
            self.$btnView.on('click', function (e) {
                self.setMode('view');
            });
        },
        setMode: function (mode) {
            var self = this;
            self.$attribs.removeClass('kv-hide');
            self.$formAttribs.removeClass('kv-hide');
            self.$buttons1.removeClass('kv-hide');
            self.$buttons2.removeClass('kv-hide');

            if (mode === 'edit') {
                self.$attribs.addClass('kv-hide');
                self.$formAttribs.removeClass('kv-hide');
                self.$buttons1.addClass('kv-hide');
                self.$buttons2.removeClass('kv-hide');
            }
            else {
                self.$attribs.removeClass('kv-hide');
                self.$formAttribs.addClass('kv-hide');
                self.$buttons1.removeClass('kv-hide');
                self.$buttons2.addClass('kv-hide');
            }
            self.initElements();
        },
        initElements: function () {
            var self = this;
            self.$btnUpdate = self.$element.find('.kv-btn-update');
            self.$btnDelete = self.$element.find('.kv-btn-delete');
            self.$btnView = self.$element.find('.kv-btn-view');
            self.$attribs = self.$element.find('.kv-attribute');
            self.$formAttribs = self.$element.find('.kv-form-attribute');
            self.$buttons1 = self.$element.find('.kv-buttons-1');
            self.$buttons2 = self.$element.find('.kv-buttons-2');
        }
    };

    //Detail View plugin definition
    $.fn.kvDetailView = function (option) {
        var args = Array.apply(null, arguments);
        args.shift();
        return this.each(function () {
            var $this = $(this),
                data = $this.data('kvDetailView'),
                options = typeof option === 'object' && option;

            if (!data) {
                $this.data('kvDetailView', (data = new KvDetailView(this, $.extend({}, $.fn.kvDetailView.defaults, options, $(this).data()))));
            }

            if (typeof option === 'string') {
                data[option].apply(data, args);
            }
        });
    };
}(jQuery));