define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'wis/activityrecord/index' +location.search,
                    add_url: 'wis/activityrecord/add',
                    edit_url: 'wis/activityrecord/edit',
                    del_url: 'wis/activityrecord/del',
                    multi_url: 'wis/activityrecord/multi',
                    table: 'dj_cms_notify',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                search:false,
                commonSearch: true,
                showToggle: false,
                exportTypes:['excel'],
                exportDataType: 'selected',
                searchFormVisible: true,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id'),formatter:Table.api.formatter.label},
                        // {field: 'admin_id', title: __('Admin_id')},
                        // {field: 'notify_id', title: __('Notify_id')},
                        {field: 'title', title: __('Wisactivitynotify.activity_theme'),formatter:Controller.api.readbutten,operate:false},
                        {field: 'wisactivitynotify.activity_time', title: __('Wisactivitynotify.activity_time'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'wisactivitynotify.activity_place', title: __('Wisactivitynotify.activity_place'),formatter:Controller.api.mybutten,operate:false},
                        {field: 'wisactivitynotify.activity_person', title: __('Wisactivitynotify.activity_person'),formatter:Table.api.formatter.label},
                        // {field: 'wisactivitynotify.activity_files', title: __('Wisactivitynotify.activity_files')},
                        {field: 'wisactivitynotify.read_list', title: __('Wisactivitynotify.read_list'),operate:false},
                        {field: 'wisactivitynotify.content', title: __('Wisactivitynotify.activity_note'),operate:false,visible: false},
                        {field: 'actice_images', title: __('Actice_images'), events: Table.api.events.image, formatter: Table.api.formatter.images,operate:false},
                        {field: 'actice_detail', title: __('Actice_detail'),operate:false,visible: false},
                        {field: 'actual_number', title: __('Actual_number'),operate:false},
                        {field: 'absent_number', title: __('Absent_number'),operate:false},
                        {field: 'createtime', title: __('Createtime'), operate:false, addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: __('Updatetime'), addclass:'datetimerange', formatter: Table.api.formatter.datetime,operate:false},


                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Form.api.bindevent($("form[role=form]"),function (data,ret) {
                Backend.api.closetabs();
            },function (data,ret) {
                Toastr.success("失败");
            });
        },
        edit: function () {
            // Controller.api.bindevent();
            Form.api.bindevent($("form[role=form]"),function (data,ret) {
                Backend.api.closetabs();
            },function (data,ret) {
                Toastr.success("失败");
            });
            // $("#submit").click(function () {
            //     Backend.api.closetabs();
            // })
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            },
            mybutten: function (value,row) {
               return '<a class="label label-info">' + value+'</a>';
    },
            greenbutten: function (value,row) {
                return '<a class="label label-success">' + value+'</a>';
            },
            readbutten: function (value,row) {
                return '<a class="label label-danger">' + value+'</a>';
            }
        }
    };
    return Controller;
});