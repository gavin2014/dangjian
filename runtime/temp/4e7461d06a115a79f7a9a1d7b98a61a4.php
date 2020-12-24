<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:131:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/public/../application/admin/view/wis/activityrecord/edit.html";i:1564545975;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/admin/view/layout/default.html";i:1564308282;s:109:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/admin/view/common/meta.html";i:1562338656;s:111:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/admin/view/common/script.html";i:1562338656;}*/ ?>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group ">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Notify_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-title" data-rule="required" data-field="title" disabled data-source="cms/archives/index" class="form-control selectpage" type="text" value="<?php echo $archives_id; ?>">
        </div>
    </div>



    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Actice_detail'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-actice_detail"  class="form-control editor" rows="5" name="row[actice_detail]" cols="100"><?php echo $row['actice_detail']; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Actice_images'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-actice_images" class="form-control" size="50" name="row[actice_images]" type="text" value="<?php echo htmlentities($row['actice_images']); ?>">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-actice_images" class="btn btn-danger plupload" data-input-id="c-actice_images" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-actice_images"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-actice_images" class="btn btn-primary fachoose" data-input-id="c-actice_images" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-actice_images"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-actice_images"></ul>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Actual_number'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-actual_number" class="form-control" disabled name="row[actual_number]" type="number" value="<?php echo htmlentities($row['actual_number']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Absent_number'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-absent_number" class="form-control" disabled name="row[absent_number]" type="number" value="<?php echo htmlentities($row['absent_number']); ?>">
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>

        <div class="col-xs-12 col-sm-8">
            <button type="submit" id="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
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