<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json; charset=utf-8');

include 'functions/user.php'; 


if(isset($_GET["action"]))
{
	if($_GET["action"] == 'insert')
	{
		$user_conn=new user();
		$insert_row=$user_conn->insert_user($_POST);
  		 
  		if($insert_row==true)
  		{
  			echo json_encode(array('resp'=>true,'msg'=>'success'));
  		}
  		else
  		{
  			echo json_encode(array('resp'=>false,'msg'=>'error'));
  		}
  	}

  if($_GET["action"] == 'update')
	{
		$user_conn=new user();
		$update_row=$user_conn->update_user($_POST);
  		 
  		if($update_row==true)
  		{
  			echo json_encode(array('resp'=>true,'msg'=>'success'));
  		}
  		else
  		{
  			echo json_encode(array('resp'=>false,'msg'=>'error'));
  		}
  	}
  if($_GET["action"] == 'updatepassword')
  {
    $user_conn=new user();
    $update_row=$user_conn->update_userpassword($_POST);
       
      if($update_row==true)
      {
        echo json_encode(array('resp'=>true,'msg'=>'success'));
      }
      else
      {
        echo json_encode(array('resp'=>false,'msg'=>'error'));
      }
    }

  if($_GET["action"] == 'delete')
	{
		$user_conn=new user();
		$delete_row=$user_conn->delete_user($_POST);
  		 
  		if($delete_row==true)
  		{
  			echo json_encode(array('resp'=>true,'msg'=>'success'));
  		}
  		else
  		{
  			echo json_encode(array('resp'=>false,'msg'=>'error'));
  		}
  	}

  if($_GET["action"] == 'fetchall')
	{
		$user_conn=new user();
		$fetch_row=$user_conn->fetchall();
  		 
  		if(count($fetch_row)>0)
  		{
  			echo json_encode(array('resp'=>true,'user_data'=>$fetch_row));
  		}
  		else
  		{
  			echo json_encode(array('resp'=>false,'user_data'=>''));
  		}
   }

  if($_GET["action"] == 'checklogin')
  {
    $user_conn=new user();
    $fetch_row=$user_conn->checklogin($_POST);
       
      if(count($fetch_row)>0)
      {
        echo json_encode(array('resp'=>true,'user_data'=>$fetch_row));
      }
      else
      {
        echo json_encode(array('resp'=>false,'user_data'=>''));
      }
   }

}


?>