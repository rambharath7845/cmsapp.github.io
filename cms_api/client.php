<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json; charset=utf-8');

include 'functions/client.php'; 


if(isset($_GET["action"]))
{
	if($_GET["action"] == 'insert')
	{
		$client_conn=new client();
		$insert_row=$client_conn->insert_client($_POST);
  		 
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
		$client_conn=new client();
		$update_row=$client_conn->update_client($_POST);
  		 
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
    $client_conn=new client();
    $update_row=$client_conn->update_clientpassword($_POST);
       
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
		$client_conn=new client();
		$delete_row=$client_conn->delete_client($_POST);
  		 
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
		$client_conn=new client();
		$fetch_row=$client_conn->fetchall();
  		 
  		if(count($fetch_row)>0)
  		{
  			echo json_encode(array('resp'=>true,'client_data'=>$fetch_row));
  		}
  		else
  		{
  			echo json_encode(array('resp'=>false,'client_data'=>''));
  		}
   }

  if($_GET["action"] == 'checklogin')
  {
    $client_conn=new client();
    $fetch_row=$client_conn->checklogin($_POST);
       
      if(count($fetch_row)>0)
      {
        echo json_encode(array('resp'=>true,'client_data'=>$fetch_row));
      }
      else
      {
        echo json_encode(array('resp'=>false,'client_data'=>''));
      }
   }

  if($_GET["action"] == 'emp_checklogin')
  {
    $client_conn=new client();
    $fetch_row=$client_conn->emp_checklogin($_POST);
       
      if(count($fetch_row)>0)
      {
        echo json_encode(array('resp'=>true,'employee_data'=>$fetch_row));
      }
      else
      {
        echo json_encode(array('resp'=>false,'employee_data'=>''));
      }
   }
}


?>