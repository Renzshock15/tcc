<?php

class Admins extends Controller
{
    public function __construct()
    {
        if (isLoggedIn('user_admin')) {
            redirect('users/cz_admin');
        }

        $this->userModel = $this->model('User');
        $this->schoolyearModel = $this->model('School');
    }

    public function index()
    {
        //redirect user to login page
        redirect('admins/home');
    }

    public function home()
    {
        $getAdminsAll = $this->userModel->getAdminsAll();
        $getAdminsAllFull = $this->userModel->getAdminsAllFull();
        $data = [
            'users' => $getAdminsAll,
            'admin' => $getAdminsAllFull
        ];
        $this->view('admins/home', $data);
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
                $checkAdminId = $this->userModel->checkAdminId($userId);
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
                $checkIfAdminExist = $this->userModel->getAdminData($userId, $oldPass);

                if ($checkIfAdminExist) {
                    $rehashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    $updateAdmin = $this->userModel->updateAdminPass($userId, $rehashedPassword);
                    if ($updateAdmin) {
                        flash('update_success', 'Password successfully updated');
                    } else {
                        flash('update_success', 'Failed to update password', 'aler alert-danger');
                    }
                } else {
                    $data['old_password_err'] = 'Old password is invalid';
                }
            }


            $this->view('admins/changepass', $data);
        } else {
            $data = [
                'user_err' => '',
                'old_password_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            $this->view('admins/changepass', $data);
        }
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
                $checkAdminId = $this->userModel->checkAdminId($oldUserId);
                if ($checkAdminId) {
                } else {
                    $data['old_user_err'] = 'User Id is invalid';
                }
            }
            if (empty($newUserId)) {
                $data['new_user_err'] = 'Please enter your new user id';
            } else {
                $checkAdminIds = $this->userModel->checkAdminId($newUserId);

                if ($checkAdminIds) {
                    $data['new_user_err'] = 'User Id already taken';
                }
            }

            if (empty($data['old_user_err']) && empty($data['new_user_err'])) {


                $updateAdminId = $this->userModel->updateAdminId($newUserId, $_SESSION['id']);

                if ($updateAdminId) {
                    flash('update_success', 'User Id successfully updated');
                } else {
                    flash('update_success', 'Failed to update user id', 'aler alert-danger');
                }
            }


            $this->view('admins/changeuserid', $data);
        } else {
            $data = [
                'old_user_err' => '',
                'new_user_err' => ''
            ];
            $this->view('admins/changeuserid', $data);
        }
    }

    public function administrator()
    {
        $getAdmins = $this->userModel->showAdmins();
        $data = [
            'admins' => $getAdmins,
            'adminRole' => $_SESSION['role'],
            'adminId' => $_SESSION['id']
        ];

        $this->view('admins/user-admins', $data);
    }

    public function registrar()
    {
        $showRegistrars = $this->userModel->getRegistrars();
        $data = [
            'userRegistrar' => $showRegistrars
        ];

        $this->view('admins/user-registrar', $data);
    }

    public function instructors()
    {
        $getAllTeacher = $this->userModel->getAllTeacher();
        $getDep = $this->schoolyearModel->getDepartments('education');
        $data = [
            'teachers' => $getAllTeacher,
            'departments' => $getDep
        ];
        $this->view('admins/instructors', $data);
    }
}
