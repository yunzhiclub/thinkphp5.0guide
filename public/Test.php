<?php
class Test
{
    public function sayHello()
    {  
        echo "hello <br />";

    }

    public function sayOther($words)
    {
        echo "$words <br />";
    }

    public function functionNotExist()
    {
        echo '您要调用的方法不存在 <br />';
    }

    public function __call($method, $args)
    {
        echo "你要调用的方法是:$method <br />";
        echo "传入参数是:";
        var_dump($args);
        $this->functionNotExist($args);
    }
}
$Test = new Test();
// 在这下面，我们开始写测试代码。
$Test->sayHello();
// $Test->sayOther('hello yunzhi');
// $Test->ssd('hi Yunzhier, how a u'); //ssd方法并不存在，是我随便写的，当然了，你也可以写成别的方法，比如sfsdfsdfwfe。
// $Test->myz('hi Yunzhier', 'how a u');