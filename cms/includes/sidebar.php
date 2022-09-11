<?php 
$curpage = basename(substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'.')));
$curfolder = basename(substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'/')));
?>
<div class="border-end bg-sidebar" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-sidebar"><h4 class="text-white text-center" style="font-weight:bold;">CMS</h4></div>
    <!-- <div class="list-group list-group-flush" style="padding:10px 8px;">
        <a class="list-group-item list-group-item-action list-group-item-grey active" href="#">
        Dashboard
       
        </a>
         <li style="list-style:none;color:#fff;">
            <a class="list-group-item list-group-item-action list-group-item-grey" href="#">Shortcuts</a>
        </li>
        <a class="list-group-item list-group-item-action list-group-item-grey" href="#">Shortcuts</a>
        <a class="list-group-item list-group-item-action list-group-item-grey" href="#">Overview</a>
    </div> -->
    <!-- <ul class="list-group list-group-flush" style="padding:10px 8px;">
        <li>
            <a class="list-group-item list-group-item-action list-group-item-grey" href="#">Dashboard </a>
        </li>
        <li>
            <a class="list-group-item list-group-item-action list-group-item-grey" href="#">Dashboard <i class="fa fa-angle-left"></i></a>
            <ul>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-grey active" href="#">Dashboard</a>
                </li>
                <li>
                    <a class="list-group-item list-group-item-action list-group-item-grey" href="#">Dashboard
                    </a>
                </li>
            </ul>
        </li>
    </ul> -->
  
<!--     <ul class="tree list-group list-group-flush" style="padding:10px 8px;">
        <li>
            <details open="">
                <summary class="list-group-item list-group-item-action list-group-item-grey"><i class="fa fa-users iconside"></i>&nbsp;Clients</summary>
                <ul style="list-style:none;">
                    <li><a class="list-group-item list-group-item-action list-group-item-grey active" href="<?php echo $mybase; ?>clients/clientlist.php">Clients List</a></li>
                </ul>
            </details>
        </li>
        <li>
            <details open="">
                <summary class="list-group-item list-group-item-action list-group-item-grey">Articles</summary>
                <ul style="list-style:none;">
                    <li><a class="list-group-item list-group-item-action list-group-item-grey active" href="<?php echo $mybase; ?>articles/">Articles List</a></li>
                </ul>
            </details>
        </li>
        <li>
            <details open="">
                <summary class="list-group-item list-group-item-action list-group-item-grey">Settings</summary>
                <ul style="list-style:none;">
                    <li><a class="list-group-item list-group-item-action list-group-item-grey" href="<?php echo $mybase; ?>settings/adduser.php">User Management</a></li>
                </ul>
            </details>
        </li>
    </ul> -->
    <ul class="list-unstyled components list-group list-group-flush" style="padding:10px 8px;">
        <li>
            <a class="<?php if($curfolder=='clients'){echo "parent-active";} ?> list-group-item list-group-item-action list-group-item-grey" onclick="toggleMenu(this.id);" href="#clients" data-toggle="collapse" id="clienttog" aria-expanded="false"><i class="fa fa-users"></i>&nbsp;Clients <span style="text-align:right;"><i class="iconcls fa <?php if($curfolder=='clients'){echo "fa fa-angle-down";}else{echo "fa fa-angle-left";} ?>"></i></span></a>
        </li>
        <ul class="collapse list-unstyled <?php if($curfolder=='clients'){echo "show";}else{} ?>" id="clients">
            <li>
                <a class="list-group-item list-group-item-action list-group-item-grey <?php if($curpage=='clientlist'){echo "active";}else{} ?>" href="<?php echo $mybase; ?>clients/clientlist.php">Clients List</a>
            </li>
        </ul>
        <li>
            <a class="<?php if($curfolder=='articles'){echo "parent-active";} ?> list-group-item list-group-item-action list-group-item-grey" onclick="toggleMenu(this.id);" href="#articles" data-toggle="collapse" id="clienttog" aria-expanded="false"><i class="fa fa-book"></i>&nbsp;Articles <span style="text-align:right;"><i class="iconcls fa <?php if($curfolder=='articles'){echo "fa fa-angle-down";}else{echo "fa fa-angle-left";} ?>"></i></span></a>
        </li>
        <ul class="collapse list-unstyled <?php if($curfolder=='articles'){echo "show";}else{} ?>" id="articles">
            <li>
                <a class="list-group-item list-group-item-action list-group-item-grey <?php if($curpage=='index'){echo "active";}else{} ?>" href="<?php echo $mybase; ?>articles/">Articles List</a>
            </li>
        </ul>
        <li>
            <a class="<?php if($curfolder=='settings'){echo "parent-active";} ?> list-group-item list-group-item-action list-group-item-grey" onclick="toggleMenu(this.id);" href="#settings" data-toggle="collapse" id="clienttog" aria-expanded="false"><i class="fa fa-cogs"></i>&nbsp;Settings <span style="text-align:right;"><i class="iconcls fa <?php if($curfolder=='settings'){echo "fa fa-angle-down";}else{echo "fa fa-angle-left";} ?>"></i></span></a>
        </li>
        <ul class="collapse list-unstyled <?php if($curfolder=='settings'){echo "show";}else{} ?>" id="settings">
            <li>
                <a class="list-group-item list-group-item-action list-group-item-grey <?php if($curpage=='adduser'){echo "active";}else{} ?>" href="<?php echo $mybase; ?>settings/adduser.php">User Management</a>
            </li>
        </ul>
    </ul>
     <!--  <ul class="list-unstyled components list-group list-group-flush">
            <li class="active list-group-item list-group-item-action list-group-item-grey">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-home"></i>
                    Home
                </a>
                <ul >
                    <li class="list-group-item list-group-item-action list-group-item-grey">
                        <a href="#">Home 1</a>
                    </li>
                    <li class="list-group-item list-group-item-action list-group-item-grey">
                        <a href="#">Home 2</a>
                    </li>
                    <li class="list-group-item list-group-item-action list-group-item-grey">
                        <a href="#">Home 3</a>
                    </li>
                </ul>
            </li>
        </ul> -->
</div>