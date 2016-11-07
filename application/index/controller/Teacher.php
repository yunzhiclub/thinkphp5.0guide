<?php
namespace app\index\controller;
use app\common\model\Teacher;  // 教师模型
/**
 * 教师管理
 */
class Teacher
{
    public function index()
    {
        $Teacher = new Teacher;
        dump($Teacher);
    }
}