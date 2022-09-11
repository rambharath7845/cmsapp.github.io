<?php  
include 'configure.php';
include 'functions/php/helpers/curl.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Employee Login | CMS</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="<?php echo $mybase; ?>assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $mybase; ?>assets/css/datatables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo $mybase; ?>assets/css/datatables/datatable.responsive.min.css" rel="stylesheet">
    <link href="<?php echo $mybase; ?>assets/css/main.css" rel="stylesheet">
    <script src="<?php echo $mybase; ?>assets/js/plugins/jquery/jquery.min.js"></script>
    <?php include("assets/sweetalert.html");?>
</head>
<?php  

if(isset($_SESSION['login_user']) OR isset($_COOKIE['login_user']))
{
header("location:articles/"); 
}
 

if(isset($_POST['employee_login']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $fieldsarray=$_POST;
    $url=$apiurl."client.php?action=emp_checklogin";
    $insert_row=curlurl($url,$fieldsarray);
    $resonse_arr=json_decode($insert_row,true);

     if($resonse_arr['resp']==1)
     {
        if(($resonse_arr['employee_data'][0]['UserName']==$username) && ($resonse_arr['employee_data'][0]['PassWord']==md5($password)))
        {
            $login_userid=$resonse_arr['employee_data'][0]['UserID'];
            $login_user=$resonse_arr['employee_data'][0]['ClientName'];
            $_SESSION['login_userid']=$login_userid; 
            $_SESSION['login_user']=$login_user;
            $_SESSION['isclient']=0;

            setcookie("login_userid", "$login_userid", time()+84600,'/');
            setcookie("login_user", "$username", time()+84600,'/');
            setcookie("isclient", "0", time()+84600,'/');

            header("location:articles/"); 
        }
     }
     else
     {
        echo "<script type='text/javascript'>
               $(document).ready(function() {
              loginalert();
          });</script>";
     }
}
?>
<body>
    <div class="d-flex" id="wrapper">
        <div id="page-content-wrapper" >

            <section class="content-header" style="min-height: 554.8px; vertical-align:middle;">
                <div class="container-fluid customcontainer mt-3" style="">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            
                        </div>
                    </div>
                    <div class="row">

                        <center><h1 style="font-weight:bold;">CMS EMPLOYEE</h1></center>
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-body login-card-body">
                                    <p class="login-box-msg">Sign in to your account</p>

                                    <form method="post" autocomplete="off">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="username" style="border-right:unset;" placeholder="User Name">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fa fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" id="passid" name="password" class="form-control" style="border-right:unset;" placeholder="Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fa fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="icheck-primary">
                                                    <input type="checkbox" onclick="showhidepass()" id="remember">
                                                    <label for="remember">
                                                        Show Password
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center mt-3">
                                                <button type="submit" name="employee_login" class="btn btn-secondary btn-block">Log In</button>
                                            </div>

                                            <div class="col-12 text-center mt-4">
                                                <a href="<?php echo $mybase; ?>" style="float:right; font-weight:bold;" type="button" class="text-success float-right">Click here for Client Log In</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </section>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="<?php echo $mybase; ?>assets/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo $mybase; ?>assets/js/plugins/datatable/jquery.datatable.min.js"></script>
    <script src="<?php echo $mybase; ?>assets/js/plugins/datatable/datatable.responsive.min"></script>
    <script src="<?php echo $mybase; ?>assets/js/plugins/datatable/datatable.bootstrap4.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?php echo $mybase; ?>assets/js/main.js"></script>
    <script type="text/javascript">
         function showhidepass() {
        var showpass = document.getElementById("passid");
        if (showpass.type === "password") {
        showpass.type = "text";
        } else {
        showpass.type = "password";
        }
        }
    </script>
    </body>
    </html>
