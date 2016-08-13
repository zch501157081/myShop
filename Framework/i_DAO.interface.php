<?php 
	interface i_DAO{
	// 获取当前DAO对象的接口方法
	public static function GetInstance($config=array());
	// 获取结果行数
	public function Exec($sql='');
	// 获取全部数据
	public function GetTable($sql='');
	// 获取一行记录
	public function GetRow($sql='');
	// 获取一个数据
	public function GetOneData($sql='');
	// 转义SQL，防止注入
	public function escapeString($str='');
	}
 ?>