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
                            echo '<li class="nav-item"><a href="' . URLROOT . '/registrars/student_subjects" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-book-open text-light fa-lg mr-3"></i>Subjects</a></li>';
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
                                    <h4>Subjects</h4>
                                </div>
                                <div class="col-lg-6">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb pl-0 pt-0 bg-white">
                                            <li class="breadcrumb-item ml-lg-auto"> <a class="text-danger" href="<?php echo URLROOT; ?>/registrars/student_subjects">Strand</a></li>

                                            <li class="breadcrumb-item active" aria-current="page">Subjects</li>
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
                                <h5><strong><?php echo $data['subjectCode']; ?></strong></h5>
                                <h5><?php echo $data['subjectDes']; ?></h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="addGradeRecord">
                                <form>
                                    <div class="form-row">
                                        <div class="table-responsive">
                                            <table class="tablesgrade" id="insertData">
                                                <thead>
                                                    <tr>
                                                        <th>Subject</th>


                                                        <th width="15%">Year Level</th>
                                                        <th width="15%">Semester</th>
                                                        <th width="10%">Core</th>
                                                        <th width="10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="rows">
                                                        <td data-label="Subject" class="colSubject">
                                                            <select id="gradeLevel1" class="form-control subjectSelect">
                                                                <option selected>Choose...</option>
                                                                <?php foreach ($data['seniorData'] as $seniorData) : ?>
                                                                    <option value="<?php echo $seniorData->code . '......' . $seniorData->description; ?>"><?php echo $seniorData->code . ' - ' . $seniorData->description; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </td>
                                                        <td data-label="Year Level" contenteditable="true" class="colYear">
                                                            <select id="level1" class="form-control">
                                                                <option selected>Choose...</option>
                                                                <option value="1">First Year</option>
                                                                <option value="2">Second Year</option>
                                                            </select>
                                                        </td>

                                                        <td data-label="Semester" contenteditable="true" class="colSem">
                                                            <select id="sem1" class="form-control">
                                                                <option selected>Choose...</option>
                                                                <option value="1">First</option>
                                                                <option value="2">Second</option>
                                                                <option value="3">Summer</option>
                                                            </select>
                                                        </td>
                                                        <td data-label="Core" contenteditable="true" class="colCore">
                                                            <select id="isCore1" class="form-control">
                                                                <option selected>Choose...</option>
                                                                <option value="1">Yes</option>
                                                                <option value="2">No</option>
                                                            </select>
                                                        </td>

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
                                                <th>Strand</th>
                                                <th>Code</th>
                                                <th>Description</th>
                                                <th>Year Level</th>
                                                <th>Semester</th>
                                                <th>Core</th>
                                                <th width="5%">Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php if (!empty($data['seniorSubjects'])) : ?>

                                                <?php foreach ($data['seniorSubjects'] as $subjectList) : ?>
                                                    <tr class="">
                                                        <td class="recRow" data-label="Strand" data-id="<?php echo $subjectList->recId; ?>">
                                                            <?php echo  $subjectList->code; ?>
                                                        </td>
                                                        <td data-label="Code">
                                                            <?php echo $subjectList->subject_code; ?>
                                                        </td>
                                                        <td data-label="Subject Name">
                                                            <?php echo $subjectList->subject_description; ?>
                                                        </td>
                                                        <td data-label="Year Level">
                                                            <?php if ($subjectList->year_level == 1) {
                                                                echo 'Grade 11';
                                                            } elseif ($subjectList->year_level == 2) {
                                                                echo 'Grade 12';
                                                            } ?>
                                                        </td>
                                                        <td data-label="Semester">
                                                            <?php if ($subjectList->semester == 1) {
                                                                echo 'First';
                                                            } elseif ($subjectList->semester == 2) {
                                                                echo 'Second';
                                                            } ?>
                                                        </td>
                                                        <td data-label="Core">
                                                            <?php if ($subjectList->is_core == 1) {
                                                                echo 'Yes';
                                                            } elseif ($subjectList->is_core == 2) {
                                                                echo 'No';
                                                            } else {
                                                                echo 'N/A';
                                                            } ?>
                                                        </td>

                                                        <td data-label="Action">
                                                            <button type="button" class="btn btn-danger btnDelete" data-id="<?php echo $subjectList->recId; ?>"><i class="far fa-trash-alt"></i></button>
                                                        </td>


                                                    </tr>

                                                <?php endforeach; ?>

                                            <?php endif; ?>

                                        </tbody>

                                    </table>

                                    <?php if (empty($data['seniorSubjects'])) : ?>
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
                <h5 class="modal-title">Confirmation</h5>
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
                    <input type="text" class="form-control editSubject" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                </div>
                <div class="form-group">
                    <label for="inputState">School Year</label>
                    <select id="editLevel" class="form-control">
                        <option selected>Choose...</option>
                        <option value="1">First Year</option>
                        <option value="2">Second Year</option>

                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputState">Grade Level</label>
                        <select id="editSem" class="form-control">
                            <option selected>Choose...</option>
                            <option value="1">First</option>
                            <option value="2">Second</option>
                            <option value="3">Summer</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">Core</label>
                        <select id="editCore" class="form-control">
                            <option selected>Choose...</option>
                            <option value="0">N/A</option>
                            <option value="1">Yes</option>
                            <option value="2">No</option>

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
        var programId = '<?php echo $data['programId']; ?>';

        var count = 1;
        $('#addCol').click(function() {
            count = count + 1;
            // var newRow = '<tr id="rows' + count + '">';
            // newRow += '<td data-label="Subject" class="colSubject"><select id="gradeLevel' + count + '" class="form-control subjectSelect"><option selected>Choose...</option><option value="sped">Sped</option><option value="kinder_1">Kinder 1</option><option value="kinder_2">Kinder 2</option></select></td>';
            // newRow += '<td data-label="Year Level" contenteditable="true" class="colYear"><select id="gradeLevel" class="form-control"><option selected>Choose...</option><option value="1">First Year</option><option value="2">Second Year</option></select></td>';
            // newRow += '<td data-label="Semester" contenteditable="true" class="colSem"><select id="gradeLevel" class="form-control"><option selected>Choose...</option><option value="1">First</option><option value="2">Second</option><option value="3">Summer</option></select></td>';
            // newRow += '<td><button type="button" name="remove" data-row="rows' + count + '" class="btn btn-danger remove"><i class="fas fa-minus"></i></button></td>'
            // newRow += '</tr>'

            $.ajax({
                url: '<?php echo URLROOT ?>' + '/Actions/getSeniorSubjectData',
                method: 'post',
                data: {
                    count: count,
                    programId: programId

                },
                success: function(response) {
                    $('#insertData').append(response);
                }
            });

        });
        $(document).on('click', '.remove', function() {
            var deletes = $(this).data('row');
            $('#' + deletes).remove();
        });



        $('.saveData').click(function() {
            var i = 0;
            var counter = 1;
            var tableData = {
                subject: [],
                year: [],
                sem: [],
                core: []
            }

            for (i = 0; i < count; i++) {
                var subject = $('#gradeLevel' + counter + '').val();
                var gradelevel = $('#level' + counter + '').val();
                var sem = $('#sem' + counter + '').val();
                var core = $('#isCore' + counter + '').val();
                tableData.subject.push(subject);
                tableData.year.push(gradelevel);
                tableData.sem.push(sem);
                tableData.core.push(core);

                counter = counter + 1;
            }



            var noSelectSubject = checkIfNoSelect(tableData.subject);
            var noSelectLevel = checkIfNoSelect(tableData.year);
            var noSelectSem = checkIfNoSelect(tableData.sem);
            var noSelectCore = checkIfNoSelect(tableData.core);

            if (noSelectSubject === false || noSelectLevel === false || noSelectSem === false || noSelectCore === false) {
                alert('Your selection is not complete, please check all selection');
            } else {
                $('#confirmModal').toggle();
                $('.saveRec').click(function() {
                    $.ajax({
                        url: '<?php echo URLROOT ?>' + '/Actions/insertSeniorSubjects',
                        method: 'post',
                        data: {
                            tableData: tableData,
                            programId: programId

                        },
                        success: function(response) {
                            alert(response);
                            $('#confirmModal').hide();
                            location.reload();
                        }
                    });
                });
                closeModal()
            }
            // var schoolName = $('.schoolName').val();
            // var schoolYear = $('#schoolYear').val();
            // var gradeLevel = $('#gradeLevel').val();


            // $('.colSubject').each(function() {
            //     tableData.subject.push($(this).text());
            // });
            // $('.colDes').each(function() {
            //     tableData.description.push($(this).text());
            // });
            // $('.col1st').each(function() {
            //     tableData.first.push($(this).text());
            // });
            // $('.col2nd').each(function() {
            //     tableData.second.push($(this).text());
            // });
            // $('.col3rd').each(function() {
            //     tableData.third.push($(this).text());
            // });
            // $('.col4th').each(function() {
            //     tableData.fourth.push($(this).text());
            // });
            // $('.colFin').each(function() {
            //     tableData.final.push($(this).text());
            // });

            // var notBlankSubject = checkIfBlank(tableData.subject);
            // var notBlankDescription = checkIfBlank(tableData.description);
            // var notBlankFirst = checkIfBlank(tableData.first);
            // var notBlankSecond = checkIfBlank(tableData.second);
            // var notBlankThird = checkIfBlank(tableData.third);
            // var notBlankFourth = checkIfBlank(tableData.fourth);
            // var notBlankFinal = checkIfBlank(tableData.final);

            // if (notBlankSubject === true && notBlankFirst === true && notBlankSecond === true &&
            //     notBlankThird === true && notBlankFourth === true && notBlankFinal === true && schoolName != '' && schoolYear != 'Choose...' && gradeLevel != 'Choose...') {
            //     var notNumericFirst = checkIfNumeric(tableData.first);
            //     var notNumericSecond = checkIfNumeric(tableData.second);
            //     var notNumericThird = checkIfNumeric(tableData.third);
            //     var notNumericFourth = checkIfNumeric(tableData.fourth);
            //     var notNumericFinal = checkIfNumeric(tableData.final);
            //     if (notNumericFirst === true && notNumericSecond === true && notNumericThird === true && notNumericFourth === true && notNumericFinal === true) {
            //         $('#confirmModal').show();

            //         $('.saveRec').click(function() {
            //             $.ajax({
            //                 url: '<?php echo URLROOT ?>' + '/Actions/insertMultyJuniorRecord',
            //                 method: 'post',
            //                 data: {
            //                     schoolName: schoolName,
            //                     schoolYear: schoolYear,
            //                     gradeLevel: gradeLevel,
            //                     tableData: tableData,
            //                     infoId: infoId,
            //                     studentNo: studentNo,
            //                     count: count
            //                 },
            //                 success: function(response) {
            //                     alert(response);
            //                     $('#confirmModal').hide();
            //                     location.reload();
            //                 }
            //             });
            //         });
            //         closeModal()
            //     } else {
            //         alert('The set of grades you enter has non numeric character');
            //     }
            // } else {
            //     alert('Please complete all the blank fields');
            // }
        });

        $('#recordsTable tbody').on('click', '.recRow', function() {
            var recId = $(this).data('id');


            var currow = $(this).closest('tr');
            var subjectCode = currow.find('td:eq(1)').text();
            var subjectName = currow.find('td:eq(2)').text();
            var yearLevel = currow.find('td:eq(3)').text();
            var sem = currow.find('td:eq(4)').text();
            var core = currow.find('td:eq(5)').text();

            var newSem = 0;
            var newYear = 0;
            var newCore = 0;
            var getSubject = subjectCode.trim() + ' - ' + subjectName.trim();

            if (yearLevel.trim() === 'Grade 11') {
                newYear = 1;
            } else if (yearLevel.trim() === 'Grade 12') {
                newYear = 2;
            }

            if (sem.trim() === 'First') {
                newSem = 1;
            } else if (sem.trim() === 'Second') {
                newSem = 2;
            } else {
                newSem = 3;
            }

            if (core.trim() === 'Yes') {
                newCore = 1;
            } else if (core.trim() === 'No') {
                newCore = 2;
            } else if (core.trim() === 'N/A') {
                newCore = 0;
            }

            $('.editSubject').val(getSubject);
            $('#editLevel').val(newYear);
            $('#editSem').val(newSem);
            $('#editCore').val(newCore);

            $('#editModal').toggle();

            $('.updateRec').click(function() {
                if ($('#editLevel').val() === 'Choose...' || $('#editSem').val() === 'Choose...' || $('#editCore').val() === 'Choose...') {
                    alert('Please complete all fields')
                } else {
                    $.ajax({
                        url: '<?php echo URLROOT ?>' + '/Actions/updateSeniorSubjectPattern',
                        method: 'post',
                        data: {
                            recId: recId,
                            newYear: $('#editLevel').val(),
                            newSem: $('#editSem').val(),
                            newCore: $('#editCore').val()

                        },
                        success: function(response) {
                            alert(response);
                            $('#editModal').hide();
                            location.reload();
                        }
                    });
                }

            });
            closeModal()
        });



        $('.btnDelete').click(function() {
            var recId = $(this).data('id');


            $('#deleteModal').toggle();

            $('.deleteRec').click(function() {
                $.ajax({
                    url: '<?php echo URLROOT ?>' + '/Actions/deleteSeniorSubjectPattern',
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

    function checkIfNoSelect(items) {
        var result = 0;

        for (var key in items) {
            var remarks = $.trim(items[key]);
            //console.log(activity);

            console.log(remarks);
            if (remarks === 'Choose...') {
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