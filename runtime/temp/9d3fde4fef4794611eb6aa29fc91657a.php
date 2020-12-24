<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:124:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/public/../application/index/view/cms/diyform/edit.html";i:1565066038;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/layout/default.html";i:1564977696;s:109:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/common/meta.html";i:1564334449;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/common/sidenav.html";i:1564376297;s:111:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/common/script.html";i:1562338656;}*/ ?>
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

    .img-border {
        border-radius: 3px;
        box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05);
    }
</style>
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
                        <div class="page-header panel-post">
                            <h2><?php echo $row['title']; ?></h2>
                        </div>

                        <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">
                            <input type="hidden" name="row[id]" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="row[admin_id]" value="<?php echo $row['admin_id']; ?>">
                            <input type="hidden" name="row[archives_id]" value="<?php echo $row['archives_id']; ?>">
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('心得体会'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">

                                    <div class="input-group">
                                        <input id="c-experience_files" class="form-control hidden " size="50" name="row[experience_files]" type="text" value="<?php echo htmlentities($row['experience_files']); ?>">
                                        <div class="input-group-addon no-border no-padding">
                                            <span><button type="button" id="plupload-experience_files" class="btn btn-danger plupload" data-input-id="c-experience_files" data-multiple="true" data-preview-id="p-experience_files"><i class="fa fa-upload"></i> <?php echo __('点击选择文件'); ?></button></span>
                                        </div>
                                        <span class="msg-box n-right" for="c-experience_files"></span>
                                    </div>

                                    <ul class="row list-inline plupload-preview" id="p-experience_files">
                                    </ul>
                                    <label class="text-danger"><?php echo $row['filename']; ?></label>
                                </div>
                            </div>
                            <div class="form-group layer-footer">
                                <label class="control-label col-xs-12 col-sm-2"></label>
                                <div class="col-xs-12 col-sm-8">
                                    <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
                                </div>
                            </div>
                        </form>

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