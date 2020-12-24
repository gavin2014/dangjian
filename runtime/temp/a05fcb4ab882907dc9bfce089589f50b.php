<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:82:"D:\workspace\php\dangjian\public/../application/admin\view\cms\archives\index.html";i:1565957032;s:68:"D:\workspace\php\dangjian\application\admin\view\layout\default.html";i:1565957032;s:65:"D:\workspace\php\dangjian\application\admin\view\common\meta.html";i:1565957032;s:67:"D:\workspace\php\dangjian\application\admin\view\common\script.html";i:1565957032;}*/ ?>
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
                                <style>
    .form-commonsearch .form-group {
        margin-left: 0;
        margin-right: 0;
        padding: 0;
    }

    form.form-commonsearch .control-label {
        padding-right: 0;
    }

    .tdtitle {
        margin-bottom: 5px;
        font-weight: 600;
    }

    #channeltree {
        margin-left: -6px;
    }

    #channelbar .panel-heading {
        height: 55px;
        line-height: 25px;
        font-size:14px;
    }

    @media (max-width: 1230px) {

        .fixed-table-toolbar .search .form-control {
            display: none;
        }
    }

    @media (min-width: 1200px) {

        #channelbar {
            width: 20%;
        }

        #archivespanel {
            width: 80%;
        }
    }

</style>
<div class="row">
    <div class="col-md-3 hidden-xs hidden-sm" id="channelbar" style="padding-right:0;">
        <div class="panel panel-default panel-intro">
            <div class="panel-heading">
                <div class="panel-lead">
                    <em><?php echo __('Channel list'); ?></em>
                </div>
            </div>
            <div class="panel-body">
                <span class="text-muted"><input type="checkbox" name="" id="checkall"/> <label for="checkall"><small><?php echo __('Check all'); ?></small></label></span>
                <span class="text-muted"><input type="checkbox" name="" id="expandall" checked=""/> <label for="expandall"><small><?php echo __('Expand all'); ?></small></label></span>
                <div id="channeltree">
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-9" id="archivespanel">
        <div class="panel panel-default panel-intro" style="background: #f1f4f6;padding-top: 0;padding-bottom: 0;box-shadow: none;">
            <div class="panel-heading">
                <?php echo build_heading(null,FALSE); ?>
                <ul class="nav nav-tabs" data-field="status">
                    <li class="active"><a href="#t-all" data-value="" data-toggle="tab"><?php echo __('All'); ?></a></li>
                    <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
                    <li><a href="#t-<?php echo $vo; ?>" data-value="<?php echo $key; ?>" data-toggle="tab"><?php echo $vo; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div id="myTabContent" class="tab-content" style="background:#fff;padding:15px;">
                <div class="tab-pane fade active in" id="one">
                    <div class="widget-body no-padding">
                        <div id="toolbar" class="toolbar">
                            <?php echo build_toolbar('refresh,add,del'); ?>

                            <a class="btn btn-info btn-move dropdown-toggle btn-disabled disabled"><i class="fa fa-arrow-right"></i> <?php echo __('Move'); ?></a>
                            <div class="dropdown btn-group <?php echo $auth->check('cms/archives/multi')?'':'hide'; ?>">
                                <a class="btn btn-primary btn-more dropdown-toggle btn-disabled disabled" data-toggle="dropdown"><i class="fa fa-cog"></i> <?php echo __('More'); ?></a>
                                <ul class="dropdown-menu text-left" role="menu">
                                    <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=normal"><i class="fa fa-eye"></i> <?php echo __('Set to normal'); ?></a></li>
                                    <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=hidden"><i class="fa fa-eye-slash"></i> <?php echo __('Set to hidden'); ?></a></li>
                                    <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=rejected"><i class="fa fa-exclamation-circle"></i> <?php echo __('Set to rejected'); ?></a></li>
                                    <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=pulloff"><i class="fa fa-arrow-circle-down"></i> <?php echo __('Set to pulloff'); ?></a></li>
                                </ul>
                            </div>
                            <a class="btn btn-success btn-recyclebin btn-dialog" href="cms/archives/recyclebin" title="<?php echo __('Recycle bin'); ?>"><i class="fa fa-recycle"></i> <?php echo __('Recycle bin'); ?></a>
                            <a class="btn btn-info btn-disabled disabled btn-selected" href="javascript:;"><i class="fa fa-leaf"></i>发送邮件通知</a>
                            <a class="btn btn btn-danger btn-addtabs" href="<?php echo url('/admin/wis/activityrecord'); ?>" title="查看所有记录"><i class="fa fa-file"></i> 查看活动记录</a>
                            <div class="dropdown btn-group <?php echo $auth->check('cms/archives/content')?'':'hide'; ?>">
<!--<a href="javascript:;" class="btn btn-info dropdown-toggle" title="<?php echo __('Addon list'); ?>" data-toggle="dropdown"><i class="fa fa-file"></i> <?php echo __('Addon list'); ?></a>-->
                                <ul class="dropdown-menu text-left" role="menu">
                                    <?php if(is_array($modelList) || $modelList instanceof \think\Collection || $modelList instanceof \think\Paginator): $i = 0; $__LIST__ = $modelList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                                    <li><a class="btn btn-link btn-addtabs" href="<?php echo url('cms.archives/content'); ?>/model_id/<?php echo $item['id']; ?>" title="<?php echo $item['name']; ?>"><i class="fa fa-file"></i> <?php echo $item['name']; ?></a></li>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>
                            <a href="javascript:;" class="btn btn-default btn-channel hidden-xs hidden-sm hidden-lg"><i class="fa fa-bars"></i></a>
                        </div>
                        <table id="table" class="table table-striped table-bordered table-hover"
                               data-operate-edit="<?php echo $auth->check('cms/archives/edit'); ?>"
                               data-operate-del="<?php echo $auth->check('cms/archives/del'); ?>"
                               width="100%">
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script id="channeltpl" type="text/html">
    <div class="box box-solid bg-red-gradient">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
            <?php echo __('Warning'); ?>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <?php echo __('Move tips'); ?>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-black">
            <div class="row">
                <div class="col-sm-12">
                    <select name="channel" class="form-control" id="">
                        <option value="0"><?php echo __('Please select channel'); ?></option>
                        <?php echo $channelOptions; ?>
                    </select>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>