<?php

/**
 * Test的标题
 * Class Test
 */
class Test extends TestParents
{
	public function __construct()
	{
//		var_dump(get_class_methods($this));
	}


	/**
	 * 列表
	 */
	public function list()
	{

	}

	/**
	 * 详情
	 */
	public function info()
	{

	}

	/**
	 * 删除
	 */
	public function del()
	{

	}
	/**
	 * 获得参数
	 * @method GET
	 */
	public function getParam(){

	}
}

class TestParents{
	public function pp(){

	}
}
require_once __DIR__.'/../vendor/autoload.php';
$test = new \hanwenbo\reflect\Reflect( new Test );

//var_dump( $test->getClassReflect()->getName() );

$list = $test->getFunctionListReflect();

foreach( $list as $row ){
//	var_dump( $row->getName() );
//	var_dump( $row->getTitle() );
	var_dump( $row->getParam('method') );
}


//var_dump(get_class_methods('Test'));

