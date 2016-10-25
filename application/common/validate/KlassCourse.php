<?php
namespace app\common\validate;
use think\Validate;

class KlassCourse extends Validate
{
    protected $rule = [
        'course_id'  => 'require',
        'klass_id' => 'require',
    ];
}