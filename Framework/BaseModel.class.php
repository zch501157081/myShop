<?php 

	class BaseModel
	{
		//一个子类可以继承的数据库操作对象
		protected $_dao = null;

		public function __construct()
		{
			$this->_initDAO();
		}

		private function _initDAO(){
			$config =array('dbname' =>'myShop');
			//$this->_dao = MySQLDB::GetInstance($config);
			$this->_dao = PDODB::GetInstance($config);
		}

		

	}
 ?>