<?php

class Teacher
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function checkEmployeeId($employeeId)
    {
        $this->db->query("SELECT * FROM instructors WHERE employee_id = :employeeId");
        $this->db->bind(':employeeId', $employeeId);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getEmployeeInfo($employeeId, $employeePass)
    {
        $this->db->query("SELECT * FROM instructors WHERE employee_id = :employeeId");
        $this->db->bind(':employeeId', $employeeId);
        $row = $this->db->single();

        $password_hash = $row->password;

        if (password_verify($employeePass, $password_hash)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateEmployeePassword($employeeId, $employeePass)
    {
        $this->db->query("UPDATE instructors SET password = :employeePass WHERE employee_id = :employeeId");
        $this->db->bind(':employeeId', $employeeId);
        $this->db->bind(':employeePass', $employeePass);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //get subject list Basic Ed
    public function getAssignSubjects($instructorId)
    {
        $this->db->query("SELECT *,subjects.id as subjectId, sections.id as sectionId, rooms.id as roomId FROM subjects 
                         INNER JOIN sections ON subjects.subject_section = sections.id 
                         INNER JOIN rooms ON subjects.subject_venue = rooms.id WHERE subject_instructor = :instructor");
        $this->db->bind(':instructor', $instructorId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }



    //get subject SR high
    public function getAssignSubjectsSrHigh($instructorId)
    {
        $this->db->query("SELECT *,col_room1.room_code as room11, col_room2.room_code as room22, col_courses.code as subjectCode FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id 
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id 
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id WHERE instructor_ID = :instructor AND col_program_category.cat_name = 'Senior High School'");
        $this->db->bind(':instructor', $instructorId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //get subject College
    public function getAssignSubjectsCollege($instructorId)
    {
        $this->db->query("SELECT *,col_room1.room_code as room11, col_room2.room_code as room22, col_courses.code as subjectCode FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id 
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id 
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id WHERE instructor_ID = :instructor AND col_program_category.cat_name = 'College'");
        $this->db->bind(':instructor', $instructorId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //get subject supplemental
    public function getAssignSubjectsSupple($instructorId)
    {
        $this->db->query("SELECT *,col_room1.room_code as room11, col_room2.room_code as room22, col_courses.code as subjectCode FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id 
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id 
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id WHERE instructor_ID = :instructor AND col_program_category.cat_name = 'Supplemental'");
        $this->db->bind(':instructor', $instructorId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //get subject graduate school
    public function getAssignSubjectsGraduaterSchool($instructorId)
    {
        $this->db->query("SELECT *,col_room1.room_code as room11, col_room2.room_code as room22, col_courses.code as subjectCode FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id 
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id 
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id WHERE instructor_ID = :instructor AND col_program_category.cat_name = 'Graduate School'");
        $this->db->bind(':instructor', $instructorId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //get student list
    public function getEnrolledStudents($sectionId, $currentSchoolYear, $subjectId)
    {
        $this->db->query("SELECT *,enrollees.id as enrolleesID, school_years.id as schoolYearsID, student_accounts.last_name as studentlname,
                        student_accounts.middle_name as studentmname, student_accounts.first_name as studentfname FROM enrollees 
                        INNER JOIN student_info ON enrollees.enrollee_info_id = student_info.id
                        INNER JOIN student_accounts ON student_info.account_id = student_accounts.id 
                        INNER JOIN school_years ON enrollees.school_year_id = school_years.id
                        LEFT JOIN grading_junior ON enrollees.id = grading_junior.enrollee_id
                        WHERE section_id = :sectionId AND enrollee_status = 'enrolled' AND school_years.term_name = :currentSchoolYear AND grading_junior.subject_id = :subjectId OR grading_junior.subject_id IS NULL ORDER BY student_info.last_name ASC");
        $this->db->bind(':sectionId', $sectionId);
        $this->db->bind(':currentSchoolYear', $currentSchoolYear);
        $this->db->bind(':subjectId', $subjectId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //get college student list
    public function getCollegeStudents($subjectSchedID, $termName)
    {
        $this->db->query("SELECT * FROM col_subject_enrolled INNER JOIN col_student ON col_subject_enrolled.si_ID = col_student.student_id 
                        INNER JOIN col_semester ON col_subject_enrolled.sem_ID = col_semester.sem_ID 
                        INNER JOIN col_terms ON col_semester.sem_term = col_terms.term_id WHERE subject_sched_ID = :subject_sched_ID AND col_terms.term_name = :term_name ORDER BY lname ASC");
        $this->db->bind(':subject_sched_ID', $subjectSchedID);
        $this->db->bind(':term_name', $termName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}
