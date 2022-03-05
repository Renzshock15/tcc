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
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/higher_submissions" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-share-square text-light fa-lg mr-3"></i>Submission</a></li>';
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
            <div class="row">
                <div class="col-12 mx-auto">
                    <!--navigation-->
                    <div class="card pl-0 pr-0 mt-3 heads">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4>Grade Summary</h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">
                                            <li class="breadcrumb-item ml-lg-auto"><a class="text-danger" href="<?php echo URLROOT; ?>/registrars/higher_submissions">Subject List</a></li>

                                            <li class="breadcrumb-item active" aria-current="page">Summary</li>
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
                        <?php if (!empty($data['studentInfo'])) : ?>
                            <div class="card-header bg-white">
                                <div class="buts">
                                    <button class="btn btn-dark float-right prints" id="prints" href="" data-id="<?php echo $admins->id; ?>" role="button"><i class="fas fa-print"></i> Print</button>
                                </div>
                                <h3><strong><?php echo $data['subjectName']; ?></strong></h3>
                                <h5><?php echo $data['subjectDescription']; ?></h5>
                                <h5> <?php echo 'SY: ' . $data['schoolYear'] . ' - ' . $data['sem'] . ' - Sem'; ?></h5>
                                <h5> <?php echo 'Year - ' . $data['yearLevel']; ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">

                                    <div class="col-lg-4">

                                    </div><!-- end col-->
                                </div>


                                <div class="table-responsive">
                                    <div id="outputJr">
                                        <table class="tablesgrade" id="jrTable">
                                            <thead>
                                                <tr>

                                                    <th>Full Name</th>
                                                    <th></th>

                                                    <th>Final Grade</th>
                                                    <th></th>
                                                    <th>Completed</th>
                                                    <th></th>
                                                    <th>Remarks</th>
                                                    <th width="10%" class="heads">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <div id="outputJr">
                                                    <?php foreach ($data['studentInfo'] as $studentInfos) : ?>
                                                        <tr>

                                                            <td data-label="Full Name">
                                                                <?php echo $studentInfos->lname . ', ' . $studentInfos->fname . ' ' . $studentInfos->mname; ?>
                                                            </td>

                                                            <td>

                                                            </td>


                                                            <td data-label="Final">
                                                                <?php echo $studentInfos->file_grade; ?>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <td data-label="Final" contenteditable="<?php echo ($studentInfos->file_grade === 'INC') ? 'true' : 'false'; ?>">
                                                                <?php echo $studentInfos->completed; ?>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <td data-label="Remarks">
                                                                <?php echo $studentInfos->grade_remarks; ?>
                                                            </td>
                                                            <td class="heads">
                                                                <button type="button" class="btn btn-primary btnSave" data-id="<?php echo $studentInfos->gId; ?>"><i class=" far fa-save"></i></button>
                                                            </td>
                                                        </tr>

                                                    <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row mx-auto">

                                    </div>
                                    <?php if (empty($data['studentInfo'])) : ?>
                                        <h5 class="ml-1 mt-3"><?php echo 'No available students on the subject'; ?></h5>
                                    <?php endif; ?>
                                </div>

                            </div>
                        <?php endif; ?>

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

<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
    $(document).ready(function() {
        $('#jrTable tbody').on('click', '.btnSave', function() {
            var currow = $(this).closest('tr');
            var studentFinalList = $(this).data('id');
            var completedGrade = {
                grade: currow.find('td:eq(4)').text()
            };

            if (completedGrade.grade.trim() === '') {
                alert('Please input grade');
            } else {
                checkInputGrade = checkIfNumeric(completedGrade);
                if (checkInputGrade === true) {
                    var grade = completedGrade.grade.trim();

                    var gradeIsDecimal = isDecimal(grade);

                    if (gradeIsDecimal === true) {
                        alert('You input non decimal grade');
                    } else {
                        $('#confirmModal').toggle();

                        $('.saveRec').click(function() {
                            $.ajax({
                                url: '<?php echo URLROOT ?>' + '/Actions/editGradingHigherFinalGrade',
                                method: 'post',
                                data: {
                                    studentFinalList: studentFinalList,
                                    grade: grade
                                },
                                success: function(response) {
                                    alert(response);
                                    $('#confirmModal').hide();
                                    location.reload();
                                }
                            });
                        });

                        closeModal();
                    }


                } else {
                    alert('You input non numerical grade');
                }
            }


        });

        $('#prints').click(function() {


            window.print();



        });
    });

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

    function isDecimal(n) {
        if (n == "")
            return false;

        var strCheck = "0123456789";
        var i;

        for (i in n) {
            if (strCheck.indexOf(n[i]) == -1)
                return false;
        }
        return true;
    }

    function closeModal() {
        $('.cancelModalsss').click(function() {
            location.reload();
        });
    }
</script>