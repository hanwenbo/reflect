<?php
require_once '../vendor/autoload.php';
$test = new \hanwenbo\reflect\Reflect( new Test );

var_dump( $test->getClassReflect()->getName() );

$list = $test->getFunctionListReflect();

foreach( $list as $row ){
	var_dump( $row->getName() );
	var_dump( $row->getTitle() );
}


/**
 * Test的标题
 * Class Test
 */
class Test
{
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
}