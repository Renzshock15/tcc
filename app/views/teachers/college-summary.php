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
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/teachers/my_loads" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-list text-light fa-lg mr-3"></i>My Loads</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/teachers/my_class" class="nav-link text-white p-3 mb-2 current"><i class="far fa-address-book text-light fa-lg mr-3"></i>Class Record</a></li>
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
                    <div class="card pl-0 pr-0 mt-3 heads">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4>Grade Summary</h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">
                                            <li class="breadcrumb-item ml-lg-auto"><a class="text-danger" href="<?php echo URLROOT; ?>/teachers/my_class">Subjects</a></li>
                                            <li class="breadcrumb-item "><a class="text-danger" href="<?php echo URLROOT; ?>/teachers/college_grade/college/<?php echo $data['subjectId'] ?>">Student List</a></li>
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
                                <h5> <?php echo $data['description']; ?></h5>
                                <h5> <?php echo 'Year Level - ' . $data['subjectGrade'] . ' ' . $data['subjectCode'] . ' ' . $data['section']; ?></h5>
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
                                                    <th class="hideColumn"></th>
                                                    <th class="hideColumn"></th>
                                                    <th class="hideColumn"></th>
                                                    <th>Full Name</th>
                                                    <th>Course</th>
                                                    <th></th>
                                                    <th>Prelim</th>
                                                    <th></th>

                                                    <th>Midterm</th>
                                                    <th></th>

                                                    <th>Semis</th>
                                                    <th></th>

                                                    <th>Finals</th>
                                                    <th></th>

                                                    <th>Avg.</th>
                                                    <th>Final Grade</th>
                                                    <th>Remarks</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $prelimAttendanceSummary = 0;
                                                $prelimAttendanceSummary = $data['collegeSummaryPATCS']; ?>
                                                <?php foreach ($data['collegeSummaryPAT'] as $collegeSummaryPAT) : ?>
                                                    <?php $prelimAttendanceSummaryWs = $collegeSummaryPAT->act_ws; ?>
                                                <?php endforeach; ?>

                                                <?php if (empty($prelimAttendanceSummaryWs)) {
                                                    $prelimAttendanceSummaryWs = 0;
                                                    // echo $firstWrittenWorksSummaryWs;
                                                } else {
                                                    // echo $firstWrittenWorksSummaryWs;
                                                }  ?>

                                                <?php $prelimRecitationSummary = 0;
                                                $prelimRecitationSummary = $data['collegeSummaryPRECS']; ?>
                                                <?php foreach ($data['collegeSummaryPRE'] as $collegeSummaryPRE) : ?>
                                                    <?php $prelimRecitationSummaryWs = $collegeSummaryPRE->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($prelimRecitationSummaryWs)) {
                                                    $prelimRecitationSummaryWs = 0;
                                                    // echo $firstPerformanceTaskSummaryWs;
                                                } else {
                                                    // echo $firstPerformanceTaskSummaryWs;
                                                }  ?>


                                                <?php $prelimQuizSummary = 0;
                                                $prelimQuizSummary = $data['collegeSummaryPQUCS']; ?>
                                                <?php foreach ($data['collegeSummaryPQU'] as $collegeSummaryPQU) : ?>
                                                    <?php $prelimQuizSummaryWs = $collegeSummaryPQU->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($prelimQuizSummaryWs)) {
                                                    $prelimQuizSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <?php $prelimProjectSummary = 0;
                                                $prelimProjectSummary = $data['collegeSummaryPPRCS']; ?>
                                                <?php foreach ($data['collegeSummaryPPR'] as $collegeSummaryPPR) : ?>
                                                    <?php $prelimProjectSummaryWs = $collegeSummaryPPR->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($prelimProjectSummaryWs)) {
                                                    $prelimProjectSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <?php $prelimAssignmentSummary = 0;
                                                $prelimAssignmentSummary = $data['collegeSummaryPASCS']; ?>
                                                <?php foreach ($data['collegeSummaryPAS'] as $collegeSummaryPAS) : ?>
                                                    <?php $prelimAssignmentSummaryWs = $collegeSummaryPAS->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($prelimAssignmentSummaryWs)) {
                                                    $prelimAssignmentSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <?php $prelimExamSummary = 0;
                                                $prelimExamSummary = $data['collegeSummaryPEXCS']; ?>
                                                <?php foreach ($data['collegeSummaryPEX'] as $collegeSummaryPEX) : ?>
                                                    <?php $prelimExamSummaryWs = $collegeSummaryPEX->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($prelimExamSummaryWs)) {
                                                    $prelimExamSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>



                                                <!--MIDTERM-->
                                                <?php $midtermAttendanceSummary = 0;
                                                $midtermAttendanceSummary = $data['collegeSummaryMATCS']; ?>
                                                <?php foreach ($data['collegeSummaryMAT'] as $collegeSummaryMAT) : ?>
                                                    <?php $midtermAttendanceSummaryWs = $collegeSummaryMAT->act_ws; ?>
                                                <?php endforeach; ?>

                                                <?php if (empty($midtermAttendanceSummaryWs)) {
                                                    $midtermAttendanceSummaryWs = 0;
                                                    // echo $firstWrittenWorksSummaryWs;
                                                } else {
                                                    // echo $firstWrittenWorksSummaryWs;
                                                }  ?>

                                                <?php $midtermRecitationSummary = 0;
                                                $midtermRecitationSummary = $data['collegeSummaryMRECS']; ?>
                                                <?php foreach ($data['collegeSummaryMRE'] as $collegeSummaryMRE) : ?>
                                                    <?php $midtermRecitationSummaryWs = $collegeSummaryMRE->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($midtermRecitationSummaryWs)) {
                                                    $midtermRecitationSummaryWs = 0;
                                                    // echo $firstPerformanceTaskSummaryWs;
                                                } else {
                                                    // echo $firstPerformanceTaskSummaryWs;
                                                }  ?>


                                                <?php $midtermQuizSummary = 0;
                                                $midtermQuizSummary = $data['collegeSummaryMQUCS']; ?>
                                                <?php foreach ($data['collegeSummaryMQU'] as $collegeSummaryMQU) : ?>
                                                    <?php $midtermQuizSummaryWs = $collegeSummaryMQU->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($midtermQuizSummaryWs)) {
                                                    $midtermQuizSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <?php $midtermProjectSummary = 0;
                                                $midtermProjectSummary = $data['collegeSummaryMPRCS']; ?>
                                                <?php foreach ($data['collegeSummaryMPR'] as $collegeSummaryMPR) : ?>
                                                    <?php $midtermProjectSummaryWs = $collegeSummaryMPR->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($midtermProjectSummaryWs)) {
                                                    $midtermProjectSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <?php $midtermAssignmentSummary = 0;
                                                $midtermAssignmentSummary = $data['collegeSummaryMASCS']; ?>
                                                <?php foreach ($data['collegeSummaryMAS'] as $collegeSummaryMAS) : ?>
                                                    <?php $midtermAssignmentSummaryWs = $collegeSummaryMAS->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($midtermAssignmentSummaryWs)) {
                                                    $midtermAssignmentSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <?php $midtermExamSummary = 0;
                                                $midtermExamSummary = $data['collegeSummaryMEXCS']; ?>
                                                <?php foreach ($data['collegeSummaryMEX'] as $collegeSummaryMEX) : ?>
                                                    <?php $midtermExamSummaryWs = $collegeSummaryMEX->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($midtermExamSummaryWs)) {
                                                    $midtermExamSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <!--SEMIS-->
                                                <?php $semisAttendanceSummary = 0;
                                                $semisAttendanceSummary = $data['collegeSummarySATCS']; ?>
                                                <?php foreach ($data['collegeSummarySAT'] as $collegeSummarySAT) : ?>
                                                    <?php $semisAttendanceSummaryWs = $collegeSummarySAT->act_ws; ?>
                                                <?php endforeach; ?>

                                                <?php if (empty($semisAttendanceSummaryWs)) {
                                                    $semisAttendanceSummaryWs = 0;
                                                    // echo $firstWrittenWorksSummaryWs;
                                                } else {
                                                    // echo $firstWrittenWorksSummaryWs;
                                                }  ?>

                                                <?php $semisRecitationSummary = 0;
                                                $semisRecitationSummary = $data['collegeSummarySRECS']; ?>
                                                <?php foreach ($data['collegeSummarySRE'] as $collegeSummarySRE) : ?>
                                                    <?php $semisRecitationSummaryWs = $collegeSummarySRE->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($semisRecitationSummaryWs)) {
                                                    $semisRecitationSummaryWs = 0;
                                                    // echo $firstPerformanceTaskSummaryWs;
                                                } else {
                                                    // echo $firstPerformanceTaskSummaryWs;
                                                }  ?>


                                                <?php $semisQuizSummary = 0;
                                                $semisQuizSummary = $data['collegeSummarySQUCS']; ?>
                                                <?php foreach ($data['collegeSummarySQU'] as $collegeSummarySQU) : ?>
                                                    <?php $semisQuizSummaryWs = $collegeSummarySQU->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($semisQuizSummaryWs)) {
                                                    $semisQuizSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <?php $semisProjectSummary = 0;
                                                $semisProjectSummary = $data['collegeSummarySPRCS']; ?>
                                                <?php foreach ($data['collegeSummarySPR'] as $collegeSummarySPR) : ?>
                                                    <?php $semisProjectSummaryWs = $collegeSummarySPR->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($semisProjectSummaryWs)) {
                                                    $semisProjectSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <?php $semisAssignmentSummary = 0;
                                                $semisAssignmentSummary = $data['collegeSummarySASCS']; ?>
                                                <?php foreach ($data['collegeSummarySAS'] as $collegeSummarySAS) : ?>
                                                    <?php $semisAssignmentSummaryWs = $collegeSummarySAS->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($semisAssignmentSummaryWs)) {
                                                    $semisAssignmentSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <?php $semisExamSummary = 0;
                                                $semisExamSummary = $data['collegeSummarySEXCS']; ?>
                                                <?php foreach ($data['collegeSummarySEX'] as $collegeSummarySEX) : ?>
                                                    <?php $semisExamSummaryWs = $collegeSummarySEX->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($semisExamSummaryWs)) {
                                                    $semisExamSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>


                                                <!--finals-->
                                                <?php $finalsAttendanceSummary = 0;
                                                $finalsAttendanceSummary = $data['collegeSummaryFATCS']; ?>
                                                <?php foreach ($data['collegeSummaryFAT'] as $collegeSummaryFAT) : ?>
                                                    <?php $finalsAttendanceSummaryWs = $collegeSummaryFAT->act_ws; ?>
                                                <?php endforeach; ?>

                                                <?php if (empty($finalsAttendanceSummaryWs)) {
                                                    $finalsAttendanceSummaryWs = 0;
                                                    // echo $firstWrittenWorksSummaryWs;
                                                } else {
                                                    // echo $firstWrittenWorksSummaryWs;
                                                }  ?>

                                                <?php $finalsRecitationSummary = 0;
                                                $finalsRecitationSummary = $data['collegeSummaryFRECS']; ?>
                                                <?php foreach ($data['collegeSummaryFRE'] as $collegeSummaryFRE) : ?>
                                                    <?php $finalsRecitationSummaryWs = $collegeSummaryFRE->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($finalsRecitationSummaryWs)) {
                                                    $finalsRecitationSummaryWs = 0;
                                                    // echo $firstPerformanceTaskSummaryWs;
                                                } else {
                                                    // echo $firstPerformanceTaskSummaryWs;
                                                }  ?>


                                                <?php $finalsQuizSummary = 0;
                                                $finalsQuizSummary = $data['collegeSummaryFQUCS']; ?>
                                                <?php foreach ($data['collegeSummaryFQU'] as $collegeSummaryFQU) : ?>
                                                    <?php $finalsQuizSummaryWs = $collegeSummaryFQU->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($finalsQuizSummaryWs)) {
                                                    $finalsQuizSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <?php $finalsProjectSummary = 0;
                                                $finalsProjectSummary = $data['collegeSummaryFPRCS']; ?>
                                                <?php foreach ($data['collegeSummaryFPR'] as $collegeSummaryFPR) : ?>
                                                    <?php $finalsProjectSummaryWs = $collegeSummaryFPR->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($finalsProjectSummaryWs)) {
                                                    $finalsProjectSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <?php $finalsAssignmentSummary = 0;
                                                $finalsAssignmentSummary = $data['collegeSummaryFASCS']; ?>
                                                <?php foreach ($data['collegeSummaryFAS'] as $collegeSummaryFAS) : ?>
                                                    <?php $finalsAssignmentSummaryWs = $collegeSummaryFAS->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($finalsAssignmentSummaryWs)) {
                                                    $finalsAssignmentSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>

                                                <?php $finalsExamSummary = 0;
                                                $finalsExamSummary = $data['collegeSummaryFEXCS']; ?>
                                                <?php foreach ($data['collegeSummaryFEX'] as $collegeSummaryFEX) : ?>
                                                    <?php $finalsExamSummaryWs = $collegeSummaryFEX->act_ws; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($finalsExamSummaryWs)) {
                                                    $finalsExamSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>


                                                <div id="outputJr">
                                                    <?php foreach ($data['studentInfo'] as $studentInfos) : ?>
                                                        <tr>
                                                            <td class="hideColumn program_id">
                                                                <?php echo $studentInfos->programId; ?>
                                                            </td>
                                                            <td class="hideColumn student_id">
                                                                <?php echo $studentInfos->studentId; ?>
                                                            </td>
                                                            <td class="hideColumn student_no">
                                                                <?php echo $studentInfos->studentNo; ?>
                                                            </td>
                                                            <td data-label="Last Name" class="student_name">
                                                                <?php echo $studentInfos->lname . ', ' . $studentInfos->fname . ' ' . $studentInfos->mname; ?>
                                                            </td>
                                                            <td data-label="Course" class="student_course">
                                                                <?php echo $studentInfos->studentCourse; ?>
                                                            </td>

                                                            <td>

                                                            </td>
                                                            <!--1st quarter-->
                                                            <td data-label="Prelim">
                                                                <?php $prelimAttendance = $studentInfos->prelim_at_act1 + $studentInfos->prelim_at_act2 + $studentInfos->prelim_at_act3 + $studentInfos->prelim_at_act4 + $studentInfos->prelim_at_act5 +
                                                                    $studentInfos->prelim_at_act6 + $studentInfos->prelim_at_act7 + $studentInfos->prelim_at_act8 + $studentInfos->prelim_at_act9 + $studentInfos->prelim_at_act10 +
                                                                    $studentInfos->prelim_at_act11 + $studentInfos->prelim_at_act12 + $studentInfos->prelim_at_act13 + $studentInfos->prelim_at_act14 + $studentInfos->prelim_at_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($prelimAttendance === 0 && $prelimAttendanceSummary === 0) {
                                                                    $prelimTotalAttendanceRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                } else {
                                                                    $prelimAttendanceSummaryWsConverted = convertToPercent($prelimAttendanceSummaryWs);
                                                                    $prelimTotalAttendance = ($prelimAttendance / $prelimAttendanceSummary) * $prelimAttendanceSummaryWsConverted;
                                                                    $prelimTotalAttendanceRound = round($prelimTotalAttendance, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }

                                                                ?>


                                                                <?php $prelimRecitation = $studentInfos->prelim_re_act1 + $studentInfos->prelim_re_act2 + $studentInfos->prelim_re_act3 + $studentInfos->prelim_re_act4 + $studentInfos->prelim_re_act5 +
                                                                    $studentInfos->prelim_re_act6 + $studentInfos->prelim_re_act7 + $studentInfos->prelim_re_act8 + $studentInfos->prelim_re_act9 + $studentInfos->prelim_re_act10 +
                                                                    $studentInfos->prelim_re_act11 + $studentInfos->prelim_re_act12 + $studentInfos->prelim_re_act13 + $studentInfos->prelim_re_act14 + $studentInfos->prelim_re_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($prelimAttendance === 0 && $prelimRecitationSummary === 0) {
                                                                    $prelimTotalRecitationRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                } else {
                                                                    $prelimRecitationSummaryWsConverted = convertToPercent($prelimRecitationSummaryWs);
                                                                    $prelimTotalRecitation = ($prelimRecitation / $prelimRecitationSummary) * $prelimRecitationSummaryWsConverted;
                                                                    $prelimTotalRecitationRound = round($prelimTotalRecitation, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }

                                                                ?>


                                                                <?php $prelimQuiz = $studentInfos->prelim_qu_act1 + $studentInfos->prelim_qu_act2 + $studentInfos->prelim_qu_act3 + $studentInfos->prelim_qu_act4 + $studentInfos->prelim_qu_act5 +
                                                                    $studentInfos->prelim_qu_act6 + $studentInfos->prelim_qu_act7 + $studentInfos->prelim_qu_act8 + $studentInfos->prelim_qu_act9 + $studentInfos->prelim_qu_act10 +
                                                                    $studentInfos->prelim_qu_act11 + $studentInfos->prelim_qu_act12 + $studentInfos->prelim_qu_act13 + $studentInfos->prelim_qu_act14 + $studentInfos->prelim_qu_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($prelimQuiz === 0 && $prelimQuizSummary === 0) {
                                                                    $prelimTotalQuizRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                } else {
                                                                    $prelimQuizSummaryWsConverted = convertToPercent($prelimQuizSummaryWs);
                                                                    $prelimTotalQuiz = ($prelimQuiz / $prelimQuizSummary) * $prelimQuizSummaryWsConverted;
                                                                    $prelimTotalQuizRound = round($prelimTotalQuiz, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>

                                                                <?php $prelimProject = $studentInfos->prelim_pr_act1 + $studentInfos->prelim_pr_act2 + $studentInfos->prelim_pr_act3 + $studentInfos->prelim_pr_act4 + $studentInfos->prelim_pr_act5 +
                                                                    $studentInfos->prelim_pr_act6 + $studentInfos->prelim_pr_act7 + $studentInfos->prelim_pr_act8 + $studentInfos->prelim_pr_act9 + $studentInfos->prelim_pr_act10 +
                                                                    $studentInfos->prelim_pr_act11 + $studentInfos->prelim_pr_act12 + $studentInfos->prelim_pr_act13 + $studentInfos->prelim_pr_act14 + $studentInfos->prelim_pr_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($prelimProject === 0 && $prelimProjectSummary === 0) {
                                                                    $prelimTotalProjectRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                } else {
                                                                    $prelimProjectSummaryWsConverted = convertToPercent($prelimProjectSummaryWs);
                                                                    $prelimTotalProject = ($prelimProject / $prelimProjectSummary) * $prelimProjectSummaryWsConverted;
                                                                    $prelimTotalProjectRound = round($prelimTotalProject, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>

                                                                <?php $prelimAssignment = $studentInfos->prelim_as_act1 + $studentInfos->prelim_as_act2 + $studentInfos->prelim_as_act3 + $studentInfos->prelim_as_act4 + $studentInfos->prelim_as_act5 +
                                                                    $studentInfos->prelim_as_act6 + $studentInfos->prelim_as_act7 + $studentInfos->prelim_as_act8 + $studentInfos->prelim_as_act9 + $studentInfos->prelim_as_act10 +
                                                                    $studentInfos->prelim_as_act11 + $studentInfos->prelim_as_act12 + $studentInfos->prelim_as_act13 + $studentInfos->prelim_as_act14 + $studentInfos->prelim_as_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($prelimAssignment === 0 && $prelimAssignmentSummary === 0) {
                                                                    $prelimTotalAssignmentRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                } else {
                                                                    $prelimAssignmentSummaryWsConverted = convertToPercent($prelimAssignmentSummaryWs);
                                                                    $prelimTotalAssignment = ($prelimAssignment / $prelimAssignmentSummary) * $prelimAssignmentSummaryWsConverted;
                                                                    $prelimTotalAssignmentRound = round($prelimTotalAssignment, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>

                                                                <?php $prelimExam = $studentInfos->prelim_ex_act1 + $studentInfos->prelim_ex_act2 + $studentInfos->prelim_ex_act3 + $studentInfos->prelim_ex_act4 + $studentInfos->prelim_ex_act5 +
                                                                    $studentInfos->prelim_ex_act6 + $studentInfos->prelim_ex_act7 + $studentInfos->prelim_ex_act8 + $studentInfos->prelim_ex_act9 + $studentInfos->prelim_ex_act10 +
                                                                    $studentInfos->prelim_ex_act11 + $studentInfos->prelim_ex_act12 + $studentInfos->prelim_ex_act13 + $studentInfos->prelim_ex_act14 + $studentInfos->prelim_ex_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($prelimExam === 0 && $prelimExamSummary === 0) {
                                                                    $prelimTotalExamRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                } else {
                                                                    $prelimExamSummaryWsConverted = convertToPercent($prelimExamSummaryWs);
                                                                    $prelimTotalExam = ($prelimExam / $prelimExamSummary) * $prelimExamSummaryWsConverted;
                                                                    $prelimTotalExamRound = round($prelimTotalExam, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>


                                                                <?php $prelimInitialGradeSummary =  $prelimTotalAttendanceRound + $prelimTotalRecitationRound + $prelimTotalQuizRound + $prelimTotalProjectRound + $prelimTotalAssignmentRound + $prelimTotalExamRound;
                                                                if (empty($prelimInitialGradeSummary)) {
                                                                    echo '';
                                                                } else {
                                                                    echo $prelimInitialGradeSummary;
                                                                } ?>
                                                            </td>
                                                            <td>

                                                            </td>

                                                            <!--Midterm-->
                                                            <td data-label="Midterm">
                                                                <?php $midtermAttendance = $studentInfos->midterm_at_act1 + $studentInfos->midterm_at_act2 + $studentInfos->midterm_at_act3 + $studentInfos->midterm_at_act4 + $studentInfos->midterm_at_act5 +
                                                                    $studentInfos->midterm_at_act6 + $studentInfos->midterm_at_act7 + $studentInfos->midterm_at_act8 + $studentInfos->midterm_at_act9 + $studentInfos->midterm_at_act10 +
                                                                    $studentInfos->midterm_at_act11 + $studentInfos->midterm_at_act12 + $studentInfos->midterm_at_act13 + $studentInfos->midterm_at_act14 + $studentInfos->midterm_at_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($midtermAttendance === 0 && $midtermAttendanceSummary === 0) {
                                                                    $midtermTotalAttendanceRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $midtermAttendanceSummaryWsConverted = convertToPercent($midtermAttendanceSummaryWs);
                                                                    $midtermTotalAttendance = ($midtermAttendance / $midtermAttendanceSummary) * $midtermAttendanceSummaryWsConverted;
                                                                    $midtermTotalAttendanceRound = round($midtermTotalAttendance, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }

                                                                ?>


                                                                <?php $midtermRecitation = $studentInfos->midterm_re_act1 + $studentInfos->midterm_re_act2 + $studentInfos->midterm_re_act3 + $studentInfos->midterm_re_act4 + $studentInfos->midterm_re_act5 +
                                                                    $studentInfos->midterm_re_act6 + $studentInfos->midterm_re_act7 + $studentInfos->midterm_re_act8 + $studentInfos->midterm_re_act9 + $studentInfos->midterm_re_act10 +
                                                                    $studentInfos->midterm_re_act11 + $studentInfos->midterm_re_act12 + $studentInfos->midterm_re_act13 + $studentInfos->midterm_re_act14 + $studentInfos->midterm_re_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($midtermRecitation === 0 && $midtermRecitationSummary === 0) {
                                                                    $midtermTotalRecitationRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $midtermRecitationSummaryWsConverted = convertToPercent($midtermRecitationSummaryWs);
                                                                    $midtermTotalRecitation = ($midtermRecitation / $midtermRecitationSummary) * $midtermRecitationSummaryWsConverted;
                                                                    $midtermTotalRecitationRound = round($midtermTotalRecitation, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }

                                                                ?>


                                                                <?php $midtermQuiz = $studentInfos->midterm_qu_act1 + $studentInfos->midterm_qu_act2 + $studentInfos->midterm_qu_act3 + $studentInfos->midterm_qu_act4 + $studentInfos->midterm_qu_act5 +
                                                                    $studentInfos->midterm_qu_act6 + $studentInfos->midterm_qu_act7 + $studentInfos->midterm_qu_act8 + $studentInfos->midterm_qu_act9 + $studentInfos->midterm_qu_act10 +
                                                                    $studentInfos->midterm_qu_act11 + $studentInfos->midterm_qu_act12 + $studentInfos->midterm_qu_act13 + $studentInfos->midterm_qu_act14 + $studentInfos->midterm_qu_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($midtermQuiz === 0 && $midtermQuizSummary === 0) {
                                                                    $midtermTotalQuizRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $midtermQuizSummaryWsConverted = convertToPercent($midtermQuizSummaryWs);
                                                                    $midtermTotalQuiz = ($midtermQuiz / $midtermQuizSummary) * $midtermQuizSummaryWsConverted;
                                                                    $midtermTotalQuizRound = round($midtermTotalQuiz, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>

                                                                <?php $midtermProject = $studentInfos->midterm_pr_act1 + $studentInfos->midterm_pr_act2 + $studentInfos->midterm_pr_act3 + $studentInfos->midterm_pr_act4 + $studentInfos->midterm_pr_act5 +
                                                                    $studentInfos->midterm_pr_act6 + $studentInfos->midterm_pr_act7 + $studentInfos->midterm_pr_act8 + $studentInfos->midterm_pr_act9 + $studentInfos->midterm_pr_act10 +
                                                                    $studentInfos->midterm_pr_act11 + $studentInfos->midterm_pr_act12 + $studentInfos->midterm_pr_act13 + $studentInfos->midterm_pr_act14 + $studentInfos->midterm_pr_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($midtermProject === 0 && $midtermProjectSummary === 0) {
                                                                    $midtermTotalProjectRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $midtermProjectSummaryWsConverted = convertToPercent($midtermProjectSummaryWs);
                                                                    $midtermTotalProject = ($midtermProject / $midtermProjectSummary) * $midtermProjectSummaryWsConverted;
                                                                    $midtermTotalProjectRound = round($midtermTotalProject, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>

                                                                <?php $midtermAssignment = $studentInfos->midterm_as_act1 + $studentInfos->midterm_as_act2 + $studentInfos->midterm_as_act3 + $studentInfos->midterm_as_act4 + $studentInfos->midterm_as_act5 +
                                                                    $studentInfos->midterm_as_act6 + $studentInfos->midterm_as_act7 + $studentInfos->midterm_as_act8 + $studentInfos->midterm_as_act9 + $studentInfos->midterm_as_act10 +
                                                                    $studentInfos->midterm_as_act11 + $studentInfos->midterm_as_act12 + $studentInfos->midterm_as_act13 + $studentInfos->midterm_as_act14 + $studentInfos->midterm_as_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($midtermAssignment === 0 && $midtermAssignmentSummary === 0) {
                                                                    $midtermTotalAssignmentRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $midtermAssignmentSummaryWsConverted = convertToPercent($midtermAssignmentSummaryWs);
                                                                    $midtermTotalAssignment = ($midtermAssignment / $midtermAssignmentSummary) * $midtermAssignmentSummaryWsConverted;
                                                                    $midtermTotalAssignmentRound = round($midtermTotalAssignment, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>

                                                                <?php $midtermExam = $studentInfos->midterm_ex_act1 + $studentInfos->midterm_ex_act2 + $studentInfos->midterm_ex_act3 + $studentInfos->midterm_ex_act4 + $studentInfos->midterm_ex_act5 +
                                                                    $studentInfos->midterm_ex_act6 + $studentInfos->midterm_ex_act7 + $studentInfos->midterm_ex_act8 + $studentInfos->midterm_ex_act9 + $studentInfos->midterm_ex_act10 +
                                                                    $studentInfos->midterm_ex_act11 + $studentInfos->midterm_ex_act12 + $studentInfos->midterm_ex_act13 + $studentInfos->midterm_ex_act14 + $studentInfos->midterm_ex_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($midtermExam === 0 && $midtermExamSummary === 0) {
                                                                    $midtermTotalExamRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $midtermExamSummaryWsConverted = convertToPercent($midtermExamSummaryWs);
                                                                    $midtermTotalExam = ($midtermExam / $midtermExamSummary) * $midtermExamSummaryWsConverted;
                                                                    $midtermTotalExamRound = round($midtermTotalExam, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>


                                                                <?php $midtermInitialGradeSummary =  $midtermTotalAttendanceRound + $midtermTotalRecitationRound + $midtermTotalQuizRound + $midtermTotalProjectRound + $midtermTotalAssignmentRound + $midtermTotalExamRound;
                                                                if (empty($midtermInitialGradeSummary)) {
                                                                    echo '';
                                                                } else {
                                                                    echo $midtermInitialGradeSummary;
                                                                } ?>
                                                            </td>
                                                            <td>

                                                            </td>

                                                            <!--Semis-->
                                                            <td data-label="Semi-Finals">
                                                                <?php $semisAttendance = $studentInfos->semis_at_act1 + $studentInfos->semis_at_act2 + $studentInfos->semis_at_act3 + $studentInfos->semis_at_act4 + $studentInfos->semis_at_act5 +
                                                                    $studentInfos->semis_at_act6 + $studentInfos->semis_at_act7 + $studentInfos->semis_at_act8 + $studentInfos->semis_at_act9 + $studentInfos->semis_at_act10 +
                                                                    $studentInfos->semis_at_act11 + $studentInfos->semis_at_act12 + $studentInfos->semis_at_act13 + $studentInfos->semis_at_act14 + $studentInfos->semis_at_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($semisAttendance === 0 && $semisAttendanceSummary === 0) {
                                                                    $semisTotalAttendanceRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $semisAttendanceSummaryWsConverted = convertToPercent($semisAttendanceSummaryWs);
                                                                    $semisTotalAttendance = ($semisAttendance / $semisAttendanceSummary) * $semisAttendanceSummaryWsConverted;
                                                                    $semisTotalAttendanceRound = round($semisTotalAttendance, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }

                                                                ?>


                                                                <?php $semisRecitation = $studentInfos->semis_re_act1 + $studentInfos->semis_re_act2 + $studentInfos->semis_re_act3 + $studentInfos->semis_re_act4 + $studentInfos->semis_re_act5 +
                                                                    $studentInfos->semis_re_act6 + $studentInfos->semis_re_act7 + $studentInfos->semis_re_act8 + $studentInfos->semis_re_act9 + $studentInfos->semis_re_act10 +
                                                                    $studentInfos->semis_re_act11 + $studentInfos->semis_re_act12 + $studentInfos->semis_re_act13 + $studentInfos->semis_re_act14 + $studentInfos->semis_re_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($semisRecitation === 0 && $semisRecitationSummary === 0) {
                                                                    $semisTotalRecitationRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $semisRecitationSummaryWsConverted = convertToPercent($semisRecitationSummaryWs);
                                                                    $semisTotalRecitation = ($semisRecitation / $semisRecitationSummary) * $semisRecitationSummaryWsConverted;
                                                                    $semisTotalRecitationRound = round($semisTotalRecitation, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }

                                                                ?>


                                                                <?php $semisQuiz = $studentInfos->semis_qu_act1 + $studentInfos->semis_qu_act2 + $studentInfos->semis_qu_act3 + $studentInfos->semis_qu_act4 + $studentInfos->semis_qu_act5 +
                                                                    $studentInfos->semis_qu_act6 + $studentInfos->semis_qu_act7 + $studentInfos->semis_qu_act8 + $studentInfos->semis_qu_act9 + $studentInfos->semis_qu_act10 +
                                                                    $studentInfos->semis_qu_act11 + $studentInfos->semis_qu_act12 + $studentInfos->semis_qu_act13 + $studentInfos->semis_qu_act14 + $studentInfos->semis_qu_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($semisQuiz === 0 && $semisQuizSummary === 0) {
                                                                    $semisTotalQuizRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $semisQuizSummaryWsConverted = convertToPercent($semisQuizSummaryWs);
                                                                    $semisTotalQuiz = ($semisQuiz / $semisQuizSummary) * $semisQuizSummaryWsConverted;
                                                                    $semisTotalQuizRound = round($semisTotalQuiz, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>

                                                                <?php $semisProject = $studentInfos->semis_pr_act1 + $studentInfos->semis_pr_act2 + $studentInfos->semis_pr_act3 + $studentInfos->semis_pr_act4 + $studentInfos->semis_pr_act5 +
                                                                    $studentInfos->semis_pr_act6 + $studentInfos->semis_pr_act7 + $studentInfos->semis_pr_act8 + $studentInfos->semis_pr_act9 + $studentInfos->semis_pr_act10 +
                                                                    $studentInfos->semis_pr_act11 + $studentInfos->semis_pr_act12 + $studentInfos->semis_pr_act13 + $studentInfos->semis_pr_act14 + $studentInfos->semis_pr_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($semisProject === 0 && $semisProjectSummary === 0) {
                                                                    $semisTotalProjectRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $semisProjectSummaryWsConverted = convertToPercent($semisProjectSummaryWs);
                                                                    $semisTotalProject = ($semisProject / $semisProjectSummary) * $semisProjectSummaryWsConverted;
                                                                    $semisTotalProjectRound = round($semisTotalProject, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>

                                                                <?php $semisAssignment = $studentInfos->semis_as_act1 + $studentInfos->semis_as_act2 + $studentInfos->semis_as_act3 + $studentInfos->semis_as_act4 + $studentInfos->semis_as_act5 +
                                                                    $studentInfos->semis_as_act6 + $studentInfos->semis_as_act7 + $studentInfos->semis_as_act8 + $studentInfos->semis_as_act9 + $studentInfos->semis_as_act10 +
                                                                    $studentInfos->semis_as_act11 + $studentInfos->semis_as_act12 + $studentInfos->semis_as_act13 + $studentInfos->semis_as_act14 + $studentInfos->semis_as_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($semisAssignment === 0 && $semisAssignmentSummary === 0) {
                                                                    $semisTotalAssignmentRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $semisAssignmentSummaryWsConverted = convertToPercent($semisAssignmentSummaryWs);
                                                                    $semisTotalAssignment = ($semisAssignment / $semisAssignmentSummary) * $semisAssignmentSummaryWsConverted;
                                                                    $semisTotalAssignmentRound = round($semisTotalAssignment, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>

                                                                <?php $semisExam = $studentInfos->semis_ex_act1 + $studentInfos->semis_ex_act2 + $studentInfos->semis_ex_act3 + $studentInfos->semis_ex_act4 + $studentInfos->semis_ex_act5 +
                                                                    $studentInfos->semis_ex_act6 + $studentInfos->semis_ex_act7 + $studentInfos->semis_ex_act8 + $studentInfos->semis_ex_act9 + $studentInfos->semis_ex_act10 +
                                                                    $studentInfos->semis_ex_act11 + $studentInfos->semis_ex_act12 + $studentInfos->semis_ex_act13 + $studentInfos->semis_ex_act14 + $studentInfos->semis_ex_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($semisExam === 0 && $semisExamSummary === 0) {
                                                                    $semisTotalExamRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $semisExamSummaryWsConverted = convertToPercent($semisExamSummaryWs);
                                                                    $semisTotalExam = ($semisExam / $semisExamSummary) * $semisExamSummaryWsConverted;
                                                                    $semisTotalExamRound = round($semisTotalExam, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>


                                                                <?php $semisInitialGradeSummary =  $semisTotalAttendanceRound + $semisTotalRecitationRound + $semisTotalQuizRound + $semisTotalProjectRound + $semisTotalAssignmentRound + $semisTotalExamRound;
                                                                if (empty($semisInitialGradeSummary)) {
                                                                    echo '';
                                                                } else {
                                                                    echo $semisInitialGradeSummary;
                                                                } ?>
                                                            </td>
                                                            <td>

                                                            </td>


                                                            <!--Finals-->
                                                            <td data-label="Finals">
                                                                <?php $finalsAttendance = $studentInfos->finals_at_act1 + $studentInfos->finals_at_act2 + $studentInfos->finals_at_act3 + $studentInfos->finals_at_act4 + $studentInfos->finals_at_act5 +
                                                                    $studentInfos->finals_at_act6 + $studentInfos->finals_at_act7 + $studentInfos->finals_at_act8 + $studentInfos->finals_at_act9 + $studentInfos->finals_at_act10 +
                                                                    $studentInfos->finals_at_act11 + $studentInfos->finals_at_act12 + $studentInfos->finals_at_act13 + $studentInfos->finals_at_act14 + $studentInfos->finals_at_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($finalsAttendance === 0 && $finalsAttendanceSummary === 0) {
                                                                    $finalsTotalAttendanceRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $finalsAttendanceSummaryWsConverted = convertToPercent($finalsAttendanceSummaryWs);
                                                                    $finalsTotalAttendance = ($finalsAttendance / $finalsAttendanceSummary) * $finalsAttendanceSummaryWsConverted;
                                                                    $finalsTotalAttendanceRound = round($finalsTotalAttendance, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }

                                                                ?>


                                                                <?php $finalsRecitation = $studentInfos->finals_re_act1 + $studentInfos->finals_re_act2 + $studentInfos->finals_re_act3 + $studentInfos->finals_re_act4 + $studentInfos->finals_re_act5 +
                                                                    $studentInfos->finals_re_act6 + $studentInfos->finals_re_act7 + $studentInfos->finals_re_act8 + $studentInfos->finals_re_act9 + $studentInfos->finals_re_act10 +
                                                                    $studentInfos->finals_re_act11 + $studentInfos->finals_re_act12 + $studentInfos->finals_re_act13 + $studentInfos->finals_re_act14 + $studentInfos->finals_re_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($finalsRecitation === 0 && $finalsRecitationSummary === 0) {
                                                                    $finalsTotalRecitationRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $finalsRecitationSummaryWsConverted = convertToPercent($finalsRecitationSummaryWs);
                                                                    $finalsTotalRecitation = ($finalsRecitation / $finalsRecitationSummary) * $finalsRecitationSummaryWsConverted;
                                                                    $finalsTotalRecitationRound = round($finalsTotalRecitation, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }

                                                                ?>


                                                                <?php $finalsQuiz = $studentInfos->finals_qu_act1 + $studentInfos->finals_qu_act2 + $studentInfos->finals_qu_act3 + $studentInfos->finals_qu_act4 + $studentInfos->finals_qu_act5 +
                                                                    $studentInfos->finals_qu_act6 + $studentInfos->finals_qu_act7 + $studentInfos->finals_qu_act8 + $studentInfos->finals_qu_act9 + $studentInfos->finals_qu_act10 +
                                                                    $studentInfos->finals_qu_act11 + $studentInfos->finals_qu_act12 + $studentInfos->finals_qu_act13 + $studentInfos->finals_qu_act14 + $studentInfos->finals_qu_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($finalsQuiz === 0 && $finalsQuizSummary === 0) {
                                                                    $finalsTotalQuizRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $finalsQuizSummaryWsConverted = convertToPercent($finalsQuizSummaryWs);
                                                                    $finalsTotalQuiz = ($finalsQuiz / $finalsQuizSummary) * $finalsQuizSummaryWsConverted;
                                                                    $finalsTotalQuizRound = round($finalsTotalQuiz, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>

                                                                <?php $finalsProject = $studentInfos->finals_pr_act1 + $studentInfos->finals_pr_act2 + $studentInfos->finals_pr_act3 + $studentInfos->finals_pr_act4 + $studentInfos->finals_pr_act5 +
                                                                    $studentInfos->finals_pr_act6 + $studentInfos->finals_pr_act7 + $studentInfos->finals_pr_act8 + $studentInfos->finals_pr_act9 + $studentInfos->finals_pr_act10 +
                                                                    $studentInfos->finals_pr_act11 + $studentInfos->finals_pr_act12 + $studentInfos->finals_pr_act13 + $studentInfos->finals_pr_act14 + $studentInfos->finals_pr_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($finalsProject === 0 && $finalsProjectSummary === 0) {
                                                                    $finalsTotalProjectRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $finalsProjectSummaryWsConverted = convertToPercent($finalsProjectSummaryWs);
                                                                    $finalsTotalProject = ($finalsProject / $finalsProjectSummary) * $finalsProjectSummaryWsConverted;
                                                                    $finalsTotalProjectRound = round($finalsTotalProject, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>

                                                                <?php $finalsAssignment = $studentInfos->finals_as_act1 + $studentInfos->finals_as_act2 + $studentInfos->finals_as_act3 + $studentInfos->finals_as_act4 + $studentInfos->finals_as_act5 +
                                                                    $studentInfos->finals_as_act6 + $studentInfos->finals_as_act7 + $studentInfos->finals_as_act8 + $studentInfos->finals_as_act9 + $studentInfos->finals_as_act10 +
                                                                    $studentInfos->finals_as_act11 + $studentInfos->finals_as_act12 + $studentInfos->finals_as_act13 + $studentInfos->finals_as_act14 + $studentInfos->finals_as_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($finalsAssignment === 0 && $finalsAssignmentSummary === 0) {
                                                                    $finalsTotalAssignmentRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $finalsAssignmentSummaryWsConverted = convertToPercent($finalsAssignmentSummaryWs);
                                                                    $finalsTotalAssignment = ($finalsAssignment / $finalsAssignmentSummary) * $finalsAssignmentSummaryWsConverted;
                                                                    $finalsTotalAssignmentRound = round($finalsTotalAssignment, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>

                                                                <?php $finalsExam = $studentInfos->finals_ex_act1 + $studentInfos->finals_ex_act2 + $studentInfos->finals_ex_act3 + $studentInfos->finals_ex_act4 + $studentInfos->finals_ex_act5 +
                                                                    $studentInfos->finals_ex_act6 + $studentInfos->finals_ex_act7 + $studentInfos->finals_ex_act8 + $studentInfos->finals_ex_act9 + $studentInfos->finals_ex_act10 +
                                                                    $studentInfos->finals_ex_act11 + $studentInfos->finals_ex_act12 + $studentInfos->finals_ex_act13 + $studentInfos->finals_ex_act14 + $studentInfos->finals_ex_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($finalsExam === 0 && $finalsExamSummary === 0) {
                                                                    $finalsTotalExamRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;

                                                                } else {
                                                                    $finalsExamSummaryWsConverted = convertToPercent($finalsExamSummaryWs);
                                                                    $finalsTotalExam = ($finalsExam / $finalsExamSummary) * $finalsExamSummaryWsConverted;
                                                                    $finalsTotalExamRound = round($finalsTotalExam, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }
                                                                ?>


                                                                <?php $finalsInitialGradeSummary =  $finalsTotalAttendanceRound + $finalsTotalRecitationRound + $finalsTotalQuizRound + $finalsTotalProjectRound + $finalsTotalAssignmentRound + $finalsTotalExamRound;
                                                                if (empty($finalsInitialGradeSummary)) {
                                                                    echo '';
                                                                } else {
                                                                    echo $finalsInitialGradeSummary;
                                                                } ?>
                                                            </td>
                                                            <td>

                                                            </td>



                                                            <td data-label="Average">
                                                                <strong><?php $collegeFinalGrade = ($prelimInitialGradeSummary + $midtermInitialGradeSummary + $semisInitialGradeSummary + $finalsInitialGradeSummary) / 4;
                                                                        $roundFinalCollege = 0;
                                                                        if (empty($prelimInitialGradeSummary) || empty($midtermInitialGradeSummary) || empty($semisInitialGradeSummary) || empty($finalsInitialGradeSummary)) {
                                                                            echo '';
                                                                        } else {
                                                                            $roundFinalCollege = round($collegeFinalGrade);
                                                                            echo $roundFinalCollege;
                                                                        } ?></strong>
                                                            </td>
                                                            <td data-label="Final Grade" class="final_grade">
                                                                <strong><?php if (empty($prelimInitialGradeSummary) || empty($midtermInitialGradeSummary) || empty($semisInitialGradeSummary) || empty($finalsInitialGradeSummary)) {
                                                                            echo '';
                                                                            $convertedeCollegeGrade = 1;
                                                                        } else {
                                                                            if ($prelimExam === 0 || $midtermExam === 0 || $semisExam === 0 || $finalsExam === 0) {
                                                                                $convertedeCollegeGrade = 0;
                                                                                echo 'INC';
                                                                            } else {
                                                                                $convertedeCollegeGrade = convertCollegeGrade($roundFinalCollege);
                                                                                echo $convertedeCollegeGrade;
                                                                            }
                                                                        }
                                                                        ?></strong>
                                                            </td>
                                                            <td class="grade_remarks <?php $gradeRemarks = finalGradeRemarksCollege($convertedeCollegeGrade);
                                                                                        if ($gradeRemarks === 'FAILED') {
                                                                                            echo ' ' . 'failedRed';
                                                                                        }  ?>" data-label="Remarks">
                                                                <strong><?php $gradeRemarks = finalGradeRemarksCollege($convertedeCollegeGrade);
                                                                        if (empty($prelimInitialGradeSummary) || empty($midtermInitialGradeSummary) || empty($semisInitialGradeSummary) || empty($finalsInitialGradeSummary)) {
                                                                            echo '';
                                                                        } else {
                                                                            echo $gradeRemarks;
                                                                        }
                                                                        ?></strong>
                                                            </td>





                                                        </tr>
                                                    <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row mx-auto heads">
                                        <div class="col-xl-6 col-lg-6 col-md-12 pl-0">
                                            <div class="col-xl-6 col-lg-6 col-md-12 pl-0">
                                                <div class="btn-group btn-group-toggle mt-4 updateDate" data-toggle="buttons">
                                                    <h5><?php echo 'Release Date: ' . $data['submitSched']; ?></h5>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 px-0">
                                            <div class="mt-4">
                                                <button class="btn btn-primary float-lg-right <?php echo $data['isExistInFinalGrade']; ?>" role="button" href=""><i class="fas fa-chart-bar"></i> <?php echo ($data['isExistInFinalGrade'] === '') ? 'Submitted' : 'Submit'; ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (empty($data['studentInfo']) && empty($data['studentInfoCollege'])) : ?>
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
<!--Confirmation Modal-->
<div class="modal" tabindex="-1" id="confirmModals" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Grades</h5>
                <button type="button" class="close cancelSubmit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelSubmit" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveGrade">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="dateShown1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Date</h5>
                <button type="button" class="close cancelSubmit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Show Date</p>
                <div class="input-group date" data-provide="datepicker">
                    <input type="date" class="form-control confirmDate1">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelSubmit" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirmDates1">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="reportModals" role="dialog">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submitted Grade Report</h5>
                <button type="button" class="close closeReport" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div id="outputReport">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closeReport" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="updateDate" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Date</h5>
                <button type="button" class="close cancelSubmit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Show Date</p>
                <div class="input-group date" data-provide="datepicker">
                    <input type="date" class="form-control confirmDateUpdate">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelSubmit" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary dateUpdate">Update</button>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
    $(document).ready(function() {
        $('.hideColumn').hide();



        $('.submitGrade').click(function() {
            var submittedInfo = {
                programId: [],
                studentId: [],
                studentNo: [],
                finalGrade: [],
                gradeRemarks: [],
                studentName: [],
                studentCourse: []

            };
            $('.program_id').each(function() {
                submittedInfo.programId.push($(this).text());
            });
            $('.student_id').each(function() {
                submittedInfo.studentId.push($(this).text());
            });
            $('.student_no').each(function() {
                submittedInfo.studentNo.push($(this).text());
            });
            $('.final_grade').each(function() {
                submittedInfo.finalGrade.push($(this).text());
            });

            $('.grade_remarks').each(function() {
                submittedInfo.gradeRemarks.push($(this).text());
            });
            $('.student_name').each(function() {
                submittedInfo.studentName.push($(this).text());
            });
            $('.student_course').each(function() {
                submittedInfo.studentCourse.push($(this).text());
            });

            if (checkIfBlank(submittedInfo)) {
                $('#dateShown1').toggle();

                $('.confirmDates1').click(function() {
                    var assignDate = $('.confirmDate1').val();

                    if (assignDate === '') {
                        alert('Please select date of grade showing');
                    } else {
                        $('#dateShown1').hide();
                        $('#confirmModals').toggle();

                        $('.saveGrade').click(function() {
                            var subjectName = '<?php echo $data['subjectName'] ?>';
                            var subjectDescription = '<?php echo $data['description'] ?>';
                            var subjectYearLevel = '<?php echo $data['subjectGrade'] ?>';

                            var subjectId = '<?php echo $data['subjectId'] ?>';
                            $.ajax({
                                url: '<?php echo URLROOT ?>' + '/Actions/submitCollegeGrade',
                                method: 'post',
                                data: {
                                    submittedInfo: submittedInfo,
                                    subjectName: subjectName,
                                    subjectDescription: subjectDescription,
                                    subjectYearLevel: subjectYearLevel,
                                    subjectId: subjectId,
                                    assignDate: assignDate

                                },
                                success: function(response) {
                                    $('#confirmModals').hide();
                                    $('#outputReport').html(response);
                                    $('#reportModals').toggle();
                                    closeReport()

                                }
                            });
                        });

                    }
                });


            }

            cancelSubmit()

        });

        $('.updateDate').click(function() {
            var dateView = '<?php echo $data['submitSched'] ?>';
            if (dateView === '---- -- --') {
                alert('Date cannot be edited');
            } else {
                $('#updateDate').toggle();

                $('.dateUpdate').click(function() {
                    var updateDate = $('.confirmDateUpdate').val();

                    if (updateDate === '') {
                        alert('Please select date');
                    } else {
                        var dateId = '<?php echo $data['submitSchedId'] ?>';
                        $.ajax({
                            url: '<?php echo URLROOT ?>' + '/Actions/updateSubmitGradeCollege',
                            method: 'post',
                            data: {
                                updateDate: updateDate,
                                dateId: dateId

                            },
                            success: function(response) {
                                alert(response);
                                $('#updateDate').hide();
                                location.reload();


                            }
                        });
                    }
                });
            }


            cancelSubmit()
        });

        $('#prints').click(function() {

            window.print();
        });


        function checkIfBlank(items) {
            var result = 0;

            for (var key in items.gradeRemarks) {
                var remarks = $.trim(items.gradeRemarks[key]);
                //console.log(activity);

                console.log(remarks);
                if (remarks === '') {
                    result = result + 1;
                }
            }
            //console.log(result);

            if (result > 0) {
                alert('Please complete the blank grade first');
            } else {
                return true;
            }

        }

        function closeReport() {
            $('.closeReport').click(function() {
                $('#reportModals').hide();
                location.reload();
            });
        }

        function cancelSubmit() {
            $('.cancelSubmit').click(function() {
                $('#confirmModals').hide();
                location.reload();
            });
        }

    });
</script>