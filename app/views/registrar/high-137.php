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
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/junior_records" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-address-card text-light fa-lg mr-3"></i>Junior</a></li>';
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/senior_records" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-address-card text-light fa-lg mr-3"></i>Senior</a></li>';
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
                                            <li class="breadcrumb-item ml-lg-auto"> <a class="text-danger" href="<?php echo URLROOT; ?>/registrars/junior_records">Levels</a></li>
                                            <li class="breadcrumb-item "> <a class="text-danger" href="<?php echo URLROOT; ?>/registrars/junior_list3">Student List</a></li>
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

                            <button class="btn btn-dark float-right prints" id="prints" href="" data-id="<?php echo $admins->id; ?>" role="button"><i class="fas fa-print"></i> Print</button>

                        </div>
                        <div class="printable" id="printable">
                            <div class="row mt-5 justify-content-center">
                                <img src="<?php echo URLROOT; ?>/images/tcclogo.png" width="80px" height="80px" alt="">
                                <div class="pl-2 pr-2">
                                    <h5 class="mt-4">TOMAS CALUDIO COLLEGES</h5>
                                    <h7 class="ml-4">Taghangin Morong, Rizal</h7>
                                </div>
                            </div>
                            <div class="row mt-4 justify-content-center">
                                <h5 class=""><strong>Basic Education Department</strong></h5>
                            </div>
                            <div class="row mb-5 justify-content-center">
                                <h6 class=""><strong>Junior High School</strong></h6>
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
                                <div class="col-md-6 ml-lg-5 ml-2">

                                    <h5><strong>Address:</strong> <?php echo $data['address']; ?></h5>
                                </div>
                                <div class="col-md-3 ml-lg-5 ml-2">
                                    <h5><strong>Gender:</strong> <?php if ($data['gender'] === 'm') {
                                                                        echo 'Male';
                                                                    } else {
                                                                        echo 'Female';
                                                                    } ?></h5>
                                </div>

                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4 ml-lg-5 ml-2">
                                    <h5><strong>Guardian:</strong> <?php echo $data['guardian']; ?></h5>
                                </div>
                                <div class="col-md-3 ml-lg-5 ml-2">
                                    <h5><strong>Address:</strong> <?php echo $data['guardianAdd']; ?></h5>
                                </div>
                                <div class="col-md-3 ml-lg-5 ml-2">
                                    <h5><strong>Relation:</strong> <?php echo $data['relation']; ?></h5>
                                </div>
                            </div>



                            <div class="row mx-1 mt-5">

                                <div class="col-lg-6 printWidth">
                                    <div>
                                        <h5><strong>School Year:</strong> <?php echo $data['schoolYear7']; ?></h5>
                                    </div>
                                    <div class="mt-2">
                                        <h5><strong>Grade 7 - Shool:</strong> <?php echo $data['school7']; ?></h5>
                                    </div>

                                    <div class="table-responsive mb-5">
                                        <table class="tablesgrade">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">Learning Area</th>
                                                    <th colspan="4">Periodic Rating</th>
                                                    <th rowspan="2">Final Avg</th>
                                                </tr>
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($data['grade7'])) : ?>
                                                    <?php $grade7Count = 0;
                                                    $grade7Avg = 0; ?>
                                                    <?php foreach ($data['grade7'] as $subjectList) : ?>
                                                        <tr>
                                                            <td data-label="Learning Area">
                                                                <?php echo  $subjectList->subject_name; ?>
                                                            </td>
                                                            <td data-label="1">
                                                                <?php echo $subjectList->fqg; ?>
                                                            </td>
                                                            <td data-label="2">
                                                                <?php echo $subjectList->sqg; ?>
                                                            </td>
                                                            <td data-label="3">
                                                                <?php echo $subjectList->tqg; ?>
                                                            </td>
                                                            <td data-label="4">
                                                                <?php echo $subjectList->foqg; ?>
                                                            </td>
                                                            <td data-label="Avg">
                                                                <?php echo $subjectList->final_grade; ?>
                                                            </td>
                                                        </tr>
                                                        <?php $grade7Count = $grade7Count + 1;
                                                        $grade7Avg = $grade7Avg + $subjectList->final_grade; ?>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="5">
                                                            <h7><strong>General Average</strong></h7>
                                                        </td>
                                                        <td>
                                                            <h7><strong><?php echo  round($grade7Avg / $grade7Count, 2); ?></strong></h7>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>

                                            </tbody>

                                        </table>
                                        <?php if (!empty($data['grade7'])) : ?>
                                            <div class="mt-3">
                                                <h5>Eligebility for admission to Grade 8</h5>
                                            </div>
                                            <div class="mt-3">
                                                <h5>Signature of Adviser: ______________</h5>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (empty($data['grade7'])) : ?>
                                            <div class="mt-2">
                                                <h3>No Preview Available</h3>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="col-lg-6 printWidth">
                                    <div>
                                        <h5><strong>School Year:</strong> <?php echo $data['schoolYear8']; ?></h5>
                                    </div>
                                    <div class="mt-2">
                                        <h5><strong>Grade 8 - Shool:</strong> <?php echo $data['school8']; ?></h5>
                                    </div>
                                    <div class="table-responsive mb-5">
                                        <table class="tablesgrade">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">Learning Area</th>
                                                    <th colspan="4">Periodic Rating</th>
                                                    <th rowspan="2">Final Avg</th>
                                                </tr>
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($data['grade8'])) : ?>
                                                    <?php $grade8Count = 0;
                                                    $grade8Avg = 0; ?>
                                                    <?php foreach ($data['grade8'] as $subjectList) : ?>
                                                        <tr>
                                                            <td data-label="Learning Area">
                                                                <?php echo  $subjectList->subject_name; ?>
                                                            </td>
                                                            <td data-label="1">
                                                                <?php echo $subjectList->fqg; ?>
                                                            </td>
                                                            <td data-label="2">
                                                                <?php echo $subjectList->sqg; ?>
                                                            </td>
                                                            <td data-label="3">
                                                                <?php echo $subjectList->tqg; ?>
                                                            </td>
                                                            <td data-label="4">
                                                                <?php echo $subjectList->foqg; ?>
                                                            </td>
                                                            <td data-label="Avg">
                                                                <?php echo $subjectList->final_grade; ?>
                                                            </td>
                                                        </tr>
                                                        <?php $grade8Count = $grade8Count + 1;
                                                        $grade8Avg = $grade8Avg + $subjectList->final_grade; ?>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="5">
                                                            <h7><strong>General Average</strong></h7>
                                                        </td>
                                                        <td>
                                                            <h7><strong><?php echo  round($grade8Avg / $grade8Count, 2); ?></strong></h7>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>

                                            </tbody>

                                        </table>
                                        <?php if (!empty($data['grade8'])) : ?>
                                            <div class="mt-3">
                                                <h5>Eligebility for admission to Grade 9</h5>
                                            </div>
                                            <div class="mt-3">
                                                <h5>Signature of Adviser: ______________</h5>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (empty($data['grade8'])) : ?>
                                            <div class="mt-2">
                                                <h3>No Preview Available</h3>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                            <!--Grade 3-4-->
                            <div class="row mx-1 mt-5">

                                <div class="col-lg-6 printWidth">
                                    <div>
                                        <h5><strong>School Year:</strong> <?php echo $data['schoolYear9']; ?></h5>
                                    </div>
                                    <div class="mt-2">
                                        <h5><strong>Grade 9 - Shool:</strong> <?php echo $data['school9']; ?></h5>
                                    </div>

                                    <div class="table-responsive mb-5">
                                        <table class="tablesgrade">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">Learning Area</th>
                                                    <th colspan="4">Periodic Rating</th>
                                                    <th rowspan="2">Final Avg</th>
                                                </tr>
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($data['grade9'])) : ?>
                                                    <?php $grade9Count = 0;
                                                    $grade9Avg = 0; ?>
                                                    <?php foreach ($data['grade9'] as $subjectList) : ?>
                                                        <tr>
                                                            <td data-label="Learning Area">
                                                                <?php echo  $subjectList->subject_name; ?>
                                                            </td>
                                                            <td data-label="1">
                                                                <?php echo $subjectList->fqg; ?>
                                                            </td>
                                                            <td data-label="2">
                                                                <?php echo $subjectList->sqg; ?>
                                                            </td>
                                                            <td data-label="3">
                                                                <?php echo $subjectList->tqg; ?>
                                                            </td>
                                                            <td data-label="4">
                                                                <?php echo $subjectList->foqg; ?>
                                                            </td>
                                                            <td data-label="Avg">
                                                                <?php echo $subjectList->final_grade; ?>
                                                            </td>
                                                        </tr>
                                                        <?php $grade9Count = $grade9Count + 1;
                                                        $grade9Avg = $grade9Avg + $subjectList->final_grade; ?>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="5">
                                                            <h7><strong>General Average</strong></h7>
                                                        </td>
                                                        <td>
                                                            <h7><strong><?php echo  round($grade9Avg / $grade9Count, 2); ?></strong></h7>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>

                                            </tbody>

                                        </table>
                                        <?php if (!empty($data['grade9'])) : ?>
                                            <div class="mt-3">
                                                <h5>Eligebility for admission to Grade 10</h5>
                                            </div>
                                            <div class="mt-3">
                                                <h5>Signature of Adviser: ______________</h5>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (empty($data['grade9'])) : ?>
                                            <div class="mt-2">
                                                <h3>No Preview Available</h3>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="col-lg-6 printWidth">
                                    <div>
                                        <h5><strong>School Year:</strong> <?php echo $data['schoolYear10']; ?></h5>
                                    </div>
                                    <div class="mt-2">
                                        <h5><strong>Grade 10 - Shool:</strong> <?php echo $data['school10']; ?></h5>
                                    </div>
                                    <div class="table-responsive mb-5">
                                        <table class="tablesgrade">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">Learning Area</th>
                                                    <th colspan="4">Periodic Rating</th>
                                                    <th rowspan="2">Final Avg</th>
                                                </tr>
                                                <tr>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($data['grade10'])) : ?>
                                                    <?php $grade10Count = 0;
                                                    $grade10Avg = 0; ?>
                                                    <?php foreach ($data['grade10'] as $subjectList) : ?>
                                                        <tr>
                                                            <td data-label="Learning Area">
                                                                <?php echo  $subjectList->subject_name; ?>
                                                            </td>
                                                            <td data-label="1">
                                                                <?php echo $subjectList->fqg; ?>
                                                            </td>
                                                            <td data-label="2">
                                                                <?php echo $subjectList->sqg; ?>
                                                            </td>
                                                            <td data-label="3">
                                                                <?php echo $subjectList->tqg; ?>
                                                            </td>
                                                            <td data-label="4">
                                                                <?php echo $subjectList->foqg; ?>
                                                            </td>
                                                            <td data-label="Avg">
                                                                <?php echo $subjectList->final_grade; ?>
                                                            </td>
                                                        </tr>
                                                        <?php $grade10Count = $grade10Count + 1;
                                                        $grade10Avg = $grade10Avg + $subjectList->final_grade; ?>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="5">
                                                            <h7><strong>General Average</strong></h7>
                                                        </td>
                                                        <td>
                                                            <h7><strong><?php echo  round($grade10Avg / $grade10Count, 2); ?></strong></h7>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>

                                            </tbody>

                                        </table>
                                        <?php if (!empty($data['grade10'])) : ?>
                                            <div class="mt-3">
                                                <h5>Eligebility for admission to College</h5>
                                            </div>
                                            <div class="mt-3">
                                                <h5>Signature of Adviser: ______________</h5>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (empty($data['grade10'])) : ?>
                                            <div class="mt-2">
                                                <h3>No Preview Available</h3>
                                            </div>
                                        <?php endif; ?>
                                    </div>
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