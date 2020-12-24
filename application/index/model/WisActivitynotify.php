<?php
/**
 * Created by 云中有鹿.
 * User: 陈云
 * Blog: http://blog.likecy.cn
 * Date: 2019-07-29
 * Time: 13:27
 */

namespace app\index\model;

use think\Model;

class WisActivitynotify extends Model
{

    // 表名
    protected $name = 'wis_activitynotify';

    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
//        'activity_time_text',
        'status_text'
    ];



    public function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }


//    public function getActivityTimeTextAttr($value, $data)
//    {
//        $value = $value ? $value : (isset($data['activity_time']) ? $data['activity_time'] : '');
//        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
//    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

//    protected function setActivityTimeAttr($value)
//    {
//        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
//    }


//    public static function contentGetById




}