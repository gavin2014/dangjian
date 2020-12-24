define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'wis/activitynotify/index' + location.search,
                    add_url: 'wis/activitynotify/add',
                    edit_url: 'wis/activitynotify/edit',
                    del_url: 'wis/activitynotify/del',
                    multi_url: 'wis/activitynotify/multi',
                    table: 'wis_activitynotify',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                search: false,
                showToggle: false,
                exportTypes: ['excel'],
                exportDataType: 'selected',
                commonSearch: true,
                searchFormVisible: true,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id'), formatter: Table.api.formatter.label},

                        {
                            field: 'id', title: __('URL连接'), formatter: function (value, row, index) {
                                return '<a href="/cms/a/' + value + '" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-link"></i></a>';
                            }, operate: false
                        },
                        {field: 'cmsarchives.title', title: __('Activity_theme'), formatter: Table.api.formatter.label},

                        // {field: 'activity_theme', title: __('Activity_theme')},
                        {
                            field: 'activity_time',
                            title: __('Activity_time'),
                            operate: 'RANGE',
                            addclass: 'datetimerange'
                        },
                        {field: 'activity_place', title: __('Activity_place')},
                        {
                            field: 'activity_person',
                            title: __('Activity_person'),
                            operate: false,
                            formatter: Table.api.formatter.label
                        },
                        {
                            field: 'operate',
                            width: "150px",
                            title: __('Operate'),
                            table: table,
                            events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: '提交活动记录',
                                    text: '提交活动记录',
                                    title: __('提交活动记录'),
                                    classname: 'btn btn-xs btn-warning btn-addtabs',
                                    icon: 'fa fa-folder-o',
                                    url: 'wis/activityrecord/add/notify_id/{ids}',
                                    callback: function (data) {
                                        Layer.alert("接收到回传数据：" + JSON.stringify(data), {title: "回传数据"});
                                    }
                                },{
                                    name: '一键下载',
                                    text: '一键下载',
                                    title: __('一键下载'),
                                    classname: 'btn btn-xs btn-info btn-addtabs',
                                    icon: 'fa fa-calendar-check-o',
                                    url: 'wis/download/all?archives_id={ids}',
                                    callback: function (data) {
                                        Layer.alert("接收到回传数据：" + JSON.stringify(data), {title: "回传数据"});
                                    }
                                }
                            ],
                            formatter: Table.api.formatter.operate
                        },

                        {field: 'cmsarchives.haveread_list', title: __('Read_list'), width: "150px", class: 'colStyle', operate: false},
                        {
                            field: 'activity_note',
                            title: __('Activity_note'),
                            operate: false,
                            width: "300px",
                            visible: false
                        },
                        {
                            field: 'progress_state',
                            title: __('Status'),
                            searchList: {"normal": __('Normal'), "hidden": __('Hidden')},
                            formatter: Table.api.formatter.normal
                        },

                        // {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        // {field: 'updatetime', title: __('Updatetime'), operate:false, addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        // {field: 'progress_state', title: __('Status'), searchList: {"normal":__('Normal'),"hidden":__('Hidden')}, formatter: Table.api.formatter.status},
                        // {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate},
                        //操作栏,默认有编辑、删除或排序按钮,可自定义配置buttons来扩展按钮

                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            //触发选项卡到进行中
            $("#jump-t-normal").click();
            // 获取选中项
            $(document).on("click", ".btn-selected", function () {
                var temp = table.bootstrapTable('getSelections');
                var subject_id = temp[0].id;
                var titletext = temp[0].cmsarchives.title;
                var time = temp[0].activity_time;
                layer.open({
                    skin: 'demo-class',
                    title:'发送邮件通知',
                    content: titletext+"<br>----------"+time,
                    btnAlign: 'c',
                    closeBtn: 1,
                    anim: 3,
                    // area: ['600px', '200px'],
                    btn: ['入党申请人','入党积极分子','发展对象', '预备党员','党员'] //可以无限个按钮
                    , btn1: function (index, layero) {
                        layer.msg("正在为入党申请人发送邮件",{offset:'200px',icon: 1});
                        var wait = layer.load();
                        Controller.api.chooseAjaxTOdata(subject_id,"1",wait);
                        return false;
                    }
                    , btn2: function (index, layero) {
                        layer.msg("正在为入党积极分子发送邮件",{offset:'200px',icon: 1});
                        var wait = layer.load();
                        Controller.api.chooseAjaxTOdata(subject_id,"2",wait);
                        return false;
                        //return false 开启该代码可禁止点击该按钮关闭
                    }
                    , btn3: function (index, layero) {
                        layer.msg("正在为发展对象发送邮件",{offset:'200px',icon: 1});
                        var wait = layer.load();
                        Controller.api.chooseAjaxTOdata(subject_id,"3",wait);
                        return false;
                        //return false 开启该代码可禁止点击该按钮关闭
                    }
                    , btn4: function (index, layero) {
                        layer.msg("正在为预备党员发送邮件",{offset:'200px',icon: 1});
                        var wait = layer.load();
                        Controller.api.chooseAjaxTOdata(subject_id,"4",wait);
                        return false;
                        //return false 开启该代码可禁止点击该按钮关闭
                    }
                    , btn5: function (index, layero) {
                        layer.msg("正在为党员发送邮件",{offset:'200px',icon: 1});
                        var wait = layer.load();
                        Controller.api.chooseAjaxTOdata(subject_id,"5",wait);
                        return false //开启该代码可禁止点击该按钮关闭
                    }
                    , cancel: function () {
                        //右上角关闭回调
                        // return false //开启该代码可禁止点击该按钮关闭
                    }
                });
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
                    url: "/admin/wis.Activitynotify/sendToEmail",
                    contentType: 'application/x-www-form-urlencoded;charset=utf-8',
                    data: {
                        "subject_id": subject_id,
                        "type": ty
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