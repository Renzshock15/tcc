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
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/student_offline" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-list-ul text-light fa-lg mr-3"></i>Register</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/student_subjects" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-book-open text-light fa-lg mr-3"></i>Subjects</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/grade_submissions" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-share-square text-light fa-lg mr-3"></i>Submission</a></li>';
                        } else {
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/transcript" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-address-card text-light fa-lg mr-3"></i>TOR</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/higher_submissions" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-share-square text-light fa-lg mr-3"></i>Submission</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/register_offline" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-list-ul text-light fa-lg mr-3"></i>Register</a></li>';
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
                                            <li class="breadcrumb-item ml-lg-auto"> <a class="text-danger" href="<?php echo URLROOT; ?>/registrars/student_offline">Levels</a></li>
                                            <li class="breadcrumb-item "> <a class="text-danger" href="<?php echo URLROOT; ?>/registrars/junior_offline_list">Student List</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Enrollment</li>
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
                                <h5><?php echo $data['studentName']; ?></h5>
                                <h5><?php echo $data['studentNo']; ?></h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="addGradeRecord">
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="inputEmail4">Registration No.</label>
                                            <input type="text" class="form-control regNo" id="inputEmail4">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">Grade Level</label>
                                            <select id="gradeLevel" class="form-control">
                                                <option selected>Choose...</option>
                                                <option value="sped">Sped</option>
                                                <option value="kinder_1">Kinder 1</option>
                                                <option value="kinder_2">Kinder 2</option>
                                                <option value="1">Grade 1</option>
                                                <option value="2">Grade 2</option>
                                                <option value="3">Grade 3</option>
                                                <option value="4">Grade 4</option>
                                                <option value="5">Grade 5</option>
                                                <option value="6">Grade 6</option>
                                                <option value="7">Grade 7</option>
                                                <option value="8">Grade 8</option>
                                                <option value="9">Grade 9</option>
                                                <option value="10">Grade 10</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="inputState">Section</label>
                                            <div id="sectionOutPut">
                                                <select id="sectionSel" class="form-control" disabled>
                                                    <option selected>Choose...</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>



                                    <button type="button" class="btn btn-primary float-right mb-3 mt-3 saveData"><i class="far fa-save"></i> Save Record</button>
                                </form>

                            </div>
                            <div>
                                <div class="table-responsive mb-5">
                                    <table class="tablesgrade" id="recordsTable">
                                        <thead>
                                            <tr>
                                                <th>Full Name</th>
                                                <th>Section</th>
                                                <th>Grade</th>
                                                <th>Academic Level</th>
                                                <th>Status</th>
                                                <th>Registration No.</th>
                                                <th>School Year</th>
                                                <th width="5%">Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php if (!empty($data['enrollees'])) : ?>

                                                <?php foreach ($data['enrollees'] as $subjectList) : ?>
                                                    <tr class="">
                                                        <td class="schoolRow" data-label="Learning Area" data-id="<?php echo $subjectList->enrolleeId; ?>">
                                                            <?php echo  $subjectList->last_name . ', ' . $subjectList->first_name . ' ' . $subjectList->middle_name; ?>
                                                        </td>
                                                        <td data-label="1">
                                                            <?php echo $subjectList->section_name; ?>
                                                        </td>
                                                        <td data-label="2">
                                                            <?php echo $subjectList->for_grade; ?>
                                                        </td>
                                                        <td data-label="3">
                                                            <?php echo $subjectList->academic_level; ?>
                                                        </td>
                                                        <td data-label="4">
                                                            <?php echo $subjectList->enrollee_status; ?>
                                                        </td>
                                                        <td data-label="Avg">
                                                            <?php echo $subjectList->registration_number; ?>
                                                        </td>
                                                        <td data-label="School Year">
                                                            <?php echo $subjectList->term_name; ?>
                                                        </td>


                                                        <td data-label="Action">
                                                            <button type="button" class="btn btn-danger btnDelete" data-id="<?php echo $subjectList->enrolleeId; ?>"><i class="far fa-trash-alt"></i></button>
                                                        </td>


                                                    </tr>

                                                <?php endforeach; ?>

                                            <?php endif; ?>

                                        </tbody>

                                    </table>

                                    <?php if (empty($data['enrollees'])) : ?>
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
                <h5 class="modal-title">Confirm</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelModalsss" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary enrollStudent">Enroll Student</button>
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
        $('#gradeLevel').change(function() {
            var valueLevel = $(this).val();

            $.ajax({
                url: '<?php echo URLROOT ?>' + '/Actions/getSections',
                method: 'post',
                data: {
                    valueLevel: valueLevel

                },
                success: function(response) {
                    $('#sectionOutPut').html(response);


                }
            });
        });

        $('.saveData').click(function() {
            var regNo = $('.regNo').val();
            var gradeSection = $('#sectionSel').val();

            if (regNo === '' || gradeSection === 'Choose...') {
                alert('Please enter registration no. and section');
            } else {
                $('#confirmModal').toggle();
                $('.enrollStudent').click(function() {
                    var infoId = '<?php echo $data['infoId']; ?>';
                    $.ajax({
                        url: '<?php echo URLROOT ?>' + '/Actions/enrollStudents',
                        method: 'post',
                        data: {
                            regNo: regNo,
                            gradeSection: gradeSection,
                            infoId: infoId
                        },
                        success: function(response) {
                            alert(response);
                            $('#confirmModal').hide();
                            location.reload();

                        }
                    });
                });

                closeModal()
            }
        });

        $('#recordsTable tbody').on('click', '.btnDelete', function() {
            var enrolleeId = $(this).data('id');
            var currow = $(this).closest('tr');
            var regNo = currow.find('td:eq(5)').text().trim();
            var splitRegNo = regNo.split(')');

            if (splitRegNo[0] === '(Offline') {
                $('#deleteModal').toggle();

                $('.deleteRec').click(function() {
                    $.ajax({
                        url: '<?php echo URLROOT ?>' + '/Actions/deleteEnrollStudents',
                        method: 'post',
                        data: {
                            enrolleeId: enrolleeId
                        },
                        success: function(response) {
                            alert(response);
                            $('#deleteModal').hide();
                            location.reload();

                        }
                    });
                });

                closeModal()
            } else {
                alert('This record cannot be deleted');
            }
        });


    });





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