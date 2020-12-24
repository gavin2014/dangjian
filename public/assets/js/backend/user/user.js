define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'user/user/index',
                    add_url: 'user/user/add',
                    edit_url: 'user/user/edit',
                    del_url: 'user/user/del',
                    multi_url: 'user/user/multi',
                    table: 'user',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                exportTypes:['excel'],
                pk: 'id',
                search:false,
                showToggle: false,
                exportDataType: 'selected',
                sortName: 'user.id',
                columns: [
                    [
                        {checkbox: true},
                        // {field: 'id', title: __('Id'), sortable: true},
                        {field: 'school_id', title: __('School_id'),width:"100px",operate: false,formatter:Controller.api.namebutton},
                        {field: 'group.name', title: __('Group_id'),width:"100px",formatter:Controller.api.schoolbutton,operate: false},
                        {field: 'username', title: __('Username'), operate: 'LIKE'},
                        {field: 'nickname', title: __('Nickname'), operate: 'LIKE'},
                        {field: 'user_type', title: __('User_type'),width:"100px", searchList: {"1":__('User_type 1'),"2":__('User_type 2'),"3":__('User_type 3'),"4":__('User_type 4'),"5":__('User_type 5')}, formatter: Table.api.formatter.normal},
                        // {field: 'avatar', title: __('Avatar'), events: Table.api.events.image, formatter: Table.api.formatter.image, operate: false},
                        // {field: 'level', title: __('Level'), operate: 'BETWEEN', sortable: true},
                        {field: 'gender', title: __('Gender'), formatter: Table.api.formatter.normal,custom: {1: 'success', 0: 'blue'},searchList:{1: '男', 0: '女'},operate: false},
                        {field: 'email', title: __('Email'), operate: 'LIKE',operate: false},
                        {field: 'mobile', title: __('Mobile'), operate: 'LIKE',operate: false},
                        {field: 'birth_place', title: __('Birth_place'),width:"200px",operate: false},
                        // {field: 'birthday', title: __('Birthday'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'id_card', title: __('Id_card')},
                        {field: 'part_duty', title: __('Part_duty'),formatter:Table.api.formatter.label},
                        {field: 'nation', title: __('Nation')},
                        {field: 'apply_time', title: __('Apply_time'), operate:'RANGE', addclass:'datetimerange',formatter:Controller.api.yellowlabel},
                        {field: 'active_time', title: __('Active_time'), operate:'RANGE', addclass:'datetimerange',formatter:Controller.api.bluelabel},
                        {field: 'develop_time', title: __('Develop_time'), operate:'RANGE', addclass:'datetimerange' ,formatter:Controller.api.greenlabel},
                        {field: 'official_time', title: __('Official_time'), operate:'RANGE',addclass:'datetimerange' ,width:"100px",formatter:Controller.api.purplelabel},
                        {field: 'preparatory_time', title: __('Preparatory_time'), operate:'RANGE', addclass:'datetimerange',formatter:Controller.api.redlabel},
                        {field: 'score', title: __('Score'), operate: 'BETWEEN', sortable: true},
                        {field: 'successions', title: __('Successions'), visible: false, operate: false, sortable: true},
                        {field: 'maxsuccessions', title: __('Maxsuccessions'), visible: false, operate: false, sortable: true},
                        {field: 'logintime', title: __('Logintime'), formatter: Table.api.formatter.datetime, operate: false, addclass: 'datetimerange', sortable: true},
                        // {field: 'loginip', title: __('Loginip'), formatter: Table.api.formatter.search},
                        {field: 'jointime', title: __('Jointime'), formatter: Table.api.formatter.datetime, addclass: 'datetimerange', sortable: true,operate: false},
                        // {field: 'joinip', title: __('Joinip'), formatter: Table.api.formatter.search},
                        {field: 'status', title: __('Status'), formatter: Table.api.formatter.status, searchList: {normal: __('Normal'), hidden: __('Hidden')},operate: false},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
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
            },
            redlabel:function (value,row) {
                var html=[];
               var label = '<span class="label label-red text-red">' + value + '</span>';
               html.push(label);
                return html.join(' ');

            },
            greenlabel:function (value,row) {
                var html=[];
                var label = '<span class="label label-red text-green">' + value + '</span>';
                html.push(label);
                return html.join(' ');

            },
            bluelabel:function (value,row) {
                var html=[];
                var label = '<span class="label label-red text-blue">' + value + '</span>';
                html.push(label);
                return html.join(' ');

            },
            yellowlabel:function (value,row) {
                var html=[];
                var label = '<span class="label label-red text-yellow">' + value + '</span>';
                html.push(label);
                return html.join(' ');

            },
            purplelabel:function (value,row) {
                var html=[];
                var label = '<span class="label label-red text-purple">' + value + '</span>';
                html.push(label);
                return html.join(' ');

            },
            namebutton:function (value,row) {
                var html=[];
                var label = '<span class="label label-info">'+value+'</span';
                html.push(label);
                return html.join(' ');

            },
            schoolbutton:function (value,row) {
                var html=[];
                var label = '<span class="label label-success">'+value+'</span';
                html.push(label);
                return html.join(' ');

            },

        }
    };
    return Controller;
});