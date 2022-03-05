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
                    <div class="card pl-0 pr-0 mt-3">
                        <div class="card-body pb-0 heads">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4>Grade Summary</h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">
                                            <li class="breadcrumb-item ml-lg-auto"><a class="text-danger" href="<?php echo URLROOT; ?>/teachers/my_class">Subjects</a></li>
                                            <li class="breadcrumb-item "><a class="text-danger" href="<?php echo URLROOT; ?>/teachers/student_subject_list/junior/<?php echo $data['subjectId'] ?>">Student List</a></li>
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
                                <h5> <?php echo 'Grade - ' . $data['subjectGrade']; ?></h5>
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
                                                    <th colspan="2">3rd</th>

                                                    <th></th>
                                                    <th colspan="2">4th</th>

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



                                                <?php $thirdWrittenWorksSummary = 0; ?>
                                                <?php foreach ($data['juniorSummaryTWW'] as $juniorSummaryTWW) : ?>
                                                    <?php $thirdWrittenWorksSummary = intval($juniorSummaryTWW->act1) + intval($juniorSummaryTWW->act2) + intval($juniorSummaryTWW->act3) + intval($juniorSummaryTWW->act4) + intval($juniorSummaryTWW->act5)
                                                        + intval($juniorSummaryTWW->act6) + intval($juniorSummaryTWW->act7) + intval($juniorSummaryTWW->act8) + intval($juniorSummaryTWW->act9) + intval($juniorSummaryTWW->act10)
                                                        + intval($juniorSummaryTWW->act11) + intval($juniorSummaryTWW->act12) + intval($juniorSummaryTWW->act13) + intval($juniorSummaryTWW->act14) + intval($juniorSummaryTWW->act15);
                                                    // echo $firstWrittenWorksSummary;
                                                    $thirdWrittenWorksSummaryWs = $juniorSummaryTWW->actWs; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($thirdWrittenWorksSummaryWs)) {
                                                    $thirdWrittenWorksSummaryWs = 0;
                                                    // echo $thirdWrittenWorksSummaryWs;
                                                } else {
                                                    // echo $thirdWrittenWorksSummaryWs;
                                                }  ?>

                                                <?php $thirdPerformanceTaskSummary = 0; ?>
                                                <?php foreach ($data['juniorSummaryTPT'] as $juniorSummaryTPT) : ?>
                                                    <?php $thirdPerformanceTaskSummary = intval($juniorSummaryTPT->act1) + intval($juniorSummaryTPT->act2) + intval($juniorSummaryTPT->act3) + intval($juniorSummaryTPT->act4) + intval($juniorSummaryTPT->act5)
                                                        + intval($juniorSummaryTPT->act6) + intval($juniorSummaryTPT->act7) + intval($juniorSummaryTPT->act8) + intval($juniorSummaryTPT->act9) + intval($juniorSummaryTPT->act10)
                                                        + intval($juniorSummaryTPT->act11) + intval($juniorSummaryTPT->act12) + intval($juniorSummaryTPT->act13) + intval($juniorSummaryTPT->act14) + intval($juniorSummaryTPT->act15);
                                                    // echo $firstPerformanceTaskSummary;
                                                    $thirdPerformanceTaskSummaryWs = $juniorSummaryTPT->actWs; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($thirdPerformanceTaskSummaryWs)) {
                                                    $thirdPerformanceTaskSummaryWs = 0;
                                                    // echo $thirdPerformanceTaskSummaryWs;
                                                } else {
                                                    // echo $thirdPerformanceTaskSummaryWs;
                                                }  ?>

                                                <?php $thirdQuarterlyAssessmentSummary = 0; ?>
                                                <?php foreach ($data['juniorSummaryTQA'] as $juniorSummaryTQA) : ?>
                                                    <?php $thirdQuarterlyAssessmentSummary = intval($juniorSummaryTQA->act1) + intval($juniorSummaryTQA->act2) + intval($juniorSummaryTQA->act3) + intval($juniorSummaryTQA->act4) + intval($juniorSummaryTQA->act5)
                                                        + intval($juniorSummaryTQA->act6) + intval($juniorSummaryTQA->act7) + intval($juniorSummaryTQA->act8) + intval($juniorSummaryTQA->act9) + intval($juniorSummaryTQA->act10)
                                                        + intval($juniorSummaryTQA->act11) + intval($juniorSummaryTQA->act12) + intval($juniorSummaryTQA->act13) + intval($juniorSummaryTQA->act14) + intval($juniorSummaryTQA->act15);
                                                    // echo $firstQuarterlyAssessmentSummary;
                                                    $thirdQuarterlyAssessmentSummaryWs = $juniorSummaryTQA->actWs; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($thirdQuarterlyAssessmentSummaryWs)) {
                                                    $thirdQuarterlyAssessmentSummaryWs = 0;
                                                    // echo $thirdQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $thirdQuarterlyAssessmentSummaryWs;
                                                }  ?>




                                                <?php $fourthWrittenWorksSummary = 0; ?>
                                                <?php foreach ($data['juniorSummaryFOWW'] as $juniorSummaryFOWW) : ?>
                                                    <?php $fourthWrittenWorksSummary = intval($juniorSummaryFOWW->act1) + intval($juniorSummaryFOWW->act2) + intval($juniorSummaryFOWW->act3) + intval($juniorSummaryFOWW->act4) + intval($juniorSummaryFOWW->act5)
                                                        + intval($juniorSummaryFOWW->act6) + intval($juniorSummaryFOWW->act7) + intval($juniorSummaryFOWW->act8) + intval($juniorSummaryFOWW->act9) + intval($juniorSummaryFOWW->act10)
                                                        + intval($juniorSummaryFOWW->act11) + intval($juniorSummaryFOWW->act12) + intval($juniorSummaryFOWW->act13) + intval($juniorSummaryFOWW->act14) + intval($juniorSummaryFOWW->act15);
                                                    // echo $firstWrittenWorksSummary;
                                                    $fourthWrittenWorksSummaryWs = $juniorSummaryFOWW->actWs; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($fourthWrittenWorksSummaryWs)) {
                                                    $fourthWrittenWorksSummaryWs = 0;
                                                    // echo $fourthWrittenWorksSummaryWs;
                                                } else {
                                                    // echo $fourthWrittenWorksSummaryWs;
                                                }  ?>

                                                <?php $fourthPerformanceTaskSummary = 0; ?>
                                                <?php foreach ($data['juniorSummaryFOPT'] as $juniorSummaryFOPT) : ?>
                                                    <?php $fourthPerformanceTaskSummary = intval($juniorSummaryFOPT->act1) + intval($juniorSummaryFOPT->act2) + intval($juniorSummaryFOPT->act3) + intval($juniorSummaryFOPT->act4) + intval($juniorSummaryFOPT->act5)
                                                        + intval($juniorSummaryFOPT->act6) + intval($juniorSummaryFOPT->act7) + intval($juniorSummaryFOPT->act8) + intval($juniorSummaryFOPT->act9) + intval($juniorSummaryFOPT->act10)
                                                        + intval($juniorSummaryFOPT->act11) + intval($juniorSummaryFOPT->act12) + intval($juniorSummaryFOPT->act13) + intval($juniorSummaryFOPT->act14) + intval($juniorSummaryFOPT->act15);
                                                    // echo $firstPerformanceTaskSummary;
                                                    $fourthPerformanceTaskSummaryWs = $juniorSummaryFOPT->actWs; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($fourthPerformanceTaskSummaryWs)) {
                                                    $fourthPerformanceTaskSummaryWs = 0;
                                                    // echo $fourthPerformanceTaskSummaryWs;
                                                } else {
                                                    // echo $fourthPerformanceTaskSummaryWs;
                                                }  ?>

                                                <?php $fourthQuarterlyAssessmentSummary = 0; ?>
                                                <?php foreach ($data['juniorSummaryFOQA'] as $juniorSummaryFOQA) : ?>
                                                    <?php $fourthQuarterlyAssessmentSummary = intval($juniorSummaryFOQA->act1) + intval($juniorSummaryFOQA->act2) + intval($juniorSummaryFOQA->act3) + intval($juniorSummaryFOQA->act4) + intval($juniorSummaryFOQA->act5)
                                                        + intval($juniorSummaryFOQA->act6) + intval($juniorSummaryFOQA->act7) + intval($juniorSummaryFOQA->act8) + intval($juniorSummaryFOQA->act9) + intval($juniorSummaryFOQA->act10)
                                                        + intval($juniorSummaryFOQA->act11) + intval($juniorSummaryFOQA->act12) + intval($juniorSummaryFOQA->act13) + intval($juniorSummaryFOQA->act14) + intval($juniorSummaryFOQA->act15);
                                                    // echo $firstQuarterlyAssessmentSummary;
                                                    $fourthQuarterlyAssessmentSummaryWs = $juniorSummaryFOQA->actWs; ?>
                                                <?php endforeach; ?>
                                                <?php if (empty($fourthQuarterlyAssessmentSummaryWs)) {
                                                    $fourthQuarterlyAssessmentSummaryWs = 0;
                                                    // echo $fourthQuarterlyAssessmentSummaryWs;
                                                } else {
                                                    // echo $fourthQuarterlyAssessmentSummaryWs;
                                                }  ?>




                                                <div id="outputJr">
                                                    <?php foreach ($data['studentInfo'] as $studentInfos) : ?>
                                                        <tr>
                                                            <td class="student_infoId">
                                                                <?php echo $studentInfos->studentInfoId; ?>
                                                            </td>
                                                            <td class="student_id">
                                                                <?php echo $studentInfos->studentId; ?>
                                                            </td>
                                                            <td data-label="Last Name" class="student_name">
                                                                <?php echo $studentInfos->last_name . ', ' . $studentInfos->first_name . ' ' . $studentInfos->middle_name; ?>
                                                            </td>

                                                            <td>

                                                            </td>
                                                            <!--1st quarter-->
                                                            <td data-label="1st Initial Grade" class="first_Ig">
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
                                                            <td data-label="1st Quarterly Grade" class="firstQurter">
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
                                                            <td data-label="2nd Initial Grade" class="sec_Ig">
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
                                                            <td data-label="2nd Quarterly Grade" class="secQuarter">
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
                                                            <td data-label="3rd Initial Grade" class="third_Ig">
                                                                <?php $thirdWrittenWorks = $studentInfos->third_ww_act1 + $studentInfos->third_ww_act2 + $studentInfos->third_ww_act3 + $studentInfos->third_ww_act4 + $studentInfos->third_ww_act5 +
                                                                    $studentInfos->third_ww_act6 + $studentInfos->third_ww_act7 + $studentInfos->third_ww_act8 + $studentInfos->third_ww_act9 + $studentInfos->third_ww_act10 +
                                                                    $studentInfos->third_ww_act11 + $studentInfos->third_ww_act12 + $studentInfos->third_ww_act13 + $studentInfos->third_ww_act14 + $studentInfos->third_ww_act15;
                                                                // echo $thirdWrittenWorks;
                                                                if ($thirdWrittenWorks === 0 && $thirdWrittenWorksSummary === 0) {
                                                                    $thirdTotalWrittenWorksRound = 0.00;
                                                                    // echo $thirdTotalWrittenWorksRound;
                                                                } else {
                                                                    $thirdTotalWrittenWorks = ($thirdWrittenWorks / $thirdWrittenWorksSummary) * $thirdWrittenWorksSummaryWs;
                                                                    $thirdTotalWrittenWorksRound = round($thirdTotalWrittenWorks, 2);
                                                                    // echo $thirdTotalWrittenWorksRound;
                                                                } ?>

                                                                <?php $thirdPerformanceTask = $studentInfos->third_pt_act1 + $studentInfos->third_pt_act2 + $studentInfos->third_pt_act3 + $studentInfos->third_pt_act4 + $studentInfos->third_pt_act5 +
                                                                    $studentInfos->third_pt_act6 + $studentInfos->third_pt_act7 + $studentInfos->third_pt_act8 + $studentInfos->third_pt_act9 + $studentInfos->third_pt_act10 +
                                                                    $studentInfos->third_pt_act11 + $studentInfos->third_pt_act12 + $studentInfos->third_pt_act13 + $studentInfos->third_pt_act14 + $studentInfos->third_pt_act15;
                                                                // echo $thirdPerformanceTask;
                                                                if ($thirdPerformanceTask === 0 && $thirdPerformanceTaskSummary === 0) {
                                                                    $thirdTotalPerformanceTaskRound = 0.00;
                                                                    // echo $thirdTotalPerformanceTaskRound;
                                                                } else {
                                                                    $thirdTotalPerformanceTask = ($thirdPerformanceTask / $thirdPerformanceTaskSummary) * $thirdPerformanceTaskSummaryWs;
                                                                    $thirdTotalPerformanceTaskRound = round($thirdTotalPerformanceTask, 2);
                                                                    // echo $thirdTotalPerformanceTaskRound;
                                                                } ?>

                                                                <?php $thirdQuarterlyAssessment = $studentInfos->third_qa_act1 + $studentInfos->third_qa_act2 + $studentInfos->third_qa_act3 + $studentInfos->third_qa_act4 + $studentInfos->third_qa_act5 +
                                                                    $studentInfos->third_qa_act6 + $studentInfos->third_qa_act7 + $studentInfos->third_qa_act8 + $studentInfos->third_qa_act9 + $studentInfos->third_qa_act10 +
                                                                    $studentInfos->third_qa_act11 + $studentInfos->third_qa_act12 + $studentInfos->third_qa_act13 + $studentInfos->third_qa_act14 + $studentInfos->third_qa_act15;
                                                                // echo $thirdQuarterlyAssessment;
                                                                if ($thirdQuarterlyAssessment === 0 && $thirdQuarterlyAssessmentSummary === 0) {
                                                                    $thirdTotalQuarterlyAssessmentRound = 0.00;
                                                                    // echo $thirdTotalQuarterlyAssessmentRound;
                                                                } else {
                                                                    $thirdQuarterlyAssessment = ($thirdQuarterlyAssessment / $thirdQuarterlyAssessmentSummary) * $thirdQuarterlyAssessmentSummaryWs;
                                                                    $thirdTotalQuarterlyAssessmentRound = round($thirdQuarterlyAssessment, 2);
                                                                    // echo $thirdTotalQuarterlyAssessmentRound;
                                                                } ?>

                                                                <?php $thirdInitialGradeSummary =  $thirdTotalWrittenWorksRound + $thirdTotalPerformanceTaskRound + $thirdTotalQuarterlyAssessmentRound;
                                                                // echo $thirdInitialGradeSummary; 
                                                                if (empty($thirdInitialGradeSummary)) {
                                                                    echo '';
                                                                } else {
                                                                    echo $thirdInitialGradeSummary;
                                                                } ?>
                                                            </td>
                                                            <td data-label="3rd Quarterly Grade" class="third_quarter">
                                                                <strong><?php $thirdQuarterlyGrade = transmuteGrade($thirdInitialGradeSummary);
                                                                        // echo $thirdQuarterlyGrade; 
                                                                        if (empty($thirdInitialGradeSummary)) {
                                                                            echo '';
                                                                        } else {
                                                                            echo $thirdQuarterlyGrade;
                                                                        } ?></strong>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <!--4th quarter-->
                                                            <td data-label="4th Initial Grade" class="fourth_Ig">
                                                                <?php $fourthWrittenWorks = $studentInfos->fourth_ww_act1 + $studentInfos->fourth_ww_act2 + $studentInfos->fourth_ww_act3 + $studentInfos->fourth_ww_act4 + $studentInfos->fourth_ww_act5 +
                                                                    $studentInfos->fourth_ww_act6 + $studentInfos->fourth_ww_act7 + $studentInfos->fourth_ww_act8 + $studentInfos->fourth_ww_act9 + $studentInfos->fourth_ww_act10 +
                                                                    $studentInfos->fourth_ww_act11 + $studentInfos->fourth_ww_act12 + $studentInfos->fourth_ww_act13 + $studentInfos->fourth_ww_act14 + $studentInfos->fourth_ww_act15;
                                                                // echo $fourthWrittenWorks;
                                                                if ($fourthWrittenWorks === 0 && $fourthWrittenWorksSummary === 0) {
                                                                    $fourthTotalWrittenWorksRound = 0.00;
                                                                    // echo $fourthTotalWrittenWorksRound;
                                                                } else {
                                                                    $fourthTotalWrittenWorks = ($fourthWrittenWorks / $fourthWrittenWorksSummary) * $fourthWrittenWorksSummaryWs;
                                                                    $fourthTotalWrittenWorksRound = round($fourthTotalWrittenWorks, 2);
                                                                    // echo $fourthTotalWrittenWorksRound;
                                                                } ?>

                                                                <?php $fourthPerformanceTask = $studentInfos->fourth_pt_act1 + $studentInfos->fourth_pt_act2 + $studentInfos->fourth_pt_act3 + $studentInfos->fourth_pt_act4 + $studentInfos->fourth_pt_act5 +
                                                                    $studentInfos->fourth_pt_act6 + $studentInfos->fourth_pt_act7 + $studentInfos->fourth_pt_act8 + $studentInfos->fourth_pt_act9 + $studentInfos->fourth_pt_act10 +
                                                                    $studentInfos->fourth_pt_act11 + $studentInfos->fourth_pt_act12 + $studentInfos->fourth_pt_act13 + $studentInfos->fourth_pt_act14 + $studentInfos->fourth_pt_act15;
                                                                // echo $fourthPerformanceTask;
                                                                if ($fourthPerformanceTask === 0 && $fourthPerformanceTaskSummary === 0) {
                                                                    $fourthTotalPerformanceTaskRound = 0.00;
                                                                    // echo $fourthTotalPerformanceTaskRound;
                                                                } else {
                                                                    $fourthTotalPerformanceTask = ($fourthPerformanceTask / $fourthPerformanceTaskSummary) * $fourthPerformanceTaskSummaryWs;
                                                                    $fourthTotalPerformanceTaskRound = round($fourthTotalPerformanceTask, 2);
                                                                    // echo $fourthTotalPerformanceTaskRound;
                                                                } ?>

                                                                <?php $fourthQuarterlyAssessment = $studentInfos->fourth_qa_act1 + $studentInfos->fourth_qa_act2 + $studentInfos->fourth_qa_act3 + $studentInfos->fourth_qa_act4 + $studentInfos->fourth_qa_act5 +
                                                                    $studentInfos->fourth_qa_act6 + $studentInfos->fourth_qa_act7 + $studentInfos->fourth_qa_act8 + $studentInfos->fourth_qa_act9 + $studentInfos->fourth_qa_act10 +
                                                                    $studentInfos->fourth_qa_act11 + $studentInfos->fourth_qa_act12 + $studentInfos->fourth_qa_act13 + $studentInfos->fourth_qa_act14 + $studentInfos->fourth_qa_act15;
                                                                // echo $fourthQuarterlyAssessment;
                                                                if ($fourthQuarterlyAssessment === 0 && $fourthQuarterlyAssessmentSummary === 0) {
                                                                    $fourthTotalQuarterlyAssessmentRound = 0.00;
                                                                    // echo $fourthTotalQuarterlyAssessmentRound;
                                                                } else {
                                                                    $fourthQuarterlyAssessment = ($fourthQuarterlyAssessment / $fourthQuarterlyAssessmentSummary) * $fourthQuarterlyAssessmentSummaryWs;
                                                                    $fourthTotalQuarterlyAssessmentRound = round($fourthQuarterlyAssessment, 2);
                                                                    // echo $fourthTotalQuarterlyAssessmentRound;
                                                                } ?>

                                                                <?php $fourthInitialGradeSummary =  $fourthTotalWrittenWorksRound + $fourthTotalPerformanceTaskRound + $fourthTotalQuarterlyAssessmentRound;
                                                                // echo $fourthInitialGradeSummary; 
                                                                if (empty($fourthInitialGradeSummary)) {
                                                                    echo '';
                                                                } else {
                                                                    echo $fourthInitialGradeSummary;
                                                                } ?>
                                                            </td>
                                                            <td data-label="4th Quarterly Grade" class="fourth_quarter">
                                                                <strong><?php $fourthQuarterlyGrade = transmuteGrade($fourthInitialGradeSummary);
                                                                        // echo $fourthQuarterlyGrade;
                                                                        if (empty($fourthInitialGradeSummary)) {
                                                                            echo '';
                                                                        } else {
                                                                            echo $fourthQuarterlyGrade;
                                                                        } ?></strong>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <td data-label="Final Grade" class="final_grade">
                                                                <?php $roundFinal = 0; ?>
                                                                <strong><?php $juniorFinalGrade = ($firstQuarterlyGrade + $secondQuarterlyGrade + $thirdQuarterlyGrade + $fourthQuarterlyGrade) / 4;
                                                                        if (empty($firstInitialGradeSummary) || empty($secondInitialGradeSummary) || empty($thirdInitialGradeSummary) || empty($fourthInitialGradeSummary)) {
                                                                            echo '';
                                                                        } else {
                                                                            $roundFinal = round($juniorFinalGrade);
                                                                            echo $roundFinal;
                                                                        } ?></strong>
                                                            </td>
                                                            <td class="<?php $gradeRemarks = finalGradeRemarks($roundFinal);
                                                                        if ($gradeRemarks === 'FAILED') {
                                                                            echo 'failedRed';
                                                                        }  ?> grade_remarks" data-label="Remarks">
                                                                <strong><?php $gradeRemarks = finalGradeRemarks($roundFinal);
                                                                        if (empty($firstInitialGradeSummary) || empty($secondInitialGradeSummary) || empty($thirdInitialGradeSummary) || empty($fourthInitialGradeSummary)) {
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
                                                                                                                                                                                                    echo 'Submit 2';
                                                                                                                                                                                                } elseif ($data['finalGradeStep'] === 'submit3') {
                                                                                                                                                                                                    echo 'Submit 3';
                                                                                                                                                                                                } elseif ($data['finalGradeStep'] === 'submit4') {
                                                                                                                                                                                                    echo 'Submit Final';
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo 'Submitted';
                                                                                                                                                                                                } ?>
                                                </button>
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

<div class="modal" tabindex="-1" id="dateShown" role="dialog">
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
                    <input type="date" class="form-control confirmDate">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelSubmit" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirmDates">Confirm</button>
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

<div class="modal" tabindex="-1" id="dateShown3" role="dialog">
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
                    <input type="date" class="form-control confirmDate3">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelSubmit" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirmDates3">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="dateShown4" role="dialog">
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
                    <input type="date" class="form-control confirmDate4">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelSubmit" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirmDates4">Confirm</button>
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

<div class="modal" tabindex="-1" id="confirmModalsjr" role="dialog">
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
                <button type="button" class="btn btn-primary saveGrade">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="confirmModalsjr2" role="dialog">
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

<div class="modal" tabindex="-1" id="confirmModalsjr3" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Grades 3rd Quarter</h5>
                <button type="button" class="close cancelSubmit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelSubmit" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveGrade3">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="confirmModalsjr4" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Grades 4th Quarter</h5>
                <button type="button" class="close cancelSubmit" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelSubmit" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveGrade4">Submit</button>
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
<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
    $(document).ready(function() {

        $('.submit1').click(function() {

            var submittedInfos = {
                studentInfoId: [],
                studentId: [],
                firstIg: [],
                firstQg: [],
                studentName: []
            };

            $('.firstQurter').each(function() {
                submittedInfos.firstQg.push($(this).text());
            });

            $('.first_Ig').each(function() {
                submittedInfos.firstIg.push($(this).text());
            });

            $('.student_infoId').each(function() {
                submittedInfos.studentInfoId.push($(this).text());
            });

            $('.student_id').each(function() {
                submittedInfos.studentId.push($(this).text());
            });

            $('.student_name').each(function() {
                submittedInfos.studentName.push($(this).text());
            });

            if (checkIfBlank(submittedInfos)) {
                $('#dateShown').toggle();

                $('.confirmDates').click(function() {
                    var assignDate = $('.confirmDate').val();


                    if (assignDate === '') {
                        alert('Please select date of grade showing');
                    } else {
                        $('#dateShown').hide();
                        $('#confirmModalsjr').toggle();

                        $('.saveGrade').click(function() {
                            var subjectName = '<?php echo $data['subjectName'] ?>';
                            var subjectDescription = '<?php echo $data['description'] ?>';
                            var subjectYearLevel = '<?php echo $data['subjectGrade'] ?>';

                            var subjectId = '<?php echo $data['subjectId'] ?>';

                            $.ajax({
                                url: '<?php echo URLROOT ?>' + '/Actions/submitJuniorGrade',
                                method: 'post',
                                data: {
                                    submittedInfos: submittedInfos,
                                    subjectName: subjectName,
                                    subjectDescription: subjectDescription,
                                    subjectYearLevel: subjectYearLevel,
                                    subjectId: subjectId,
                                    assignDate: assignDate

                                },
                                success: function(response) {

                                    $('#confirmModalsjr').hide();
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

            var submittedInfos = {
                studentInfoId: [],
                studentId: [],
                firstQg: [],
                firstIg: [],
                studentName: []
            };

            $('.secQuarter').each(function() {
                submittedInfos.firstQg.push($(this).text());
            });

            $('.sec_Ig').each(function() {
                submittedInfos.firstIg.push($(this).text());
            });

            $('.student_infoId').each(function() {
                submittedInfos.studentInfoId.push($(this).text());
            });

            $('.student_id').each(function() {
                submittedInfos.studentId.push($(this).text());
            });

            $('.student_name').each(function() {
                submittedInfos.studentName.push($(this).text());
            });

            if (checkIfBlank(submittedInfos)) {
                $('#dateShown2').toggle();

                $('.confirmDates2').click(function() {
                    var assignDate = $('.confirmDate2').val();


                    if (assignDate === '') {
                        alert('Please select date of grade showing');
                    } else {
                        $('#dateShown2').hide();
                        $('#confirmModalsjr2').toggle();

                        $('.saveGrade2').click(function() {
                            var subjectName = '<?php echo $data['subjectName'] ?>';
                            var subjectDescription = '<?php echo $data['description'] ?>';
                            var subjectYearLevel = '<?php echo $data['subjectGrade'] ?>';

                            var subjectId = '<?php echo $data['subjectId'] ?>';

                            $.ajax({
                                url: '<?php echo URLROOT ?>' + '/Actions/submitJuniorGrade2',
                                method: 'post',
                                data: {
                                    submittedInfos: submittedInfos,
                                    subjectName: subjectName,
                                    subjectDescription: subjectDescription,
                                    subjectYearLevel: subjectYearLevel,
                                    subjectId: subjectId,
                                    assignDate: assignDate

                                },
                                success: function(response) {

                                    $('#confirmModalsjr2').hide();
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


        $('.submit3').click(function() {

            var submittedInfos = {
                studentInfoId: [],
                studentId: [],
                firstQg: [],
                firstIg: [],
                studentName: []
            };

            $('.third_quarter').each(function() {
                submittedInfos.firstQg.push($(this).text());
            });

            $('.third_Ig').each(function() {
                submittedInfos.firstIg.push($(this).text());
            });

            $('.student_infoId').each(function() {
                submittedInfos.studentInfoId.push($(this).text());
            });

            $('.student_id').each(function() {
                submittedInfos.studentId.push($(this).text());
            });

            $('.student_name').each(function() {
                submittedInfos.studentName.push($(this).text());
            });

            if (checkIfBlank(submittedInfos)) {
                $('#dateShown3').toggle();

                $('.confirmDates3').click(function() {
                    var assignDate = $('.confirmDate3').val();


                    if (assignDate === '') {
                        alert('Please select date of grade showing');
                    } else {
                        $('#dateShown3').hide();
                        $('#confirmModalsjr3').toggle();

                        $('.saveGrade3').click(function() {
                            var subjectName = '<?php echo $data['subjectName'] ?>';
                            var subjectDescription = '<?php echo $data['description'] ?>';
                            var subjectYearLevel = '<?php echo $data['subjectGrade'] ?>';

                            var subjectId = '<?php echo $data['subjectId'] ?>';

                            $.ajax({
                                url: '<?php echo URLROOT ?>' + '/Actions/submitJuniorGrade3',
                                method: 'post',
                                data: {
                                    submittedInfos: submittedInfos,
                                    subjectName: subjectName,
                                    subjectDescription: subjectDescription,
                                    subjectYearLevel: subjectYearLevel,
                                    subjectId: subjectId,
                                    assignDate: assignDate

                                },
                                success: function(response) {

                                    $('#confirmModalsjr3').hide();
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


        $('.submit4').click(function() {

            var submittedInfos = {
                studentInfoId: [],
                studentId: [],
                fourthQg: [],
                fourthIg: [],
                studentName: [],
                finalGrade: [],
                gradeRemarks: []
            };

            $('.fourth_quarter').each(function() {
                submittedInfos.fourthQg.push($(this).text());
            });

            $('.fourth_Ig').each(function() {
                submittedInfos.fourthIg.push($(this).text());
            });

            $('.student_infoId').each(function() {
                submittedInfos.studentInfoId.push($(this).text());
            });

            $('.student_id').each(function() {
                submittedInfos.studentId.push($(this).text());
            });

            $('.student_name').each(function() {
                submittedInfos.studentName.push($(this).text());
            });

            $('.final_grade').each(function() {
                submittedInfos.finalGrade.push($(this).text());
            });

            $('.grade_remarks').each(function() {
                submittedInfos.gradeRemarks.push($(this).text());
            });

            if (checkIfBlank4(submittedInfos)) {
                $('#dateShown4').toggle();

                $('.confirmDates4').click(function() {
                    var assignDate = $('.confirmDate4').val();


                    if (assignDate === '') {
                        alert('Please select date of grade showing');
                    } else {
                        $('#dateShown4').hide();
                        $('#confirmModalsjr4').toggle();

                        $('.saveGrade4').click(function() {
                            var subjectName = '<?php echo $data['subjectName'] ?>';
                            var subjectDescription = '<?php echo $data['description'] ?>';
                            var subjectYearLevel = '<?php echo $data['subjectGrade'] ?>';

                            var subjectId = '<?php echo $data['subjectId'] ?>';

                            $.ajax({
                                url: '<?php echo URLROOT ?>' + '/Actions/submitJuniorGrade4',
                                method: 'post',
                                data: {
                                    submittedInfos: submittedInfos,
                                    subjectName: subjectName,
                                    subjectDescription: subjectDescription,
                                    subjectYearLevel: subjectYearLevel,
                                    subjectId: subjectId,
                                    assignDate: assignDate

                                },
                                success: function(response) {

                                    $('#confirmModalsjr3').hide();
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
                            url: '<?php echo URLROOT ?>' + '/Actions/updateSubmitGrade',
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

            for (var key in items.firstQg) {
                var remarks = $.trim(items.firstQg[key]);
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

        function checkIfBlank4(items) {
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