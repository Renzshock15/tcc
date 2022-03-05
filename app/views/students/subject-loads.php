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
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/students/subject_load" class="nav-link text-white p-3 mb-2 current"><i class="far fa-address-book text-light fa-lg mr-3"></i>Subjects</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/students/student_grades" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-address-card text-light fa-lg mr-3"></i>Report Card</a></li>
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
                                    <h4>Subject List</h4>
                                    <?php if (empty($data['juniorSubjects']) && empty($data['seniorSubjects']) && empty($data['collegeSubjects']) && empty($data['suppleSubjects']) && empty($data['masterSubjects'])) : ?>
                                        <h5 class="ml-0 mt-3 mb-3"><?php echo 'No subjects available'; ?></h5>

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
                    <!--Jr High-->
                    <?php if (!empty($data['juniorSubjects'])) : ?>
                        <div class="tableHeaderColLoads">
                            <div class="tableHeaderContentColLoads">
                                <strong>Kinder - Junior High</strong>
                            </div>
                        </div>
                        <div class="card-columns">
                            <?php foreach ($data['juniorSubjects'] as $subject) : ?>
                                <div class="card mb-3">
                                    <div class="card-header <?php echo 'bg-c' . $subject->subject_grade; ?>">
                                        <a href="" class="text-white font-weight-bold"><?php echo $subject->subject_name; ?></a>
                                    </div>
                                    <div class="card-body text-white <?php echo 'bg-c' . $subject->subject_grade; ?> <?php echo 'bg-c' . $subject->subject_grade . 'img'; ?>">
                                        <h6><?php echo $subject->subject_description; ?></h6>
                                        <h6><?php echo $subject->subject_grade . ' - ' . $subject->section_name; ?></h6>
                                        <h6><?php echo $subject->subject_time . ' - ' . $subject->subject_day; ?></h6>
                                        <h6><?php echo $subject->room_name; ?></h6>

                                    </div>
                                    <div class="card-footer text-dark">
                                        <h6><?php echo 'Teacher: ' . $subject->first_name . ' ' . $subject->last_name; ?></h6>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <!--End of Jr High-->
                    <!--Sr High-->
                    <?php if (!empty($data['seniorSubjects'])) : ?>
                        <div class="tableHeaderColLoads">
                            <div class="tableHeaderContentColLoads">
                                <strong>Senior High School</strong>
                            </div>
                        </div>
                        <div class="card-columns">
                            <?php foreach ($data['seniorSubjects'] as $subjectSr) : ?>
                                <div class="card text-white mb-3">
                                    <div class="card-header <?php echo 'bg-c' . $subjectSr->year_level; ?>">
                                        <a href="" class="text-white font-weight-bold"><?php echo $subjectSr->subjectCode . ' - ' . $subjectSr->term_name; ?></a>
                                    </div>
                                    <div class="card-body text-white <?php echo 'bg-c' . $subjectSr->year_level; ?> <?php echo 'bg-c' . $subjectSr->proId . 'sr'; ?>">
                                        <h6><?php echo $subjectSr->subjectDes; ?></h6>
                                        <h6><?php echo $subjectSr->year_level . ' - ' . $subjectSr->sec_code; ?></h6>
                                        <strong>
                                            <h6><?php echo 'Schedule 1:'; ?></h6>
                                        </strong>
                                        <h6><?php echo $subjectSr->start . ' - ' . $subjectSr->end . ' - ' . $subjectSr->day . ' - ' . '(' . $subjectSr->room11 . ')'; ?></h6>
                                        <strong>
                                            <h6><?php echo 'Schedule 2:'; ?></h6>
                                        </strong>
                                        <?php if (empty($subjectSr->room_ID2) && empty($subjectSr->day2) || empty($subjectSr->start2) || empty($subjectSr->end2)) : ?>
                                            <?php echo 'None'; ?>
                                        <?php else : ?>
                                            <?php echo $subjectSr->start2 . ' - ' . $subjectSr->end2 . ' - ' . $subjectSr->day2 . ' - ' . '(' . $subjectSr->room22 . ')'; ?>
                                        <?php endif; ?>

                                    </div>
                                    <div class="card-footer bg-c-white text-dark">
                                        <h6><?php echo 'Teacher: ' . $subjectSr->first_name . ' ' . $subjectSr->last_name; ?></h6>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <!--End of Sr High-->
                    <!--College-->
                    <?php if (!empty($data['collegeSubjects'])) : ?>
                        <div class="tableHeaderColLoads">
                            <div class="tableHeaderContentColLoads">
                                <strong>College</strong>
                            </div>
                        </div>
                        <div class="card-columns">
                            <?php foreach ($data['collegeSubjects'] as $subjectCollege) : ?>
                                <div class="card text-white mb-3">
                                    <div class="card-header <?php echo 'bg-c' . $subjectCollege->year_level; ?>">
                                        <a href="" class="text-white font-weight-bold"><?php echo $subjectCollege->subjectCode; ?></a>
                                    </div>
                                    <div class="card-body text-white <?php echo 'bg-c' . $subjectCollege->year_level; ?> <?php echo 'bg-c' . $subjectCollege->proId . 'col'; ?>">
                                        <h6><?php echo $subjectCollege->subjectDes; ?></h6>
                                        <h6><?php echo $subjectCollege->year_level . ' - ' . $subjectCollege->sec_code; ?></h6>
                                        <strong>
                                            <h6><?php echo 'Schedule 1:'; ?></h6>
                                        </strong>
                                        <h6><?php echo $subjectCollege->start . ' - ' . $subjectCollege->end . ' - ' . $subjectCollege->day . ' - ' . '(' . $subjectCollege->room11 . ')'; ?></h6>
                                        <strong>
                                            <h6><?php echo 'Schedule 2:'; ?></h6>
                                        </strong>
                                        <?php if (empty($subjectCollege->room_ID2) && empty($subjectCollege->day2) || empty($subjectCollege->start2) || empty($subjectCollege->end2)) : ?>
                                            <?php echo 'None'; ?>
                                        <?php else : ?>
                                            <?php echo $subjectCollege->start2 . ' - ' . $subjectCollege->end2 . ' - ' . $subjectCollege->day2 . ' - ' . '(' . $subjectCollege->room22 . ')'; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer text-dark">
                                        <h6><?php echo 'Teacher: ' . $subjectCollege->first_name . ' ' . $subjectCollege->last_name; ?></h6>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <!--End of College-->
                    <!--Supplemental-->
                    <?php if (!empty($data['suppleSubjects'])) : ?>
                        <div class="tableHeaderColLoads">
                            <div class="tableHeaderContentColLoads">
                                <strong>Supplemental</strong>
                            </div>
                        </div>
                        <div class="card-columns">
                            <?php foreach ($data['suppleSubjects'] as $subjectSupple) : ?>
                                <div class="card text-white mb-3">
                                    <div class="card-header <?php echo 'bg-c' . $subjectSupple->year_level; ?>">
                                        <a href="" class="text-white font-weight-bold"><?php echo $subjectSupple->subjectCode; ?></a>
                                    </div>
                                    <div class="card-body text-white <?php echo 'bg-c' . $subjectSupple->year_level; ?> <?php echo 'bg-c' . $subjectSupple->proId . 'sup'; ?>">
                                        <h6><?php echo $subjectSupple->subjectDes; ?></h6>
                                        <h6><?php echo $subjectSupple->year_level . ' - ' . $subjectSupple->sec_code; ?></h6>
                                        <strong>
                                            <h6><?php echo 'Schedule 1:'; ?></h6>
                                        </strong>
                                        <h6><?php echo $subjectSupple->start . ' - ' . $subjectSupple->end . ' - ' . $subjectSupple->day . ' - ' . '(' . $subjectSupple->room11 . ')'; ?></h6>
                                        <strong>
                                            <h6><?php echo 'Schedule 2:'; ?></h6>
                                        </strong>
                                        <?php if (empty($subjectSupple->room_ID2) && empty($subjectSupple->day2) || empty($subjectSupple->start2) || empty($subjectSupple->end2)) : ?>
                                            <?php echo 'None'; ?>
                                        <?php else : ?>
                                            <?php echo $subjectSupple->start2 . ' - ' . $subjectSupple->end2 . ' - ' . $subjectSupple->day2 . ' - ' . '(' . $subjectSupple->room22 . ')'; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer text-dark">
                                        <h6><?php echo 'Teacher: ' . $subjectSupple->first_name . ' ' . $subjectSupple->last_name; ?></h6>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <!--End  of Supplemental-->
                    <!--Masteral-->
                    <?php if (!empty($data['masterSubjects'])) : ?>
                        <div class="tableHeaderColLoads">
                            <div class="tableHeaderContentColLoads">
                                <strong>Graduate School</strong>
                            </div>
                        </div>
                        <div class="card-columns">
                            <?php foreach ($data['masterSubjects'] as $subjectMaster) : ?>
                                <div class="card text-white mb-3">
                                    <div class="card-header <?php echo 'bg-c' . $subjectMaster->year_level; ?>">
                                        <a href="" class="text-white font-weight-bold"><?php echo (empty($subjectMaster->subjectCode)) ? '--' : $subjectMaster->subjectCode; ?></a>
                                    </div>
                                    <div class="card-body text-white <?php echo 'bg-c' . $subjectMaster->year_level; ?> <?php echo 'bg-c' . $subjectMaster->proId . 'mas'; ?>">
                                        <h6><?php echo $subjectMaster->subjectDes; ?></h6>
                                        <h6><?php echo $subjectMaster->year_level . ' - ' . $subjectMaster->sec_code; ?></h6>
                                        <strong>
                                            <h6><?php echo 'Schedule 1:'; ?></h6>
                                        </strong>
                                        <h6><?php echo $subjectMaster->start . ' - ' . $subjectMaster->end . ' - ' . $subjectMaster->day . ' - ' . '(' . $subjectMaster->room11 . ')'; ?></h6>
                                        <strong>
                                            <h6><?php echo 'Schedule 2:'; ?></h6>
                                        </strong>
                                        <?php if (empty($subjectMaster->room_ID2) && empty($subjectMaster->day2) || empty($subjectMaster->start2) || empty($subjectMaster->end2)) : ?>
                                            <?php echo 'None'; ?>
                                        <?php else : ?>
                                            <?php echo $subjectMaster->start2 . ' - ' . $subjectMaster->end2 . ' - ' . $subjectMaster->day2 . ' - ' . '(' . $subjectMaster->room22 . ')'; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer bg-c-white f-right">
                                        <h6><?php echo 'Teacher: ' . $subjectMaster->first_name . ' ' . $subjectMaster->last_name; ?></h6>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <!--End of Masteral-->
                </div>

            </div>
        </div>
    </div>
    </div>
</section>
<!--end of content-->

<?php require APPROOT . '/views/inc/footer.php'; ?>