<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:124:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/public/../application/admin/view/cms/diyform/edit.html";i:1565017584;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/admin/view/layout/default.html";i:1564308282;s:109:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/admin/view/common/meta.html";i:1562338656;s:111:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/admin/view/common/script.html";i:1562338656;}*/ ?>
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

    <div class="form-group">
        <label for="c-name" class="control-label col-xs-12 col-sm-2"><?php echo __('Name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-name" data-rule="required" class="form-control" name="row[name]" type="text" value="<?php echo htmlentities($row['name']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-title" class="control-label col-xs-12 col-sm-2"><?php echo __('Title'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-title" data-rule="required" class="form-control" name="row[title]" type="text" value="<?php echo htmlentities($row['title']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-table" class="control-label col-xs-12 col-sm-2"><?php echo __('Table'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-table" data-rule="required" class="form-control" name="row[table]" readonly="" type="text" value="<?php echo $row['table']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-diyname" class="control-label col-xs-12 col-sm-2"><?php echo __('Diyname'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-diyname"  class="form-control" name="row[diyname]" type="text" value="<?php echo htmlentities($row['diyname']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-keywords" class="control-label col-xs-12 col-sm-2"><?php echo __('Keywords'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-keywords" data-rule="" class="form-control" name="row[keywords]" type="text" value="<?php echo htmlentities($row['keywords']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-description" class="control-label col-xs-12 col-sm-2"><?php echo __('Description'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-description" cols="60" rows="5" data-rule="" class="form-control" name="row[description]"><?php echo htmlentities($row['description']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="c-successtips" class="control-label col-xs-12 col-sm-2"><?php echo __('Successtips'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-successtips" cols="60" rows="5" data-rule="" class="form-control" name="row[successtips]"><?php echo htmlentities($row['successtips']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="c-redirecturl" class="control-label col-xs-12 col-sm-2"><?php echo __('Redirecturl'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-redirecturl" data-rule="" class="form-control" name="row[redirecturl]" placeholder="<?php echo __('Redirecturl tips'); ?>" type="text" value="<?php echo htmlentities($row['redirecturl']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-formtpl" class="control-label col-xs-12 col-sm-2"><?php echo __('Formtpl'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-formtpl" data-rule="required" class="form-control selectpage" name="row[formtpl]" data-source="cms/ajax/get_template_list" data-params='{"type":"diyform"}' data-primary-key="name" data-field="name" type="text" placeholder="自定义模板文件必须以diyform开头" value="<?php echo $row['formtpl']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Needlogin'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-iscontribute" name="row[needlogin]" type="hidden" value="<?php echo $row['needlogin']; ?>">
            <a href="javascript:;" data-toggle="switcher" class="btn-switcher" data-input-id="c-needlogin" data-yes="1" data-no="0">
                <i class="fa fa-toggle-on text-success <?php if($row['needlogin'] == '0'): ?>fa-flip-horizontal text-gray<?php endif; ?> fa-2x"></i>
            </a>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">

            <div class="radio">
                <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
                <label for="row[status]-<?php echo $key; ?>"><input id="row[status]-<?php echo $key; ?>" name="row[status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['status'])?$row['status']:explode(',',$row['status']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label>
                <?php endforeach; endif; else: echo "" ;endif; ?>
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