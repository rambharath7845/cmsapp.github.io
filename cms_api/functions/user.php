<?php
class user
{
	public $db = NULL;
	public $dbconn = NULL;
	public $rowcount = NULL;

	function __construct()
	{
		include_once $_SERVER['DOCUMENT_ROOT'].'/cms_api/common/db.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/cms_api/common/rowcount.php';
		include_once $_SERVER['DOCUMENT_ROOT'].'/cms_api/common/idgeneration.php';
		$this->dbconn=new database_conn();
	}
	 
	function insert_user($postfields)
	{	 
		extract($postfields);
		$rowcount=tablerowcount("2022_userlogin","IsActive=1 AND EmployeeID='$employeeid'",$this->dbconn);
		if($rowcount==0)
		{
			$userid=idgeneration("Sno","2022_userlogin","USR",$this->dbconn);
			$user_insert="INSERT INTO `2022_userlogin`( `UserID`, `EmployeeName`, `Employeeid`,`UserName`,`PassWord`,`CreatedOn`,`CreatedBy`) VALUES ('$userid','$employeename','$employeeid','$username',md5('$password'),now(),'$loginid')";
			$user_exec=$this->dbconn->connection()->query($user_insert);

			if($user_exec)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	function update_user($postfields)
	{	 
		extract($postfields);

		$user_update="UPDATE `2022_userlogin` SET  `EmployeeName`='$employeename',`UserName`='$username', `EmployeeID`='$employeeid', `ModifiedOn`=now(), `ModifiedBy`='$loginid' WHERE IsActive=1 AND `UserID`='$userid'";
		$user_exec=$this->dbconn->connection()->query($user_update);

		if($user_exec)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function update_userpassword($postfields)
	{	 
		extract($postfields);

		$user_update="UPDATE `2022_userlogin` SET  `PassWord`=md5('$password'), `ModifiedOn`=now(), `ModifiedBy`='$loginid' WHERE IsActive=1 AND `UserID`='$userid'";
		$user_exec=$this->dbconn->connection()->query($user_update);

		if($user_exec)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function delete_user($postfields)
	{	 
		extract($postfields);

		$user_delete="UPDATE `2022_userlogin` SET  `ModifiedOn`=now(),`ModifiedBy`='$loginid',`IsActive`='0', `IsDelete`='1' WHERE `UserID`='$userid'";
		$user_exec=$this->dbconn->connection()->query($user_delete);

		if($user_exec)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function fetchall()
	{
		$user_data=array();
		$user_sel="SELECT * FROM `2022_userlogin` WHERE `IsActive`='1'";
		$user_qry_exec=$this->dbconn->connection()->query($user_sel);
		$rowcount=mysqli_num_rows($user_qry_exec);
		while($user_ret=mysqli_fetch_assoc($user_qry_exec))
		{
			$UserID_fetch=$user_ret['UserID'];
			$EmployeeName_fetch=$user_ret['EmployeeName'];
			$EmployeeID_fetch=$user_ret['EmployeeID'];
			$UserName_fetch=$user_ret['UserName'];
			$PassWord_fetch=$user_ret['PassWord'];

			$user_data[]=array(
				"UserID"=>$UserID_fetch,
				"EmployeeName"=>$EmployeeName_fetch,
				"EmployeeID"=>$EmployeeID_fetch,
				"UserName"=>$UserName_fetch,
				"PassWord"=>$PassWord_fetch
			);
		}

		if($rowcount>0)
		{
			$result=$user_data;
		}
		else
		{
			$result=[];
		}
		
		return $result;
	}

}
?>