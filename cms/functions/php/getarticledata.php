<?php 
include("../../configure.php");
include 'helpers/curl.php';
$isclient=$_SESSION['isclient'];
$clientid_search=$_POST["clientid_search"];

$addqry="";

if(isset($clientid_search) && $clientid_search!='')
{
  $addqry.="AND ClientID='$clientid_search'";
}
else
{
	$addqry .='';
}


$fieldsarray=array("mode"=>"filter","isclient"=>$isclient,"filterdata"=>$addqry);
$url=$apiurl."article.php?action=fetchall_article";
$fetch_row=curlurl($url,$fieldsarray);
$fetchresonse_arr=json_decode($fetch_row,true);
?>
<table id="example" class="table table-bordered table-hover dataTable no-footer dtr-inline table-responsive" style="width:100%">
  <thead>
      <tr>
          <th>Article&nbsp;ID</th>
          <th>Try Here</th>
          <th>Current&nbsp;Status</th>
          <th>Comments</th>
      </tr>
  </thead>
  <tbody>
      <?php 
      $sno=0;
      if($fetchresonse_arr['resp']==1){
          foreach ($fetchresonse_arr['article_data'] as $arrkey => $arrvalue) {
              $sno++;

              ?>
              <tr>
                  <td><?php echo $sno; ?></td>
                  <td><a href="<?php echo $arrvalue['ArticleLink']; ?>"><?php echo $arrvalue['ArticleLink']; ?></a></td>
                  <td><?php echo $arrvalue['StatusLabel']; ?></td>
                  <td id="tooltip<?php echo $sno; ?>" data-html="true" data-toggle="tooltip" data-placement="top" title="<?php echo $arrvalue['Comments']; ?>"><span id="cmtspan<?php echo $sno; ?>"><?php echo $arrvalue['CommentsShort']; ?></span>
                  </td>
              </tr>
          <?php }} ?>
      </tbody>
      <?php if($fetchresonse_arr['resp']!=1){ ?>
        <center><h4>No Records Found !</h4></center>
      <?php } ?>
  </table>
