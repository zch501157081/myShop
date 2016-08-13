<?php 
	/**
 	* 基础控制器类  被所有的控制类继承
 	*/
  	class BaseController
  	{
  		
  		function __construct()
  		{
        $this->_isLogin();
  			$this->_setContentType();
  		}
  		/**
  		 * 设置响应内容类型，字符集
  		 */
  		public function _setContentType()
  		{
  			header('ContentType : text/html;charset = utf-8');
  		} 


      //判断是否登陆  即判断是否存在SESSION
      protected function _isLogin($value='admin'){
        
        //定义一个非使用文件，有些controller并不需要验证session
        //意思下面控制器下的方法即使没有SESSION也可以访问
        $no_check = array(
          'Admin' =>array('Login','Check') );
        //判断当前控制器为下标的元素是否存在 && 当前动作是否存在于当前控制器的特列动作列表
        if(isset($no_check[CONTROLLER])  &&  in_array(ACTION,$no_check[CONTROLLER]))
        {          
          //直接结束
          return ;
        }

        //除上面以外的所有接口没有session则不能够访问
        if(!isset($_SESSION[$value])){
          // echo $_COOKIE['admin_id'];
          // echo $_COOKIE['admin_password'];
            //如果存在cookie并且匹配数据库密码成功，登陆成功，否则跳转登陆。
            $m_admin = new AdminModel();
            $result = $m_admin -> checkRememer($_COOKIE['admin_id'],$_COOKIE['admin_password']) ;
          
            if (isset($_COOKIE['admin_id']) && isset($_COOKIE['admin_password']) && $result ) {
                $_SESSION['admin'] = $result;
            }
            else{
            $this->_jumpNow('index.php?c=Admin&a=Login');
          }
        }
      }


  		protected function _jumpNow($url='')
  		{
  			header('Location:'.$url);
  			die;

  		}

  		protected function _jumpWait($url='',$message='',$wait=3){
  			header("Refresh:$wait;URL='$url'");
  			echo $message."    ".$wait."秒之后跳转";

  			die;
  		}
  	}



 ?>