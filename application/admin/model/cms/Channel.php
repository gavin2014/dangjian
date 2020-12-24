<?php

namespace app\admin\model\cms;

use think\Model;

class Channel extends Model
{

    // 表名
    protected $name = 'cms_channel';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    // 追加属性
    protected $append = [
        'type_text',
        'status_text',
        'url'
    ];

    public function getUrlAttr($value, $data)
    {
        $diyname = $data['diyname'] ? $data['diyname'] : $data['id'];
        return isset($data['type']) && isset($data['outlink']) && $data['type'] == 'link' ? $data['outlink'] : addon_url('cms/channel/index', [':id' => $data['id'], ':diyname' => $diyname]);
    }

    protected static function init()
    {
        self::beforeInsert(function ($row) {
            if ($row->getData('type') == 'link') {
                $row->model_id = 0;
            }
        });
        self::afterInsert(function ($row) {
            //创建时自动添加权重值
            $pk = $row->getPk();
            $row->getQuery()->where($pk, $row[$pk])->update(['weigh' => $row[$pk]]);
        });
        self::afterDelete(function ($row) {
            //删除时，删除子节点，同时将所有相关文档移入回收站
            static $tree;
            if (!$tree) {
                $tree = \fast\Tree::instance();
                $tree->init(collection(Channel::order('weigh desc,id desc')->field('id,parent_id,name,type,diyname,status')->select())->toArray(), 'parent_id');
            }
            $childIds = $tree->getChildrenIds($row['id']);
            if ($childIds) {
                Channel::destroy(function ($query) use ($childIds) {
                    $query->where('id', 'in', $childIds);
                });
            }
            $childIds[] = $row['id'];
            db('cms_archives')->where('channel_id', 'in', $childIds)->update(['deletetime' => time()]);
        });
        self::afterWrite(function ($row) {
            $changed = $row->getChangedData();
            //隐藏时判断是否有子节点,有则隐藏
            if (isset($changed['status']) && $changed['status'] == 'hidden') {
                static $tree;
                if (!$tree) {
                    $tree = \fast\Tree::instance();
                    $tree->init(collection(Channel::order('weigh desc,id desc')->field('id,parent_id,name,type,diyname,status')->select())->toArray(), 'parent_id');
                }
                $childIds = $tree->getChildrenIds($row['id']);
                db('cms_channel')->where('id', 'in', $childIds)->update(['status' => 'hidden']);
            }
            //隐藏栏目显示时判断是否有子节点
            if (isset($changed['isnav']) && !$changed['isnav']) {
                static $tree;
                if (!$tree) {
                    $tree = \fast\Tree::instance();
                    $tree->init(collection(Channel::order('weigh desc,id desc')->field('id,parent_id,name,type,diyname,isnav,status')->select())->toArray(), 'parent_id');
                }
                $childIds = $tree->getChildrenIds($row['id']);
                db('cms_channel')->where('id', 'in', $childIds)->update(['isnav' => 0]);
            }
        });
    }

    public static function getTypeList()
    {
        return ['channel' => __('Channel'), 'list' => __('List'), 'link' => __('Link')];
    }

    public static function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }

    public function getTypeTextAttr($value, $data)
    {
        $value = $value ? $value : $data['type'];
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : $data['status'];
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function model()
    {
        return $this->belongsTo('Modelx', 'model_id')->setEagerlyType(0);
    }
}
