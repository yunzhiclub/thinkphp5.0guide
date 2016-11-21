<?php
namespace app\index\controller;     // 该文件的位于application\index\controller文件夹
use app\common\model\Teacher;       // 教师模型
/**
 * 教师管理
 */
class TeacherController
{
    public function index()
    {
        $Teacher = new Teacher;
        var_dump($Teacher);
    }
}