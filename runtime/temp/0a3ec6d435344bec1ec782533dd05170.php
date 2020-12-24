<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:110:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/show_notify.html";i:1565067588;s:112:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/common/layout.html";i:1565058304;s:113:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/cms/view/default/common/comment.html";i:1564559440;}*/ ?>
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
<!--                    <?php $__ZCN1y4mdIY__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","condition"=>"1=isnav"]); if(is_array($__ZCN1y4mdIY__) || $__ZCN1y4mdIY__ instanceof \think\Collection || $__ZCN1y4mdIY__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__ZCN1y4mdIY__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>-->
<!--                    &lt;!&ndash;判断是否有子级或高亮当前栏目&ndash;&gt;-->
<!--                    <li class="<?php if($nav['has_child']): ?>dropdown<?php endif; if($nav->is_active): ?> active<?php endif; ?>">-->
<!--                        <a href="<?php echo $nav['url']; ?>" <?php if($nav['has_child']): ?> data-toggle="dropdown" <?php endif; ?>><?php echo $nav['name']; if($nav['has_child']): ?> <b class="caret"></b><?php endif; ?></a>-->
<!--                        <ul class="dropdown-menu" role="menu">-->
<!--                            <?php $__ncAezdLDFE__ = \addons\cms\model\Channel::getChannelList(["id"=>"sub","type"=>"son","typeid"=>$nav['id'],"condition"=>"1=isnav"]); if(is_array($__ncAezdLDFE__) || $__ncAezdLDFE__ instanceof \think\Collection || $__ncAezdLDFE__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__ncAezdLDFE__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>-->
<!--                            <li><a href="<?php echo $sub['url']; ?>"><?php echo $sub['name']; ?></a></li>-->
<!--                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__ncAezdLDFE__; ?>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__ZCN1y4mdIY__; ?>-->
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

        <main class="col-md-12 col-lg-12 col-xs-12">
            <div class="panel panel-default article-content">
                <div class="panel-heading">
                    <ol class="breadcrumb">
                        <!-- S 面包屑导航 -->
                        <?php $__XnSomE8ayk__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__XnSomE8ayk__) || $__XnSomE8ayk__ instanceof \think\Collection || $__XnSomE8ayk__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__XnSomE8ayk__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__XnSomE8ayk__; ?>
                        <!-- E 面包屑导航 -->
                    </ol>
                </div>
                <div class="panel-body">
                    <div class="article-metas">
                        <h1 $__ARCHIVES__.style}style="<?php echo $__ARCHIVES__['style_text']; ?>" class="metas-title" {{if/if}>
                        <?php echo $__ARCHIVES__['title']; ?>
                        </h1>
                        <!-- S 统计信息 -->
                        <div class="metas-body p-3">
                            <span class="views-num">
                                   <a class="btn btn-sm u-btn-skew u-btn-outline-lightred g-mr-10 g-mb-15" href="#">
                            <span class="u-btn-skew__inner">  <i class="fa fa-eye"></i> <?php echo $__ARCHIVES__['views']; ?> 阅读</span>
                        </a>

                            </span>
                            <span class="comment-num">
                                <a href="#" class="btn btn-sm u-btn-skew u-btn-outline-primary g-mr-10 g-mb-15">
     <span class="u-btn-skew__inner"> <i class="fa fa-comments"></i> <?php echo $__ARCHIVES__['comments']; ?> 评论</span>
</a>

                            </span>
                            <span class="like-num">

                                  <a class="btn btn-sm u-btn-skew u-btn-outline-red g-mr-10 g-mb-15" href="#">
                                      <span class="js-like-num">   <i class="fa fa-thumbs-o-up"></i><?php echo $__ARCHIVES__['likes']; ?> 点赞
                                </span>
                        </a>

                            </span>



                        </div>

                        <!-- E 统计信息 -->
                    </div>


                    <?php if($__ARCHIVES__['user_type'] ==0  || $__ARCHIVES__['user_type'] == \think\Session::get('user_type')): ?>

                    <div class="entry-meta">
                        <ul class="p-2">
                            <!-- S 归档 -->

                            <a class="btn  u-btn-skew u-btn-primary g-font-weight-600 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50 g-mr-10 g-mb-15"
                               href="#">
                                  <span class="u-btn-skew__inner">
                                    <span class="glyphicon glyphicon-time"></span>
                                      <?php echo __('Activity_time'); ?>：<?php echo $__ARCHIVES__['activity_time']; ?>
                                  </span>
                            </a>
                            <a class="btn u-btn-skew u-btn-red g-font-weight-600 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50 g-mr-10 g-mb-15"
                               href="#">
                                  <span class="u-btn-skew__inner">
                                   <span class="glyphicon glyphicon-map-marker"></span>
                                      <?php echo __('Activity_place'); ?>：<?php echo $__ARCHIVES__['activity_place']; ?>
                                  </span>
                            </a>
                            <a class="btn  u-btn-skew u-btn-lightred g-font-weight-600 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50 g-mr-10 g-mb-15"
                               href="#">
                                  <span class="u-btn-skew__inner">
                                    <span class="glyphicon glyphicon-user"></span>
                                      <?php echo __('Activity_person'); ?>：<?php echo $__ARCHIVES__['activity_person']; ?>
                                  </span>
                            </a>
                        </ul>
                        <!-- S 归档 -->
                        </ul>
                    </div>
                    <div class="article-text">
                        <!-- S 正文 -->
                        <p>
                            <?php echo $__ARCHIVES__['content']; ?>
                        </p>
                        <!-- E 正文 -->
                    </div>

                    <ul class="p-1">
                        <?php
                               $urls= $__ARCHIVES__['activity_files'];
                               $urls=explode(',',$urls);
                           if($__ARCHIVES__['activity_files'] !=''): if(is_array($urls) || $urls instanceof \think\Collection || $urls instanceof \think\Paginator): $s = 0;$__LIST__ = is_array($urls) ? array_slice($urls,0,3, true) : $urls->slice(0,3, true); if( count($__LIST__)==0 ) : echo "这里没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($s % 2 );++$s;                                  $mysuffix=explode('.',$vo)[1];
                             if($mysuffix =="doc" or $mysuffix =="docx" or $mysuffix =="xlsx" or $mysuffix =="ppt"): ?>

                      <li> <span class=""> <?php echo __('Activity_files').$s; ?>： <a
                                href="https://view.officeapps.live.com/op/view.aspx?src=http://<?php echo $_SERVER['HTTP_HOST'].$vo; ?>">点击在线预览</a>
                            </span>
                      </li>
                        <?php else: ?>
                        <li><span class="">  <?php echo __('Activity_files').$s; ?>：<a
                            href="<?php echo $vo; ?>">点击在线预览</a>
                            </span>
                        </li>
                        <?php endif; ?> 　　
                        <?php endforeach; endif; else: echo "这里没有数据" ;endif; endif; ?>
                    </ul>

                    <div class="article-donate">
                        <a class="btn  u-btn-outline-red u-btn-hover-v2-2 g-letter-spacing-0_5 text-uppercase g-rounded-50 g-px-30 g-mr-10 g-mb-15 btn-like" data-action="vote" data-id="<?php echo $__ARCHIVES__['id']; ?>"
                           data-tag="archives" data-type="like" href="javascript:"><i class="fa fa-thumbs-up"></i>
                            点赞(<span><?php echo $__ARCHIVES__['likes']; ?></span>)</a>
                    </div>
                    <?php if($__ARCHIVES__['is_user_record']): ?>
                    <div class="article-donate">
                        <a class="btn u-btn-skew u-btn-red g-font-weight-600 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50 g-mr-10 g-mb-15" data-id="" href="/cms/d/archives?archives_id=<?php echo $__ARCHIVES__['id']; ?>&admin_id=<?php echo $__ARCHIVES__['admin_id']; ?>"><i class="fa fa-thumbs-up"></i>
                            提交心得体会</span></a>
                    </div>
                    <?php endif; ?>



                    <div class="entry-meta">
                        <ul>
                            <!-- S 归档 -->
                            <li><?php echo __('Article category'); ?>：<a href="<?php echo $__CHANNEL__['url']; ?>"><?php echo $__CHANNEL__['name']; ?></a></li>
                            <?php if($__ARCHIVES__['tagslist']): ?>
                            <li><?php echo __('Article tags'); ?>：<?php if(is_array($__ARCHIVES__['tagslist']) || $__ARCHIVES__['tagslist'] instanceof \think\Collection || $__ARCHIVES__['tagslist'] instanceof \think\Paginator): $i = 0; $__LIST__ = $__ARCHIVES__['tagslist'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tag): $mod = ($i % 2 );++$i;?><a class="tag"
                                                                                                        href="<?php echo $tag['url']; ?>"
                                                                                                        rel="tag"><?php echo $tag['name']; ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                            </li>
                            <?php endif; ?>
                            <li><?php echo __('Article views'); ?>：<span><?php echo $__ARCHIVES__['views']; ?></span> 次浏览</li>
                            <li><?php echo __('Post date'); ?>：<?php echo datetime($__ARCHIVES__['publishtime']); ?></li>
                            <li><?php echo __('Article url'); ?>：<a href="<?php echo $__ARCHIVES__['fullurl']; ?>" ><?php echo $__ARCHIVES__['fullurl']; ?></a></li>
                            <li> <?php echo __('Read_list'); ?>：<?php echo $__ARCHIVES__['haveread_list']; ?></li>
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

                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="panel panel-default" id="comments">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo __('Comment list'); ?>
                        <small>共有 <span><?php echo $__ARCHIVES__['comments']; ?></span> 条评论</small>
                    </h3>
                </div>
                <div class="panel-body">
                    <div id="comment-container">
    <!-- S 评论列表 -->
    <div id="commentlist">
        <?php $aid = $__ARCHIVES__['id']; $__COMMENTLIST__ = \addons\cms\model\Comment::getCommentList(["id"=>"comment","type"=>"archives","aid"=>"$aid","pagesize"=>"10"]); if(is_array($__COMMENTLIST__) || $__COMMENTLIST__ instanceof \think\Collection || $__COMMENTLIST__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__COMMENTLIST__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): $mod = ($i % 2 );++$i;?>
        <dl id="comment-<?php echo $comment['id']; ?>">
            <dt><a href="javascript:;" rel="nofollow"><img src='<?php echo $comment['user']['avatar']; ?>'/></a></dt>
            <dd>
                <div class="parent">
                    <cite><a href='javascript:;' rel='external nofollow'><?php echo $comment['user']['nickname']; ?></a></cite>
                    <small> <?php echo human_date($comment['createtime']); ?> <a href="javascript:;" data-id="<?php echo $comment['id']; ?>" title="@<?php echo $comment['user']['nickname']; ?> " class="reply">回复TA</a></small>
                    <p><?php echo $comment['content']; ?></p>
                </div>
            </dd>
            <div class="clearfix"></div>
        </dl>
        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__COMMENTLIST__; if($__COMMENTLIST__->isEmpty()): ?>
        <div class="loadmore loadmore-line loadmore-nodata"><span class="loadmore-tips">暂无评论</span></div>
        <?php endif; ?>
    </div>
    <!-- E 评论列表 -->

    <!-- S 评论分页 -->
    <div id="commentpager" class="text-center">
        <?php echo $__COMMENTLIST__->render(["type"=>"full"]); ?>
    </div>
    <!-- E 评论分页 -->

    <!-- S 发表评论 -->
    <div id="postcomment">
        <h3>发表评论 <a href="javascript:;">
            <small>取消回复</small>
        </a></h3>
        <form action="<?php echo addon_url('cms/comment/post'); ?>" method="post" id="postform">
            <?php echo token(); ?>
            <input type="hidden" name="type" value="archives"/>
            <input type="hidden" name="aid" value="<?php echo $__ARCHIVES__['id']; ?>"/>
            <input type="hidden" name="pid" id="pid" value="0"/>
            <div class="form-group">
                <textarea name="content" class="form-control" <?php if(!$user): ?>disabled placeholder="请登录后再发表评论" <?php endif; ?> id="commentcontent" cols="6" rows="5" tabindex="4"></textarea>
            </div>
            <?php if(!$user): ?>
            <div class="form-group">
                <a href="<?php echo url('index/user/login'); ?>" class="btn btn-primary">登录</a>
                <a href="<?php echo url('index/user/register'); ?>" class="btn btn-outline-primary">注册新账号</a>
            </div>
            <?php else: ?>
            <div class="form-group">
                <input name="submit" type="submit" id="submit" tabindex="5" value="提交评论(Ctrl+回车)" class="btn btn-primary"/>
                <span id="actiontips"></span>
            </div>
            <div class="checkbox">
                <label>
                    <input name="subscribe" type="checkbox" class="checkbox" tabindex="7" checked value="1"/> 有人回复时邮件通知我
                </label>
            </div>
            <?php endif; ?>
        </form>
    </div>
    <!-- E 发表评论 -->
</div>
                </div>
            </div>




            <?php else: ?>


            <!--                    无权查看哟-->

            <div class="article-text">
                <h2 class="text-danger text-center">您暂无查看权限</h2>
            </div>



            <?php endif; ?>

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