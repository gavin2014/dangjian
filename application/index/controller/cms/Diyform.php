<?php

namespace app\index\controller\cms;

use addons\cms\model\Modelx;
use app\admin\model\wis\Studyrecords;
use app\common\controller\Frontend;
use addons\cms\model\Diyform as DiyformModel;
use function Complex\add;
use function fast\e;
use think\Db;
use think\Exception;
use think\exception\PDOException;
use think\exception\ValidateException;

/**
 * 会员中心
 */
class Diyform extends Frontend
{
    protected $layout = 'default';
    protected $noNeedLogin = [];
    protected $noNeedRight = ['*'];

    public function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 表单
     */
    public function index()
    {
        $diyname = $this->request->param('diyname');
        if ($diyname && !is_numeric($diyname)) {
            $diyform = DiyformModel::getByDiyname($diyname);
        } else {
            $id = $diyname ? $diyname : $this->request->get('id', '');
            $diyform = DiyformModel::get($id);
        }
        if (!$diyform || $diyform['status'] == 'hidden') {
            $this->error(__('表单未找到'));
        }
        $fields = DiyformModel::getDiyformFields($diyform['id']);
        $this->view->assign('diyform', $diyform);
        $this->view->assign('fields', $fields);

        return $this->view->fetch();
    }


    /**
     * 我的发布
     * @return string
     * @throws \think\Exception
     * @throws \think\exception\DbException
     */
    public function mypost()
    {
        $archivesList = Db::name('wis_study_record')->where('user_id', $this->auth->id)
            ->order('id', 'desc')->select();
        $aList =[];
        foreach ($archivesList as $archives){
            $archives['title'] = Db::name('cms_archives')->where('id',$archives['archives_id'])->field('title')->find()['title'];
            array_push($aList,$archives);
        }
        $this->view->assign('archivesList', $aList);
        return $this->view->fetch();
    }



    public function edit(){
        $id = input('get.id');
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $result =Studyrecords::update($params);
                if ($result !== false) {
                    $this->success('编辑成功','mypost');
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
      $record =  Db::name('wis_study_record')->where('id',$id)->find();
      if ($record['user_id']== $this->auth->id){
          $record['filename'] = Db::name('attachment')->where('url',$record['experience_files'])->field('extparam')->find()['extparam'];
          $record['title'] =Db::name('cms_archives')->where('id',$record['archives_id'])->field('title')->find()['title'];
          $this->view->assign('row',$record);
          return $this->view->fetch();
      }
      else{
          return $this->error('数据非法');
      }


    }

    public function del(){
        $id = input('get.id');
        $record =  Db::name('wis_study_record')->where('id',$id)->find();
        if ($record['user_id']== $this->auth->id) {
            Db::name('wis_study_record')->where('id',$id)->delete();
            return $this->success('删除成功');
        }
        else
        {
            return $this->error('数据非法');
        }

    }

}
