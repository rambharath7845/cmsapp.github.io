<?php
class client
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
	 
	function insert_client($postfields)
	{	 
		extract($postfields);
		$rowcount=tablerowcount("2022_clients","IsActive=1 AND MobileNo='$mobileno'",$this->dbconn);
		if($rowcount==0)
		{
			$clientid=idgeneration("Sno","2022_clients","CLT",$this->dbconn);
			$client_insert="INSERT INTO `2022_clients`( `ClientID`, `ClientName`, `MobileNo`,`UserName`,`PassWord`,`CreatedOn`,`CreatedBy`) VALUES ('$clientid','$clientname','$mobileno','$username',md5('$password'),now(),'$loginid')";
			$client_exec=$this->dbconn->connection()->query($client_insert);

			if($client_exec)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}

	function update_client($postfields)
	{	 
		extract($postfields);

		$client_update="UPDATE `2022_clients` SET  `ClientName`='$clientname',`UserName`='$username', `MobileNo`='$mobileno', `ModifiedOn`=now(), `ModifiedBy`='$loginid' WHERE IsActive=1 AND `ClientID`='$clientid'";
		$client_exec=$this->dbconn->connection()->query($client_update);

		if($client_exec)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function update_clientpassword($postfields)
	{	 
		extract($postfields);

		$client_update="UPDATE `2022_clients` SET  `PassWord`=md5('$password'), `ModifiedOn`=now(), `ModifiedBy`='$loginid' WHERE IsActive=1 AND `ClientID`='$clientid'";
		$client_exec=$this->dbconn->connection()->query($client_update);

		if($client_exec)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function delete_client($postfields)
	{	 
		extract($postfields);

		$client_delete="UPDATE `2022_clients` SET  `ModifiedOn`=now(),`ModifiedBy`='$loginid',`IsActive`='0', `IsDelete`='1' WHERE `ClientID`='$clientid'";
		$client_exec=$this->dbconn->connection()->query($client_delete);

		if($client_exec)
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
		$client_data=array();
		$client_sel="SELECT * FROM `2022_clients` WHERE `IsActive`='1'";
		$client_qry_exec=$this->dbconn->connection()->query($client_sel);
		$rowcount=mysqli_num_rows($client_qry_exec);
		while($client_ret=mysqli_fetch_assoc($client_qry_exec))
		{
			$ClientID_fetch=$client_ret['ClientID'];
			$ClientName_fetch=$client_ret['ClientName'];
			$MobileNo_fetch=$client_ret['MobileNo'];
			$UserName_fetch=$client_ret['UserName'];
			$PassWord_fetch=$client_ret['PassWord'];

			$client_data[]=array(
				"ClientID"=>$ClientID_fetch,
				"ClientName"=>$ClientName_fetch,
				"MobileNo"=>$MobileNo_fetch,
				"UserName"=>$UserName_fetch,
				"PassWord"=>$PassWord_fetch
			);
		}

		if($rowcount>0)
		{
			$result=$client_data;
		}
		else
		{
			$result=[];
		}
		
		return $result;
	}

	function checklogin($postfields)
	{
		extract($postfields);

		$client_data=array();
		$client_sel="SELECT * FROM `2022_clients` WHERE `IsActive`='1' AND `UserName`='$username' AND `PassWord`=md5('$password')";
		$client_qry_exec=$this->dbconn->connection()->query($client_sel);
		$rowcount=mysqli_num_rows($client_qry_exec);
		while($client_ret=mysqli_fetch_assoc($client_qry_exec))
		{
			$ClientID_fetch=$client_ret['ClientID'];
			$ClientName_fetch=$client_ret['ClientName'];
			$MobileNo_fetch=$client_ret['MobileNo'];
			$UserName_fetch=$client_ret['UserName'];
			$PassWord_fetch=$client_ret['PassWord'];

			$client_data[]=array(
				"ClientID"=>$ClientID_fetch,
				"ClientName"=>$ClientName_fetch,
				"MobileNo"=>$MobileNo_fetch,
				"UserName"=>$UserName_fetch,
				"PassWord"=>$PassWord_fetch
			);
		}

		if($rowcount>0)
		{
			$result=$client_data;
		}
		else
		{
			$result=[];
		}
		
		return $result;
	}	

	function emp_checklogin($postfields)
	{
		extract($postfields);

		$employee_data=array();
		$employee_sel="SELECT * FROM `2022_userlogin` WHERE `IsActive`='1' AND `UserName`='$username' AND `PassWord`=md5('$password')";
		$employee_qry_exec=$this->dbconn->connection()->query($employee_sel);
		$rowcount=mysqli_num_rows($employee_qry_exec);
		while($employee_ret=mysqli_fetch_assoc($employee_qry_exec))
		{
			$UserID_fetch=$employee_ret['UserID'];
			$EmployeeID_fetch=$employee_ret['EmployeeID'];
			$EmployeeName_fetch=$employee_ret['EmployeeName'];
			$UserName_fetch=$employee_ret['UserName'];
			$PassWord_fetch=$employee_ret['PassWord'];

			$employee_data[]=array(
				"UserID"=>$UserID_fetch,
				"EmployeeID"=>$EmployeeID_fetch,
				"UserName"=>$UserName_fetch,
				"PassWord"=>$PassWord_fetch
			);
		}

		if($rowcount>0)
		{
			$result=$employee_data;
		}
		else
		{
			$result=[];
		}
		
		return $result;
	}
}
?>