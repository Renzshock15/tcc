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
                                    <h4>My Subjects</h4>
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
                        <div class="card-body">
                            <?php if (!empty($data['subjects'])) : ?>
                                <div class="tableHeader">
                                    <div class="tableHeaderContent">
                                        <strong>Kinder - Junior High</strong>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-8">

                                    </div>
                                    <div class="col-lg-4">

                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive mb-5">
                                    <table class="tables">
                                        <thead>
                                            <tr>
                                                <th>Subjects</th>
                                                <th>Description</th>
                                                <th>Level</th>
                                                <th>Section</th>
                                                <th>Schedule</th>
                                                <th>Room</th>
                                                <th width="10%">View Students</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['subjects'] as $subject) : ?>
                                                <tr>
                                                    <td data-label="Subjects">
                                                        <a href="<?php echo URLROOT; ?>/teachers/student_subject_list/ <?php echo 'junior' . '/' . $subject->subjectId; ?>" class="text-body font-weight-bold"><?php echo $subject->subject_name; ?></a>
                                                    </td>
                                                    <td data-label="Description">
                                                        <?php echo $subject->subject_description; ?>
                                                    </td>
                                                    <td data-label="Level">
                                                        <?php echo $subject->subject_grade; ?>
                                                    </td>
                                                    <td data-label="Section">
                                                        <?php echo $subject->section_name; ?>
                                                    </td>
                                                    <td data-label="Schedule">
                                                        <?php echo $subject->subject_time . ' - ' . $subject->subject_day; ?>
                                                    </td>
                                                    <td data-label="Room">
                                                        <?php echo $subject->room_name; ?>
                                                    </td>
                                                    <td data-label="View Students">
                                                        <a class="btn btn-danger" href="<?php echo URLROOT; ?>/teachers/student_subject_list/ <?php echo 'junior' . '/' . $subject->subjectId; ?>" role="button"><i class="fas fa-users text-light fa-lg mr-1"></i> View</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($data['subjectsSr'])) : ?>
                                <div class="tableHeader">
                                    <div class="tableHeaderContent">
                                        <strong>Senior High School</strong>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-8">

                                    </div>
                                    <div class="col-lg-4">

                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive mb-5">
                                    <table class="tables">
                                        <thead>
                                            <tr>
                                                <th>Subjects</th>
                                                <th>Description</th>
                                                <th>Level</th>
                                                <th>Section</th>
                                                <th>Schedule 1</th>
                                                <th>Schedule 2</th>
                                                <th>Sem</th>
                                                <th width="10%">View Students</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['subjectsSr'] as $subjectSr) : ?>
                                                <tr>
                                                    <td data-label="Subjects">
                                                        <a href="<?php echo URLROOT; ?>/teachers/senior_grade<?php echo $subjectSr->sem_TERM; ?>/<?php echo 'senior' . '/' . $subjectSr->subject_sched_ID; ?>" class="text-body font-weight-bold"><?php echo $subjectSr->subjectCode; ?></a>
                                                    </td>
                                                    <td data-label="Description">
                                                        <?php echo $subjectSr->subjectDes; ?>
                                                    </td>
                                                    <td data-label="Level">
                                                        <?php echo $subjectSr->year_level; ?>
                                                    </td>
                                                    <td data-label="Section">
                                                        <?php echo $subjectSr->year_level . ' - ' . $subjectSr->sec_code; ?>
                                                    </td>
                                                    <td data-label="Schedule 1">
                                                        <?php echo $subjectSr->start . ' - ' . $subjectSr->end . ' - ' . $subjectSr->day . ' - ' . '(' . $subjectSr->room11 . ')'; ?>
                                                    </td>
                                                    <td data-label="Schedule 2">
                                                        <?php if (empty($subjectSr->room_ID2) && empty($subjectSr->day2) || empty($subjectSr->start2) || empty($subjectSr->end2)) : ?>
                                                            <?php echo 'None'; ?>
                                                        <?php else : ?>
                                                            <?php echo $subjectSr->start2 . ' - ' . $subjectSr->end2 . ' - ' . $subjectSr->day2 . ' - ' . '(' . $subjectSr->room22 . ')'; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td data-label="Sem">
                                                        <?php if ($subjectSr->semTerm === '1') {
                                                            echo '1st';
                                                        } elseif ($subjectSr->semTerm === '2') {
                                                            echo '2nd';
                                                        } elseif ($subjectSr->semTerm === '3') {
                                                            echo 'Summer';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td data-label="View Students">
                                                        <a class="btn btn-danger" href="<?php echo URLROOT; ?>/teachers/senior_grade<?php echo $subjectSr->sem_TERM; ?>/<?php echo 'senior' . '/' . $subjectSr->subject_sched_ID; ?>" role="button"><i class="fas fa-users text-light fa-lg mr-1"></i> View</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($data['subjectsCollege'])) : ?>
                                <div class="tableHeader">
                                    <div class="tableHeaderContent">
                                        <strong>College</strong>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-8">

                                    </div>
                                    <div class="col-lg-4">

                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive mb-5">
                                    <table class="tables">
                                        <thead>
                                            <tr>
                                                <th>Subjects</th>
                                                <th>Description</th>
                                                <th>Level</th>
                                                <th>Section</th>
                                                <th>Schedule 1</th>
                                                <th>Schedule 2</th>
                                                <th width="10%">View Students</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['subjectsCollege'] as $subjectCollege) : ?>
                                                <tr>
                                                    <td data-label="Subjects">
                                                        <a href="<?php echo URLROOT; ?>/teachers/college_grade/<?php echo 'college' . '/' . $subjectCollege->subject_sched_ID; ?>" class="text-body font-weight-bold"><?php echo $subjectCollege->subjectCode; ?></a>
                                                    </td>
                                                    <td data-label="Description">
                                                        <?php echo $subjectCollege->subjectDes; ?>
                                                    </td>
                                                    <td data-label="Level">
                                                        <?php echo $subjectCollege->year_level; ?>
                                                    </td>
                                                    <td data-label="Section">
                                                        <?php echo $subjectCollege->year_level . ' - ' . $subjectCollege->sec_code; ?>
                                                    </td>
                                                    <td data-label="Schedule 1">
                                                        <?php echo $subjectCollege->start . ' - ' . $subjectCollege->end . ' - ' . $subjectCollege->day . ' - ' . '(' . $subjectCollege->room11 . ')'; ?>
                                                    </td>
                                                    <td data-label="Schedule 2">
                                                        <?php if (empty($subjectCollege->room_ID2) && empty($subjectCollege->day2) || empty($subjectCollege->start2) || empty($subjectCollege->end2)) : ?>
                                                            <?php echo 'None'; ?>
                                                        <?php else : ?>
                                                            <?php echo $subjectCollege->start2 . ' - ' . $subjectCollege->end2 . ' - ' . $subjectCollege->day2 . ' - ' . '(' . $subjectCollege->room22 . ')'; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td data-label="View Students">
                                                        <a class="btn btn-danger" href="<?php echo URLROOT; ?>/teachers/college_grade/<?php echo 'college' . '/' . $subjectCollege->subject_sched_ID; ?>" role="button"><i class="fas fa-users text-light fa-lg mr-1"></i> View</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($data['subjectsSupple'])) : ?>
                                <div class="tableHeader">
                                    <div class="tableHeaderContent">
                                        <strong>Supplemental</strong>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-8">

                                    </div>
                                    <div class="col-lg-4">

                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive mb-5">
                                    <table class="tables">
                                        <thead>
                                            <tr>
                                                <th>Subjects</th>
                                                <th>Description</th>
                                                <th>Level</th>
                                                <th>Section</th>
                                                <th>Schedule 1</th>
                                                <th>Schedule 2</th>
                                                <th width="10%">View Students</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['subjectsSupple'] as $subjectSupple) : ?>
                                                <tr>
                                                    <td data-label="Subjects">
                                                        <a href="<?php echo URLROOT; ?>/teachers/college_grade/<?php echo 'supplemental' . '/' . $subjectSupple->subject_sched_ID; ?>" class="text-body font-weight-bold"><?php echo $subjectSupple->subjectCode; ?></a>
                                                    </td>
                                                    <td data-label="Description">
                                                        <?php echo $subjectSupple->subjectDes; ?>
                                                    </td>
                                                    <td data-label="Level">
                                                        <?php echo $subjectSupple->year_level; ?>
                                                    </td>
                                                    <td data-label="Section">
                                                        <?php echo $subjectSupple->year_level . ' - ' . $subjectSupple->sec_code; ?>
                                                    </td>
                                                    <td data-label="Schedule 1">
                                                        <?php echo $subjectSupple->start . ' - ' . $subjectSupple->end . ' - ' . $subjectSupple->day . ' - ' . '(' . $subjectSupple->room11 . ')'; ?>
                                                    </td>
                                                    <td data-label="Schedule 2">
                                                        <?php if (empty($subjectSupple->room_ID2) && empty($subjectSupple->day2) || empty($subjectSupple->start2) || empty($subjectSupple->end2)) : ?>
                                                            <?php echo 'None'; ?>
                                                        <?php else : ?>
                                                            <?php echo $subjectSupple->start2 . ' - ' . $subjectSupple->end2 . ' - ' . $subjectSupple->day2 . ' - ' . '(' . $subjectSupple->room22 . ')'; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td data-label="View Students">
                                                        <a class="btn btn-danger" href="<?php echo URLROOT; ?>/teachers/college_grade/<?php echo 'supplemental' . '/' . $subjectSupple->subject_sched_ID; ?>" role="button"><i class="fas fa-users text-light fa-lg mr-1"></i> View</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($data['subjectsMaster'])) : ?>
                                <div class="tableHeader">
                                    <div class="tableHeaderContent">
                                        <strong>Graduate School</strong>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-8">

                                    </div>
                                    <div class="col-lg-4">

                                    </div><!-- end col-->
                                </div>

                                <div class="table-responsive">
                                    <table class="tables">
                                        <thead>
                                            <tr>
                                                <th>Subjects</th>
                                                <th>Description</th>
                                                <th>Level</th>
                                                <th>Section</th>
                                                <th>Schedule 1</th>
                                                <th>Schedule 2</th>
                                                <th width="10%">View Students</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['subjectsMaster'] as $subjectMaster) : ?>
                                                <tr>
                                                    <td data-label="Subjects">
                                                        <a href="<?php echo URLROOT; ?>/teachers/college_grade/<?php echo 'masters' . '/' . $subjectMaster->subject_sched_ID; ?>" class="text-body font-weight-bold"><?php echo $subjectMaster->subjectCode; ?></a>
                                                    </td>
                                                    <td data-label="Description">
                                                        <?php echo $subjectMaster->subjectDes; ?>
                                                    </td>
                                                    <td data-label="Level">
                                                        <?php echo $subjectMaster->year_level; ?>
                                                    </td>
                                                    <td data-label="Section">
                                                        <?php echo $subjectMaster->year_level . ' - ' . $subjectMaster->sec_code; ?>
                                                    </td>
                                                    <td data-label="Schedule 1">
                                                        <?php echo $subjectMaster->start . ' - ' . $subjectMaster->end . ' - ' . $subjectMaster->day . ' - ' . '(' . $subjectMaster->room11 . ')'; ?>
                                                    </td>
                                                    <td data-label="Schedule 2">
                                                        <?php if (empty($subjectMaster->room_ID2) && empty($subjectMaster->day2) || empty($subjectMaster->start2) || empty($subjectMaster->end2)) : ?>
                                                            <?php echo 'None'; ?>
                                                        <?php else : ?>
                                                            <?php echo $subjectMaster->start2 . ' - ' . $subjectMaster->end2 . ' - ' . $subjectMaster->day2 . ' - ' . '(' . $subjectMaster->room22 . ')'; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td data-label="View Students">
                                                        <a class="btn btn-danger" href="<?php echo URLROOT; ?>/teachers/college_grade/<?php echo 'masters' . '/' . $subjectMaster->subject_sched_ID; ?>" role="button"><i class="fas fa-users text-light fa-lg mr-1"></i> View</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            <?php if (empty($data['subjects']) && empty($data['subjectsSr']) && empty($data['subjectsCollege']) && empty($data['subjectsSupple']) && empty($data['subjectsMaster'])) : ?>
                                <h5 class="ml-1 mt-3 mb-3"><?php echo 'No subjects available'; ?></h5>
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