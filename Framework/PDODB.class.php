<?php 

	
	/**
	* PDOMySQLDB PDO连接数据库帮助类
	*/
	class PDODB implements i_DAO	{
	
		//PDO实例化对象
		private  $pdo = null  ;
		private static $instance;
		private $_host;
		private $_port;
		private $_user;
		private $_password;
		private $_charset;
		private $_dbname;
		private $_dsn;		
		private $_options;

		/**
		 * 构造方法，实例化PDO对象 私有 单例
		 * @param array  $config  数据库连接数组（初始化工作）
		 */
		private function __construct($config = array()){
			$this->_initServer($config);
			$this->connent();
		}

		private function _initServer($config = array()){
			$this->_host = isset($config['host']) ? $config['host'] : 'localhost';
			$this->_port = isset($config['port']) ? $config['port'] : '3306';
			$this->_user = isset($config['user']) ? $config['user'] : 'root';
			$this->_password = isset($config['password']) ? $config['password'] : '123456';
			$this->_charset = isset($config['charset']) ? $config['charset'] : 'UTF8';
			$this->_dbname = isset($config['dbname']) ? $config['dbname'] : 'test';
		}


		private function connent()
		{
			$this->_dsn = "mysql:$this->_host;port=$this->_port;dbname=$this->_dbname";
			$this->_options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES $this->_charset");
			try {
				$this->pdo = new PDO($this->_dsn,$this->_user,$this->_password,$this->_options);
			} catch (PDOException $e) {
				exit('连接失败：'.$e->getMessage());
			}
		 	
		}




		/**
		 * 完全单例不允许克隆
		 * @return empty
		 */
		private function __clone(){

		}

		static function GetInstance($config=array()){
				if (!isset($instance)) {
					self::$instance = new self($config);
				}
				return self::$instance;
			}
		

		/**
		 * 代码执行错误时
		 * @param  string $sql sql语句
		 * @return empty
		 */
		public function falseSql($sql=''){
			echo "<p>sql语句执行失败，请参考以下信息</p>";
			echo "<br>错误代号：".$this->pdo->errorCode();  //获取错误代号
			echo "<br>错误原因：".$this->pdo->errorInfo()[2];  //获取错误提示
			echo "<br>错误语句：".$sql;
			die();
		}

		/**
		 * 返回受影响行数
		 * @param [type] $sql sql语句
		 */
		public function Exec($sql=''){
			$result = $this->pdo->exec($sql);
			if($result === false){
				$this->falseSql($sql);
			}
			return $result;
		}

		/**
		 * 返回查询的一行数据
		 * @param  [string] $sql sql语句
		 * @return [array]    一维数组
		 */
		public function GetRow($sql=''){
			$result = $this->pdo->query($sql);			
			if($result === false)
			{
				$this->falseSql($sql);
			}			
			$row = $result->fetch();
			$result->closeCursor(); //释放结果集光标；
			return $row;
		}
		/**
		 * 返回查询的二维数据集
		 * @param  [string] $sql sql语句
		 * @return [array[][]]  二维数组     
		 */
		public function GetTable($sql=''){
			$result = $this->pdo->query($sql);
			if($result === false)
			{
				$this->falseSql($sql);
			}			
			$table = $result->fetchAll();
			$result -> closeCursor();
			return $table;
		}

		/**
		 * 返回一个数据
		 * @param  [type] $sql [description]
		 * @return [type]      [description]
		 */
		public function GetOneData($sql=''){
			$result = $this->pdo->query($sql);
			if($result === false)
			{
				$this->falseSql($sql);
			}						
			$oneData =  $result ->fetchColumn();
			$result -> closeCursor();
			return $oneData;
		}

		

		/**
		 * 获取转义之后的字符
		 * @param  string $str sql字符串
		 * @return string      转义后得字符串
		 */
		public function escapeString($str=''){
			return $this->pdo->quote($str);
		}

		/**
		 * 析构函数，关闭连接
		 */
		function __destruct(){
			$this->pdo = null;
		}
	}

    //数据库操作类测试
	// $config = array('dbname'=>'myShop');
	// $dao=PDODB::GetInstance($config);
	// $sqlstr = "select * from admin";
	// $m_admin = $dao->GetOneData($sqlstr);
	// var_dump($m_admin);

 ?>