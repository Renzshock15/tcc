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
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/students/student_grades" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-address-card text-light fa-lg mr-3"></i>Report Card</a></li>
                        <?php if ($_SESSION['studentLevel'] === 'College' || $_SESSION['studentLevel'] === 'Graduate School' || $_SESSION['studentLevel'] === 'Supplemental') {
                            echo '<li class="nav-item"><a href="' . URLROOT . '/students/checklist" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-tasks text-light fa-lg mr-3"></i>My Checklist</a></li>';
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
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <h4>My Checklist</h4>

                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">
                                            <li class="breadcrumb-item active ml-lg-auto" aria-current="page"></li>
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
                        <?php if (!empty($data['collegeClassCardHeader'])) : ?>
                            <div class="row mb-5">
                                <div class="col-lg-3 mt-4 ml-4">
                                    <img src="<?php echo URLROOT; ?>/images/tcclogo.png" width="80px" height="80px" alt="">
                                </div>
                                <div class="col-lg-8 mt-5 mx-auto">
                                    <h3><?php echo $data['collegeClassCardHeader']; ?></h3>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="row justify-content-center mb-2">
                            <h4>First Year</h4>
                        </div>

                        <div class="row">
                            <?php if (!empty($data['getSubject11'])) : ?>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="ml-3 mb-3">
                                                <h4>First Semester</h4>
                                            </div>
                                        </div>
                                        <?php foreach ($data['getSubject11'] as $subject11) : ?>
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <?php $viewDate11 = date("Y-m-d");
                                                    if ($viewDate11 >= $subject11->showDate) {
                                                        if ($subject11->file_grade === 'INC') {
                                                            if (!empty($subject11->completed)) {
                                                                echo $subject11->completed;
                                                            } else {
                                                                echo 'INC';
                                                            }
                                                        } else {
                                                            echo $subject11->file_grade;
                                                        }
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-3">
                                                    <?php echo $subject11->subject_code; ?>
                                                </div>
                                                <div class="col-7">
                                                    <?php echo $subject11->sdes; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($data['getSubject12'])) : ?>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="ml-3 mb-3">
                                                <h4>Second Semester</h4>
                                            </div>
                                        </div>
                                        <?php foreach ($data['getSubject12'] as $subject12) : ?>
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <?php $viewDate12 = date("Y-m-d");
                                                    if ($viewDate12 >= $subject12->showDate) {
                                                        if ($subject12->file_grade === 'INC') {
                                                            if (!empty($subject12->completed)) {
                                                                echo $subject12->completed;
                                                            } else {
                                                                echo 'INC';
                                                            }
                                                        } else {
                                                            echo $subject12->file_grade;
                                                        }
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-3">
                                                    <?php echo $subject12->subject_code; ?>
                                                </div>
                                                <div class="col-7">
                                                    <?php echo $subject12->sdes; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($data['getSubject21']) || !empty($data['getSubject22'])) : ?>
                            <div class="row justify-content-center mb-2">
                                <h4>Second Year</h4>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <?php if (!empty($data['getSubject21'])) : ?>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="ml-3 mb-3">
                                                <h4>First Semester</h4>
                                            </div>
                                        </div>
                                        <?php foreach ($data['getSubject21'] as $subject21) : ?>
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <?php $viewDate21 = date("Y-m-d");
                                                    if ($viewDate21 >= $subject21->showDate) {
                                                        if ($subject21->file_grade === 'INC') {
                                                            if (!empty($subject21->completed)) {
                                                                echo $subject21->completed;
                                                            } else {
                                                                echo 'INC';
                                                            }
                                                        } else {
                                                            echo $subject21->file_grade;
                                                        }
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-3">
                                                    <?php echo $subject21->subject_code; ?>
                                                </div>
                                                <div class="col-7">
                                                    <?php echo $subject21->sdes; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($data['getSubject22'])) : ?>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="ml-3 mb-3">
                                                <h4>Second Semester</h4>
                                            </div>
                                        </div>
                                        <?php foreach ($data['getSubject22'] as $subject22) : ?>
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <?php $viewDate22 = date("Y-m-d");
                                                    if ($viewDate22 >= $subject22->showDate) {
                                                        if ($subject22->file_grade === 'INC') {
                                                            if (!empty($subject22->completed)) {
                                                                echo $subject22->completed;
                                                            } else {
                                                                echo 'INC';
                                                            }
                                                        } else {
                                                            echo $subject22->file_grade;
                                                        }
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-3">
                                                    <?php echo $subject22->subject_code; ?>
                                                </div>
                                                <div class="col-7">
                                                    <?php echo $subject22->sdes; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                        <div class="row">
                            <?php if (!empty($data['getSubject23'])) : ?>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="ml-3 mb-3">
                                                <h4>Summer</h4>
                                            </div>
                                        </div>
                                        <?php foreach ($data['getSubject23'] as $subject23) : ?>
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <?php $viewDate23 = date("Y-m-d");
                                                    if ($viewDate23 >= $subject23->showDate) {
                                                        if ($subject23->file_grade === 'INC') {
                                                            if (!empty($subject23->completed)) {
                                                                echo $subject23->completed;
                                                            } else {
                                                                echo 'INC';
                                                            }
                                                        } else {
                                                            echo $subject23->file_grade;
                                                        }
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-3">
                                                    <?php echo $subject23->subject_code; ?>
                                                </div>
                                                <div class="col-7">
                                                    <?php echo $subject23->sdes; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($data['getSubject31']) || !empty($data['getSubject32']) || !empty($data['getSubject33'])) : ?>
                            <div class="row justify-content-center mb-2">
                                <h4>Third Year</h4>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <?php if (!empty($data['getSubject31'])) : ?>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="ml-3 mb-3">
                                                <h4>First Semester</h4>
                                            </div>
                                        </div>
                                        <?php foreach ($data['getSubject31'] as $subject31) : ?>
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <?php $viewDate31 = date("Y-m-d");
                                                    if ($viewDate31 >= $subject31->showDate) {
                                                        if ($subject31->file_grade === 'INC') {
                                                            if (!empty($subject31->completed)) {
                                                                echo $subject31->completed;
                                                            } else {
                                                                echo 'INC';
                                                            }
                                                        } else {
                                                            echo $subject31->file_grade;
                                                        }
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-3">
                                                    <?php echo $subject31->subject_code; ?>
                                                </div>
                                                <div class="col-7">
                                                    <?php echo $subject31->sdes; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($data['getSubject32'])) : ?>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="ml-3 mb-3">
                                                <h4>Second Semester</h4>
                                            </div>
                                        </div>
                                        <?php foreach ($data['getSubject32'] as $subject32) : ?>
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <?php $viewDate32 = date("Y-m-d");
                                                    if ($viewDate32 >= $subject32->showDate) {
                                                        if ($subject32->file_grade === 'INC') {
                                                            if (!empty($subject32->completed)) {
                                                                echo $subject32->completed;
                                                            } else {
                                                                echo 'INC';
                                                            }
                                                        } else {
                                                            echo $subject32->file_grade;
                                                        }
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-3">
                                                    <?php echo $subject32->subject_code; ?>
                                                </div>
                                                <div class="col-7">
                                                    <?php echo $subject32->sdes; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                        <div class="row">
                            <?php if (!empty($data['getSubject33'])) : ?>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="ml-3 mb-3">
                                                <h4>Summer</h4>
                                            </div>
                                        </div>
                                        <?php foreach ($data['getSubject33'] as $subject33) : ?>
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <?php $viewDate33 = date("Y-m-d");
                                                    if ($viewDate33 >= $subject33->showDate) {
                                                        if ($subject33->file_grade === 'INC') {
                                                            if (!empty($subject33->completed)) {
                                                                echo $subject33->completed;
                                                            } else {
                                                                echo 'INC';
                                                            }
                                                        } else {
                                                            echo $subject33->file_grade;
                                                        }
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-3">
                                                    <?php echo $subject33->subject_code; ?>
                                                </div>
                                                <div class="col-7">
                                                    <?php echo $subject33->sdes; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($data['getSubject41']) || !empty($data['getSubject42'])) : ?>
                            <div class="row justify-content-center mb-2">

                                <h4>Fourth Year</h4>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <?php if (!empty($data['getSubject41'])) : ?>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="ml-3 mb-3">
                                                <h4>First Semester</h4>
                                            </div>
                                        </div>
                                        <?php foreach ($data['getSubject41'] as $subject41) : ?>
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <?php $viewDate41 = date("Y-m-d");
                                                    if ($viewDate41 >= $subject41->showDate) {
                                                        if ($subject41->file_grade === 'INC') {
                                                            if (!empty($subject41->completed)) {
                                                                echo $subject41->completed;
                                                            } else {
                                                                echo 'INC';
                                                            }
                                                        } else {
                                                            echo $subject41->file_grade;
                                                        }
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-3">
                                                    <?php echo $subject41->subject_code; ?>
                                                </div>
                                                <div class="col-7">
                                                    <?php echo $subject41->sdes; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($data['getSubject42'])) : ?>
                                <div class="col-lg-6">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="ml-3 mb-3">
                                                <h4>Second Semester</h4>
                                            </div>
                                        </div>
                                        <?php foreach ($data['getSubject42'] as $subject42) : ?>
                                            <div class="row mb-2">
                                                <div class="col-2">
                                                    <?php $viewDate42 = date("Y-m-d");
                                                    if ($viewDate42 >= $subject42->showDate) {
                                                        if ($subject42->file_grade === 'INC') {
                                                            if (!empty($subject42->completed)) {
                                                                echo $subject42->completed;
                                                            } else {
                                                                echo 'INC';
                                                            }
                                                        } else {
                                                            echo $subject42->file_grade;
                                                        }
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-3">
                                                    <?php echo $subject42->subject_code; ?>
                                                </div>
                                                <div class="col-7">
                                                    <?php echo $subject42->sdes; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
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