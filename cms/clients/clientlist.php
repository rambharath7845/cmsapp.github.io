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
    <title>Clients List | CMS</title>
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
if(isset($_POST['client_submit']))
{
  $password=md5($_POST['password']);
  $confirmpassword=md5($_POST['confirmpassword']);

  if($password==$confirmpassword)
  {
    $fieldsarray=$_POST;
    $url=$apiurl."client.php?action=insert";
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
  else
  {
    echo "<script type='text/javascript'>
           $(document).ready(function() {
          warningalert();
      });</script>";
  }

}

if(isset($_POST['update_client']))
{
  $fieldsarray=$_POST;
  $url=$apiurl."client.php?action=update";
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

if(isset($_POST['update_clientpassword']))
{
  $password=md5($_POST['password']);
  $confirmpassword=md5($_POST['confirmpassword']);

  if($password==$confirmpassword)
  {
    $fieldsarray=$_POST;
    $url=$apiurl."client.php?action=updatepassword";
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
  else
  {
     echo "<script type='text/javascript'>
             $(document).ready(function() {
            warningalert();
        });</script>";
  }
  
}

if(isset($_POST['delete_client']))
{
  $fieldsarray=$_POST;
  $url=$apiurl."client.php?action=delete";
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

$clienturl=$apiurl."client.php?action=fetchall";
$clientfieldsarray=[];
$fetchclient_row=curlurl($clienturl,$clientfieldsarray);
$clientresonse_arr=json_decode($fetchclient_row,true);
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
                            <h3>Clients</h3>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <button class="btn btn-primary btn-sm float-sm-right" data-toggle="modal" data-target="#addclient">Add Client</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    Clients List
                                </div>
                                <div class="card-body">
                                  <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-hover dataTable no-footer dtr-inline table-responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Client&nbsp;ID</th>
                                                <th>Client Name</th>
                                                <th>Mobile No</th>
                                                <th>User Name</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $sno=0;
                                            if($clientresonse_arr['resp']==1){
                                                foreach ($clientresonse_arr['client_data'] as $cleintarrkey => $cleintarrvalue) {
                                                    $sno++;

                                                    ?>
                                                    <tr>
                                                        <td><?php echo $sno; ?></td>
                                                        <td><?php echo $cleintarrvalue['ClientID']; ?></td>
                                                        <td><?php echo $cleintarrvalue['ClientName']; ?></td>
                                                        <td><?php echo $cleintarrvalue['MobileNo']; ?></td>
                                                        <td><?php echo $cleintarrvalue['UserName']; ?></td>
                                                        <td class="text-center">
                                                          <a href="#" data-toggle="modal" data-target="#editpassword<?php echo $sno; ?>"><i class="fa fa-key text-dark"></i></a>&nbsp;
                                                          <a href="#" data-toggle="modal" data-target="#editclient<?php echo $sno; ?>"><i class="fa fa-edit text-primary"></i></a>&nbsp;
                                                          <a href="#" data-toggle="modal" data-target="#deleteclient<?php echo $sno; ?>"><i class="fa fa-trash text-danger"></i></a>
                                                        </td>

                                                        <div class="modal fade" id="editclient<?php echo $sno; ?>">
                                                          <div class="modal-dialog">
                                                            <form method="post" autocomplete="off">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h4 class="modal-title">Edit Client</h4>
                                                                  <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                  <div class="row">
                                                                    <div class="col-md-6">
                                                                      <div class="form-group">
                                                                        <label>Client Name</label>
                                                                        <input type="text" name="clientname" id="clientnameid" class="form-control" placeholder="Enter the Client Name" value="<?php echo $cleintarrvalue['ClientName'] ?>">
                                                                        <input type="hidden" name="loginid" value="<?php echo $loginid; ?>">
                                                                        <input type="hidden" name="clientid" value="<?php echo $cleintarrvalue['ClientID']; ?>">
                                                                      </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                      <div class="form-group">
                                                                        <label>Mobile No</label>
                                                                        <input type="text" placeholder="Enter the Mobile No" name="mobileno" class="form-control" value="<?php echo $cleintarrvalue['MobileNo'] ?>">
                                                                      </div>
                                                                    </div>
                                                                    <div class="col-md-6 mt-3">
                                                                      <div class="form-group">
                                                                        <label>User Name<sup>*</sup></label>
                                                                        <input type="text" placeholder="Enter the Mobile No" name="username" class="form-control" value="<?php echo $cleintarrvalue['UserName']; ?>" required="">
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="submit" name="update_client" class="btn btn-info btn-sm">Update</button>
                                                                </div>
                                                              </div>
                                                            </form>
                                                            <!-- /.modal-content -->
                                                          </div>
                                                          <!-- /.modal-dialog -->
                                                        </div>

                                                        <div class="modal fade" id="editpassword<?php echo $sno; ?>">
                                                          <div class="modal-dialog">
                                                            <form method="post" autocomplete="off">
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <h4 class="modal-title">Edit Password</h4>
                                                                  <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                  </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                  <div class="row">
                                                                    <div class="col-md-6">
                                                                      <div class="form-group">
                                                                        <label>PassWord</label>
                                                                        <input type="password" name="password" id="passwordid<?php echo $sno; ?>" onkeyup="passwordMatch('<?php echo $sno; ?>')" class="form-control" placeholder="******">
                                                                        <input type="hidden" name="loginid" value="<?php echo $loginid; ?>">
                                                                        <input type="hidden" name="clientid" value="<?php echo $cleintarrvalue['ClientID']; ?>">
                                                                      </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                      <div class="form-group">
                                                                        <label>Confirm Password<sup>*</sup></label>
                                                                        <input type="password" placeholder="******" name="confirmpassword" onkeyup="passwordMatch('<?php echo $sno; ?>')" id="confirmpasswordid<?php echo $sno; ?>" class="form-control" >
                                                                      </div>
                                                                    </div>
                                                                    <div class="mt-1" id="passmsg<?php echo $sno; ?>"></div>
                                                                  </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="submit" name="update_clientpassword" class="btn btn-info btn-sm">Update</button>
                                                                </div>
                                                              </div>
                                                            </form>
                                                            <!-- /.modal-content -->
                                                          </div>
                                                          <!-- /.modal-dialog -->
                                                        </div>

                                                        <div id="deleteclient<?php echo $sno;?>" class="modal fade">
                                                          <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                              <form action="" class="form-horizontal" method="POST">
                                                                <div class="modal-header">
                                                                  <h5 class="modal-title"> Delete Client </h5>
                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                  <div class="form-group">
                                                                    <div class="col-sm-9">
                                                                      <input type="hidden" class="form-control" name="clientid" value="<?php echo $cleintarrvalue['ClientID']; ?>"> 
                                                                      <input type="hidden" name="loginid" value="<?php echo $loginid; ?>">
                                                                      <p>Are you sure? You need to Delete This Source?</p>
                                                                      <span class="help-block"></span>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="submit" class="btn btn-danger" name="delete_client">Delete</button>
                                                                </div>
                                                              </form>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </tr>
                                                <?php }} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="addclient">
                      <div class="modal-dialog">
                        <form method="post" autocomplete="off">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Add Client</h4>
                              <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Client Name</label>
                                    <input type="text" name="clientname" id="clientnameid" class="form-control" placeholder="Enter the Client Name">
                                    <input type="hidden" name="loginid" value="<?php echo $loginid; ?>">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Mobile No</label>
                                    <input type="text" placeholder="Enter the Mobile No" name="mobileno" class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                  <div class="form-group">
                                    <label>User Name<sup>*</sup></label>
                                    <input type="text" placeholder="Enter the User Name" name="username" class="form-control" required="">
                                  </div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6 mt-3">
                                  <div class="form-group">
                                    <label>Password<sup>*</sup></label>
                                    <input type="password" placeholder="******" onkeyup="passwordMatch('')" name="password" id="passwordid" class="form-control" required="">
                                  </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                  <div class="form-group">
                                    <label>Confirm Password<sup>*</sup></label>
                                    <input type="password" placeholder="******" onkeyup="passwordMatch('')" name="confirmpassword" id="confirmpasswordid" class="form-control" required="">
                                  </div>
                                </div>
                                <div class="mt-1" id="passmsg"></div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" name="client_submit" class="btn btn-success btn-sm">Add</button>
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
        $('#addclient').on('shown.bs.modal', function (e) {
           $("#clientnameid").focus();
        });

        function passwordMatch(id) 
        {
          if($('#confirmpasswordid'+id).val()!='')
          {
            if($('#passwordid'+id).val() == $('#confirmpasswordid'+id).val()) 
            {
              $('#passmsg'+id).html('Matching').css('color', 'green');
            } 
            else
            {
              $('#passmsg'+id).html('Not Matching! Password and Confirm Password must be same!').css('color', 'red');
            }
          }
          
        }
    </script>
</body>
</html>
