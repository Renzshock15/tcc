<?php

class Students extends Controller
{

    public function __construct()
    {
        if (isLoggedIn(0)) {
            redirect('users/index');
        }

        $this->studentModel = $this->model('Student');
        $this->subjectModel = $this->model('Subject');
        $this->gradeModel = $this->model('Grade');
        $this->userModel = $this->model('User');
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        redirect('students/home');
    }

    public function home()
    {
        $getAllPost = $this->postModel->getAllPost();
        $getId = $this->userModel->getMyId($_SESSION['id']);
        $data = [
            'myId' => $getId->student_id,
            'post' => $getAllPost
        ];

        $this->view('students/home', $data);
    }

    public function change_password()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'student_id' => trim($_POST['student-id']),
                'old_password' => trim($_POST['old_password']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'old_password_err' => "",
                'student_err' => "",
                'password_err'  => "",
                'confirm_password_err' => ""
            ];

            if (empty($data['student_id'])) {
                $data['student_err'] = 'Please enter your student id';
            } else {
                if ($this->studentModel->checkStudentId($data['student_id'])) {
                    //employee id found
                } else {
                    //emplyee id not found
                    $data['student_err'] = 'Student id is invalid';
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

            if (empty($data['student_err']) && empty($data['old_password_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                //All fields are complete
                $passwordMatch = $this->studentModel->getStudentInfo($data['student_id'], $data['old_password']);
                if ($passwordMatch) {
                    //Encrypt password
                    $password_rehash = password_hash($data['password'], PASSWORD_BCRYPT);
                    //Update password
                    $passwordUpdate = $this->studentModel->updateStudentPassword($data['student_id'], $password_rehash);
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

            $this->view('students/changepass', $data);
        } else {
            $data = [
                'students_id' => "",
                'old_password' => "",
                'password' => "",
                'confirm_password' => "",
                'students_err' => "",
                'old_password_err' => "",
                'password_err'  => "",
                'confirm_password_err' => "",

            ];

            $this->view('students/changepass', $data);
        }
    }

    public function subject_load()
    {
        $checkInStudentsAccount = $this->userModel->checkInStudentsAccount($_SESSION['id'], $_SESSION['user_id']);

        $mySubjectsJunior = $this->subjectModel->loadSubjectJunior($_SESSION['user_id'], $_SESSION['school_year']);
        $mySubjectsSenior = $this->subjectModel->loadSubjectSenior($checkInStudentsAccount, $_SESSION['sem_name']);
        $mySubjectsCollege = $this->subjectModel->loadSubjectCollege($checkInStudentsAccount, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $mySubjectsSupple = $this->subjectModel->loadSubjectSupple($checkInStudentsAccount, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $mySubjectsMaster = $this->subjectModel->loadSubjectMaster($checkInStudentsAccount, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $data = [
            'juniorSubjects' => $mySubjectsJunior,
            'seniorSubjects' => $mySubjectsSenior,
            'collegeSubjects' => $mySubjectsCollege,
            'suppleSubjects' => $mySubjectsSupple,
            'masterSubjects' => $mySubjectsMaster
        ];
        $this->view('students/subject-loads', $data);
    }

    public function student_grades()
    {
        $checkInStudentsAccount = $this->userModel->checkInStudentsAccount($_SESSION['id'], $_SESSION['user_id']);

        $loadJuniorGrades = $this->gradeModel->loadJuniorGrades($_SESSION['user_id'], $_SESSION['school_year']);
        $countJuniorGrades = $this->gradeModel->countJuniorGrades($_SESSION['user_id'], $_SESSION['school_year']);
        $loadSeniorGrades1 = $this->gradeModel->loadSeniorGrades1($checkInStudentsAccount, $_SESSION['sem_name']);
        $countSeniorGrades1 = $this->gradeModel->countSeniorGrades1($checkInStudentsAccount, $_SESSION['sem_name']);
        $loadSeniorGrades2 = $this->gradeModel->loadSeniorGrades2($checkInStudentsAccount, $_SESSION['sem_name']);
        $countSeniorGrades2 = $this->gradeModel->countSeniorGrades2($checkInStudentsAccount, $_SESSION['sem_name']);
        $makeCollegeClassCard = $this->gradeModel->collegeClassCard($checkInStudentsAccount, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $data = [
            'juniorSubjects' => $loadJuniorGrades,
            'juniorSubjectsCount' => $countJuniorGrades,
            'seniorSubjects1' => $loadSeniorGrades1,
            'seniorSubjectsCount1' => $countSeniorGrades1,
            'seniorSubjects2' => $loadSeniorGrades2,
            'seniorSubjectsCount2' => $countSeniorGrades2,
            'collegeClassCard' => $makeCollegeClassCard
        ];
        $this->view('students/grades', $data);
    }

    public function checklist()
    {
        $getStudentCourse = $this->userModel->getStudentCourse($_SESSION['id']);
        $getSubject11 = $this->subjectModel->getSubject11($getStudentCourse->program_id, $getStudentCourse->student_id);
        $getSubject12 = $this->subjectModel->getSubject12($getStudentCourse->program_id, $getStudentCourse->student_id);
        $getSubject21 = $this->subjectModel->getSubject21($getStudentCourse->program_id, $getStudentCourse->student_id);
        $getSubject22 = $this->subjectModel->getSubject22($getStudentCourse->program_id, $getStudentCourse->student_id);
        $getSubject23 = $this->subjectModel->getSubject23($getStudentCourse->program_id, $getStudentCourse->student_id);
        $getSubject31 = $this->subjectModel->getSubject31($getStudentCourse->program_id, $getStudentCourse->student_id);
        $getSubject32 = $this->subjectModel->getSubject32($getStudentCourse->program_id, $getStudentCourse->student_id);
        $getSubject33 = $this->subjectModel->getSubject33($getStudentCourse->program_id, $getStudentCourse->student_id);
        $getSubject41 = $this->subjectModel->getSubject41($getStudentCourse->program_id, $getStudentCourse->student_id);
        $getSubject42 = $this->subjectModel->getSubject42($getStudentCourse->program_id, $getStudentCourse->student_id);

        $data = [
            'collegeClassCardHeader' => $getStudentCourse->courseDescription,
            'getSubject11' => $getSubject11,
            'getSubject12' => $getSubject12,
            'getSubject21' => $getSubject21,
            'getSubject22' => $getSubject22,
            'getSubject23' => $getSubject23,
            'getSubject31' => $getSubject31,
            'getSubject32' => $getSubject32,
            'getSubject33' => $getSubject33,
            'getSubject41' => $getSubject41,
            'getSubject42' => $getSubject42
        ];
        $this->view('students/my-checklist', $data);
    }

    public function cards()
    {
        $checkInStudentsAccount = $this->userModel->checkInStudentsAccount($_SESSION['id'], $_SESSION['user_id']);
        $makeCollegeClassCard = $this->gradeModel->collegeClassCardAll($checkInStudentsAccount, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $data = [
            'collegeClassCard' => $makeCollegeClassCard
        ];
        $this->view('students/my-cards', $data);
    }
}
