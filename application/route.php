<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    // 首页 定位到 Login控制器下的index触发器, 方法为get
    ''         => ['Login/index', ['method' => 'get']],

    // login 定位到 Login控制器下的login控制器， 方法为post
    'login'    => ['Login/login', ['method' => 'post']],

    // logout 定位到 Login控制器下的logout控制器， 方法为get
    'logout'    => ['Login/logout', ['method' => 'get']],

    'teacher/'      =>  ['Teacher/index', ['method' => 'get']],
    'teacher/add'   =>  ['Teacher/add', ['method' => 'get']],
    'teacher/save'  =>  ['Teacher/save', ['method' => 'post']],
    'teacher/edit/:id'  =>  ['Teacher/edit', ['method' => 'get'], ['id' => '\d+']],
    'teacher/update'  =>  ['Teacher/update', ['method' => 'post']],
    'teacher/delete/:id'     => ['Teacher/delete', ['method' => 'get'], ['id' => '\d+']],
];
