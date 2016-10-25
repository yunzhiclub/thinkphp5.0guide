<?php
namespace app\common\model;
use think\Model;
/**
 * 课程
 */
class Course extends Model
{
    /**
     * 多对多关联
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-10-24T16:26:58+0800
     */
    public function Klasses()
    {
        return $this->belongsToMany('Klass',  config('database.prefix') . 'klass_course');
    }

    /**
     * 一对多关联
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-10-24T16:27:05+0800
     */
    public function KlassCourses()
    {
        return $this->hasMany('KlassCourse');
    }

    /**
     * 获取是否存在相关关联记录
     * @param  object  班级
     * @return bool
     * @author panjie <panjie@yunzhiclub.com>
     */
    public function getIsChecked(Klass &$Klass)
    {
        // 取课程ID
        $courseId = (int)$this->id;
        $klassId = (int)$Klass->id;

        // 定制查询条件
        $map = array();
        $map['klass_id'] = $klassId;
        $map['course_id'] = $courseId;

        // 从关联表中取信息
        $KlassCourse = KlassCourse::get($map);
        if (is_null($KlassCourse)) {
            return false;
        } else {
            return true;
        }
    }
}