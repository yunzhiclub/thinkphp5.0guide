<?php
namespace app\index\controller;
use think\Request;                  // 请求
use app\common\model\Klass;         // 班级
use app\common\model\Teacher;       // 教师
class KlassController extends IndexController
{
    public function index()
    {
        $klasses = Klass::paginate();
        $this->assign('klasses', $klasses);
        return $this->fetch();
    }
    
    public function add()
    {
        // 获取所有的教师信息
        $teachers = Teacher::all();
        $this->assign('teachers', $teachers);
        return $this->fetch();
    }

    public function save()
    {
        // 实例化请求信息
        $Request = Request::instance();

        // 实例化班级并赋值
        $Klass = new Klass();
        $Klass->name = $Request->post('name');
        $Klass->teacher_id = $Request->post('teacher_id/d');

        // 添加数据
        if (!$Klass->validate(true)->save()) {
            return $this->error('数据添加错误：' . $Klass->getError());
        }

        return $this->success('操作成功', url('index'));
    }

    public function edit()
    {
        $id = Request::instance()->param('id/d');

        // 获取所有的教师信息
        $teachers = Teacher::all();
        $this->assign('teachers', $teachers);

        // 获取用户操作的班级信息
        if (false === $Klass = Klass::get($id))
        {
            return $this->error('系统未找到ID为' . $id . '的记录');
        }

        $this->assign('Klass', $Klass);
        return $this->fetch();
    }

    public function update()
    {
        $id = Request::instance()->post('id/d');

        // 获取传入的班级信息
        $Klass = Klass::get($id);
        if (is_null($Klass)) {
            return $this->error('系统未找到ID为' . $id . '的记录');
        }

        // 数据更新
        $Klass->name = Request::instance()->post('name');
        $Klass->teacher_id = Request::instance()->post('teacher_id/d');
        if (!$Klass->validate()->save()) {  // 这里使用的是validate()而不是validate(true)效果相同，为什么呢？
            return $this->error('更新错误：' . $Klass->getError());
        } else {
            return $this->success('操作成功', url('index'));
        }
    }
}