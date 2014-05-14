<?php


if ( ! function_exists('dddos_token'))
{
	/**
	 * Generate a dddos token value.
	 *
	 * @return string
	 */
	function dddos_token()
	{
		$dddos = md5(uniqid('',true));
		Session::put('dddos', $dddos);
		return $dddos;
	}
}


if ( ! function_exists('get_map_content'))
{
	/**
	 * Generate a dddos token value.
	 *
	 * @return string
	 */
	function get_map_content($pagename,$name)
	{
		 
		return Lang::get($name.'.'.$pagename);
		//return Lang::get('title.'.$name);;
	}
}