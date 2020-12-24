define(['jquery', 'bootstrap', 'frontend', 'template', 'form'], function ($, undefined, Frontend, Template, Form) {
    var Controller = {
        index: function () {
            Form.api.bindevent($("form[role=form]"), function (data, ret) {
                Layer.alert(ret.msg, function () {
                    location.href = ret.url;
                });
                return false;
            });
        },
        edit: function () {
            Form.api.bindevent($("form[role=form]"), function (data, ret) {
                Layer.alert(ret.msg, function () {
                    location.href = ret.url ? ret.url : "/index/cms.diyform/mypost";
                });
                return false;
            });
        }

    };
    return Controller;
});