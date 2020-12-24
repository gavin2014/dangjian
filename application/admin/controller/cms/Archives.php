<?php

namespace app\admin\controller\cms;

use app\admin\model\cms\Channel;
use app\admin\model\cms\ChannelAdmin;
use app\admin\model\cms\Modelx;
use app\admin\model\wis\Study;
use app\common\controller\Backend;
use fast\Tree;
use think\Db;
use think\db\Query;
use think\Exception;
use think\exception\ErrorException;
use think\exception\PDOException;
use think\exception\ValidateException;

/**
 * 内容表
 *
 * @icon fa fa-file-text-o
 */
class Archives extends Backend
{

    /**
     * Archives模型对象
     */
    protected $model = null;
    protected $noNeedRight = ['get_channel_fields', 'check_element_available','addstudy'];
    protected  $noNeedLogin =['addnotify','addstudy'];
    protected $channelIds = [];
    protected $isSuperAdmin = false;
    protected $searchFields = 'id,title';
    protected $dataLimit = 'personal'; //默认基类中为false，表示不启用，可额外使用auth和personal两个值
    protected $dataLimitField = 'admin_id'; //数据关联字段,当前控制器对应的模型表中必须存在该字段


    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\cms\Archives;
        $cms = get_addon_config('cms');

        //是否超级管理员
        $this->isSuperAdmin = $this->auth->isSuperAdmin();
        $channelList = [];
        $disabledIds = [];
        $all = collection(Channel::order("weigh desc,id desc")->select())->toArray();

        //允许的栏目
        $this->channelIds = $this->isSuperAdmin || !$cms['channelallocate'] ? Channel::column('id') : ChannelAdmin::getAdminChanneIds();
        $parentChannelIds = Channel::where('id', 'in', $this->channelIds)->column('parent_id');
        foreach ($all as $k => $v) {
            $state = ['opened' => true];
            if ($v['type'] != 'list') {
                $disabledIds[] = $v['id'];
            }
            if ($v['type'] == 'link') {
                $state['checkbox_disabled'] = true;
            }
            if (!$this->isSuperAdmin) {
                if (($v['type'] != 'list' && !in_array($v['id'], $parentChannelIds)) || ($v['type'] == 'list' && !in_array($v['id'], $this->channelIds))) {
                    unset($all[$k]);
                    continue;
                }
            }
            $channelList[] = [
                'id'     => $v['id'],
                'parent' => $v['parent_id'] ? $v['parent_id'] : '#',
                'text'   => __($v['name']),
                'type'   => $v['type'],
                'state'  => $state
            ];
        }
        $school_id = Db::name('admin')->where('id',$this->auth->id)->find()['school_id'];
        $wis_school = Db::name('wis_school')->where('id',$school_id)->field(['studychannel_id','notifychannel_id'])->find();
        $study_id =$wis_school['studychannel_id'];
        $channel_name_id =$wis_school['notifychannel_id'];
        $this->assignconfig('study_id',$study_id);
        $this->assignconfig('channel_name_id',$channel_name_id);
        $tree = Tree::instance()->init($all, 'parent_id');
        $channelOptions = $tree->getTree(0, "<option model='@model_id' value=@id @selected @disabled>@spacer@name</option>", '', $disabledIds);
        $this->view->assign('channelOptions', $channelOptions);
        $this->assignconfig('channelList', $channelList);

        $this->assignconfig("flagList", $this->model->getFlagList());
        $this->view->assign("flagList", $this->model->getFlagList());
        $this->view->assign("statusList", $this->model->getStatusList());
        $this->view->assign("userTypeList", $this->model->getUserTypeList());
        $this->view->assign('activityTypeList',$this->model->getActivityTypeList());
        $this->assignconfig('cms', ['archiveseditmode' => $cms['archiveseditmode']]);
    }


    //增加互斥量保证每次更新数据后admin—id依然存在
    public function editToself($ids = null)
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
                        //互斥锁保证后台多用户数据独立性
                    if (Db::name('cms_notify')->where('id',$ids)->find()){
                        if (Db::name('wis_activityrecord')->where('notify_id',$ids)->find()){
                            Db::name('cms_notify')->where('id',$ids)->update(['admin_id'=>$this->auth->id,'progress_state'=>'hidden']);
                        }else{
                            Db::name('cms_notify')->where('id',$ids)->update(['admin_id'=>$this->auth->id]);
                        }
                    }
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        return $this->view->fetch('edit');
    }
    /**
     * 查看
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            $this->relationSearch = true;
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            if (!$this->auth->isSuperAdmin()) {
                $this->model->where('channel_id', 'in', $this->channelIds);
            }
            $total = $this->model
                ->with('Channel')
                ->where($where)
                ->order($sort, $order)
                ->count();
            if (!$this->auth->isSuperAdmin()) {
                $this->model->where('channel_id', 'in', $this->channelIds);
            }
            $list = $this->model
                ->with('Channel')
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }

        $modelList = \app\admin\model\cms\Modelx::all();
        $this->view->assign('modelList', $modelList);
        return $this->view->fetch();
    }

    /**
     * 副表内容
     */
    public function content($model_id = null)
    {
        $model = \app\admin\model\cms\Modelx::get($model_id);
        if (!$model) {
            $this->error('未找到对应模型');
        }
        $fieldsList = \app\admin\model\cms\Fields::where('model_id', $model['id'])->where('type', '<>', 'text')->select();
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            $fields = [];
            foreach ($fieldsList as $index => $item) {
                $fields[] = "addon." . $item['name'];
            }
            $table = $this->model->getTable();
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $sort = 'main.id';
            $isSuperAdmin = $this->isSuperAdmin;
            $channelIds = $this->channelIds;
            $customWhere = function ($query) use ($isSuperAdmin, $channelIds, $model_id) {
                if (!$isSuperAdmin) {
                    $query->where('main.channel_id', 'in', $channelIds);
                }
                if ($model_id) {
                    $query->where('main.model_id', $model_id);
                }
            };
            $total = Db::table($table)
                ->alias('main')
                ->join('cms_channel channel', 'channel.id=main.channel_id', 'LEFT')
                ->join($model['table'] . ' addon', 'addon.id=main.id', 'LEFT')
                ->field('main.id,main.channel_id,main.title,channel.name as channel_name,addon.id as aid' . ($fields ? ',' . implode(',', $fields) : ''))
                ->where($customWhere)
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = Db::table($table)
                ->alias('main')
                ->join('cms_channel channel', 'channel.id=main.channel_id', 'LEFT')
                ->join($model['table'] . ' addon', 'addon.id=main.id', 'LEFT')
                ->field('main.id,main.channel_id,main.title,channel.name as channel_name,addon.id as aid' . ($fields ? ',' . implode(',', $fields) : ''))
                ->where($customWhere)
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        $fields = [];
        foreach ($fieldsList as $index => $item) {
            $fields[] = ['field' => $item['name'], 'title' => $item['title'], 'type' => $item['type'], 'content' => $item['content_list']];
        }
        $this->assignconfig('fields', $fields);
        $this->view->assign('fieldsList', $fieldsList);
        $this->view->assign('model', $model);
        $this->assignconfig('model_id', $model_id);
        $modelList = \app\admin\model\cms\Modelx::all();
        $this->view->assign('modelList', $modelList);
        return $this->view->fetch();
    }

    /**
     * 编辑
     *
     * @param mixed $ids
     * @return string
     */
    public function edit($ids = null)
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
        if (!$this->isSuperAdmin && !in_array($row['channel_id'], $this->channelIds)) {
            $this->error(__('You have no permission'));
        }
        if ($this->request->isPost()) {
            return $this->editToself($ids);
        }
        $channel = Channel::get($row['channel_id']);
        if (!$channel) {
            $this->error(__('No specified channel found'));
        }
        $model = \app\admin\model\cms\Modelx::get($channel['model_id']);
        if (!$model) {
            $this->error(__('No specified model found'));
        }
        $addon = db($model['table'])->where('id', $row['id'])->find();
        if ($addon) {
            $row->setData($addon);
        }

        $disabledIds = [];
        $all = collection(Channel::order("weigh desc,id desc")->select())->toArray();
        foreach ($all as $k => $v) {
            if ($v['type'] != 'list' || $v['model_id'] != $channel['model_id']) {
                $disabledIds[] = $v['id'];
            }
        }
        $tree = Tree::instance()->init($all, 'parent_id');
        $channelOptions = $tree->getTree(0, "<option model='@model_id' value=@id @selected @disabled>@spacer@name</option>", $row['channel_id'], $disabledIds);
        $this->view->assign('channelOptions', $channelOptions);
        $this->view->assign("row", $row);
        $this->assignconfig('user_type',$row['user_type']);
        $this->assignconfig('activity_type',$row['activity_type']);
        return $this->view->fetch();
    }




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
     * 添加学习课程
     */
    public function addstudy()
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
        return $this->view->fetch('');
    }



    /**
     * 添加
     */
    public function addnotify()
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
                    Db::name('cms_notify')->where('id',$this->model->id)->update(['admin_id'=>$this->auth->id]);
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
     * 删除
     * @param mixed $ids
     */
    public function del($ids = "")
    {
        \app\admin\model\cms\Archives::event('after_delete', function ($row) {
            Channel::where('id', $row['channel_id'])->where('items', '>', 0)->setDec('items');
        });
        if (Db::name('cms_notify')->where('id',$ids)->find()){
            if (Db::name('wis_activityrecord')->where('notify_id',$ids)->find()){
                Db::name('wis_activityrecord')->where('notify_id',$ids)->delete();
                Db::name('cms_notify')->where('id',$ids)->delete();
            }else{
                Db::name('cms_notify')->where('id',$ids)->delete();
            }
        }
        parent::del($ids);
    }

    /**
     * 销毁
     * @param string $ids
     */
    public function destroy($ids = "")
    {
        \app\admin\model\cms\Archives::event('after_delete', function ($row) {
            //删除副表
            $channel = Channel::get($row->channel_id);
            if ($channel) {
                $model = Modelx::get($channel['model_id']);
                if ($model) {
                    db($model['table'])->where("id", $row['id'])->delete();
                }
            }
        });
        parent::destroy($ids);
    }

    /**
     * 还原
     * @param mixed $ids
     */
    public function restore($ids = "")
    {
        $pk = $this->model->getPk();
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            $this->model->where($this->dataLimitField, 'in', $adminIds);
        }
        if ($ids) {
            $this->model->where($pk, 'in', $ids);
        }
        $archivesChannelIds = $this->model->onlyTrashed()->column('id,channel_id');
        $archivesChannelIds = array_filter($archivesChannelIds);
        $this->model->where('id', 'in', array_keys($archivesChannelIds));
        $count = $this->model->restore('1=1');
        if ($count) {
            $channelNums = array_count_values($archivesChannelIds);
            foreach ($channelNums as $k => $v) {
                Channel::where('id', $k)->setInc('items', $v);
            }
            $this->success();
        }
        $this->error(__('No rows were updated'));
    }

    /**
     * 移动
     * @param string $ids
     */
    public function move($ids = "")
    {
        if ($ids) {
            $channel_id = $this->request->post('channel_id');
            $pk = $this->model->getPk();
            $adminIds = $this->getDataLimitAdminIds();
            if (is_array($adminIds)) {
                $this->model->where($this->dataLimitField, 'in', $adminIds);
            }
            $this->model->where($pk, 'in', $ids);
            $channel = Channel::get($channel_id);
            if ($channel && $channel['type'] === 'list') {
                $channelNums = \app\admin\model\cms\Archives::
                with('channel')
                    ->where('archives.' . $pk, 'in', $ids)
                    ->where('channel_id', '<>', $channel['id'])
                    ->field('channel_id,COUNT(*) AS nums')
                    ->group('channel_id')
                    ->select();
                $result = $this->model
                    ->where('model_id', '=', $channel['model_id'])
                    ->where('channel_id', '<>', $channel['id'])
                    ->update(['channel_id' => $channel_id]);
                if ($result) {
                    $count = 0;
                    foreach ($channelNums as $k => $v) {
                        if ($v['channel']) {
                            Channel::where('id', $v['channel_id'])->where('items', '>', 0)->setDec('items', min($v['channel']['items'], $v['nums']));
                        }
                        $count += $v['nums'];
                    }
                    Channel::where('id', $channel_id)->setInc('items', $count);
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            } else {
                $this->error(__('No rows were updated'));
            }
            $this->error(__('Parameter %s can not be empty', 'ids'));
        }
    }

    /**
     * 获取栏目列表
     * @internal
     */
    public function get_channel_fields()
    {
        $this->view->engine->layout(false);
        $channel_id = $this->request->post('channel_id');
        $archives_id = $this->request->post('archives_id');
        $channel = Channel::get($channel_id, 'model');
        if ($channel && $channel['type'] === 'list') {
            $values = [];
            if ($archives_id) {
                $values = db($channel['model']['table'])->where('id', $archives_id)->find();
            }

            $fields = \app\admin\model\cms\Fields::where('model_id', $channel['model_id'])
                ->order('weigh desc,id desc')
                ->select();
            foreach ($fields as $k => $v) {
                //优先取编辑的值,再次取默认值
                $v->value = isset($values[$v['name']]) ? $values[$v['name']] : (is_null($v['defaultvalue']) ? '' : $v['defaultvalue']);
                $v->rule = str_replace(',', '; ', $v->rule);
                if (in_array($v->type, ['checkbox', 'lists', 'images'])) {
                    $checked = '';
                    if ($v['minimum'] && $v['maximum']) {
                        $checked = "{$v['minimum']}~{$v['maximum']}";
                    } elseif ($v['minimum']) {
                        $checked = "{$v['minimum']}~";
                    } elseif ($v['maximum']) {
                        $checked = "~{$v['maximum']}";
                    }
                    if ($checked) {
                        $v->rule .= (';checked(' . $checked . ')');
                    }
                }
                if (in_array($v->type, ['checkbox', 'radio']) && stripos($v->rule, 'required') !== false) {
                    $v->rule = str_replace('required', 'checked', $v->rule);
                }
                if (in_array($v->type, ['selects'])) {
                    $v->extend .= (' ' . 'data-max-options="' . $v['maximum'] . '"');
                }
            }

            $this->view->assign('fields', $fields);
            $this->view->assign('values', $values);
            $this->success('', null, ['html' => $this->view->fetch('fields')]);
        } else {
            $this->error(__('Please select channel'));
        }
        $this->error(__('Parameter %s can not be empty', 'ids'));
    }

    /**
     * 检测元素是否可用
     * @internal
     */
    public function check_element_available()
    {
        $id = $this->request->request('id');
        $name = $this->request->request('name');
        $value = $this->request->request('value');
        $name = substr($name, 4, -1);
        if (!$name) {
            $this->error(__('Parameter %s can not be empty', 'name'));
        }
        if ($id) {
            $this->model->where('id', '<>', $id);
        }
        $exist = $this->model->where($name, $value)->find();
        if ($exist) {
            $this->error(__('The data already exist'));
        } else {
            $this->success();
        }
    }
}
