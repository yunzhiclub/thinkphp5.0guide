<?php
namespace app\index\controller;     // 该文件的位于application\index\controller文件夹

use think\Controller;               // 用于与V层进行数据传递
use think\Request;                  // 引用Request

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
        // 接收传入数据
        $postData = Request::instance()->post();    

        // 实例化Teacher空对象
        $Teacher = new Teacher();

        // 为对象赋值
        $Teacher->name = $postData['name'];
        $Teacher->username = $postData['username'];
        $Teacher->sex = $postData['sex'];
        $Teacher->email = $postData['email'];

        // 新增对象至数据表
        $result = $Teacher->validate(true)->save();

        // 反馈结果
        if (false === $result) {
            return '新增失败:' . $Teacher->getError();
        } else {
            return  '新增成功。新增ID为:' . $Teacher->id;
        }
    }

    /**
     * 新增数据交互
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-11-07T12:41:23+0800
     */
    public function add()
    {
        $htmls = $this->fetch();
        return $htmls;
    }


    /**
     * 删除
     * @return   跳转                   
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-11-07T13:52:07+0800
     */
    public function delete()
    {
        // 获取pathinfo传入的ID值.
        $id = Request::instance()->param('id/d'); // /d 表示将数值转化为 整形

        if (0 === $id) {
            return $this->error('未获取到ID信息');
        }

        // 获取要删除的对象
        $Teacher = Teacher::get($id);

        // 要删除的对象不存在
        if (is_null($Teacher)) {
            return $this->error('不存在id为' . $id . '的教师，删除失败');
        }

        // 删除对象
        if (!$Teacher->delete()) {
            return $this->error('删除失败:' . $Teacher->getError());
        }

        // 进行跳转
        return $this->success('删除成功', url('index'));
    }


    /**
     * 编辑
     * @return   html                   
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-11-07T13:52:29+0800
     */
    public function edit()
    {
        // 获取传入ID
        $id = Request::instance()->param('id/d');

        // 在Teacher表模型中获取当前记录
        if (is_null($Teacher = Teacher::get($id))) {
            return '系统未找到ID为' . $id . '的记录';
        } 
        
        // 将数据传给V层
        $this->assign('Teacher', $Teacher);

        // 获取封装好的V层内容
        $htmls = $this->fetch();

        // 将封装好的V层内容返回给用户
        return $htmls;
    }

    /**
     * 更新
     * @return                      
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-11-07T14:03:41+0800
     */
    public function update()
    {
        try {
            // 接收数据，取要更新的关键字信息
            $id = Request::instance()->post('id/d');
            $message = '更新成功';

            // 获取当前对象
            $teacher = Teacher::get($id);

            if (!is_null($teacher)) {
                // 写入要更新的数据
                $teacher->name = Request::instance()->post('name');
                $teacher->username = Request::instance()->post('username');
                $teacher->sex = Request::instance()->post('sex/d');
                $teacher->email = Request::instance()->post('email');

                // 更新
                if (false === $teacher->validate(true)->save())
                {
                    $message =  '更新失败' . $teacher->getError();
                }
            } else {
                throw new \Exception("所更新的记录不存在", 1);   // 调用PHP内置类时，需要在前面加上 \ 
            }
        } catch (\Exception $e) {
            // 由于对异常进行了处理，如果发生了错误，我们仍然需要查看具体的异常位置及信息，那么需要将以下的代码的注释去掉
            // throw $e;
            $message = $e->getMessage();
        }
       
        return $message;
    }
}

