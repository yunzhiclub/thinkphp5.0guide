<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class Teacher extends Validate
{
    protected $rule = [
        'email' => 'email',
    ];
}