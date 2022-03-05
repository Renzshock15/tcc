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
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/teachers/home" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-home text-light fa-lg mr-3"></i>Home</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/teachers/my_loads" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-list text-light fa-lg mr-3"></i>My Loads</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/teachers/my_class" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="far fa-address-book text-light fa-lg mr-3"></i>Class Record</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/teachers/history" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-history text-light fa-lg mr-3"></i>History</a></li>
                    </ul>
                </div>
                <!-- end of sidebar -->
                <!-- top-nav -->
                <div class="col-xl-10 col-lg-9 col-md-8 ml-lg-auto pt-3 pb-2 fixed-top top-navbar bg">
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-12 text-white">
                            <h4><?php echo 'SY ' . $_SESSION['school_year']; ?></h4>
                        </div>
                        <div class="ml-lg-auto mr-3 ml-3">
                            <div class="dropdowns">
                                <a class="dropdown-toggle text-light" href="" id="navbarDropdown" role="button" data-toggle="dropdown">
                                    <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right mr-xl-1 mt-1" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-item"><strong>My Account</strong></div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item small" href="<?php echo URLROOT; ?>/teachers/change_password">Change Password</a>
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
    <div class="container-fluid pl-0 pr-0">
        <div class="col-xl-10 col-lg-9 col-md-12 ml-auto">
            <div class="row">
                <div class="col-12 mx-auto">
                    <!--navigation-->
                    <div class="card pl-0 pr-0 mt-3">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4>Enrolled Students</h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">
                                            <li class="breadcrumb-item ml-lg-auto"><a class="text-danger" href="<?php echo URLROOT; ?>/teachers/my_loads">Subjects</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Student List</li>
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
                    <div class="card pl-0 pr-0 mt-1 bg-c-green">
                        <div class="card-body">
                            <div class="tableHeaderColLoads text-white">
                                <div class="tableHeaderContentColLoads">
                                    <?php flash('add_student_record_success'); ?>
                                    <strong><?php echo $data['subjectName']; ?></strong>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-8">

                                </div>
                                <div class="col-lg-4">

                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table class="tables">
                                    <thead>
                                        <tr>
                                            <th width="10%">Enrollee Id</th>
                                            <th>Full Name</th>
                                            <th>Student No.</th>
                                            <th width="10">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($data['studentInfo'])) : ?>
                                            <?php foreach ($data['studentInfo'] as $studentInfos) : ?>
                                                <tr>
                                                    <td data-label="Enrollee Id" id="enrolleId">
                                                        <?php echo $studentInfos->enrolleesID; ?>
                                                    </td>
                                                    <td data-label="Last Name">
                                                        <?php echo $studentInfos->last_name . ', ' . $studentInfos->first_name . ' ' . $studentInfos->middle_name; ?>
                                                    </td>
                                                    <td data-label="Student No.">
                                                        <?php echo $studentInfos->studentNo; ?>
                                                    </td>

                                                    <td data-label="Action">
                                                        <a class="btn btn-danger getStudent" data-id="<?php echo $studentInfos->enrolleesID; ?>" href="" role="button"><i class="fa fa-user mr-1" aria-hidden="true"></i> Add</a>
                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if (!empty($data['studentInfoSr'])) : ?>
                                            <?php foreach ($data['studentInfoSr'] as $studentInfosSr) : ?>
                                                <tr>
                                                    <td data-label="Enrollee Id">
                                                        <?php echo $studentInfosSr->subject_enrolled_ID; ?>
                                                    </td>
                                                    <td data-label="Full Name">
                                                        <?php echo $studentInfosSr->lname . ', ' . $studentInfosSr->fname . ' ' . $studentInfosSr->mname; ?>
                                                    </td>
                                                    <td data-label="Student No.">
                                                        <?php echo $studentInfosSr->student_id; ?>
                                                    </td>

                                                    <td data-label="Action">
                                                        <a class="btn btn-danger getSrStudent" data-id="<?php echo $studentInfosSr->subject_enrolled_ID; ?>" href="" role="button"><i class="fa fa-user mr-1" aria-hidden="true"></i> Add</a>
                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <?php if (empty($data['studentInfo']) && empty($data['studentInfoSr'])) : ?>
                                    <h5 class="ml-1 mt-3"><?php echo 'No available students on the subject'; ?></h5>
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

<?php require APPROOT . '/views/inc/footer.php'; ?>

<script>
    $(document).ready(function() {


        $('.getSrStudent').click(function() {
            var enrolleId = $(this).data("id");
            var subjectId = '<?php echo $data['subjectId'] ?>';
            var subjectSem = '<?php echo $data['semester'] ?>';

            switch (subjectSem) {
                case '1':
                    $.ajax({
                        url: '<?php echo URLROOT ?>' + '/Actions/insertDataSr',
                        method: 'post',
                        data: {
                            enrolleId: enrolleId,
                            subjectId: subjectId
                        },
                        success: function(response) {
                            alert(response);
                        }
                    });
                    break;
                case '2':
                    $.ajax({
                        url: '<?php echo URLROOT ?>' + '/Actions/insertDataSr2',
                        method: 'post',
                        data: {
                            enrolleId: enrolleId,
                            subjectId: subjectId
                        },
                        success: function(response) {
                            alert(response);
                        }
                    });
                    break;
            }
        });
    });
</script>