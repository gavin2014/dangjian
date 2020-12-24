<?php

namespace addons\cms\controller;

use think\Config;

/**
 * 会员个人主页控制器
 */
class User extends Base
{

    public function index()
    {
        $config = get_addon_config('cms');
        if (!$config['userpage']) {
            $this->error("会员主页功能已关闭");
        }
        $user_id = $this->request->param('id');
        $user = \app\common\model\User::get($user_id);
        if (!$user) {
            $this->error("未找到指定会员");
        }
        if ($user['status'] == 'hidden') {
            $this->error("暂时无法浏览");
        }
        $pathArr = explode('/', $this->request->pathinfo());
        $type = end($pathArr);
        $type = is_numeric($type) ? 'archives' : $type;

        $pagesize = 10;
        $page = $this->request->get('page/d', 1);
        $page = max(1, $page);
        if ($type == 'archives') {
            $archivesList = \addons\cms\model\Archives::with(['user', 'channel'])
                ->where('user_id', $user['id'])
                ->where('status', '<>', 'hidden')
                ->order('id', 'desc')
                ->paginate($pagesize, false, ['type' => '\\addons\\cms\\library\\Bootstrap', 'var_page' => 'page', 'fragment' => '']);
            $this->view->assign('archivesList', $archivesList);
            $this->view->assign('__PAGELIST__', $archivesList);
            if ($this->request->isAjax()) {
                $this->success("", "", $this->view->fetch('common/list_item_ajax'));
            }
        } else {
            $commentList = \addons\cms\model\Comment::with(['user', 'archives'])
                ->where('user_id', $user['id'])
                ->where('status', '<>', 'hidden')
                ->order('id', 'desc')
                ->paginate($pagesize, false, ['type' => '\\addons\\cms\\library\\Bootstrap', 'var_page' => 'page', 'fragment' => '']);
            $this->view->assign('commentList', $commentList);
        }

        $title = $type == 'archives' ? 'TA的文章' : 'TA的评论';
        Config::set('cms.title', $title);

        $statistics = [
            'archives' => \addons\cms\model\Archives::where('user_id', $user['id'])->where('status', '<>', 'hidden')->count(),
            'comments' => \addons\cms\model\Comment::where('user_id', $user['id'])->where('status', '<>', 'hidden')->count(),
        ];
        $this->view->assign('statistics', $statistics);
        $this->view->assign('page', $page);
        $this->view->assign('type', $type);
        $this->view->assign('__USER__', $user);
        return $this->view->fetch("/user");
    }

}
