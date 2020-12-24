<?php

namespace app\admin\controller\wis;

use app\common\controller\Backend;
use fast\Random;
use function PHPSTORM_META\elementType;
use think\Db;
use think\Exception;
use think\exception\PDOException;
use think\exception\ValidateException;

/**
 * 活动记录
 *
 * @icon fa fa-circle-o
 */
class Activityrecord extends Backend
{
    
    /**
     * Activityrecord模型对象
     * @var \app\admin\model\wis\Activityrecord
     */
    protected $model = null;
    protected $dataLimit = 'personal'; //默认基类中为false，表示不启用，可额外使用auth和personal两个值
    protected $dataLimitField = 'admin_id'; //数据关联字段,当前控制器对应的模型表中必须存在该字段

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\wis\Activityrecord;

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
                    ->with(['wisactivitynotify'])
                    ->where($where)
                    ->order($sort, $order)
                    ->count();

            $list = $this->model
                    ->with(['wisactivitynotify'])
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

            foreach ($list as $row) {
                $archives_id = Db::name('cms_notify')->where('id',$row->notify_id)->field('id')->find()['id'];
                $row['title'] =Db::name('cms_archives')->where('id',$archives_id)->field('title')->find()['title'];
                $row->getRelation('wisactivitynotify')->visible(['activity_theme','activity_time','activity_place','activity_person','activity_files','content','read_list']);
            }
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }


    /**
     * 添加
     */
    public function add($notify_id = NULL)
    {

        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                $result = false;
                Db::startTrans();
                try {
                    $params['notify_id'] = $notify_id;
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
                    if (Db::name('cms_notify')->where('id',$notify_id)->update(['progress_state'=>'hidden'])){
                        $this->success();
                    }
                    else $this->error();
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
//        $row['notify_id']=(int)$ids;
        if ($notify_id){
            $res= $this->model->where('notify_id',$notify_id)->find();
            if ($res){
                $this->redirect('edit',array('notify_id'=>$notify_id));
            }
            $this->view->assign("archives_id",$notify_id);
        }
        return $this->view->fetch();

    }

    /**
     * 编辑
     */
    public function edit($ids = NULL)
    {
        $notify = input('notify_id');
        if ($notify) {
//            $archives_id = Db::name('cms_notify')->where('id',$notify)->field('id')->find()['id'];
            $row = $this->model->get(['notify_id' => (int)$notify]);
            $this->view->assign("archives_id",$notify);
        } else{
            $row = $this->model->get($ids);
            $this->view->assign("archives_id",$row->notify_id);
//            $archives_id = Db::name('cms_notify')->where('activity_id',$row->notify_id)->field('id')->find()['id'];
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $result = false;
                Db::startTrans();
                try {
                  if ($notify)
                    $params['notify_id'] = $notify;
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
//        var_dump($row);
        return $this->view->fetch();

    }
}
