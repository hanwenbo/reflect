<?php
/**
 *
 * Copyright  FaShop
 * License    http://www.fashop.cn
 * link       http://www.fashop.cn
 * Created by FaShop.
 * User: hanwenbo
 * Date: 2019-02-23
 * Time: 22:47
 *
 */

namespace hanwenbo\reflect;

class Reflect
{
	/**
	 * 禁止的方法
	 * @var array
	 */
	protected $denyFunctionList = [];
	/**
	 * 非法的方法
	 * @var array
	 */
	private $illegalFunctionList
		= [
			'__construct',
			'__set',
			'__get',
			'__isset',
			'__call',
			'__destruct',
			'__callStatic',
			'__invoke',
			'__unset',
			'__autoload',
			'__clone',
			'__toString',
			'__sleep',
			'__wakeup',
			'__set_state',
		];
	private $targetReflectionInstance;

	/**
	 * Reflect constructor.
	 * @param $target
	 * @throws \ReflectionException
	 */
	public function __construct( $target )
	{
		$this->targetReflectionInstance = new \ReflectionClass( $target );
	}

	/**
	 * @param array $denyFunctionList
	 */
	public function setDenyFunctionList( array $denyFunctionList ) : void
	{
		$this->denyFunctionList = $denyFunctionList;
	}


	/**
	 * @return ReflectItemResponse
	 */
	public function getClassReflect() : ReflectItemResponse
	{
		return new ReflectItemResponse( $this->targetReflectionInstance );
	}

	/**
	 * @throws \ReflectionException
	 * @return array
	 */
	public function getFunctionListReflect() : array
	{
		$methodList  = $this->targetReflectionInstance->getMethods( \ReflectionMethod::IS_PUBLIC );
		$_methodList = [];
		foreach( $methodList as $method ){
			if( !in_array( $method->name, $this->denyFunctionList ) && !in_array( $method->name, $this->illegalFunctionList ) ){
				$_methodList[] = new ReflectItemResponse( $method );
			}
		}
		return $_methodList;
	}
}