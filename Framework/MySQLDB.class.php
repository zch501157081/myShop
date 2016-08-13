<?php 
	/**
	 * MySQLDB 连接数据库帮助类
	 */
	class MySQLDB implements i_DAO{
		public $link=null;   //设置为了用于关闭连接
		private static $instance=null;
		private $_host;
		private $_port;
		private $_user;
		private $_password;
		private $_charset;
		private $_dbname;
		private $_dsn;		
		private $_options;
		/*
		 *  类的单例化  
		 *  1.构造函数私有
		 *  2.定义一个私有的静态变量，以存储唯一的对象
		 *  3.定义静态方法 ，若有有对象则返回，没有对象实例化一个对象
		 */
		static function GetInstance($config = array())
		{
			if(!isset($instance))
			{
				self::$instance=new self($config);
			}
			return self::$instance;
		}

		/*
		 *不允许克隆 完全单例
		 */
		private function __clone(){}

		/*
		*构造函数  初始化数据库连接 默认连接本地数据库 编码模式UTF8
		*单例模式，不允许通过类来创建
		 */
		private  function __construct($config=array())
		{
			$this->__initSever($config);
			@$this->link=mysql_connect($this->_host.":".$this->_port,$this->_user,$this->_password);
			if(!$this->link)
			{
				die('error:'.mysql_error());
			}	
			mysql_query("set names $this->_charset");
			mysql_query("use $this->_dbname");
		}

		private function __initSever($config=array()){
			$this->_host = isset($config['host']) ? $config['host'] : 'localhost';
			$this->_port = isset($config['port']) ? $config['port'] : '3306';
			$this->_user = isset($config['user']) ? $config['user'] : 'root';
			$this->_password = isset($config['password']) ? $config['password'] : '123456';
			$this->_charset = isset($config['charset']) ? $config['charset'] : 'UTF8';
			$this->_dbname = isset($config['dbname']) ? $config['dbname'] : 'test';
		}

		/*
		* 更改编码模式
		 */
		
		function setCharset($charset){
			mysql_query("set names $charset");
		}

		/*
		*  更改要使用的数据库 一般不使用 初始化时初始好
		 */
		function queryDB($dbname)
		{
			mysql_query("use $dbname");
		}
		/*
		如果结果错误执行下列语句
		 */
		function falseSQL($sql='')
		{
			
			echo "<p>sql语句执行失败，请参考以下信息</p>";
			echo "<br>错误代号：".mysql_errno();  //获取错误代号
			echo "<br>错误原因：".mysql_error();  //获取错误提示
			echo "<br>错误语句：".$sql;
			die();
				

		}

		/*
		执行一条sql 语句，返回真假结果
		 */
		public function Exec($sql='')
		{
			$result=mysql_query($sql);
			if($result === false)
			{
				$this->falseSQL($sql);
			}
			else
				return true;
		}

		/*
		 执行一条返回一行数据的语句，返回的是一维数组
		 */
		public function GetRow($sql='')
		{
			$result=mysql_query($sql);
			if($result === false)
			{
				$this->falseSQL($sql);
			}
			$rec=mysql_fetch_array($result);
			mysql_free_result($result);   //提前销毁储存在内存的查询出结果集 否则等到页面结束才销毁
			return $rec;

		}
		/*
		执行一条返回多条数据的语句，返回二维数组
		 */
		public function GetTable($sql='')
		{
			$result=mysql_query($sql);
			if($result === false)
			{
				$this->falseSQL($sql);
			}
			$arr=array();
			while ($rec=mysql_fetch_array($result))
			{
				$arr[]=$rec;
			}
			mysql_free_result($result);
			return $arr;
		}
		/*
		返回一个数据时
		 */
		public function GetOneData($sql='')
		{
			$result=mysql_query($sql);
			if($result === false)
			{
				$this->falseSQL($sql);
			}
			$rec=mysql_fetch_array($result);
			mysql_free_result($result);

			return $rec[0];
		}
		
		/**
		 * 将字符串转义后返回
		 * @var 待转义的字符串
		 * @return string 转义后的字符串
		 */
		public function escapeString($str=''){
			return "'".mysql_real_escape_string($str,$this->link)."'";
		}


		/**
		 *析构函数  关闭链接 
		 */
		function __destruct()
		{
			mysql_close($this->link);
		}

	}
	// $config = array('dbname'=>'myShop');
	// $dao = MySQLDB::GetInstance($config);
	// $sqlstr = "select * from admin";
	// $result = $dao->GetTable($sqlstr);
	// var_dump($result);


 ?>	