<?php
namespace app\common\model;
use think\Model;    // 使用前进行声明
/**
 * Student 学生表
 */
class Student extends Model
{
    protected $dateFormat = 'Y年m月d日';    // 日期格式

    /**
     * 自定义自转换字换
     * @var array
     */
    protected $type = [
        'create_time' => 'datetime',
    ];

    /**
     * 输出性别的属性
     * @return string 0男，1女
     * @author 梦云智 http://www.mengyunzhi.com
     */
    public function getSexAttr($value)
    {
        $status = array('0'=>'男','1'=>'女');
        $sex = $status[$value];
        if (isset($sex))
        {
            return $sex;
        } else {
            return $status[0];
        }
    } 

    /**
     * ThinkPHP使用一个叫做__get()的魔法函数来完成这个函数的自动调用
     * 在本章第五节中，我们将专门对__get()进行讲解
     * @author 梦云智 http://www.mengyunzhi.com
    */
    public function Klass()
    {
        return $this->belongsTo('klass');
    }
}