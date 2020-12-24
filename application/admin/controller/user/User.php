<?php

namespace app\admin\controller\user;

use app\common\controller\Backend;
use think\Db;
use think\Exception;
use think\exception\PDOException;
use think\exception\ValidateException;

/**
 * 会员管理
 *
 * @icon fa fa-user
 */
class User extends Backend
{

    protected $relationSearch = true;

    /**
     * @var \app\admin\model\User
     */
    protected $model = null;
//    protected $dataLimit = 'personal'; //默认基类中为false，表示不启用，可额外使用auth和personal两个值
//    protected $dataLimitField = 'group_id'; //数据关联字段,当前控制器对应的模型表中必须存在该字段

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('User');
        $this->view->assign("userTypeList", $this->model->getUserTypeList());
    }

    /**
     * 查看
     */
    public function index()
    {

//        var_dump($group_id);
//        设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {

            $admin_id = $this->auth->id;
            $group_id = Db::name('admin')->where('id',$admin_id)->field('user_group_id')->find()['user_group_id'];
            $where2 = ['group_id'=>['in', $group_id]];
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

           if($this->auth->id==1){
               $total = $this->model
                   ->with('group')
                   ->where($where)
                   ->order($sort, $order)
                   ->count();
               $list = $this->model
                   ->with('group')
                   ->where($where)
                   ->order($sort, $order)
                   ->limit($offset, $limit)
                   ->select();
           }else{
               $total = $this->model
                   ->with('group')
                   ->where($where)
                   ->where($where2)
                   ->order($sort, $order)
                   ->count();
               $list = $this->model
                   ->with('group')
                   ->where($where)
                   ->where($where2)
                   ->order($sort, $order)
                   ->limit($offset, $limit)
                   ->select();
           }


            foreach ($list as $k => $v) {
                $v->hidden(['password', 'salt']);
                $v['school_id'] = Db::name('wis_school')->where('id',$v['school_id'])->find()['college_name'];
            }
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }

//        var_dump($this->auth->id);
        return $this->view->fetch();
    }

    /**
     * 编辑
     */
    public function edit($ids = NULL)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validateFailException(true)->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
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
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }

}
