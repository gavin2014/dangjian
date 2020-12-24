<?php

namespace app\admin\model\wis;

use think\Model;


class Study extends Model
{

    

    

    // 表名
    protected $name = 'cms_political_study';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'user_type_text'
    ];
    

    
    public function getUserTypeList()
    {
        return ['1' => __('User_type 1'), '2' => __('User_type 2'), '3' => __('User_type 3'), '4' => __('User_type 4'), '5' => __('User_type 5')];
    }


    public function getUserTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['user_type']) ? $data['user_type'] : '');
        $list = $this->getUserTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function cmsarchives()
    {
        return $this->belongsTo('app\admin\model\cms\Archives', 'id', 'id', [], 'LEFT')->setEagerlyType(0);
    }



}
