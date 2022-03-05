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
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/senior_records" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-address-card text-light fa-lg mr-3"></i>Senior</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/student_records" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="far fa-folder text-light fa-lg mr-3"></i>Records</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/student_offline" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-list-ul text-light fa-lg mr-3"></i>Register</a></li>';
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
                                    <h4>Form 137</h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">

                                            <li class="breadcrumb-item ml-lg-auto"> <a class="text-danger" href="<?php echo URLROOT; ?>/registrars/senior_records">Student List</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">137</li>
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
                        <div class="printable" id="printable">
                            <div class="row mt-5 justify-content-center">
                                <img src="<?php echo URLROOT; ?>/images/tcclogo.png" width="80px" height="80px" alt="">
                                <div class="pl-2 pr-2">
                                    <h5 class="mt-3">TOMAS CALUDIO COLLEGES</h5>
                                    <h7 class="ml-4">Taghangin Morong, Rizal</h7>
                                </div>
                            </div>
                            <div class="row mt-4 justify-content-center">
                                <h5 class=""><strong>Basic Education Department</strong></h5>
                            </div>
                            <div class="row mb-5 justify-content-center">
                                <h6 class=""><strong>Senior High School</strong></h6>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ml-lg-5 ml-2">
                                    <h5><strong>Name:</strong> <?php echo $data['studentName']; ?></h5>
                                </div>
                                <div class="col-md-3 ml-lg-5 ml-2">
                                    <h5><strong>Date of Birth:</strong> <?php echo $data['birthdate']; ?></h5>
                                </div>
                                <div class="col-md-3 ml-lg-5 ml-2">
                                    <h5><strong>Place of Birth:</strong> <?php echo $data['birthPlace']; ?></h5>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4 ml-lg-5 ml-2">

                                    <h5><strong>Address:</strong> <?php echo $data['address']; ?></h5>
                                </div>
                                <div class="col-md-3 ml-lg-5 ml-2">
                                    <h5><strong>Gender:</strong> <?php if ($data['gender'] === 'M') {
                                                                        echo 'Male';
                                                                    } else {
                                                                        echo 'Female';
                                                                    } ?></h5>
                                </div>
                                <div class="col-md-3  ml-lg-5 ml-2">

                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-10 ml-lg-5 ml-2">
                                    <h5><strong>Strand:</strong> <?php echo $data['progCode'] . ' - ' . $data['program']; ?></h5>
                                </div>
                            </div>

                            <div class="row mx-2 mt-5">
                                <div class="col-md-5">
                                    <h5><strong>Grade 11 - Shool:</strong> <?php echo $data['schoolName11']; ?></h5>

                                </div>
                                <div class="col-md-4">
                                    <h5><strong>School Year:</strong> <?php echo $data['schoolYear11']; ?></h5>
                                </div>
                                <div class="col-md-3">
                                    <h5><strong>Semester:</strong>
                                        <?php if ($data['term11'] == 1) {
                                            echo 'First';
                                        } elseif ($data['term11'] == 2) {
                                            echo 'Second';
                                        } else {
                                            echo 'Summer';
                                        } ?>
                                    </h5>
                                </div>
                                <div class="table-responsive mb-2 mt-2">
                                    <table class="tablesgrade">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Learning Area</th>
                                                <th colspan="2">Periodic Rating</th>
                                                <th rowspan="2" width="10%">Final Avg</th>
                                            </tr>
                                            <tr>
                                                <th width="10%">1</th>
                                                <th width="10%">2</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($data['senior11']) && !empty($data['senior11App'])) : ?>

                                                <tr>
                                                    <td colspan="4"><strong><i>Core Subjects</i></strong></td>
                                                </tr>
                                                <?php $seniorCount11 = 0;
                                                $senior11Avg = 0;
                                                $senior11WeightedAvg = 0; ?>
                                                <?php foreach ($data['senior11'] as $subjectList) : ?>
                                                    <tr>
                                                        <td data-label="Learning Area">
                                                            <?php echo  $subjectList->sDes; ?>
                                                        </td>
                                                        <td data-label="1">
                                                            <?php echo $subjectList->fqg; ?>
                                                        </td>
                                                        <td data-label="2">
                                                            <?php echo $subjectList->sqg; ?>
                                                        </td>
                                                        <td data-label="Avg">
                                                            <?php echo $subjectList->final_grade; ?>
                                                        </td>
                                                    </tr>
                                                    <?php $seniorCount11 = $seniorCount11 + 1;
                                                    $senior11Avg = $senior11Avg + $subjectList->final_grade; ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="4"><strong><i>Applied and Specialized Subjects</i></strong></td>
                                                </tr>
                                                <?php foreach ($data['senior11App'] as $subjectList) : ?>
                                                    <tr>
                                                        <td data-label="Learning Area">
                                                            <?php echo  $subjectList->sDes; ?>
                                                        </td>
                                                        <td data-label="1">
                                                            <?php echo $subjectList->fqg; ?>
                                                        </td>
                                                        <td data-label="2">
                                                            <?php echo $subjectList->sqg; ?>
                                                        </td>
                                                        <td data-label="Avg">
                                                            <?php echo $subjectList->final_grade; ?>
                                                        </td>
                                                    </tr>
                                                    <?php $seniorCount11 = $seniorCount11 + 1;
                                                    $senior11Avg = $senior11Avg + $subjectList->final_grade; ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="3">
                                                        <h7><strong>General Semester Average</strong></h7>
                                                    </td>
                                                    <td>
                                                        <h7><strong><?php $senior11WeightedAvg = round($senior11Avg / $seniorCount11, 2);
                                                                    echo $senior11WeightedAvg;
                                                                    ?></strong></h7>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                    <?php if (empty($data['senior11']) && empty($data['senior11App'])) : ?>
                                        <div class="mt-2">
                                            <h3>No Preview Available</h3>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mx-2 mt-5">
                                <div class="col-md-5">
                                    <h5><strong>Grade 11 - Shool:</strong> <?php echo $data['schoolName12']; ?></h5>

                                </div>
                                <div class="col-md-4">
                                    <h5><strong>School Year:</strong> <?php echo $data['schoolYear12']; ?></h5>
                                </div>
                                <div class="col-md-3">
                                    <h5><strong>Semester:</strong>
                                        <?php if ($data['term12'] == 1) {
                                            echo 'First';
                                        } elseif ($data['term12'] == 2) {
                                            echo 'Second';
                                        } else {
                                            echo 'Summer';
                                        } ?>
                                    </h5>
                                </div>
                                <div class="table-responsive mb-5 mt-2">
                                    <table class="tablesgrade">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Learning Area</th>
                                                <th colspan="2">Periodic Rating</th>
                                                <th rowspan="2" width="10%">Final Avg</th>
                                            </tr>
                                            <tr>
                                                <th width="10%">3</th>
                                                <th width="10%">4</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($data['senior12']) && !empty($data['senior12App'])) : ?>
                                                <?php $seniorCount12 = 0;
                                                $senior12Avg = 0;
                                                $senior12WeightedAvg = 0; ?>
                                                <tr>
                                                    <td colspan="4"><strong><i>Core Subjects</i></strong></td>
                                                </tr>
                                                <?php foreach ($data['senior12'] as $subjectList) : ?>
                                                    <tr>
                                                        <td data-label="Learning Area">
                                                            <?php echo  $subjectList->sDes; ?>
                                                        </td>
                                                        <td data-label="1">
                                                            <?php echo $subjectList->fqg; ?>
                                                        </td>
                                                        <td data-label="2">
                                                            <?php echo $subjectList->sqg; ?>
                                                        </td>
                                                        <td data-label="Avg">
                                                            <?php echo $subjectList->final_grade; ?>
                                                        </td>
                                                    </tr>
                                                    <?php $seniorCount12 = $seniorCount12 + 1;
                                                    $senior12Avg = $senior12Avg + $subjectList->final_grade; ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="4"><strong><i>Applied and Specialized Subjects</i></strong></td>
                                                </tr>
                                                <?php foreach ($data['senior12App'] as $subjectList) : ?>
                                                    <tr>
                                                        <td data-label="Learning Area">
                                                            <?php echo  $subjectList->sDes; ?>
                                                        </td>
                                                        <td data-label="1">
                                                            <?php echo $subjectList->fqg; ?>
                                                        </td>
                                                        <td data-label="2">
                                                            <?php echo $subjectList->sqg; ?>
                                                        </td>
                                                        <td data-label="Avg">
                                                            <?php echo $subjectList->final_grade; ?>
                                                        </td>
                                                    </tr>
                                                    <?php $seniorCount12 = $seniorCount12 + 1;
                                                    $senior12Avg = $senior12Avg + $subjectList->final_grade; ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="3">
                                                        <h7><strong>General Semester Average</strong></h7>
                                                    </td>
                                                    <td>
                                                        <h7><strong><?php $senior12WeightedAvg = round($senior12Avg / $seniorCount12, 2);
                                                                    echo $senior12WeightedAvg;
                                                                    ?></strong></h7>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                    <?php if (empty($data['senior12']) && empty($data['senior12App'])) : ?>
                                        <div class="mt-2">
                                            <h3>No Preview Available</h3>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="table-responsive mb-2">
                                    <table class="tablesgrade">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3"><strong>General Weighted Average</strong></td>
                                                <td width="10%" data-label="Gen Avg"><strong><?php echo round(($senior11WeightedAvg + $senior12WeightedAvg) / 2); ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-none d-print-block">
                                <div class="row mt-2 mt-5 justify-content-center pageBreak">
                                    <img src="<?php echo URLROOT; ?>/images/tcclogo.png" width="80px" height="80px" alt="">
                                    <div class="pl-2 pr-2">
                                        <h5 class="mt-3">TOMAS CALUDIO COLLEGES</h5>
                                        <h7 class="ml-4">Taghangin Morong, Rizal</h7>
                                    </div>
                                </div>
                                <div class="row mt-4 justify-content-center">
                                    <h5 class=""><strong>Basic Education Department</strong></h5>
                                </div>
                                <div class="row mb-5 justify-content-center">
                                    <h6 class=""><strong>Senior High School</strong></h6>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 ml-lg-5 ml-2">
                                        <h5><strong>Name:</strong> <?php echo $data['studentName']; ?></h5>
                                    </div>
                                    <div class="col-md-3 ml-lg-5 ml-2">
                                        <h5><strong>Date of Birth:</strong> <?php echo $data['birthdate']; ?></h5>
                                    </div>
                                    <div class="col-md-3 ml-lg-5 ml-2">
                                        <h5><strong>Place of Birth:</strong> <?php echo $data['birthPlace']; ?></h5>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4 ml-lg-5 ml-2">

                                        <h5><strong>Address:</strong> <?php echo $data['address']; ?></h5>
                                    </div>
                                    <div class="col-md-3 ml-lg-5 ml-2">
                                        <h5><strong>Gender:</strong> <?php if ($data['gender'] === 'M') {
                                                                            echo 'Male';
                                                                        } else {
                                                                            echo 'Female';
                                                                        } ?></h5>
                                    </div>
                                    <div class="col-md-3  ml-lg-5 ml-2">

                                    </div>

                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-10 ml-lg-5 ml-2">
                                        <h5><strong>Strand:</strong> <?php echo $data['progCode'] . ' - ' . $data['program']; ?></h5>
                                    </div>
                                </div>

                            </div>
                            <div class="row mx-2 mt-5">
                                <div class="col-md-5">
                                    <h5><strong>Grade 11 - Shool:</strong> <?php echo $data['schoolName21']; ?></h5>

                                </div>
                                <div class="col-md-4">
                                    <h5><strong>School Year:</strong> <?php echo $data['schoolYear21']; ?></h5>
                                </div>
                                <div class="col-md-3">
                                    <h5><strong>Semester:</strong>
                                        <?php if ($data['term21'] == 1) {
                                            echo 'First';
                                        } elseif ($data['term21'] == 2) {
                                            echo 'Second';
                                        } else {
                                            echo '';
                                        } ?>
                                    </h5>
                                </div>
                                <div class="table-responsive mb-2 mt-2">
                                    <table class="tablesgrade">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Learning Area</th>
                                                <th colspan="2">Periodic Rating</th>
                                                <th rowspan="2" width="10%">Final Avg</th>
                                            </tr>
                                            <tr>
                                                <th width="10%">1</th>
                                                <th width="10%">2</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($data['senior21']) && !empty($data['senior21App'])) : ?>

                                                <tr>
                                                    <td colspan="4"><strong><i>Core Subjects</i></strong></td>
                                                </tr>
                                                <?php $seniorCount21 = 0;
                                                $senior21Avg = 0;
                                                $senior21WeightedAvg = 0; ?>
                                                <?php foreach ($data['senior21'] as $subjectList) : ?>
                                                    <tr>
                                                        <td data-label="Learning Area">
                                                            <?php echo  $subjectList->sDes; ?>
                                                        </td>
                                                        <td data-label="1">
                                                            <?php echo $subjectList->fqg; ?>
                                                        </td>
                                                        <td data-label="2">
                                                            <?php echo $subjectList->sqg; ?>
                                                        </td>
                                                        <td data-label="Avg">
                                                            <?php echo $subjectList->final_grade; ?>
                                                        </td>
                                                    </tr>
                                                    <?php $seniorCount21 = $seniorCount21 + 1;
                                                    $senior21Avg = $senior21Avg + $subjectList->final_grade; ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="4"><strong><i>Applied and Specialized Subjects</i></strong></td>
                                                </tr>
                                                <?php foreach ($data['senior21App'] as $subjectList) : ?>
                                                    <tr>
                                                        <td data-label="Learning Area">
                                                            <?php echo  $subjectList->sDes; ?>
                                                        </td>
                                                        <td data-label="1">
                                                            <?php echo $subjectList->fqg; ?>
                                                        </td>
                                                        <td data-label="2">
                                                            <?php echo $subjectList->sqg; ?>
                                                        </td>
                                                        <td data-label="Avg">
                                                            <?php echo $subjectList->final_grade; ?>
                                                        </td>
                                                    </tr>
                                                    <?php $seniorCount21 = $seniorCount21 + 1;
                                                    $senior21Avg = $senior21Avg + $subjectList->final_grade; ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="3">
                                                        <h7><strong>General Semester Average</strong></h7>
                                                    </td>
                                                    <td>
                                                        <h7><strong><?php $senior21WeightedAvg = round($senior21Avg / $seniorCount21, 2);
                                                                    echo $senior21WeightedAvg;
                                                                    ?></strong></h7>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                    <?php if (empty($data['senior21']) && empty($data['senior21App'])) : ?>
                                        <div class="mt-2">
                                            <h3>No Preview Available</h3>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mx-2 mt-5">
                                <div class="col-md-5">
                                    <h5><strong>Grade 11 - Shool:</strong> <?php echo $data['schoolName22']; ?></h5>

                                </div>
                                <div class="col-md-4">
                                    <h5><strong>School Year:</strong> <?php echo $data['schoolYear22']; ?></h5>
                                </div>
                                <div class="col-md-3">
                                    <h5><strong>Semester:</strong>
                                        <?php if ($data['term22'] == 1) {
                                            echo 'First';
                                        } elseif ($data['term22'] == 2) {
                                            echo 'Second';
                                        } else {
                                            echo '';
                                        } ?>
                                    </h5>
                                </div>
                                <div class="table-responsive mb-5 mt-2">
                                    <table class="tablesgrade">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Learning Area</th>
                                                <th colspan="2">Periodic Rating</th>
                                                <th rowspan="2" width="10%">Final Avg</th>
                                            </tr>
                                            <tr>
                                                <th width="10%">3</th>
                                                <th width="10%">4</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($data['senior22']) && !empty($data['senior22App'])) : ?>
                                                <?php $seniorCount22 = 0;
                                                $senior22Avg = 0;
                                                $senior22WeightedAvg = 0; ?>
                                                <tr>
                                                    <td colspan="4"><strong><i>Core Subjects</i></strong></td>
                                                </tr>
                                                <?php foreach ($data['senior22'] as $subjectList) : ?>
                                                    <tr>
                                                        <td data-label="Learning Area">
                                                            <?php echo  $subjectList->sDes; ?>
                                                        </td>
                                                        <td data-label="1">
                                                            <?php echo $subjectList->fqg; ?>
                                                        </td>
                                                        <td data-label="2">
                                                            <?php echo $subjectList->sqg; ?>
                                                        </td>
                                                        <td data-label="Avg">
                                                            <?php echo $subjectList->final_grade; ?>
                                                        </td>
                                                    </tr>
                                                    <?php $seniorCount22 = $seniorCount22 + 1;
                                                    $senior22Avg = $senior22Avg + $subjectList->final_grade; ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="4"><strong><i>Applied and Specialized Subjects</i></strong></td>
                                                </tr>
                                                <?php foreach ($data['senior22App'] as $subjectList) : ?>
                                                    <tr>
                                                        <td data-label="Learning Area">
                                                            <?php echo  $subjectList->sDes; ?>
                                                        </td>
                                                        <td data-label="1">
                                                            <?php echo $subjectList->fqg; ?>
                                                        </td>
                                                        <td data-label="2">
                                                            <?php echo $subjectList->sqg; ?>
                                                        </td>
                                                        <td data-label="Avg">
                                                            <?php echo $subjectList->final_grade; ?>
                                                        </td>
                                                    </tr>
                                                    <?php $seniorCount22 = $seniorCount22 + 1;
                                                    $senior22Avg = $senior22Avg + $subjectList->final_grade; ?>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="3">
                                                        <h7><strong>General Semester Average</strong></h7>
                                                    </td>
                                                    <td>
                                                        <h7><strong><?php $senior22WeightedAvg = round($senior22Avg / $seniorCount22, 2);
                                                                    echo $senior22WeightedAvg;
                                                                    ?></strong></h7>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                    <?php if (empty($data['senior22']) && empty($data['senior22App'])) : ?>
                                        <div class="mt-2">
                                            <h3>No Preview Available</h3>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="table-responsive mb-2">
                                    <table class="tablesgrade">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3"><strong>General Weighted Average</strong></td>
                                                <td width="10%" data-label="Gen Avg"><strong><?php echo round(($senior21WeightedAvg + $senior22WeightedAvg) / 2); ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
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


<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
    $(document).ready(function() {
        $('#prints').click(function() {


            window.print();



        });



    });
</script>