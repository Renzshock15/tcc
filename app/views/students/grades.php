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
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/students/home" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-home text-light fa-lg mr-3"></i>Home</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/students/subject_load" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="far fa-address-book text-light fa-lg mr-3"></i>Subjects</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/students/student_grades" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-address-card text-light fa-lg mr-3"></i>Report Card</a></li>
                        <?php if ($_SESSION['studentLevel'] === 'College' || $_SESSION['studentLevel'] === 'Graduate School' || $_SESSION['studentLevel'] === 'Supplemental') {
                            echo '<li class="nav-item"><a href="' . URLROOT . '/students/checklist" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-tasks text-light fa-lg mr-3"></i>My Checklist</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/students/cards" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-archive text-light fa-lg mr-3"></i>My Cards</a></li>';
                        } else {
                            echo '';
                        } ?>
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
                                    <h4>Grades</h4>
                                    <?php if (empty($data['juniorSubjects']) && empty($data['seniorSubjects1']) && empty($data['seniorSubjects2']) && empty($data['collegeClassCard']) && empty($data['subjectsSupple']) && empty($data['subjectsMaster'])) : ?>
                                        <h5 class="ml-0 mt-3 mb-3"><?php echo 'No cards available'; ?></h5>

                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">
                                            <li class="breadcrumb-item active ml-lg-auto" aria-current="page">Subjects</li>
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
                        <?php if (!empty($data['juniorSubjects'])) : ?>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-3 mt-4 ml-4">
                                        <img src="<?php echo URLROOT; ?>/images/tcclogo.png" width="80px" height="80px" alt="">
                                    </div>
                                    <div class="col-lg-8 mt-5 ml-auto">
                                        <h1>Tomas Claudio Colleges</h1>
                                    </div>
                                </div>
                            </div>
                            <div class=" card-body">
                                <div class="row mb-2">

                                    <div class="col-lg-4">

                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive">
                                    <div id="outputJr">
                                        <table class="tablesgrade">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">Learning Area</th>
                                                    <th colspan="4">Quarter</th>
                                                    <th rowspan="2">Final Grade</th>
                                                    <th rowspan="2">Remarks</th>
                                                </tr>
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $juniorGenAvg = 0; ?>
                                                <?php foreach ($data['juniorSubjects'] as $juniorGradesCard) : ?>
                                                    <tr>
                                                        <td data-label="Subject">
                                                            <?php echo $juniorGradesCard->subject_name; ?>
                                                        </td>
                                                        <td data-label="First">
                                                            <?php $currentDateFirst = date("Y-m-d");
                                                            if ($currentDateFirst >= $juniorGradesCard->viewDate) {
                                                                echo $juniorGradesCard->fqg;
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-label="Second">
                                                            <?php $currentDateSec = date("Y-m-d");
                                                            if ($currentDateSec >= $juniorGradesCard->viewDate) {

                                                                if ($juniorGradesCard->sqg == 0) {
                                                                    echo '';
                                                                } else {
                                                                    echo $juniorGradesCard->sqg;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-label="Third">
                                                            <?php $currentDateThi = date("Y-m-d");
                                                            if ($currentDateThi >= $juniorGradesCard->viewDate) {

                                                                if ($juniorGradesCard->tqg == 0) {
                                                                    echo '';
                                                                } else {
                                                                    echo $juniorGradesCard->tqg;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-label="Fourth">
                                                            <?php $currentDateFou = date("Y-m-d");
                                                            if ($currentDateFou >= $juniorGradesCard->viewDate) {

                                                                if ($juniorGradesCard->foqg == 0) {
                                                                    echo '';
                                                                } else {
                                                                    echo $juniorGradesCard->foqg;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-label="Final">
                                                            <?php $currentDateFin = date("Y-m-d");
                                                            if ($currentDateFin >= $juniorGradesCard->viewDate) {

                                                                if ($juniorGradesCard->final_grade == 0) {
                                                                    echo '';
                                                                } else {
                                                                    echo $juniorGradesCard->final_grade;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-label="Remarks">
                                                            <?php $currentDateRem = date("Y-m-d");
                                                            if ($currentDateRem >= $juniorGradesCard->viewDate) {

                                                                if ($juniorGradesCard->final_grade == 0) {
                                                                    echo '';
                                                                } else {
                                                                    echo $juniorGradesCard->grade_remarks;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php $juniorGenAvg = $juniorGenAvg + $juniorGradesCard->final_grade; ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="4">
                                                        <h5><strong>General Average</strong></h5>
                                                    </td>

                                                    <td>
                                                        <strong>
                                                            <?php $currentDateRem = date("Y-m-d");
                                                            if ($currentDateRem >= $juniorGradesCard->viewDate) {

                                                                if ($juniorGenAvg == 0 || $data['juniorSubjectsCount'] == 0) {
                                                                    echo '';
                                                                } else {
                                                                    echo $juniorGenAvg / $data['juniorSubjectsCount'];
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </strong>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($data['seniorSubjects1'])) : ?>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-3 mt-4 ml-4">
                                        <img src="<?php echo URLROOT; ?>/images/tcclogo.png" width="80px" height="80px" alt="">
                                    </div>
                                    <div class="col-lg-8 mt-5 ml-auto">
                                        <h1>Tomas Claudio Colleges</h1>
                                    </div>
                                </div>
                            </div>
                            <div class=" card-body">
                                <div class="row mb-2">

                                    <div class="col-lg-4">

                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive">
                                    <div id="outputJr">
                                        <table class="tablesgrade">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" width="40%">Subjects</th>
                                                    <th colspan="2">Quarter</th>
                                                    <th rowspan="2" width="12%">Final Grade</th>
                                                    <th rowspan="2" width="15%">Remarks</th>
                                                </tr>
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $seniorGenAvg1 = 0; ?>
                                                <?php foreach ($data['seniorSubjects1'] as $seniorGradesCard) : ?>
                                                    <tr>
                                                        <td data-label="Subject">
                                                            <?php echo $seniorGradesCard->subject_description; ?>
                                                        </td>
                                                        <td data-label="First">
                                                            <?php $currentDateFirst1 = date("Y-m-d");
                                                            if ($currentDateFirst1 >= $seniorGradesCard->viewDate) {
                                                                echo $seniorGradesCard->fqg;
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-label="Second">
                                                            <?php $currentDateSec1 = date("Y-m-d");
                                                            if ($currentDateSec1 >= $seniorGradesCard->viewDate) {

                                                                if ($seniorGradesCard->sqg == 0) {
                                                                    echo '';
                                                                } else {
                                                                    echo $seniorGradesCard->sqg;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>


                                                        <td data-label="Final">
                                                            <?php $currentDateFin1 = date("Y-m-d");
                                                            if ($currentDateFin1 >= $seniorGradesCard->viewDate) {

                                                                if ($seniorGradesCard->final_grade == 0) {
                                                                    echo '';
                                                                } else {
                                                                    echo $seniorGradesCard->final_grade;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-label="Remarks">
                                                            <?php $currentDateRem1 = date("Y-m-d");
                                                            if ($currentDateRem1 >= $seniorGradesCard->viewDate) {

                                                                if ($seniorGradesCard->final_grade == 0) {
                                                                    echo '';
                                                                } else {
                                                                    echo $seniorGradesCard->grade_remarks;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php $seniorGenAvg1 = $seniorGenAvg1 + $seniorGradesCard->final_grade; ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2">
                                                        <h5><strong>General Average First Semester</strong></h5>
                                                    </td>

                                                    <td>
                                                        <strong>
                                                            <?php $currentDateRem1 = date("Y-m-d");
                                                            if ($currentDateRem1 >= $seniorGradesCard->viewDate) {

                                                                if ($seniorGenAvg1 == 0 || $data['seniorSubjectsCount1'] == 0) {
                                                                    echo '';
                                                                } else {
                                                                    $seniorAVG1 = $seniorGenAvg1 / $data['seniorSubjectsCount1'];
                                                                    echo $seniorAVG1;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </strong>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($data['seniorSubjects2'])) : ?>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-3 mt-4 ml-4">
                                        <img src="<?php echo URLROOT; ?>/images/tcclogo.png" width="80px" height="80px" alt="">
                                    </div>
                                    <div class="col-lg-8 mt-5 ml-auto">
                                        <h1>Tomas Claudio Colleges</h1>
                                    </div>
                                </div>
                            </div>
                            <div class=" card-body">
                                <div class="row mb-2">

                                    <div class="col-lg-4">

                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive">
                                    <div id="outputJr">
                                        <table class="tablesgrade">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" width="40%">Subjects</th>
                                                    <th colspan="2">Quarter</th>
                                                    <th rowspan="2" width="12%">Final Grade</th>
                                                    <th rowspan="2" width="15%">Remarks</th>
                                                </tr>
                                                <tr>
                                                    <th>3</th>
                                                    <th>4</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $seniorGenAvg2 = 0; ?>
                                                <?php foreach ($data['seniorSubjects2'] as $seniorGradesCard) : ?>
                                                    <tr>
                                                        <td data-label="Subject">
                                                            <?php echo $seniorGradesCard->subject_description; ?>
                                                        </td>
                                                        <td data-label="Third">
                                                            <?php $currentDateFirst2 = date("Y-m-d");
                                                            if ($currentDateFirst2 >= $seniorGradesCard->viewDate) {
                                                                echo $seniorGradesCard->fqg;
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-label="Fourth">
                                                            <?php $currentDateSec2 = date("Y-m-d");
                                                            if ($currentDateSec2 >= $seniorGradesCard->viewDate) {

                                                                if ($seniorGradesCard->sqg == 0) {
                                                                    echo '';
                                                                } else {
                                                                    echo $seniorGradesCard->sqg;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>


                                                        <td data-label="Final">
                                                            <?php $currentDateFin2 = date("Y-m-d");
                                                            if ($currentDateFin2 >= $seniorGradesCard->viewDate) {

                                                                if ($seniorGradesCard->final_grade == 0) {
                                                                    echo '';
                                                                } else {
                                                                    echo $seniorGradesCard->final_grade;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td data-label="Remarks">
                                                            <?php $currentDateRem2 = date("Y-m-d");
                                                            if ($currentDateRem2 >= $seniorGradesCard->viewDate) {

                                                                if ($seniorGradesCard->final_grade == 0) {
                                                                    echo '';
                                                                } else {
                                                                    echo $seniorGradesCard->grade_remarks;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php $seniorGenAvg2 = $seniorGenAvg2 + $seniorGradesCard->final_grade; ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td></td>
                                                    <td colspan="2">
                                                        <h5><strong>General Average Second Semester</strong></h5>
                                                    </td>

                                                    <td>
                                                        <strong>

                                                            <?php $currentDateRem2 = date("Y-m-d");
                                                            if ($currentDateRem2 >= $seniorGradesCard->viewDate) {

                                                                if ($seniorGenAvg2 == 0 || $data['seniorSubjectsCount2'] == 0) {
                                                                    echo '';
                                                                } else {

                                                                    $seniorAVG2 = $seniorGenAvg2 / $data['seniorSubjectsCount2'];
                                                                    echo $seniorAVG2;
                                                                }
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                        </strong>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($data['seniorSubjects1']) && !empty($data['seniorSubjects2'])) : ?>
                            <div class="container-fluid">

                            </div>
                            <div class=" card-body">
                                <div class="row mb-2">

                                    <div class="col-lg-4">

                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive">
                                    <div id="outputJr">
                                        <table class="tablesgrade">
                                            <thead>

                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="40%"></td>
                                                    <td>
                                                        <h5><strong>General Weighted Average</strong></h5>
                                                    </td>
                                                    <td width="12%">
                                                        <strong>
                                                            <?php if ($currentDateRem2 >= $seniorGradesCard->viewDate) {
                                                                if ($seniorGenAvg1 == 0 || $seniorGenAvg2 == 0) {
                                                                    echo '';
                                                                } else {
                                                                    $weigthedAvg = ($seniorAVG1 + $seniorAVG2) / 2;
                                                                    echo round($weigthedAvg);
                                                                }
                                                            } ?>
                                                        </strong>
                                                    </td>
                                                    <td width="15%"></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($data['collegeClassCard'])) : ?>
                            <div class="row pt-3">
                                <?php foreach ($data['collegeClassCard'] as $collegeCard) : ?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card-columns-fluid">
                                            <div class="card text-dark border mx-1">
                                                <div class="row ml-0">
                                                    <div class="ml-3 mt-3">
                                                        <img src="<?php echo URLROOT; ?>/images/tcclogo.png" width="50px" height="50px" alt="">
                                                    </div>
                                                    <div class="mt-3 ml-2">
                                                        <h5 class="mb-0"><strong>Tomas Claudio Colleges</strong></h5>
                                                        <h7>Morong Rizal</h7>
                                                    </div>
                                                </div>
                                                <div class="row ml-0">
                                                    <div class="ml-3 mt-2">
                                                        <h7><strong>ENROLLED</strong></h7>
                                                    </div>
                                                </div>
                                                <div class="card-body text-dark">
                                                    <div class="row">
                                                        <div class="col-7 ml-0">
                                                            <?php echo '<strong>Student No.</strong> ' . $collegeCard->student_no; ?>
                                                        </div>
                                                        <div class="col-5">
                                                            <?php $sem = '';
                                                            if ($collegeCard->semester == 1) {
                                                                $sem = '1st';
                                                            } elseif ($collegeCard->semester == 2) {
                                                                $sem = '2nd';
                                                            } else {
                                                                $sem = 'Sum';
                                                            }
                                                            echo $sem . ' - ' . $collegeCard->schoolYear; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="ml-3 mt-2">
                                                            <?php echo '<strong>NAME</strong> ' . $_SESSION['last_name'] . ', ' . $_SESSION['first_name'] . ' ' . $_SESSION['middle_name']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="ml-3 mt-2">
                                                            <?php echo '<strong>SUBJECT</strong> ' . $collegeCard->subject_name . ' - ' . $collegeCard->subject_description; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="ml-3 mt-2">
                                                            <?php echo '<strong>COURSE</strong> ' . $collegeCard->course; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-8">
                                                            <?php echo '<strong>Prof.</strong> ' . $collegeCard->first_name . ' ' . $collegeCard->last_name; ?>
                                                        </div>
                                                        <div class="col-4">
                                                            <?php $collegeReleaseGrade = date("Y-m-d");
                                                            if ($collegeReleaseGrade >= $collegeCard->show_date) {
                                                                echo '<strong>RATING</strong> ' . $collegeCard->file_grade;
                                                            } else {
                                                                echo '';
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!--end of content-->

<?php require APPROOT . '/views/inc/footer.php'; ?>