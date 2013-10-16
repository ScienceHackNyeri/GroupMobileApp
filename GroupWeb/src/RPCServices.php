<?php
use ZendServerGateway\Controller\AbstractActionController;

class RPCServices extends AbstractActionController {
	public function postLoginAction() {
		$username = $this->bodyParam ( 'username' );
		$groupname = $this->bodyParam ( 'groupname' );
		$password = $this->bodyParam ( 'password' );
        $usr = new MyCompany\Model\UserRepository();
		$post_data[] = array($username,$groupname, $password);
		$clean_data = $this->sanitize($post_data);
		$reply = $usr->validate($clean_data);
		if($reply == -1){

		}

	}
	public function getRegisterAction() {
		$username = $this->bodyParam ( 'username' );
		$unit = $this->bodyParam ( 'unit' );
		$groupname = $this->bodyParam ( 'groupname' );
		$password = $this->bodyParam ( 'password' );
		$verifypwd = $this->bodyParam ( 'password' );

		return array ();
	}
	public function getLogoutAction() {
		$id = $this->queryParam ( 'id' );
		return true;
	}
	public function getUploadAction() {
		return array ();
	}
	public function getAdmnloginAction() {
		$AdminPassword=$this->bodyParam('AdminPassword');
		return true;
	}

	public function sanitize($data){
		foreach($data as $varname=>$value){
			$clean = trim($value);
			$clean = mysql_real_escape_string($clean);
			$clean = htmlentities($clean, ENT_QUOTES, 'UTF-8');
			$cleanVars[$varname] = $clean;
		}
		return $cleanVars;
	}
}

?>