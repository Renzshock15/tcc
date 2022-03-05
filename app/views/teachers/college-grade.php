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
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4><?php echo $data['subjectName']; ?></h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">
                                            <li class="breadcrumb-item ml-lg-auto"><a class="text-danger" href="<?php echo URLROOT; ?>/teachers/my_class">Subjects</a></li>
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
                                    <label class="btn btn-success active radio_gradeSource rg1" data-radio="attendance">
                                        <input type="radio" name="options" id="option1" value="Attendance" autocomplete="off" checked>Attendance
                                    </label>
                                    <label class="btn btn-success radio_gradeSource rg2" data-radio="recitation">
                                        <input type="radio" name="options" id="option2" value="Recitation" autocomplete="off">Recitation
                                    </label>
                                    <label class="btn btn-success radio_gradeSource rg3" data-radio="quiz">
                                        <input type="radio" name="options" id="option3" value="Quiz" autocomplete="off">Quiz
                                    </label>
                                    <label class="btn btn-success radio_gradeSource rg4" data-radio="project">
                                        <input type="radio" name="options" id="option4" value="Project" autocomplete="off">Project
                                    </label>
                                    <label class="btn btn-success radio_gradeSource rg5" data-radio="assignment">
                                        <input type="radio" name="options" id="option5" value="Assignment" autocomplete="off">Assignment
                                    </label>
                                    <label class="btn btn-success radio_gradeSource rg6" data-radio="exam">
                                        <input type="radio" name="options" id="option6" value="Exam" autocomplete="off">Exam
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
                                                    <th>Students Name</th>
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
                                                    <th>CS</th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="gradesHigh">
                                                        <strong>Highest Posible Grade</strong>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="1" data-id=" <?php echo 0; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act1Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act1Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act1; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="2" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act2Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act2Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act2; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="3" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act3Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act3Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act3; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="4" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act4Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act4Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act4; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="5" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act5Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act5Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act5; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="6" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act6Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act6Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act6; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="7" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act7Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act7Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act7; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="8" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act8Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act8Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act8; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="9" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act9Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act9Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act9; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="10" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act10Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act10Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act10; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="11" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act11Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act11Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act11; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="12" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act12Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act2Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act12; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="13" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act13Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act13Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act13; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="14" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act14Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act14Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act14; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>
                                                    <td class="chs" data-row="1" data-column="15" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act15Id; ?><?php endforeach; ?>" data-name="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->act15Name; ?><?php endforeach; ?>">
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?>
                                                            <strong><?php echo $highJr->act15; ?></strong>
                                                        <?php endforeach; ?>
                                                    </td>

                                                    <td>
                                                        <strong><?php $actCount =  $data['actCount'];
                                                                echo $actCount; ?></strong>
                                                    </td>
                                                    <td class="chsWs" data-value="<?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->actWs; ?><?php endforeach; ?>" data-id=" <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php echo $highJr->g_c_h_ids_id; ?><?php endforeach; ?>">
                                                        <?php $ws = 0; ?>
                                                        <?php foreach ($data['jrHighScore'] as $highJr) : ?><?php $ws = $highJr->actWs; ?><?php endforeach; ?>
                                                        <strong><?php echo $ws . '%'; ?></strong>
                                                    </td>
                                                    <td>

                                                    </td>
                                                </tr>


                                                <div id="outputJr">
                                                    <?php foreach ($data['studentInfo'] as $studentInfos) : ?>
                                                        <tr>
                                                            <td data-label="Last Name">
                                                                <?php echo $studentInfos->lname . ', ' . $studentInfos->fname . ' ' . $studentInfos->mname; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act1)) ? 'true' : 'false'; ?>" data-label="1">
                                                                <?php if ($studentInfos->act_1 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_1; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act2)) ? 'true' : 'false'; ?>" data-label="2">
                                                                <?php if ($studentInfos->act_2 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_2; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act3)) ? 'true' : 'false'; ?>" data-label="3">
                                                                <?php if ($studentInfos->act_3 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_3; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act4)) ? 'true' : 'false'; ?>" data-label="4">
                                                                <?php if ($studentInfos->act_4 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_4; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act5)) ? 'true' : 'false'; ?>" data-label="5">
                                                                <?php if ($studentInfos->act_5 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_5; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act6)) ? 'true' : 'false'; ?>" data-label="6">
                                                                <?php if ($studentInfos->act_6 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_6; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act7)) ? 'true' : 'false'; ?>" data-label="7">
                                                                <?php if ($studentInfos->act_7 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_7; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act8)) ? 'true' : 'false'; ?>" data-label="8">
                                                                <?php if ($studentInfos->act_8 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_8; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act9)) ? 'true' : 'false'; ?>" data-label="9">
                                                                <?php if ($studentInfos->act_9 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_9; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act10)) ? 'true' : 'false'; ?>" data-label="10">
                                                                <?php if ($studentInfos->act_10 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_10; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act11)) ? 'true' : 'false'; ?>" data-label="11">
                                                                <?php if ($studentInfos->act_11 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_11; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act12)) ? 'true' : 'false'; ?>" data-label="12">
                                                                <?php if ($studentInfos->act_12 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_12; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act13)) ? 'true' : 'false'; ?>" data-label="13">
                                                                <?php if ($studentInfos->act_13 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_13; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act14)) ? 'true' : 'false'; ?>" data-label="14">
                                                                <?php if ($studentInfos->act_14 === '0') : ?>
                                                                    <?php echo null; ?>
                                                                <?php else : ?>
                                                                    <?php echo $studentInfos->act_14; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td contenteditable="<?php echo (!empty($highJr->act15)) ? 'true' : 'false'; ?>" data-label="15">
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

                                                            <td data-label="WS">
                                                                <strong>
                                                                    <?php
                                                                    if ($totalActJrScore === 0 || $actCount === 0) {
                                                                        echo 0;
                                                                    } else {
                                                                        $convertedNum  = convertToPercent($ws);
                                                                        $jrWs = ($totalActJrScore / $actCount) * $convertedNum;
                                                                        $jrWsRound = round($jrWs, 2);
                                                                        echo $jrWsRound;
                                                                    }
                                                                    ?>
                                                                </strong>

                                                            </td>
                                                            <td data-label="Action">
                                                                <span><button class="btn btn-info mr-1 btnsave" href="" data-id="<?php echo $studentInfos->g_c_id; ?>" role="button"><i class="far fa-save"></i></button><button class="btn btn-danger btndelete" href="" data-id="<?php echo $studentInfos->enrollee_id; ?>" role="button"><i class="far fa-trash-alt"></i></button></span>
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
                                                <label class="btn btn-primary active radio_quarter rq1" data-radio="prelim">
                                                    <input type="radio" name="options" id="option1" value="prelim" autocomplete="off" checked>Pre
                                                </label>
                                                <label class="btn btn-primary radio_quarter rq2" data-radio="midterm">
                                                    <input type="radio" name="options" id="option2" value="midterm" autocomplete="off">Mid
                                                </label>
                                                <label class="btn btn-primary radio_quarter rq3" data-radio="semi-finals">
                                                    <input type="radio" name="options" id="option3" value="semi-finals" autocomplete="off">Sem
                                                </label>
                                                <label class="btn btn-primary radio_quarter rq4" data-radio="finals">
                                                    <input type="radio" name="options" id="option4" value="finals" autocomplete="off">Fin
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 px-0">
                                            <div class="mt-4">
                                                <a class="btn btn-success float-lg-right" role="button" href="<?php echo URLROOT; ?>/teachers/college_summary/<?php echo $data['subjectId'] ?>"><i class="fas fa-chart-bar"></i> View Summary</a>
                                            </div>
                                        </div>
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
                    <div class="form-group" id="activityName">
                        <label for="activityName">Activity Name</label>
                        <input type="email" class="form-control" id="otherVal" aria-describedby="emailHelp" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-3 mb-2">
                            <label for="exampleInputEmail1">No.</label>
                            <input type="text" name="actNo" id="actNo" class="form-control actNo" id="" aria-describedby="" readonly>
                        </div>
                        <div class="form-group col-9 mb-2">
                            <label for="exampleInputEmail1">High Score</label>
                            <input type="text" name="actHighScore" id="actHighScore" class="form-control" id="" aria-describedby="">
                        </div>
                    </div>
                    <div class="form-row">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addJrHs">Add</button>
                <button type="button" class="btn btn-primary" id="updateJrHs">Update</button>
            </div>
        </div>
    </div>
</div>

<!--Modal Ws-->
<div class="modal" id="addWs" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Class standing</h5>
                <button type="button" class="close" id="closeWs" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group ">
                            <label for="exampleInputEmail1">Class Standing</label>
                            <input type="text" name="actWs" id="actWs" class="form-control actWs" id="" aria-describedby="">
                        </div>
                    </div>
                    <div class="form-row">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateWs">Update</button>

            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="confirmModalDraft">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remove</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2">
                    <label for="inputState">Removal Category</label>
                    <select id="draftCat" class="form-control">
                        <option selected>Choose...</option>
                        <option value="remove">Remove Only</option>
                        <option value="AW">Authorized Withdrawal</option>
                        <option value="UW">Unauthorized Withdrawal</option>
                        <option value="NCA">No Credit Due to Absences</option>
                        <option value="NG">No Grade</option>
                        <option value="NC">No Credit</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelModalsss" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveRec">Submit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="confirmRemove">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Remove</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelModalsss" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirmSave">Save</button>
            </div>
        </div>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
<?php require APPROOT . '/views/inc/footergrades.php'; ?>

<script>
    $(document).ready(function() {
        var gradeSource = '';
        var gradeQuarter = '';
        var subjectId = '<?php echo $data['subjectId'] ?>';

        var getPresserveGradeSource = sessionStorage.getItem('preservedGradeSource');
        var getPresserveGradeQuarter = sessionStorage.getItem('preserveGdradeQuarter');

        if (getPresserveGradeSource !== null && getPresserveGradeQuarter !== null) {
            gradeSource = getPresserveGradeSource;
            gradeQuarter = getPresserveGradeQuarter;

            if (gradeSource === 'attendance') {
                $('.rg1').trigger('click');
            }
            if (gradeSource === 'recitation') {
                $('.rg2').trigger('click');
            }
            if (gradeSource === 'quiz') {
                $('.rg3').trigger('click');
            }
            if (gradeSource === 'project') {
                $('.rg4').trigger('click');
            }
            if (gradeSource === 'assignment') {
                $('.rg5').trigger('click');
            }
            if (gradeSource === 'exam') {
                $('.rg6').trigger('click');
            }

            if (gradeQuarter === 'prelim') {
                $('.rq1').trigger('click');
            }

            if (gradeQuarter === 'midterm') {
                $('.rq2').trigger('click');
            }

            if (gradeQuarter === 'semi-finals') {
                $('.rq3').trigger('click');
            }

            if (gradeQuarter === 'finals') {
                $('.rq4').trigger('click');
            }

            $.ajax({
                url: '<?php echo URLROOT ?>' + '/Actions/loadGradesCollege',
                method: 'post',
                data: {
                    gradeSource: gradeSource,
                    gradeQuarter: gradeQuarter,
                    subjectId: subjectId
                },
                success: function(response) {
                    $('#outputJr').html(response);
                    sessionStorage.clear();
                    addCollegeGrades(gradeSource, gradeQuarter);
                    removeCollegeStudents(gradeSource, gradeQuarter);
                    assignCollegeActHighScore(gradeSource, gradeQuarter);
                    closeModal(gradeSource, gradeQuarter);
                    assignWs(gradeSource, gradeQuarter)
                    closeModalWs(gradeSource, gradeQuarter)

                }
            });

            $('.radio_gradeSource').click(function() {
                gradeSource = $(this).attr('data-radio');

                $.ajax({
                    url: '<?php echo URLROOT ?>' + '/Actions/loadGradesCollege',
                    method: 'post',
                    data: {
                        gradeSource: gradeSource,
                        gradeQuarter: gradeQuarter,
                        subjectId: subjectId
                    },
                    success: function(response) {
                        $('#outputJr').html(response);
                        addCollegeGrades(gradeSource, gradeQuarter);
                        removeCollegeStudents(gradeSource, gradeQuarter);
                        assignCollegeActHighScore(gradeSource, gradeQuarter);
                        closeModal(gradeSource, gradeQuarter);
                        assignWs(gradeSource, gradeQuarter)
                        closeModalWs(gradeSource, gradeQuarter)
                    }
                });
            });
            $('.radio_quarter').click(function() {
                gradeQuarter = $(this).attr('data-radio');

                $.ajax({
                    url: '<?php echo URLROOT ?>' + '/Actions/loadGradesCollege',
                    method: 'post',
                    data: {
                        gradeSource: gradeSource,
                        gradeQuarter: gradeQuarter,
                        subjectId: subjectId
                    },
                    success: function(response) {
                        $('#outputJr').html(response);
                        addCollegeGrades(gradeSource, gradeQuarter);
                        removeCollegeStudents(gradeSource, gradeQuarter);
                        assignCollegeActHighScore(gradeSource, gradeQuarter);
                        closeModal(gradeSource, gradeQuarter);
                        assignWs(gradeSource, gradeQuarter)
                        closeModalWs(gradeSource, gradeQuarter)
                    }
                });
            });

        } else {
            gradeSource = 'attendance';
            gradeQuarter = 'prelim';

            $('.radio_gradeSource').click(function() {
                gradeSource = $(this).attr('data-radio');

                $.ajax({
                    url: '<?php echo URLROOT ?>' + '/Actions/loadGradesCollege',
                    method: 'post',
                    data: {
                        gradeSource: gradeSource,
                        gradeQuarter: gradeQuarter,
                        subjectId: subjectId
                    },
                    success: function(response) {
                        $('#outputJr').html(response);
                        addCollegeGrades(gradeSource, gradeQuarter);
                        removeCollegeStudents(gradeSource, gradeQuarter);
                        assignCollegeActHighScore(gradeSource, gradeQuarter);
                        closeModal(gradeSource, gradeQuarter);
                        assignWs(gradeSource, gradeQuarter)
                        closeModalWs(gradeSource, gradeQuarter)
                    }
                });
            });
            $('.radio_quarter').click(function() {
                gradeQuarter = $(this).attr('data-radio');

                $.ajax({
                    url: '<?php echo URLROOT ?>' + '/Actions/loadGradesCollege',
                    method: 'post',
                    data: {
                        gradeSource: gradeSource,
                        gradeQuarter: gradeQuarter,
                        subjectId: subjectId
                    },
                    success: function(response) {
                        $('#outputJr').html(response);
                        addCollegeGrades(gradeSource, gradeQuarter);
                        removeCollegeStudents(gradeSource, gradeQuarter);
                        assignCollegeActHighScore(gradeSource, gradeQuarter);
                        closeModal(gradeSource, gradeQuarter);
                        assignWs(gradeSource, gradeQuarter)
                        closeModalWs(gradeSource, gradeQuarter)
                    }
                });
            });

            addCollegeGrades(gradeSource, gradeQuarter);

            removeCollegeStudents(gradeSource, gradeQuarter);

            closeModal(gradeSource, gradeQuarter);

            assignCollegeActHighScore(gradeSource, gradeQuarter);

            assignWs(gradeSource, gradeQuarter)

            closeModalWs(gradeSource, gradeQuarter)
        }

    });

    function assignWs(gradeSource, gradeQuarter) {
        $('.chsWs').click(function() {

            if ($(this).data('value') === '') {
                alert('Please add first a posible high score');
            } else {
                var wsId = $(this).data('id');
                var wsValue = $(this).data('value');

                $('.actWs').val(wsValue);

                $('#addWs').show();

                $('#updateWs').click(function() {
                    var updateWsValue = $('.actWs').val()
                    var newWs = {
                        newWs1: updateWsValue
                    };

                    if (checkIfNumeric(newWs)) {
                        $.ajax({
                            url: '<?php echo URLROOT ?>' + '/Actions/updateCollegeClassStanding',
                            method: 'post',
                            data: {
                                gradeSource: gradeSource,
                                gradeQuarter: gradeQuarter,
                                newWs: newWs,
                                wsId: wsId
                            },
                            success: function(response) {
                                $('#addWs').hide();
                                alert(response);
                                // removeJrStudents(gradeSource, gradeQuarter);
                                // addJrGrades(gradeSource, gradeQuarter);
                                // assignJrActHighScore(gradeSource, gradeQuarter);
                                var preserveGradeSource = gradeSource;
                                var preserveGradeQuarter = gradeQuarter;
                                sessionStorage.setItem('preservedGradeSource', preserveGradeSource);
                                sessionStorage.setItem('preserveGdradeQuarter', preserveGradeQuarter);
                                location.reload();




                            }
                        });
                    }
                });

            }

        });
    }



    function assignCollegeActHighScore(gradeSource, gradeQuarter) {
        $('.chs').click(function() {
            var colId = $(this).data('id');
            var colIndex = $(this).data('column');
            var rowIndex = $(this).data('row');
            var currCell = $.trim($(this).closest('td').text());
            var perId = $(this).data('value');
            var getActName = gradeSource;
            // var getActName = $(this).data('name');
            var tbIndex = colIndex + ' ' + rowIndex + ' ' + currCell;



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

            var newSelectedCell = 'hsRows.hs' + (currentSelectedCell - 1);
            var myNeSelectedCell = $.trim(eval(newSelectedCell));


            if (myNeSelectedCell === '') {
                alert('Please select the empty previous column');
            } else {
                $('#addhighestgrade').toggle()
                $('.actNo').val(colIndex);
                $('#actHighScore').val(currCell);
                $('#otherVal').val(getActName);

                if (currCell === '') {
                    $('#updateJrHs').hide();
                    $('#addJrHs').show();
                } else {
                    $('#addJrHs').hide();
                    $('#updateJrHs').show();
                }

                $('#addJrHs').click(function() {
                    var currentSubjectId = '<?php echo $data['subjectId'] ?>';
                    var actTrigger = 'add';
                    var actJrHsNo = $('.actNo').val();
                    var actName = $('#otherVal').val();
                    var jrHs = {
                        actJrHs: $('#actHighScore').val()
                    };
                    if ($('#actHighScore').val() === '') {
                        alert('Please enter a high score');
                    } else {
                        if (checkIfNumeric(jrHs)) {
                            $.ajax({
                                url: '<?php echo URLROOT ?>' + '/Actions/addCollegeHighGrade',
                                method: 'post',
                                data: {
                                    gradeSource: gradeSource,
                                    gradeQuarter: gradeQuarter,
                                    currentSubjectId: currentSubjectId,
                                    jrHs: jrHs,
                                    actName: $('#otherVal').val(),
                                    actTrigger: actTrigger,
                                    actJrHsNo: actJrHsNo,
                                    colId: colId,
                                    perId: perId
                                },
                                success: function(response) {
                                    var newact = 'Assining high score to ' + actName + ' successfully';

                                    // $('#outputJr').html(response);
                                    $('#addhighestgrade').hide();
                                    alert(newact);
                                    // removeJrStudents(gradeSource, gradeQuarter);
                                    // addJrGrades(gradeSource, gradeQuarter);
                                    // assignJrActHighScore(gradeSource, gradeQuarter);
                                    var preserveGradeSource = gradeSource;
                                    var preserveGradeQuarter = gradeQuarter;
                                    sessionStorage.setItem('preservedGradeSource', preserveGradeSource);
                                    sessionStorage.setItem('preserveGdradeQuarter', preserveGradeQuarter);
                                    location.reload();

                                }
                            });
                        }

                    }
                });
                $('#updateJrHs').click(function() {
                    var currentSubjectId = '<?php echo $data['subjectId'] ?>';
                    var actTrigger = 'update';
                    var actJrHsNo = $('.actNo').val();
                    var actName = $('#otherVal').val();
                    var jrHs = {
                        actJrHs: $('#actHighScore').val()
                    };
                    if ($('#actHighScore').val() === '') {
                        alert('Please enter a high score');
                    } else {
                        if (checkIfNumeric(jrHs)) {
                            $.ajax({
                                url: '<?php echo URLROOT ?>' + '/Actions/addCollegeHighGrade',
                                method: 'post',
                                data: {
                                    gradeSource: gradeSource,
                                    gradeQuarter: gradeQuarter,
                                    currentSubjectId: currentSubjectId,
                                    jrHs: jrHs,
                                    actName: $('#otherVal').val(),
                                    actTrigger: actTrigger,
                                    actJrHsNo: actJrHsNo,
                                    colId: colId,
                                    perId: perId
                                },
                                success: function(response) {
                                    var newact = 'Updating high score ' + actName + ' successfully';

                                    // $('#outputJr').html(response);
                                    $('#addhighestgrade').hide();
                                    alert(newact);
                                    // removeJrStudents(gradeSource, gradeQuarter);
                                    // addJrGrades(gradeSource, gradeQuarter);
                                    // assignJrActHighScore(gradeSource, gradeQuarter);
                                    var preserveGradeSource = gradeSource;
                                    var preserveGradeQuarter = gradeQuarter;
                                    sessionStorage.setItem('preservedGradeSource', preserveGradeSource);
                                    sessionStorage.setItem('preserveGdradeQuarter', preserveGradeQuarter);
                                    location.reload();

                                }
                            });
                        }
                    }
                });
            }

        });
    }


    function closeModal(gradeSource, gradeQuarter) {
        $('#close').click(function() {
            var preserveGradeSource = gradeSource;
            var preserveGradeQuarter = gradeQuarter;
            sessionStorage.setItem('preservedGradeSource', preserveGradeSource);
            sessionStorage.setItem('preserveGdradeQuarter', preserveGradeQuarter);
            location.reload();

        });
    }

    function closeModalWs(gradeSource, gradeQuarter) {
        $('#closeWs').click(function() {
            var preserveGradeSource = gradeSource;
            var preserveGradeQuarter = gradeQuarter;
            sessionStorage.setItem('preservedGradeSource', preserveGradeSource);
            sessionStorage.setItem('preserveGdradeQuarter', preserveGradeQuarter);
            location.reload();

        });
    }


    function addCollegeGrades(gradeSource, gradeQuarter) {
        $('#jrTable tbody').on('click', '.btnsave', function() {
            var jrGradeId = $(this).data('id');
            var currow = $(this).closest('tr');
            var subjectIds = '<?php echo $data['subjectId'] ?>';
            var activities = {
                act1: currow.find('td:eq(1)').text(),
                act2: currow.find('td:eq(2)').text(),
                act3: currow.find('td:eq(3)').text(),
                act4: currow.find('td:eq(4)').text(),
                act5: currow.find('td:eq(5)').text(),
                act6: currow.find('td:eq(6)').text(),
                act7: currow.find('td:eq(7)').text(),
                act8: currow.find('td:eq(8)').text(),
                act9: currow.find('td:eq(9)').text(),
                act10: currow.find('td:eq(10)').text(),
                act11: currow.find('td:eq(11)').text(),
                act12: currow.find('td:eq(12)').text(),
                act13: currow.find('td:eq(13)').text(),
                act14: currow.find('td:eq(14)').text(),
                act15: currow.find('td:eq(15)').text()
            };

            if (checkIfNumeric(activities)) {
                $.ajax({
                    url: '<?php echo URLROOT ?>' + '/Actions/updateCollegeGradeTable',
                    method: 'post',
                    data: {
                        gradeSource: gradeSource,
                        gradeQuarter: gradeQuarter,
                        jrGradeId: jrGradeId,
                        subjectIds: subjectIds,
                        activities: activities
                    },
                    success: function(response) {
                        $('#outputJr').html(response);
                        alert('Adding grade to class record as ' + gradeSource + ' for ' + gradeQuarter + ' successful')
                        removeCollegeStudents(gradeSource, gradeQuarter);
                        addCollegeGrades(gradeSource, gradeQuarter);
                        assignCollegeActHighScore(gradeSource, gradeQuarter);
                        closeModal(gradeSource, gradeQuarter);
                        assignWs(gradeSource, gradeQuarter)
                        closeModalWs(gradeSource, gradeQuarter)
                    }
                });
            }
        });
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
            alert('The grade you enter has invalid character');
        } else {
            return true;
        }

    }

    function removeCollegeStudents(gradeSource, gradeQuarter) {
        $('#jrTable tbody').on('click', '.btndelete', function() {
            var jrGradeId = $(this).data('id');
            var subjectIds = '<?php echo $data['subjectId'] ?>';
            var subjectDes = '<?php echo $data['subjectDescription']; ?>';
            var subjectName = '<?php echo $data['subjectName']; ?>';

            $('#confirmModalDraft').toggle();

            $('.saveRec').click(function() {
                var draftStat = $('#draftCat').val();

                if (draftStat === 'Choose...') {
                    alert('Please select removing option');
                } else if (draftStat === 'remove') {
                    $('#confirmModalDraft').hide();
                    $('#confirmRemove').toggle();
                    $('.confirmSave').click(function() {
                        $.ajax({
                            url: '<?php echo URLROOT ?>' + '/Actions/removeCollegeStudent',
                            method: 'post',
                            data: {
                                gradeSource: gradeSource,
                                gradeQuarter: gradeQuarter,
                                subjectIds: subjectIds,
                                jrGradeId: jrGradeId
                            },
                            success: function(response) {
                                alert(response);
                                $('#confirmRemove').hide();
                                location.reload();
                            }
                        });
                    });

                } else {

                    $('#confirmModalDraft').hide();
                    $('#confirmRemove').toggle();
                    $('.confirmSave').click(function() {
                        $.ajax({
                            url: '<?php echo URLROOT ?>' + '/Actions/removeCollegeStudentDraft',
                            method: 'post',
                            data: {
                                gradeSource: gradeSource,
                                gradeQuarter: gradeQuarter,
                                subjectIds: subjectIds,
                                jrGradeId: jrGradeId,
                                subjectName: subjectName,
                                subjectDes: subjectDes,
                                draftStat: draftStat
                            },
                            success: function(response) {
                                alert(response);
                                $('#confirmRemove').hide();
                                location.reload();
                            }
                        });
                    });

                }
            });


        });
    }
</script>