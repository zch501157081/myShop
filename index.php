<?php 
	session_start();
	//  ***自动加载实现***
	spl_autoload_register('MvcAutoload');
	//  类与类文件地址映射列表 ，定义方法外，保证仅定义一次
	$class_list = array(
			'BaseModel' =>'Framework/BaseModel.class.php',
			'MySQLDB' => 'Framework/MySQLDB.class.php',
			'BaseController' => 'Framework/BaseController.class.php',
			'i_DAO'=>'Framework/i_DAO.interface.php',
			'PDODB'=>'Framework/PDODB.class.php'
		);
	/**
	 * 自动加载类
	 * @param string $name 自动调用的文件名
	 */
	function MvcAutoload( $name='' )
	{
		//拿到全局映射列表
		$class_list = $GLOBALS['class_list'];
		//如果文件名在映射列表内，加载
		if (isset($class_list[$name])) {
			require $class_list[$name];
		}
		//以model结尾的模型类
		else if('Model' == substr($name, -5)){
			require './Model/'.$name.'.class.php';
		}
		// 以controller结尾的
		else if('Controller' == substr($name, -10))
		{
			require 'Controller/'.$name.'.class.php';
		}
	}

	/**
 	*程序入口文件 
 	*/
 	//设置默认的入口文件，默认值
 	$default_controller = 'Manage';
 	$default_action = 'Index';
 	//当前请求的控制器
 	$current_controller = isset($_GET['c']) ? $_GET['c'] : $default_controller;
 	//当前请求的控制器方法
 	$current_action = isset($_GET['a']) ? $_GET['a'] : $default_action;
 	define('CONTROLLER', $current_controller);
 	define('ACTION', $current_action);

 	//require 'Controller/'.CONTROLLER.'.class.php';
	$controller_use = CONTROLLER . 'Controller'; 	
 	$controller = new  $controller_use();
 	$action_use = ACTION . 'Action';
 	$controller -> $action_use();
 ?>