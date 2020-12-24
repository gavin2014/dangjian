<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:117:"/Users/chenyun/Documents/项目/信息工程学院-智慧党建系统/addons/signin/view/hook/user_sidenav_after.html";i:1564376223;}*/ ?>
<ul class="list-group">
    <li class="list-group-item <?php echo $controllername =='signin'?'active':''; ?>"><a href="<?php echo url('index/signin/index'); ?>"><i class="fa fa-map-signs fa-fw"></i> <?php echo __('每日签到'); ?></a></li>
</ul>