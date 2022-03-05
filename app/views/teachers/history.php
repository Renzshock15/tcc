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
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/teachers/my_class" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="far fa-address-book text-light fa-lg mr-3"></i>Class Record</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/teachers/history" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-history text-light fa-lg mr-3"></i>History</a></li>
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
                                    <h4>History</h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">
                                            <li class="breadcrumb-item active ml-lg-auto" aria-current="page">History</li>
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

                            <div class="tableHeader">
                                <div class="tableHeaderContent">
                                    <strong>Kinder - Grade 10</strong>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-8">
                                    <form class="form-inline" method="POST" action="<?php echo URLROOT; ?>/teachers/history">
                                        <div class="form-group  mb-2">
                                            <label for="inputPassword2" class="sr-only">Password</label>
                                            <input type="text" class="form-control txtSearch" id="inputPassword2" placeholder="Search" name="txtSearchj">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2 ml-2 btnSearch" name="btnSearchj">Search</button>

                                    </form>
                                </div>
                                <div class="col-lg-4">

                                </div><!-- end col-->
                            </div>
                            <?php if (!empty($data['subjects'])) : ?>
                                <div class="table-responsive mb-5">
                                    <table class="tables">
                                        <thead>
                                            <tr>
                                                <th>Subjects</th>
                                                <th>Description</th>
                                                <th>Level</th>
                                                <th>Scool Year</th>

                                                <th width="10%">View Students</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['subjects'] as $subject) : ?>
                                                <tr>
                                                    <td data-label="Subjects">
                                                        <a href="<?php echo URLROOT; ?>/teachers/junior_history_list/<?php echo $subject->subject_id . '/' . $subject->school_year; ?>" class="text-body font-weight-bold"><?php echo $subject->subject_name; ?></a>
                                                    </td>
                                                    <td data-label="Description">
                                                        <?php echo $subject->subject_description; ?>
                                                    </td>
                                                    <td data-label="Level">
                                                        <?php echo $subject->grade_level; ?>
                                                    </td>

                                                    <td data-label="Schedule">
                                                        <?php echo $subject->school_year; ?>
                                                    </td>

                                                    <td data-label="View Students">
                                                        <a class="btn btn-danger" href="<?php echo URLROOT; ?>/teachers/junior_history_list/<?php echo $subject->subject_id . '/' . $subject->school_year; ?>" role="button"><i class="fas fa-users text-light fa-lg mr-1"></i> View</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>

                            <div class="tableHeader">
                                <div class="tableHeaderContent">
                                    <strong>Senior High School</strong>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-8">
                                    <form class="form-inline" method="POST" action="<?php echo URLROOT; ?>/teachers/history">
                                        <div class="form-group  mb-2">
                                            <label for="inputPassword2" class="sr-only">Password</label>
                                            <input type="text" class="form-control txtSearch" id="inputPassword2" placeholder="Search" name="txtSearchs">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2 ml-2 btnSearch" name="btnSearchs">Search</button>

                                    </form>
                                </div>
                                <div class="col-lg-4">

                                </div><!-- end col-->
                            </div>
                            <?php if (!empty($data['subjectsSr'])) : ?>
                                <div class="table-responsive mb-5">
                                    <table class="tables">
                                        <thead>
                                            <tr>
                                                <th>Subjects</th>
                                                <th>Description</th>
                                                <th>Level</th>
                                                <th>Semester</th>
                                                <th>School Year</th>

                                                <th width="10%">View Students</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['subjectsSr'] as $subjectSr) : ?>
                                                <tr>
                                                    <td data-label="Subjects">
                                                        <a href="<?php echo URLROOT; ?>/teachers/senior_history_list/<?php echo $subjectSr->subject_id . '/' . $subjectSr->subject_term . '/' . $subjectSr->school_year; ?>" class="text-body font-weight-bold"><?php echo $subjectSr->subject_name; ?></a>
                                                    </td>
                                                    <td data-label="Description">
                                                        <?php echo $subjectSr->subject_description; ?>
                                                    </td>
                                                    <td data-label="Level">
                                                        <?php echo $subjectSr->year_level; ?>
                                                    </td>
                                                    <td data-label="Semester">
                                                        <?php if ($subjectSr->subject_term == 1) {
                                                            echo '1st';
                                                        } else {
                                                            echo '2nd';
                                                        } ?>
                                                    </td>
                                                    <td data-label="School_year">
                                                        <?php echo $subjectSr->school_year; ?>
                                                    </td>

                                                    <td data-label="View Students">
                                                        <a class="btn btn-danger" href="<?php echo URLROOT; ?>/teachers/senior_history_list/<?php echo $subjectSr->subject_id . '/' . $subjectSr->subject_term . '/' . $subjectSr->school_year; ?>" role="button"><i class="fas fa-users text-light fa-lg mr-1"></i> View</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>

                            <div class="tableHeader">
                                <div class="tableHeaderContent">
                                    <strong>Higher Level</strong>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-8">
                                    <form class="form-inline" method="POST" action="<?php echo URLROOT; ?>/teachers/history">
                                        <div class="form-group  mb-2">
                                            <label for="inputPassword2" class="sr-only">Password</label>
                                            <input type="text" class="form-control txtSearch" id="inputPassword2" placeholder="Search" name="txtSearchc">
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2 ml-2 btnSearch" name="btnSearchc">Search</button>

                                    </form>
                                </div>
                                <div class="col-lg-4">

                                </div><!-- end col-->
                            </div>
                            <?php if (!empty($data['subjectsCollege'])) : ?>
                                <div class="table-responsive mb-5">
                                    <table class="tables">
                                        <thead>
                                            <tr>
                                                <th>Subjects</th>
                                                <th>Description</th>
                                                <th>Level</th>
                                                <th>Semester</th>
                                                <th>School Year</th>

                                                <th width="10%">View Students</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['subjectsCollege'] as $subjectCollege) : ?>
                                                <tr>
                                                    <td data-label="Subjects">
                                                        <a href="<?php echo URLROOT; ?>/teachers/higher_history_list/<?php echo $subjectCollege->sched_id . '/' . $subjectCollege->semester . '/' . $subjectCollege->school_year; ?>" class="text-body font-weight-bold"><?php echo $subjectCollege->subject_name; ?></a>
                                                    </td>
                                                    <td data-label="Description">
                                                        <?php echo $subjectCollege->subject_description; ?>
                                                    </td>
                                                    <td data-label="Level">
                                                        <?php echo $subjectCollege->year_level; ?>
                                                    </td>
                                                    <td data-label="Semester">
                                                        <?php if ($subjectCollege->semester == 1) {
                                                            echo '1st';
                                                        } elseif ($subjectCollege->semester == 2) {
                                                            echo '2nd';
                                                        } else {
                                                            echo 'Summer';
                                                        } ?>
                                                    </td>
                                                    <td data-label="School Year">
                                                        <?php echo $subjectCollege->school_year; ?>
                                                    </td>

                                                    <td data-label="View Students">
                                                        <a class="btn btn-danger" href="<?php echo URLROOT; ?>/teachers/higher_history_list/<?php echo $subjectCollege->sched_id . '/' . $subjectCollege->semester . '/' . $subjectCollege->school_year; ?>" role="button"><i class="fas fa-users text-light fa-lg mr-1"></i> View</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>


                            <?php if (empty($data['subjects']) && empty($data['subjectsSr']) && empty($data['subjectsCollege'])) : ?>
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