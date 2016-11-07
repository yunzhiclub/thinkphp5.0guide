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
        try {
            $pageSize = 5; // 每页显示5条数据

            // 实例化Teacher
            $Teacher = new Teacher; 

            // 调用分页
            $teachers = $Teacher->paginate($pageSize);

            // 向V层传数据
            $this->assign('teachers', $teachers);

            // 取回打包后的数据
            $htmls = $this->fetch();

            // 将数据返回给用户
            return $htmls;

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
    }

    /**
     * 插入新数据
     * @return   html                   
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-11-07T12:31:24+0800
     */
    public function insert()
    {
        $message = '';  // 提示信息

        try {
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
            if (false === $result)
            {
                // 验证未通过，发生错误
                $message = '新增失败:' . $Teacher->getError();
            } else {
                // 提示操作成功，并跳转至教师管理列表
                return $this->success('用户' . $Teacher->name . '新增成功。', url('index'));
            }
        } catch (\Exception $e) {
            // 发生异常
            return $e->getMessage();
        }

        return $this->error($message);
    }

    /**
     * 新增数据交互
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-11-07T12:41:23+0800
     */
    public function add()
    {
        try {
            $htmls = $this->fetch();
            return $htmls;
        } catch (\Exception $e) {
            return '系统错误' . $e->getMessage();
        }
    }


    /**
     * 删除
     * @return   跳转                   
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-11-07T13:52:07+0800
     */
    public function delete()
    {
        try {
            // 实例化请求类
            $Request = Request::instance();
            
            // 获取get数据
            $id = Request::instance()->param('id/d');
            
            // 判断是否成功接收
            if (0 === $id) {
                throw new \Exception('未获取到ID信息', 1);
            }

            // 获取要删除的对象
            $Teacher = Teacher::get($id);

            // 要删除的对象存在
            if (is_null($Teacher)) {
                throw new \Exception('不存在id为' . $id . '的教师，删除失败', 1);
            }

            // 删除对象
            if (!$Teacher->delete()) {
                return $this->error('删除失败:' . $Teacher->getError());
            }

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 

        // 进行跳转 
        return $this->success('删除成功', $Request->header('referer')); 
    }

    /**
     * 编辑
     * @return   html                   
     * @author 梦云智 http://www.mengyunzhi.com
     * @DateTime 2016-11-07T13:52:29+0800
     */
    public function edit()
    {
        try {
            // 获取传入ID
            $id = Request::instance()->param('id/d');

            // 在Teacher表模型中获取当前记录
            if (null === $teacher = Teacher::get($id))
            {
                // 由于在$this->error抛出了异常，所以也可以省略return(不推荐)
                $this->error('系统未找到ID为' . $id . '的记录');
            } 
            
            // 将数据传给V层
            $this->assign('teacher', $teacher);

            // 获取封装好的V层内容
            $htmls = $this->fetch();

            // 将封装好的V层内容返回给用户
            return $htmls;

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
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

            // 获取当前对象
            $teacher = Teacher::get($id);

            if (!is_null($teacher)) {
                // 写入要更新的数据
                $teacher->name = input('post.name');
                $teacher->username = input('post.username');
                $teacher->sex = input('post.sex');
                $teacher->email = input('post.email');

                // 更新
                if (false === $teacher->validate(true)->save()) {
                    return $this->error('更新失败' . $teacher->getError());
                }
            } else {
                throw new \Exception("所更新的记录不存在", 1);   // 调用PHP内置类时，需要在前面加上 \ 
            }

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
        
        // 成功跳转至index触发器
        return $this->success('操作成功', url('index'));
    }

    public function test()
    {
        $pageSize = 5; // 每次显示5条数据
        $Teacher = new Teacher; 

        // 调用分页
        $teachers = $Teacher->paginate($pageSize);
        var_dump($teachers);

        // 不调用分页
        $teachers = $Teacher->select();
        var_dump($teachers);
    }
}

