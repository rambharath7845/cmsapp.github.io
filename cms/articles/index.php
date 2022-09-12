<?php  
include '../configure.php';
include '../functions/php/helpers/curl.php';
include '../includes/session_data.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Articles | CMS</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="<?php echo $mybase; ?>assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $mybase; ?>assets/css/datatables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo $mybase; ?>assets/css/datatables/datatable.responsive.min.css" rel="stylesheet">
    <!-- <link href="<?php echo $mybase; ?>assets/css/boostrap.utilities.css" rel="stylesheet"> -->
    <link href="<?php echo $mybase; ?>assets/css/main.css" rel="stylesheet">
    <script src="<?php echo $mybase; ?>assets/js/plugins/jquery/jquery.min.js"></script>
     <?php include("../assets/sweetalert.html");?>
</head>
<?php  
if(isset($_POST['article_submit']))
{
  $fieldsarray=$_POST;
  $url=$apiurl."article.php?action=insert";
  $insert_row=curlurl($url,$fieldsarray);
  $resonse_arr=json_decode($insert_row,true);

  if($resonse_arr['msg']=='success')
  {
      echo "<script type='text/javascript'>
           $(document).ready(function() {
          insertalert();
      });</script>";
  }
  else
  {
    echo "<script type='text/javascript'>
           $(document).ready(function() {
          warningalert();
      });</script>";
  }
}

if(isset($_POST['update_article']))
{
  $fieldsarray=$_POST;
  $url=$apiurl."article.php?action=update";
  $update_row=curlurl($url,$fieldsarray);
  $resonse_arr=json_decode($update_row,true);

  if($resonse_arr['msg']=='success')
  {
      echo "<script type='text/javascript'>
           $(document).ready(function() {
          updatealert();
      });</script>";
  }
  else
  {
    echo "<script type='text/javascript'>
           $(document).ready(function() {
          warningalert();
      });</script>";
  }
}

if(isset($_POST['delete_article']))
{
  $fieldsarray=$_POST;
  $url=$apiurl."article.php?action=delete";
  $delete_row=curlurl($url,$fieldsarray);
  $resonse_arr=json_decode($delete_row,true);

  if($resonse_arr['msg']=='success')
  {
      echo "<script type='text/javascript'>
           $(document).ready(function() {
          deletealert();
      });</script>";
  }
  else
  {
    echo "<script type='text/javascript'>
           $(document).ready(function() {
          warningalert();
      });</script>";
  }
}

$url=$apiurl."article.php?action=fetchall_article";
$fieldsarray=array("loginid"=>$loginid,"isclient"=>$isclient,"mode"=>'');
$fetch_row=curlurl($url,$fieldsarray);
$fetchresonse_arr=json_decode($fetch_row,true);

if($isclient==0)
{
    $clienturl=$apiurl."article.php?action=fetchall_client";
    $clientfieldsarray=[];
    $fetchclient_row=curlurl($clienturl,$clientfieldsarray);
    $clientresonse_arr=json_decode($fetchclient_row,true);
}
else
{
    $clientresonse_arr=[];
}

?>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <?php include '../includes/sidebar.php'; ?>
        <!-- Sidebar End-->
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php include '../includes/header.php'; ?>
            <!-- Page content-->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-md-6 col-sm-6 col-6">
                            <h3>Articles</h3>
                        </div>
                        <?php if($isclient!=1){ ?>
                        <div class="col-md-6 col-sm-6 col-6">
                            <button class="btn btn-primary btn-sm float-sm-right" data-toggle="modal" data-target="#addarticle">Add Articles</button>
                        </div>
                        <?php } ?>
                    </div>
                    <?php if($isclient!=1){ ?>
                    <div class="row mb-3">
                      <div class="col-md-12 col-sm-12 col-12">
                        <div class="card">
                           <div class="card-body">
                            <div class="row">
                              <label class="col-md-4 col-sm-3 col-3 col-form-label" style="text-align:right;">Client</label>
                              <div class="col-md-4 col-sm-6 col-6">
                                <select class="form-control" id="client_id">
                                    <option value="">Select Client</option>
                                    <?php  
                                    if($clientresonse_arr['resp']==1){
                                        foreach ($clientresonse_arr['client_data'] as $cleintarrkey => $cleintarrvalue) {
                                    ?>
                                    <option value="<?php echo $cleintarrvalue['ClientID'] ?>"><?php echo $cleintarrvalue['ClientName'] ?></option>
                                    <?php }} ?>
                                </select>
                              </div>
                              <div class="col-md-4 col-sm-3 col-3">
                                <button class="btn btn-secondary btn-sm mt-1" onclick="filterarticle('<?php echo $mybase; ?>')">Search</button>
                              </div>
                            </div>
                           </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-header" id="artheaderhtml">
                                    Articles List
                                </div>
                                <div class="card-body">
                                  <div class="table-responsive" id="filterresp">
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
                                                        <td>
                                                            <?php if($isclient==1){ ?>
                                                            <select  onchange="checkoptionval('<?php echo $mybase; ?>','<?php echo $sno; ?>','<?php echo $arrvalue['ArticleID'] ?>',this.value)" class="form-control form-control-sm" id="currentstatusid<?php echo $sno; ?>" style="width:50%;">
                                                                <option value="1" <?php if($arrvalue['CurrentStatus']==1){echo "selected";} ?>>Yes</option>
                                                                <option value="0" <?php if($arrvalue['CurrentStatus']==0){echo "selected";} ?>>No</option>
                                                            </select>
                                                          <?php }else{ ?>
                                                            <?php echo $arrvalue['StatusLabel']; ?>
                                                          <?php } ?>
                                                        </td>
                                                        <td id="tooltip<?php echo $sno; ?>" data-html="true" data-toggle="tooltip" data-placement="top" title="<?php echo $arrvalue['Comments']; ?>"><span id="cmtspan<?php echo $sno; ?>"><?php echo $arrvalue['CommentsShort']; ?></span>
                                                        </td>
                                                    </tr>
                                                <?php }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="addarticle">
                      <div class="modal-dialog">
                        <form method="post" autocomplete="off">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Add Articles</h4>
                              <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Client</label>
                                        <select class="form-control" required=""  name="clientid" id="clientid">
                                            <option value="">Select Client</option>
                                            <?php  
                                            if($clientresonse_arr['resp']==1){
                                                foreach ($clientresonse_arr['client_data'] as $cleintarrkey => $cleintarrvalue) {
                                            ?>
                                            <option value="<?php echo $cleintarrvalue['ClientID'] ?>"><?php echo $cleintarrvalue['ClientName'] ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Article Name</label>
                                    <input type="text" name="articlename" class="form-control" placeholder="Enter the Article Name">
                                    <input type="hidden" name="loginid" value="CLT001">
                                  </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                  <div class="form-group">
                                    <label>Article Link<sup>*</sup></label>
                                    <input type="text" placeholder="Enter the Article Link" name="articlelink" class="form-control" required="">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="article_submit" class="btn btn-success btn-sm">Add</button>
                            </div>
                          </div>
                        </form>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>

                    <div class="modal fade" id="statuspopup">
                      <div class="modal-dialog">
                        <form method="post" autocomplete="off">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Add Articles</h4>
                              <button type="button" class="close" onclick="closemodal('statuspopup')" data-dismiss="modal" data-target="#statuspopup" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Comments</label>
                                    <textarea cols="10" rows="4" class="form-control" id="articlecmtid"></textarea>
                                    <input type="hidden" id="articlenoid">
                                    <input type="hidden" id="articlestatusid">
                                    <input type="hidden" id="articlerowid">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button"  onclick="closemodal('statuspopup')" class="btn btn-danger btn-sm">Cancel</button>
                              <button type="button" id="modalformbtn" onclick="changearticlestatus('statuspopup')" class="btn btn-success btn-sm">Ok</button>
                            </div>
                          </div>
                        </form>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                </div> 
            </section>
        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="<?php echo $mybase; ?>assets/js/plugins/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $mybase; ?>assets/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo $mybase; ?>assets/js/plugins/datatable/jquery.datatable.min.js"></script>
    <script src="<?php echo $mybase; ?>assets/js/plugins/datatable/datatable.responsive.min"></script>
    <script src="<?php echo $mybase; ?>assets/js/plugins/datatable/datatable.bootstrap4.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?php echo $mybase; ?>assets/js/main.js"></script>
    <script type="text/javascript">
        function closemodal(id)
        {
            $('#'+id).modal('hide');
        }

        function checkoptionval(myurl,sno,articleid,optionval)
        {
            $('#articlerowid').val(sno);
            $('#articlestatusid').val(optionval);
            $('#articlenoid').val(articleid);

            if(optionval==0)
            {
                $('#statuspopup').modal({backdrop: 'static', keyboard: false})  
                $('#statuspopup').modal('show');
            }
            else
            {
                changearticlestatus();
            }
        }

        function changearticlestatus(modalid=null)
        {
            sno=$('#articlerowid').val();
            optionval=$('#articlestatusid').val();
            articleid=$('#articlenoid').val();
            articlecmtid=$('#articlecmtid').val();

            if(modalid!=null)
            {
                $('#'+modalid).modal('hide');
            }

            if(optionval==1){articlecmtid="";}
            myurl='<?php echo $mybase ?>';
            loginid='<?php echo $loginid ?>';
            $.ajax({
                type: "POST",
                url: myurl+"functions/php/changestatus.php",
                data:  {
                    articleid_post:articleid,
                    optionval_post:optionval,
                    articlecmtid_post:articlecmtid,
                    loginid_post:loginid
                },
                dataType: "json",
                cache: false,
                success: function(response){
                    if(response==true)
                    {
                        updatealert();
                        if(optionval==0)
                        {
                            if(articlecmtid.length > 30) 
                            {
                                var shortcmt = articlecmtid.substring(0, 30) + "...";
                            }
                            else
                            {
                                var shortcmt=articlecmtid;
                            }

                            $('#tooltip'+sno).attr('title',articlecmtid);
                            $("#cmtspan"+sno).html(shortcmt);
                        }
                        else
                        {
                            $("#cmtspan"+sno).html('');
                        }

                            $("#articlecmtid").val('');
                            $("#articlenoid").val('');
                            $("#articlestatusid").val('');
                            $("#articlerowid").val('');
                            
                            
                            
                            
                    }
                    else
                    {
                        warningalert();
                    }

                }
            });
        }

        $('#addarticle').on('shown.bs.modal', function (e) {
           $("#clientid").focus();
        });

        $('#statuspopup').on('shown.bs.modal', function (e) {
           $("#articlecmtid").focus();
        });

        function filterarticle(myurl)
        {
          clientid=$("#client_id").val();
          $.ajax({
            type: "POST",
            url: myurl+"functions/php/getarticledata.php",
            data:  {
              clientid_search:clientid
            },
            cache: false,
            success: function(response)
            {
              $("#filterresp").html(response);
               $('#example').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
              });
            }
          });
        }
    </script>
</body>
</html>
