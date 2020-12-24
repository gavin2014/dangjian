<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:104:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/index.html";i:1565057505;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/common/layout.html";i:1565058304;s:116:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/common/index_list.html";i:1564978880;s:110:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/common/item.html";i:1564411431;s:113:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/common/sidebar.html";i:1565026757;}*/ ?>
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
<!--                    <?php $__tm3pjOIxXz__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","condition"=>"1=isnav"]); if(is_array($__tm3pjOIxXz__) || $__tm3pjOIxXz__ instanceof \think\Collection || $__tm3pjOIxXz__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__tm3pjOIxXz__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>-->
<!--                    &lt;!&ndash;判断是否有子级或高亮当前栏目&ndash;&gt;-->
<!--                    <li class="<?php if($nav['has_child']): ?>dropdown<?php endif; if($nav->is_active): ?> active<?php endif; ?>">-->
<!--                        <a href="<?php echo $nav['url']; ?>" <?php if($nav['has_child']): ?> data-toggle="dropdown" <?php endif; ?>><?php echo $nav['name']; if($nav['has_child']): ?> <b class="caret"></b><?php endif; ?></a>-->
<!--                        <ul class="dropdown-menu" role="menu">-->
<!--                            <?php $__wfYN6C8yJ2__ = \addons\cms\model\Channel::getChannelList(["id"=>"sub","type"=>"son","typeid"=>$nav['id'],"condition"=>"1=isnav"]); if(is_array($__wfYN6C8yJ2__) || $__wfYN6C8yJ2__ instanceof \think\Collection || $__wfYN6C8yJ2__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__wfYN6C8yJ2__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>-->
<!--                            <li><a href="<?php echo $sub['url']; ?>"><?php echo $sub['name']; ?></a></li>-->
<!--                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__wfYN6C8yJ2__; ?>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__tm3pjOIxXz__; ?>-->
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

    <!--<div style="margin-bottom:20px;">-->
    <!---->
    <!--</div>-->

    <div class="row">
        <main class="col-md-12">
            <div class="swiper-container index-focus">
                <!-- S 焦点图 -->
                <div id="index-focus" class="carousel slide carousel-focus" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <?php $__XSQZsBJPb3__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"indexfocus","row"=>"5"]); if(is_array($__XSQZsBJPb3__) || $__XSQZsBJPb3__ instanceof \think\Collection || $__XSQZsBJPb3__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__XSQZsBJPb3__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                        <li data-target="#index-focus" data-slide-to="<?php echo $i-1; ?>" class="<?php if($i==1): ?>active<?php endif; ?>"></li>
                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__XSQZsBJPb3__; ?>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php $__opvgyO39cM__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"indexfocus","row"=>"5"]); if(is_array($__opvgyO39cM__) || $__opvgyO39cM__ instanceof \think\Collection || $__opvgyO39cM__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__opvgyO39cM__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                        <div class="item <?php if($i==1): ?>active<?php endif; ?>">
                            <a href="<?php echo $block['url']; ?>">
                                <div class="carousel-img" style="background-image:url('<?php echo cdnurl($block['image']); ?>');"></div>
                                <div class="carousel-caption hidden-xs">
                                    <h3><?php echo $block['title']; ?></h3>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__opvgyO39cM__; ?>
                    </div>
                    <a class="left carousel-control" href="#index-focus" role="button" data-slide="prev">
                        <span class="icon-prev fa fa-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#index-focus" role="button" data-slide="next">
                        <span class="icon-next fa fa-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- E 焦点图 -->
            </div>
        </main>

        <div  class="col-md-12 text-center">
            <ul class="p-3">
                <!-- S 归档 -->

                <a class="btn btn-md u-btn-skew u-btn-primary g-font-weight-600 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50 g-mr-10 g-mb-15"
                   href="cms/c/zhengzhixuexi.html">
                                  <span class="u-btn-skew__inner">
                                    <span class="glyphicon glyphicon-time"></span>
                                      政治学习
                                  </span>
                </a>
                <a class="btn btn-md u-btn-skew u-btn-red g-font-weight-600 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50 g-mr-10 g-mb-15"
                   href="cms/c/news.html">
                                  <span class="u-btn-skew__inner">
                                   <span class="glyphicon glyphicon-map-marker"></span>
                                  新闻中心
                                  </span>
                </a>
                <a class="btn btn-md u-btn-skew u-btn-lightred g-font-weight-600 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50 g-mr-10 g-mb-15"
                   href="cms/c/smarthome.html">
                                  <span class="u-btn-skew__inner">
                                    <span class="glyphicon glyphicon-user"></span>
                                   支部考核
                                  </span>
                </a>
            </ul>
        </div>


        <div class="col-md-8" >
            <div class="panel panel-default col-md-12">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span>最近动态</span>

                        <div class="more hidden-xs">
                            <ul class="list-unstyled list-inline">
                                <!-- E 栏目筛选 -->
                                <?php $__GwJd2FaVWc__ = \addons\cms\model\Channel::getChannelList(["id"=>"item","condition"=>"'list'=type","limit"=>"6"]); if(is_array($__GwJd2FaVWc__) || $__GwJd2FaVWc__ instanceof \think\Collection || $__GwJd2FaVWc__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__GwJd2FaVWc__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                                <li><?php echo $item['textlink']; ?></li>
                                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__GwJd2FaVWc__; ?>
                                <!-- E 栏目筛选 -->
                               </ul>
                        </div>
                    </h3>
                </div>
                <div class="panel-body p-0">
                    <div class="article-list">
                        <?php $page=request()->get('page/d',1);$offset=($page-1)*5; ?>

<!-- S 首页列表 -->
<?php $__LHrt8okhcm__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","cache"=>"false","orderby"=>"weigh","limit"=>"$offset,5"]); if(is_array($__LHrt8okhcm__) || $__LHrt8okhcm__ instanceof \think\Collection || $__LHrt8okhcm__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__LHrt8okhcm__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
<article class="article-item">
    <div class="media">
        <div class="media-left">
            <a href="<?php echo $item['url']; ?>">
                <div class="embed-responsive embed-responsive-4by3 img-zoom">
                    <img src="<?php echo $item['image']; ?>">
                </div>
            </a>
        </div>
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
<?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__LHrt8okhcm__; ?>
<!-- E 首页列表 -->

<?php if(!$__LASTLIST__): ?>
    <div class="loadmore loadmore-line loadmore-nodata"><span class="loadmore-tips">暂无更多数据</span></div>
<?php else: ?>
    <div class="text-center">
        <a href="?page=<?php echo $page+1; ?>" data-page="<?php echo $page; ?>" class="btn btn-default my-4 px-4 btn-loadmore">加载更多</a>
    </div>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <aside class="col-xs-12 col-sm-4">

            <div class="panel panel-default lasest-update">
                <!-- S 最近更新 -->
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo __('最新活动'); ?></h3>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <?php $__u4Rl87xYZk__ = \addons\cms\model\Archives::getArchivesList(["id"=>"new","row"=>"6","orderby"=>"id","orderway"=>"desc"]); if(is_array($__u4Rl87xYZk__) || $__u4Rl87xYZk__ instanceof \think\Collection || $__u4Rl87xYZk__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__u4Rl87xYZk__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$new): $mod = ($i % 2 );++$i;?>
                        <li>
                            <span>[<a href="<?php echo $new['channel']['url']; ?>"><?php echo $new['channel']['name']; ?></a>]</span>
                            <a class="link-dark" href="<?php echo $new['url']; ?>" title="<?php echo $new['title']; ?>"><?php echo $new['title']; ?></a>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__u4Rl87xYZk__; ?>
                    </ul>
                </div>
                <!-- E 最近更新 -->
                
<!-- S 热门标签 -->
<div class="panel panel-default hot-tags">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Hot tags'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="tags">
            <?php $__pY0m6jg8wq__ = \addons\cms\model\Tags::getTagsList(["id"=>"tag","orderby"=>"rand","limit"=>"30"]); if(is_array($__pY0m6jg8wq__) || $__pY0m6jg8wq__ instanceof \think\Collection || $__pY0m6jg8wq__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__pY0m6jg8wq__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo $tag['url']; ?>" class="tag"> <span><?php echo $tag['name']; ?></span></a>
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__pY0m6jg8wq__; ?>
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
        <?php $__wZQXtbIy9B__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","model"=>1,"row"=>"10","flag"=>"recommend","orderby"=>"id","orderway"=>"asc"]); if(is_array($__wZQXtbIy9B__) || $__wZQXtbIy9B__ instanceof \think\Collection || $__wZQXtbIy9B__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__wZQXtbIy9B__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
        <div class="media media-number">
            <div class="media-left">
                <span class="num"><?php echo $i; ?></span>
            </div>
            <div class="media-body">
                <a class="link-dark" href="<?php echo $item['url']; ?>" title="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></a>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__wZQXtbIy9B__; ?>
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
        <?php $__uHSae0X6FT__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","model"=>3,"row"=>"10","flag"=>"recommend","orderby"=>"id","orderway"=>"asc","addon"=>"political_study"]); if(is_array($__uHSae0X6FT__) || $__uHSae0X6FT__ instanceof \think\Collection || $__uHSae0X6FT__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__uHSae0X6FT__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
        <div class="media media-number">
            <div class="media-left">
                <span class="num"><?php echo $i; ?></span>
            </div>
            <div class="media-body">
                <a href="<?php echo $item['url']; ?>" title="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></a>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__uHSae0X6FT__; ?>
    </div>
</div>
<!-- E 推荐下载 -->

<!--<div class="panel panel-blockimg">-->
<!--    <a href="https://www.fastadmin.net/go/aliyun" title="FastAdmin推荐企业服务器" target="_blank">-->
<!--        <img src="https://cdn.fastadmin.net/uploads/store/enterprisehost.png" class="img-responsive" alt="">-->
<!--    </a>-->
<!--</div>-->
            </div>

            <div class="panel panel-blockimg">

            </div>



        </aside>








    </div>
</div>

<div class="container hidden-xs j-partner">
    <div class="panel panel-default">
        <!-- S 合作伙伴 -->
        <div class="panel-heading">
            <h3 class="panel-title">
                校内导航
                <a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo \think\Config::get("contactqq"); ?>&site=&menu=yes" target="_blank" class="more">联系我们</a>
            </h3>
        </div>
        <div class="panel-body">
            <ul class="list-unstyled list-partner  text-center">
                <li><a href="http://www.mnu.cn"><img src="/assets/addons/cms/img/logo/mnu_cn.png" /></a></li><li><a href="http://xgb.mnu.cn"><img src="/assets/addons/cms/img/logo/xgb_mnu_cn.png" /></a></li><li><a href="http://jw.mnu.cn"><img src="/assets/addons/cms/img/logo/jw_mnu_cn.png" /></a></li>
            </ul>
        </div>
        <!-- E 合作伙伴 -->

        <!-- S 友情链接 -->
<!--        <div class="panel-heading">-->
<!--            <h3 class="panel-title">友情链接-->
<!--                <a href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo \think\Config::get("contactqq"); ?>&site=&menu=yes" target="_blank" class="more">申请友链</a></h3>-->
<!--        </div>-->
<!--        <div class="panel-body">-->
<!--            <div class="list-unstyled list-links">-->
<!--                <a href="https://www.fastadmin.net" title="FastAdmin - 极速后台开发框架">FastAdmin</a> <a href="https://gitee.com" title="FastAdmin码云仓库">码云</a> <a href="https://github.com" title="FastAdminGithub仓库">Github</a> <a href="https://doc.fastadmin.net" title="FastAdmin文档 - 极速后台开发框架">FastAdmin文档</a> <a href="https://ask.fastadmin.net" title="FastAdmin问答社区 - 极速后台开发框架">FastAdmin问答社区</a>-->
<!--            </div>-->
<!--        </div>-->
        <!-- E 友情链接 -->
    </div>

</div>


<script>
     var mySwiper = new Swiper('.swiper-container',{
         autoplay:3000,
         _autoplayStopOnLast:true
     })
</script>



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