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
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/grade_submissions" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-share-square text-light fa-lg mr-3"></i>Submission</a></li>';
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
            <div class="row">
                <div class="col-12 mx-auto">
                    <!--navigation-->
                    <div class="card pl-0 pr-0 mt-3">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4><?php echo $data['subjectName']; ?></h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">
                                            <li class="breadcrumb-item ml-lg-auto"><a class="text-danger" href="<?php echo URLROOT; ?>/registrars/grade_submissions">Level</a></li>
                                            <li class="breadcrumb-item"><a class="text-danger" href="<?php echo URLROOT; ?>/registrars/Senior_submission">Subject List</a></li>
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
                    <div class="card pl-0 pr-0 mt-1">
                        <?php if (!empty($data['studentInfo'])) : ?>
                            <div class="card-header bg-success">
                                <div class="btn-group btn-group-toggle flex-wrap" data-toggle="buttons">
                                    <label class="btn btn-success active radio_gradeSource rg1" data-radio="written works">
                                        <input type="radio" name="options" id="option1" value="Written Works" autocomplete="off" checked>Written Works
                                    </label>
                                    <label class="btn btn-success radio_gradeSource rg2" data-radio="performance task">
                                        <input type="radio" name="options" id="option2" value="Performance Task" autocomplete="off">Performance Task
                                    </label>
                                    <label class="btn btn-success radio_gradeSource rg3" data-radio="quarterly assessment">
                                        <input type="radio" name="options" id="option3" value="Quarterly Assessment" autocomplete="off">Quarterly Assessment
                                    </label>
                                </div>


                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-lg-8">
                                        <form class="form-inline">
                                            <div class="form-group mb-2">
                                                <label for="inputPassword2" class="sr-only">Search</label>
                                                <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-4">

                                    </div><!-- end col-->
                                </div>


                                <div class="table-responsive">
                                    <div id="outputJr">
                                        <table class="tablesgrade" id="jrTable">
                                            <thead>
                                                <tr>
                                                    <th>Full Name</th>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>6</th>
                                                    <th>7</th>
                                                    <th>8</th>
                                                    <th>9</th>
                                                    <th>10</th>
                                                    <th>11</th>
                                                    <th>12</th>
                                                    <th>13</th>
                                                    <th>14</th>
                                                    <th>15</th>
                                                    <th>Total</th>
                                                    <th>PS</th>
                                                    <th>WS</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="gradesHigh">
                                                        <strong>Highest Posible Grade</strong>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="1" data-id=" <?php echo 0; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act1Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act1Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act1; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="2" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act2Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act2Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act2; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="3" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act3Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act3Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act3; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="4" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act4Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act4Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act4; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="5" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act5Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act5Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act5; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="6" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act6Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act6Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act6; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="7" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act7Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act7Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act7; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="8" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act8Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act8Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act8; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="9" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act9Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act9Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act9; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="10" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act10Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act10Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act10; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="11" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act11Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act11Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act11; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="12" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act12Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act2Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act12; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="13" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act13Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act13Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act13; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="14" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act14Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act14Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act14; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="shs" data-row="1" data-column="15" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act15Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act15Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act15; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td>
                                                        <?php $actToatalJr = 0; ?>
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <?php $actToatalJr = $highJr->act1 + $highJr->act2 + $highJr->act3 + $highJr->act4 + $highJr->act5 + $highJr->act6 + $highJr->act7 +
                                                                $highJr->act8 + $highJr->act9 + $highJr->act10 + $highJr->act11 + $highJr->act12 + $highJr->act13 + $highJr->act14 + $highJr->act15; ?>
                                                        <?php endforeach; ?>
                                                        <strong><?php echo $actToatalJr;

                                                                ?></strong>
                                                    </td>
                                                    <td>
                                                        <strong><?php $ps = 100;
                                                                echo $ps . '.00'; ?></strong>
                                                    </td>
                                                    <td class="shsWs" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->actWs; ?><?php endforeach; ?>" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_s_h_ids_id; ?><?php endforeach; ?>">
                                                        <?php $ws = 0; ?>
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php $ws = $highJr->actWs; ?><?php endforeach; ?>
                                                        <strong><?php echo $ws . '%'; ?></strong>
                                                    </td>

                                                </tr>


                                                <div id="outputJr">
                                                    <?php foreach ($data['studentInfo'] as $studentInfos) : ?>
                                                        <tr>
                                                            <td data-label="Last Name">
                                                                <?php echo $studentInfos->lname . ', ' . $studentInfos->fname . ' ' . $studentInfos->mname; ?>
                                                            </td>
                                                            <td data-label="1">
                                                                <?php if ($studentInfos->act_1 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_1; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="2">
                                                                <?php if ($studentInfos->act_2 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_2; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="3">
                                                                <?php if ($studentInfos->act_3 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_3; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="4">
                                                                <?php if ($studentInfos->act_4 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_4; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="5">
                                                                <?php if ($studentInfos->act_5 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_5; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="6">
                                                                <?php if ($studentInfos->act_6 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_6; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="7">
                                                                <?php if ($studentInfos->act_7 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_7; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="8">
                                                                <?php if ($studentInfos->act_8 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_8; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="9">
                                                                <?php if ($studentInfos->act_9 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_9; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="10">
                                                                <?php if ($studentInfos->act_10 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_10; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="11">
                                                                <?php if ($studentInfos->act_11 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_11; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="12">
                                                                <?php if ($studentInfos->act_12 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_12; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="13">
                                                                <?php if ($studentInfos->act_13 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_13; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="14">
                                                                <?php if ($studentInfos->act_14 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_14; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="15">
                                                                <?php if ($studentInfos->act_15 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_15; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td data-label="Total">
                                                                <strong>
                                                                    <?php $totalActJrScore = $studentInfos->act_1 + $studentInfos->act_2 + $studentInfos->act_3 + $studentInfos->act_4 +
                                                                        $studentInfos->act_5 + $studentInfos->act_6 + $studentInfos->act_7 + $studentInfos->act_8 + $studentInfos->act_9 +
                                                                        $studentInfos->act_10 + $studentInfos->act_11 + $studentInfos->act_12 +  $studentInfos->act_13 + $studentInfos->act_14 +
                                                                        $studentInfos->act_15;
                                                                    echo $totalActJrScore; ?>
                                                                </strong>
                                                            </td>
                                                            <td data-label="PS">
                                                                <strong><?php echo $totalActJrScore . '.00'; ?></strong>
                                                            </td>
                                                            <td data-label="WS">
                                                                <strong>
                                                                    <?php
                                                                    if ($totalActJrScore === 0 || $actToatalJr === 0) {
                                                                        echo 0;
                                                                    } else {
                                                                        $jrWs = ($totalActJrScore / $actToatalJr) * $ws;
                                                                        $jrWsRound = round($jrWs, 2);
                                                                        echo $jrWsRound;
                                                                    }
                                                                    ?>
                                                                </strong>

                                                            </td>

                                                        </tr>

                                                    <?php endforeach; ?>



                                                    <?php if (empty($data['studentInfo'])) : ?>

                                                        <h4>No available student on class record</h4>


                                                    <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row mx-auto">
                                        <div class="col-xl-6 col-lg-6 col-md-12 pl-0">
                                            <div class="btn-group btn-group-toggle mt-4" data-toggle="buttons">
                                                <label class="btn btn-primary active radio_quarter rq1" data-radio="1st quarter">
                                                    <input type="radio" name="options" id="option1" value="1st" autocomplete="off" checked>1st
                                                </label>
                                                <label class="btn btn-primary radio_quarter rq2" data-radio="2nd quarter">
                                                    <input type="radio" name="options" id="option2" value="2nd" autocomplete="off">2nd
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 px-0">
                                            <div class="mt-4">
                                                <a class="btn btn-success float-lg-right" role="button" href="<?php echo URLROOT; ?>/registrars/senior_submission_summary/<?php echo $data['subjectId'] . '/' . $data['sem'] . '/' . $data['schoolYear']; ?>"><i class="fas fa-chart-bar"></i> View Summary</a>
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
<div class="modal" id="addhighestgrade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Highest Posible Score</h5>
                <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mb-2">
                        <label for="status-select" class="mr-2">Activity Name</label>
                        <select class="custom-select" id="status-select" disabled>
                            <option selected="">Choose...</option>
                            <option value="quiz">Quiz</option>
                            <option value="assignment">Assignment</option>
                            <option value="exam">Exam</option>
                            <option value="project">Project</option>
                            <option value="other" id="otherAct">Other</option>
                        </select>
                    </div>
                    <div class="form-group" id="activityName">
                        <label for="activityName">Other Activity</label>
                        <input type="email" class="form-control" id="otherVal" aria-describedby="emailHelp">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-3 mb-2">
                            <label for="exampleInputEmail1">No.</label>
                            <input type="text" name="actNo" id="actNo" class="form-control actNo" id="" aria-describedby="" readonly>
                        </div>
                        <div class="form-group col-9 mb-2">
                            <label for="exampleInputEmail1">High Score</label>
                            <input type="text" name="actHighScore" id="actHighScore" class="form-control" id="" aria-describedby="" readonly>
                        </div>
                    </div>
                    <div class="form-row">

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
    $(document).ready(function() {

        var subjectId = '<?php echo $data['subjectId'] ?>';
        var schoolYear = '<?php echo $data['schoolYear'] ?>';

        gradeSource = 'written works';
        gradeQuarter = '1st quarter';

        $('.radio_gradeSource').click(function() {
            gradeSource = $(this).attr('data-radio');

            $.ajax({
                url: '<?php echo URLROOT ?>' + '/Actions/loadGradesSrAll',
                method: 'post',
                data: {
                    gradeSource: gradeSource,
                    gradeQuarter: gradeQuarter,
                    subjectId: subjectId,
                    schoolYear: schoolYear
                },
                success: function(response) {
                    $('#outputJr').html(response);

                    assignJrActHighScore(gradeSource, gradeQuarter);
                    closeModal(gradeSource, gradeQuarter);

                }
            });
        });
        $('.radio_quarter').click(function() {
            gradeQuarter = $(this).attr('data-radio');

            $.ajax({
                url: '<?php echo URLROOT ?>' + '/Actions/loadGradesSrAll',
                method: 'post',
                data: {
                    gradeSource: gradeSource,
                    gradeQuarter: gradeQuarter,
                    subjectId: subjectId,
                    schoolYear: schoolYear
                },
                success: function(response) {
                    $('#outputJr').html(response);

                    assignJrActHighScore(gradeSource, gradeQuarter);
                    closeModal(gradeSource, gradeQuarter);

                }
            });
        });





        closeModal(gradeSource, gradeQuarter);

        assignJrActHighScore(gradeSource, gradeQuarter);



    });


    function assignJrActHighScore(gradeSource, gradeQuarter) {
        $('.shs').click(function() {
            var colId = $(this).data('id');
            var colIndex = $(this).data('column');
            var rowIndex = $(this).data('row');
            var currCell = $.trim($(this).closest('td').text());
            var perId = $(this).data('value');
            var getActName = $(this).data('name');
            var tbIndex = colIndex + ' ' + rowIndex + ' ' + currCell;
            $('#activityName').hide();


            //check if empty previous column
            var currentSelectedCell = parseInt(colIndex);
            var currowHs = $(this).closest('tr');
            var hsRows = {
                hs0: 'success',
                hs1: currowHs.find('td:eq(1)').text(),
                hs2: currowHs.find('td:eq(2)').text(),
                hs3: currowHs.find('td:eq(3)').text(),
                hs4: currowHs.find('td:eq(4)').text(),
                hs5: currowHs.find('td:eq(5)').text(),
                hs6: currowHs.find('td:eq(6)').text(),
                hs7: currowHs.find('td:eq(7)').text(),
                hs8: currowHs.find('td:eq(8)').text(),
                hs9: currowHs.find('td:eq(9)').text(),
                hs10: currowHs.find('td:eq(10)').text(),
                hs11: currowHs.find('td:eq(11)').text(),
                hs12: currowHs.find('td:eq(12)').text(),
                hs13: currowHs.find('td:eq(13)').text(),
                hs14: currowHs.find('td:eq(14)').text(),
                hs15: currowHs.find('td:eq(15)').text(),
            };

            $('#addhighestgrade').toggle()
            $('.actNo').val(colIndex);
            $('#actHighScore').val(currCell);

            if (currCell === '') {
                $('#updateJrHs').hide();
                $('#addJrHs').show();
            } else {
                if (getActName === 'quiz' || getActName === 'assignment' || getActName === 'exam') {
                    $('#status-select').val(getActName);
                    $('#addJrHs').hide();
                    $('#updateJrHs').show();

                } else {
                    $('#status-select').val('other');
                    $('#otherVal').val(getActName);
                    $('#activityName').show();
                    $('#addJrHs').hide();
                    $('#updateJrHs').show();
                }

            }

            $('#status-select').change(function() {
                var valueAct = $(this).val();
                if (valueAct === 'other') {
                    $('#activityName').show();
                } else {
                    $('#activityName').hide();
                }
            });

        });
    }


    function closeModal(gradeSource, gradeQuarter) {
        $('#close').click(function() {
            $('#addhighestgrade').hide()


        });
    }
</script>