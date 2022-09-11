<?php
class article
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
	 
	function insert_article($postfields)
	{	 
		extract($postfields);

		///$articleid=idgeneration_withoutstr("2022_article","ClientID='".$clientid."'",$this->dbconn);
		$articleid=idgeneration("Sno","2022_article","ART",$this->dbconn);
		$article_insert="INSERT INTO `2022_article`( `ArticleID`,`ClientID`, `ArticleName`, `ArticleLink`, `CreatedOn`, `CreatedBy`) VALUES ('$articleid','$clientid','$articlename','$articlelink',now(),'$loginid')";
		$article_exec=$this->dbconn->connection()->query($article_insert);

		if($article_exec)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}

	function update_article($postfields)
	{	 
		extract($postfields);

		$article_update="UPDATE `2022_article` SET  `ArticleName`='$articlename', `ArticleLink`='$articlelink',`ModifiedBy`='$loginid', `ModifiedOn`=now() WHERE IsActive=1 AND `ArticleID`='$articleid' AND `ClientID`='$clientid' AND `CreatedBy`='$loginid'";
		$article_exec=$this->dbconn->connection()->query($article_update);

		if($article_exec)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function changestatus($postfields)
	{	 
		extract($postfields);

		$article_update="UPDATE `2022_article` SET  `Comments`='$articlecmtid', `CurrentStatus`='$optionval',`ModifiedBy`='$loginid', `ModifiedOn`=now() WHERE IsActive=1 AND `ArticleID`='$articleid' AND `CreatedBy`='$loginid'";
		$article_exec=$this->dbconn->connection()->query($article_update);

		if($article_exec)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function delete_article($postfields)
	{	 
		extract($postfields);

		$article_delete="UPDATE `2022_article` SET  `ModifiedOn`=now(),`ModifiedBy`='$loginid',`IsActive`='0', `IsDelete`='1' WHERE `CreatedBy`='$loginid' AND `ArticleID`='$articleid' AND `ClientID`='$clientid'";
		$article_exec=$this->dbconn->connection()->query($article_delete);

		if($article_exec)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function fetchall_article($postfields)
	{
		$article_data=array();
		extract($postfields);

		if($isclient==0)
		{
			$addqry='';
		}
		else
		{
			$addqry="AND CreatedBy='$loginid'";
		}

		if($mode=="filter")
		{
			$filtermode=$filterdata;
		}
		else
		{
			$filtermode='';
		}


		$article_sel="SELECT * FROM `2022_article` WHERE `IsActive`='1' $addqry $filtermode";
		$article_qry_exec=$this->dbconn->connection()->query($article_sel);
		$rowcount=mysqli_num_rows($article_qry_exec);
		while($article_ret=mysqli_fetch_assoc($article_qry_exec))
		{
			$ArticleID_fetch=$article_ret['ArticleID'];
			$ArticleName_fetch=$article_ret['ArticleName'];
			$ArticleLink_fetch=$article_ret['ArticleLink'];
			$CurrentStatus_fetch=$article_ret['CurrentStatus'];
			$Comments_fetch=$article_ret['Comments']; 
			$Comments_short = strlen($article_ret['Comments']) > 30 ? substr($article_ret['Comments'],0,30)."..." : $article_ret['Comments'];
			 

			if($CurrentStatus_fetch==1){$CurrentStatus_label='Yes';}else{$CurrentStatus_label='No';}
			$article_data[]=array(
				"ArticleID"=>$ArticleID_fetch,
				"ArticleName"=>$ArticleName_fetch,
				"ArticleLink"=>$ArticleLink_fetch,
				"CurrentStatus"=>$CurrentStatus_fetch,
				"StatusLabel"=>$CurrentStatus_label,
				"CommentsShort"=>$Comments_short,
				"Comments"=>$Comments_fetch,
			);
		}

		if($rowcount>0)
		{
			$result=$article_data;
		}
		else
		{
			$result=[];
		}
		
		return $result;
	}

	function fetchall_client()
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

			$client_data[]=array(
				"ClientID"=>$ClientID_fetch,
				"ClientName"=>$ClientName_fetch,
				"MobileNo"=>$MobileNo_fetch
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
}
?>