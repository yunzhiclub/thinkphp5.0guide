<?php
namespace app\common\model;
use think\Model;
/**
 * 班级
 */
class Klass extends Model
{
    private $Teacher;

    /**
     * 获取对应的教师（辅导员）信息
     * @return Teacher 教师
     * @author <panjie@yunzhiclub.com> http://www.mengyunzhi.com
     */
    public function Teacher()
    {
        return $this->belongsTo('teacher');
    }
}