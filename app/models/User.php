<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllUser($userId)
    {
        $this->db->query("SELECT * FROM instructors WHERE employee_id = :userId");
        $this->db->bind('userId', $userId);
        $row[] = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $this->db->query("SELECT * FROM student_accounts WHERE student_id = :userId");
            $this->db->bind('userId', $userId);
            $newRow[] = $this->db->single();

            if ($this->db->rowCount() > 0) {
                return $newRow;
            } else {
                $this->db->query("SELECT * FROM grading_user_registrars WHERE user_id = :userId AND is_active = 1");
                $this->db->bind('userId', $userId);
                $newRows[] = $this->db->single();

                if ($this->db->rowCount() > 0) {
                    return $newRows;
                } else {
                    return false;
                }
            }
        }
    }

    public function checkInStudentsAccount($id, $studentId)
    {
        $this->db->query("SELECT * FROM col_student WHERE account_id = :id");
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row->student_id;
        } else {
            return $studentId;
        }
    }

    public function getUserLevel($userId)
    {
        $this->db->query("SELECT * FROM col_student INNER JOIN col_curriculum ON col_student.curr_id = col_curriculum.id
                        INNER JOIN col_program ON col_curriculum.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE account_id = :id");
        $this->db->bind(':id', $userId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row->cat_name;
        } else {
            return 'Junior High School';
        }
    }

    public function getStudentCourse($userId)
    {
        $this->db->query("SELECT *,col_program.description as courseDescription FROM col_student INNER JOIN col_curriculum ON col_student.curr_id = col_curriculum.id
        INNER JOIN col_program ON col_curriculum.program_id = col_program.id
        WHERE account_id = :id");
        $this->db->bind(':id', $userId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function checkIfThereIsAccount()
    {
        $this->db->query("SELECT * FROM grading_administrator");
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertAdmin($firstName, $lastName, $userId, $passwordHashed)
    {
        $role = 'full';
        $this->db->query("INSERT INTO grading_administrator (user_id, password, first_name, last_name, role) VALUES (:userId, :passwordHashed, :firstName, :lastName, :role)");
        $this->db->bind(':userId', $userId);
        $this->db->bind(':passwordHashed', $passwordHashed);
        $this->db->bind(':firstName', $firstName);
        $this->db->bind(':lastName', $lastName);
        $this->db->bind(':role', $role);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAdmin($userId)
    {
        $this->db->query("SELECT * FROM grading_administrator WHERE user_id = :userId");
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAdminData($userId, $oldPass)
    {
        $this->db->query("SELECT * FROM grading_administrator WHERE user_id = :userId");
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            $passVeify = password_verify($oldPass, $row->password);
            if ($passVeify) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkAdminId($userId)
    {
        $this->db->query("SELECT * FROM grading_administrator WHERE user_id = :userId");
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAdminPass($userId, $rehashedPassword)
    {
        $this->db->query("UPDATE grading_administrator SET password = :rehashedPassword WHERE user_id = :userId");
        $this->db->bind(':rehashedPassword', $rehashedPassword);
        $this->db->bind(':userId', $userId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAdminId($newUserId, $id)
    {
        $this->db->query("UPDATE grading_administrator SET user_id = :newUserId WHERE id =:id");
        $this->db->bind(':newUserId', $newUserId);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function showAdmins()
    {
        $this->db->query("SELECT * FROM grading_administrator");


        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function addNewAdmin($fname, $lname, $userId, $role)
    {
        $passwordHashed = password_hash('admin1234', PASSWORD_BCRYPT);
        $this->db->query("INSERT INTO grading_administrator (user_id, password, first_name, last_name, role) VALUES (:userId, :passwordHashed, :fname, :lname, :role)");
        $this->db->bind(':userId', $userId);
        $this->db->bind(':passwordHashed', $passwordHashed);
        $this->db->bind(':fname', $fname);
        $this->db->bind(':lname', $lname);
        $this->db->bind(':role', $role);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAdminRole($adminId, $newRole, $target)
    {
        $this->db->query("UPDATE grading_administrator SET $target = :newRole WHERE id = :adminId");

        $this->db->bind(':newRole', $newRole);
        $this->db->bind(':adminId', $adminId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAdminUser($adminId)
    {
        $this->db->query("DELETE FROM grading_administrator WHERE id = :adminId");
        $this->db->bind(':adminId', $adminId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRegistrars()
    {
        $this->db->query("SELECT * FROM grading_user_registrars");

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function checkRegisrarId($userId)
    {
        $this->db->query("SELECT * FROM grading_user_registrars WHERE user_id = :userId");
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addRegistrar($fname, $lname, $userId, $department)
    {
        $password = password_hash('admin1234', PASSWORD_BCRYPT);
        $role = 'full';
        $this->db->query("INSERT INTO grading_user_registrars(user_id, password, first_name, last_name, department, role) VALUES(:userId, :password, :fname, :lname, :department, :role)");
        $this->db->bind(':userId', $userId);
        $this->db->bind(':password', $password);
        $this->db->bind(':fname', $fname);
        $this->db->bind(':lname', $lname);
        $this->db->bind(':department', $department);
        $this->db->bind(':role', $role);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRegistrarDepartment($id)
    {
        $this->db->query("SELECT * FROM grading_user_registrars WHERE id = :id");
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function checkRegistrarId($userId)
    {
        $this->db->query("SELECT * FROM grading_user_registrars WHERE user_id = :userId");
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateRegistrarId($newUserId, $id)
    {
        $this->db->query("UPDATE grading_user_registrars SET user_id = :newUserId WHERE id =:id");
        $this->db->bind(':newUserId', $newUserId);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRegistrarData($userId, $oldPass)
    {
        $this->db->query("SELECT * FROM grading_user_registrars WHERE user_id = :userId");
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            $passVeify = password_verify($oldPass, $row->password);
            if ($passVeify) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateRegPass($userId, $rehashedPassword)
    {
        $this->db->query("UPDATE grading_user_registrars SET password = :rehashedPassword WHERE user_id = :userId");
        $this->db->bind(':rehashedPassword', $rehashedPassword);
        $this->db->bind(':userId', $userId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRegistrarUser($department)
    {
        $this->db->query("SELECT * FROM grading_user_registrars WHERE department = :department");
        $this->db->bind(':department', $department);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function addUserRegistrar($fname, $lname, $userId, $role, $adminDepartment)
    {
        $password = password_hash('admin1234', PASSWORD_BCRYPT);

        $this->db->query("INSERT INTO grading_user_registrars(user_id, password, first_name, last_name, department, role) VALUES(:userId, :password, :fname, :lname, :department, :role)");
        $this->db->bind(':userId', $userId);
        $this->db->bind(':password', $password);
        $this->db->bind(':fname', $fname);
        $this->db->bind(':lname', $lname);
        $this->db->bind(':department', $adminDepartment);
        $this->db->bind(':role', $role);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateRegRole($adminId, $newRole, $target)
    {
        $this->db->query("UPDATE grading_user_registrars SET $target = :newRole WHERE id = :adminId");

        $this->db->bind(':newRole', $newRole);
        $this->db->bind(':adminId', $adminId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteRegUser($adminId)
    {
        $this->db->query("DELETE FROM grading_user_registrars WHERE id = :adminId");
        $this->db->bind(':adminId', $adminId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRegistrarUserCount($department)
    {
        $this->db->query("SELECT * FROM grading_user_registrars WHERE department = :department AND is_active = 1");
        $this->db->bind(':department', $department);

        $row = $this->db->resultSet();
        $counts = $this->db->rowCount();

        return $counts;
    }

    public function getRegistrarUserCountAdmin($department, $role = 'full')
    {
        $this->db->query("SELECT * FROM grading_user_registrars WHERE department = :department AND is_active = 1 AND role = :role");
        $this->db->bind(':department', $department);
        $this->db->bind(':role', $role);

        $row = $this->db->resultSet();
        $counts = $this->db->rowCount();

        return $counts;
    }

    public function getAdminsAll()
    {
        $this->db->query("SELECT * FROM grading_administrator WHERE is_active = 1");

        $row = $this->db->resultSet();
        $counts = $this->db->rowCount();

        return $counts;
    }

    public function getAdminsAllFull()
    {
        $this->db->query("SELECT * FROM grading_administrator WHERE is_active = 1 AND role = 'full'");

        $row = $this->db->resultSet();
        $counts = $this->db->rowCount();

        return $counts;
    }

    public function getPostId($userId)
    {
        $this->db->query("SELECT * FROM instructors WHERE id = :userId");
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getMyId($userId)
    {
        $this->db->query("SELECT * FROM student_accounts WHERE id = :userId");
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAllTeacher()
    {
        $this->db->query("SELECT * FROM instructors INNER JOIN departments ON instructors.department_id = departments.id");
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function checkEmployeeId($userId)
    {
        $this->db->query("SELECT * FROM instructors WHERE employee_id = :userId");
        $this->db->bind(':userId', $userId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function addNewTeacher($fname, $lname, $userId, $department)
    {
        $this->db->query("INSERT INTO instructors (employee_id, first_name, last_name, department_id) VALUES(:userId, :fname, :lname, :department)");
        $this->db->bind(':userId', $userId);
        $this->db->bind(':fname', $fname);
        $this->db->bind(':lname', $lname);
        $this->db->bind(':department', $department);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
