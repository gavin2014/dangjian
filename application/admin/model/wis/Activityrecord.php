<?php

namespace app\admin\model\wis;

use think\Model;


class Activityrecord extends Model
{

    

    

    // 表名
    protected $name = 'wis_activityrecord';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];
    

    public function wisactivitynotify()
    {
        return $this->belongsTo('Activitynotify', 'notify_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
