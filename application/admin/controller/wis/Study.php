<?php

namespace app\admin\controller\wis;

use app\common\controller\Backend;
use app\common\library\Email;
use think\Db;

/**
 * 政治学习
 *
 * @icon fa fa-circle-o
 */
class Study extends Backend
{
    
    /**
     * Study模型对象
     * @var \app\admin\model\wis\Study
     */
    protected $model = null;
    protected  $noNeedRight =['sendToEmail'];
    protected $dataLimit = 'personal'; //默认基类中为false，表示不启用，可额外使用auth和personal两个值
    protected $dataLimitField = 'admin_id'; //数据关联字段,当前控制器对应的模型表中必须存在该字段
    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\wis\Study;
        $this->view->assign("userTypeList", $this->model->getUserTypeList());
        $this->assignconfig("userTypeList", $this->model->getUserTypeList());
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

                $row->getRelation('cmsarchives')->visible(['title']);
            }
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }





    public function sendToEmail(){

//        return json( input('post.'));
//        $backData = input("post.");
//        return $this->success('邮件发送成功','',$backData);
        $admin_id = $this->auth->id;
//            $admin_id =8;
        $type =input('type');
        $type_text =input('type_text');
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
            $url = $this->request->domain()."/cms/a/".$subject_id.'?class='.rand();
            $subject_name =Db::name('cms_archives')->where('id',$subject_id)->field('title')->find()['title'];
            $subject_title = "智慧党建通知消息:".'课程：'.$subject_name.'--'.date("Y-m-d");
            $userinfo = $school_name.'--'.$group_name;
            $send['userinfo'] =$userinfo;
            $send['url']=$url;
            $send['type_text']=$type_text;
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
//            $backData['list'] =$userList;
            $backData['successful'] =$successful;
            $backData['fall'] = $fall;
//            $backData['url']=$url;
//            $backData['$subject_title']=$subject_title;
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
        $contents ='<section data-tplid="90681" data-tools="135编辑器"><section data-id="us694798" class="_135editor" style="border: 0px none; padding: 0px; box-sizing: border-box;"><section style="padding: 10px 15px; box-sizing: border-box;"><section style="width:100%;"><img style="width:50px; margin-left:-15px;" src="https://mpt.135editor.com/mmbiz_png/fgnkxfGnnkQkLJv64s12hZPl6lWeKCQagf3v4N3ojUEeIaqgxZicibSsz15FqsicWrnLibsmNGlFTEHLKlF58knoKw/0?wx_fmt=png" data-ratio="1" _src="https://mpt.135editor.com/mmbiz_png/fgnkxfGnnkQkLJv64s12hZPl6lWeKCQagf3v4N3ojUEeIaqgxZicibSsz15FqsicWrnLibsmNGlFTEHLKlF58knoKw/0?wx_fmt=png"></section><section style="padding: 20px; margin-top: -40px; background-color: rgb(250, 250, 250); box-shadow: rgb(204, 204, 204) 0px 0px 5px; -webkit-box-shadow: rgb(204, 204, 204) 0px 0px 5px; box-sizing: border-box;"><img style="width:100%; display:block" src="https://image.135editor.com/files/users/467/4674456/201908/UVV53THb_BMjs.jpg" data-ratio="0.7106598984771574" data-op="change" title="libarary.jpg" alt="libarary.jpg" _src="https://image.135editor.com/files/users/467/4674456/201908/UVV53THb_BMjs.jpg"></section></section></section><section data-role="paragraph" style="border: 0px none; padding: 0px; box-sizing: border-box;"><p><br></p></section><div style="text-align: center;">'.$info['title'].'</div><section data-role="paragraph"><p><br></p></section><p><span style="font-size: 14px;">尊敬'.$info['userinfo'].'---'.$info['type_text'].'---'.$user['nickname'].'：</span></p><section data-id="us694915" class="_135editor" style="border: 0px none; padding: 0px; box-sizing: border-box;"><section style="width:100%; text-align:center;"><img style="width:80%;" src="https://mpt.135editor.com/mmbiz_png/fgnkxfGnnkQkLJv64s12hZPl6lWeKCQah5E1YEUpjdE4nc129BLKZlgbdPfictmrtdqdTx2JqugPp356icCJpp3w/0?wx_fmt=png" data-ratio="0.08402203856749312" _src="https://mpt.135editor.com/mmbiz_png/fgnkxfGnnkQkLJv64s12hZPl6lWeKCQah5E1YEUpjdE4nc129BLKZlgbdPfictmrtdqdTx2JqugPp356icCJpp3w/0?wx_fmt=png"></section></section><section data-role="paragraph" style="border: 0px none; padding: 0px; box-sizing: border-box;"><p><a href="'.$info['url'].'" _href="'.$info['title'].'" target="_blank" style="max-inline-size: 100%; margin: 0px; padding: 0px; color: rgb(96, 127, 166); text-decoration: none; caret-color: rgb(255, 0, 0); font-size: 16px; font-weight: normal; text-align: center; box-sizing: border-box !important; outline: none 0px !important; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;, Arial, sans-serif;"></a></p><p style="max-inline-size: 100%; margin: 0px; padding: 0px; clear: both; caret-color: rgb(255, 0, 0); color: rgb(0, 0, 0); font-size: 16px; font-weight: normal; text-decoration: none; box-sizing: border-box !important; outline: none 0px !important; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;, Arial, sans-serif;"><span style="max-inline-size: 100%; margin: 0px; padding: 0px; box-sizing: border-box !important; outline: none 0px !important; font-size: 14px;">&nbsp; &nbsp; &nbsp; &nbsp;您的-课程'.$info['title'].'&nbsp;</span></p><p style="max-inline-size: 100%; margin: 0px; padding: 0px; clear: both; caret-color: rgb(255, 0, 0); color: rgb(0, 0, 0); font-size: 16px; font-weight: normal; text-decoration: none; box-sizing: border-box !important; outline: none 0px !important; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;, Arial, sans-serif;"><span style="max-inline-size: 100%; margin: 0px; padding: 0px; box-sizing: border-box !important; outline: none 0px !important; font-size: 14px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;已经发布,点击下方链接进行学习：<br style="max-inline-size: 100%; margin: 0px; padding: 0px; box-sizing: border-box !important; outline: none 0px !important;"></span></p><p style="text-align: center;"><a href="'.$info['url'].'" _href="'.$info['url'].'" target="_blank" style="max-inline-size: 100%; margin: 0px; padding: 0px; color: rgb(96, 127, 166); text-decoration: none; caret-color: rgb(255, 0, 0); font-size: 16px; font-weight: normal; text-align: center; box-sizing: border-box !important; outline: none 0px !important; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;, Arial, sans-serif;">课程地址</a><span style="caret-color: rgb(255, 0, 0); color: rgb(0, 0, 0); font-size: 16px; font-weight: normal; text-align: center; text-decoration: none; display: inline !important; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;, Arial, sans-serif;"></span></p><p style="text-align: center;"><br></p><p style="text-align: center;"><br></p><p style="text-align: center;"><br></p><p style="text-align: center;"><img src="https://mpt.135editor.com/mmbiz_png/fgnkxfGnnkQkLJv64s12hZPl6lWeKCQa8BS0332aicvNTbfqLGj4MPrtmA52QguwZMMKQGmYayWso9sGDltYVsw/0?wx_fmt=png" data-ratio="0.08571428571428572" _src="https://mpt.135editor.com/mmbiz_png/fgnkxfGnnkQkLJv64s12hZPl6lWeKCQa8BS0332aicvNTbfqLGj4MPrtmA52QguwZMMKQGmYayWso9sGDltYVsw/0?wx_fmt=png" style="max-inline-size: 100%; margin: 0px auto; padding: 0px; max-width: 100%; caret-color: rgb(255, 0, 0); color: rgb(0, 0, 0); font-size: 16px; font-weight: normal; text-decoration: none; width: 150px; display: block; box-sizing: border-box !important; outline: none 0px !important; height: auto !important; font-family: 微软雅黑, &quot;Microsoft YaHei&quot;, Arial, sans-serif;"></p><p style="text-align: right;">---来自 &nbsp;'.$info['userinfo'].'</p></section><section data-role="paragraph" style="border: 0px none; padding: 0px; box-sizing: border-box;"><p><br></p></section><section data-role="paragraph" style="border: 0px none; padding: 0px; box-sizing: border-box;"><p><br></p></section></section><p></p>';
        $email = new Email();
        $result = $email
            ->to($user['email'])
            ->subject($subject)
            ->message($contents)
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
