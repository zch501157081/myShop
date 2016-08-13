<?php 
	
	class AdminModel extends BaseModel
	{
		public function CheckUser($username,$password)
		{
			$escape_username = $this->_dao->escapeString($username);
			$escape_password = $this->_dao->escapeString($password);
			$sqlstr = "select * from admin where name = $escape_username and password = md5($escape_password);";
			
			return  $this->_dao -> GetRow($sqlstr);

		}

		public function checkRememer($md5_id,$md5_password){
			 // $sqlstr = "select * from admin where md5(concat(id,'SALT')) ='". $md5_id ."' and md5(
				// concat(password,'SALT')) ='".$md5_password. "'";
			
			$sqlstr = "select * from admin where md5(concat(id,'SALT')) = '$md5_id' and md5(
				 concat(password,'SALT')) ='$md5_password'";
			
			return $this->_dao->GetRow($sqlstr);
		}
	}
 ?>