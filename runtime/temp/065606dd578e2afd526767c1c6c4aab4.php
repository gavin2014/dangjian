<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:125:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/public/../application/index/view/cms/archives/post.html";i:1564411431;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/layout/default.html";i:1564977696;s:109:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/common/meta.html";i:1564334449;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/common/sidenav.html";i:1564376297;s:111:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/common/script.html";i:1562338656;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<?php if(isset($keywords)): ?>
<meta name="keywords" content="<?php echo $keywords; ?>">
<?php endif; if(isset($description)): ?>
<meta name="description" content="<?php echo $description; ?>">
<?php endif; ?>
<meta name="author" content="FastAdmin">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />

<link href="/assets/css/frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config: <?php echo json_encode($config); ?>
    };
</script>
        <link href="/assets/css/user.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
    </head>
    <style>
        .myhead{
            background-image: url(/bar.png);
            background-size:cover;
            padding-top: 100px;
        }
    </style>

    <body>

        <nav class="navbar navbar-inverse myhead" role="navigation" >
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo url('/'); ?>" style="padding:6px 15px;"><img src="/assets/img/logo.png" style="height:40px;" alt=""></a>

                </div>


                <div class="collapse navbar-collapse" id="header-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <?php if($user): ?>
                        <li><a href="<?php echo url('index/signin/index'); ?>"><i class="fa fa-map-signs fa-fw"></i> <?php echo __('每日签到'); ?></a></li>
                        <li><a href="<?php echo url('user/home'); ?>"><i class="fa fa-user-circle fa-fw"></i><?php echo __('User center'); ?></a></li>
                        <li><a href="<?php echo url('user/profile'); ?>"><i class="fa fa-user-o fa-fw"></i><?php echo __('Profile'); ?></a></li>
                        <li><a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-key fa-fw"></i><?php echo __('Change password'); ?></a></li>
                        <li><a href="<?php echo url('user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i><?php echo __('Sign out'); ?></a></li>
                        <?php else: ?>
                        <li><a href="<?php echo url('user/login'); ?>"><i class="fa fa-sign-in fa-fw"></i> <?php echo __('Sign in'); ?></a></li>
                        <li><a href="<?php echo url('user/register'); ?>"><i class="fa fa-user-o fa-fw"></i> <?php echo __('Sign up'); ?></a></li>
                        <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="content">
            <style>
    .panel-post {
        position: relative;
    }

    .btn-post {
        position: absolute;
        right: 0;
        bottom: 10px;
    }
    #post-form .panel-default {
        padding:0;
    }
</style>

<link rel="stylesheet" href="/assets/libs/bootstrap-select/dist/css/bootstrap-select.min.css">
<div class="container mt-20">
    <div id="content-container" class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="sidenav">
    <?php echo hook('user_sidenav_before'); ?>

        <ul class="list-group ">
        <li class="list-group-heading"><?php echo __('User center'); ?></li>
        <li class="list-group-item <?php echo $config['actionname']=='home'?'active':''; ?>"> <a href="<?php echo url('user/home'); ?>"><i class="fa fa-user-circle fa-fw"></i> <?php echo __('User center'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='profile'?'active':''; ?>"> <a href="<?php echo url('user/profile'); ?>"><i class="fa fa-user-o fa-fw"></i> <?php echo __('Profile'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='changepwd'?'active':''; ?>"> <a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-key fa-fw"></i> <?php echo __('Change password'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='logout'?'active':''; ?>"> <a href="<?php echo url('user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> <?php echo __('Sign out'); ?></a> </li>
    </ul>
    <?php echo hook('user_sidenav_after'); ?>
</div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default panel-user">
                    <div class="panel-body">
                        <?php if($archives && $archives['status']=='normal'): ?>
                        <div class="alert alert-danger">
                            <b>温馨提示：</b>当前<?php echo $model?$model['name']:'文章'; ?>已经发布,如果修改将重新进入审核
                        </div>
                        <?php endif; ?>
                        <div class="page-header panel-post">
                            <h2><?php echo $archives?'修改':'发布'; ?><?php echo $model?$model['name']:'文章'; ?></h2>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <form id="post-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">
                                    <?php echo token(); ?>
                                    <div class="form-group">
                                        <label for="c-channel_id" class="control-label col-xs-12 col-sm-2"><?php echo __('Channel_id'); ?>:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <select id="c-channel_id" data-rule="required" class="form-control" data-live-search="true" name="row[channel_id]">
                                                <?php echo $channelOptions; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-title" class="control-label col-xs-12 col-sm-2"><?php echo __('Title'); ?>:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-title" data-rule="required" class="form-control" name="row[title]" type="text" value="<?php echo htmlentities((isset($archives['title']) && ($archives['title'] !== '')?$archives['title']:'')); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="c-image" class="control-label col-xs-12 col-sm-2"><?php echo __('Image'); ?>:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <div class="input-group">
                                                <input id="c-image" class="form-control" size="50" name="row[image]" type="text" value="<?php echo htmlentities((isset($archives['image']) && ($archives['image'] !== '')?$archives['image']:'')); ?>">
                                                <div class="input-group-addon no-border no-padding">
                                                    <span><button type="button" id="plupload-image" class="btn btn-danger plupload" data-input-id="c-image" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-image"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                                                    <span class="msg-box n-right" for="c-image"></span>
                                                </div>
                                            </div>
                                            <ul class="row list-inline plupload-preview" id="p-image"></ul>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-tags" class="control-label col-xs-12 col-sm-2"><?php echo __('Tags'); ?>:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-tags" data-rule="" class="form-control" placeholder="多个标签请使用半角逗号分隔" data-primary-key="name" data-multiple="true" name="row[tags]" type="text" value="<?php echo htmlentities((isset($archives['tags']) && ($archives['tags'] !== '')?$archives['tags']:'')); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-content" class="control-label col-xs-12 col-sm-2"><?php echo __('Content'); ?>:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <textarea id="c-content" data-rule="required" class="form-control editor" name="row[content]" rows="15"><?php echo htmlentities((isset($archives['content']) && ($archives['content'] !== '')?$archives['content']:'')); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-keywords" class="control-label col-xs-12 col-sm-2"><?php echo __('Keywords'); ?>:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <input id="c-keywords" data-rule="" class="form-control" name="row[keywords]" type="text" value="<?php echo htmlentities((isset($archives['keywords']) && ($archives['keywords'] !== '')?$archives['keywords']:'')); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c-description" class="control-label col-xs-12 col-sm-2"><?php echo __('Description'); ?>:</label>
                                        <div class="col-xs-12 col-sm-8">
                                            <textarea id="c-description" cols="60" rows="5" data-rule="" class="form-control" name="row[description]"><?php echo htmlentities((isset($archives['description']) && ($archives['description'] !== '')?$archives['description']:'')); ?></textarea>
                                        </div>
                                    </div>
                                    <div id="extend"></div>

                                    <div class="form-group normal-footer">
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
    </div>
</div>
        </main>

        <footer class="footer foot" style="clear:both ">
            <!-- FastAdmin是开源程序，建议在您的网站底部保留一个FastAdmin的链接 -->
            <p class="copyright">Copyright&nbsp;©&nbsp;2017-2019 Powered by <a href="https://www.likecy.cn" target="_blank">云中有鹿</a> <br/>All Rights Reserved <?php echo $site['name']; ?> <?php echo __('Copyrights'); ?> <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $site['beian']; ?></a></p>
        </footer>

        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>

    </body>
<style>
    .foot{
        background-color: ghostwhite !important;
        margin:0 auto;
        clear: both;
    }
</style>


</html>