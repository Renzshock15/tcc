<?php

class Teachers extends Controller
{

    public function __construct()
    {
        if (isLoggedIn(5)) {
            redirect('users/index');
        }

        //Connect to teacher model
        $this->teacherModel = $this->model('Teacher');
        $this->studentModel = $this->model('Student');
        $this->subjectsModel = $this->model('Subject');
        $this->gradeModel = $this->model('Grade');
        $this->schoolModel = $this->model('School');
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index()
    {


        redirect('teachers/home');
    }

    public function home()
    {
        $getAllPost = $this->postModel->getAllPost();
        $getPostId = $this->userModel->getPostId($_SESSION['id']);

        $data = [
            'post' => $getAllPost,
            'myId' => $getPostId->employee_id
        ];

        $this->view('teachers/home', $data);
    }

    public function my_loads()
    {

        $getSubjectBE = $this->subjectsModel->getAssignSubjects($_SESSION['id']);

        //sr high
        $getSubjectSr = $this->subjectsModel->getAssignSubjectsSrHigh($_SESSION['id'], $_SESSION['sem_name']);

        //college subjects
        $getSubjectCol = $this->subjectsModel->getAssignSubjectsCollege($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);

        //supplemental
        $getSubjectSupple = $this->subjectsModel->getAssignSubjectsSupple($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);

        //Masteral
        $getSubjectMaster = $this->subjectsModel->getAssignSubjectsGraduaterSchool($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);


        $data = [
            'subjects' => $getSubjectBE,
            'subjectsSr' => $getSubjectSr,
            'subjectsCollege' =>  $getSubjectCol,
            'subjectsSupple' => $getSubjectSupple,
            'subjectsMaster' => $getSubjectMaster
        ];

        $this->view('teachers/myloads', $data);
    }

    public function enrolled_student_list($sectionId, $educationLevel = '', $subjectName = '')
    {
        //set page session
        setSessionPage('subjectName', $subjectName);


        if (isSessionPageSet('subjectName')) {
            redirect('teachers/home');
        }

        switch ($educationLevel) {
            case 'junior':

                $subjectsId = $this->subjectsModel->getCurrentSubjectsJunior($subjectName);
                $sectionStudents = $this->studentModel->getEnrolledJuniorStudents($sectionId,  $_SESSION['school_year'], $subjectName);
                $data = [
                    'studentInfo' => $sectionStudents,
                    'studentInfoSr' => '',
                    'studentInfoCollege' => '',
                    'sectionId' => $sectionId,
                    'subjectId' => $subjectName,
                    'subjectName' => $subjectsId->subject_name,
                    'subjectIds' => $subjectsId->id,
                    'educationLevel' => $educationLevel
                ];


                $this->view('teachers/load_student', $data);

                break;
            case 'senior':
                $seniorStudents = $this->studentModel->getEnrolledSeniorStudents($subjectName, $_SESSION['sem_name']);
                $seniorSubjectName = $this->subjectsModel->getSubjectNameSem($subjectName);
                $data = [
                    'studentInfo' => '',
                    'studentInfoSr' => $seniorStudents,
                    'studentInfoCollege' => '',
                    'subjectId' => $subjectName,
                    'subjectName' => $seniorSubjectName->code,
                    'educationLevel' => $educationLevel,
                    'semester' => $sectionId
                ];


                $this->view('teachers/load_studentSr', $data);
                break;
            case 'college':
                $collegeStudents = $this->studentModel->getEnrolledcollegeStudents($subjectName, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                $collegeSubjectName = $this->subjectsModel->getSubjectNameSem($subjectName);
                $data = [
                    'studentInfo' => '',
                    'studentInfoCollege' => $collegeStudents,
                    'subjectId' => $subjectName,
                    'subjectName' => $collegeSubjectName->code,
                    'subjectTerm' => $_SESSION['sem_termNum'],
                    'educationLevel' => $educationLevel
                ];


                $this->view('teachers/load_studentCol', $data);
                break;
            case 'supplemental':
                $suppleStudents = $this->studentModel->getEnrolledcollegeStudents($subjectName, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                $suppleSubjectName = $this->subjectsModel->getSubjectNameSem($subjectName);
                $data = [
                    'studentInfo' => '',
                    'studentInfoSupple' => $suppleStudents,
                    'subjectId' => $subjectName,
                    'subjectName' => $suppleSubjectName->code,
                    'subjectTerm' => $_SESSION['sem_termNum'],
                    'educationLevel' => $educationLevel
                ];


                $this->view('teachers/load_studentSup', $data);
                break;
            case 'master':
                $masterStudents = $this->studentModel->getEnrolledcollegeStudents($subjectName, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                $masterSubjectName = $this->subjectsModel->getSubjectNameSem($subjectName);
                $data = [
                    'studentInfo' => '',
                    'studentInfoMaster' => $masterStudents,
                    'subjectId' => $subjectName,
                    'subjectName' => $masterSubjectName->code,
                    'subjectTerm' => $_SESSION['sem_termNum'],
                    'educationLevel' => $educationLevel
                ];


                $this->view('teachers/load_studentMas', $data);
                break;
            default:
                redirect('teachers/home');
        }
    }

    public function change_password()
    {

        //unset page id is set
        sessionPageUnset();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'employee_id' => trim($_POST['employee-id']),
                'old_password' => trim($_POST['old_password']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'old_password_err' => "",
                'employee_err' => "",
                'password_err'  => "",
                'confirm_password_err' => ""
            ];

            if (empty($data['employee_id'])) {
                $data['employee_err'] = 'Please enter your employee id';
            } else {
                if ($this->teacherModel->checkEmployeeId($data['employee_id'])) {
                    //employee id found
                } else {
                    //emplyee id not found
                    $data['employee_err'] = 'Employee id is invalid';
                }
            }

            if (empty($data['old_password'])) {
                $data['old_password_err'] = 'Please enter your password';
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter your new password';
            }

            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm your password';
            }

            if ($data['confirm_password'] != $data['password']) {
                $data['confirm_password_err'] = 'Password not match';
            }

            if (empty($data['employee_err']) && empty($data['old_password_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                //All fields are complete
                $passwordMatch = $this->teacherModel->getEmployeeInfo($data['employee_id'], $data['old_password']);
                if ($passwordMatch) {
                    //Encrypt password
                    $password_rehash = password_hash($data['password'], PASSWORD_BCRYPT);
                    //Update password
                    $passwordUpdate = $this->teacherModel->updateEmployeePassword($data['employee_id'], $password_rehash);
                    if ($passwordUpdate) {
                        //Success
                        flash('update_success', 'Password updated successfully');
                    } else {
                        //Die
                        flash('update_success', 'Password update error', 'aler alert-danger');
                    }
                } else {
                    $data['old_password_err'] = 'Password is invalid';
                }
            }

            $this->view('teachers/changepass', $data);
        } else {
            $data = [
                'employee_id' => "",
                'old_password' => "",
                'password' => "",
                'confirm_password' => "",
                'employee_err' => "",
                'old_password_err' => "",
                'password_err'  => "",
                'confirm_password_err' => "",

            ];

            $this->view('teachers/changepass', $data);
        }
    }

    public function my_class()
    {

        //basic ed subjects
        // $getSubjectBE = $this->teacherModel->getAssignSubjects($_SESSION['id']);
        $getSubjectBE = $this->subjectsModel->getClassRecordSubjectsJunior($_SESSION['id'], $_SESSION['school_year']);

        //sr high
        // $getSubjectSr = $this->teacherModel->getAssignSubjectsSrHigh($_SESSION['id']);
        $getSubjectSr = $this->subjectsModel->getClassRecordSubjectsSenior($_SESSION['id'], $_SESSION['sem_name']);

        //college subjects
        $getSubjectCol = $this->subjectsModel->getClassRecordSubjectsCollege($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);

        //supplemental
        $getSubjectSupple = $this->subjectsModel->getClassRecordSubjectsSupplemental($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);

        //Masteral
        $getSubjectMaster = $this->subjectsModel->getClassRecordSubjectsMaster($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);

        $data = [
            'instructor_id' => "",
            'subjects' => $getSubjectBE,
            'subjectsSr' => $getSubjectSr,
            'subjectsCollege' =>  $getSubjectCol,
            'subjectsSupple' => $getSubjectSupple,
            'subjectsMaster' => $getSubjectMaster
        ];

        $this->view('teachers/myclass', $data);
    }

    public function student_subject_list($educationLevel = '', $subjectName = '')
    {
        //set page session
        setSessionPage('subjectName', $subjectName);


        if (isSessionPageSet('subjectName')) {
            redirect('teachers/home');
        }

        switch ($educationLevel) {
            case 'junior':

                $gradeSource = 'written works';
                $gradeQuarter = '1st quarter';
                $jrHighScore = $this->gradeModel->getJrHighSCore($subjectName, $gradeSource, $gradeQuarter, $_SESSION['school_year']);
                $subjectsId = $this->subjectsModel->getCurrentSubjectsJunior($subjectName);
                $sectionStudents = $this->studentModel->getJuniorStudentsBysubjects($subjectName, $_SESSION['school_year']);
                $checkIfschedExistInFinal = $this->subjectsModel->checkIfschedExistInFinal($subjectName, $_SESSION['school_year']);
                $data = [
                    'studentInfo' => $sectionStudents,
                    'studentInfoCollege' => '',
                    'subjectId' => $subjectName,
                    'subjectName' => $subjectsId->subject_name,
                    'educationLevel' => $educationLevel,
                    'jrHighScore' => $jrHighScore,
                    'checkIfExsist' => $checkIfschedExistInFinal
                ];


                $this->view('teachers/studentlist', $data);
                break;
            case 'college':
                $collegeStudents = $this->teacherModel->getCollegeStudents($_SESSION['sem_name']);
                $data = [
                    'studentInfo' => '',
                    'studentInfoCollege' => $collegeStudents,
                    'subjectName' => $_SESSION['subjectName'],
                    'educationLevel' => $educationLevel
                ];


                $this->view('teachers/studentlist', $data);
                break;
            default:
                redirect('teachers/home');
        }
    }

    public function junior_summary($subjectId = '')
    {

        //set page session
        setSessionPage('subjectName', $subjectId);


        if (isSessionPageSet('subjectName')) {
            redirect('teachers/home');
        }

        $subjectsId = $this->subjectsModel->getCurrentSubjectsJunior($subjectId);
        $juniorStudents = $this->studentModel->getJuniorSummary($subjectId, $_SESSION['school_year']);
        $finalGradeStep = $this->gradeModel->getStepSubmitGrades($subjectId, $_SESSION['school_year']);
        $submiSched = $this->schoolModel->getSubmitDates($subjectId, $_SESSION['school_year']);
        $juniorGradeSummaryFWW = $this->gradeModel->juniorGradeSummaryFWW($subjectId, $_SESSION['school_year']);
        $juniorGradeSummaryFPT = $this->gradeModel->juniorGradeSummaryFPT($subjectId, $_SESSION['school_year']);
        $juniorGradeSummaryFQA = $this->gradeModel->juniorGradeSummaryFQA($subjectId, $_SESSION['school_year']);
        $juniorGradeSummarySWW = $this->gradeModel->juniorGradeSummarySWW($subjectId, $_SESSION['school_year']);
        $juniorGradeSummarySPT = $this->gradeModel->juniorGradeSummarySPT($subjectId, $_SESSION['school_year']);
        $juniorGradeSummarySQA = $this->gradeModel->juniorGradeSummarySQA($subjectId, $_SESSION['school_year']);
        $juniorGradeSummaryTWW = $this->gradeModel->juniorGradeSummaryTWW($subjectId, $_SESSION['school_year']);
        $juniorGradeSummaryTPT = $this->gradeModel->juniorGradeSummaryTPT($subjectId, $_SESSION['school_year']);
        $juniorGradeSummaryTQA = $this->gradeModel->juniorGradeSummaryTQA($subjectId, $_SESSION['school_year']);
        $juniorGradeSummaryFOWW = $this->gradeModel->juniorGradeSummaryFOWW($subjectId, $_SESSION['school_year']);
        $juniorGradeSummaryFOPT = $this->gradeModel->juniorGradeSummaryFOPT($subjectId, $_SESSION['school_year']);
        $juniorGradeSummaryFOQA = $this->gradeModel->juniorGradeSummaryFOQA($subjectId, $_SESSION['school_year']);
        $data = [
            'subjectName' => $subjectsId->subject_name,
            'description' => $subjectsId->subject_description,
            'subjectGrade'  => $subjectsId->subject_grade,
            'subjectId' => $subjectId,
            'studentInfo' => $juniorStudents,
            'finalGradeStep' => $finalGradeStep,
            'submitSched' => $submiSched->show_date,
            'submitSchedId' => $submiSched->id,
            'juniorSummaryFWW' => $juniorGradeSummaryFWW,
            'juniorSummaryFPT' => $juniorGradeSummaryFPT,
            'juniorSummaryFQA' => $juniorGradeSummaryFQA,
            'juniorSummarySWW' => $juniorGradeSummarySWW,
            'juniorSummarySPT' => $juniorGradeSummarySPT,
            'juniorSummarySQA' => $juniorGradeSummarySQA,
            'juniorSummaryTWW' => $juniorGradeSummaryTWW,
            'juniorSummaryTPT' => $juniorGradeSummaryTPT,
            'juniorSummaryTQA' => $juniorGradeSummaryTQA,
            'juniorSummaryFOWW' => $juniorGradeSummaryFOWW,
            'juniorSummaryFOPT' => $juniorGradeSummaryFOPT,
            'juniorSummaryFOQA' => $juniorGradeSummaryFOQA
        ];
        $this->view('teachers/junior-summary', $data);
    }

    //Sr grades
    public function senior_grade1($educationLevel = '', $subjectName = '')
    {
        //set page session
        setSessionPage('subjectName', $subjectName);


        if (isSessionPageSet('subjectName')) {
            redirect('teachers/home');
        }

        $quarter = '1st quarter';
        $gradeSource = 'written works';

        $getSrStudents = $this->studentModel->getSeniorStudentsBysubjects($subjectName, $_SESSION['sem_name'], $quarter,  $gradeSource);
        $subjectsId = $this->subjectsModel->getCurrentSubjects($subjectName);
        $srHighScore = $this->gradeModel->getSrHighSCore($subjectName, $gradeSource, $quarter, $_SESSION['sem_name']);
        $checkIfSeniorSubjectExist = $this->subjectsModel->checkIfSeniorSubjectExist($subjectName, $_SESSION['sem_name']);

        $data = [
            'studentInfo' => $getSrStudents,
            'subjectName' =>  $subjectsId->code,
            'subjectId' => $subjectsId->subject_sched_ID,
            'jrHighScore' => $srHighScore,
            'checkIfExsist' => $checkIfSeniorSubjectExist
        ];
        $this->view('teachers/senior-grade', $data);
    }

    public function senior_grade2($educationLevel = '', $subjectName = '')
    {
        //set page session
        setSessionPage('subjectName', $subjectName);


        if (isSessionPageSet('subjectName')) {
            redirect('teachers/home');
        }

        $quarter = '3rd quarter';
        $gradeSource = 'written works';

        $getSrStudents = $this->studentModel->getSeniorStudentsBysubjects($subjectName, $_SESSION['sem_name'], $quarter,  $gradeSource);
        $subjectsId = $this->subjectsModel->getCurrentSubjects($subjectName);
        $srHighScore = $this->gradeModel->getSrHighSCore($subjectName, $gradeSource, $quarter, $_SESSION['sem_name']);
        $checkIfSeniorSubjectExist = $this->subjectsModel->checkIfSeniorSubjectExist($subjectName, $_SESSION['sem_name']);

        $data = [
            'studentInfo' => $getSrStudents,
            'subjectName' =>  $subjectsId->code,
            'subjectId' => $subjectsId->subject_sched_ID,
            'jrHighScore' => $srHighScore,
            'checkIfExsist' => $checkIfSeniorSubjectExist
        ];
        $this->view('teachers/senior-grade2', $data);
    }

    public function senior_summary($subjectId = '', $seniorSem)
    {

        //set page session
        setSessionPage('subjectName', $subjectId);


        if (isSessionPageSet('subjectName')) {
            redirect('teachers/home');
        }

        $subjectsId = $this->subjectsModel->getCurrentSubjectsSummary($subjectId);







        switch ($seniorSem) {
            case 'first':
                $seniorStudents = $this->studentModel->getSeniorSummaryFirst($subjectId, $_SESSION['sem_name']);
                $finalGradeStep = $this->gradeModel->getStepSubmitGradesSr1($subjectId, $_SESSION['sem_name']);
                $submiSched = $this->schoolModel->getSubmitDatesSr($subjectId, $_SESSION['sem_name']);
                $seniorGradeSummaryFWW = $this->gradeModel->seniorGradeSummaryFWW($subjectId, $_SESSION['sem_name']);
                $seniorGradeSummaryFPT = $this->gradeModel->seniorGradeSummaryFPT($subjectId, $_SESSION['sem_name']);
                $seniorGradeSummaryFQA = $this->gradeModel->seniorGradeSummaryFQA($subjectId, $_SESSION['sem_name']);
                $seniorGradeSummarySWW = $this->gradeModel->seniorGradeSummarySWW($subjectId, $_SESSION['sem_name']);
                $seniorGradeSummarySPT = $this->gradeModel->seniorGradeSummarySPT($subjectId, $_SESSION['sem_name']);
                $seniorGradeSummarySQA = $this->gradeModel->seniorGradeSummarySQA($subjectId, $_SESSION['sem_name']);
                $data = [
                    'subjectName' => $subjectsId->code,
                    'description' => $subjectsId->description,
                    'subjectGrade'  => $subjectsId->year_level,
                    'section' => $subjectsId->sec_code,
                    'subjectCode' => $subjectsId->courseCode,
                    'subjectId' => $subjectId,
                    'studentInfo' => $seniorStudents,
                    'finalGradeStep' => $finalGradeStep,
                    'submitSched' => $submiSched->show_date,
                    'submitSchedId' => $submiSched->id,
                    'juniorSummaryFWW' => $seniorGradeSummaryFWW,
                    'juniorSummaryFPT' => $seniorGradeSummaryFPT,
                    'juniorSummaryFQA' => $seniorGradeSummaryFQA,
                    'juniorSummarySWW' => $seniorGradeSummarySWW,
                    'juniorSummarySPT' => $seniorGradeSummarySPT,
                    'juniorSummarySQA' => $seniorGradeSummarySQA

                ];
                $this->view('teachers/senior-summary1', $data);
                break;
            case 'second':
                $seniorStudents = $this->studentModel->getSeniorSummarySecond($subjectId, $_SESSION['sem_name']);
                $finalGradeStep = $this->gradeModel->getStepSubmitGradesSr1($subjectId, $_SESSION['sem_name']);
                $submiSched = $this->schoolModel->getSubmitDatesSr($subjectId, $_SESSION['sem_name']);
                $seniorGradeSummaryTWW = $this->gradeModel->seniorGradeSummaryTWW($subjectId, $_SESSION['sem_name']);
                $seniorGradeSummaryTPT = $this->gradeModel->seniorGradeSummaryTPT($subjectId, $_SESSION['sem_name']);
                $seniorGradeSummaryTQA = $this->gradeModel->seniorGradeSummaryTQA($subjectId, $_SESSION['sem_name']);
                $seniorGradeSummaryFOWW = $this->gradeModel->seniorGradeSummaryFOWW($subjectId, $_SESSION['sem_name']);
                $seniorGradeSummaryFOPT = $this->gradeModel->seniorGradeSummaryFOPT($subjectId, $_SESSION['sem_name']);
                $seniorGradeSummaryFOQA = $this->gradeModel->seniorGradeSummaryFOQA($subjectId, $_SESSION['sem_name']);
                $data = [
                    'subjectName' => $subjectsId->code,
                    'description' => $subjectsId->description,
                    'subjectGrade'  => $subjectsId->year_level,
                    'section' => $subjectsId->sec_code,
                    'subjectCode' => $subjectsId->courseCode,
                    'subjectId' => $subjectId,
                    'studentInfo' => $seniorStudents,
                    'finalGradeStep' => $finalGradeStep,
                    'submitSched' => $submiSched->show_date,
                    'submitSchedId' => $submiSched->id,
                    'juniorSummaryFWW' => $seniorGradeSummaryTWW,
                    'juniorSummaryFPT' => $seniorGradeSummaryTPT,
                    'juniorSummaryFQA' => $seniorGradeSummaryTQA,
                    'juniorSummarySWW' => $seniorGradeSummaryFOWW,
                    'juniorSummarySPT' => $seniorGradeSummaryFOPT,
                    'juniorSummarySQA' => $seniorGradeSummaryFOQA
                ];
                $this->view('teachers/senior-summary2', $data);
                break;
            default:
                redirect('teachers/home');
        }
    }

    //Sr grades
    public function college_grade($educationLevel = '', $subjectName = '')
    {
        //set page session
        setSessionPage('subjectName', $subjectName);


        if (isSessionPageSet('subjectName')) {
            redirect('teachers/home');
        }

        $quarter = 'prelim';
        $gradeSource = 'attendance';

        $getCollegeStudents = $this->studentModel->getCollegeStudentsBysubjects($subjectName, $_SESSION['sem_name'], $quarter,  $gradeSource, $_SESSION['sem_termNum']);
        $subjectsId = $this->subjectsModel->getCurrentSubjects($subjectName);
        $collegeHighScore = $this->gradeModel->getCollegeHighSCore($subjectName, $gradeSource, $quarter, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeActCount = $this->gradeModel->countCollegeActivity($subjectName, $quarter, $gradeSource, $_SESSION['sem_name'], $_SESSION['sem_termNum']);

        $data = [
            'studentInfo' => $getCollegeStudents,
            'subjectName' =>  $subjectsId->code,
            'subjectDescription' => $subjectsId->description,
            'subjectId' => $subjectsId->subject_sched_ID,
            'jrHighScore' => $collegeHighScore,
            'actCount' => $collegeActCount
        ];
        $this->view('teachers/college-grade', $data);
    }

    public function college_summary($subjectId = '')
    {

        //set page session
        setSessionPage('subjectName', $subjectId);


        if (isSessionPageSet('subjectName')) {
            redirect('teachers/home');
        }

        $subjectsId = $this->subjectsModel->getCurrentSubjectsSummary($subjectId);
        $collegeStudents = $this->studentModel->getCollegeSummary($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $isExistInFinalGrade = $this->subjectsModel->checkIfSchedIdExist($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $submiSched = $this->schoolModel->getSubmitDatesCollege($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        //prelim
        $collegeGradeSummaryPAT = $this->gradeModel->collegeGradeSummaryPAT($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryPATclassStanding = $this->gradeModel->collegeGradeSummaryPATclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryPRE = $this->gradeModel->collegeGradeSummaryPRE($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryPREclassStanding = $this->gradeModel->collegeGradeSummaryPREclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryPQU = $this->gradeModel->collegeGradeSummaryPQU($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryPQUclassStanding = $this->gradeModel->collegeGradeSummaryPQUclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryPPR = $this->gradeModel->collegeGradeSummaryPPR($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryPPRclassStanding = $this->gradeModel->collegeGradeSummaryPPRclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryPAS = $this->gradeModel->collegeGradeSummaryPAS($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryPASclassStanding = $this->gradeModel->collegeGradeSummaryPASclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryPEX = $this->gradeModel->collegeGradeSummaryPEX($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryPEXclassStanding = $this->gradeModel->collegeGradeSummaryPEXclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);

        //midterm
        $collegeGradeSummaryMAT = $this->gradeModel->collegeGradeSummaryMAT($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryMATclassStanding = $this->gradeModel->collegeGradeSummaryMATclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryMRE = $this->gradeModel->collegeGradeSummaryMRE($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryMREclassStanding = $this->gradeModel->collegeGradeSummaryMREclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryMQU = $this->gradeModel->collegeGradeSummaryMQU($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryMQUclassStanding = $this->gradeModel->collegeGradeSummaryMQUclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryMPR = $this->gradeModel->collegeGradeSummaryMPR($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryMPRclassStanding = $this->gradeModel->collegeGradeSummaryMPRclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryMAS = $this->gradeModel->collegeGradeSummaryMAS($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryMASclassStanding = $this->gradeModel->collegeGradeSummaryMASclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryMEX = $this->gradeModel->collegeGradeSummaryMEX($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryMEXclassStanding = $this->gradeModel->collegeGradeSummaryMEXclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);

        //semi finals
        $collegeGradeSummarySAT = $this->gradeModel->collegeGradeSummarySAT($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummarySATclassStanding = $this->gradeModel->collegeGradeSummarySATclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummarySRE = $this->gradeModel->collegeGradeSummarySRE($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummarySREclassStanding = $this->gradeModel->collegeGradeSummarySREclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummarySQU = $this->gradeModel->collegeGradeSummarySQU($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummarySQUclassStanding = $this->gradeModel->collegeGradeSummarySQUclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummarySPR = $this->gradeModel->collegeGradeSummarySPR($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummarySPRclassStanding = $this->gradeModel->collegeGradeSummarySPRclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummarySAS = $this->gradeModel->collegeGradeSummarySAS($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummarySASclassStanding = $this->gradeModel->collegeGradeSummarySASclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummarySEX = $this->gradeModel->collegeGradeSummarySEX($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummarySEXclassStanding = $this->gradeModel->collegeGradeSummarySEXclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);

        //finals
        $collegeGradeSummaryFAT = $this->gradeModel->collegeGradeSummaryFAT($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryFATclassStanding = $this->gradeModel->collegeGradeSummaryFATclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryFRE = $this->gradeModel->collegeGradeSummaryFRE($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryFREclassStanding = $this->gradeModel->collegeGradeSummaryFREclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryFQU = $this->gradeModel->collegeGradeSummaryFQU($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryFQUclassStanding = $this->gradeModel->collegeGradeSummaryFQUclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryFPR = $this->gradeModel->collegeGradeSummaryFPR($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryFPRclassStanding = $this->gradeModel->collegeGradeSummaryFPRclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryFAS = $this->gradeModel->collegeGradeSummaryFAS($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryFASclassStanding = $this->gradeModel->collegeGradeSummaryFASclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryFEX = $this->gradeModel->collegeGradeSummaryFEX($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $collegeGradeSummaryFEXclassStanding = $this->gradeModel->collegeGradeSummaryFEXclassStanding($subjectId, $_SESSION['sem_name'], $_SESSION['sem_termNum']);


        $data = [
            'subjectName' => $subjectsId->code,
            'description' => $subjectsId->description,
            'subjectGrade'  => $subjectsId->year_level,
            'section' => $subjectsId->sec_code,
            'subjectCode' => $subjectsId->courseCode,
            'subjectId' => $subjectId,
            'studentInfo' => $collegeStudents,
            'submitSched' => $submiSched->show_date,
            'submitSchedId' => $submiSched->id,
            'isExistInFinalGrade' => $isExistInFinalGrade,
            'collegeSummaryPAT' => $collegeGradeSummaryPAT,
            'collegeSummaryPATCS' => $collegeGradeSummaryPATclassStanding,
            'collegeSummaryPRE' => $collegeGradeSummaryPRE,
            'collegeSummaryPRECS' => $collegeGradeSummaryPREclassStanding,
            'collegeSummaryPQU' => $collegeGradeSummaryPQU,
            'collegeSummaryPQUCS' => $collegeGradeSummaryPQUclassStanding,
            'collegeSummaryPPR' => $collegeGradeSummaryPPR,
            'collegeSummaryPPRCS' => $collegeGradeSummaryPPRclassStanding,
            'collegeSummaryPAS' => $collegeGradeSummaryPAS,
            'collegeSummaryPASCS' => $collegeGradeSummaryPASclassStanding,
            'collegeSummaryPEX' => $collegeGradeSummaryPEX,
            'collegeSummaryPEXCS' => $collegeGradeSummaryPEXclassStanding,
            'collegeSummaryMAT' => $collegeGradeSummaryMAT,
            'collegeSummaryMATCS' => $collegeGradeSummaryMATclassStanding,
            'collegeSummaryMRE' => $collegeGradeSummaryMRE,
            'collegeSummaryMRECS' => $collegeGradeSummaryMREclassStanding,
            'collegeSummaryMQU' => $collegeGradeSummaryMQU,
            'collegeSummaryMQUCS' => $collegeGradeSummaryMQUclassStanding,
            'collegeSummaryMPR' => $collegeGradeSummaryMPR,
            'collegeSummaryMPRCS' => $collegeGradeSummaryMPRclassStanding,
            'collegeSummaryMAS' => $collegeGradeSummaryMAS,
            'collegeSummaryMASCS' => $collegeGradeSummaryMASclassStanding,
            'collegeSummaryMEX' => $collegeGradeSummaryMEX,
            'collegeSummaryMEXCS' => $collegeGradeSummaryMEXclassStanding,
            'collegeSummarySAT' => $collegeGradeSummarySAT,
            'collegeSummarySATCS' => $collegeGradeSummarySATclassStanding,
            'collegeSummarySRE' => $collegeGradeSummarySRE,
            'collegeSummarySRECS' => $collegeGradeSummarySREclassStanding,
            'collegeSummarySQU' => $collegeGradeSummarySQU,
            'collegeSummarySQUCS' => $collegeGradeSummarySQUclassStanding,
            'collegeSummarySPR' => $collegeGradeSummarySPR,
            'collegeSummarySPRCS' => $collegeGradeSummarySPRclassStanding,
            'collegeSummarySAS' => $collegeGradeSummarySAS,
            'collegeSummarySASCS' => $collegeGradeSummarySASclassStanding,
            'collegeSummarySEX' => $collegeGradeSummarySEX,
            'collegeSummarySEXCS' => $collegeGradeSummarySEXclassStanding,
            'collegeSummaryFAT' => $collegeGradeSummaryFAT,
            'collegeSummaryFATCS' => $collegeGradeSummaryFATclassStanding,
            'collegeSummaryFRE' => $collegeGradeSummaryFRE,
            'collegeSummaryFRECS' => $collegeGradeSummaryFREclassStanding,
            'collegeSummaryFQU' => $collegeGradeSummaryFQU,
            'collegeSummaryFQUCS' => $collegeGradeSummaryFQUclassStanding,
            'collegeSummaryFPR' => $collegeGradeSummaryFPR,
            'collegeSummaryFPRCS' => $collegeGradeSummaryFPRclassStanding,
            'collegeSummaryFAS' => $collegeGradeSummaryFAS,
            'collegeSummaryFASCS' => $collegeGradeSummaryFASclassStanding,
            'collegeSummaryFEX' => $collegeGradeSummaryFEX,
            'collegeSummaryFEXCS' => $collegeGradeSummaryFEXclassStanding


        ];
        $this->view('teachers/college-summary', $data);
    }

    public function history()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['btnSearchj'])) {
                $txtSearchj = $_POST['txtSearchj'];
                if ($txtSearchj === '') {
                    $getJuniorHistory = $this->subjectsModel->getJuniorHistory($_SESSION['id'], $_SESSION['school_year']);
                    $getSrHistory = $this->subjectsModel->getSrHistory($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                    $getHigherHistory = $this->subjectsModel->getHigherHistory($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                    $data = [
                        'subjects' => $getJuniorHistory,
                        'subjectsSr' => $getSrHistory,
                        'subjectsCollege' => $getHigherHistory
                    ];
                    $this->view('teachers/history', $data);
                } else {
                    $getJuniorHistory = $this->subjectsModel->getJuniorHistoryS($_SESSION['id'], $txtSearchj, $_SESSION['school_year']);
                    $getSrHistory = $this->subjectsModel->getSrHistory($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                    $getHigherHistory = $this->subjectsModel->getHigherHistory($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                    $data = [
                        'subjects' => $getJuniorHistory,
                        'subjectsSr' => $getSrHistory,
                        'subjectsCollege' => $getHigherHistory
                    ];
                    $this->view('teachers/history', $data);
                }
            } elseif (isset($_POST['btnSearchs'])) {
                $txtSearchs = $_POST['txtSearchs'];
                if ($txtSearchs === '') {
                    $getJuniorHistory = $this->subjectsModel->getJuniorHistory($_SESSION['id'], $_SESSION['school_year']);
                    $getSrHistory = $this->subjectsModel->getSrHistory($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                    $getHigherHistory = $this->subjectsModel->getHigherHistory($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                    $data = [
                        'subjects' => $getJuniorHistory,
                        'subjectsSr' => $getSrHistory,
                        'subjectsCollege' => $getHigherHistory
                    ];
                    $this->view('teachers/history', $data);
                } else {
                    $getJuniorHistory = $this->subjectsModel->getJuniorHistory($_SESSION['id'], $_SESSION['school_year']);
                    $getSrHistory = $this->subjectsModel->getSrHistoryS($_SESSION['id'], $txtSearchs, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                    $getHigherHistory = $this->subjectsModel->getHigherHistory($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                    $data = [
                        'subjects' => $getJuniorHistory,
                        'subjectsSr' => $getSrHistory,
                        'subjectsCollege' => $getHigherHistory
                    ];
                    $this->view('teachers/history', $data);
                }
            } elseif (isset($_POST['btnSearchc'])) {
                $txtSearchc = $_POST['txtSearchc'];
                if ($txtSearchc === '') {
                    $getJuniorHistory = $this->subjectsModel->getJuniorHistory($_SESSION['id'], $_SESSION['school_year']);
                    $getSrHistory = $this->subjectsModel->getSrHistory($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                    $getHigherHistory = $this->subjectsModel->getHigherHistory($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                    $data = [
                        'subjects' => $getJuniorHistory,
                        'subjectsSr' => $getSrHistory,
                        'subjectsCollege' => $getHigherHistory
                    ];
                    $this->view('teachers/history', $data);
                } else {
                    $getJuniorHistory = $this->subjectsModel->getJuniorHistory($_SESSION['id'], $_SESSION['school_year']);
                    $getSrHistory = $this->subjectsModel->getSrHistory($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                    $getHigherHistory = $this->subjectsModel->getHigherHistoryS($_SESSION['id'], $txtSearchc, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
                    $data = [
                        'subjects' => $getJuniorHistory,
                        'subjectsSr' => $getSrHistory,
                        'subjectsCollege' => $getHigherHistory
                    ];
                    $this->view('teachers/history', $data);
                }
            }
        } else {
            $getJuniorHistory = $this->subjectsModel->getJuniorHistory($_SESSION['id'], $_SESSION['school_year']);
            $getSrHistory = $this->subjectsModel->getSrHistory($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);
            $getHigherHistory = $this->subjectsModel->getHigherHistory($_SESSION['id'], $_SESSION['sem_name'], $_SESSION['sem_termNum']);
            $data = [
                'subjects' => $getJuniorHistory,
                'subjectsSr' => $getSrHistory,
                'subjectsCollege' => $getHigherHistory
            ];
            $this->view('teachers/history', $data);
        }
    }

    public function junior_history($id, $schoolYear)
    {
        if ($schoolYear === '') {
            redirect('teachers/home');
        }
        $getJuniorFinalHistory = $this->gradeModel->getJuniorFinalHistory($id, $schoolYear);
        $getJuniorFinalHistoryC = $this->gradeModel->getJuniorFinalHistoryC($id, $schoolYear);
        $data = [
            'studentInfo' => $getJuniorFinalHistory,
            'subjectName' => $getJuniorFinalHistoryC->subject_name,
            'schoolYear' => $getJuniorFinalHistoryC->school_year,
            'gradeLevel' => $getJuniorFinalHistoryC->grade_level,
            'subjectId' => $id
        ];
        $this->view('teachers/junior-history', $data);
    }

    public function senior_history($id, $sem, $schoolYear)
    {
        if ($schoolYear === '') {
            redirect('teachers/home');
        }
        $explodeSchoolYear = explode('-', $schoolYear);
        $newSchoolYear = $explodeSchoolYear[0] . ' - ' . $explodeSchoolYear[1];
        $getSeniorFinalHistory = $this->gradeModel->getSeniorFinalHistory($id, $sem, $newSchoolYear);
        $getSeniorFinalHistoryC = $this->gradeModel->getSeniorFinalHistoryC($id, $sem, $newSchoolYear);
        $data = [
            'studentInfo' => $getSeniorFinalHistory,
            'sem' => $sem,
            'schoolYear' => $newSchoolYear,
            'subjectName' => $getSeniorFinalHistoryC->subject_name,
            'yearLevel' => $getSeniorFinalHistoryC->year_level,
            'subjectDescription' => $getSeniorFinalHistoryC->subject_description,
            'subjectId' => $id
        ];
        $this->view('teachers/senior-history', $data);
    }

    public function higher_history($id, $sem, $schoolYear)
    {
        if ($schoolYear === '') {
            redirect('teachers/home');
        }
        $explodeSchoolYear = explode('-', $schoolYear);
        $newSchoolYear = $explodeSchoolYear[0] . ' - ' . $explodeSchoolYear[1];
        $getHighFinalHistory = $this->gradeModel->getHighFinalHistory($id, $sem, $newSchoolYear);
        $getHighFinalHistoryC = $this->gradeModel->getHighFinalHistoryC($id, $sem, $newSchoolYear);
        $data = [
            'studentInfo' => $getHighFinalHistory,
            'sem' => $sem,
            'schoolYear' => $newSchoolYear,
            'subjectName' => $getHighFinalHistoryC->subject_name,
            'yearLevel' => $getHighFinalHistoryC->year_level,
            'subjectDescription' => $getHighFinalHistoryC->subject_description,
            'subjectId' => $id
        ];
        $this->view('teachers/higher-history', $data);
    }

    public function junior_history_list($subjectId, $schoolYear)
    {
        if (empty($schoolYear)) {
            redirect('teachers/home');
        }

        $gradeSource = 'written works';
        $gradeQuarter = '1st quarter';
        $jrHighScore = $this->gradeModel->getJrHighSCore($subjectId, $gradeSource, $gradeQuarter, $schoolYear);
        $subjectNameAll = $this->subjectsModel->subjectNameAll($subjectId, $schoolYear);
        $sectionStudents = $this->studentModel->getJuniorStudentsBysubjects($subjectId, $schoolYear);
        $data = [
            'studentInfo' => $sectionStudents,
            'subjectId' => $subjectId,
            'schoolYear' => $schoolYear,
            'jrHighScore' => $jrHighScore,
            'subjectName' => $subjectNameAll->subject_name
        ];

        $this->view('teachers/junior-history-list', $data);
    }

    public function senior_history_list($subjectId, $sem, $schoolYear)
    {
        if ($schoolYear === '') {
            redirect('teachers/home');
        }
        $explodedSchoolYear = explode('-', $schoolYear);
        $jointSchoolYear = $explodedSchoolYear[0] . ' - ' . $explodedSchoolYear[1];
        $quarter = '';
        $gradeSource = '';

        if ($sem === '1') {
            $quarter = '1st quarter';
            $gradeSource = 'written works';
        } else {
            $quarter = '3rd quarter';
            $gradeSource = 'written works';
        }

        switch ($sem) {
            case 1:
                $getSrStudents = $this->studentModel->getSeniorStudentsBysubjects($subjectId, $jointSchoolYear, $quarter,  $gradeSource);
                $subjectNameAllSr = $this->subjectsModel->subjectNameAllSr($subjectId, $jointSchoolYear, $sem);
                $srHighScore = $this->gradeModel->getSrHighSCore($subjectId, $gradeSource, $quarter, $jointSchoolYear);

                $data = [
                    'studentInfo' => $getSrStudents,
                    'subjectName' =>  $subjectNameAllSr->subject_name,
                    'subjectId' => $subjectId,
                    'jrHighScore' => $srHighScore,
                    'schoolYear' => $jointSchoolYear,
                    'sem' => $sem
                ];
                $this->view('teachers/senior-history-list1', $data);
                break;
            case 2:
                $getSrStudents = $this->studentModel->getSeniorStudentsBysubjects($subjectId, $jointSchoolYear, $quarter,  $gradeSource);
                $subjectNameAllSr = $this->subjectsModel->subjectNameAllSr($subjectId, $jointSchoolYear, $sem);
                $srHighScore = $this->gradeModel->getSrHighSCore($subjectId, $gradeSource, $quarter, $jointSchoolYear);

                $data = [
                    'studentInfo' => $getSrStudents,
                    'subjectName' =>  $subjectNameAllSr->subject_name,
                    'subjectId' => $subjectId,
                    'jrHighScore' => $srHighScore,
                    'schoolYear' => $jointSchoolYear,
                    'sem' => $sem
                ];
                $this->view('teachers/senior-history-list2', $data);
                break;
        }
    }

    public function higher_history_list($subjectId, $sem, $schoolYear)
    {
        if ($schoolYear === '') {
            redirect('teachers/home');
        }
        $explodedSchoolYear = explode('-', $schoolYear);
        $jointSchoolYear = $explodedSchoolYear[0] . ' - ' . $explodedSchoolYear[1];

        $quarter = 'prelim';
        $gradeSource = 'attendance';

        $getCollegeStudents = $this->studentModel->getCollegeStudentsBysubjects($subjectId, $jointSchoolYear, $quarter,  $gradeSource, $sem);
        $subjectNameAllHigh = $this->subjectsModel->subjectNameAllHigh($subjectId, $jointSchoolYear, $sem);
        $collegeHighScore = $this->gradeModel->getCollegeHighSCore($subjectId, $gradeSource, $quarter, $jointSchoolYear, $sem);
        $collegeActCount = $this->gradeModel->countCollegeActivity($subjectId, $quarter, $gradeSource, $jointSchoolYear, $sem);

        $data = [
            'studentInfo' => $getCollegeStudents,
            'subjectName' => $subjectNameAllHigh->subject_name,
            'subjectId' => $subjectId,
            'jrHighScore' => $collegeHighScore,
            'actCount' => $collegeActCount,
            'sem' => $sem,
            'schoolYear' => $jointSchoolYear
        ];
        $this->view('teachers/higher_history_list', $data);
    }
}
