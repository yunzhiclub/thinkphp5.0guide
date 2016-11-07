<?php
namespace app\index\controller;     // 该文件的位于application\index\controller文件夹

use think\Controller;   // 用于与V层进行数据传递

use app\common\model\Teacher;       // 教师模型

/**
 * 教师管理，继承think\Controller后，就可以利用V层对数据进行打包了。
 */
class TeacherController extends Controller
{
    public function index()
    {
        $Teacher = new Teacher; 
        $teachers = $Teacher->select();

        // 向V层传数据
        $this->assign('teachers', $teachers);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;
    }

    /**
     * 插入新数据
     * @return   html                   
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-11-07T12:31:24+0800
     */
    public function insert()
    {
        // 实例化Teacher空对象
        $Teacher = new Teacher();

        // 为对象的属性赋值
        $Teacher->name = '王五';
        $Teacher->username = 'wangwu';
        $Teacher->sex = '1';
        $Teacher->email = 'wangwu@yunzhi.club';
        
        // 执行对象的插入数据操作
        var_dump($Teacher->save());
        return $Teacher->name . '成功增加至数据表中。新增ID为:' . $Teacher->id;
    }
}

