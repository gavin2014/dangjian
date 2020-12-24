<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:108:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/list_news.html";i:1564411431;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/common/layout.html";i:1565058304;s:115:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/common/item_news.html";i:1564411431;s:113:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/common/sidebar.html";i:1565026757;}*/ ?>
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
<!--                    <?php $__sHVlkfQF6O__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","condition"=>"1=isnav"]); if(is_array($__sHVlkfQF6O__) || $__sHVlkfQF6O__ instanceof \think\Collection || $__sHVlkfQF6O__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__sHVlkfQF6O__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>-->
<!--                    &lt;!&ndash;判断是否有子级或高亮当前栏目&ndash;&gt;-->
<!--                    <li class="<?php if($nav['has_child']): ?>dropdown<?php endif; if($nav->is_active): ?> active<?php endif; ?>">-->
<!--                        <a href="<?php echo $nav['url']; ?>" <?php if($nav['has_child']): ?> data-toggle="dropdown" <?php endif; ?>><?php echo $nav['name']; if($nav['has_child']): ?> <b class="caret"></b><?php endif; ?></a>-->
<!--                        <ul class="dropdown-menu" role="menu">-->
<!--                            <?php $__VI851ocOz0__ = \addons\cms\model\Channel::getChannelList(["id"=>"sub","type"=>"son","typeid"=>$nav['id'],"condition"=>"1=isnav"]); if(is_array($__VI851ocOz0__) || $__VI851ocOz0__ instanceof \think\Collection || $__VI851ocOz0__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__VI851ocOz0__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>-->
<!--                            <li><a href="<?php echo $sub['url']; ?>"><?php echo $sub['name']; ?></a></li>-->
<!--                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__VI851ocOz0__; ?>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__sHVlkfQF6O__; ?>-->
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
                <?php $__5EVyjRN8mW__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__5EVyjRN8mW__) || $__5EVyjRN8mW__ instanceof \think\Collection || $__5EVyjRN8mW__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__5EVyjRN8mW__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__5EVyjRN8mW__; ?>
                <!-- E 面包屑导航 -->
            </ol>
        </div>
    </h1>
    <?php if($__FILTERLIST__): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                筛选
            </h3>
        </div>
        <div class="panel-body">
            <div class="tabs-wrapper">
                <?php $__sOjnKZX43H__ = \addons\cms\model\Archives::getPageFilter($__FILTERLIST__, ["id"=>"filter","exclude"=>""]); if(is_array($__sOjnKZX43H__) || $__sOjnKZX43H__ instanceof \think\Collection || $__sOjnKZX43H__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__sOjnKZX43H__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$filter): $mod = ($i % 2 );++$i;?>
                <div class="tabs-group">
                    <div class="title"><?php echo $filter['title']; ?>:</div>
                    <ul class="content clearfix">
                        <?php if(is_array($filter['content']) || $filter['content'] instanceof \think\Collection || $filter['content'] instanceof \think\Paginator): $i = 0; $__LIST__ = $filter['content'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                        <li class="<?php echo !empty($item['active'])?'active':''; ?>"><a href="<?php echo $item['url']; ?>"><?php echo $item['title']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__sOjnKZX43H__; ?>
                <!-- E 分类列表 -->
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">

        <main class="col-xs-12 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span>列表</span>
                        <div class="more">
                            <ul class="list-unstyled list-inline category-order clearfix">
                                <!-- S 排序 -->
                                <?php $__dWOkRzl4XB__ = \addons\cms\model\Archives::getPageOrder($__ORDERLIST__, ["id"=>"order"]); if(is_array($__dWOkRzl4XB__) || $__dWOkRzl4XB__ instanceof \think\Collection || $__dWOkRzl4XB__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__dWOkRzl4XB__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order): $mod = ($i % 2 );++$i;?>
                                <li><a href="<?php echo $order['url']; ?>" class="<?php echo !empty($order['active'])?'active':''; ?>"><?php echo $order['title']; ?></a></li>
                                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__dWOkRzl4XB__; ?>
                                <!-- E 排序 -->
                            </ul>
                        </div>
                    </h3>
                </div>
                <div class="panel-body py-0">
                    <div class="article-list">

                        <!-- S 列表 -->
                        <?php $__oBJ5xLwbnz__ = \addons\cms\model\Archives::getPageList($__PAGELIST__, ["id"=>"item"]); if(is_array($__oBJ5xLwbnz__) || $__oBJ5xLwbnz__ instanceof \think\Collection || $__oBJ5xLwbnz__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__oBJ5xLwbnz__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                        <article class="article-item">
    <div class="media">
        <?php if($item['hasimage']): ?>
        <div class="media-left">
            <a href="<?php echo $item['url']; ?>">
                <div class="embed-responsive embed-responsive-4by3 img-zoom">
                    <img src="<?php echo $item['image']; ?>">
                </div>
            </a>
        </div>
        <?php endif; ?>
        <div class="media-body">
            <h3 class="article-title">
                <a href="<?php echo $item['url']; ?>" <?php if($item['style']): ?>style="<?php echo $item['style_text']; ?>"<?php endif; ?>><?php echo $item['title']; ?></a>
            </h3>
            <div class="article-intro hidden-xs">
                <?php echo $item['description']; ?>
            </div>
            <div class="article-tag">
                <a href="<?php echo $item['channel']['url']; ?>" class="tag tag-primary"><?php echo $item['channel']['name']; ?></a>
                <span itemprop="date"><?php echo date("Y年m月d日", $item['publishtime']); ?></span>
                <span itemprop="likes" title="点赞次数"><i class="fa fa-thumbs-up"></i> <?php echo $item['likes']; ?> 点赞</span>
                <span itemprop="comments"><a href="<?php echo $item['url']; ?>#comments" target="_blank" title="评论数"><i class="fa fa-comments"></i> <?php echo $item['comments']; ?></a> 评论</span>
                <span itemprop="views" title="浏览次数"><i class="fa fa-eye"></i> <?php echo $item['views']; ?> 浏览</span>
            </div>
        </div>
    </div>

</article>
                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__oBJ5xLwbnz__; ?>
                        <!-- E 列表 -->

                        
                        <?php if(false): ?>
                            <!-- S 分页栏 -->
                            <div class="text-center pager">
                                <?php echo $__PAGELIST__->render(["type"=>"simple"]); ?>
                            </div>
                            <!-- E 分页栏 -->
                            <?php if($__PAGELIST__->isEmpty()): ?>
                            <div class="loadmore loadmore-line loadmore-nodata"><span class="loadmore-tips">暂无数据</span></div>
                            <?php endif; endif; if($__PAGELIST__->isEmpty()): ?>
                            <div class="loadmore loadmore-line loadmore-nodata"><span class="loadmore-tips">暂无更多数据</span></div>
                        <?php else: ?>
                            <div class="text-center">
                                <a href="?page=<?php echo $__PAGELIST__->getNextPage(); ?>" data-page="<?php echo $__PAGELIST__->getNextPage(); ?>" class="btn btn-default my-4 px-4 btn-loadmore">加载更多</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>

        <aside class="col-xs-12 col-sm-4">
            
<!-- S 热门标签 -->
<div class="panel panel-default hot-tags">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Hot tags'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="tags">
            <?php $__nqNHCry4zx__ = \addons\cms\model\Tags::getTagsList(["id"=>"tag","orderby"=>"rand","limit"=>"30"]); if(is_array($__nqNHCry4zx__) || $__nqNHCry4zx__ instanceof \think\Collection || $__nqNHCry4zx__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__nqNHCry4zx__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo $tag['url']; ?>" class="tag"> <span><?php echo $tag['name']; ?></span></a>
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__nqNHCry4zx__; ?>
        </div>
    </div>
</div>
<!-- E 热门标签 -->




<div class="panel panel-blockimg">
<!--    <img src="/uploads/305112475f6660078939417e357e3034e0dd05e34c322-5CjdIH_fw658kVahw45HbWiueqQx.jpeg" class="img-responsive"/>-->
</div>


<!-- S 热门资讯 -->
<div class="panel panel-default hot-article">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Recommend news'); ?></h3>
    </div>
    <div class="panel-body">
        <?php $__YIjcS7dPUD__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","model"=>1,"row"=>"10","flag"=>"recommend","orderby"=>"id","orderway"=>"asc"]); if(is_array($__YIjcS7dPUD__) || $__YIjcS7dPUD__ instanceof \think\Collection || $__YIjcS7dPUD__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__YIjcS7dPUD__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
        <div class="media media-number">
            <div class="media-left">
                <span class="num"><?php echo $i; ?></span>
            </div>
            <div class="media-body">
                <a class="link-dark" href="<?php echo $item['url']; ?>" title="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></a>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__YIjcS7dPUD__; ?>
    </div>
</div>
<!-- E 热门资讯 -->

<div class="panel panel-blockimg">
    <img src="/uploads/锦绣1ewxdSQ8LHBlrFGsV.png" class="img-responsive"/>
</div>



<!-- S 推荐下载 -->
<div class="panel panel-default recommend-article">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('推荐课程'); ?></h3>
    </div>
    <div class="panel-body">
        <?php $__uvg1DHSoWB__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","model"=>3,"row"=>"10","flag"=>"recommend","orderby"=>"id","orderway"=>"asc","addon"=>"political_study"]); if(is_array($__uvg1DHSoWB__) || $__uvg1DHSoWB__ instanceof \think\Collection || $__uvg1DHSoWB__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__uvg1DHSoWB__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
        <div class="media media-number">
            <div class="media-left">
                <span class="num"><?php echo $i; ?></span>
            </div>
            <div class="media-body">
                <a href="<?php echo $item['url']; ?>" title="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></a>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__uvg1DHSoWB__; ?>
    </div>
</div>
<!-- E 推荐下载 -->

<!--<div class="panel panel-blockimg">-->
<!--    <a href="https://www.fastadmin.net/go/aliyun" title="FastAdmin推荐企业服务器" target="_blank">-->
<!--        <img src="https://cdn.fastadmin.net/uploads/store/enterprisehost.png" class="img-responsive" alt="">-->
<!--    </a>-->
<!--</div>-->
        </aside>
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