<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:130:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/public/../application/admin/view/cms/archives/addnotify.html";i:1565002468;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/admin/view/layout/default.html";i:1564308282;s:109:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/admin/view/common/meta.html";i:1562338656;s:111:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/admin/view/common/script.html";i:1562338656;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content ">
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">
    <input type="hidden" name="row[style]" value=""/>
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="panel panel-default panel-intro">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#basic" data-toggle="tab">添加活动通知</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-2"><?php echo __('活动类型'); ?>:</label>
                        <div class="col-xs-12 col-sm-8">
                            <select  id="c-activity_type" class="form-control selectpicker" name="row[activity_type]">
                                <?php if(is_array($activityTypeList) || $activityTypeList instanceof \think\Collection || $activityTypeList instanceof \think\Paginator): if( count($activityTypeList)==0 ) : echo "" ;else: foreach($activityTypeList as $key=>$vo): ?>
                                <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',""))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>

                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="basic">
                            <div class="form-group hidden">
                                <label for="c-channel_id" class="control-label col-xs-12 col-sm-2"><?php echo __('Channel_id'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <select id="c-channel_id" data-rule="required" class="form-control selectpicker" data-live-search="true" name="row[channel_id]">
                                        <?php echo $channelOptions; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label for="c-user_id" class="control-label col-xs-12 col-sm-2"><?php echo __('User_id'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input type="text" class="form-control selectpage" data-source="user/user/index" placeholder="发布会员,可为空" data-field="nickname" name="row[user_id]"/>
                                </div>
                            </div>
                            <div class="form-group hidden">
                                <label for="c-special_id" class="control-label col-xs-12 col-sm-2"><?php echo __('Special_id'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input type="text" class="form-control selectpage" data-source="cms/special/index" placeholder="所属专题,可为空" data-field="title" name="row[special_id]"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('User_type'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">

                                    <select  id="c-user_type" class="form-control selectpicker" name="row[user_type]">
                                        <?php if(is_array($userTypeList) || $userTypeList instanceof \think\Collection || $userTypeList instanceof \think\Paginator): if( count($userTypeList)==0 ) : echo "" ;else: foreach($userTypeList as $key=>$vo): ?>
                                        <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',""))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>

                                </div>
                            </div>



                            <div class="form-group">
                                <label  class="control-label col-xs-12 col-sm-2"><?php echo __('Is_user_record'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <?php echo Form::switcher('row[is_user_record]', '0', ['color'=>'danger']); ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="c-title" class="control-label col-xs-12 col-sm-2"><?php echo __('活动主题'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group">
                                        <input id="c-title" data-rule="required" class="form-control" name="row[title]" type="text" value="">
                                        <span class="input-group-btn">
                                        <button class="btn btn-default btn-bold" style="margin:0 1px;" type="button">粗</button>
                                        <button type="button" class="btn btn-default btn-color colorpicker" style="padding:0;margin-left:1px;" title="选择标题颜色"><img src="/assets/addons/cms/img/colorful.png" height="29" alt=""></button>
                                        <span class="msg-box n-right" for="c-title"></span>
                                    </span>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('学习资料文件'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group">
                                        <input id="c-experience_files" class="form-control hidden" size="50" name="row[activity_files]" type="text">
                                        <div class="input-group-addon no-border no-padding">
                                            <span><button type="button" id="plupload-experience_files" class="btn btn-danger plupload" data-input-id="c-experience_files" data-multiple="true" data-preview-id="p-experience_files"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                                            <!--                    <span><button type="button" id="fachoose-experience_files" class="btn btn-primary fachoose" data-input-id="c-experience_files" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>-->
                                        </div>
                                        <span class="msg-box n-right" for="c-experience_files"></span>
                                    </div>
                                    <ul class="row list-inline plupload-preview" id="p-experience_files"></ul>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="control-label col-xs-12 col-sm-2">主讲人</div>
                                <div class="col-xs-12 col-sm-8">
                                    <input type="text" name="row[activity_person]" id="c-activity_person" value="" class="form-control" data-rule="required" data-tip="请填写活动主讲人">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="control-label col-xs-12 col-sm-2">活动地点</div>
                                <div class="col-xs-12 col-sm-8">
                                    <input type="text" name="row[activity_place]" id="c-activity_place" value="" class="form-control" data-rule="required" data-tip="">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="control-label col-xs-12 col-sm-2">活动时间</div>
                                <div class="col-xs-12 col-sm-8" style="position: relative;">
                                    <input type="text" name="row[activity_time]" id="c-activity_time" value="" class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-tip="请输入活动时间" data-rule="date">
                                </div>
                            </div>




                            <div class="form-group">
                                <label for="c-image" class="control-label col-xs-12 col-sm-2"><?php echo __('Image'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group">
                                        <input id="c-image" class="form-control" size="50" name="row[image]" type="text" value="">
                                        <div class="input-group-addon no-border no-padding">
                                            <span><button type="button" id="plupload-image" class="btn btn-danger plupload" data-input-id="c-image" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-image"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                                            <span><button type="button" id="fachoose-image" class="btn btn-primary fachoose" data-input-id="c-image" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                                        </div>
                                        <span class="msg-box n-right" for="c-image"></span>
                                    </div>
                                    <ul class="row list-inline plupload-preview" id="p-image"></ul>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="c-tags" class="control-label col-xs-12 col-sm-2"><?php echo __('Tags'); ?>标签:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input id="c-tags" data-rule="" class="form-control" placeholder="请输入后回车或空格确认" name="row[tags]" type="text" value="">
                                </div>
                            </div>

                            <div class="form-group hidden">
                                <label for="c-diyname" class="control-label col-xs-12 col-sm-2"><?php echo __('Diyname'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php echo addon_url('cms/archives/index', [':diyname'=>'']); ?></button>
                                        </div>
                                        <input type="text" id="c-diyname" data-rule="diyname" name="row[diyname]" class="form-control" placeholder="请输入自定义的名称,为空将使用主键ID"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c-content" class="control-label col-xs-12 col-sm-2"><?php echo __('Content'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <textarea id="c-content" data-rule="required" class="form-control editor" name="row[content]" rows="15"></textarea>
                                    <div style="margin-top:5px;">
                                        <a href="javascript:" class="btn btn-xs btn-default btn-legal"><?php echo __('Check content is legal'); ?></a>
                                        <a href="javascript:" class="btn btn-xs btn-default btn-keywords"><?php echo __('Get the keyword and description'); ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c-keywords" class="control-label col-xs-12 col-sm-2"><?php echo __('Keywords'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input id="c-keywords" data-rule="" class="form-control" name="row[keywords]" type="text" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c-description" class="control-label col-xs-12 col-sm-2"><?php echo __('Description'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <textarea id="c-description" cols="60" rows="5" data-rule="" class="form-control" name="row[description]"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group layer-footer">
                        <label class="control-label col-xs-12 col-sm-2"></label>
                        <div class="col-xs-12 col-sm-8">
                            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
                            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-md-3 col-sm-12">
            <div class="panel panel-default panel-intro">
                <div class="panel-heading">
                    <div class="panel-lead"><em>相关信息</em></div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active in">
                            <div class="form-group">
                                <label for="c-views" class="control-label col-xs-12 col-sm-3"><?php echo __('Views'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group margin-bottom-sm">

                                        <input id="c-views" data-rule="required" class="form-control" name="row[views]" placeholder="<?php echo __('Views'); ?>" type="number" value="0">
                                        <span class="input-group-addon"><i class="fa fa-eye text-success"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c-comments" class="control-label col-xs-12 col-sm-3"><?php echo __('Comments'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group margin-bottom-sm">

                                        <input id="c-comments" data-rule="required" class="form-control" name="row[comments]" placeholder="<?php echo __('Comments'); ?>" type="number" value="0">
                                        <span class="input-group-addon"><i class="fa fa-comment text-info"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c-likes" class="control-label col-xs-12 col-sm-3"><?php echo __('Likes'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group margin-bottom-sm">

                                        <input id="c-likes" data-rule="required" class="form-control" name="row[likes]" placeholder="<?php echo __('Likes'); ?>" type="number" value="0">
                                        <span class="input-group-addon"><i class="fa fa-thumbs-up text-danger"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c-dislikes" class="control-label col-xs-12 col-sm-3"><?php echo __('Dislikes'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group margin-bottom-sm">
                                        <input id="c-dislikes" data-rule="required" class="form-control" name="row[dislikes]" placeholder="<?php echo __('Dislikes'); ?>" type="number" value="0">
                                        <span class="input-group-addon"><i class="fa fa-thumbs-down text-gray"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c-weigh" class="control-label col-xs-12 col-sm-3"><?php echo __('Weigh'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input id="c-weigh" data-rule="required" class="form-control" name="row[weigh]" placeholder="<?php echo __('Weigh'); ?>" type="number" value="0">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-intro">
                <div class="panel-heading">
                    <div class="panel-lead"><em>状态</em></div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active in">
                            <div class="form-group">
                                <label for="c-flag" class="control-label col-xs-12 col-sm-3"><?php echo __('Flag'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">

                                    <select id="c-flag" class="form-control selectpicker" multiple="" name="row[flag][]">
                                        <?php if(is_array($flagList) || $flagList instanceof \think\Collection || $flagList instanceof \think\Paginator): if( count($flagList)==0 ) : echo "" ;else: foreach($flagList as $key=>$vo): ?>
                                        <option value="<?php echo $key; ?>" {in name="key" value="" }selected{
                                        /in}><?php echo $vo; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3"><?php echo __('Status'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <select id="c-status" class="form-control selectpicker" name="row[status]">
                                        <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
                                        <option value="<?php echo $key; ?>" {in name="key" value="" }selected{
                                        /in}><?php echo $vo; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3"><?php echo __('Publish'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class='input-group date'>
                                        <input type='text' name="row[publishtime]" data-date-format="YYYY-MM-DD HH:mm:ss" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control datetimepicker"/>
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>