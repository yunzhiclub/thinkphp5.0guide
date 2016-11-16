<?php
namespace app\index\controller;
use think\Db;       // 数据库操作类

class Teacher
{
    public function index()
    {
        // 获取教师表中的所有数据
        $teachers = Db::name('teacher')->select();

        // 查看获取的数据
        var_dump($teachers);
    }
}