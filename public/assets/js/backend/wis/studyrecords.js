define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {





            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'wis/studyrecords/index' + location.search,
                    add_url: 'wis/studyrecords/add',
                    edit_url: 'wis/studyrecords/edit',
                    del_url: 'wis/studyrecords/del',
                    multi_url: 'wis/studyrecords/multi',
                    table: 'wis_study_record',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'archives_id', title: __('Study_id'),visible: false},
                        // {field: 'admin_id', title: __('Admin_id')},
                        // {field: 'user_id', title: __('User_id')},
                        {field: 'user.user_type', title: __('User.user_type'),width:"100px", searchList: {"1":__('User_type 1'),"2":__('User_type 2'),"3":__('User_type 3'),"4":__('User_type 4'),"5":__('User_type 5')}, formatter: Table.api.formatter.normal},
                        {field: 'user.nickname', title: __('User.nickname')},
                        {field: 'experience_files', title: __('Experience_files'),formatter:Table.api.formatter.url},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},

                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });




            // 为表格绑定事件
            Table.api.bindevent(table);

            if (Config.archives_id){
                // Config.archives_id =null
                var options = table.bootstrapTable('getOptions');

                options.pageNumber = 1;
                options.queryParams = function (params) {
                    var filter = {};
                    if (value !== '') {
                        filter['archives_id'] = Config.archives_id;
                    }
                    params.filter = JSON.stringify(filter);
                    return params;
                };
                table.bootstrapTable('refresh', {});
                return false;
            }

        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});