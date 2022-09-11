<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <button class="btn btn-primary" id="sidebarToggle"><i class="fa fa-bars"></i></button>
        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" style="font-size:26px;"></i></a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo $mybase; ?>logout.php"><i class="fa fa-power-off text-danger"></i>&nbsp;Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>