<?php
namespace app\index\controller;
use think\Db;       // 数据库操作类

class Teacher
{
    public function index()
    {
        // 获取教师表中的所有数据
        $teachers = DB::name('teacher')->select();

        // 用下面的语句，也可以直接返回给用户
        echo $teachers[0]['name'];

        // 查看获取的数据
        return $teachers[0]['name'];
    }
}