<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:120:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/public/../application/index/view/user/profile.html";i:1564410711;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/layout/default.html";i:1564977696;s:109:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/common/meta.html";i:1564334449;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/common/sidenav.html";i:1564376297;s:111:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/common/script.html";i:1562338656;}*/ ?>
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
    .profile-avatar-container {
        position:relative;
        width:100px;
    }
    .profile-avatar-container .profile-user-img{
        width:100px;
        height:100px;
    }
    .profile-avatar-container .profile-avatar-text {
        display:none;
    }
    .profile-avatar-container:hover .profile-avatar-text {
        display:block;
        position:absolute;
        height:100px;
        width:100px;
        background:#444;
        opacity: .6;
        color: #fff;
        top:0;
        left:0;
        line-height: 100px;
        text-align: center;
    }
    .profile-avatar-container button{
        position:absolute;
        top:0;left:0;width:100px;height:100px;opacity: 0;
    }
</style>
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
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="page-header"><?php echo __('Profile'); ?></h2>
                    <form id="profile-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="<?php echo url('api/user/profile'); ?>">
                        <?php echo token(); ?>

                        <input type="hidden" name="avatar" id="c-avatar" value="<?php echo $user->getData('avatar'); ?>" />
                        <div class="form-group">
                            <label class="control-label col-xs-4 col-sm-4"></label>
                            <div class="col-xs-4 col-sm-6">
                                <div class="profile-avatar-container">
                                    <img class="profile-user-img img-responsive img-circle plupload" src="<?php echo cdnurl($user['avatar']); ?>" alt="">
                                    <div class="profile-avatar-text img-circle"><?php echo __('Click to edit'); ?></div>
                                    <button id="plupload-avatar" class="plupload" data-mimetype="png,jpg,jpeg,gif" data-input-id="c-avatar"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-xs-6 col-sm-2"><?php echo __('School_id'); ?>:</label>
                            <div class="col-xs-6 col-sm-8">
                                <span class="label label-info">
                                                <?php echo htmlentities($school_name); ?>
                                            </span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-xs-6 col-sm-2" for="c-group_id"><?php echo __('Group_id'); ?>:</label>
                            <div class="col-xs-6 col-sm-8">
                                <span class="label label-danger">
                                    <?php echo htmlentities($group_name); ?>
                                </span>
                             </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-6 col-sm-2"><?php echo __('Username'); ?>:</label>
                            <div class="col-xs-6 col-sm-8">
                                 <span class="label label-success">
                                            <?php echo $user['username']; ?>
                               </span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-xs-6 col-sm-2" for="c-group_id"><?php echo __('User_type'); ?>:</label>
                            <div class="col-xs-6 col-sm-8">
                               <span class="label label-success">
                                            <?php echo $userTypeList[$user['user_type']]; ?>
                               </span>

                            </div>
                        </div>





                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Nickname'); ?>:</label>
                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo htmlentities($user['nickname']); ?>" data-rule="required" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="c-email" class="control-label col-xs-12 col-sm-2"><?php echo __('Email'); ?>:</label>
                            <div class="col-xs-12 col-sm-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="c-email" name="email" value="<?php echo htmlentities($user['email']); ?>" disabled placeholder="">
                                    <span class="input-group-btn" style="padding:0;border:none;">
                                        <a href="javascript:;" class="btn btn-info btn-change" data-type="email"><?php echo __('Change'); ?></a>
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="c-mobile" class="control-label col-xs-12 col-sm-2"><?php echo __('Mobile'); ?>:</label>
                            <div class="col-xs-12 col-sm-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="c-mobile" name="mobile" value="<?php echo htmlentities($user['mobile']); ?>" disabled placeholder="">
                                    <span class="input-group-btn" style="padding:0;border:none;">
                                        <a href="javascript:;" class="btn btn-info btn-change" data-type="mobile"><?php echo __('Change'); ?></a>
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2"><?php echo __('Nation'); ?>:</label>
                            <div class="col-xs-12 col-sm-8">
                                <input class="form-control" id="c-nation" name="nation" type="text" value="<?php echo htmlentities($user['nation']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-2" for="c-gender"><?php echo __('Gender'); ?>:</label>
                            <div class="col-xs-12 col-sm-8">

                                <?php echo Form::radios('gender', ['0'=>'女', '1'=>'男'], $user['gender'], ['data-rule'=>'required']); ?>
                            </div>
                        </div>
<!--                        <div class="panel panel-default">-->
<!--                              <div class="panel-heading bg-danger">-->
<!--                                <h3 class="panel-title ">党建资料</h3>-->
<!--                              </div>-->
<!--                              <div class="panel-body">-->

                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('Id_card'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control" id="c-id_card" name="id_card" type="text" value="<?php echo htmlentities($user['id_card']); ?>">
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('Birth_place'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control" id="c-birth_place" name="birth_place" type="text" value="<?php echo htmlentities($user['birth_place']); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('Part_duty'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control" id="c-part_duty" name="part_duty" type="text" value="<?php echo htmlentities($user['part_duty']); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('Apply_time'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-use-current="true" id="c-apply_time" name="apply_time" type="text" value="<?php echo $user['apply_time']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('Active_time'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-use-current="true" id="c-active_time" name="active_time" type="text" value="<?php echo $user['active_time']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('Develop_time'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-use-current="true" id="c-develop_time" name="develop_time" type="text" value="<?php echo $user['develop_time']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('Official_time'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-use-current="true" id="c-join_time" name="official_time" type="text" value="<?php echo $user['official_time']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2"><?php echo __('Preparatory_time'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-use-current="true" id="c-preparatory_time" name="preparatory_time" type="text" value="<?php echo $user['preparatory_time']; ?>">
                                </div>
                            </div>





                        <div class="form-group">
                            <label for="c-bio" class="control-label col-xs-12 col-sm-2"><?php echo __('Intro'); ?>:</label>
                            <div class="col-xs-12 col-sm-8">
                                <input id="c-bio" data-rule="" data-tip="一句话介绍一下你自己" class="form-control" name="bio" type="text" value="<?php echo htmlentities($user['bio']); ?>">
                            </div>
                        </div>

                        <div class="form-group normal-footer">
                            <label class="control-label col-xs-12 col-sm-2"></label>
                            <div class="col-xs-12 col-sm-8">
                                <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('Ok'); ?></button>
                                <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/html" id="emailtpl">
    <form id="email-form" class="form-horizontal form-layer" method="POST" action="<?php echo url('api/user/changeemail'); ?>">
        <div class="form-body">
            <input type="hidden" name="action" value="changeemail" />
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3"><?php echo __('New Email'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                    <input type="text" class="form-control" id="email" name="email" value="" data-rule="required;email;remote(<?php echo url('api/validate/check_email_available'); ?>, event=changeemail, id=<?php echo $user['id']; ?>)" placeholder="<?php echo __('New email'); ?>">
                    <span class="msg-box"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3"><?php echo __('Captcha'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                    <div class="input-group">
                        <input type="text" name="captcha" id="email-captcha" class="form-control" data-rule="required;length(4);integer[+];remote(<?php echo url('api/validate/check_ems_correct'); ?>, event=changeemail, email:#email)" />
                        <span class="input-group-btn" style="padding:0;border:none;">
                            <a href="javascript:;" class="btn btn-info btn-captcha" data-url="<?php echo url('api/ems/send'); ?>" data-type="email" data-event="changeemail">获取验证码</a>
                        </span>
                    </div>
                    <span class="msg-box"></span>
                </div>
            </div>
        </div>
        <div class="form-footer">
            <div class="form-group" style="margin-bottom:0;">
                <label class="control-label col-xs-12 col-sm-3"></label>
                <div class="col-xs-12 col-sm-8">
                    <button type="submit" class="btn btn-md btn-info"><?php echo __('Submit'); ?></button>
                </div>
            </div>
        </div>
    </form>
</script>
<script type="text/html" id="mobiletpl">
    <form id="mobile-form" class="form-horizontal form-layer" method="POST" action="<?php echo url('api/user/changemobile'); ?>">
        <div class="form-body">
            <input type="hidden" name="action" value="changemobile" />
            <div class="form-group">
                <label for="c-mobile" class="control-label col-xs-12 col-sm-3"><?php echo __('New mobile'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                    <input type="text" class="form-control" id="mobile" name="mobile" value="" data-rule="required;mobile;remote(<?php echo url('api/validate/check_mobile_available'); ?>, event=changemobile, id=<?php echo $user['id']; ?>)" placeholder="<?php echo __('New mobile'); ?>">
                    <span class="msg-box"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="mobile-captcha" class="control-label col-xs-12 col-sm-3"><?php echo __('Captcha'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                    <div class="input-group">
                        <input type="text" name="captcha" id="mobile-captcha" class="form-control" data-rule="required;length(4);integer[+];remote(<?php echo url('api/validate/check_sms_correct'); ?>, event=changemobile, mobile:#mobile)" />
                        <span class="input-group-btn" style="padding:0;border:none;">
                            <a href="javascript:;" class="btn btn-info btn-captcha" data-url="<?php echo url('api/sms/send'); ?>" data-type="mobile" data-event="changemobile">获取验证码</a>
                        </span>
                    </div>
                    <span class="msg-box"></span>
                </div>
            </div>
        </div>
        <div class="form-footer">
            <div class="form-group" style="margin-bottom:0;">
                <label class="control-label col-xs-12 col-sm-3"></label>
                <div class="col-xs-12 col-sm-8">
                    <button type="submit" class="btn btn-md btn-info"><?php echo __('Submit'); ?></button>
                </div>
            </div>
        </div>
    </form>
</script>
<style>
    .form-layer {height:100%;min-height:150px;min-width:300px;}
    .form-body {
        width:100%;
        overflow:auto;
        top:0;
        position:absolute;
        z-index:10;
        bottom:50px;
        padding:15px;
    }
    .form-layer .form-footer {
        height:50px;
        line-height:50px;
        background-color: #ecf0f1;
        width:100%;
        position:absolute;
        z-index:200;
        bottom:0;
        margin:0;
    }
    .form-footer .form-group{
        margin-left:0;
        margin-right:0;
    }
</style>
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