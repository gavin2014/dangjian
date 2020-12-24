<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:111:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/channel_news.html";i:1564411431;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/common/layout.html";i:1565058304;}*/ ?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=""> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit">
    <title><?php echo \think\Config::get("cms.title"); ?> - <?php echo \think\Config::get("cms.sitename"); ?></title>
    <meta name="keywords" content="<?php echo \think\Config::get("cms.keywords"); ?>"/>
    <meta name="description" content="<?php echo \think\Config::get("cms.description"); ?>"/>
    <link href="/assets/css/frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
<!--    <link rel="stylesheet" media="screen" href="/assets/css/bootstrap.min.css"/>-->
    <link rel="stylesheet" media="screen" href="/assets/libs/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" media="screen" href="/assets/libs/fastadmin-layer/dist/theme/default/layer.css"/>
    <link rel="stylesheet" media="screen" href="/assets/addons/cms/css/common.css?v=<?php echo \think\Config::get("site.version"); ?>"/>
    <link rel="stylesheet" media="screen" href="/assets/addons/cms/show/css/unify.css"/>
    <link rel="stylesheet" media="screen" href="/assets/addons/cms/show/css/custom.css"/>
    <link rel="stylesheet" media="screen" href="/assets/addons/cms/css/swiper.min.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_1104524_z1zcv22ej09.css">

    {__STYLE__}



    <!--[if lt IE 9]>
    <script src="/libs/html5shiv.js"></script>
    <script src="/libs/respond.min.js"></script>
    <![endif]-->

    <style>
        .mynavbar {
            position: relative;
            min-height: 100px;
            background-image: url(/bar.png);
            background-size:cover;
        }
        .myfooter{

        }

    </style>

</head>
<body class="group-page">
    <!-- S 导航 -->
<header>
    <nav class="mynavbar naviagtion fixed-top transition" role="navigation">
        <div class="container " style="padding-top: 70px" >

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo url('/'); ?>" style="padding:6px 15px;"><img src="/assets/img/logo.png" style="height:40px;" alt=""></a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
<!--                <ul class="nav navbar-nav">-->
<!--                    &lt;!&ndash;如果你需要自定义NAV,可使用channellist标签来完成,这里只设置了2级,如果显示无限级,请使用cms:nav标签&ndash;&gt;-->
<!--                    <?php $__acSrNb8Lz9__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","condition"=>"1=isnav"]); if(is_array($__acSrNb8Lz9__) || $__acSrNb8Lz9__ instanceof \think\Collection || $__acSrNb8Lz9__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__acSrNb8Lz9__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>-->
<!--                    &lt;!&ndash;判断是否有子级或高亮当前栏目&ndash;&gt;-->
<!--                    <li class="<?php if($nav['has_child']): ?>dropdown<?php endif; if($nav->is_active): ?> active<?php endif; ?>">-->
<!--                        <a href="<?php echo $nav['url']; ?>" <?php if($nav['has_child']): ?> data-toggle="dropdown" <?php endif; ?>><?php echo $nav['name']; if($nav['has_child']): ?> <b class="caret"></b><?php endif; ?></a>-->
<!--                        <ul class="dropdown-menu" role="menu">-->
<!--                            <?php $__uF3UwKXHGq__ = \addons\cms\model\Channel::getChannelList(["id"=>"sub","type"=>"son","typeid"=>$nav['id'],"condition"=>"1=isnav"]); if(is_array($__uF3UwKXHGq__) || $__uF3UwKXHGq__ instanceof \think\Collection || $__uF3UwKXHGq__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__uF3UwKXHGq__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>-->
<!--                            <li><a href="<?php echo $sub['url']; ?>"><?php echo $sub['name']; ?></a></li>-->
<!--                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__uF3UwKXHGq__; ?>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__acSrNb8Lz9__; ?>-->
<!--                </ul>-->

                <ul class="nav navbar-nav navbar-right">

                    <?php if($user): else: ?>
                    <li><a href="<?php echo url('/admin/index/login'); ?>"><i class="fa fa-sign-in fa-fw"></i>管理员登录</a></li>
                    <li><a href="<?php echo url('index/user/login'); ?>"><i class="fa fa-sign-in fa-fw"></i>登录</a></li>
                    <li><a href="<?php echo url('index/user/register'); ?>"><i class="fa fa-user-o fa-fw"></i>注册</a></li>
                    <?php endif; ?>

                    <li class="dropdown">
                        <?php if($user): ?>
                        <a href="<?php echo url('index/user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 10px;height: 50px;">
                            <span class="avatar-img"><img src="<?php echo cdnurl($user['avatar']); ?>" style="width:30px;height:30px;border-radius:50%;" alt=""></span>
                        </a>
                        <?php else: endif; ?>
                        <ul class="dropdown-menu">
                            <?php if($user): ?>
                            <li><a href="<?php echo url('index/user/index'); ?>"><i class="fa fa-user fa-fw"></i>会员中心</a></li>
                            <li><a href="<?php echo url('index/cms.archives/my'); ?>"><i class="fa fa-list fa-fw"></i>我发布的文章</a></li>
                            <li><a href="<?php echo url('index/cms.archives/post'); ?>"><i class="fa fa-pencil fa-fw"></i>发布文章</a></li>
                            <li><a href="<?php echo url('index/user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i>注销</a></li>
                            <?php else: ?>
                            <li><a href="<?php echo url('/admin/index/login'); ?>"><i class="fa fa-sign-in fa-fw"></i>管理员登录</a></li>
                            <li><a href="<?php echo url('index/user/login'); ?>"><i class="fa fa-sign-in fa-fw"></i>登录</a></li>
                            <li><a href="<?php echo url('index/user/register'); ?>"><i class="fa fa-user-o fa-fw"></i>注册</a></li>
                            <?php endif; ?>

                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <!-- E 导航 -->

</header>
<!--    <img src="/dj.jpeg" class="img-fluid bg-shape-3" alt="shape" width="100%" height="50%">-->




<div class="container" id="content-container">
    <h1 class="category-title">
        <?php echo $__CHANNEL__['name']; ?>
        <div class="more pull-right">
            <ol class="breadcrumb">
                <!-- S 面包屑导航 -->
                <?php $__oLKtme2rHC__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__oLKtme2rHC__) || $__oLKtme2rHC__ instanceof \think\Collection || $__oLKtme2rHC__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__oLKtme2rHC__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__oLKtme2rHC__; ?>
                <!-- E 面包屑导航 -->
            </ol>
        </div>
    </h1>

    <div class="row">
        <div class="col-xs-12 col-md-7">
            <div id="news-focus" class="carousel slide carousel-focus" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php $__qW4GFip1wZ__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"newsfocus","row"=>"2"]); if(is_array($__qW4GFip1wZ__) || $__qW4GFip1wZ__ instanceof \think\Collection || $__qW4GFip1wZ__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__qW4GFip1wZ__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                    <li data-target="#carousel-focus-captions" data-slide-to="<?php echo $i-1; ?>" class="<?php if($i==1): ?>active<?php endif; ?>"></li>
                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__qW4GFip1wZ__; ?>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <?php $__HUaDryXbJ9__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"newsfocus","row"=>"2"]); if(is_array($__HUaDryXbJ9__) || $__HUaDryXbJ9__ instanceof \think\Collection || $__HUaDryXbJ9__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__HUaDryXbJ9__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                    <div class="item <?php if($i==1): ?>active<?php endif; ?>">
                        <a href="<?php echo $block['url']; ?>">
                            <div class="carousel-img" style="background-image:url('<?php echo $block['image']; ?>');"></div>
                            <div class="carousel-caption hidden-xs">
                                <h3><?php echo $block['title']; ?></h3>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__HUaDryXbJ9__; ?>
                </div>
                <a class="left carousel-control" href="#news-focus" role="button" data-slide="prev">
                    <span class="icon-prev fa fa-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#news-focus" role="button" data-slide="next">
                    <span class="icon-next fa fa-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-xs-12 col-md-5 focus-img">
            <div class="row">
                <?php $__A78vBqtPUs__ = \addons\cms\model\Block::getBlockList(["id"=>"item","name"=>"newsfocus","limit"=>"2,4"]); if(is_array($__A78vBqtPUs__) || $__A78vBqtPUs__ instanceof \think\Collection || $__A78vBqtPUs__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__A78vBqtPUs__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                <div class="col-xs-6">
                    <a href="<?php echo $item['url']; ?>">
                        <span class="embed-responsive embed-responsive-16by9 img-zoom">
                            <img src="<?php echo $item['image']; ?>" class="embed-responsive-item" alt="">
                            <div class="intro"><?php echo $item['title']; ?></div>
                        </span>
                    </a>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__A78vBqtPUs__; ?>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <main class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body pt-0">
                    <div class="channel-list">
                        <div class="row">
                            <!-- S 栏目列表 -->
                            <?php $__QxueLrylgZ__ = \addons\cms\model\Channel::getChannelList(["id"=>"channel","type"=>"son","typeid"=>$__CHANNEL__['id']]); if(is_array($__QxueLrylgZ__) || $__QxueLrylgZ__ instanceof \think\Collection || $__QxueLrylgZ__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__QxueLrylgZ__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i;?>
                            <div class="col-xs-12 col-sm-6">
                                <h3><?php echo $channel['textlink']; ?> <em><a href="<?php echo $channel['url']; ?>"><?php echo __('More'); ?></a></em></h3>

                                <?php $__cLVEgrFfxl__ = \addons\cms\model\Archives::getArchivesList(["id"=>"row","channel"=>$channel['id'],"limit"=>"0,1"]); if(is_array($__cLVEgrFfxl__) || $__cLVEgrFfxl__ instanceof \think\Collection || $__cLVEgrFfxl__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__cLVEgrFfxl__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="<?php echo $row['url']; ?>" <?php if($row['style']): ?>style="<?php echo $row['style_text']; ?>"<?php endif; ?>>
                                            <div class="embed-responsive embed-responsive-4by3 img-zoom">
                                                <img class="embed-responsive-item media-object" width="64" height="64" src="<?php echo $row['image']; ?>">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo $row['textlink']; ?></h4>
                                        <p><?php echo $row['description']; ?></p>
                                    </div>
                                </div>
                                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__cLVEgrFfxl__; ?>

                                <ul class="list-unstyled inner-list">
                                    <?php $__WgjskzCSyZ__ = \addons\cms\model\Archives::getArchivesList(["id"=>"row","channel"=>$channel['id'],"limit"=>"1,5"]); if(is_array($__WgjskzCSyZ__) || $__WgjskzCSyZ__ instanceof \think\Collection || $__WgjskzCSyZ__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__WgjskzCSyZ__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?>
                                    <li>
                                        <a href="<?php echo $row['url']; ?>" <?php if($row['style']): ?>style="<?php echo $row['style_text']; ?>"<?php endif; ?>><?php echo $row['title']; ?></a>
                                        <span class="pull-right"><?php echo date('m-d',$row['publishtime']); ?></span>
                                    </li>
                                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__WgjskzCSyZ__; ?>
                                </ul>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__QxueLrylgZ__; ?>
                            <!-- E 栏目列表 -->
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>



<footer class="myfooter footer"  >
    <!-- FastAdmin是开源程序，建议在您的网站底部保留一个FastAdmin的链接 -->
    <p class="copyright">Copyright&nbsp;©&nbsp;2017-2019 Powered by <a href="https://www.likecy.cn" target="_blank">云中有鹿</a> <br/>All Rights Reserved <?php echo $site['name']; ?> <?php echo __('Copyrights'); ?> <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $site['beian']; ?></a></p>
</footer>

<div id="floatbtn">
    <!-- S 浮动按钮 -->


    <?php if(isset($__ARCHIVES__)): ?>
    <a id="feedback" class="hover" href="#comments">
        <i class="iconfont icon-feedback"></i>
        <em>发表<br>评论</em>
    </a>
    <?php endif; ?>

    <a id="back-to-top" class="hover" href="javascript:;">
        <i class="iconfont icon-backtotop"></i>
        <em>返回<br>顶部</em>
    </a>
    <!-- E 浮动按钮 -->
</div>


<script type="text/javascript" src="/assets/libs/jquery/dist/jquery.min.js"></script>
<!--<script src="/assets/addons/cms/show/vendor/bootstrap/bootstrap.min.js"></script>-->
<script type="text/javascript" src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/libs/fastadmin-layer/dist/layer.js"></script>
<script type="text/javascript" src="/assets/libs/art-template/dist/template-native.js"></script>
<script type="text/javascript" src="/assets/addons/cms/js/bootstrap-typeahead.min.js"></script>
<script type="text/javascript" src="/assets/addons/cms/js/cms.js?r=<?php echo $site['version']; ?>"></script>
<script type="text/javascript" src="/assets/addons/cms/js/common.js?r=<?php echo $site['version']; ?>"></script>
<script type="text/javascript" src="/assets/addons/cms/js/swiper.min.js"></script>


    {__SCRIPT__}

</body>
</html>