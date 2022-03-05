<?php

class Registrars extends Controller
{
    public function __construct()
    {
        if (isLoggedIn(2)) {
            redirect('users/login');
        }

        $this->userModel = $this->model('User');
        $this->schoolyearModel = $this->model('School');
        $this->studentModel = $this->model('Student');
        $this->subjectModel = $this->model('Subject');
        $this->gradeModel = $this->model('Grade');
        $this->schoolModel = $this->model('School');
    }

    public function index()
    {
        //redirect user to login page
        redirect('registrars/home');
    }

    public function home()
    {
        $getRegistrarUserCount = $this->userModel->getRegistrarUserCount($_SESSION['department']);
        $getRegistrarUserCountAdmin = $this->userModel->getRegistrarUserCountAdmin($_SESSION['department']);
        $data = [
            'users' => $getRegistrarUserCount,
            'admin' => $getRegistrarUserCountAdmin
        ];

        $this->view('registrar/home', $data);
    }

    public function change_userId()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $oldUserId = $_POST['user_id'];
            $newUserId = $_POST['new_user_id'];
            $data = [
                'old_user_err' => '',
                'new_user_err' => ''
            ];

            if (empty($oldUserId)) {
                $data['old_user_err'] = 'Please enter your old user id';
            } else {
                $checkAdminId = $this->userModel->checkRegistrarId($oldUserId);
                if ($checkAdminId) {
                } else {
                    $data['old_user_err'] = 'User Id is invalid';
                }
            }
            if (empty($newUserId)) {
                $data['new_user_err'] = 'Please enter your new user id';
            } else {
                $checkAdminIds = $this->userModel->checkRegistrarId($newUserId);

                if ($checkAdminIds) {
                    $data['new_user_err'] = 'User Id already taken';
                }
            }

            if (empty($data['old_user_err']) && empty($data['new_user_err'])) {


                $updateAdminId = $this->userModel->updateRegistrarId($newUserId, $_SESSION['id']);

                if ($updateAdminId) {
                    flash('update_success', 'User Id successfully updated');
                } else {
                    flash('update_success', 'Failed to update user id', 'aler alert-danger');
                }
            }


            $this->view('registrar/change-userId', $data);
        } else {
            $data = [
                'old_user_err' => '',
                'new_user_err' => ''
            ];
            $this->view('registrar/change-userId', $data);
        }
    }

    public function change_password()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_POST['user_id'];
            $oldPass = $_POST['old_password'];
            $password = $_POST['password'];
            $confirmPass = $_POST['confirm_password'];

            $data = [
                'user_err' => '',
                'old_password_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            if (empty($userId)) {
                $data['user_err'] = 'Please enter your user id';
            } else {
                $checkAdminId = $this->userModel->checkRegistrarId($userId);
                if ($checkAdminId) {
                } else {
                    $data['user_err'] = 'User Id is invalid';
                }
            }
            if (empty($oldPass)) {
                $data['old_password_err'] = 'Please eneter your old password';
            }
            if (empty($password)) {
                $data['password_err'] = 'Please enter your new password';
            }
            if (empty($confirmPass)) {
                $data['confirm_password_err'] = 'Please confirm your new password';
            } elseif ($confirmPass != $password) {
                $data['confirm_password_err'] = 'Password not match';
            }

            if (empty($data['user_err']) && empty($data['old_password_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                $checkIfAdminExist = $this->userModel->getRegistrarData($userId, $oldPass);

                if ($checkIfAdminExist) {
                    $rehashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $updateAdmin = $this->userModel->updateRegPass($userId, $rehashedPassword);
                    if ($updateAdmin) {
                        flash('update_success', 'Password successfully updated');
                    } else {
                        flash('update_success', 'Failed to update password', 'aler alert-danger');
                    }
                } else {
                    $data['old_password_err'] = 'Old password is invalid';
                }
            }


            $this->view('registrar/change-password', $data);
        } else {
            $data = [
                'user_err' => '',
                'old_password_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            $this->view('registrar/change-password', $data);
        }
    }

    public function user_registrar()
    {
        $getRegistrar = $this->userModel->getRegistrarUser($_SESSION['department']);
        $data = [
            'admins' => $getRegistrar,
            'adminRole' => $_SESSION['role'],
            'adminId' => $_SESSION['id'],
            'admindDepartment' => $_SESSION['department']
        ];

        $this->view('registrar/user-registrar', $data);
    }

    public function junior_records()
    {
        $data = [];

        $this->view('registrar/junior-records', $data);
    }

    public function junior_list1()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $txtSearch = $_POST['txtSearch'];
            if ($txtSearch === '') {

                $getStudentList = $this->studentModel->getAllStudentsKinder();
                $data = [
                    'studentList' => $getStudentList
                ];

                $this->view('registrar/junior-list', $data);
            } else {
                $getStudentList = $this->studentModel->getFilteredStudents($txtSearch);
                $data = [
                    'studentList' => $getStudentList
                ];

                $this->view('registrar/junior-list', $data);
            }
        } else {
            $getStudentList = $this->studentModel->getAllStudentsKinder();
            $data = [
                'studentList' => $getStudentList
            ];

            $this->view('registrar/junior-list', $data);
        }
    }

    public function kinder137($infoId)
    {

        if (empty($infoId)) {
            redirect('registrars/home');
        }
        $getStudentList = $this->studentModel->getAllStudentsKinder12($infoId);
        $getKinder1 = $this->studentModel->getKinder1($getStudentList->student_id);
        $getKinder1s = $this->studentModel->getKinder1s($getStudentList->student_id);
        $getKinder2 = $this->studentModel->getKinder2($getStudentList->student_id);
        $getKinder2s = $this->studentModel->getKinder2s($getStudentList->student_id);
        $getSchoolYears = $this->schoolyearModel->getSchoolYears();
        $getSubjects = $this->subjectModel->getAllKinderSubject();
        $data = [
            'studentName' => $getStudentList->lastName . ', ' . $getStudentList->firstName . ' ' . $getStudentList->middleName,
            'birthdate' => $getStudentList->birthdate,
            'birthPlace' => $getStudentList->birthplace,
            'address' => $getStudentList->siAdd,
            'gender' => $getStudentList->gender,
            'guardian' => $getStudentList->full_name,
            'guardianAdd' => $getStudentList->address,
            'relation' => $getStudentList->relationship,
            'kinder1' => $getKinder1,
            'schoolYear1' => $getKinder1s->schoolYear1,
            'school1' => $getKinder1s->school,
            'kinder2' => $getKinder2,
            'schoolYear2' => $getKinder2s->schoolYear1,
            'school2' => $getKinder2s->school,
            'getSchoolYears' => $getSchoolYears,
            'kinderSubjects' => $getSubjects,
            'studentId' => $getStudentList->student_id,
            'infoId' => $infoId
        ];

        $this->view('registrar/kinder-137', $data);
    }

    public function junior_list2()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $txtSearch = $_POST['txtSearch'];
            if ($txtSearch === '') {

                $getStudentList = $this->studentModel->getAllStudentsKinder();
                $data = [
                    'studentList' => $getStudentList
                ];

                $this->view('registrar/junior-list1-6', $data);
            } else {
                $getStudentList = $this->studentModel->getFilteredStudents($txtSearch);
                $data = [
                    'studentList' => $getStudentList
                ];

                $this->view('registrar/junior-list1-6', $data);
            }
        } else {
            $getStudentList = $this->studentModel->getAllStudentsKinder();
            $data = [
                'studentList' => $getStudentList
            ];

            $this->view('registrar/junior-list1-6', $data);
        }
    }

    public function elem137($infoId)
    {

        if (empty($infoId)) {
            redirect('registrars/home');
        }
        $getStudentList = $this->studentModel->getAllStudentsKinder12($infoId);
        $getgrade1 = $this->studentModel->getGrade1($getStudentList->student_id);
        $getGrade1s = $this->studentModel->getGrade1s($getStudentList->student_id);
        $getgrade2 = $this->studentModel->getGrade2($getStudentList->student_id);
        $getGrade2s = $this->studentModel->getGrade2s($getStudentList->student_id);
        $getgrade3 = $this->studentModel->getGrade3($getStudentList->student_id);
        $getGrade3s = $this->studentModel->getGrade3s($getStudentList->student_id);
        $getgrade4 = $this->studentModel->getGrade4($getStudentList->student_id);
        $getGrade4s = $this->studentModel->getGrade4s($getStudentList->student_id);
        $getgrade5 = $this->studentModel->getGrade5($getStudentList->student_id);
        $getGrade5s = $this->studentModel->getGrade5s($getStudentList->student_id);
        $getgrade6 = $this->studentModel->getGrade6($getStudentList->student_id);
        $getGrade6s = $this->studentModel->getGrade6s($getStudentList->student_id);
        $getSchoolYears = $this->schoolyearModel->getSchoolYears();
        $getSubjects = $this->subjectModel->getAllKinderSubject();
        $data = [
            'studentName' => $getStudentList->lastName . ', ' . $getStudentList->firstName . ' ' . $getStudentList->middleName,
            'birthdate' => $getStudentList->birthdate,
            'birthPlace' => $getStudentList->birthplace,
            'address' => $getStudentList->siAdd,
            'gender' => $getStudentList->gender,
            'guardian' => $getStudentList->full_name,
            'guardianAdd' => $getStudentList->address,
            'relation' => $getStudentList->relationship,
            'grade1' => $getgrade1,
            'schoolYear1' => $getGrade1s->schoolYear1,
            'school1' => $getGrade1s->school,
            'grade2' => $getgrade2,
            'schoolYear2' => $getGrade2s->schoolYear1,
            'school2' => $getGrade2s->school,
            'grade3' => $getgrade3,
            'schoolYear3' => $getGrade3s->schoolYear1,
            'school3' => $getGrade3s->school,
            'grade4' => $getgrade4,
            'schoolYear4' => $getGrade4s->schoolYear1,
            'school4' => $getGrade4s->school,
            'grade5' => $getgrade5,
            'schoolYear5' => $getGrade5s->schoolYear1,
            'school5' => $getGrade5s->school,
            'grade6' => $getgrade6,
            'schoolYear6' => $getGrade6s->schoolYear1,
            'school6' => $getGrade6s->school,
            'getSchoolYears' => $getSchoolYears,
            'kinderSubjects' => $getSubjects,
            'studentId' => $getStudentList->student_id,
            'infoId' => $infoId
        ];

        $this->view('registrar/elem-137', $data);
    }

    public function junior_list3()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $txtSearch = $_POST['txtSearch'];
            if ($txtSearch === '') {

                $getStudentList = $this->studentModel->getAllStudentsKinder();
                $data = [
                    'studentList' => $getStudentList
                ];

                $this->view('registrar/junior-list7-10', $data);
            } else {
                $getStudentList = $this->studentModel->getFilteredStudents($txtSearch);
                $data = [
                    'studentList' => $getStudentList
                ];

                $this->view('registrar/junior-list7-10', $data);
            }
        } else {
            $getStudentList = $this->studentModel->getAllStudentsKinder();
            $data = [
                'studentList' => $getStudentList
            ];

            $this->view('registrar/junior-list7-10', $data);
        }
    }

    public function high137($infoId)
    {

        if (empty($infoId)) {
            redirect('registrars/home');
        }
        $getStudentList = $this->studentModel->getAllStudentsKinder12($infoId);
        $getgrade7 = $this->studentModel->getGrade7($getStudentList->student_id);
        $getGrade7s = $this->studentModel->getGrade7s($getStudentList->student_id);
        $getgrade8 = $this->studentModel->getGrade8($getStudentList->student_id);
        $getGrade8s = $this->studentModel->getGrade8s($getStudentList->student_id);
        $getgrade9 = $this->studentModel->getGrade9($getStudentList->student_id);
        $getGrade9s = $this->studentModel->getGrade9s($getStudentList->student_id);
        $getgrade10 = $this->studentModel->getGrade10($getStudentList->student_id);
        $getGrade10s = $this->studentModel->getGrade10s($getStudentList->student_id);

        $getSchoolYears = $this->schoolyearModel->getSchoolYears();
        $getSubjects = $this->subjectModel->getAllKinderSubject();
        $data = [
            'studentName' => $getStudentList->lastName . ', ' . $getStudentList->firstName . ' ' . $getStudentList->middleName,
            'birthdate' => $getStudentList->birthdate,
            'birthPlace' => $getStudentList->birthplace,
            'address' => $getStudentList->siAdd,
            'gender' => $getStudentList->gender,
            'guardian' => $getStudentList->full_name,
            'guardianAdd' => $getStudentList->address,
            'relation' => $getStudentList->relationship,
            'grade7' => $getgrade7,
            'schoolYear7' => $getGrade7s->schoolYear1,
            'school7' => $getGrade7s->school,
            'grade8' => $getgrade8,
            'schoolYear8' => $getGrade8s->schoolYear1,
            'school8' => $getGrade8s->school,
            'grade9' => $getgrade9,
            'schoolYear9' => $getGrade9s->schoolYear1,
            'school9' => $getGrade9s->school,
            'grade10' => $getgrade10,
            'schoolYear10' => $getGrade10s->schoolYear1,
            'school10' => $getGrade10s->school,
            'getSchoolYears' => $getSchoolYears,
            'kinderSubjects' => $getSubjects,
            'studentId' => $getStudentList->student_id,
            'infoId' => $infoId
        ];

        $this->view('registrar/high-137', $data);
    }

    public function senior_records()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $txtSearch = $_POST['txtSearch'];
            if ($txtSearch === '') {
                $getAllSeniorHighStudentRecord = $this->studentModel->getAllSeniorHighRecordStudent();
                $data = [
                    'seniorStudentList' => $getAllSeniorHighStudentRecord
                ];
                $this->view('registrar/senior-list', $data);
            } else {
                $getAllSeniorHighStudentRecord = $this->studentModel->getAllSeniorHighRecordStudentLast($txtSearch);
                $data = [
                    'seniorStudentList' => $getAllSeniorHighStudentRecord
                ];
                $this->view('registrar/senior-list', $data);
            }
        } else {
            $getAllSeniorHighStudentRecord = $this->studentModel->getAllSeniorHighRecordStudent();
            $data = [
                'seniorStudentList' => $getAllSeniorHighStudentRecord
            ];
            $this->view('registrar/senior-list', $data);
        }
    }

    public function senior137($infoId)
    {
        if (empty($infoId)) {
            redirect('registrars/home');
        }
        $getSelectedSeniorRecords = $this->studentModel->getSelectedSeniorRecord($infoId);
        $getSeniorSubject11 = $this->subjectModel->getSeniorSubject11($getSelectedSeniorRecords->program_id, $getSelectedSeniorRecords->student_id);
        $getSeniorSubject11App = $this->subjectModel->getSeniorSubject11App($getSelectedSeniorRecords->program_id, $getSelectedSeniorRecords->student_id);
        $getSeniorSubject11s = $this->subjectModel->getSeniorSubject11s($getSelectedSeniorRecords->student_id);
        $getSeniorSubject12 = $this->subjectModel->getSeniorSubject12($getSelectedSeniorRecords->program_id, $getSelectedSeniorRecords->student_id);
        $getSeniorSubject12App = $this->subjectModel->getSeniorSubject12App($getSelectedSeniorRecords->program_id, $getSelectedSeniorRecords->student_id);
        $getSeniorSubject12s = $this->subjectModel->getSeniorSubject12s($getSelectedSeniorRecords->student_id);
        $getSeniorSubject21 = $this->subjectModel->getSeniorSubject21($getSelectedSeniorRecords->program_id, $getSelectedSeniorRecords->student_id);
        $getSeniorSubject21App = $this->subjectModel->getSeniorSubject21App($getSelectedSeniorRecords->program_id, $getSelectedSeniorRecords->student_id);
        $getSeniorSubject21s = $this->subjectModel->getSeniorSubject21s($getSelectedSeniorRecords->student_id);
        $getSeniorSubject22 = $this->subjectModel->getSeniorSubject22($getSelectedSeniorRecords->program_id, $getSelectedSeniorRecords->student_id);
        $getSeniorSubject22App = $this->subjectModel->getSeniorSubject22App($getSelectedSeniorRecords->program_id, $getSelectedSeniorRecords->student_id);
        $getSeniorSubject22s = $this->subjectModel->getSeniorSubject22s($getSelectedSeniorRecords->student_id);

        $data = [
            'studentName' => $getSelectedSeniorRecords->lname . ', ' . $getSelectedSeniorRecords->fname . ' ' . $getSelectedSeniorRecords->mname,
            'birthdate' => $getSelectedSeniorRecords->dobirth,
            'birthPlace' => $getSelectedSeniorRecords->pobirth,
            'address' => $getSelectedSeniorRecords->add1,
            'gender' => $getSelectedSeniorRecords->gender,
            'senior11' => $getSeniorSubject11,
            'senior11App' => $getSeniorSubject11App,
            'schoolYear11' => $getSeniorSubject11s->schoolYear,
            'schoolName11' =>  $getSeniorSubject11s->schoolName,
            'term11' =>  $getSeniorSubject11s->term,
            'senior12' => $getSeniorSubject12,
            'senior12App' => $getSeniorSubject12App,
            'schoolYear12' => $getSeniorSubject12s->schoolYear,
            'schoolName12' =>  $getSeniorSubject12s->schoolName,
            'term12' =>  $getSeniorSubject12s->term,
            'senior21' => $getSeniorSubject21,
            'senior21App' => $getSeniorSubject21App,
            'schoolYear21' => $getSeniorSubject21s->schoolYear,
            'schoolName21' =>  $getSeniorSubject21s->schoolName,
            'term21' =>  $getSeniorSubject21s->term,
            'senior22' => $getSeniorSubject22,
            'senior22App' => $getSeniorSubject22App,
            'schoolYear22' => $getSeniorSubject22s->schoolYear,
            'schoolName22' =>  $getSeniorSubject22s->schoolName,
            'term22' =>  $getSeniorSubject22s->term,
            'program' => $getSelectedSeniorRecords->progDes,
            'progCode' => $getSelectedSeniorRecords->progCode
        ];
        $this->view('registrar/senior-137', $data);
    }

    public function student_records()
    {
        $data = [];
        $this->view('registrar/student-records', $data);
    }

    public function junior_master_list()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $txtSearch = $_POST['txtSearch'];
            if ($txtSearch === '') {

                $getStudentList = $this->studentModel->getAllStudentsKinder();
                $data = [
                    'studentList' => $getStudentList
                ];

                $this->view('registrar/junior-master-list', $data);
            } else {
                $getStudentList = $this->studentModel->getFilteredStudents($txtSearch);
                $data = [
                    'studentList' => $getStudentList
                ];

                $this->view('registrar/junior-master-list', $data);
            }
        } else {
            $getStudentList = $this->studentModel->getAllStudentsKinder();
            $data = [
                'studentList' => $getStudentList
            ];

            $this->view('registrar/junior-master-list', $data);
        }
    }

    public function junior_grades($infoId)
    {
        if (empty($infoId)) {
            redirect('registrars/home');
        }
        $getStudentList = $this->studentModel->getAllStudentsKinder12($infoId);
        $getJuniorGradeSummaryAll = $this->gradeModel->getJuniorGradeSummaryAll($getStudentList->student_id);
        $schoolYear = $this->schoolModel->getSchoolYears();

        $data = [
            'studentName' => $getStudentList->lastName . ', ' . $getStudentList->firstName . ' ' . $getStudentList->middleName,
            'studentNo' =>  $getStudentList->student_id,
            'infoId' => $infoId,
            'gradelist' => $getJuniorGradeSummaryAll,
            'schoolYear' => $schoolYear
        ];
        $this->view('registrar/junior-grades', $data);
    }

    public function senior_master_list()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $txtSearch = $_POST['txtSearch'];
            if ($txtSearch === '') {
                $getAllSeniorHighStudentRecord = $this->studentModel->getAllSeniorHighRecordStudent();
                $data = [
                    'seniorStudentList' => $getAllSeniorHighStudentRecord
                ];
                $this->view('registrar/senior-master-list', $data);
            } else {
                $getAllSeniorHighStudentRecord = $this->studentModel->getAllSeniorHighRecordStudentLast($txtSearch);
                $data = [
                    'seniorStudentList' => $getAllSeniorHighStudentRecord
                ];
                $this->view('registrar/senior-master-list', $data);
            }
        } else {
            $getAllSeniorHighStudentRecord = $this->studentModel->getAllSeniorHighRecordStudent();
            $data = [
                'seniorStudentList' => $getAllSeniorHighStudentRecord
            ];
            $this->view('registrar/senior-master-list', $data);
        }
    }

    public function student_offline()
    {
        $data = [];
        $this->view('registrar/offline', $data);
    }

    public function junior_offline_list()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $txtSearch = $_POST['txtSearch'];
            if ($txtSearch === '') {

                $getStudentList = $this->studentModel->getAllStudentsKinder();
                $data = [
                    'studentList' => $getStudentList
                ];

                $this->view('registrar/junior_offline', $data);
            } else {
                $getStudentList = $this->studentModel->getFilteredStudents($txtSearch);
                $data = [
                    'studentList' => $getStudentList
                ];

                $this->view('registrar/junior_offline', $data);
            }
        } else {
            $getStudentList = $this->studentModel->getAllStudentsKinder();
            $data = [
                'studentList' => $getStudentList
            ];

            $this->view('registrar/junior_offline', $data);
        }
    }

    public function senior_offline_list()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $txtSearch = $_POST['txtSearch'];
            if ($txtSearch === '') {
                $getAllSeniorHighStudentRecord = $this->studentModel->getAllSeniorHighRecordStudent();
                $data = [
                    'seniorStudentList' => $getAllSeniorHighStudentRecord
                ];
                $this->view('registrar/senior-offline', $data);
            } else {
                $getAllSeniorHighStudentRecord = $this->studentModel->getAllSeniorHighRecordStudentLast($txtSearch);
                $data = [
                    'seniorStudentList' => $getAllSeniorHighStudentRecord
                ];
                $this->view('registrar/senior-offline', $data);
            }
        } else {
            $getAllSeniorHighStudentRecord = $this->studentModel->getAllSeniorHighRecordStudent();
            $data = [
                'seniorStudentList' => $getAllSeniorHighStudentRecord
            ];
            $this->view('registrar/senior-offline', $data);
        }
    }

    public function junior_register_offline($infoId)
    {
        if (empty($infoId)) {
            redirect('registrars/home');
        }
        $getStudentList = $this->studentModel->getAllStudentsKinder12($infoId);
        $getEnrolleeList = $this->schoolModel->getEnrolleeList($_SESSION['school_year']);
        $data = [
            'studentName' => $getStudentList->lastName . ', ' . $getStudentList->firstName . ' ' . $getStudentList->middleName,
            'studentNo' =>  $getStudentList->student_id,
            'infoId' => $infoId,
            'enrollees' => $getEnrolleeList
        ];
        $this->view('registrar/junior-register-offline', $data);
    }

    public function senior_register_offline($infoId)
    {
        if (empty($infoId)) {
            redirect('registrars/home');
        }
        $getSelectedSeniorRecords = $this->studentModel->getSelectedSeniorRecord($infoId);
        $getSeniorAvailableSubjectSched = $this->subjectModel->getSeniorAvailableSubjectSched($getSelectedSeniorRecords->program_id, $_SESSION['sem_name'], $getSelectedSeniorRecords->student_id);
        $getEnrolledSubjectListStudent = $this->subjectModel->getEnrolledSubjectListStudent($getSelectedSeniorRecords->student_id, $_SESSION['sem_name']);
        $data = [
            'studentName' => $getSelectedSeniorRecords->lname . ', ' . $getSelectedSeniorRecords->fname . ' ' . $getSelectedSeniorRecords->mname,
            'studentId' => $getSelectedSeniorRecords->student_id,
            'strand' => $getSelectedSeniorRecords->progCode . ' - ' . $getSelectedSeniorRecords->progDes,
            'schedule' => $getSeniorAvailableSubjectSched,
            'programId' => $getSelectedSeniorRecords->program_id,
            'subjectEnrolledLIst' => $getEnrolledSubjectListStudent
        ];
        $this->view('registrar/senior-register-offline', $data);
    }

    public function student_subjects()
    {
        $academicLevel = 'Senior High School';
        $getSeniorStrand = $this->schoolModel->getSeniorStrand($academicLevel);

        $data = [
            'seniorStrand' => $getSeniorStrand

        ];
        $this->view('registrar/senior-strand', $data);
    }

    public function student_subjects_strand($programId)
    {
        if (empty($programId)) {
            redirect('registrars/home');
        }

        $getSeniorSubjectsList = $this->subjectModel->getSeniorSubjectsList($programId);
        $getProgram = $this->schoolModel->getProgram($programId);
        $getSeniorSubjectFromCourse = $this->subjectModel->getSeniorSubjectFromCourse($programId);
        $data = [
            'seniorSubjects' => $getSeniorSubjectsList,
            'seniorData' => $getSeniorSubjectFromCourse,
            'subjectCode' => $getProgram->code,
            'subjectDes' => $getProgram->description,
            'programId' => $programId
        ];
        $this->view('registrar/senior-subjects', $data);
    }

    public function senior_grades($infoId)
    {
        if (empty($infoId)) {
            redirect('resgistrars/home');
        }
        $getSelectedSeniorRecords = $this->studentModel->getSelectedSeniorRecord($infoId);
        $getSchoolYear = $this->schoolModel->getHighSchoolYear();
        $getSeniorSubjectFromCourse = $this->subjectModel->getSeniorSubjectFromCourseS($getSelectedSeniorRecords->program_id);
        $getSeniorSubjectFinalAll = $this->subjectModel->getSeniorSubjectFinalAll($getSelectedSeniorRecords->student_id);
        $data = [
            'studentName' => $getSelectedSeniorRecords->lname . ', ' . $getSelectedSeniorRecords->fname . ' ' . $getSelectedSeniorRecords->mname,
            'studentId' => $getSelectedSeniorRecords->student_id,
            'strand' => $getSelectedSeniorRecords->progCode . ' - ' . $getSelectedSeniorRecords->progDes,
            'infoId' => $infoId,
            'schoolYear' => $getSchoolYear,
            'seniorData' => $getSeniorSubjectFromCourse,
            'programId' => $getSelectedSeniorRecords->program_id,
            'seniorSubjects' => $getSeniorSubjectFinalAll
        ];
        $this->view('registrar/senior-grades', $data);
    }

    public function grade_submissions()
    {
        $data = [];
        $this->view('registrar/grade-submission', $data);
    }

    public function junior_submission()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $txtSearch = $_POST['txtSearch'];
            if ($txtSearch === '') {
                $getJuniorSubmissionAll = $this->subjectModel->getJuniorHistoryAll();
                $data = [
                    'juniorSubjects' => $getJuniorSubmissionAll
                ];
                $this->view('registrar/junior-submission', $data);
            } else {
                $getJuniorSubmissionAllS = $this->subjectModel->getJuniorHistoryAllS($txtSearch);
                $data = [
                    'juniorSubjects' => $getJuniorSubmissionAllS
                ];
                $this->view('registrar/junior-submission', $data);
            }
        } else {
            $getJuniorSubmissionAll = $this->subjectModel->getJuniorHistoryAll();
            $data = [
                'juniorSubjects' => $getJuniorSubmissionAll
            ];
            $this->view('registrar/junior-submission', $data);
        }
    }

    public function senior_submission()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $txtSearch = $_POST['txtSearch'];
            if ($txtSearch === '') {
                $getSeniorSubmissionAll = $this->subjectModel->getSeniorHistoryAll();
                $data = [
                    'seniorSubjects' => $getSeniorSubmissionAll
                ];
                $this->view('registrar/senior-submission', $data);
            } else {
                $getSeniorSubmissionAllS = $this->subjectModel->getSeniorHistoryAllS($txtSearch);
                $data = [
                    'seniorSubjects' => $getSeniorSubmissionAllS
                ];
                $this->view('registrar/senior-submission', $data);
            }
        } else {
            $getSeniorSubmissionAll = $this->subjectModel->getSeniorHistoryAll();
            $data = [
                'seniorSubjects' => $getSeniorSubmissionAll
            ];
            $this->view('registrar/senior-submission', $data);
        }
    }

    public function junior_submission_list($subjectId, $schoolYear)
    {
        if (empty($schoolYear)) {
            redirect('registrars/home');
        }

        $gradeSource = 'written works';
        $gradeQuarter = '1st quarter';
        $jrHighScore = $this->gradeModel->getJrHighSCore($subjectId, $gradeSource, $gradeQuarter, $schoolYear);
        $subjectNameAll = $this->subjectModel->subjectNameAll($subjectId, $schoolYear);
        $sectionStudents = $this->studentModel->getJuniorStudentsBysubjects($subjectId, $schoolYear);
        $data = [
            'studentInfo' => $sectionStudents,
            'subjectId' => $subjectId,
            'schoolYear' => $schoolYear,
            'jrHighScore' => $jrHighScore,
            'subjectName' => $subjectNameAll->subject_name
        ];

        $this->view('registrar/junior-submission-list', $data);
    }

    public function junior_submission_summary($subjectId, $schoolYear)
    {
        if ($schoolYear === '') {
            redirect('registrars/home');
        }
        $getJuniorFinalHistory = $this->gradeModel->getJuniorFinalHistory($subjectId, $schoolYear);
        $getJuniorFinalHistoryC = $this->gradeModel->getJuniorFinalHistoryC($subjectId, $schoolYear);
        $data = [
            'studentInfo' => $getJuniorFinalHistory,
            'subjectName' => $getJuniorFinalHistoryC->subject_name,
            'schoolYear' => $getJuniorFinalHistoryC->school_year,
            'gradeLevel' => $getJuniorFinalHistoryC->grade_level,
            'subjectId' => $subjectId,
            'schoolYears' => $schoolYear
        ];
        $this->view('registrar/junior-submission-summary', $data);
    }

    public function senior_submission_list($subjectId, $sem, $schoolYear)
    {
        if ($schoolYear === '') {
            redirect('registrars/home');
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
                $subjectNameAllSr = $this->subjectModel->subjectNameAllSr($subjectId, $jointSchoolYear, $sem);
                $srHighScore = $this->gradeModel->getSrHighSCore($subjectId, $gradeSource, $quarter, $jointSchoolYear);

                $data = [
                    'studentInfo' => $getSrStudents,
                    'subjectName' =>  $subjectNameAllSr->subject_name,
                    'subjectId' => $subjectId,
                    'jrHighScore' => $srHighScore,
                    'schoolYear' => $jointSchoolYear,
                    'sem' => $sem
                ];
                $this->view('registrar/senior-submission-list1', $data);
                break;
            case 2:
                $getSrStudents = $this->studentModel->getSeniorStudentsBysubjects($subjectId, $jointSchoolYear, $quarter,  $gradeSource);
                $subjectNameAllSr = $this->subjectModel->subjectNameAllSr($subjectId, $jointSchoolYear, $sem);
                $srHighScore = $this->gradeModel->getSrHighSCore($subjectId, $gradeSource, $quarter, $jointSchoolYear);

                $data = [
                    'studentInfo' => $getSrStudents,
                    'subjectName' =>  $subjectNameAllSr->subject_name,
                    'subjectId' => $subjectId,
                    'jrHighScore' => $srHighScore,
                    'schoolYear' => $jointSchoolYear,
                    'sem' => $sem
                ];
                $this->view('registrar/senior-submission-list2', $data);
                break;
        }
    }

    public function senior_submission_summary($subjectId, $sem, $schoolYear)
    {
        if ($schoolYear === '') {
            redirect('registrars/home');
        }
        $explodedSchoolYear = explode('-', $schoolYear);
        $jointSchoolYear = $explodedSchoolYear[0] . ' - ' . $explodedSchoolYear[1];

        $getSeniorFinalHistory = $this->gradeModel->getSeniorFinalHistory($subjectId, $sem, $jointSchoolYear);
        $getSeniorFinalHistoryC = $this->gradeModel->getSeniorFinalHistoryC($subjectId, $sem, $jointSchoolYear);
        $data = [
            'studentInfo' => $getSeniorFinalHistory,
            'sem' => $sem,
            'schoolYear' => $jointSchoolYear,
            'subjectId' => $subjectId,
            'subjectName' => $getSeniorFinalHistoryC->subject_name,
            'yearLevel' => $getSeniorFinalHistoryC->year_level,
            'subjectDescription' => $getSeniorFinalHistoryC->subject_description
        ];
        $this->view('registrar/senior-submission-summary', $data);
    }

    public function transcript()
    {
        $getAllHigherStudentNameRecords = $this->studentModel->getAllHigherStudentNameRecords();
        $data = [
            'higherStudents' => $getAllHigherStudentNameRecords
        ];

        $this->view('registrar/transcript-of-records', $data);
    }

    public function higher_transcript($infoId)
    {
        if (empty($infoId)) {
            redirect('registrars/home');
        }
        $getSelectedHigherRecords = $this->studentModel->getSelectedHigherRecord($infoId);
        $getHigherProgram = $this->schoolModel->getHigherProgram($getSelectedHigherRecords->program_id);
        $getSubject11 = $this->subjectModel->getSubject11($getSelectedHigherRecords->program_id, $getSelectedHigherRecords->student_id);
        $getAllGradesTorS = $this->gradeModel->getAllGradesTorS($getSelectedHigherRecords->student_id);
        $getAllGradesTor = $this->gradeModel->getAllGradesTor($getSelectedHigherRecords->student_id);

        $data = [
            'studentName' => $getSelectedHigherRecords->lname . ', ' . $getSelectedHigherRecords->fname . ' ' . $getSelectedHigherRecords->mname,
            'birthdate' => $getSelectedHigherRecords->dobirth,
            'birthPlace' => $getSelectedHigherRecords->pobirth,
            'address' => $getSelectedHigherRecords->add1,
            'gender' => $getSelectedHigherRecords->gender,
            'course' => $getHigherProgram->description,
            'major' => $getHigherProgram->major,
            'getSubject11' => $getAllGradesTorS,
            'getSubjectGrade' => $getAllGradesTor

        ];

        $this->view('registrar/higher_transcript', $data);
    }

    public function higher_submissions()
    {
        $getHigherSubjectFinals = $this->subjectModel->getHigherSubjectFinals();
        $data = [
            'higherSubjects' => $getHigherSubjectFinals
        ];
        $this->view('registrar/higher-submissions', $data);
    }

    public function higher_submission_list($id, $sem, $schoolYear)
    {
        if (empty($schoolYear)) {
            redirect('registrars/home');
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
        $this->view('registrar/higher-submissions-finals', $data);
    }

    public function register_offline()
    {
        $getAllHigherStudentNameRecords = $this->studentModel->getAllHigherStudentNameRecords();
        $data = [
            'higherStudents' => $getAllHigherStudentNameRecords
        ];

        $this->view('registrar/college-offline', $data);
    }

    public function higher_offline($infoId)
    {
        if (empty($infoId)) {
            redirect('registrars/home');
        }

        $getSelectedHigherRecord = $this->studentModel->getSelectedHigherRecord($infoId);
        $getHigherAvailableSubjectSched = $this->subjectModel->getHigherAvailableSubjectSched($getSelectedHigherRecord->program_id, $_SESSION['sem_name'], $getSelectedHigherRecord->student_id, $_SESSION['sem_termNum']);
        $getEnrolledSubjectListStudent = $this->subjectModel->getEnrolledSubjectListStudentS($getSelectedHigherRecord->student_id, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        $data = [
            'studentName' => $getSelectedHigherRecord->lname . ', ' . $getSelectedHigherRecord->fname . ' ' . $getSelectedHigherRecord->mname,
            'studentId' => $getSelectedHigherRecord->student_id,
            'strand' => $getSelectedHigherRecord->progCode . ' - ' . $getSelectedHigherRecord->progDes,
            'programId' => $getSelectedHigherRecord->program_id,
            'schedule' => $getHigherAvailableSubjectSched,
            'subjectEnrolledLIst' => $getEnrolledSubjectListStudent
        ];
        $this->view('registrar/higher-offline', $data);
    }

    public function higher_subjects()
    {
        $getHigherCourses = $this->schoolModel->getHigherCourses('Senior High School');
        $data = [
            'higherCourses' => $getHigherCourses
        ];
        $this->view('registrar/higher-subjects', $data);
    }

    public function student_subjects_course($programId)
    {
        if (empty($programId)) {
            redirect('registrars/home');
        }
        $getcoursebyprogram = $this->schoolModel->getcoursebyprogram($programId);
        $getHigherSubjectList = $this->schoolModel->getHigherSubjectList($programId);
        $getCourseSubjectAssign = $this->schoolModel->getCourseSubjectAssign($programId);
        $data = [
            'subjectCode' => $getcoursebyprogram->code,
            'subjectDes' => $getcoursebyprogram->description,
            'higherSubject' => $getHigherSubjectList,
            'subjectCourseAssign' => $getCourseSubjectAssign,
            'programId' => $programId
        ];
        $this->view('registrar/student-subjects-course', $data);
    }

    public function higher_records()
    {
        $getAllHigherStudentNameRecords = $this->studentModel->getAllHigherStudentNameRecords();
        $data = [
            'higherStudents' => $getAllHigherStudentNameRecords
        ];
        $this->view('registrar/higher-records', $data);
    }

    public function higher_transfer_record($infoId)
    {
        if (empty($infoId)) {
            redirect('registrars/home');
        }

        $getHigherStudentsInfo = $this->studentModel->getHigherStudentsInfo($infoId);
        $getSubjectByCourseTransfer = $this->subjectModel->getSubjectByCourseTransfer($getHigherStudentsInfo->program_id);
        $getSchoolYear = $this->schoolModel->getHighSchoolYear();
        $getAllSubjectsHigherByStudent = $this->schoolModel->getAllSubjectsHigherByStudent($getHigherStudentsInfo->student_id);

        $data = [
            'studentName' => $getHigherStudentsInfo->lname . ', ' . $getHigherStudentsInfo->fname . ' ' . $getHigherStudentsInfo->mname,
            'studentId' => $getHigherStudentsInfo->student_id,
            'course' => $getHigherStudentsInfo->code,
            'higherData' => $getSubjectByCourseTransfer,
            'programId' => $getHigherStudentsInfo->program_id,
            'infoId' => $infoId,
            'schoolYear' => $getSchoolYear,
            'higherSubjects' => $getAllSubjectsHigherByStudent
        ];
        $this->view('registrar/higher-transfer-record', $data);
    }

    public function instructor_sched()
    {
        $department = $_SESSION['department'];
        $newDepartment = 'Senior High School';
        $schedData = new \stdClass;
        $getDepartments = $this->schoolModel->getDepartments('education');
        if ($department === 'Basic Education') {
            $schedData = $this->schoolModel->getSchedDataSenior($newDepartment, $_SESSION['sem_name']);
        } else {
            $schedData = $this->schoolModel->getSchedDataHigher($newDepartment, $_SESSION['sem_name'], $_SESSION['sem_termNum']);
        }
        $data = [
            'subjectSchedule' => $schedData,
            'departments' => $getDepartments
        ];
        $this->view('registrar/instructor-sched', $data);
    }
}
