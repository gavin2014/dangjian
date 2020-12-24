<?php

namespace addons\cms\controller;

use addons\cms\model\Archives as ArchivesModel;
use addons\cms\model\Channel;
use addons\cms\model\Modelx;
use think\Config;
use think\Db;
use think\Exception;

/**
 * 文档控制器
 * Class Archives
 * @package addons\cms\controller
 */
class Archives extends Base
{
    public function index()
    {

        if (!$this->auth->id){
                $this->redirect('/index/user/login?url='.$this->request->url());
        }
        $action = $this->request->post("action");
        if ($action && $this->request->isPost()) {
            return $this->$action();
        }
        $diyname = $this->request->param('diyname');
        if ($diyname && !is_numeric($diyname)) {
            $archives = ArchivesModel::getByDiyname($diyname);
        } else {
            $id = $diyname ? $diyname : $this->request->param('id', '');

            $old_read_list =  Db::name('cms_archives')->where('id',$id)->field('haveread_list')->find()['haveread_list'];
            $names=explode(',',$old_read_list);
             $has =in_array($this->auth->nickname,$names);
             if(!$has){
                 if ($old_read_list==null){
                     $new_read_list = $this->auth->nickname;
                 }else{
                     $new_read_list = $old_read_list.','.$this->auth->nickname;
                 }
                 Db::name('cms_archives')->where('id',$id)->update(['haveread_list'=>$new_read_list]);
             }
            $archives = ArchivesModel::get($id, ['channel']);
        }
        if (!$archives || ($archives['user_id'] != $this->auth->id && $archives['status'] != 'normal') || $archives['deletetime']) {
            $this->error(__('No specified article found'));
        }
        $channel = Channel::get($archives['channel_id']);
        if (!$channel) {
            $this->error(__('No specified channel found'));
        }
        $model = Modelx::get($channel['model_id'], [], true);
        if (!$model) {
            $this->error(__('No specified model found'));
        }
        $addon = db($model['table'])->where('id', $archives['id'])->find();
        if ($addon) {
            if ($model->fields) {
                $fieldsContentList = $model->getFieldsContentList($model->id);
                ArchivesModel::appendTextAttr($fieldsContentList, $addon);
            }
            $archives->setData($addon);
        } else {
            $this->error('No specified addon article found');
        }


//        var_dump($archives['admin_id']);
        $archives->user = Db::name('admin')->where('id',$archives['admin_id'])->find();
        $archives->setInc("views", 1);
        $this->view->assign("__ARCHIVES__", $archives);
        $this->view->assign("__CHANNEL__", $channel);
        Config::set('cms.title', $archives['title']);
        Config::set('cms.keywords', $archives['keywords']);
        Config::set('cms.description', $archives['description']);
        $template = preg_replace('/\.html$/', '', $channel['showtpl']);
        return $this->view->fetch('/' . $template);
    }

    /**
     * 赞与踩
     */
    public function vote()
    {
        if (!$this->auth->id){
           return $this->redirect('/');
        }
        $id = (int)$this->request->post("id");
        $type = trim($this->request->post("type", ""));
        if (!$id || !$type) {
            $this->error(__('Operation failed'));
        }
        $archives = ArchivesModel::get($id);
        if (!$archives || ($archives['user_id'] != $this->auth->id && $archives['status'] != 'normal') || $archives['deletetime']) {
            $this->error(__('No specified article found'));
        }
        $archives->where('id', $id)->setInc($type === 'like' ? 'likes' : 'dislikes', 1);
        $archives = ArchivesModel::get($id);
        $this->success(__('Operation completed'), null, ['likes' => $archives->likes, 'dislikes' => $archives->dislikes, 'likeratio' => $archives->likeratio]);
    }






    /**
     * 下载次数
     */
    public function download()
    {
        $id = (int)$this->request->post("id");
        if (!$id) {
            $this->error(__('Operation failed'));
        }
        $archives = ArchivesModel::get($id, ['model']);
        if (!$archives || ($archives['user_id'] != $this->auth->id && $archives['status'] != 'normal') || $archives['deletetime']) {
            $this->error(__('No specified article found'));
        }
        try {
            $table = $archives->getRelation('model')->getData('table');
            \think\Db::name($table)->where('id', $id)->setInc('downloads');
        } catch (Exception $e) {
            //
        }
        $this->success(__('Operation completed'), null);
    }
}
