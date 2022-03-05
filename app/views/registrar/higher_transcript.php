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
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/transcript" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-address-card text-light fa-lg mr-3"></i>TOR</a></li>';
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
                                    <h4>Transcript</h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">

                                            <li class="breadcrumb-item ml-lg-auto"> <a class="text-danger" href="<?php echo URLROOT; ?>/registrars/transcript">Student List</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">TOR</li>
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

                        <div class="card-header bg-white buts">

                            <button class="btn btn-dark float-right prints" id="prints" href="" role="button"><i class="fas fa-print"></i> Print</button>

                        </div>
                        <div class="printable " id="printable">
                            <div class="table-responsive">
                                <table class="report-container mx-3">
                                    <thead class="report-header">
                                        <tr>
                                            <th class="report-header-cell" colspan="5">
                                                <div class="header-info">
                                                    <div class="row marginTOR justify-content-center">
                                                        <img src="<?php echo URLROOT; ?>/images/tcclogo.png" width="80px" height="80px" alt="">
                                                        <div class="pl-2 pr-2">
                                                            <h5 class="mt-3">TOMAS CALUDIO COLLEGES</h5>
                                                            <h7 class="ml-4">Taghangin Morong, Rizal</h7>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-4 justify-content-center">
                                                        <h6 class=""><strong>OFFICE OF THE REGISTRAR</strong></h6>
                                                    </div>
                                                    <div class="row mb-2 justify-content-center">
                                                        <h5 class=""><strong>OFFICIAL TRANSCRIPT OF RECORD</strong></h5>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="2">
                                                <h5 class=""><strong>Name:</strong> <?php echo $data['studentName']; ?></h5>
                                                <h5 class=""><strong>Address:</strong> <?php echo $data['address']; ?></h5>
                                                <h5 class=""><strong>Birthday:</strong> <?php echo $data['birthdate'] . '   <strong>Birth Place</strong> ' . $data['birthPlace']; ?></h5>

                                            </th>
                                            <th colspan="3">
                                                <h5 class=""><strong>Course:</strong> <?php echo $data['course']; ?></h5>
                                                <h5 class=""><strong>Major:</strong> <?php echo $data['major']; ?></h5>

                                            </th>
                                        </tr>
                                        <tr class="colheadersss">
                                            <th rowspan="2" width="20%" class="colheadersss">TERM COURSE NO.</th>
                                            <th rowspan="2" class="colheadersss">DESCRIPTIVE TITLE</th>
                                            <th colspan="2" class="colheadersss">GRADES</th>
                                            <th rowspan="2" width="10%" class="colheadersss">UNITS</th>
                                        </tr>
                                        <tr class="colheadersss">
                                            <th width="10%" class="colheadersss">FINAL</th>
                                            <th width="10%" class="colheadersss">RE-EXAM</th>

                                        </tr>
                                    </thead>
                                    <tbody class="report-body colheaderssss">

                                        <?php if (!empty($data['getSubject11'])) : ?>

                                            <?php foreach ($data['getSubject11'] as $subjectList) : ?>
                                                <tr class="rowheadersss">
                                                    <td data-label="Learning Area" class="rowheadersss">
                                                        <?php if ($subjectList->semester == 1) {
                                                            if ($subjectList->school_id == 1) {
                                                                echo '1st Semester ' . $subjectList->school_year;
                                                            } else {
                                                                echo '1st Semester ' . $subjectList->school_year . ' - ' . $subjectList->school_name;
                                                            }
                                                        } elseif ($subjectList->semester == 2) {
                                                            if ($subjectList->school_id == 1) {
                                                                echo '2nd Semester ' . $subjectList->school_year;
                                                            } else {
                                                                echo '2nd Semester ' . $subjectList->school_year . ' - ' . $subjectList->school_name;
                                                            }
                                                        } elseif ($subjectList->semester == 3) {
                                                            if ($subjectList->school_id == 1) {
                                                                echo 'Summer ' . $subjectList->school_year;
                                                            } else {
                                                                echo 'Summer ' . $subjectList->school_year . ' - ' . $subjectList->school_name;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td data-label="1" class="rowheadersss">

                                                    </td>
                                                    <td data-label="2" class="tableUnits rowheadersss">

                                                    </td>
                                                    <td data-label="2" class="tableUnits rowheadersss">

                                                    </td>
                                                    <td data-label="2" class="tableUnits rowheadersss">

                                                    </td>
                                                </tr>
                                                <?php foreach ($data['getSubjectGrade'] as $subjectGrade) : ?>
                                                    <?php if ($subjectGrade->sem . $subjectGrade->school_year === $subjectList->semester . $subjectList->school_year) : ?>
                                                        <tr>
                                                            <td class="rowheadersss">
                                                                <?php echo $subjectGrade->subject_name; ?>
                                                            </td>
                                                            <td class="rowheadersss">
                                                                <?php echo $subjectGrade->subject_description; ?>
                                                            </td>
                                                            <td class="rowheadersss tableUnits">
                                                                <?php echo $subjectGrade->file_grade; ?>
                                                            </td>
                                                            <td class="rowheadersss tableUnits">
                                                                <?php echo $subjectGrade->completed; ?>
                                                            </td>
                                                            <td class="rowheadersss tableUnits">
                                                                <?php echo $subjectGrade->units; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>

                                            <?php endforeach; ?>


                                        <?php endif; ?>


                                    </tbody>
                                    <tfoot class="report-footer">
                                        <tr>
                                            <td class="report-footer-cell" colspan="5">
                                                <div class="footer-info">
                                                    <div class="row mx-0 mt-2">
                                                        <div class="table-responsive">
                                                            <table class="tablesgradesss">
                                                                <thead>

                                                                </thead>
                                                                <tbody class="colheadersss">
                                                                    <tr class="p-0">
                                                                        <td width="11%" class="rowSmall">
                                                                            <p class="superSmall">(1) GRADING SYSTEM</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">1.0 - 100%</p>

                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">1.3 - 95-96%</p>

                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">1.6 - 92%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">1.9 - 88%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">2.2 - 85%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">2.5 - 81%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">2.8 - 77-78%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">5.0 - FAILED</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="p-0">
                                                                        <td width="11%">

                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">1.1 - 98-99%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">1.4 - 94%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">1.7 - 91%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">2.0 - 87%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">2.3 - 83-84%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">2.6 - 80%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">2.9 - 76%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">INC INCOMPLETE</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="p-0">
                                                                        <td width="11%">

                                                                        </td>
                                                                        <td width="11%">

                                                                            <p class="superSmall">1.2 - 97%</p>

                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">1.5 - 93%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">1.9 - 89-90%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">2.1 - 86%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">2.4 - 82%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">2.7 - 79%</p>
                                                                        </td>
                                                                        <td width="11%">
                                                                            <p class="superSmall">3.0 - 75%</p>
                                                                        </td>
                                                                        <td width="11%">

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="9" class=" rowSmall">
                                                                            <p class="superSmall">
                                                                                <strong>(2) ONE UNIT OF CREDIT IS EQUIVALENT TO ONE HOUR LECTURE OF RECITATION OR THREE HOURS
                                                                                    LABORATORY OR SHOP WORK EACH WEEK FROM A PERIOD OF ONE COMPLETE SEMESTER</strong>
                                                                            </p>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="row mx-0">
                                                        <div class="table-responsive">
                                                            <table class="tablesgradesss">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="9" class="tableUnits">

                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="p-0">
                                                                        <td class="tableUnits" colspan="9">
                                                                            <h6>REMARKS more on next page</h6>
                                                                        </td>

                                                                    </tr>


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="row mx-0">
                                                        <div class="table-responsive">
                                                            <table class="tablesgradesss">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="3" class="tableUnits">

                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="p-0" class="tableUnits">
                                                                        <td colspan="2" width="50%" class="tableUnits">
                                                                            <h6>NOT VALID WITHOUT COLLEGE SEAL</h6>
                                                                        </td>
                                                                        <td width="50%">
                                                                            <p class="superSmall">CERTIFIED CORRECT</p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="p-0" class="tableUnits">
                                                                        <td width="25%" class="tableUnits">
                                                                            <h6></h6>
                                                                        </td>
                                                                        <td width="25%" class="tableUnits">
                                                                            <h6></h6>
                                                                        </td>
                                                                        <td width="50%" class="tableUnits">
                                                                            <h6></h6>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="p-0" class="tableUnits">
                                                                        <td width="25%" class="tableUnits">
                                                                            <h6></h6>
                                                                        </td>
                                                                        <td width="25%" class="tableUnits">
                                                                            <h6></h6>
                                                                        </td>
                                                                        <td width="50%" class="tableUnits">
                                                                            <h6></h6>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="p-0" class="tableUnits">
                                                                        <td width="25%" class="tableUnits">
                                                                            <h6></h6>
                                                                        </td>
                                                                        <td width="25%" class="tableUnits">
                                                                            <h6></h6>
                                                                        </td>
                                                                        <td width="50%" class="tableUnits">
                                                                            <h6></h6>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="p-0" class="tableUnits">
                                                                        <td width="25%" class="tableUnits">
                                                                            <h6>NAME 1</h6>
                                                                        </td>
                                                                        <td width="25%" class="tableUnits">
                                                                            <h6>NAME 2</h6>
                                                                        </td>
                                                                        <td width="50%" class="tableUnits">
                                                                            <h6>NAME 3</h6>
                                                                        </td>
                                                                    </tr>

                                                                    <tr class="p-0" class="tableUnits">
                                                                        <td width="25%" class="tableUnits">
                                                                            <h6>ACCOUNTING DEPT</h6>
                                                                        </td>
                                                                        <td width="25%" class="tableUnits">
                                                                            <h6>RECORD SECTION</h6>
                                                                        </td>
                                                                        <td width="50%" class="tableUnits">
                                                                            <h6>VICE PRESIDENT for Admin and Acting Registrar</h6>
                                                                        </td>
                                                                    </tr>


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                            <div class="tor-header">

                            </div>
                            <div class="tor-body">

                            </div>
                            <div class="tor-footer mx-auto">

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
        $('#prints').click(function() {


            window.print();



        });



    });
</script>