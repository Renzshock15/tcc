<?php

class Users extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->schoolyearModel = $this->model('School');
    }

    public function index()
    {
        //redirect user to login page
        redirect('users/login');
    }


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Sanitize array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'userId' => trim($_POST['txtstudent-no']),
                'password' => trim($_POST['txtpassword']),
                'errorMsg' => "",
                'access_level' => ""
            ];

            //Validate empty user id and password
            if (empty($data['userId']) || empty($data['password'])) {
                $data['errorMsg'] = 'Please fill all fields';
            }

            //user id and password are not empty
            if (empty($data['errorMsg'])) {
                $userInfo = $this->userModel->getAllUser($data['userId']);

                //if gets user data
                if ($userInfo) {
                    foreach ($userInfo as $rowInfo) {

                        //this verified password
                        if ($this->passwordVerify($data['password'], $rowInfo->password)) {

                            //school year set
                            $setSchool = $this->schoolyearModel->getSchoolYear();
                            $this->setSchoolYearSession($setSchool);

                            //sem set
                            $setSem = $this->schoolyearModel->getSemester();
                            $this->setSemesterSession($setSem);

                            //create session
                            $this->createUserSession($rowInfo, $data['userId']);
                        } else {
                            $data['errorMsg'] = 'Password is incorrect';
                        }
                    }
                } else {
                    $data['errorMsg'] = 'Invalid user id';
                }
            }
            $this->view('users/index', $data);
        } else {
            $data = [
                'userId' => "",
                'password' => "",
                'errorMsg' => ""
            ];

            $this->view('users/index', $data);
        }
    }

    public function cz_admin()
    {
        $accountExist = $this->userModel->checkIfThereIsAccount();

        if ($accountExist) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['btn-login'])) {
                    $data = [
                        'userId' => trim($_POST['txtstudent-no']),
                        'password' => trim($_POST['txtpassword']),
                        'errorMsg' => "",
                        'access_level' => ""
                    ];


                    if (empty($data['userId']) || empty($data['password'])) {
                        $data['errorMsg'] = 'Please fill all fields';
                    }

                    if (empty($data['errorMsg'])) {
                        $isAdminLoggedIn = $this->userModel->getAdmin($data['userId']);

                        if ($isAdminLoggedIn) {
                            if ($isAdminLoggedIn->is_active == 1) {
                                if ($this->passwordVerify($data['password'], $isAdminLoggedIn->password)) {
                                    $_SESSION['id'] = $isAdminLoggedIn->id;
                                    $_SESSION['access_level'] = $isAdminLoggedIn->access_level;
                                    $_SESSION['role'] =  $isAdminLoggedIn->role;
                                    $_SESSION['first_name'] = $isAdminLoggedIn->first_name;
                                    $_SESSION['last_name'] = $isAdminLoggedIn->last_name;
                                    redirect('admins');
                                } else {
                                    $data['errorMsg'] = 'Password is incorrect';
                                }
                            } else {
                                $data['errorMsg'] = 'Sorry you are not active';
                            }
                        } else {
                            $data['errorMsg'] = 'Invalid User Id';
                        }
                    }


                    $this->view('users/cz-login', $data);
                }
            } else {
                $data = [
                    'userId' => "",
                    'password' => "",
                    'errorMsg' => ""
                ];
                $this->view('users/cz-login', $data);
            }
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['btnCreate'])) {
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $userId = $_POST['userId'];
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirm_password'];

                    $data = [
                        'first_name_err' => '',
                        'last_name_err' => '',
                        'user_id_err' => '',
                        'password_err' => '',
                        'confirm_password_err' => ''
                    ];
                    if (empty($firstName)) {
                        $data['first_name_err'] = 'Please fill first name';
                    }
                    if (empty($lastName)) {
                        $data['last_name_err'] = 'Please fill last name';
                    }
                    if (empty($userId)) {
                        $data['user_id_err'] = 'Please fill user id';
                    }
                    if (empty($password)) {
                        $data['password_err'] = 'PLease fill password';
                    }
                    if (empty($confirm_password)) {
                        $data['confirm_password_err'] = 'Please confirm your password';
                    } elseif ($confirm_password != $password) {
                        $data['confirm_password_err'] = 'Password not match';
                    }

                    if (empty($data['first_name_err']) && empty($data['last_name_err']) && empty($data['user_id_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
                        $adminRegistered = $this->userModel->insertAdmin($firstName, $lastName, $userId, $passwordHashed);

                        if ($adminRegistered) {
                            flash('create_success', 'Admin successfully created ' . '<a href="' . URLROOT . '/users/cz_admin">Login Now?</a>');
                        } else {
                            flash('create_success', 'Failed to create admin', 'aler alert-danger');
                        }
                    }

                    $this->view('users/cz-registration', $data);
                }
            } else {
                $data = [
                    'first_name_err' => '',
                    'last_name_err' => '',
                    'user_id_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
                $this->view('users/cz-registration', $data);
            }
        }
    }

    //this check if password are the same
    private function passwordVerify($password, $hash_password)
    {
        if (password_verify($password, $hash_password)) {
            return true;
        } else {
            return false;
        }
    }

    //Create sessions
    public function createUserSession($usersInfo, $userId)
    {
        $_SESSION['id'] = $usersInfo->id;
        $_SESSION['first_name'] = $usersInfo->first_name;
        $_SESSION['last_name'] = $usersInfo->last_name;
        $_SESSION['middle_name'] = $usersInfo->middle_name;
        $_SESSION['access_level'] = $usersInfo->access_level;
        $_SESSION['user_id'] = $userId;

        //Redirect to page
        $access_level = $_SESSION['access_level'];
        switch ($access_level) {
            case 0:
                $studentLevel = $this->userModel->getUserLevel($usersInfo->id);
                $_SESSION['studentLevel'] = $studentLevel;
                redirect('students');
                break;
            case 5:
                redirect('teachers');
                break;
            case 2:
                $departmentLevel = $this->userModel->getRegistrarDepartment($usersInfo->id);
                $_SESSION['department'] = $departmentLevel->department;
                $_SESSION['role'] = $departmentLevel->role;
                redirect('registrars');
                break;
        }
    }

    //school year session
    public function setSchoolYearSession($schoolYears)
    {
        $schoolYear = $schoolYears;

        if (!empty($schoolYear)) {

            $_SESSION['school_year'] = $schoolYear->term_name;
        } else {
            die('Oops somethings went wroong');
        }
    }

    //sem session
    public function setSemesterSession($semester)
    {
        $semesters = $semester;

        if (!empty($semesters)) {
            foreach ($semesters as $setsem) {
                $_SESSION['sem_name'] = $setsem->sem_NAME;
                $_SESSION['sem_term'] = $setsem->term_name;
                $_SESSION['sem_termNum'] = $setsem->sem_TERM;
            }
        } else {
            die('Oops somethings went wroong');
        }
    }

    //unset sessions
    public function logout()
    {
        unset($_SESSION['id']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        unset($_SESSION['middle_name']);
        unset($_SESSION['access_level']);
        unset($_SESSION['user_id']);
        unset($_SESSION['school_year']);
        unset($_SESSION['sem_name']);
        session_destroy();
        redirect('users/index');
    }
}
