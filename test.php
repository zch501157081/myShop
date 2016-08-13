<?php 
	header('content-Type :test/html ;charset=utf-8');
 	//require 'View/ManagerIndex.html';
 	//require 'Controller/adminController.class.php';
 	// ini_set('session.save_path', 'd:/zch/11');
 	// session_start();
 	// $_SESSION['name'] = 'kang';
 	// $_SESSION['sex'] = 0;
 	

 	// //增加Session数据
 	// $_SESSION['name'] = 'kang';
 	// $_SESSION['sex'] = 0;
 	// //删除Session数据
 	// unset($_SESSION['sex']);
 	// //更改
 	// $_SESSION['name'] = 'zheng';
 	// //查询
 	// var_dump($_SESSION['name']);

 	// @mysql_connect('$localhost:3306','root','123456');
 	// @mysql_query("use test");
 	// $sqlstr = "select * from join1";
 	// $result = mysql_query($sqlstr);
 	// if($result === false)
 	// {
 	// 	echo "<br>错误代号：".mysql_errno();  //获取错误代号
		// echo "<br>错误原因：".mysql_error();  //获取错误提示
		// echo "<br>错误语句：".$sql;
 	// }
 	// var_dump($result);
 	
 	// while($rec=mysql_fetch_array($result))
 	// {
 	// 	for($i=0;$i<mysql_num_fields($result);$i++)
 	// 		echo $rec[mysql_field_name($result, $i)];
 	// }
 	// 
 	

 	$dsn = 'mysql:host=localhost;port=3306;dbname=myShop';
 	$username= 'root';
 	$password = '123456';
 	$options = array(
 		PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8',
 		);   //MYSQL初始化命令
 	$pdo = new PDO($dsn,$username,$password,$options);
 	$sqlstr = "select * from admin";
 	$result = $pdo->query($sqlstr);
 	$join1_list = $result->fetch(PDO::FETCH_BOTH);
 	var_dump($join1_list);
 	// $sqlstr = "select * from admin";
 	// $sqlstr = "delete from admin where id = ";

 	// $result = $pdo->exec($sqlstr);
 	// if ($result === false) {
 	// 	echo "你的错误是<br>";
 	// 	var_dump($pdo->errorInfo()[2]);
 	//}
 	

 	// $result = $pdo->exec($sqlstr);
 	// var_dump($result);
 	// echo "<br>";
 	// $last_id = $pdo->lastInsertID();
 	// var_dump($last_id);
 	// var_dump($result);
 	// die;
 	
 ?>