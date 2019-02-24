# reflect-auth-router
反射权限路由，用于FaShop公司内部约束好的控制器文件，生成权限路由信息

```php
$test = new \hanwenbo\reflect\Reflect( new Test );

// 设置禁止的方法
$test->setDenyFunctionList(['del','info']);

// 获得类名字
var_dump( $test->getClassReflect()->getName() );

// 获得反射的方法列表
$list = $test->getFunctionListReflect();

foreach( $list as $row ){
	var_dump( $row->getName() );
	var_dump( $row->getTitle() );
}

```