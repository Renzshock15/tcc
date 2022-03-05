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
                                            <li class="breadcrumb-item "><a class="text-danger" href="<?php echo URLROOT; ?>/teachers/senior_grade1/senior/<?php echo $data['subjectId'] ?>">Student List</a></li>
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
                                                    <th></th>
                                                    <th></th>
                                                    <th>Full Name</th>
                                                    <th></th>
                                                    <th colspan="2">1st</th>

                                                    <th></th>
                                                    <th colspan="2">2nd</th>

                                                    <th></th>
                                                    <th>Final Grade</th>
                                                    <th>Remarks</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $firstWrittenWorksSummary = 0; ?>
                                                <?php foreach ($data['juniorSummaryFWW'] as $juniorSummaryFWW) : ?>
                                                    <?php $firstWrittenWorksSummary = intval($juniorSummaryFWW->act1) + intval($juniorSummaryFWW->act2) + intval($juniorSummaryFWW->act3) + intval($juniorSummaryFWW->act4) + intval($juniorSummaryFWW->act5)
                                                        + intval($juniorSummaryFWW->act6) + intval($juniorSummaryFWW->act7) + intval($juniorSummaryFWW->act8) + intval($juniorSummaryFWW->act9) + intval($juniorSummaryFWW->act10)
                                                        + intval($juniorSummaryFWW->act11) + intval($juniorSummaryFWW->act12) + intval($juniorSummaryFWW->act13) + intval($juniorSummaryFWW->act14) + intval($juniorSummaryFWW->act15);
                                                    // echo $firstWrittenWorksSummary;
                                                    $firstWrittenWorksSummaryWs = $juniorSummaryFWW->actWs; ?>

                                                <?php endforeach; ?>
                                                <?php if (empty($firstWrittenWorksSummaryWs)) {
                                                    $firstWrittenWorksSummaryWs = 0;
                                                    // echo $firstWrittenWorksSummaryWs;
                                                } else {
                                                    // echo $firstWrittenWorksSummaryWs;
                                                }  ?>

                                                <?php $firstPerformanceTaskSummary = 0; ?>
                                                <?php foreach ($data['juniorSummaryFPT'] as $juniorSummaryFPT) : ?>
                                                    <?php $firstPerformanceTaskSummary = intval($juniorSummaryFPT->act1) + intval($juniorSummaryFPT->act2) + intval($juniorSummaryFPT->act3) + intval($juniorSummaryFPT->act4) + intval($juniorSummaryFPT->act5)
                                                        + intval($juniorSummaryFPT->act6) + intval($juniorSummaryFPT->act7) + intval($juniorSummaryFPT->act8) + intval($juniorSummaryFPT->act9) + intval($juniorSummaryFPT->act10)
                                                        + intval($juniorSummaryFPT->act11) + intval($juniorSummaryFPT->act12) + intval($juniorSummaryFPT->act13) + intval($juniorSummaryFPT->act14) + intval($juniorSummaryFPT->act15);
                                                    // echo $firstPerformanceTaskSummary;
                                                    $firstPerformanceTaskSummaryWs = $juniorSummaryFPT->actWs; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($firstPerformanceTaskSummaryWs)) {
                                                    $firstPerformanceTaskSummaryWs = 0;
                                                    // echo $firstPerformanceTaskSummaryWs;
                                                } else {
                                                    // echo $firstPerformanceTaskSummaryWs;
                                                }  ?>


                                                <?php $firstQuarterlyAssessmentSummary = 0; ?>
                                                <?php foreach ($data['juniorSummaryFQA'] as $juniorSummaryFQA) : ?>
                                                    <?php $firstQuarterlyAssessmentSummary = intval($juniorSummaryFQA->act1) + intval($juniorSummaryFQA->act2) + intval($juniorSummaryFQA->act3) + intval($juniorSummaryFQA->act4) + intval($juniorSummaryFQA->act5)
                                                        + intval($juniorSummaryFQA->act6) + intval($juniorSummaryFQA->act7) + intval($juniorSummaryFQA->act8) + intval($juniorSummaryFQA->act9) + intval($juniorSummaryFQA->act10)
                                                        + intval($juniorSummaryFQA->act11) + intval($juniorSummaryFQA->act12) + intval($juniorSummaryFQA->act13) + intval($juniorSummaryFQA->act14) + intval($juniorSummaryFQA->act15);
                                                    // echo $firstQuarterlyAssessmentSummary;
                                                    $firstQuarterlyAssessmentSummaryWs = $juniorSummaryFQA->actWs; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($firstQuarterlyAssessmentSummaryWs)) {
                                                    $firstQuarterlyAssessmentSummaryWs = 0;
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $firstQuarterlyAssessmentSummaryWs;
                                                }  ?>



                                                <?php $secondWrittenWorksSummary = 0; ?>
                                                <?php foreach ($data['juniorSummarySWW'] as $juniorSummarySWW) : ?>
                                                    <?php $secondWrittenWorksSummary = intval($juniorSummarySWW->act1) + intval($juniorSummarySWW->act2) + intval($juniorSummarySWW->act3) + intval($juniorSummarySWW->act4) + intval($juniorSummarySWW->act5)
                                                        + intval($juniorSummarySWW->act6) + intval($juniorSummarySWW->act7) + intval($juniorSummarySWW->act8) + intval($juniorSummarySWW->act9) + intval($juniorSummarySWW->act10)
                                                        + intval($juniorSummarySWW->act11) + intval($juniorSummarySWW->act12) + intval($juniorSummarySWW->act13) + intval($juniorSummarySWW->act14) + intval($juniorSummarySWW->act15);
                                                    // echo $firstWrittenWorksSummary;
                                                    $secondWrittenWorksSummaryWs = $juniorSummarySWW->actWs; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($secondWrittenWorksSummaryWs)) {
                                                    $secondWrittenWorksSummaryWs = 0;
                                                    // echo $secondWrittenWorksSummaryWs;
                                                } else {
                                                    // echo $secondWrittenWorksSummaryWs;
                                                }  ?>

                                                <?php $secondPerformanceTaskSummary = 0; ?>
                                                <?php foreach ($data['juniorSummarySPT'] as $juniorSummarySPT) : ?>
                                                    <?php $secondPerformanceTaskSummary = intval($juniorSummarySPT->act1) + intval($juniorSummarySPT->act2) + intval($juniorSummarySPT->act3) + intval($juniorSummarySPT->act4) + intval($juniorSummarySPT->act5)
                                                        + intval($juniorSummarySPT->act6) + intval($juniorSummarySPT->act7) + intval($juniorSummarySPT->act8) + intval($juniorSummarySPT->act9) + intval($juniorSummarySPT->act10)
                                                        + intval($juniorSummarySPT->act11) + intval($juniorSummarySPT->act12) + intval($juniorSummarySPT->act13) + intval($juniorSummarySPT->act14) + intval($juniorSummarySPT->act15);
                                                    // echo $firstPerformanceTaskSummary;
                                                    $secondPerformanceTaskSummaryWs = $juniorSummarySPT->actWs; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($secondPerformanceTaskSummaryWs)) {
                                                    $secondPerformanceTaskSummaryWs = 0;
                                                    // echo $secondPerformanceTaskSummaryWs;
                                                } else {
                                                    // echo $secondPerformanceTaskSummaryWs;
                                                }  ?>

                                                <?php $secondQuarterlyAssessmentSummary = 0; ?>
                                                <?php foreach ($data['juniorSummarySQA'] as $juniorSummarySQA) : ?>
                                                    <?php $secondQuarterlyAssessmentSummary = intval($juniorSummarySQA->act1) + intval($juniorSummarySQA->act2) + intval($juniorSummarySQA->act3) + intval($juniorSummarySQA->act4) + intval($juniorSummarySQA->act5)
                                                        + intval($juniorSummarySQA->act6) + intval($juniorSummarySQA->act7) + intval($juniorSummarySQA->act8) + intval($juniorSummarySQA->act9) + intval($juniorSummarySQA->act10)
                                                        + intval($juniorSummarySQA->act11) + intval($juniorSummarySQA->act12) + intval($juniorSummarySQA->act13) + intval($juniorSummarySQA->act14) + intval($juniorSummarySQA->act15);
                                                    // echo $firstQuarterlyAssessmentSummary;
                                                    $secondQuarterlyAssessmentSummaryWs = $juniorSummarySQA->actWs; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($secondQuarterlyAssessmentSummaryWs)) {
                                                    $secondQuarterlyAssessmentSummaryWs = 0;
                                                    // echo $secondQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $secondQuarterlyAssessmentSummaryWs;
                                                }  ?>


                                                <div id="outputJr">
                                                    <?php foreach ($data['studentInfo'] as $studentInfos) : ?>
                                                        <tr>
                                                            <td class="student_id">
                                                                <?php echo $studentInfos->studentId; ?>
                                                            </td>
                                                            <td class="student_no">
                                                                <?php echo $studentInfos->studentNo; ?>
                                                            </td>
                                                            <td data-label="Full Name" class="student_name">
                                                                <?php echo $studentInfos->lname . ', ' . $studentInfos->fname . ' ' . $studentInfos->mname; ?>
                                                            </td>

                                                            <td>

                                                            </td>
                                                            <!--1st quarter-->
                                                            <td data-label="1st Initial Grade" class="first_ig">
                                                                <?php $firstWrittenWorks = $studentInfos->first_ww_act1 + $studentInfos->first_ww_act2 + $studentInfos->first_ww_act3 + $studentInfos->first_ww_act4 + $studentInfos->first_ww_act5 +
                                                                    $studentInfos->first_ww_act6 + $studentInfos->first_ww_act7 + $studentInfos->first_ww_act8 + $studentInfos->first_ww_act9 + $studentInfos->first_ww_act10 +
                                                                    $studentInfos->first_ww_act11 + $studentInfos->first_ww_act12 + $studentInfos->first_ww_act13 + $studentInfos->first_ww_act14 + $studentInfos->first_ww_act15;
                                                                // echo $firstWrittenWorks;
                                                                if ($firstWrittenWorks === 0 && $firstWrittenWorksSummary === 0) {
                                                                    $firstTotalWrittenWorksRound = 0.00;
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                } else {
                                                                    $firstTotalWrittenWorks = ($firstWrittenWorks / $firstWrittenWorksSummary) * $firstWrittenWorksSummaryWs;
                                                                    $firstTotalWrittenWorksRound = round($firstTotalWrittenWorks, 2);
                                                                    // echo $firstTotalWrittenWorksRound;
                                                                }

                                                                ?>


                                                                <?php $firstPerformanceTask = $studentInfos->first_pt_act1 + $studentInfos->first_pt_act2 + $studentInfos->first_pt_act3 + $studentInfos->first_pt_act4 + $studentInfos->first_pt_act5 +
                                                                    $studentInfos->first_pt_act6 + $studentInfos->first_pt_act7 + $studentInfos->first_pt_act8 + $studentInfos->first_pt_act9 + $studentInfos->first_pt_act10 +
                                                                    $studentInfos->first_pt_act11 + $studentInfos->first_pt_act12 + $studentInfos->first_pt_act13 + $studentInfos->first_pt_act14 + $studentInfos->first_pt_act15;
                                                                // echo $firstPerformanceTask;
                                                                if ($firstPerformanceTask === 0 && $firstPerformanceTaskSummary === 0) {
                                                                    $firstTotalPerformanceTaskRound = 0.00;
                                                                    // echo $firstTotalPerformanceTaskRound;
                                                                } else {
                                                                    $firstTotalPerformanceTask = ($firstPerformanceTask / $firstPerformanceTaskSummary) * $firstPerformanceTaskSummaryWs;
                                                                    $firstTotalPerformanceTaskRound = round($firstTotalPerformanceTask, 2);
                                                                    // echo $firstTotalPerformanceTaskRound;
                                                                }

                                                                ?>


                                                                <?php $firstQuarterlyAssessment = $studentInfos->first_qa_act1 + $studentInfos->first_qa_act2 + $studentInfos->first_qa_act3 + $studentInfos->first_qa_act4 + $studentInfos->first_qa_act5 +
                                                                    $studentInfos->first_qa_act6 + $studentInfos->first_qa_act7 + $studentInfos->first_qa_act8 + $studentInfos->first_qa_act9 + $studentInfos->first_qa_act10 +
                                                                    $studentInfos->first_qa_act11 + $studentInfos->first_qa_act12 + $studentInfos->first_qa_act13 + $studentInfos->first_qa_act14 + $studentInfos->first_qa_act15;
                                                                // echo $firstQuarterlyAssessment;
                                                                if ($firstQuarterlyAssessment === 0 && $firstQuarterlyAssessmentSummary === 0) {
                                                                    $firstTotalQuarterlyAssessmentRound = 0.00;
                                                                    // echo $firstTotalQuarterlyAssessmentRound;
                                                                } else {
                                                                    $firstQuarterlyAssessment = ($firstQuarterlyAssessment / $firstQuarterlyAssessmentSummary) * $firstQuarterlyAssessmentSummaryWs;
                                                                    $firstTotalQuarterlyAssessmentRound = round($firstQuarterlyAssessment, 2);
                                                                    // echo $firstTotalQuarterlyAssessmentRound;
                                                                } ?>


                                                                <?php $firstInitialGradeSummary =  $firstTotalWrittenWorksRound + $firstTotalPerformanceTaskRound + $firstTotalQuarterlyAssessmentRound;
                                                                if (empty($firstInitialGradeSummary)) {
                                                                    echo '';
                                                                } else {
                                                                    echo $firstInitialGradeSummary;
                                                                } ?>
                                                            </td>
                                                            <td data-label="1st Quarterly Grade" class="first_quarter">
                                                                <strong><?php $firstQuarterlyGrade = transmuteGrade($firstInitialGradeSummary);
                                                                        if (empty($firstInitialGradeSummary)) {
                                                                            echo '';
                                                                        } else {
                                                                            echo $firstQuarterlyGrade;
                                                                        }
                                                                        ?></strong>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <!--2nd quarter-->
                                                            <td data-label="2nd Initial Grade" class="second_ig">
                                                                <?php $secondWrittenWorks = $studentInfos->second_ww_act1 + $studentInfos->second_ww_act2 + $studentInfos->second_ww_act3 + $studentInfos->second_ww_act4 + $studentInfos->second_ww_act5 +
                                                                    $studentInfos->second_ww_act6 + $studentInfos->second_ww_act7 + $studentInfos->second_ww_act8 + $studentInfos->second_ww_act9 + $studentInfos->second_ww_act10 +
                                                                    $studentInfos->second_ww_act11 + $studentInfos->second_ww_act12 + $studentInfos->second_ww_act13 + $studentInfos->second_ww_act14 + $studentInfos->second_ww_act15;
                                                                // echo $secondWrittenWorks;
                                                                if ($secondWrittenWorks === 0 && $secondWrittenWorksSummary === 0) {
                                                                    $secondTotalWrittenWorksRound = 0.00;
                                                                    // echo $secondTotalWrittenWorksRound;
                                                                } else {
                                                                    $secondTotalWrittenWorks = ($secondWrittenWorks / $secondWrittenWorksSummary) * $secondWrittenWorksSummaryWs;
                                                                    $secondTotalWrittenWorksRound = round($secondTotalWrittenWorks, 2);
                                                                    // echo $secondTotalWrittenWorksRound;
                                                                } ?>


                                                                <?php $secondPerformanceTask = $studentInfos->second_pt_act1 + $studentInfos->second_pt_act2 + $studentInfos->second_pt_act3 + $studentInfos->second_pt_act4 + $studentInfos->second_pt_act5 +
                                                                    $studentInfos->second_pt_act6 + $studentInfos->second_pt_act7 + $studentInfos->second_pt_act8 + $studentInfos->second_pt_act9 + $studentInfos->second_pt_act10 +
                                                                    $studentInfos->second_pt_act11 + $studentInfos->second_pt_act12 + $studentInfos->second_pt_act13 + $studentInfos->second_pt_act14 + $studentInfos->second_pt_act15;
                                                                // echo $secondPerformanceTask;
                                                                if ($secondPerformanceTask === 0 && $secondPerformanceTaskSummary === 0) {
                                                                    $secondTotalPerformanceTaskRound = 0.00;
                                                                    // echo $secondTotalPerformanceTaskRound;
                                                                } else {
                                                                    $secondTotalPerformanceTask = ($secondPerformanceTask / $secondPerformanceTaskSummary) * $secondPerformanceTaskSummaryWs;
                                                                    $secondTotalPerformanceTaskRound = round($secondTotalPerformanceTask, 2);
                                                                    // echo $secondTotalPerformanceTaskRound;
                                                                } ?>

                                                                <?php $secondQuarterlyAssessment = $studentInfos->second_qa_act1 + $studentInfos->second_qa_act2 + $studentInfos->second_qa_act3 + $studentInfos->second_qa_act4 + $studentInfos->second_qa_act5 +
                                                                    $studentInfos->second_qa_act6 + $studentInfos->second_qa_act7 + $studentInfos->second_qa_act8 + $studentInfos->second_qa_act9 + $studentInfos->second_qa_act10 +
                                                                    $studentInfos->second_qa_act11 + $studentInfos->second_qa_act12 + $studentInfos->second_qa_act13 + $studentInfos->second_qa_act14 + $studentInfos->second_qa_act15;
                                                                // echo $secondQuarterlyAssessment;
                                                                if ($secondQuarterlyAssessment === 0 && $secondQuarterlyAssessmentSummary === 0) {
                                                                    $secondTotalQuarterlyAssessmentRound = 0.00;
                                                                    // echo $secondTotalQuarterlyAssessmentRound;
                                                                } else {
                                                                    $secondQuarterlyAssessment = ($secondQuarterlyAssessment / $secondQuarterlyAssessmentSummary) * $secondQuarterlyAssessmentSummaryWs;
                                                                    $secondTotalQuarterlyAssessmentRound = round($secondQuarterlyAssessment, 2);
                                                                    // echo $secondTotalQuarterlyAssessmentRound;
                                                                } ?>

                                                                <?php $secondInitialGradeSummary =  $secondTotalWrittenWorksRound + $secondTotalPerformanceTaskRound + $secondTotalQuarterlyAssessmentRound;
                                                                // echo $secondInitialGradeSummary; 
                                                                if (empty($secondInitialGradeSummary)) {
                                                                    echo '';
                                                                } else {
                                                                    echo $secondInitialGradeSummary;
                                                                } ?>
                                                            </td>
                                                            <td data-label="2nd Quarterly Grade" class="second_quarter">
                                                                <strong><?php $secondQuarterlyGrade = transmuteGrade($secondInitialGradeSummary);
                                                                        // echo $secondQuarterlyGrade; 
                                                                        if (empty($secondInitialGradeSummary)) {
                                                                            echo '';
                                                                        } else {
                                                                            echo $secondQuarterlyGrade;
                                                                        } ?></strong>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <!--3rd quarter-->

                                                            <!--4th quarter-->


                                                            <td data-label="Final Grade" class="final_grade">
                                                                <strong><?php $juniorFinalGrade = ($firstQuarterlyGrade + $secondQuarterlyGrade) / 2;
                                                                        $roundFinalSr = 0;
                                                                        if (empty($firstInitialGradeSummary) || empty($secondInitialGradeSummary)) {
                                                                            echo '';
                                                                        } else {
                                                                            $roundFinalSr = round($juniorFinalGrade);
                                                                            echo $roundFinalSr;
                                                                        } ?></strong>
                                                            </td>
                                                            <td class="<?php $gradeRemarks = finalGradeRemarks($roundFinalSr);
                                                                        if ($gradeRemarks === 'FAILED') {
                                                                            echo 'failedRed';
                                                                        }  ?> grade_remarks" data-label="Remarks">
                                                                <strong><?php $gradeRemarks = finalGradeRemarks($roundFinalSr);
                                                                        if (empty($firstInitialGradeSummary) || empty($secondInitialGradeSummary)) {
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
                                            <div class="btn-group btn-group-toggle mt-4 updateDate" data-toggle="buttons">
                                                <h5><?php echo 'Release Date: ' . $data['submitSched']; ?></h5>

                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 px-0">
                                            <div class="mt-4">
                                                <button class="btn btn-primary float-lg-right <?php echo $data['finalGradeStep']; ?>" role="button" href=""><i class="fas fa-chart-bar"></i> <?php
                                                                                                                                                                                                if ($data['finalGradeStep'] === 'submit1') {
                                                                                                                                                                                                    echo 'Submit 1';
                                                                                                                                                                                                } elseif ($data['finalGradeStep'] === 'submit2') {
                                                                                                                                                                                                    echo 'Submit Final';
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo 'Submitted';
                                                                                                                                                                                                } ?></button>
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

<div class="modal" tabindex="-1" id="dateShown2" role="dialog">
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
                    <input type="date" class="form-control confirmDate2">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelSubmit" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirmDates2">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!--confirm Modal-->
<div class="modal" tabindex="-1" id="confirmModalsSr1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Grades 1st Quarter</h5>
                <button type="button" class="close cancelSubmit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelSubmit" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveGrade1">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="confirmModalsSr2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Grades 2nd Quarter</h5>
                <button type="button" class="close cancelSubmit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelSubmit" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveGrade2">Submit</button>
            </div>
        </div>
    </div>
</div>

<!--report Modals-->
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
        $('.submit1').click(function() {
            var seniorGrade = {
                studentId: [],
                studentNo: [],
                studentName: [],
                firstIg: [],
                firstQuarter: []
            };

            $('.student_id').each(function() {
                seniorGrade.studentId.push($(this).text());
            });
            $('.student_no').each(function() {
                seniorGrade.studentNo.push($(this).text());
            });
            $('.student_name').each(function() {
                seniorGrade.studentName.push($(this).text());
            });
            $('.first_ig').each(function() {
                seniorGrade.firstIg.push($(this).text());
            });
            $('.first_quarter').each(function() {
                seniorGrade.firstQuarter.push($(this).text());
            });

            if (checkIfBlank(seniorGrade)) {
                $('#dateShown1').toggle();

                $('.confirmDates1').click(function() {
                    var assignDate = $('.confirmDate1').val();

                    if (assignDate === '') {
                        alert('Please select date of grade showing');
                    } else {
                        $('#dateShown1').hide();
                        $('#confirmModalsSr1').toggle();

                        $('.saveGrade1').click(function() {
                            var subjectName = '<?php echo $data['subjectName'] ?>';
                            var subjectDescription = '<?php echo $data['description'] ?>';
                            var subjectYearLevel = '<?php echo $data['subjectGrade'] ?>';
                            var subjectId = '<?php echo $data['subjectId'] ?>';
                            var subjectTerm = 1;
                            var gradeQuarter = '1st';
                            $.ajax({
                                url: '<?php echo URLROOT ?>' + '/Actions/submitSeniorGrade1',
                                method: 'post',
                                data: {
                                    seniorGrade: seniorGrade,
                                    subjectName: subjectName,
                                    subjectDescription: subjectDescription,
                                    subjectYearLevel: subjectYearLevel,
                                    subjectId: subjectId,
                                    assignDate: assignDate,
                                    subjectTerm: subjectTerm,
                                    gradeQuarter: gradeQuarter

                                },
                                success: function(response) {

                                    $('#confirmModalsSr1').hide();
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

        $('.submit2').click(function() {
            var seniorGrade = {
                studentId: [],
                studentNo: [],
                studentName: [],
                secondIg: [],
                secondQuarter: [],
                finalGrade: [],
                gradeRemarks: []
            };

            $('.student_id').each(function() {
                seniorGrade.studentId.push($(this).text());
            });
            $('.student_no').each(function() {
                seniorGrade.studentNo.push($(this).text());
            });
            $('.student_name').each(function() {
                seniorGrade.studentName.push($(this).text());
            });
            $('.second_ig').each(function() {
                seniorGrade.secondIg.push($(this).text());
            });
            $('.second_quarter').each(function() {
                seniorGrade.secondQuarter.push($(this).text());
            });
            $('.final_grade').each(function() {
                seniorGrade.finalGrade.push($(this).text());
            });
            $('.grade_remarks').each(function() {
                seniorGrade.gradeRemarks.push($(this).text());
            });

            if (checkIfBlankRemarks(seniorGrade)) {
                $('#dateShown2').toggle();

                $('.confirmDates2').click(function() {
                    var assignDate = $('.confirmDate2').val();

                    if (assignDate === '') {
                        alert('Please select date of grade showing');
                    } else {
                        $('#dateShown2').hide();
                        $('#confirmModalsSr2').toggle();

                        $('.saveGrade2').click(function() {
                            var subjectName = '<?php echo $data['subjectName'] ?>';
                            var subjectDescription = '<?php echo $data['description'] ?>';
                            var subjectYearLevel = '<?php echo $data['subjectGrade'] ?>';
                            var subjectId = '<?php echo $data['subjectId'] ?>';
                            var subjectTerm = 1;
                            var gradeQuarter = '2nd';
                            $.ajax({
                                url: '<?php echo URLROOT ?>' + '/Actions/submitSeniorGrade2',
                                method: 'post',
                                data: {
                                    seniorGrade: seniorGrade,
                                    subjectName: subjectName,
                                    subjectDescription: subjectDescription,
                                    subjectYearLevel: subjectYearLevel,
                                    subjectId: subjectId,
                                    assignDate: assignDate,
                                    subjectTerm: subjectTerm,
                                    gradeQuarter: gradeQuarter

                                },
                                success: function(response) {

                                    $('#confirmModalsSr2').hide();
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
                            url: '<?php echo URLROOT ?>' + '/Actions/updateSubmitGradeSr',
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

        //check if grade list has blank or incomplete
        function checkIfBlank(items) {
            var result = 0;

            for (var key in items.firstQuarter) {
                var remarks = $.trim(items.firstQuarter[key]);
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

        function checkIfBlankRemarks(items) {
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