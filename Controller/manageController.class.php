<?php 
	/**
	* 管理员
	*/
	class ManageController extends BaseController
	{
		
		public function IndexAction()
		{
			// //²éÑ¯session£¬¿´ÆäÊÇ·ñÓÐµÇÂ½È¨ÏÞ
			// if(!isset($_SESSION["admin"]))
			// {
			// 	$this->_jumpNow("index.php?c=Admin&a=Login");
			// }
			 require './View/Index.html';

		}

		public function outLogAction()
		{
			unset($_SESSION['admin']);
			session_destroy();
			unset($_SESSION);
			setcookie(session_name(),'',time()-1,'/');
			setcookie('admin_id','',time()-1,'/');
			setcookie('admin_password','',time()-1,'/');
			$this->_jumpNow('index.php?c=Admin&a=login');

		}

		public function topAction()
		{
			require './View/top.html'; 
		}
		public function menuAction()
		{
			require './View/menu.html'; 
		}
		public function dragAction()
		{
			require './View/drag.html'; 
		}
		public function mainAction()
		{
			require './View/main.html'; 
		}

	}

 ?>