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
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/student_records" class="nav-link text-white p-3 mb-2 current"><i class="far fa-folder text-light fa-lg mr-3"></i>Records</a></li>';
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
                                    <h4>Grade Records</h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">
                                            <li class="breadcrumb-item ml-lg-auto"> <a class="text-danger" href="<?php echo URLROOT; ?>/registrars/student_records">Levels</a></li>
                                            <li class="breadcrumb-item "> <a class="text-danger" href="<?php echo URLROOT; ?>/registrars/junior_master_list">Student List</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Grades</li>
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


                        <div class="card-header bg-white">
                            <div class="mt-3">
                                <h5><?php echo $data['studentName']; ?></h5>
                                <h5><?php echo $data['studentNo']; ?></h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="addGradeRecord">
                                <form>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">School Name</label>
                                            <input type="text" class="form-control schoolName" id="inputEmail4">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputState">School Year</label>
                                            <select id="schoolYear" class="form-control">
                                                <option selected>Choose...</option>
                                                <option value="2010-2011">2010-2011</option>
                                                <option value="2011-2012">2011-2012</option>
                                                <option value="2012-2013">2012-2013</option>
                                                <option value="2013-2014">2013-2014</option>
                                                <option value="2014-2015">2014-2015</option>
                                                <option value="2015-2016">2015-2016</option>
                                                <option value="2016-2017">2016-2017</option>
                                                <option value="2017-2018">2017-2018</option>
                                                <option value="2018-2019">2018-2019</option>
                                                <option value="2019-2020">2019-2020</option>
                                                <?php foreach ($data['schoolYear'] as $schoolYear) : ?>
                                                    <option value="<?php echo $schoolYear->term_name; ?>"><?php echo $schoolYear->term_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputState">Grade Level</label>
                                            <select id="gradeLevel" class="form-control">
                                                <option selected>Choose...</option>
                                                <option value="sped">Sped</option>
                                                <option value="kinder_1">Kinder 1</option>
                                                <option value="kinder_2">Kinder 2</option>
                                                <option value="1">Grade 1</option>
                                                <option value="2">Grade 2</option>
                                                <option value="3">Grade 3</option>
                                                <option value="4">Grade 4</option>
                                                <option value="5">Grade 5</option>
                                                <option value="6">Grade 6</option>
                                                <option value="7">Grade 7</option>
                                                <option value="8">Grade 8</option>
                                                <option value="9">Grade 9</option>
                                                <option value="10">Grade 10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="table-responsive">
                                            <table class="tablesgrade" id="insertData">
                                                <thead>
                                                    <tr>
                                                        <th>Subject</th>
                                                        <th>Description</th>

                                                        <th width="5%">1st</th>
                                                        <th width="5%">2nd</th>
                                                        <th width="5%">3rd</th>
                                                        <th width="5%">4th</th>
                                                        <th width="5%">Final</th>
                                                        <th width="10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="rows">
                                                        <td data-label="Subject" contenteditable="true" class="colSubject"></td>
                                                        <td data-label="Description" contenteditable="true" class="colDes"></td>

                                                        <td data-label="1st" contenteditable="true" class="col1st"></td>
                                                        <td data-label="2nd" contenteditable="true" class="col2nd"></td>
                                                        <td data-label="3rd" contenteditable="true" class="col3rd"></td>
                                                        <td data-label="4th" contenteditable="true" class="col4th"></td>
                                                        <td data-label="Final" contenteditable="true" class="colFin"></td>
                                                        <td>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-success mb-3 mt-3 addCol" id="addCol"><i class="fas fa-plus"></i></button>
                                    <button type="button" class="btn btn-primary float-right mb-3 mt-3 saveData"><i class="far fa-save"></i> Save Record</button>
                                </form>

                            </div>
                            <div>
                                <div class="table-responsive mb-5">
                                    <table class="tablesgrade" id="recordsTable">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Subject</th>
                                                <th colspan="4">Quarter</th>
                                                <th rowspan="2">Final Avg</th>
                                                <th rowspan="2">School Year</th>
                                                <th rowspan="2">Level</th>
                                                <th rowspan="2">School</th>
                                                <th rowspan="2" width="5%">Action</th>
                                            </tr>
                                            <tr>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($data['gradelist'])) : ?>

                                                <?php foreach ($data['gradelist'] as $subjectList) : ?>
                                                    <tr class="">
                                                        <td class="recRow" data-label="Learning Area" data-id="<?php echo $subjectList->recId; ?>" data-school="<?php echo $subjectList->school; ?>">
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
                                                        <td data-label="School Year">
                                                            <?php echo $subjectList->school_year; ?>
                                                        </td>
                                                        <td data-label="Level">
                                                            <?php echo $subjectList->grade_level; ?>
                                                        </td>
                                                        <td class="schoolRow" data-label="School Name" data-id="<?php echo $subjectList->recId; ?>" data-school="<?php echo $subjectList->school; ?>">
                                                            <?php echo $subjectList->school_name; ?>
                                                        </td>
                                                        <td data-label="Action">
                                                            <button type="button" class="btn btn-danger btnDelete" data-id="<?php echo $subjectList->recId; ?>" data-school="<?php echo $subjectList->school; ?>"><i class="far fa-trash-alt"></i></button>
                                                        </td>


                                                    </tr>

                                                <?php endforeach; ?>

                                            <?php endif; ?>

                                        </tbody>

                                    </table>

                                    <?php if (empty($data['gradelist'])) : ?>
                                        <div class="mt-2">
                                            <h3>No Records Available</h3>
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
</section>
<!--end of content-->
<div class="modal" tabindex="-1" id="confirmModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelModalsss" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveRec">Save records</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the record?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelModalsss" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary deleteRec">Delete record</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="editShcool">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit School Name</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">School Name</label>
                    <input type="text" class="form-control editSchool" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelModalsss" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary updateSchool">Update records</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="editModal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Records</h5>
                <button type="button" class="close cancelModalsss" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Subject</label>
                    <input type="text" class="form-control editSubject" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">1st</label>
                        <input type="text" class="form-control first" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">2nd</label>
                        <input type="text" class="form-control second" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">3rd</label>
                        <input type="text" class="form-control third" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEmail4">4th</label>
                        <input type="text" class="form-control fourth" id="inputEmail4">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Final</label>
                        <input type="text" class="form-control final" id="inputEmail4">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputState">School Year</label>
                        <select id="editSchoolYear" class="form-control">
                            <option selected>Choose...</option>
                            <option value="2010-2011">2010-2011</option>
                            <option value="2011-2012">2011-2012</option>
                            <option value="2012-2013">2012-2013</option>
                            <option value="2013-2014">2013-2014</option>
                            <option value="2014-2015">2014-2015</option>
                            <option value="2015-2016">2015-2016</option>
                            <option value="2016-2017">2016-2017</option>
                            <option value="2017-2018">2017-2018</option>
                            <option value="2018-2019">2018-2019</option>
                            <option value="2019-2020">2019-2020</option>
                            <?php foreach ($data['schoolYear'] as $schoolYear) : ?>
                                <option value="<?php echo $schoolYear->term_name; ?>"><?php echo $schoolYear->term_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">Grade Level</label>
                        <select id="editGradeLevel" class="form-control">
                            <option selected>Choose...</option>
                            <option value="sped">Sped</option>
                            <option value="kinder_1">Kinder 1</option>
                            <option value="kinder_2">Kinder 2</option>
                            <option value="1">Grade 1</option>
                            <option value="2">Grade 2</option>
                            <option value="3">Grade 3</option>
                            <option value="4">Grade 4</option>
                            <option value="5">Grade 5</option>
                            <option value="6">Grade 6</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelModalsss" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary updateRec">Update records</button>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
    $(document).ready(function() {
        var count = 1;
        $('#addCol').click(function() {
            count = count + 1;
            var newRow = '<tr id="rows' + count + '">';
            newRow += '<td data-label="Subject" contenteditable="true" class="colSubject"></td>';
            newRow += '<td data-label="Description" contenteditable="true" class="colDes"></td>';
            newRow += '<td data-label="1st" contenteditable="true" class="col1st"></td>';
            newRow += '<td data-label="2nd" contenteditable="true" class="col2nd"></td>';
            newRow += '<td data-label="3rd" contenteditable="true" class="col3rd"></td>';
            newRow += '<td data-label="4th" contenteditable="true" class="col4th"></td>';
            newRow += '<td data-label="Final" contenteditable="true" class="colFin"></td>';
            newRow += '<td><button type="button" name="remove" data-row="rows' + count + '" class="btn btn-danger remove"><i class="fas fa-minus"></i></button></td>'
            newRow += '</tr>'
            $('#insertData').append(newRow);
        });
        $(document).on('click', '.remove', function() {
            var deletes = $(this).data('row');
            $('#' + deletes).remove();
        });

        $('.saveData').click(function() {
            var infoId = '<?php echo $data['infoId']; ?>';
            var studentNo = '<?php echo $data['studentNo']; ?>';
            var schoolName = $('.schoolName').val();
            var schoolYear = $('#schoolYear').val();
            var gradeLevel = $('#gradeLevel').val();
            var tableData = {
                subject: [],
                description: [],
                first: [],
                second: [],
                third: [],
                fourth: [],
                final: []
            }

            $('.colSubject').each(function() {
                tableData.subject.push($(this).text());
            });
            $('.colDes').each(function() {
                tableData.description.push($(this).text());
            });
            $('.col1st').each(function() {
                tableData.first.push($(this).text());
            });
            $('.col2nd').each(function() {
                tableData.second.push($(this).text());
            });
            $('.col3rd').each(function() {
                tableData.third.push($(this).text());
            });
            $('.col4th').each(function() {
                tableData.fourth.push($(this).text());
            });
            $('.colFin').each(function() {
                tableData.final.push($(this).text());
            });

            var notBlankSubject = checkIfBlank(tableData.subject);
            var notBlankDescription = checkIfBlank(tableData.description);
            var notBlankFirst = checkIfBlank(tableData.first);
            var notBlankSecond = checkIfBlank(tableData.second);
            var notBlankThird = checkIfBlank(tableData.third);
            var notBlankFourth = checkIfBlank(tableData.fourth);
            var notBlankFinal = checkIfBlank(tableData.final);

            if (notBlankSubject === true && notBlankFirst === true && notBlankSecond === true &&
                notBlankThird === true && notBlankFourth === true && notBlankFinal === true && schoolName != '' && schoolYear != 'Choose...' && gradeLevel != 'Choose...') {
                var notNumericFirst = checkIfNumeric(tableData.first);
                var notNumericSecond = checkIfNumeric(tableData.second);
                var notNumericThird = checkIfNumeric(tableData.third);
                var notNumericFourth = checkIfNumeric(tableData.fourth);
                var notNumericFinal = checkIfNumeric(tableData.final);
                if (notNumericFirst === true && notNumericSecond === true && notNumericThird === true && notNumericFourth === true && notNumericFinal === true) {
                    $('#confirmModal').show();

                    $('.saveRec').click(function() {
                        $.ajax({
                            url: '<?php echo URLROOT ?>' + '/Actions/insertMultyJuniorRecord',
                            method: 'post',
                            data: {
                                schoolName: schoolName,
                                schoolYear: schoolYear,
                                gradeLevel: gradeLevel,
                                tableData: tableData,
                                infoId: infoId,
                                studentNo: studentNo,
                                count: count
                            },
                            success: function(response) {
                                alert(response);
                                $('#confirmModal').hide();
                                location.reload();
                            }
                        });
                    });
                    closeModal()
                } else {
                    alert('The set of grades you enter has non numeric character');
                }
            } else {
                alert('Please complete all the blank fields');
            }
        });

        $('#recordsTable tbody').on('click', '.recRow', function() {
            var recId = $(this).data('id');
            var schoolId = $(this).data('school');

            if (schoolId == 1) {
                alert('Sorry you cannot edit grade from our school');
            } else {
                var currow = $(this).closest('tr');
                var subjectName = currow.find('td:eq(0)').text();
                var grades = {
                    first: currow.find('td:eq(1)').text(),
                    second: currow.find('td:eq(2)').text(),
                    third: currow.find('td:eq(3)').text(),
                    fourth: currow.find('td:eq(4)').text(),
                    final: currow.find('td:eq(5)').text()
                };
                var schoolYear = currow.find('td:eq(6)').text();
                var gradeLevel = currow.find('td:eq(7)').text();
                $('.editSubject').val(subjectName.trim());
                $('.first').val(grades.first.trim());
                $('.second').val(grades.second.trim());
                $('.third').val(grades.third.trim());
                $('.fourth').val(grades.fourth.trim());
                $('.final').val(grades.final.trim());
                $('#editSchoolYear').val(schoolYear.trim());
                $('#editGradeLevel').val(gradeLevel.trim());
                $('#editModal').toggle();

                $('.updateRec').click(function() {
                    if ($('.editSubject').val() === '' || $('.first').val() === '' || $('.second').val() === '' || $('.third').val() === '' ||
                        $('.fourth').val() === '' || $('.final').val() === '' || $('#editSchoolYear').val() === 'Choose...' || $('#editGradeLevel').val() === 'Choose') {
                        alert('Please complete all fields');
                    } else {
                        var newGrade = {
                            first: $('.first').val(),
                            second: $('.second').val(),
                            third: $('.third').val(),
                            fourth: $('.fourth').val(),
                            final: $('.final').val()
                        };

                        if (checkIfNumeric(newGrade)) {
                            $.ajax({
                                url: '<?php echo URLROOT ?>' + '/Actions/updateMultyJuniorRecord',
                                method: 'post',
                                data: {
                                    recId: recId,
                                    subject: $('.editSubject').val(),
                                    newGrade: newGrade,
                                    schoolYear: $('#editSchoolYear').val(),
                                    gradeLevel: $('#editGradeLevel').val()

                                },
                                success: function(response) {
                                    alert(response);
                                    $('#editModal').hide();
                                    location.reload();
                                }
                            });
                        } else {
                            alert('Sorry the grade you enter has invalid character');
                        }
                    }
                });
                closeModal()
            }
        });

        $('#recordsTable tbody').on('click', '.schoolRow', function() {
            var schoolId = $(this).data('school');

            if (schoolId == 1) {
                alert('Sorry you cannot edit this school name');
            } else {
                var currow = $(this).closest('tr');
                var schoolName = currow.find('td:eq(8)').text();
                $('.editSchool').val(schoolName.trim());

                $('#editShcool').toggle();

                $('.updateSchool').click(function() {
                    if ($('.editSchool').val() === '') {
                        alert('Please complete the field');
                    } else {
                        $.ajax({
                            url: '<?php echo URLROOT ?>' + '/Actions/updateJuniorSchool',
                            method: 'post',
                            data: {
                                newSchool: $('.editSchool').val(),
                                schoolId: schoolId
                            },
                            success: function(response) {
                                alert(response);
                                $('#editShcool').hide();
                                location.reload();
                            }
                        });
                    }
                });
                closeModal()
            }
        });

        $('.btnDelete').click(function() {
            var recId = $(this).data('id');
            var schoolId = $(this).data('school');

            if (schoolId == 1) {
                alert('This record cannot be deleted');
            } else {
                $('#deleteModal').toggle();

                $('.deleteRec').click(function() {
                    $.ajax({
                        url: '<?php echo URLROOT ?>' + '/Actions/deleteJuniorMultyRecords',
                        method: 'post',
                        data: {
                            recId: recId
                        },
                        success: function(response) {
                            alert(response);
                            $('#deleteModal').hide();
                            location.reload();
                        }
                    });
                });
                closeModal()
            }
        });

    });



    function checkIfBlank(items) {
        var result = 0;

        for (var key in items) {
            var remarks = $.trim(items[key]);
            //console.log(activity);

            console.log(remarks);
            if (remarks === '') {
                result = result + 1;
            }
        }
        //console.log(result);

        if (result > 0) {
            return false;
        } else {
            return true;
        }

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
            return false;
        } else {
            return true;
        }

    }

    function closeModal() {
        $('.cancelModalsss').click(function() {
            location.reload();
        });
    }
</script>