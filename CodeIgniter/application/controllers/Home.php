<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class home extends CI_Controller{
	public function __construct(){
		parent::__construct();
		error_reporting(0);
		session_start();
	}
	function index()
	{
		if($_SESSION['name'])
		{
			if(!$_SESSION['isVerified'])
			{
				redirect(base_url("login/verifyEmail"));
			}
			$this->load->model("users");
			$result['data']=$this->users->getData();
			$this->load->view('home',$result);
		}
		else{
			echo $_SESSION['name'];
		}
	}
	function logout()
	{	
		session_destroy();
		redirect(base_url());
	}
}
?>