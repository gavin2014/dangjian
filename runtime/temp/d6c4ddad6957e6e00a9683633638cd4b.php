<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:108:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/show_news.html";i:1565067070;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/common/layout.html";i:1565058304;s:113:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/common/sidebar.html";i:1565026757;}*/ ?>
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
<!--                    <?php $__aVIu1vd2Ej__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","condition"=>"1=isnav"]); if(is_array($__aVIu1vd2Ej__) || $__aVIu1vd2Ej__ instanceof \think\Collection || $__aVIu1vd2Ej__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__aVIu1vd2Ej__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>-->
<!--                    &lt;!&ndash;判断是否有子级或高亮当前栏目&ndash;&gt;-->
<!--                    <li class="<?php if($nav['has_child']): ?>dropdown<?php endif; if($nav->is_active): ?> active<?php endif; ?>">-->
<!--                        <a href="<?php echo $nav['url']; ?>" <?php if($nav['has_child']): ?> data-toggle="dropdown" <?php endif; ?>><?php echo $nav['name']; if($nav['has_child']): ?> <b class="caret"></b><?php endif; ?></a>-->
<!--                        <ul class="dropdown-menu" role="menu">-->
<!--                            <?php $__MnjxOa6gIZ__ = \addons\cms\model\Channel::getChannelList(["id"=>"sub","type"=>"son","typeid"=>$nav['id'],"condition"=>"1=isnav"]); if(is_array($__MnjxOa6gIZ__) || $__MnjxOa6gIZ__ instanceof \think\Collection || $__MnjxOa6gIZ__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__MnjxOa6gIZ__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>-->
<!--                            <li><a href="<?php echo $sub['url']; ?>"><?php echo $sub['name']; ?></a></li>-->
<!--                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__MnjxOa6gIZ__; ?>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__aVIu1vd2Ej__; ?>-->
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

    <div class="row">

        <main class="col-md-8">
            <div class="panel panel-default article-content">
                <div class="panel-heading">
                    <ol class="breadcrumb">
                        <!-- S 面包屑导航 -->
                        <?php $__C7yX9sxb4M__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__C7yX9sxb4M__) || $__C7yX9sxb4M__ instanceof \think\Collection || $__C7yX9sxb4M__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__C7yX9sxb4M__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__C7yX9sxb4M__; ?>
                        <!-- E 面包屑导航 -->
                    </ol>
                </div>
                <div class="panel-body">
                    <div class="article-metas">
                        <h1 class="metas-title" <?php if($__ARCHIVES__['style']): ?>style="<?php echo $__ARCHIVES__['style_text']; ?>"<?php endif; ?>>
                            <?php echo $__ARCHIVES__['title']; ?>
                        </h1>
                        <!-- S 统计信息 -->
                        <div class="metas-body">
                            <?php if($__ARCHIVES__['author']): ?>
                            <span>
                                <i class="fa fa-user"></i> <?php echo $__ARCHIVES__['author']; ?>
                            </span>
                            <?php endif; ?>
                            <span class="views-num">
                                <i class="fa fa-eye"></i> <?php echo $__ARCHIVES__['views']; ?> 阅读
                            </span>
                            <span class="comment-num">
                                <i class="fa fa-comments"></i> <?php echo $__ARCHIVES__['comments']; ?> 评论
                            </span>
                            <span class="like-num">
                                <i class="fa fa-thumbs-o-up"></i>
                                <span class="js-like-num"> <?php echo $__ARCHIVES__['likes']; ?> 点赞
                                </span>
                            </span>
                        </div>
                        <!-- E 统计信息 -->
                    </div>


                    <div class="article-text">
                        <!-- S 正文 -->
                        <p>
                            <?php if((isset($__ARCHIVES__['price']) && $__ARCHIVES__['price']<=0) || $__ARCHIVES__['is_paid_part_of_content'] || $__ARCHIVES__['ispaid']): ?>
                            <?php echo $__ARCHIVES__['content']; endif; ?>
                        </p>
                        <!-- E 正文 -->
                    </div>


                    <!-- E 付费阅读 -->

                    <div class="article-donate">
                        <a href="javascript:" class="btn btn-primary btn-like btn-lg" data-action="vote" data-type="like" data-id="<?php echo $__ARCHIVES__['id']; ?>" data-tag="archives"><i class="fa fa-thumbs-up"></i> 点赞(<span><?php echo $__ARCHIVES__['likes']; ?></span>)</a>

                    </div>

                    <div class="entry-meta">
                        <ul>
                            <!-- S 归档 -->
                            <li><?php echo __('Article category'); ?>：<a href="<?php echo $__CHANNEL__['url']; ?>"><?php echo $__CHANNEL__['name']; ?></a></li>
                            <li><?php echo __('Article tags'); ?>：<?php if(is_array($__ARCHIVES__['tagslist']) || $__ARCHIVES__['tagslist'] instanceof \think\Collection || $__ARCHIVES__['tagslist'] instanceof \think\Paginator): $i = 0; $__LIST__ = $__ARCHIVES__['tagslist'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><a href="<?php echo $tag['url']; ?>" class="tag" rel="tag"><?php echo $tag['name']; ?></a><?php endforeach; endif; else: echo "" ;endif; ?></li>
                            <li><?php echo __('Article views'); ?>：<span><?php echo $__ARCHIVES__['views']; ?></span> 次浏览</li>
                            <li><?php echo __('Post date'); ?>：<?php echo datetime($__ARCHIVES__['publishtime']); ?></li>
                            <li><?php echo __('Article url'); ?>：<a href="<?php echo $__ARCHIVES__['fullurl']; ?>"><?php echo $__ARCHIVES__['fullurl']; ?></a></li>
                            <!-- S 归档 -->
                        </ul>

                        <ul class="article-prevnext">
                            <!-- S 上一篇下一篇 -->
                            <?php $prev = \addons\cms\model\Archives::getPrevNext("prev", $__ARCHIVES__['id'], $__CHANNEL__['id']);if($prev): ?>
                            <li>
                                <span><?php echo __('Prev'); ?> &gt;</span>
                                <a href="<?php echo $prev['url']; ?>"><?php echo $prev['title']; ?></a>
                            </li>
                            <?php endif;$next = \addons\cms\model\Archives::getPrevNext("next", $__ARCHIVES__['id'], $__CHANNEL__['id']);if($next): ?>
                            <li>
                                <span><?php echo __('Next'); ?> &gt;</span>
                                <a href="<?php echo $next['url']; ?>"><?php echo $next['title']; ?></a>
                            </li>
                            <?php endif;?>
                            <!-- E 上一篇下一篇 -->
                        </ul>
                    </div>


                    <div class="related-article">
                        <div class="row">
                            <!-- S 相关文章 -->
                            <?php $__3Gs1Hcapfb__ = \addons\cms\model\Archives::getArchivesList(["id"=>"relate","tags"=>$__ARCHIVES__['tags'],"model"=>$__ARCHIVES__['model_id'],"row"=>"4"]); if(is_array($__3Gs1Hcapfb__) || $__3Gs1Hcapfb__ instanceof \think\Collection || $__3Gs1Hcapfb__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__3Gs1Hcapfb__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$relate): $mod = ($i % 2 );++$i;?>
                            <div class="col-sm-3 col-xs-6">
                                <a href="<?php echo $relate['url']; ?>" class="img-zoom">
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <img src="<?php echo $relate['image']; ?>" alt="<?php echo $relate['title']; ?>" class="embed-responsive-item">
                                    </div>
                                </a>
                                <h5><?php echo $relate['title']; ?></h5>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__3Gs1Hcapfb__; ?>
                            <!-- E 相关文章 -->
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </main>

        <aside class="col-xs-12 col-sm-4">
            <?php if($config['userpage']): ?>
            <!-- S 关于作者 -->
            <div class="panel panel-default about-author" data-id="<?php echo $__ARCHIVES__['user']['id']; ?>" itemProp="author" itemscope="" itemType="http://schema.org/Person">
                <meta itemProp="name" content="<?php echo $__ARCHIVES__['user']['nickname']; ?>"/>
                <meta itemProp="image" content="<?php echo cdnurl($__ARCHIVES__['user']['avatar']); ?>"/>

                <div class="panel-heading">
                    <h3 class="panel-title">文章From</h3>
                </div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-left">


                                <img class="media-object img-circle img-medium" style="width:64px;height:64px;" src="<?php echo cdnurl($__ARCHIVES__['user']['avatar']); ?>"
                                     data-holder-rendered="true">


                        </div>
                        <div class="media-body">
                            <h3 style="margin-top:10px;" class="media-heading">
                       <?php echo $__ARCHIVES__['user']['nickname']; ?>

                            </h3>

                            <?php echo $__ARCHIVES__['user']['nickname']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- E 关于作者 -->
            <?php endif; ?>
            
<!-- S 热门标签 -->
<div class="panel panel-default hot-tags">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Hot tags'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="tags">
            <?php $__7Oz28yhT3S__ = \addons\cms\model\Tags::getTagsList(["id"=>"tag","orderby"=>"rand","limit"=>"30"]); if(is_array($__7Oz28yhT3S__) || $__7Oz28yhT3S__ instanceof \think\Collection || $__7Oz28yhT3S__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__7Oz28yhT3S__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo $tag['url']; ?>" class="tag"> <span><?php echo $tag['name']; ?></span></a>
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__7Oz28yhT3S__; ?>
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
        <?php $__CcK2OhkoDd__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","model"=>1,"row"=>"10","flag"=>"recommend","orderby"=>"id","orderway"=>"asc"]); if(is_array($__CcK2OhkoDd__) || $__CcK2OhkoDd__ instanceof \think\Collection || $__CcK2OhkoDd__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__CcK2OhkoDd__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
        <div class="media media-number">
            <div class="media-left">
                <span class="num"><?php echo $i; ?></span>
            </div>
            <div class="media-body">
                <a class="link-dark" href="<?php echo $item['url']; ?>" title="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></a>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__CcK2OhkoDd__; ?>
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
        <?php $__8uGbCI1y9Y__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","model"=>3,"row"=>"10","flag"=>"recommend","orderby"=>"id","orderway"=>"asc","addon"=>"political_study"]); if(is_array($__8uGbCI1y9Y__) || $__8uGbCI1y9Y__ instanceof \think\Collection || $__8uGbCI1y9Y__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__8uGbCI1y9Y__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
        <div class="media media-number">
            <div class="media-left">
                <span class="num"><?php echo $i; ?></span>
            </div>
            <div class="media-body">
                <a href="<?php echo $item['url']; ?>" title="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></a>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__8uGbCI1y9Y__; ?>
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