<?php

namespace app\admin\controller\wis;

use app\admin\model\cms\Channel;
use app\common\controller\Backend;
use fast\Pinyin;
use think\Db;
use think\Exception;
use think\exception\PDOException;
use think\exception\ValidateException;

/**
 * 二级学院
 *
 * @icon fa fa-circle-o
 */
class School extends Backend
{
    
    /**
     * School模型对象
     * @var \app\admin\model\wis\School
     */
    protected $model = null;
    protected $noNeedLogin =['*'];
    protected $noNeedRight =['*'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\wis\School;

    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */

    /**
     * 添加
     */
    public function add()
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
                    $data['name'] =$params['college_name'];
                    $data['diyname'] = Pinyin::get($params['college_name']);
                    $data['channeltpl']='channel_news.html';
                    $data['listtpl'] ='list_news.html';
                    $data['showtpl'] ='show_notify.html';
                    $data['pagesize'] =10;
                    $data['iscontribute']=1;
                    $data['isnav'] =1;
                    $data['status'] ='normal';
                    $data['model_id']=5;
                    $data['parent_id']=10;
                    $data['type']='list';
                    $notifyres = Channel::create($data);
                    $data['diyname'] = Pinyin::get($params['college_name'].'study');
                    $data['showtpl'] ='show_political_study.html';
                    $data['parent_id']=30;
                    $data['model_id']=6;
                    $studyres= Channel::create($data);
                    $params['studychannel_id'] =$studyres->id;
                    $params['notifychannel_id'] =$notifyres->id;
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
                    ->with(['admin'])
                    ->where($where)
                    ->order($sort, $order)
                    ->count();

            $list = $this->model
                    ->with(['admin'])
                    ->where($where)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

            foreach ($list as $row) {
                
                $row->getRelation('admin')->visible(['nickname']);
            }
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }


    public function select(){

        $list= Db::name('wis_school')->select();
        $total = Db::name('wis_school')->count();
        if (!empty($this->request->param('searchValue'))){
            $where2 = ['id'=>['in', $this->request->param('searchValue')]];

                $list = Db::name('wis_school')->where($where2)->select();
                $total = Db::name('wis_school')->where($where2)->count();
        } //编辑时只返回默认值
        //这里一定要返回有list这个字段,total是可选的,如果total<=list的数量,则会隐藏分页按钮
        return json(['list' => $list, 'total' => $total]);


    }
}
