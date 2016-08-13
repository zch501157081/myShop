<?php 
  

  /*
   * 用户类
   */
  class AdminController extends BaseController
  {
  	/**
  	 * 登陆界面的显示
  	 */
  	public function LoginAction()
  	{
  		require 'View/AdminLogin.html';
  	}

  	public function CheckAction(){
  		$username = $_POST['username'];
  		$password = $_POST['password'];

  		//require 'Model/AdminModel.class.php';
  		$m_admin = new AdminModel();
  		$result= $m_admin->CheckUser($username,$password);
  		if ($result) {
        if(isset($_POST['remember'])){
          setcookie('admin_id',md5($result['id'].'SALT'),time()+24*60*60,'/');
          setcookie('admin_password',md5($result['password'].'SALT'),time()+24*60*60,'/');          
        }          
  			//登陆成功记录其账号信息。
  			$_SESSION['admin']=$result;
  			$this->_jumpNow('index.php?c=Manage&a=Index');
  		}
  		else
  		{
  			$this->_jumpWait($message='index.php?c=Admin&a=Login','密码错误');
  			
  		}

   	}
  }

 ?>