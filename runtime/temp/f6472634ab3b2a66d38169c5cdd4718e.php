<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:120:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/public/../application/index/view/signin/index.html";i:1564374360;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/layout/default.html";i:1564977696;s:109:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/common/meta.html";i:1564334449;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/common/sidenav.html";i:1564376297;s:111:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/application/index/view/common/script.html";i:1562338656;}*/ ?>
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
    .calendar {
        color: #444;
        width: 100%;
        table-layout: fixed;
    }

    .calendar-title th {
        font-size: 14px;
        font-weight: bold;
        padding: 15px;
        text-align: center;
        text-transform: uppercase;
    }

    .calendar-header th {
        padding: 10px;
        text-align: center;
    }

    .calendar-title th {
        font-weight: normal;
    }

    .calendar-title th span {
        margin: 0 5px;
        color: #666;
    }

    .calendar-title th a {
        margin: 0 5px;
        color: #666;
    }

    .calendar tbody tr td {
        text-align: center;
        vertical-align: middle;
        width: 14.28%;
        height: 60px;
        line-height: 30px;
    }

    .calendar tbody tr td.pad {
        background: rgba(255, 255, 255, 0.1);
    }

    .calendar tbody tr td.day {
    }

    .calendar tbody tr td.day div:first-child {
        display: block;
        width: 30px;
        margin: 0 auto;
        cursor: pointer;
    }

    .calendar tbody tr td.signed div:first-child {
        background: #f7b82e;
        color: #fff;
        border-radius: 30px;
    }

    .calendar tbody tr td.today {
        background: rgba(0, 0, 0, 0.1);
    }

    .signin-rank-table > tbody > tr > td {
        vertical-align: middle;
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
            <div class="panel panel-default panel-page">
                <div class="panel-heading">
                    <h2>我的签到
                        <a class="btn btn-success pull-right btn-signin <?php echo $signin?'disabled':''; ?>" href="javascript:;">
                            <i class="fa fa-location-arrow"></i> <span><?php echo $signin?'已签到':'签到'; ?></span>
                        </a>

                        <a href="javascript:;" class="btn btn-default pull-right btn-rule" style="margin-right:5px;">
                            <i class="fa fa-question-circle"></i>
                            签到积分规则
                        </a>

                        <a href="javascript:;" class="btn btn-default pull-right btn-rank" style="margin-right:5px;">
                            <i class="fa fa-trophy"></i>
                            排行榜
                        </a>
                    </h2>
                </div>
                <div class="panel-body" style="padding:0;">
                    <div class="alert alert-warning-light">
                        <?php if($signin): ?>
                        你当前已经连续签到 <b><?php echo $successions; ?></b> 天，明天继续签到可获得 <b><?php echo $score; ?></b> 积分
                        <?php else: ?>
                        今天签到可获得 <b><?php echo $score; ?></b> 积分，请点击签到领取积分
                        <?php endif; ?>
                    </div>
                    <div class="calendar calendar3"></div>
                    <?php echo $calendar->draw($date);; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/html" id="signintpl">
    <table class="table table-striped" style="margin-bottom:0;">
        <thead>
        <tr>
            <th>连续签到天数</th>
            <th>获得积分</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($signinscore) || $signinscore instanceof \think\Collection || $signinscore instanceof \think\Paginator): $i = 0; $__LIST__ = $signinscore;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
        <tr>
            <th scope="row">第<?php echo str_replace('s','',$key); ?>天</th>
            <td>+<?php echo $item; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
</script>

<script type="text/html" id="ranktpl">
    <div style="padding:20px;min-height:300px;">
        <table class="table table-striped table-hover signin-rank-table">
            <thead>
            <tr>
                <th>头像</th>
                <th width="50%">昵称</th>
                <th class="text-center">连续签到</th>
            </tr>
            </thead>
            <tbody>
            <%for(var i=0;i< ranklist.length;i++){%>
            <tr>
                <td><a href="<%=ranklist[i]['user']['url']%>"><img src="<%=ranklist[i]['user']['avatar']%>" height="30" width="30" alt="" class="img-circle"/></a></td>
                <td><a href="<%=ranklist[i]['user']['url']%>"><%=ranklist[i]['user']['nickname']%></a></td>
                <td class="text-center"><%=ranklist[i]['days']%> 天</td>
            </tr>
            <%}%>
            </tbody>
        </table>
    </div>
</script>
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