 <?php
class users extends CI_Model{
	function isUser($data){
		$query=$this->db->query("SELECT isVerified,email from `Users` where username='".$data["name"]."' and password='".$data['key']."'");
		return $query->result_array();
	}
	function getData()
	{
		$query=$this->db->query("SELECT name as Name,username as User_name,email as Email from Users where userName='".$_SESSION["name"]."'");
		return $query->result();
	}
	function verifyUser()
	{
		$this->db->where('username',$_SESSION['name']);
		$query=$this->db->update("Users",array("isVerified"=>'1'));
		return $query;
	}
	function insert($data)
	{
		$query=$this->db->insert("Users",$data);
		/*query("INSERT INTO Users(name,username,password,email) 
			VALUES('".$data['name']."','".$data['username']."','".$data['password']."','".$data['email']."')");*/
		return $this->db->insert_id();
	}
}
?>