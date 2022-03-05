<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- navbar -->
<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg pl-0 pr-0">
    <div class="ml-2 pb-1"><img src="<?php echo URLROOT; ?>/images/tcclogo.png" width="40"> </div>
    <button class="btn btn-dark navbar-toggler ml-auto mb-2 mr-2" type="button" data-toggle="collapse" data-target="#myNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myNavbar">
        <div class="container-fluid">
            <div class="row">
                <!-- sidebar -->
                <div class="col-xl-2 col-lg-3 col-md-12 sidebar fixed-top">
                    <a href="#" class="navbar-brand text-white d-block mx-auto text-center py-3 mb-4"><img src="<?php echo URLROOT; ?>/images/zoneclaudians.svg" width="150"></a>
                    <ul class="navbar-nav flex-column mt-4">
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/admins/home" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-home text-light fa-lg mr-3"></i>Home</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/admins/administrator" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-users text-light fa-lg mr-3"></i>Admins</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/admins/registrar" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-users text-light fa-lg mr-3"></i>Registrar</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/admins/instructors" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-users text-light fa-lg mr-3"></i>Instructors</a></li>
                    </ul>
                </div>
                <!-- end of sidebar -->
                <!-- top-nav -->
                <div class="col-xl-10 col-lg-9 col-md-8 ml-lg-auto pt-3 pb-2 fixed-top top-navbar bg">
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-12 text-white">
                            <h4>CZ Admin</h4>
                        </div>
                        <div class="ml-lg-auto mr-3 ml-3">
                            <div class="dropdowns">
                                <a class="dropdown-toggle text-light" href="" id="navbarDropdown" role="button" data-toggle="dropdown">
                                    <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right mr-xl-1 mt-1" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-item"><strong>My Account</strong></div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item small" href="<?php echo URLROOT; ?>/admins/change_userId">Change User Id</a>
                                    <a class="dropdown-item small" href="<?php echo URLROOT; ?>/admins/change_password">Change Password</a>
                                    <a class="dropdown-item small" href="" name="btn-logout" data-toggle="modal" data-target="#logout">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of top-nav -->
            </div>
        </div>
    </div>
</nav>
<!-- end of navbar -->
<!--modal logout-->
<div class="modal" tabindex="-1" role="dialog" id="logout">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form method="post" action="<?php echo URLROOT; ?>/users/logout"><button class="btn btn-success">Logout</button></form>
            </div>
        </div>
    </div>
</div>

<!--end of modal logout-->

<!--content start-->
<section>
    <div class="container-fluid">
        <div class="col-xl-10 col-lg-9 col-md-12 ml-auto">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="mt-5">
                        <?php flash('update_success'); ?>
                        <h2>Change Password</h2>
                        <p>Please complete all field to change password</p>
                        <form action="<?php echo URLROOT; ?>/admins/change_password" method="post">
                            <div class="form-group">
                                <label for="name"><strong>User Id: <sup>*</sup></strong></label>
                                <input type="text" name="user_id" class="form-control form-control <?php echo (!empty($data['user_err'])) ? 'is-invalid' : ''; ?>">
                                <span class="invalid-feedback"><?php echo $data['user_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="old_password"><strong>Password: <sup>*</sup></strong></label>
                                <input type="text" name="old_password" class="form-control form-control <?php echo (!empty($data['old_password_err'])) ? 'is-invalid' : ''; ?>">
                                <span class="invalid-feedback"><?php echo $data['old_password_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="password"><strong>New Password: <sup>*</sup></strong></label>
                                <input type="text" name="password" class="form-control form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
                                <span class=" invalid-feedback"><?php echo $data['password_err']; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password"><strong>Confirm Password: <sup>*</sup></strong></label>
                                <input type="text" name="confirm_password" class="form-control form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>">
                                <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <input type="submit" value="Accept" class="btn btn-success btn-block">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--end of content-->
<!--Confirmation modal-->

<!--End of confirmation modal-->
<?php require APPROOT . '/views/inc/footer.php'; ?>