<?php

namespace app\admin\controller\user;

use app\common\controller\Backend;
use think\Db;
use think\Exception;
use think\exception\PDOException;
use think\exception\ValidateException;

/**
 * 会员组管理
 *
 * @icon fa fa-users
 */
class Group extends Backend
{


    /**
     * @var \app\admin\model\UserGroup
     */
    protected $model = null;
    protected $dataLimit = 'personal'; //默认基类中为false，表示不启用，可额外使用auth和personal两个值
    protected $dataLimitField = 'admin_id'; //数据关联字段,当前控制器对应的模型表中必须存在该字段
    protected $noNeedLogin =['selectToAll'];
    protected $noNeedRight =['selectToAll'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('UserGroup');
        $this->view->assign("statusList", $this->model->getStatusList());
    }

    public function add()
    {
        $nodeList = \app\admin\model\UserRule::getTreeList();
        $this->assign("nodeList", $nodeList);
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            $params['rules'] ="1,2,3,4,5,6,7,8,9,10,11,12";
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $result = $this->model->allowField(true)->save($params);
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }

    public function edit($ids = NULL)
    {
        $row = $this->model->get($ids);
        if (!$row)
            $this->error(__('No Results were found'));
        $rules = explode(',', $row['rules']);
        $nodeList = \app\admin\model\UserRule::getTreeList($rules);
        $this->assign("nodeList", $nodeList);
        return parent::edit($ids);
    }


    public function select(){

        $admin_id = $this->auth->id;
        if ($this->auth->isSuperAdmin()){//超级管理员
            $list= Db::name('user_group')->select();
            $total = Db::name('user_group')->count();
        }else{
            $list= Db::name('user_group')->where('admin_id',$admin_id)->select();
            $total = Db::name('user_group')->where('admin_id',$admin_id)->count();
        }
        if (!empty($this->request->param('searchValue'))){
            $where2 = ['id'=>['in', $this->request->param('searchValue')]];
            if($this->auth->isSuperAdmin()){
                $list= Db::name('user_group')->where($where2)->select();
                $total = Db::name('user_group')->where($where2)->count();
            }else{
                $list= Db::name('user_group')->where('admin_id',$admin_id)->where($where2)->select();
                $total = Db::name('user_group')->where('admin_id',$admin_id)->where($where2)->count();
            }
        } //编辑时只返回默认值
        //这里一定要返回有list这个字段,total是可选的,如果total<=list的数量,则会隐藏分页按钮
        return json(['list' => $list, 'total' => $total]);
    }



    public function selectToAll(){

//        $admin_id = $this->auth->id;
//        if ($this->auth->isSuperAdmin()){//超级管理员
//            $list= Db::name('user_group')->select();
//            $total = Db::name('user_group')->count();
//        }else{
//            $list= Db::name('user_group')->where('admin_id',$admin_id)->select();
//            $total = Db::name('user_group')->where('admin_id',$admin_id)->count();
//        }
        if (!empty($this->request->param('searchValue'))){

            $where2 = ['id'=>['in', $this->request->param('searchValue')]];
            $list= Db::name('user_group')->where($where2)->select();
            $total = Db::name('user_group')->where($where2)->count();
//            if($this->auth->isSuperAdmin()){
//                $list= Db::name('user_group')->where($where2)->select();
//                $total = Db::name('user_group')->where($where2)->count();
//            }else{
//                $list= Db::name('user_group')->where('admin_id',$admin_id)->where($where2)->select();
//                $total = Db::name('user_group')->where('admin_id',$admin_id)->where($where2)->count();
//            }
        } //编辑时只返回默认值
        //这里一定要返回有list这个字段,total是可选的,如果total<=list的数量,则会隐藏分页按钮
        return json(['list' => $list, 'total' => $total]);
    }


}
