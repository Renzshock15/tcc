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
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/registrars/home" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-home text-light fa-lg mr-3"></i>Home</a></li>
                        <?php if ($_SESSION['department'] === 'Basic Education') {
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/junior_records" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-address-card text-light fa-lg mr-3"></i>Junior</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/senior_records" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-address-card text-light fa-lg mr-3"></i>Senior</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/student_records" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="far fa-folder text-light fa-lg mr-3"></i>Records</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/student_offline" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-list-ul text-light fa-lg mr-3"></i>Register</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/student_subjects" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-book-open text-light fa-lg mr-3"></i>Subjects</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/grade_submissions" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-share-square text-light fa-lg mr-3"></i>Submission</a></li>';
                        } else {
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/transcript" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-address-card text-light fa-lg mr-3"></i>TOR</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/higher_submissions" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-share-square text-light fa-lg mr-3"></i>Submission</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/register_offline" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-list-ul text-light fa-lg mr-3"></i>Register</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/higher_subjects" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-book-open text-light fa-lg mr-3"></i>Subjects</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/higher_records" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="far fa-folder text-light fa-lg mr-3"></i>Records</a></li>';
                        }
                        ?>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/registrars/instructor_sched" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-users text-light fa-lg mr-3"></i>Schedule</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/registrars/user_registrar" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-users text-light fa-lg mr-3"></i>Users</a></li>


                    </ul>
                </div>
                <!-- end of sidebar -->
                <!-- top-nav -->
                <div class="col-xl-10 col-lg-9 col-md-8 ml-lg-auto pt-3 pb-2 fixed-top top-navbar bg">
                    <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-12 text-white">
                            <h4><?php echo $_SESSION['department']; ?></h4>
                        </div>
                        <div class="ml-lg-auto mr-3 ml-3">
                            <div class="dropdowns">
                                <a class="dropdown-toggle text-light" href="" id="navbarDropdown" role="button" data-toggle="dropdown">
                                    <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right mr-xl-1 mt-1" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-item"><strong>My Account</strong></div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item small" href="<?php echo URLROOT; ?>/registrars/change_userId">Change User Id</a>
                                    <a class="dropdown-item small" href="<?php echo URLROOT; ?>/registrars/change_password">Change Password</a>
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
            <div class="row heads">
                <div class="col-12 mx-auto">
                    <!--navigation-->
                    <div class="card pl-0 pr-0 mt-3">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4>Register Offline</h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">

                                            <li class="breadcrumb-item ml-lg-auto"> <a class="text-danger" href="<?php echo URLROOT; ?>/registrars/register_offline">Student List</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Subjects</li>
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
                            <div class="mt-3">
                                <h5><strong><?php echo $data['studentName']; ?></strong></h5>
                                <h5>Student No: <?php echo $data['studentId']; ?></h5>
                                <h5><?php echo $data['strand']; ?></h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="addGradeRecord">
                                <form class="form-inline" method="POST">
                                    <div class="form-group  mb-2">
                                        <label for="inputPassword2" class="sr-only">Password</label>
                                        <input type="text" class="form-control txtSearch" id="inputPassword2" placeholder="Search" name="txtSearch">
                                    </div>


                                </form>


                                <div id="result">
                                    <div class="table-responsive mt-2">
                                        <table class="tablesgrade" id="insertData">
                                            <thead>
                                                <tr>
                                                    <th width="10%">Code</th>
                                                    <th>Subject Name</th>
                                                    <th width="10%">Section</th>
                                                    <th>Schedule</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($data['schedule'])) : ?>
                                                    <?php foreach ($data['schedule'] as $seniorSched) : ?>
                                                        <tr id="rows">
                                                            <td data-label="Code">
                                                                <?php echo $seniorSched->subjectCode; ?>
                                                            </td>
                                                            <td data-label="Subject Name">
                                                                <?php echo $seniorSched->subjectDescription; ?>
                                                            </td>
                                                            <td data-label="Section">
                                                                <?php echo $seniorSched->year_level . ' - ' . $seniorSched->sec_code; ?>
                                                            </td>
                                                            <td data-label="Schedule">
                                                                <?php echo $seniorSched->day . ' (' . $seniorSched->start . ' - ' . $seniorSched->end . ')'; ?>
                                                            </td>
                                                            <td data-label="Action">
                                                                <button type="button" class="btn btn-primary addSched" data-id="<?php echo $seniorSched->subject_sched_ID; ?>" data-year="<?php echo $seniorSched->sem_id; ?>"><i class="fas fa-plus"></i> Add</button>
                                                            </td>
                                                        </tr>

                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <div class="table-responsive mb-5 mt-5">
                                    <table class="tablesgrade" id="recordsTable">
                                        <thead>
                                            <tr>
                                                <th width="10%">Code</th>
                                                <th>Subject Name</th>
                                                <th width="10%">Section</th>
                                                <th>Schedule</th>
                                                <th width="10%">Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php if (!empty($data['subjectEnrolledLIst'])) : ?>

                                                <?php foreach ($data['subjectEnrolledLIst'] as $seniorSched) : ?>
                                                    <tr class="">
                                                        <td class="" data-label="Code">
                                                            <?php echo $seniorSched->subjectCode; ?>
                                                        </td>
                                                        <td data-label="Subject Name">
                                                            <?php echo $seniorSched->subjectDescription; ?>
                                                        </td>
                                                        <td data-label="Section">
                                                            <?php echo $seniorSched->year_level . ' - ' . $seniorSched->sec_code; ?>
                                                        </td>
                                                        <td data-label="Schedule">
                                                            <?php echo $seniorSched->day . ' (' . $seniorSched->start . ' - ' . $seniorSched->end . ')'; ?>
                                                        </td>


                                                        <td data-label="Action">
                                                            <button type="button" class="btn btn-danger btnDelete" data-id="<?php echo $seniorSched->subject_enrolled_ID; ?>"><i class=" far fa-trash-alt"></i></button>
                                                        </td>


                                                    </tr>

                                                <?php endforeach; ?>

                                            <?php endif; ?>

                                        </tbody>

                                    </table>

                                    <?php if (empty($data['subjectEnrolledLIst'])) : ?>
                                        <div class="mt-2">
                                            <h3>No Records Available</h3>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--end of content-->
<div class="modal" tabindex="-1" id="confirmModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelModalsss" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveRec">Save records</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the record?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelModalsss" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary deleteRec">Delete record</button>
            </div>
        </div>
    </div>
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
    $(document).ready(function() {
        var programId = '<?php echo $data['programId']; ?>';
        var studentId = '<?php echo $data['studentId']; ?>';

        addSubject(studentId)
        $('.btnDelete').click(function() {
            var schedId = $(this).data('id');

            $('#deleteModal').toggle();

            $('.deleteRec').click(function() {
                $.ajax({
                    url: '<?php echo URLROOT ?>' + '/Actions/enrollDeleteSenior',
                    method: 'post',
                    data: {
                        schedId: schedId
                    },
                    success: function(response) {
                        alert(response);
                        $('#deleteModal').hide();
                        location.reload();
                    }
                });

            });
            closeModal()
        });

        $('.txtSearch').keyup(function() {
            var searchField = $(this).val();
            if (searchField != '') {
                $.ajax({
                    url: '<?php echo URLROOT ?>' + '/Actions/enrollSearchResultHigh',
                    method: 'post',
                    data: {
                        searchField: searchField,
                        studentId: studentId,
                        programId: programId
                    },
                    success: function(response) {
                        $('#result').html(response);
                        addSubject(studentId)
                    }
                });
            } else {
                location.reload();

            }
        });



    });

    function addSubject(studentId) {
        $('.addSched').click(function() {
            var currow = $(this).closest('tr');
            var schedId = $(this).data('id');
            var semId = $(this).data('year');


            $('#confirmModal').toggle();

            $('.saveRec').click(function() {
                $.ajax({
                    url: '<?php echo URLROOT ?>' + '/Actions/enrollHigh',
                    method: 'post',
                    data: {
                        schedId: schedId,
                        semId: semId,
                        studentId: studentId
                    },
                    success: function(response) {
                        alert(response);
                        $('#confirmModal').hide();
                        location.reload();
                    }
                });
            });
            closeModal()

        });
    }



    function checkIfBlank(items) {
        var result = 0;

        for (var key in items) {
            var remarks = $.trim(items[key]);
            //console.log(activity);

            console.log(remarks);
            if (remarks === '') {
                result = result + 1;
            }
        }
        //console.log(result);

        if (result > 0) {
            return false;
        } else {
            return true;
        }

    }

    function checkIfNoSelect(items) {
        var result = 0;

        for (var key in items) {
            var remarks = $.trim(items[key]);
            //console.log(activity);

            console.log(remarks);
            if (remarks === 'Choose...') {
                result = result + 1;
            }
        }
        //console.log(result);

        if (result > 0) {
            return false;
        } else {
            return true;
        }

    }

    function checkIfNumeric(items) {
        var result = 0;

        for (var key in items) {
            var activity = isNaN(items[key]);
            //console.log(activity);

            if (activity === true) {
                result = result + 1;
            }
        }
        //console.log(result);
        if (result > 0) {
            return false;
        } else {
            return true;
        }

    }

    function closeModal() {
        $('.cancelModalsss').click(function() {
            location.reload();
        });
    }
</script>