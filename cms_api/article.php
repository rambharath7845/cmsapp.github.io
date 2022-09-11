<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json; charset=utf-8');

include 'functions/article.php'; 


if(isset($_GET["action"]))
{
	if($_GET["action"] == 'insert')
	{
		$article_conn=new article();
		$insert_row=$article_conn->insert_article($_POST);
  		 
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
		$article_conn=new article();
		$update_row=$article_conn->update_article($_POST);
  		 
  		if($update_row==true)
  		{
  			echo json_encode(array('resp'=>true,'msg'=>'success'));
  		}
  		else
  		{
  			echo json_encode(array('resp'=>false,'msg'=>'error'));
  		}
  	} 
  if($_GET["action"] == 'changestatus')
  {
    $article_conn=new article();
    $update_row=$article_conn->changestatus($_POST);
       
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
		$article_conn=new article();
		$delete_row=$article_conn->delete_article($_POST);
  		 
  		if($delete_row==true)
  		{
  			echo json_encode(array('resp'=>true,'msg'=>'success'));
  		}
  		else
  		{
  			echo json_encode(array('resp'=>false,'msg'=>'error'));
  		}
  	}

  if($_GET["action"] == 'fetchall_article')
	{
		$article_conn=new article();
		$fetch_row=$article_conn->fetchall_article($_POST);
  		 
  		if(count($fetch_row)>0)
  		{
  			echo json_encode(array('resp'=>true,'article_data'=>$fetch_row));
  		}
  		else
  		{
  			echo json_encode(array('resp'=>false,'article_data'=>''));
  		}
   }

  if($_GET["action"] == 'fetchall_client')
  {
    $article_conn=new article();
    $fetch_row=$article_conn->fetchall_client();
       
      if(count($fetch_row)>0)
      {
        echo json_encode(array('resp'=>true,'client_data'=>$fetch_row));
      }
      else
      {
        echo json_encode(array('resp'=>false,'client_data'=>''));
      }
   }
}


?>