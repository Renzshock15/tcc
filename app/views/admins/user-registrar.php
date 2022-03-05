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
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/admins/registrar" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-users text-light fa-lg mr-3"></i>Registrar</a></li>
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
<section>
    <div class="container-fluid pl-0 pr-0">
        <div class="col-xl-10 col-lg-9 col-md-12 ml-auto">
            <div class="row">
                <div class="col-12 mx-auto">
                    <!--navigation-->
                    <div class="card pl-0 pr-0 mt-3">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <h4>Registrar</h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">

                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of navigation-->
                </div>
            </div>
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="card pl-0 pr-0 mt-1">

                        <div class="card-header bg-white">
                            <button class="btn btn-primary float-right addRegistrar" href="" data-id="" role="button"><i class="fas fa-user-plus"></i> Registrar</button>

                        </div>
                        <div class="card-body">
                            <div class="row mb-2">

                                <div class="col-lg-4">

                                </div><!-- end col-->
                            </div>


                            <div class="table-responsive">
                                <div id="outputJr">
                                    <?php if (!empty($data['userRegistrar'])) : ?>
                                        <table class="tablesgrade" id="jrTable">
                                            <thead>
                                                <tr>
                                                    <th>Full Name</th>
                                                    <th>Department</th>
                                                    <th>Role</th>
                                                    <th>Active</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <div id="outputJr">
                                                    <?php foreach ($data['userRegistrar'] as $admins) : ?>
                                                        <tr>
                                                            <td data-label="Full Name">
                                                                <?php echo $admins->last_name . ', ' . $admins->first_name; ?>
                                                            </td>
                                                            <td data-label="Department">
                                                                <?php echo $admins->department; ?>
                                                            </td>
                                                            <td data-label="Role">
                                                                <?php echo $admins->role; ?>
                                                            </td>
                                                            <td data-label="Active">
                                                                <?php if ($admins->is_active == 1) {
                                                                    echo 'Yes';
                                                                } else {
                                                                    echo 'No';
                                                                }
                                                                ?>
                                                            </td>

                                                        </tr>
                                                    <?php endforeach; ?>
                                                </div>

                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                </div>


                                <?php if (empty($data['userRegistrar'])) : ?>
                                    <h5 class="ml-1 mt-3"><?php echo 'No available registrar'; ?></h5>
                                <?php endif; ?>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--end of content-->
<div class="modal" tabindex="-1" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Administrator</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" class="form-control fname" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" class="form-control lname" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">User Id</label>
                            <input type="text" class="form-control userId" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-2">
                            <label for="status-select" class="mr-2">Department</label>
                            <select class="custom-select" id="status-select">
                                <option selected="">Choose...</option>
                                <option value="Basic Education">Basic Education</option>
                                <option value="College - Masteral">College - Masteral</option>

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelModalsss" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveAdmin">Save Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="deleteConfirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelModalsss" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary deleteYes">Yes Delete</button>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
    $(document).ready(function() {
        $('.addRegistrar').click(function() {
            $('#addModal').toggle();

            $('.saveAdmin').click(function() {
                var fname = $('.fname').val();
                var lname = $('.lname').val();
                var userId = $('.userId').val();
                var department = $('#status-select').val();
                if (fname === '' || lname === '' || userId === '' || department === 'Choose...') {
                    alert('Please fill all fields')
                } else {
                    $.ajax({
                        url: '<?php echo URLROOT ?>' + '/Actions/addNewRegistrar',
                        method: 'post',
                        data: {
                            fname: fname,
                            lname: lname,
                            userId: userId,
                            department: department
                        },
                        success: function(response) {
                            $('#addModal').hide();
                            alert(response);

                            location.reload();

                        }
                    });
                }
            });
            closeModal()
        });



        function closeModal() {
            $('.cancelModalsss').click(function() {
                location.reload();
            });
        }
    });
</script>