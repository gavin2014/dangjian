<?php

namespace app\admin\model\wis;

use think\Model;


class Activitynotify extends Model
{

    

    

    // 表名
    protected $name = 'cms_notify';


    // 追加属性
    protected $append = [
        'progress_state_text'
    ];


//    protected $pk = 'activity_id';



    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;




    public function getProgressStateList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }


    public function getProgressStateTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['progress_state']) ? $data['progress_state'] : '');
        $list = $this->getProgressStateList();
        return isset($list[$value]) ? $list[$value] : '';
    }




    public function cmsarchives()
    {
        return $this->belongsTo('app\admin\model\cms\Archives', 'id', 'id', [], 'LEFT')->setEagerlyType(0);
    }





}
