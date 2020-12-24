<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use fast\Tree;
use function MongoDB\BSON\toJSON;
use think\Db;
use think\Lang;
use think\Request;

/**
 * Ajax异步请求接口
 * @internal
 */
class Ajax extends Frontend
{

    protected $noNeedLogin = ['lang','schoolselectpage','getUserGroup'];
    protected $noNeedRight = ['*'];
    protected $layout = '';

    /**
     * 加载语言包
     */
    public function lang()
    {
        header('Content-Type: application/javascript');
        $callback = $this->request->get('callback');
        $controllername = input("controllername");
        $this->loadlang($controllername);
        //强制输出JSON Object
        $result = jsonp(Lang::get(), 200, [], ['json_encode_param' => JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE]);
        return $result;
    }
    
    /**
     * 上传文件
     */
    public function upload()
    {
        return action('api/common/upload');
    }









    /**
     * Selectpage的实现方法
     *
     * 当前方法只是一个比较通用的搜索匹配,请按需重载此方法来编写自己的搜索逻辑,$where按自己的需求写即可
     * 这里示例了所有的参数，所以比较复杂，实现上自己实现只需简单的几行即可
     *
     */
    public function schoolselectpage()
    {
        $list= Db::name('wis_school')->select();
        $total = Db::name('wis_school')->count();
//        $list = [];
        //这里一定要返回有list这个字段,total是可选的,如果total<=list的数量,则会隐藏分页按钮
        return json(['list' => $list, 'total' => $total]);
    }


    public function getUserGroup(){
        $school_id =input("school");
        $admin_id = Db::name('wis_school')->where('id',$school_id)->field('admin_id')->find()['admin_id'];
        $list= Db::name('user_group')->where('admin_id',$admin_id)->field('id,name')->select();
//        var_dump($list);
        $total = Db::name('user_group')->where('admin_id',$admin_id)->count();
//        $list = [];
        //这里一定要返回有list这个字段,total是可选的,如果total<=list的数量,则会隐藏分页按钮
        return json(['list' => $list, 'total' => $total]);


    }




}
