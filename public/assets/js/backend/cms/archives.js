define(['jquery', 'bootstrap', 'backend', 'table', 'form', 'template'], function ($, undefined, Backend, Table, Form, Template) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'cms/archives/index',
                    add_url: 'cms/archives/add',
                    edit_url: 'cms/archives/edit',
                    del_url: 'cms/archives/del',
                    multi_url: 'cms/archives/multi',
                    dragsort_url: '',
                    table: 'archives',
                }
            });

            var table = $("#table");

            //在表格内容渲染完成后回调的事件
            table.on('post-body.bs.table', function (e, settings, json, xhr) {
                //当为新选项卡中打开时
                if (Config.cms.archiveseditmode == 'addtabs') {
                    $(".btn-editone", this)
                        .off("click")
                        .removeClass("btn-editone")
                        .addClass("btn-addtabs")
                        .prop("title", __('Edit'));
                }
            });
            //当双击单元格时
            table.on('dbl-click-row.bs.table', function (e, row, element, field) {
                $(".btn-addtabs", element).trigger("click");
            });

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'weigh DESC,id DESC',
                searchFormVisible: Fast.api.query("model_id") ? true : false,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id'), sortable: true},
                        {
                            field: 'channel.name',
                            title: __('Channel'),
                            operate: false,
                            visible: false,
                            formatter: function (value, row, index) {
                                return '<a href="javascript:;" class="searchit" data-field="channel_id" data-value="' + row.channel_id + '">' + value + '</a>';
                            }
                        },
                        // {
                        //     field: 'model_id', title: __('Model'), visible: false, align: 'left', addclass: "selectpage", extend: "data-source='cms/modelx/index' data-field='name'"
                        // },
                        {
                            field: 'title', title: __('Title'), align: 'left', formatter: function (value, row, index) {
                                return '<div class=""><a href="' + row.url + '" target="_blank"><span style="color:' + (row.style_color ? row.style_color : 'inherit') + ';font-weight:' + (row.style_bold ? 'bold' : 'normal') + '">' + value + '</span></a></div>' + Table.api.formatter.flag.call(this, row['flag'], row, index);
                            }
                        },
                        {field: 'flag', title: __('Flag'), operate: '=', visible: false, searchList: Config.flagList, formatter: Table.api.formatter.flag},
                        {field: 'image', title: __('Image'), operate: false, events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'views', title: __('Views'), operate: 'BETWEEN', sortable: true},
                        {field: 'comments', title: __('Comments'), operate: 'BETWEEN', sortable: true},
                        {field: 'weigh', title: __('Weigh'), operate: false, sortable: true},

                        {
                            field: 'createtime',
                            title: __('Createtime'),
                            visible: false,
                            operate: 'RANGE',
                            addclass: 'datetimerange',
                            formatter: Table.api.formatter.datetime
                        },
                        {
                            field: 'updatetime',
                            title: __('Updatetime'),
                            sortable: true,
                            operate: 'RANGE',
                            addclass: 'datetimerange',
                            formatter: Table.api.formatter.datetime
                        },
                        {field: 'status', title: __('Status'), searchList: {"normal": __('Status normal'), "hidden": __('Status hidden'), "rejected": __('Status rejected'), "pulloff": __('Status pulloff')}, formatter: Table.api.formatter.status},
                        {
                            field: 'operate',
                            width: "300px",
                            title: __('Operate'),
                            table: table,
                            classname:'btn-group-vertical',
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
                                },
                                {
                                    name: '心得体会',
                                    text: '心得体会',
                                    title: __('查看心得体会'),
                                    classname: 'btn btn-xs btn-info btn-addtabs',
                                    icon: 'fa fa-calendar-check-o',
                                    url: 'wis/studyrecords/index/archives_id/{ids}',
                                    callback: function (data) {
                                        Layer.alert("接收到回传数据：" + JSON.stringify(data), {title: "回传数据"});
                                    }
                                }
                                // {
                                //     name: '一键下载',
                                //     text: '一键下载',
                                //     title: __('一键下载'),
                                //     classname: 'btn btn-xs btn-info btn-addtabs',
                                //     icon: 'fa fa-calendar-check-o',
                                //     url: 'wis/download/all?archives_id={ids}',
                                //     callback: function (data) {
                                //         Layer.alert("接收到回传数据：" + JSON.stringify(data), {title: "回传数据"});
                                //     }
                                // }
                            ],
                            formatter: Table.api.formatter.operate
                        }
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            //当为新选项卡中打开时
            if (Config.cms.archiveseditmode == 'addtabs') {
                $(".btn-add").off("click").on("click", function () {
                    Fast.api.addtabs('cms/archives/add', __('Add'));
                    return false;
                });
            }

            $(document).on("click", "a.btn-channel", function () {
                $("#archivespanel").toggleClass("col-md-9", $("#channelbar").hasClass("hidden"));
                $("#channelbar").toggleClass("hidden");
            });

            require(['jstree'], function () {
                //全选和展开
                $(document).on("click", "#checkall", function () {
                    $("#channeltree").jstree($(this).prop("checked") ? "check_all" : "uncheck_all");
                });
                $(document).on("click", "#expandall", function () {
                    $("#channeltree").jstree($(this).prop("checked") ? "open_all" : "close_all");
                });
                $('#channeltree').on("changed.jstree", function (e, data) {
                    $(".commonsearch-table input[name=channel_id]").val(data.selected.join(","));
                    table.bootstrapTable('refresh', {});
                    return false;
                });
                $('#channeltree').jstree({
                    "themes": {
                        "stripes": true
                    },
                    "checkbox": {
                        "keep_selected_style": false,
                    },
                    "types": {
                        "channel": {
                            "icon": "fa fa-th",
                        },
                        "list": {
                            "icon": "fa fa-list",
                        },
                        "link": {
                            "icon": "fa fa-link",
                        },
                        "disabled": {
                            "check_node": false,
                            "uncheck_node": false
                        }
                    },
                    'plugins': ["types", "checkbox"],
                    "core": {
                        "multiple": true,
                        'check_callback': true,
                        "data": Config.channelList
                    }
                });
            });

            $(document).on('click', '.btn-move', function () {
                var ids = Table.api.selectedids(table);
                Layer.open({
                    title: __('Move'),
                    content: Template("channeltpl", {}),
                    btn: [__('Move')],
                    yes: function (index, layero) {
                        var channel_id = $("select[name='channel']", layero).val();
                        if (channel_id == 0) {
                            Toastr.error(__('Please select channel'));
                            return;
                        }
                        Fast.api.ajax({
                            url: "cms/archives/move/ids/" + ids.join(","),
                            type: "post",
                            data: {channel_id: channel_id},
                        }, function () {
                            table.bootstrapTable('refresh', {});
                            Layer.close(index);
                        });
                    },
                    success: function (layero, index) {
                    }
                });
            });

            // 获取选中项
            $(document).on("click", ".btn-selected", function () {
                var temp = table.bootstrapTable('getSelections');
                var subject_id = temp[0].id;
                var titletext = temp[0].title;
                var time = Controller.api.formatDateTime(temp[0].createtime);
                layer.open({
                    skin: 'demo-class',
                    title:'选择发送对象',
                    content:'通知标题：<h1 class="text-danger">'+ titletext+"</h1><br>----------"+time,
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
        content: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'cms/archives/content/model_id/' + Config.model_id,
                    add_url: '',
                    edit_url: 'cms/archives/edit',
                    del_url: 'cms/archives/del',
                    multi_url: '',
                    table: '',
                }
            });

            var table = $("#table");
            //在表格内容渲染完成后回调的事件
            table.on('post-body.bs.table', function (e, settings, json, xhr) {
                $(".btn-editone", this)
                    .off("click")
                    .removeClass("btn-editone")
                    .addClass("btn-addtabs")
                    .prop("title", __('Edit'));
            });
            //默认字段
            var columns = [
                {checkbox: true},
                //这里因为涉及到关联多个表,因为用了两个字段来操作,一个隐藏,一个搜索
                {field: 'main.id', title: __('Id'), visible: false},
                {field: 'id', title: __('Id'), operate: false},
                {field: 'title', title: __('Title'), operate: 'like'},
                {
                    field: 'channel_id',
                    title: __('Channel_id'),
                    addclass: 'selectpage',
                    extend: 'data-source="cms/channel/index"',
                    formatter: Table.api.formatter.search
                },
                {field: 'channel_name', title: __('Channel_name'), operate: false}
            ];
            //动态追加字段
            $.each(Config.fields, function (i, j) {
                var data = {field: j.field, title: j.title, operate: 'like'};
                //如果是图片,加上formatter
                if (j.type == 'image') {
                    data.events = Table.api.events.image;
                    data.formatter = Table.api.formatter.image;
                } else if (j.type == 'images') {
                    data.events = Table.api.events.image;
                    data.formatter = Table.api.formatter.images;
                } else if (j.type == 'radio' || j.type == 'checkbox' || j.type == 'select' || j.type == 'selects') {
                    data.formatter = Controller.api.formatter.content;
                    data.extend = j.content;
                    data.searchList = j.content;
                }
                columns.push(data);
            });
            //追加操作字段
            columns.push({
                field: 'operate',
                title: __('Operate'),
                table: table,
                events: Table.api.events.operate,
                formatter: Table.api.formatter.operate
            });

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: columns
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        diyform: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'cms/archives/diyform/diyform_id/' + Config.diyform_id,
                    add_url: '',
                    edit_url: 'cms/archives/edit',
                    del_url: 'cms/archives/del',
                    multi_url: '',
                    table: '',
                }
            });

            var table = $("#table");
            //在表格内容渲染完成后回调的事件
            table.on('post-body.bs.table', function (e, settings, json, xhr) {
                $(".btn-editone", this)
                    .off("click")
                    .removeClass("btn-editone")
                    .addClass("btn-addtabs")
                    .prop("title", __('Edit'));
            });
            //默认字段
            var columns = [
                {checkbox: true},
                {field: 'id', title: __('Id'), operate: false},
            ];
            //动态追加字段
            $.each(Config.fields, function (i, j) {
                var data = {field: j.field, title: j.title, operate: 'like'};
                //如果是图片,加上formatter
                if (j.type == 'image') {
                    data.formatter = Table.api.formatter.image;
                } else if (j.type == 'images') {
                    data.formatter = Table.api.formatter.images;
                } else if (j.type == 'radio' || j.type == 'check' || j.type == 'select' || j.type == 'selects') {
                    data.formatter = Controller.api.formatter.content;
                    data.extend = j.content;
                }
                columns.push(data);
            });
            //追加操作字段
            columns.push({
                field: 'operate',
                title: __('Operate'),
                table: table,
                events: Table.api.events.operate,
                formatter: Table.api.formatter.operate
            });

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: columns
            })
            ;

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        recyclebin: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    'dragsort_url': ''
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: 'cms/archives/recyclebin',
                pk: 'id',
                sortName: 'weigh',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'title', title: __('Title'), align: 'left'},
                        {field: 'image', title: __('Image'), operate: false, formatter: Table.api.formatter.image},
                        {
                            field: 'deletetime',
                            title: __('Deletetime'),
                            operate: 'RANGE',
                            addclass: 'datetimerange',
                            formatter: Table.api.formatter.datetime
                        },
                        {
                            field: 'operate',
                            width: '130px',
                            title: __('Operate'),
                            table: table,
                            events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'Restore',
                                    text: __('Restore'),
                                    classname: 'btn btn-xs btn-info btn-restoreit',
                                    icon: 'fa fa-rotate-left',
                                    url: 'cms/archives/restore'
                                },
                                {
                                    name: 'Destroy',
                                    text: __('Destroy'),
                                    classname: 'btn btn-xs btn-danger btn-destroyit',
                                    icon: 'fa fa-times',
                                    url: 'cms/archives/destroy'
                                }
                            ],
                            formatter: Table.api.formatter.operate
                        }
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);

            $(document).on('click', '.btn-destroyall', function () {
                var that = this;
                Layer.confirm(__('Are you sure you want to truncate?'), function () {
                    Fast.api.ajax($(that).attr("href"), function () {
                        Layer.closeAll();
                        table.bootstrapTable('refresh');
                    }, function () {
                        Layer.closeAll();
                    });
                });
                return false;
            });
            $(document).on('click', '.btn-restoreall,.btn-restoreit,.btn-destroyit', function () {
                Fast.api.ajax($(this).attr("href"), function () {
                    table.bootstrapTable('refresh');
                });
                return false;
            });

            $(document).on("click", ".btn-selected", function () {
                var temp = table.bootstrapTable('getSelections');
                var subject_id = temp[0].id;
                var titletext = temp[0].title;
                var time = temp[0].deletetime;
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
            var last_channel_id = localStorage.getItem('last_channel_id');
            if (last_channel_id) {
                $("#c-channel_id option[value='" + last_channel_id + "']").prop("selected", true);
            }
            Controller.api.bindevent();
            $("#c-channel_id").trigger("change");
        },
        addnotify: function () {
            var last_channel_id = Config.channel_name_id;
            if (last_channel_id) {
                $("#c-channel_id option[value='" + last_channel_id + "']").prop("selected", true);
            }
            Controller.api.bindevent();
            $("#c-channel_id").trigger("change");
        },

        addstudy: function () {
            var study_id = Config.study_id;
            if (study_id) {
                $("#c-channel_id option[value='" + study_id + "']").prop("selected", true);
            }
            Controller.api.bindevent();
            $("#c-channel_id").trigger("change");
        },
        edit: function () {
            Controller.api.bindevent();
            $("#c-channel_id").trigger("change");
            $(function(){
                console.log(Config.activity_type);
                $("#c-user_type option[value='" + Config.user_type + "']").prop("selected", true);
                $("#c-activity_type option[value='" + Config.activity_type + "']").prop("selected", true);
            });

        },
        api: {
            formatter: {
                content: function (value, row, index) {
                    var extend = this.extend;
                    if (!value) {
                        return '';
                    }
                    var valueArr = value.toString().split(/,/);
                    var result = [];
                    $.each(valueArr, function (i, j) {
                        result.push(typeof extend[j] !== 'undefined' ? extend[j] : j);
                    });
                    return result.join(',');
                }
            },

           formatDateTime :function (inputTime) {
               var newDate = new Date();
               newDate.setTime(inputTime * 1000);
                return newDate.toLocaleString();
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
            },
            bindevent: function () {
                var refreshStyle = function () {
                    var style = [];
                    if ($(".btn-bold").hasClass("active")) {
                        style.push("b");
                    }
                    if ($(".btn-color").hasClass("active")) {
                        style.push($(".btn-color").data("color"));
                    }
                    $("input[name='row[style]']").val(style.join("|"));
                };
                require(['jquery-colorpicker'], function () {
                    $('.colorpicker').colorpicker({
                        color: function () {
                            var color = "#000000";
                            var rgb = $("#c-title").css('color').match(/^rgb\(((\d+),\s*(\d+),\s*(\d+))\)$/);
                            if (rgb) {
                                color = rgb[1];
                            }
                            return color;
                        }
                    }, function (event, obj) {
                        $("#c-title").css('color', '#' + obj.hex);
                        $(event).addClass("active").data("color", '#' + obj.hex);
                        refreshStyle();
                    }, function (event) {
                        $("#c-title").css('color', 'inherit');
                        $(event).removeClass("active");
                        refreshStyle();
                    });
                });
                require(['jquery-tagsinput'], function () {
                    //标签输入
                    var elem = "#c-tags";
                    var tags = $(elem);
                    tags.tagsInput({
                        width: 'auto',
                        defaultText: '输入后回车确认',
                        minInputWidth: 110,
                        height: '36px',
                        placeholderColor: '#999',
                        onChange: function (row) {
                            if (typeof callback === 'function') {

                            } else {
                                $(elem + "_addTag").focus();
                                $(elem + "_tag").trigger("blur.autocomplete").focus();
                            }
                        },
                        autocomplete: {
                            url: 'cms/tags/autocomplete',
                            minChars: 1,
                            menuClass: 'autocomplete-tags'
                        }
                    });
                });

                $(document).on('click', '.btn-bold', function () {
                    $("#c-title").toggleClass("text-bold", !$(this).hasClass("active"));
                    $(this).toggleClass("text-bold active");
                    refreshStyle();
                });
                $(document).on('change', '#c-channel_id', function () {
                    var model = $("option:selected", this).attr("model");
                    Fast.api.ajax({
                        url: 'cms/archives/get_channel_fields',
                        data: {channel_id: $(this).val(), archives_id: $("#archive-id").val()}
                    }, function (data) {
                        if ($("#extend").data("model") != model) {
                            $("#extend").html(data.html).data("model", model);
                            Form.api.bindevent($("#extend"));
                        }
                        return false;
                    });
                    localStorage.setItem('last_channel_id', $(this).val());
                });
                $(document).on("fa.event.appendfieldlist", ".downloadlist", function (a) {
                    Form.events.plupload(this);
                    $(".fachoose", this).off("click");
                    Form.events.faselect(this);
                });
                $(document).on("click", ".btn-legal", function (a) {
                    Fast.api.ajax({
                        url: "cms/ajax/check_content_islegal",
                        data: {content: $("#c-content").val()}
                    }, function (data, ret) {

                    }, function (data, ret) {
                        if ($.isArray(data)) {
                            Layer.alert(__('Banned words') + "：" + data.join(","));
                        }
                    });
                });
                $(document).on("click", ".btn-keywords", function (a) {
                    Fast.api.ajax({
                        url: "cms/ajax/get_content_keywords",
                        data: {title: $("#c-title").val(), tags: $("#c-tags").val(), content: $("#c-content").val()}
                    }, function (data, ret) {
                        $("#c-keywords").val(data.keywords);
                        $("#c-description").val(data.description);
                    });
                });
                $.validator.config({
                    rules: {
                        diyname: function (element) {
                            if (element.value.toString().match(/^\d+$/)) {
                                return __('Can not be digital');
                            }
                            return $.ajax({
                                url: 'cms/archives/check_element_available',
                                type: 'POST',
                                data: {id: $("#archive-id").val(), name: element.name, value: element.value},
                                dataType: 'json'
                            });
                        }
                    }
                });
                Form.api.bindevent($("form[role=form]"), function () {
                    if (Config.cms.archiveseditmode == 'addtabs') {
                        var obj = top.window.$("ul.nav-addtabs li.active");
                        top.window.Toastr.success(__('Operation completed'));
                        top.window.$(".sidebar-menu a[url$='/cms/archives'][addtabs]").click();
                        top.window.$(".sidebar-menu a[url$='/cms/archives'][addtabs]").dblclick();
                        obj.find(".fa-remove").trigger("click");
                    }
                });
            }
        }
    };
    return Controller;
});