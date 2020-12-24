<?php
/**
 * Created by 云中有鹿.
 * User: 陈云
 * Blog: http://blog.likecy.cn
 * Date: 2019-07-29
 * Time: 13:24
 */

namespace app\index\controller;


use app\common\controller\Frontend;
use app\index\model\WisActivitynotify;

class Notify extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
        return $this->view->fetch();
    }


    public function readNotify($ids =null){
        if ($ids==null){
            return $this->error('地址不正确');
        }

      $res =  WisActivitynotify::get($ids);
//        var_dump($res);
        $this->assign('web_connent', $res['activity_note']);
        return $this->view->fetch();

    }

}