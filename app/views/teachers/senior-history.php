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
                    <div class="card pl-0 pr-0 mt-3 heads">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4>Grade Summary</h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">
                                            <li class="breadcrumb-item ml-lg-auto"><a class="text-danger" href="<?php echo URLROOT; ?>/teachers/history">History</a></li>
                                            <li class="breadcrumb-item"><a class="text-danger" href="<?php echo URLROOT; ?>/teachers/senior_history_list/<?php echo $data['subjectId'] . '/'  . $data['sem'] . '/' . $data['schoolYear']; ?>">Student List</a></li>
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
                                <h5> <?php echo 'SY: ' . $data['schoolYear'] . ' - ' . $data['sem'] . ' - Sem'; ?></h5>
                                <h5> <?php echo 'Grade - 1' . $data['yearLevel']; ?></h5>
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

                                                    <th>Full Name</th>
                                                    <th></th>
                                                    <th colspan="2">
                                                        <?php if ($data['sem'] == 1) {
                                                            echo '1st';
                                                        } elseif ($data['sem'] == 2) {
                                                            echo '3rd';
                                                        } ?>
                                                    </th>

                                                    <th></th>
                                                    <th colspan="2">
                                                        <?php if ($data['sem'] == 1) {
                                                            echo '2nd';
                                                        } elseif ($data['sem'] == 2) {
                                                            echo '4th';
                                                        } ?>
                                                    </th>
                                                    <th></th>
                                                    <th>Final Grade</th>
                                                    <th>Remarks</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <div id="outputJr">
                                                    <?php foreach ($data['studentInfo'] as $studentInfos) : ?>
                                                        <tr>

                                                            <td data-label="Full Name">
                                                                <?php echo $studentInfos->lname . ', ' . $studentInfos->fname . ' ' . $studentInfos->mname; ?>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <td data-label="Initial">
                                                                <?php echo $studentInfos->fig; ?>
                                                            </td>
                                                            <td data-label="1st Quarter">
                                                                <?php echo $studentInfos->fqg; ?>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <td data-label="Initial">
                                                                <?php echo $studentInfos->sig; ?>
                                                            </td>
                                                            <td data-label="2nd Quarter">
                                                                <?php echo $studentInfos->sqg; ?>
                                                            </td>
                                                            <td>

                                                            </td>


                                                            <td data-label="Final">
                                                                <?php echo $studentInfos->final_grade; ?>
                                                            </td>
                                                            <td data-label="Remarks">
                                                                <?php echo $studentInfos->grade_remarks; ?>
                                                            </td>
                                                        </tr>

                                                    <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row mx-auto">

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


<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
    $(document).ready(function() {
        $('#prints').click(function() {

            window.print();
        });



    });
</script>