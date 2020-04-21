<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("users");
		error_reporting(0);
		session_start();
	}
	public function index()
	{
		if($_SESSION['name'])
		{
			redirect(base_url("home"));
		}
		$this->load->view('login');
	}
	public function isUser()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username',"Username",'required|regex_match[/^[a-zA-Z0-9]+$/]');
		$this->form_validation->set_rules('password',"Password",'required');

		if($this->form_validation->run()){
			$data=array(
				"name"=>$this->input->post("username"),
				"key"=>md5($this->input->post("password"))
			);
			$result=$this->users->isUser($data);
			if(empty($result))
			{
				redirect(base_url("login/failure"));		
			}
			if ($result[0]['isVerified']==1){
				$_SESSION['name']=$data['name'];
				$_SESSION['isVerified']=1;
				redirect(base_url("home"));
			}
			else{
				$_SESSION['name']=$data['name'];
				$_SESSION['isVerified']=0;
				$_SESSION['email']=$result[0]['email'];
				redirect(base_url("login/verifyEmail"));
			}
		}
		else{
			$this->index();
		}
		
	}
	public function failure()
	{
		$_SESSION['error']="You are not a valid user";
		redirect(base_url());	
	}
	public function register()
	{
		if($_SESSION['username'])
		{
			redirect(base_url());
		}
		else
		{
			$this->load->view('register'); 
		}
	}
	public function sendEmail()
	{
		if(!$_SESSION['name'])
		{
			redirect(base_url());
		}
		$_SESSION['otp']=md5(rand());
		$info="<p>Dear ".$_SESSION['name']."<br>The OTP is ".$_SESSION['otp']."</p>";
        $this->load->library('email');
        $this->email->from("","");
        $this->email->to($_SESSION['email']);
        $this->email->subject("Email verification");
        $this->email->message($info);
        $this->email->set_newline("\r\n");
        if ($this->email->send()) {
        	redirect(base_url()."login/verifyEmail");
        } 
        else {
            session_destroy();
            $_SESSION['error']="Email isn't valid or some problem with email";
            redirect(base_url());
        }
	}
	public function verifyEmail()
	{
		if($_SESSION['isVerified'])
		{
			redirect(base_url("home"));
		}
		if(!$_SESSION['name'])
		{
			redirect(base_url());
		}
		if(!$_SESSION['otp'])
		{
			redirect(base_url()."login/sendEmail");
		}
		else
		{
			$this->load->view("verifyEmail");
		}
	}
	public function verifyOtp()
	{
		if(!$_SESSION['name'])
		{
			redirect(base_url());
		}
		$this->load->library('form_validation');
		$otp=$_SESSION['otp'];
		function matchOtp($otp)
		{
			if($otp==$_SESSION['otp'])
			{
				return true;
			}
			return false;
		}
		$this->form_validation->set_rules('otp',"OTP","required|matchOtp",
		array(
			"matchOtp"=>"Enter valid OTP")
		);
		if($this->form_validation->run())
		{
			$this->load->model("users");
			if($this->users->verifyUser())
			{
				$_SESSION['isVerified']=1;
				redirect(base_url("home"));
			}
			else
			{
				echo "Some error";
			}
		}
		else
		{
			$this->load->view("verifyEmail");
		}
	}
	public function validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name',"Name",'required|regex_match[/^[a-zA-Z0-9]+$/]');
		$this->form_validation->set_rules('username',"Username",'required|regex_match[/^[a-zA-Z0-9]+$/]');
		$this->form_validation->set_rules('email',"Password",'required|valid_email');
		$this->form_validation->set_rules('password',"Password",'required');
		$this->form_validation->set_rules('cpassword',"Password",'required|matches[password]',
			array('matches'=>'Passwords aren\'t matching')
		);
		$this->form_validation->set_message('regex_match', '{field} can only have alphanumeric characters.');
		if($this->form_validation->run())
		{
			$data=array(
				"name"=>$this->input->post("name"),
				"username"=>$this->input->post("username"),
				"password"=>md5($this->input->post("password")),
				"email"=>$this->input->post('email')
			);
			$this->load->model("users");
			$id=$this->users->insert($data);
			if($id)
			{
				$_SESSION['name']=$data['username'];
				$_SESSION['email']=$data['email'];
				$_SESSION['isVerified']=0;
				redirect(base_url("login/verifyEmail"));
			}
			else
			{
				echo "Some error";
			}
		}
		else
		{
			$this->load->view('register');
		}
	}
}