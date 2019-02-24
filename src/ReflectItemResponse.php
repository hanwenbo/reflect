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
	public function __construct(  $obj )
	{
		$this->obj = $obj;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->obj->getName();
	}

	/**
	 * @return mixed
	 */
	public function getTitle()
	{
		return $this->parseTitle( $this->obj->getDocComment() );
	}

	/**
	 * 解析标题
	 * @param string $comment
	 * @return string
	 */
	private function parseTitle( string $comment ) : string
	{
		preg_match_all( "/\*\*\s*(?:\*\s*)+([^\s\*]+)/", $comment, $title_matches, PREG_PATTERN_ORDER );
		return $title_matches[1][0];
	}

}