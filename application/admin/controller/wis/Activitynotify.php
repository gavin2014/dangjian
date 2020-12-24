<?php

namespace app\admin\controller\wis;

use app\admin\model\wis\Activitynotify as ActivitynotifyModel;
use app\common\controller\Backend;
use app\common\library\Email;
use think\Db;

/**
 * 组织生活活动通知
 *
 * @icon fa fa-circle-o
 */
class Activitynotify extends Backend
{
    
    /**
     * Activitynotify模型对象
     * @var \app\admin\model\wis\Activitynotify
     */
    protected $model = null;
    protected $dataLimit = 'personal'; //默认基类中为false，表示不启用，可额外使用auth和personal两个值
    protected $dataLimitField = 'admin_id'; //数据关联字段,当前控制器对应的模型表中必须存在该字段
    protected $noNeedLogin =['sendToshow','sendToEmail','test'];
    protected $noNeedRight =['sendToEmail','test'];
    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\wis\Activitynotify;
        $this->view->assign("progressStateList", $this->model->getProgressStateList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */



    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax())
        {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField'))
            {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->with(['cmsarchives'])
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->with(['cmsarchives'])
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            foreach ($list as $row) {

                $row->getRelation('cmsarchives')->visible(['title','haveread_list']);
            }
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    public function sendToshow($ids=null){

        $res= ActivitynotifyModel::get($ids);

        return json($res);


    }

    public function sendToEmail(){
        $admin_id = $this->auth->id;
//            $admin_id =8;
        $type =input('type');
        $subject_id = input('subject_id');
        $admin = Db::name("admin")->where('id',$admin_id)->field(['user_group_id','school_id'])->find();
        $group_id =$admin['user_group_id'];
        $school_name_id =$admin['school_id'];
        $condition =[
            'group_id'=>$group_id,
            'user_type'=>$type,
            'status'=>'normal'
        ];
        $userList = Db::name('user')->where($condition)->field(['nickname,email'])->select();
        if ($userList){

            $group_name =Db::name('user_group')->where('id',$group_id)->field('name')->find()['name'];
            $school_name =Db::name('wis_school')->where('id',$school_name_id)->field('college_name')->find()['college_name'];
            $url = $this->request->domain()."/cms/a/".$subject_id.'?essay='.rand();
            $subject_name =Db::name('cms_archives')->where('id',$subject_id)->field('title')->find()['title'];
            $subject_title = "智慧党建通知消息:".'活动：'.$subject_name.'-'.date("Y-m-d");
            $userinfo = $school_name.'--'.$group_name.'--';
            $send['userinfo'] =$userinfo;
            $send['url']=$url;
            $send['title'] =$subject_name;
            static $successful=0;
            static $fall=0;
            foreach ($userList as $user){
               $res = $this->sendEmail($subject_title,$send,$user);
               if ($res){
                   $successful++;
               }else{
                   $fall++;
               }
            }
            $backData['list'] =$userList;
            $backData['successful'] =$successful;
            $backData['fall'] = $fall;
            $backData['url']=$url;
            $backData['$subject_title']=$subject_title;
            return $this->success('邮件发送成功','',$backData);
//            var_dump($backData);
                //群发邮件
        }else{
            return $this->error('分组暂无人员');
        }

    }




    public function test(){
        if ($this->request->isAjax()) {
            $data= input("post.");
            $this->success("Ajax请求成功", '',$data);
//            return json($data);
        }
    }





    /**
     * 发送测试邮件
     * @internal
     */
    protected function sendEmail($subject,$info,$user)
    {

        $content ='<section data-tplid="93137" data-tools="135编辑器"><section data-id="us2322706" class="_135editor" style="border: 0px none; box-sizing: border-box;"><section style="background-image: url(https://image2.135editor.com/cache/remote/aHR0cHM6Ly9tbWJpei5xbG9nby5jbi9tbWJpel9wbmcvbGRGYUJOU2t2SGhGOGhUaWJrMHhLdEo2OU8wREZTMUZlSmt6bUFncUE1dEtMbU5ydWJZaWI4N0c0Q2tBaWFpYTh4eUNtYldIOXIzaWNpYXJJV2NVaWFEMEdpYXdrZy8w);background-size:100% 100%;background-repeat:no-repeat;width:100%;"><section data-id="us2316541" class="_135editor" style="border: 0px none; box-sizing: border-box;"><section data-role="paragraph" style="border: 0px none; box-sizing: border-box;"><p><br></p></section><section data-id="us2322911" style="border: 0px none; box-sizing: border-box;" class="_135editor"></section><section data-id="us2323101" style="border: 0px none; box-sizing: border-box;" class="_135editor"><section style="position: static; border: 0px none; box-sizing: border-box;"><section class="" style="text-align: center; margin: 20px 0% 10px; position: static;max-width:90%;margin-left:5%;margin-right:5%;"><section class="" style="display: inline-block; border: 1px solid rgb(62, 62, 62); border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; background-color: rgb(242, 222, 195); box-sizing: border-box;"><section style="position: static;"><section class="" style="margin: -5px 0% 3px; position: static;background-color:#ffffff;transform: translate3d(-3px, 0px, 0px);-webkit-transform: translate3d(-3px, 0px, 0px);-moz-transform: translate3d(-3px, 0px, 0px);-ms-transform: translate3d(-3px, 0px, 0px);-o-transform: translate3d(-3px, 0px, 0px);"><section class="" style="display: inline-block; padding: 5px; border: 1px solid rgb(62, 62, 62); border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; box-sizing: border-box;"><section style="display: flex;justify-content: center;"><section style="width: 10px; height: 10px; background-color: rgb(242, 222, 195); border-top-left-radius: 50%; border-top-right-radius: 50%; border-bottom-right-radius: 50%; border-bottom-left-radius: 50%; border: 1px solid rgb(62, 62, 62); display: inline-block; margin-left: -10px; margin-top: 7px; box-sizing: border-box;"></section><section class="" style="position: static;"><section class="135brush" style="text-align: center; font-size: 14px; padding-right: 5px; padding-left: 5px; box-sizing: border-box;" data-brushtype="text"><p>'.$info['title'].'</p></section></section></section></section></section></section></section></section></section></section><section data-role="paragraph" style="border: 0px none; box-sizing: border-box;"><p><br></p></section></section><section data-role="paragraph" style="border: 0px none; box-sizing: border-box;"><p><br></p></section><section data-id="us2318707" class="_135editor" style="border: 0px none; box-sizing: border-box;"><section class="" style="text-align: center;"><section class="" style="display: inline-block; border: 1px solid rgb(62, 62, 62); border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; background-color: rgb(242, 222, 195); width: 90%; box-sizing: border-box;"><section style="position: static;"><section class="" style="margin: -5px 0% 3px; position: static;background-color:#ffffff;transform: translate3d(-3px, 0px, 0px);-webkit-transform: translate3d(-3px, 0px, 0px);-moz-transform: translate3d(-3px, 0px, 0px);-ms-transform: translate3d(-3px, 0px, 0px);-o-transform: translate3d(-3px, 0px, 0px);"><section class="" style="display: inline-block; padding: 5px; border: 1px solid rgb(62, 62, 62); border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; width: 100%; box-sizing: border-box;"><section style=""><section style="width: 20px;height: 20px;background-color:#404040;display: inline-block;margin-right: -6px;margin-top: -6px;z-index: 999;float: right;"><section style="width: 18px; height: 15px; background-color: rgb(242, 222, 195); margin-top: 4px; border-top-width: 1px; border-top-style: solid; border-top-color: black; margin-left: 2px; box-sizing: border-box; background-position: initial initial; background-repeat: initial initial;"></section><section style="width: 0px; height: 0px; border-width: 20px 0px 0px 20px; border-style: solid; border-color: transparent transparent transparent black; margin-top: -19px; box-sizing: border-box;"></section><section style="width: 0px; height: 0px; border-width: 17px 0px 0px 17px; border-style: solid; border-color: transparent transparent transparent white; margin-top: -18px; margin-left: 1px; box-sizing: border-box;"></section></section><section class="" style="position: static;"><section class="135brush" style="text-align: center; font-size: 14px; padding-right: 5px; padding-left: 5px; letter-spacing: 1.5px; color: rgb(63, 63, 63); box-sizing: border-box;"><p>'.$info['userinfo'].$user['nickname'].':</p><p>您好:</p><p><br></p></section></section></section></section></section></section></section></section></section><section data-role="paragraph" style="border: 0px none; box-sizing: border-box;"><p><br></p></section><section data-id="us2319837" class="_135editor" style="border: 0px none; box-sizing: border-box;"><section class="" style="text-align: center;"><section style="position: static;"><section class="" style="display: inline-block; padding: 5px; border-top-width: 1px; border-right-width: 1px; border-left-width: 1px; border-style: solid solid none; border-top-color: rgb(62, 62, 62); border-right-color: rgb(62, 62, 62); border-left-color: rgb(62, 62, 62); width: 90%; background-color: rgb(255, 255, 255); box-sizing: border-box;"><section style=""><section style="width: 20px;height: 20px;background-color: #e4e4e4;display: inline-block;margin-right: -6px;margin-top: -6px;z-index: 999;float: right;"><section style="width: 0px; height: 0px; border-width: 20px 0px 0px 20px; border-style: solid; border-color: transparent transparent transparent black; box-sizing: border-box;"></section><section style="width: 0px; height: 0px; border-width: 17px 0px 0px 17px; border-style: solid; border-color: transparent transparent transparent white; margin-top: -18px; margin-left: 1px; box-sizing: border-box;"></section></section><section style="width: 20%; height: 1px; border-top-width: 1px; border-top-style: solid; border-top-color: black; display: inline-block; box-sizing: border-box;"></section><section class="" style="position: static;margin-top:10px;"><section style="font-size: 16px; font-weight: bold; padding-right: 5px; padding-left: 5px; box-sizing: border-box;"><p><span style="color: #808080;">智慧党建-</span><span style="color:#91b859">'.$info['title'].'</span></p><p><span style="color: #808080;">已经发布，请点击下方连接访问打卡：</span></p><p><span style="color: #808080;"><a href="'.$info['url'].'" target="_blank" _href="'.$info['url'].'">点击打卡</a><br></span></p><p><br></p></section></section></section></section></section><section style="width:95%;margin-left:auto;margin-right:auto;margin-top:-30px;"><img src="https://image2.135editor.com/cache/remote/aHR0cHM6Ly9tbWJpei5xbG9nby5jbi9tbWJpel9wbmcvbGRGYUJOU2t2SGlhY1RZaDNiNWlhVERBb0tOQkw1alF5eXRVeGdRSHlac3pndGxRbzhSZlVjcmxWM3RVTjdaZkdhQnU1VUVTQldDbTFTbmRMQjBNTHNwQS8w" style="width:100%;" data-ratio="1" _src="https://image2.135editor.com/cache/remote/aHR0cHM6Ly9tbWJpei5xbG9nby5jbi9tbWJpel9wbmcvbGRGYUJOU2t2SGlhY1RZaDNiNWlhVERBb0tOQkw1alF5eXRVeGdRSHlac3pndGxRbzhSZlVjcmxWM3RVTjdaZkdhQnU1VUVTQldDbTFTbmRMQjBNTHNwQS8w"></section></section></section><section data-role="paragraph" style="border: 0px none; box-sizing: border-box;"><p><br></p></section><section data-id="us2320023" class="_135editor" style="border: 0px none; box-sizing: border-box;"><section style="font-size: 16px;text-align: center;letter-spacing:1.5px;"><p>- END -</p></section></section><section data-role="paragraph" style="border: 0px none; box-sizing: border-box;"><p><br></p></section><section data-id="us2320122" style="border: 0px none; box-sizing: border-box;" class="_135editor"><section data-role="paragraph" style="border: 0px none; box-sizing: border-box;"><p><br></p></section><section data-id="us2320109" class="_135editor" style="border: 0px none; box-sizing: border-box;"><section style="font-size: 16px;text-align: center;background: url(https://image2.135editor.com/cache/remote/aHR0cHM6Ly9tbWJpei5xbG9nby5jbi9tbWJpel9wbmcvbGRGYUJOU2t2SGlhY1RZaDNiNWlhVERBb0tOQkw1alF5eXBOWVlhWmJ5bHF2ekNWWlR6N0hjMk9id0w5MEFEUGljZFhXT1g1V3VzRWlhUkVoR1pYclZlZVdRLzA=);background-size: 100%;width:100px;margin: auto;background-repeat: no-repeat;line-height: 60px;"></section></section><section data-role="paragraph" style="border: 0px none; box-sizing: border-box;"><p><br></p></section><section data-role="paragraph" style="border: 0px none; box-sizing: border-box;"><p><br></p></section></section></section></section><section data-role="paragraph" style="border: 0px none; box-sizing: border-box;"><p><br></p></section></section><p></p>';

        $email = new Email();
        $result = $email
            ->to($user['email'])
            ->subject($subject)
            ->message($content)
            ->send();
        if ($result) {
            return true;
//            $this->success();
        } else {
            return false;
//            $this->error($email->getError());
        }
    }

}
