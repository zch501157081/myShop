<?php 
	/**
	* ç®¡ç†å‘˜ç±»
	*/
	class ManageController extends BaseController
	{
		
		public function IndexAction()
		{
			//²éÑ¯session£¬¿´ÆäÊÇ·ñÓÐµÇÂ½È¨ÏÞ
			if(!isset($_SESSION["admin"]))
			{
				$this->_jumpNow("index.php?c=Admin&a=Login");
			}
			require './View/ManageIndex.html';
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