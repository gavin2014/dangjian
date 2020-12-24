define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'wis/study/index' + location.search,
                    add_url: 'wis/study/add',
                    edit_url: 'wis/study/edit',
                    del_url: 'wis/study/del',
                    multi_url: 'wis/study/multi',
                    table: 'cms_political_study',
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
                        // {field: 'id', title: __('Id')},
                        {
                            field: 'id', title: __('课程地址'), formatter: function (value, row, index) {
                                return '<a href="/cms/a/' + value + '" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-link"></i></a>';
                            }, operate: false
                        },


                        {field: 'cmsarchives.title', title: __('Activity_theme')},
                        {field: 'cmsarchives.publishtime_text', title: __('课程发布时间'), formatter: Table.api.formatter.time},
                        {field: 'content', title: __('Content'), visible: false,operate: false},
                        {field: 'study_files', title: __('Study_files'), visible: false},
                        // {field: 'admin_id', title: __('Admin_id')},
                        {field: 'user_type', title: __('User_type'), searchList: {"1":__('User_type 1'),"2":__('User_type 2'),"3":__('User_type 3'),"4":__('User_type 4'),"5":__('User_type 5')}, formatter: Table.api.formatter.normal},
                        {
                            field: 'operate',
                            width: "150px",
                            title: __('Operate'),
                            table: table,
                            events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: '查看成员记录',
                                    text: '查看成员记录',
                                    title: __('查看成员记录'),
                                    classname: 'btn btn-xs btn-warning btn-addtabs',
                                    icon: 'fa fa-folder-o',
                                    url: 'wis/activityrecord/add/notify_id/{ids}',
                                    callback: function (data) {
                                        Layer.alert("接收到回传数据：" + JSON.stringify(data), {title: "回传数据"});
                                    }
                                }
                            ],
                            formatter: Table.api.formatter.operate
                        }
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            $(document).on("click", ".btn-selected", function () {
                var temp = table.bootstrapTable('getSelections');
                console.log(temp);
                var subject_id = temp[0].id;
                var titletext = temp[0].cmsarchives.title;
                var user_type = temp[0].user_type;
                layer.msg("正在为"+Config.userTypeList[user_type]+"发送邮件",{offset:'200px',icon: 1});
                        var wait = layer.load();
                        Controller.api.chooseAjaxTOdata(subject_id,user_type,wait);
            });


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
            chooseAjaxTOdata: function (subject_id,ty,li) {
                $.ajax({
                    type: "POST",
                    url: "/admin/wis.study/sendToEmail",
                    contentType: 'application/x-www-form-urlencoded;charset=utf-8',
                    data: {
                        "subject_id": subject_id,
                        "type": ty,
                        "type_text":Config.userTypeList[ty]
                    },
                    dataType: "json",
                    success: function (data) {
                        layer.close(li);
                        if(data.code==1){
                            Toastr.success("成功发送"+data.data.successful+"人"+"<br>发送失败:"+data.data.fall+"人");
                            layer.close(layer.index);
                        }else {
                            Toastr.error(data.msg);
                            layer.close(layer.index);
                        }
                        console.log(data);
                    },
                    error: function (e) {
                        Toastr.error("发送失败");
                        layer.close(layer.index);
                    }
                });
            }
        }
    };
    return Controller;
});