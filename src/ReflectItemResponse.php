<?php
/**
 *
 * Copyright  FaShop
 * License    http://www.fashop.cn
 * link       http://www.fashop.cn
 * Created by FaShop.
 * User: hanwenbo
 * Date: 2019-02-24
 * Time: 14:53
 *
 */

namespace hanwenbo\reflect;


class ReflectItemResponse
{
	protected $name;
	protected $title;
	private $obj;

	/**
	 *
	 * ReflectItemResponse constructor.
	 * @param \ReflectionClass | \ReflectionMethod $obj
	 */
	public function __construct( $obj )
	{
		$this->obj = $obj;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->obj->getShortName();
	}

	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->parseTitle( $this->getDocComment() );
	}

	/**
	 * 解析@xx
	 *
	 * @param string $comment
	 * @return string
	 */
	public function getParam( string $name ) : array
	{
		return $this->parseParam( $name, $this->getDocComment() );
	}

	/**
	 * 解析标题
	 * @param string $comment
	 * @return string
	 */
	private function parseTitle( string $comment ) : string
	{
		preg_match_all( "/\*\*\s*(?:\*\s*)+([^\s\*]+)/", $comment, $title_matches, PREG_PATTERN_ORDER );
		return isset($title_matches[1][0]) ? $title_matches[1][0] : '';
	}

	/**
	 * 解析某个参数
	 * @param string $name
	 * @param string $comment
	 * @return array
	 */
	private function parseParam( string $name, string $comment )
	{
		if( strstr( $comment, "* @{$name}" ) ){
			$paramRows = explode( "\n", $comment );
			foreach( $paramRows as $paramRow ){
				if( strstr( $paramRow, "* @{$name}" ) ){
					$_units       = explode( " ", trim( $paramRow ) );
					$_unitsResult = [];
					$_startIndex  = 0;
					foreach( $_units as $index => $unit ){
						if( $unit === "@{$name}" ){
							$_startIndex = $index;
						}
						if( $index >= $_startIndex && $index !== 0  && $unit !== "" ){
							$_unitsResult[] = $unit;
						}
					}
				}
			}
			return $_unitsResult;
		} else{
			return [];
		}
	}

	/**
	 * 获得注释
	 * @return string
	 */
	public function getDocComment() : string
	{
		return $this->obj->getDocComment() ? $this->obj->getDocComment() : '';
	}

}