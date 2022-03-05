<?php

class Student
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function checkStudentId($studentId)
    {
        $this->db->query("SELECT * FROM student_accounts WHERE student_id = :studentId");
        $this->db->bind(':studentId', $studentId);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getStudentInfo($studentId, $studentPass)
    {
        $this->db->query("SELECT * FROM student_accounts WHERE student_id = :studentId");
        $this->db->bind(':studentId', $studentId);
        $row = $this->db->single();

        $password_hash = $row->password;

        if (password_verify($studentPass, $password_hash)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateStudentPassword($studentId, $studentPass)
    {
        $this->db->query("UPDATE student_accounts SET password = :studentPass WHERE student_id = :studentId");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':studentPass', $studentPass);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getStudentInfoById($studentaccountId)
    {
        $this->db->query("SELECT * FROM student_accounts WHERE id = :studentaccountId");
        $this->db->bind(':studentaccountId', $studentaccountId);
        $row = $this->db->single();

        return $row;
    }


    //get enrolled junior student from subject
    public function getEnrolledJuniorStudents($sectionId, $currentSchoolYear, $subjectId)
    {
        $this->db->query("SELECT *,enrollees.id as enrolleesID, school_years.id as schoolYearsID, student_accounts.last_name as studentlname,
                        student_accounts.middle_name as studentmname, student_accounts.first_name as studentfname, student_accounts.student_id as studentNo FROM enrollees 
                        INNER JOIN student_info ON enrollees.enrollee_info_id = student_info.id
                        INNER JOIN student_accounts ON student_info.account_id = student_accounts.id 
                        INNER JOIN school_years ON enrollees.school_year_id = school_years.id
                        WHERE section_id = :sectionId AND enrollee_status = 'enrolled' AND school_years.term_name = :currentSchoolYear AND enrollees.id NOT IN (SELECT grading_junior.enrollee_id FROM grading_junior WHERE grading_junior.subject_id = :subjectId AND grading_junior.school_year = :currentSchoolYear) ORDER BY student_info.last_name ASC");
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

    //add student to class record
    public function addStudentRecords($enrolleeId, $subjectId, $instructorId, $currenSchoolYear)
    {
        $totalCount = 12;
        $count = 0;
        $quarter = '1st quarter';
        $gradeSource = 'written works';

        while ($count < $totalCount) {
            $this->db->query("INSERT INTO grading_junior (enrollee_id, subject_id, instructor_id, quarter, grade_source, school_year) VALUES(:enrolleeId, :subjectId, :instructorId, :quarter, :grade_source, :currentSchoolYear)");
            $this->db->bind(':enrolleeId', $enrolleeId);
            $this->db->bind(':subjectId', $subjectId);
            $this->db->bind(':instructorId', $instructorId);
            $this->db->bind(':quarter', $quarter);
            $this->db->bind(':grade_source', $gradeSource);
            $this->db->bind(':currentSchoolYear', $currenSchoolYear);

            if ($this->db->execute()) {
                $count = $count + 1;

                switch ($count) {
                    case 1:
                        $quarter = '2nd quarter';
                        break;
                    case 2:
                        $quarter = '3rd quarter';
                        break;
                    case 3:
                        $quarter = '4th quarter';
                        break;
                    case 4:
                        $quarter = '1st quarter';
                        $gradeSource = 'performance task';
                        break;
                    case 5:
                        $quarter = '2nd quarter';
                        $gradeSource = 'performance task';
                        break;
                    case 6:
                        $quarter = '3rd quarter';
                        $gradeSource = 'performance task';
                        break;
                    case 7:
                        $quarter = '4th quarter';
                        $gradeSource = 'performance task';
                        break;
                    case 8:
                        $quarter = '1st quarter';
                        $gradeSource = 'quarterly assessment';
                        break;
                    case 9:
                        $quarter = '2nd quarter';
                        $gradeSource = 'quarterly assessment';
                        break;
                    case 10:
                        $quarter = '3rd quarter';
                        $gradeSource = 'quarterly assessment';
                        break;
                    case 11:
                        $quarter = '4th quarter';
                        $gradeSource = 'quarterly assessment';
                        break;
                    case 12:
                        return true;
                        break;
                }
            } else {
                return false;
            }
        }
    }

    public function getJuniorStudentsBysubjects($subjectId, $currenSchoolYear)
    {
        $quarter = '1st quarter';
        $gradeSource = 'written works';

        $this->db->query("SELECT * FROM grading_junior INNER JOIN enrollees ON grading_junior.enrollee_id = enrollees.id 
                        INNER JOIN student_info ON enrollees.enrollee_info_id = student_info.id 
                        WHERE grading_junior.subject_id = :subjectId AND grading_junior.school_year = :currentSchoolYear AND quarter = :quarter AND grade_source = :gradeSource
                        ORDER BY student_info.last_name ASC");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':currentSchoolYear',  $currenSchoolYear);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
    //junior grade summary
    public function getJuniorSummary($subjectId, $currenSchoolYear)
    {
        $quarter = '1st quarter';
        $gradeSource = 'written works';
        $performance = 'performance task';
        $quarterly = 'quarterly assessment';
        $written = 'written works';
        $second = '2nd quarter';
        $third = '3rd quarter';
        $fourth = '4th quarter';

        $this->db->query("SELECT *,1stPt.act_1 as first_pt_act1, 1stPt.act_2 as first_pt_act2, 1stPt.act_3 as first_pt_act3, 1stPt.act_4 as first_pt_act4, 1stPt.act_5 as first_pt_act5,
                        1stPt.act_6 as first_pt_act6, 1stPt.act_7 as first_pt_act7, 1stPt.act_8 as first_pt_act8, 1stPt.act_9 as first_pt_act9, 1stPt.act_10 as first_pt_act10,
                        1stPt.act_11 as first_pt_act11, 1stPt.act_12 as first_pt_act12, 1stPt.act_13 as first_pt_act13, 1stPt.act_14 as first_pt_act14, 1stPt.act_15 as first_pt_act15,
                        1stQa.act_1 as first_qa_act1, 1stQa.act_2 as first_qa_act2, 1stQa.act_3 as first_qa_act3, 1stQa.act_4 as first_qa_act4, 1stQa.act_5 as first_qa_act5,
                        1stQa.act_6 as first_qa_act6, 1stQa.act_7 as first_qa_act7, 1stQa.act_8 as first_qa_act8, 1stQa.act_9 as first_qa_act9, 1stQa.act_10 as first_qa_act10,
                        1stQa.act_11 as first_qa_act11, 1stQa.act_12 as first_qa_act12, 1stQa.act_13 as first_qa_act13, 1stQa.act_14 as first_qa_act14, 1stQa.act_15 as first_qa_act15,
                        1stWw.act_1 as first_ww_act1, 1stWw.act_2 as first_ww_act2, 1stWw.act_3 as first_ww_act3, 1stWw.act_4 as first_ww_act4, 1stWw.act_5 as first_ww_act5,
                        1stWw.act_6 as first_ww_act6, 1stWw.act_7 as first_ww_act7, 1stWw.act_8 as first_ww_act8, 1stWw.act_9 as first_ww_act9, 1stWw.act_10 as first_ww_act10,
                        1stWw.act_11 as first_ww_act11, 1stWw.act_12 as first_ww_act12, 1stWw.act_13 as first_ww_act13, 1stWw.act_14 as first_ww_act14, 1stWw.act_15 as first_ww_act15,
                        2ndWw.act_1 as second_ww_act1, 2ndWw.act_2 as second_ww_act2, 2ndWw.act_3 as second_ww_act3, 2ndWw.act_4 as second_ww_act4, 2ndWw.act_5 as second_ww_act5,
                        2ndWw.act_6 as second_ww_act6, 2ndWw.act_7 as second_ww_act7, 2ndWw.act_8 as second_ww_act8, 2ndWw.act_9 as second_ww_act9, 2ndWw.act_10 as second_ww_act10,
                        2ndWw.act_11 as second_ww_act11, 2ndWw.act_12 as second_ww_act12, 2ndWw.act_13 as second_ww_act13, 2ndWw.act_14 as second_ww_act14, 2ndWw.act_15 as second_ww_act15,
                        2ndPt.act_1 as second_pt_act1, 2ndPt.act_2 as second_pt_act2, 2ndPt.act_3 as second_pt_act3, 2ndPt.act_4 as second_pt_act4, 2ndPt.act_5 as second_pt_act5,
                        2ndPt.act_6 as second_pt_act6, 2ndPt.act_7 as second_pt_act7, 2ndPt.act_8 as second_pt_act8, 2ndPt.act_9 as second_pt_act9, 2ndPt.act_10 as second_pt_act10,
                        2ndPt.act_11 as second_pt_act11, 2ndPt.act_12 as second_pt_act12, 2ndPt.act_13 as second_pt_act13, 2ndPt.act_14 as second_pt_act14, 2ndPt.act_15 as second_pt_act15,
                        2ndQa.act_1 as second_qa_act1, 2ndQa.act_2 as second_qa_act2, 2ndQa.act_3 as second_qa_act3, 2ndQa.act_4 as second_qa_act4, 2ndQa.act_5 as second_qa_act5,
                        2ndQa.act_6 as second_qa_act6, 2ndQa.act_7 as second_qa_act7, 2ndQa.act_8 as second_qa_act8, 2ndQa.act_9 as second_qa_act9, 2ndQa.act_10 as second_qa_act10,
                        2ndQa.act_11 as second_qa_act11, 2ndQa.act_12 as second_qa_act12, 2ndQa.act_13 as second_qa_act13, 2ndQa.act_14 as second_qa_act14, 2ndQa.act_15 as second_qa_act15,
                        3rdWw.act_1 as third_ww_act1, 3rdWw.act_2 as third_ww_act2, 3rdWw.act_3 as third_ww_act3, 3rdWw.act_4 as third_ww_act4, 3rdWw.act_5 as third_ww_act5,
                        3rdWw.act_6 as third_ww_act6, 3rdWw.act_7 as third_ww_act7, 3rdWw.act_8 as third_ww_act8, 3rdWw.act_9 as third_ww_act9, 3rdWw.act_10 as third_ww_act10,
                        3rdWw.act_11 as third_ww_act11, 3rdWw.act_12 as third_ww_act12, 3rdWw.act_13 as third_ww_act13, 3rdWw.act_14 as third_ww_act14, 3rdWw.act_15 as third_ww_act15,
                        3rdPt.act_1 as third_pt_act1, 3rdPt.act_2 as third_pt_act2, 3rdPt.act_3 as third_pt_act3, 3rdPt.act_4 as third_pt_act4, 3rdPt.act_5 as third_pt_act5,
                        3rdPt.act_6 as third_pt_act6, 3rdPt.act_7 as third_pt_act7, 3rdPt.act_8 as third_pt_act8, 3rdPt.act_9 as third_pt_act9, 3rdPt.act_10 as third_pt_act10,
                        3rdPt.act_11 as third_pt_act11, 3rdPt.act_12 as third_pt_act12, 3rdPt.act_13 as third_pt_act13, 3rdPt.act_14 as third_pt_act14, 3rdPt.act_15 as third_pt_act15,
                        3rdQa.act_1 as third_qa_act1, 3rdQa.act_2 as third_qa_act2, 3rdQa.act_3 as third_qa_act3, 3rdQa.act_4 as third_qa_act4, 3rdQa.act_5 as third_qa_act5,
                        3rdQa.act_6 as third_qa_act6, 3rdQa.act_7 as third_qa_act7, 3rdQa.act_8 as third_qa_act8, 3rdQa.act_9 as third_qa_act9, 3rdQa.act_10 as third_qa_act10,
                        3rdQa.act_11 as third_qa_act11, 3rdQa.act_12 as third_qa_act12, 3rdQa.act_13 as third_qa_act13, 3rdQa.act_14 as third_qa_act14, 3rdQa.act_15 as third_qa_act15,
                        4thWw.act_1 as fourth_ww_act1, 4thWw.act_2 as fourth_ww_act2, 4thWw.act_3 as fourth_ww_act3, 4thWw.act_4 as fourth_ww_act4, 4thWw.act_5 as fourth_ww_act5,
                        4thWw.act_6 as fourth_ww_act6, 4thWw.act_7 as fourth_ww_act7, 4thWw.act_8 as fourth_ww_act8, 4thWw.act_9 as fourth_ww_act9, 4thWw.act_10 as fourth_ww_act10,
                        4thWw.act_11 as fourth_ww_act11, 4thWw.act_12 as fourth_ww_act12, 4thWw.act_13 as fourth_ww_act13, 4thWw.act_14 as fourth_ww_act14, 4thWw.act_15 as fourth_ww_act15,
                        4thPt.act_1 as fourth_pt_act1, 4thPt.act_2 as fourth_pt_act2, 4thPt.act_3 as fourth_pt_act3, 4thPt.act_4 as fourth_pt_act4, 4thPt.act_5 as fourth_pt_act5,
                        4thPt.act_6 as fourth_pt_act6, 4thPt.act_7 as fourth_pt_act7, 4thPt.act_8 as fourth_pt_act8, 4thPt.act_9 as fourth_pt_act9, 4thPt.act_10 as fourth_pt_act10,
                        4thPt.act_11 as fourth_pt_act11, 4thPt.act_12 as fourth_pt_act12, 4thPt.act_13 as fourth_pt_act13, 4thPt.act_14 as fourth_pt_act14, 4thPt.act_15 as fourth_pt_act15,
                        4thQa.act_1 as fourth_qa_act1, 4thQa.act_2 as fourth_qa_act2, 4thQa.act_3 as fourth_qa_act3, 4thQa.act_4 as fourth_qa_act4, 4thQa.act_5 as fourth_qa_act5,
                        4thQa.act_6 as fourth_qa_act6, 4thQa.act_7 as fourth_qa_act7, 4thQa.act_8 as fourth_qa_act8, 4thQa.act_9 as fourth_qa_act9, 4thQa.act_10 as fourth_qa_act10,
                        4thQa.act_11 as fourth_qa_act11, 4thQa.act_12 as fourth_qa_act12, 4thQa.act_13 as fourth_qa_act13, 4thQa.act_14 as fourth_qa_act14, 4thQa.act_15 as fourth_qa_act15,
                        student_info.id as studentInfoId, student_accounts.student_id as studentId
                        FROM grading_junior as 1stWw INNER JOIN enrollees ON 1stWw.enrollee_id = enrollees.id 
                        INNER JOIN student_info ON enrollees.enrollee_info_id = student_info.id
                        INNER JOIN student_accounts ON student_info.account_id = student_accounts.id
                        LEFT JOIN grading_junior as 1stPt ON 1stWw.enrollee_id = 1stPt.enrollee_id AND 1stWw.subject_id = 1stPt.subject_id AND 1stWw.quarter = 1stPt.quarter AND 1stPt.grade_source = :performance AND 1stWw.school_year = 1stPt.school_year
                        LEFT JOIN grading_junior as 1stQa ON 1stWw.enrollee_id = 1stQa.enrollee_id AND 1stWw.subject_id = 1stQa.subject_id AND 1stWw.quarter = 1stQa.quarter AND 1stQa.grade_source = :quarterly AND 1stWw.school_year = 1stQa.school_year
                        LEFT JOIN grading_junior as 2ndWw ON 1stWw.enrollee_id = 2ndWw.enrollee_id AND 1stWw.subject_id = 2ndWw.subject_id AND 2ndWw.quarter = :second AND 2ndWw.grade_source = :written AND 1stWw.school_year = 2ndWw.school_year
                        LEFT JOIN grading_junior as 2ndPt ON 1stWw.enrollee_id = 2ndPt.enrollee_id AND 1stWw.subject_id = 2ndPt.subject_id AND 2ndPt.quarter = :second AND 2ndPt.grade_source = :performance AND 1stWw.school_year = 2ndPt.school_year
                        LEFT JOIN grading_junior as 2ndQa ON 1stWw.enrollee_id = 2ndQa.enrollee_id AND 1stWw.subject_id = 2ndQa.subject_id AND 2ndQa.quarter = :second AND 2ndQa.grade_source = :quarterly AND 1stWw.school_year = 2ndQa.school_year
                        LEFT JOIN grading_junior as 3rdWw ON 1stWw.enrollee_id = 3rdWw.enrollee_id AND 1stWw.subject_id = 3rdWw.subject_id AND 3rdWw.quarter = :third AND 3rdWw.grade_source = :written AND 1stWw.school_year = 3rdWw.school_year
                        LEFT JOIN grading_junior as 3rdPt ON 1stWw.enrollee_id = 3rdPt.enrollee_id AND 1stWw.subject_id = 3rdPt.subject_id AND 3rdPt.quarter = :third AND 3rdPt.grade_source = :performance AND 1stWw.school_year = 3rdPt.school_year
                        LEFT JOIN grading_junior as 3rdQa ON 1stWw.enrollee_id = 3rdQa.enrollee_id AND 1stWw.subject_id = 3rdQa.subject_id AND 3rdQa.quarter = :third AND 3rdQa.grade_source = :quarterly AND 1stWw.school_year = 3rdQa.school_year
                        LEFT JOIN grading_junior as 4thWw ON 1stWw.enrollee_id = 4thWw.enrollee_id AND 1stWw.subject_id = 4thWw.subject_id AND 4thWw.quarter = :fourth AND 4thWw.grade_source = :written AND 1stWw.school_year = 4thWw.school_year
                        LEFT JOIN grading_junior as 4thPt ON 1stWw.enrollee_id = 4thPt.enrollee_id AND 1stWw.subject_id = 4thPt.subject_id AND 4thPt.quarter = :fourth AND 4thPt.grade_source = :performance AND 1stWw.school_year = 4thPt.school_year
                        LEFT JOIN grading_junior as 4thQa ON 1stWw.enrollee_id = 4thQa.enrollee_id AND 1stWw.subject_id = 4thQa.subject_id AND 4thQa.quarter = :fourth AND 4thQa.grade_source = :quarterly AND 1stWw.school_year = 4thQa.school_year
                        WHERE 1stWw.subject_id = :subjectId AND 1stWw.school_year = :currentSchoolYear AND 1stWw.quarter = :quarter AND 1stWw.grade_source = :gradeSource
                        ORDER BY student_info.last_name ASC");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':currentSchoolYear',  $currenSchoolYear);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':performance', $performance);
        $this->db->bind(':quarterly', $quarterly);
        $this->db->bind(':second', $second);
        $this->db->bind(':third', $third);
        $this->db->bind(':fourth', $fourth);
        $this->db->bind(':written', $written);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //remove Jr student to the class record
    public function removeJrStudent($jrGradeId, $subjectIds)
    {
        $this->db->query("DELETE FROM grading_junior WHERE enrollee_id = :jrGradeId AND subject_id = :subjectIds");
        $this->db->bind(':jrGradeId', $jrGradeId);
        $this->db->bind(':subjectIds', $subjectIds);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //get enrolled sr student
    public function getEnrolledSeniorStudents($subjectId, $semName)
    {
        $this->db->query("SELECT * FROM col_subject_enrolled
                        INNER JOIN col_semester ON col_subject_enrolled.sem_ID = col_semester.sem_ID 
                        INNER JOIN col_student ON col_subject_enrolled.si_ID = col_student.student_id
                        WHERE col_subject_enrolled.subject_sched_ID = :subjectId AND col_semester.sem_NAME = :semName AND col_subject_enrolled.subject_enrolled_id NOT IN (SELECT grading_senior.enrollee_id FROM grading_senior WHERE grading_senior.subject_id = :subjectId and grading_senior.school_year = :semName) ORDER BY col_student.lname ASC");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':semName', $semName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function addSrStudentRecords($enrolleeID, $subjectID, $instructorId, $currenSchoolYear)
    {
        $totalCount = 6;
        $count = 0;
        $quarter = '1st quarter';
        $gradeSource = 'written works';

        while ($count < $totalCount) {
            $this->db->query("INSERT INTO grading_senior (enrollee_id, subject_id, instructor_id, quarter, grade_source, school_year) VALUES(:enrolleeId, :subjectId, :instructorId, :quarter, :grade_source, :currentSchoolYear)");
            $this->db->bind(':enrolleeId', intval($enrolleeID));
            $this->db->bind(':subjectId', intval($subjectID));
            $this->db->bind(':instructorId', intval($instructorId));
            $this->db->bind(':quarter', $quarter);
            $this->db->bind(':grade_source', $gradeSource);
            $this->db->bind(':currentSchoolYear', $currenSchoolYear);

            if ($this->db->execute()) {
                $count = $count + 1;

                switch ($count) {
                    case 1:
                        $quarter = '2nd quarter';
                        break;
                    case 2:
                        $quarter = '1st quarter';
                        $gradeSource = 'performance task';
                        break;
                    case 3:
                        $quarter = '2nd quarter';
                        $gradeSource = 'performance task';
                        break;
                    case 4:
                        $quarter = '1st quarter';
                        $gradeSource = 'quarterly assessment';
                        break;
                    case 5:
                        $quarter = '2nd quarter';
                        $gradeSource = 'quarterly assessment';
                        break;
                    case 6:
                        return true;
                        break;
                }
            } else {
                return false;
            }
        }
    }

    public function addSrStudentRecords2($enrolleeID, $subjectID, $instructorId, $currenSchoolYear)
    {
        $totalCount = 6;
        $count = 0;
        $quarter = '3rd quarter';
        $gradeSource = 'written works';

        while ($count < $totalCount) {
            $this->db->query("INSERT INTO grading_senior (enrollee_id, subject_id, instructor_id, quarter, grade_source, school_year) VALUES(:enrolleeId, :subjectId, :instructorId, :quarter, :grade_source, :currentSchoolYear)");
            $this->db->bind(':enrolleeId', intval($enrolleeID));
            $this->db->bind(':subjectId', intval($subjectID));
            $this->db->bind(':instructorId', intval($instructorId));
            $this->db->bind(':quarter', $quarter);
            $this->db->bind(':grade_source', $gradeSource);
            $this->db->bind(':currentSchoolYear', $currenSchoolYear);

            if ($this->db->execute()) {
                $count = $count + 1;

                switch ($count) {
                    case 1:
                        $quarter = '4th quarter';
                        break;
                    case 2:
                        $quarter = '3rd quarter';
                        $gradeSource = 'performance task';
                        break;
                    case 3:
                        $quarter = '4th quarter';
                        $gradeSource = 'performance task';
                        break;
                    case 4:
                        $quarter = '3rd quarter';
                        $gradeSource = 'quarterly assessment';
                        break;
                    case 5:
                        $quarter = '4th quarter';
                        $gradeSource = 'quarterly assessment';
                        break;
                    case 6:
                        return true;
                        break;
                }
            } else {
                return false;
            }
        }
    }

    //get Sr students
    public function getSeniorStudentsBysubjects($subjectId, $currentSchoolYear, $quarter, $gradeSource)
    {
        $this->db->query("SELECT * FROM grading_senior INNER JOIN col_subject_enrolled ON grading_senior.enrollee_id = col_subject_enrolled.subject_enrolled_ID
                        INNER JOIN col_student ON col_subject_enrolled.si_ID = col_student.student_id 
                        WHERE subject_Id = :subjectId AND school_year = :currentSchoolYear AND quarter = :quarter And grade_source = :gradeSource ORDER BY col_student.lname ASC");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':currentSchoolYear', $currentSchoolYear);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function removeSrStudent($jrGradeId, $subjectIds, $currenSchoolYear)
    {
        $this->db->query("DELETE FROM grading_senior WHERE enrollee_id = :jrGradeId AND subject_id = :subjectIds AND school_year = :currenSchoolYear");
        $this->db->bind(':jrGradeId', $jrGradeId);
        $this->db->bind(':subjectIds', $subjectIds);
        $this->db->bind(':currenSchoolYear', $currenSchoolYear);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getSeniorSummaryFirst($subjectId, $currenSchoolYear)
    {
        $quarter = '1st quarter';
        $gradeSource = 'written works';
        $performance = 'performance task';
        $quarterly = 'quarterly assessment';
        $written = 'written works';
        $second = '2nd quarter';


        $this->db->query("SELECT *,1stPt.act_1 as first_pt_act1, 1stPt.act_2 as first_pt_act2, 1stPt.act_3 as first_pt_act3, 1stPt.act_4 as first_pt_act4, 1stPt.act_5 as first_pt_act5,
                        1stPt.act_6 as first_pt_act6, 1stPt.act_7 as first_pt_act7, 1stPt.act_8 as first_pt_act8, 1stPt.act_9 as first_pt_act9, 1stPt.act_10 as first_pt_act10,
                        1stPt.act_11 as first_pt_act11, 1stPt.act_12 as first_pt_act12, 1stPt.act_13 as first_pt_act13, 1stPt.act_14 as first_pt_act14, 1stPt.act_15 as first_pt_act15,
                        1stQa.act_1 as first_qa_act1, 1stQa.act_2 as first_qa_act2, 1stQa.act_3 as first_qa_act3, 1stQa.act_4 as first_qa_act4, 1stQa.act_5 as first_qa_act5,
                        1stQa.act_6 as first_qa_act6, 1stQa.act_7 as first_qa_act7, 1stQa.act_8 as first_qa_act8, 1stQa.act_9 as first_qa_act9, 1stQa.act_10 as first_qa_act10,
                        1stQa.act_11 as first_qa_act11, 1stQa.act_12 as first_qa_act12, 1stQa.act_13 as first_qa_act13, 1stQa.act_14 as first_qa_act14, 1stQa.act_15 as first_qa_act15,
                        1stWw.act_1 as first_ww_act1, 1stWw.act_2 as first_ww_act2, 1stWw.act_3 as first_ww_act3, 1stWw.act_4 as first_ww_act4, 1stWw.act_5 as first_ww_act5,
                        1stWw.act_6 as first_ww_act6, 1stWw.act_7 as first_ww_act7, 1stWw.act_8 as first_ww_act8, 1stWw.act_9 as first_ww_act9, 1stWw.act_10 as first_ww_act10,
                        1stWw.act_11 as first_ww_act11, 1stWw.act_12 as first_ww_act12, 1stWw.act_13 as first_ww_act13, 1stWw.act_14 as first_ww_act14, 1stWw.act_15 as first_ww_act15,
                        2ndWw.act_1 as second_ww_act1, 2ndWw.act_2 as second_ww_act2, 2ndWw.act_3 as second_ww_act3, 2ndWw.act_4 as second_ww_act4, 2ndWw.act_5 as second_ww_act5,
                        2ndWw.act_6 as second_ww_act6, 2ndWw.act_7 as second_ww_act7, 2ndWw.act_8 as second_ww_act8, 2ndWw.act_9 as second_ww_act9, 2ndWw.act_10 as second_ww_act10,
                        2ndWw.act_11 as second_ww_act11, 2ndWw.act_12 as second_ww_act12, 2ndWw.act_13 as second_ww_act13, 2ndWw.act_14 as second_ww_act14, 2ndWw.act_15 as second_ww_act15,
                        2ndPt.act_1 as second_pt_act1, 2ndPt.act_2 as second_pt_act2, 2ndPt.act_3 as second_pt_act3, 2ndPt.act_4 as second_pt_act4, 2ndPt.act_5 as second_pt_act5,
                        2ndPt.act_6 as second_pt_act6, 2ndPt.act_7 as second_pt_act7, 2ndPt.act_8 as second_pt_act8, 2ndPt.act_9 as second_pt_act9, 2ndPt.act_10 as second_pt_act10,
                        2ndPt.act_11 as second_pt_act11, 2ndPt.act_12 as second_pt_act12, 2ndPt.act_13 as second_pt_act13, 2ndPt.act_14 as second_pt_act14, 2ndPt.act_15 as second_pt_act15,
                        2ndQa.act_1 as second_qa_act1, 2ndQa.act_2 as second_qa_act2, 2ndQa.act_3 as second_qa_act3, 2ndQa.act_4 as second_qa_act4, 2ndQa.act_5 as second_qa_act5,
                        2ndQa.act_6 as second_qa_act6, 2ndQa.act_7 as second_qa_act7, 2ndQa.act_8 as second_qa_act8, 2ndQa.act_9 as second_qa_act9, 2ndQa.act_10 as second_qa_act10,
                        2ndQa.act_11 as second_qa_act11, 2ndQa.act_12 as second_qa_act12, 2ndQa.act_13 as second_qa_act13, 2ndQa.act_14 as second_qa_act14, 2ndQa.act_15 as second_qa_act15,
                        col_student.id as studentId, col_student.student_id as studentNo
                        
                        FROM grading_senior as 1stWw INNER JOIN col_subject_enrolled ON 1stWw.enrollee_id = col_subject_enrolled.subject_enrolled_ID 
                        INNER JOIN col_student ON col_subject_enrolled.si_ID = col_student.student_id
                        LEFT JOIN grading_senior as 1stPt ON 1stWw.enrollee_id = 1stPt.enrollee_id AND 1stWw.subject_id = 1stPt.subject_id AND 1stWw.quarter = 1stPt.quarter AND 1stPt.grade_source = :performance AND 1stWw.school_year = 1stPt.school_year
                        LEFT JOIN grading_senior as 1stQa ON 1stWw.enrollee_id = 1stQa.enrollee_id AND 1stWw.subject_id = 1stQa.subject_id AND 1stWw.quarter = 1stQa.quarter AND 1stQa.grade_source = :quarterly AND 1stWw.school_year = 1stQa.school_year
                        LEFT JOIN grading_senior as 2ndWw ON 1stWw.enrollee_id = 2ndWw.enrollee_id AND 1stWw.subject_id = 2ndWw.subject_id AND 2ndWw.quarter = :second AND 2ndWw.grade_source = :written AND 1stWw.school_year = 2ndWw.school_year
                        LEFT JOIN grading_senior as 2ndPt ON 1stWw.enrollee_id = 2ndPt.enrollee_id AND 1stWw.subject_id = 2ndPt.subject_id AND 2ndPt.quarter = :second AND 2ndPt.grade_source = :performance AND 1stWw.school_year = 2ndPt.school_year
                        LEFT JOIN grading_senior as 2ndQa ON 1stWw.enrollee_id = 2ndQa.enrollee_id AND 1stWw.subject_id = 2ndQa.subject_id AND 2ndQa.quarter = :second AND 2ndQa.grade_source = :quarterly AND 1stWw.school_year = 2ndQa.school_year
                        
                        WHERE 1stWw.subject_id = :subjectId AND 1stWw.school_year = :currentSchoolYear AND 1stWw.quarter = :quarter AND 1stWw.grade_source = :gradeSource
                        ORDER BY col_student.lname ASC");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':currentSchoolYear',  $currenSchoolYear);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':performance', $performance);
        $this->db->bind(':quarterly', $quarterly);
        $this->db->bind(':second', $second);

        $this->db->bind(':written', $written);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSummarySecond($subjectId, $currenSchoolYear)
    {
        $quarter = '3rd quarter';
        $gradeSource = 'written works';
        $performance = 'performance task';
        $quarterly = 'quarterly assessment';
        $written = 'written works';
        $second = '4th quarter';


        $this->db->query("SELECT *,1stPt.act_1 as first_pt_act1, 1stPt.act_2 as first_pt_act2, 1stPt.act_3 as first_pt_act3, 1stPt.act_4 as first_pt_act4, 1stPt.act_5 as first_pt_act5,
                        1stPt.act_6 as first_pt_act6, 1stPt.act_7 as first_pt_act7, 1stPt.act_8 as first_pt_act8, 1stPt.act_9 as first_pt_act9, 1stPt.act_10 as first_pt_act10,
                        1stPt.act_11 as first_pt_act11, 1stPt.act_12 as first_pt_act12, 1stPt.act_13 as first_pt_act13, 1stPt.act_14 as first_pt_act14, 1stPt.act_15 as first_pt_act15,
                        1stQa.act_1 as first_qa_act1, 1stQa.act_2 as first_qa_act2, 1stQa.act_3 as first_qa_act3, 1stQa.act_4 as first_qa_act4, 1stQa.act_5 as first_qa_act5,
                        1stQa.act_6 as first_qa_act6, 1stQa.act_7 as first_qa_act7, 1stQa.act_8 as first_qa_act8, 1stQa.act_9 as first_qa_act9, 1stQa.act_10 as first_qa_act10,
                        1stQa.act_11 as first_qa_act11, 1stQa.act_12 as first_qa_act12, 1stQa.act_13 as first_qa_act13, 1stQa.act_14 as first_qa_act14, 1stQa.act_15 as first_qa_act15,
                        1stWw.act_1 as first_ww_act1, 1stWw.act_2 as first_ww_act2, 1stWw.act_3 as first_ww_act3, 1stWw.act_4 as first_ww_act4, 1stWw.act_5 as first_ww_act5,
                        1stWw.act_6 as first_ww_act6, 1stWw.act_7 as first_ww_act7, 1stWw.act_8 as first_ww_act8, 1stWw.act_9 as first_ww_act9, 1stWw.act_10 as first_ww_act10,
                        1stWw.act_11 as first_ww_act11, 1stWw.act_12 as first_ww_act12, 1stWw.act_13 as first_ww_act13, 1stWw.act_14 as first_ww_act14, 1stWw.act_15 as first_ww_act15,
                        2ndWw.act_1 as second_ww_act1, 2ndWw.act_2 as second_ww_act2, 2ndWw.act_3 as second_ww_act3, 2ndWw.act_4 as second_ww_act4, 2ndWw.act_5 as second_ww_act5,
                        2ndWw.act_6 as second_ww_act6, 2ndWw.act_7 as second_ww_act7, 2ndWw.act_8 as second_ww_act8, 2ndWw.act_9 as second_ww_act9, 2ndWw.act_10 as second_ww_act10,
                        2ndWw.act_11 as second_ww_act11, 2ndWw.act_12 as second_ww_act12, 2ndWw.act_13 as second_ww_act13, 2ndWw.act_14 as second_ww_act14, 2ndWw.act_15 as second_ww_act15,
                        2ndPt.act_1 as second_pt_act1, 2ndPt.act_2 as second_pt_act2, 2ndPt.act_3 as second_pt_act3, 2ndPt.act_4 as second_pt_act4, 2ndPt.act_5 as second_pt_act5,
                        2ndPt.act_6 as second_pt_act6, 2ndPt.act_7 as second_pt_act7, 2ndPt.act_8 as second_pt_act8, 2ndPt.act_9 as second_pt_act9, 2ndPt.act_10 as second_pt_act10,
                        2ndPt.act_11 as second_pt_act11, 2ndPt.act_12 as second_pt_act12, 2ndPt.act_13 as second_pt_act13, 2ndPt.act_14 as second_pt_act14, 2ndPt.act_15 as second_pt_act15,
                        2ndQa.act_1 as second_qa_act1, 2ndQa.act_2 as second_qa_act2, 2ndQa.act_3 as second_qa_act3, 2ndQa.act_4 as second_qa_act4, 2ndQa.act_5 as second_qa_act5,
                        2ndQa.act_6 as second_qa_act6, 2ndQa.act_7 as second_qa_act7, 2ndQa.act_8 as second_qa_act8, 2ndQa.act_9 as second_qa_act9, 2ndQa.act_10 as second_qa_act10,
                        2ndQa.act_11 as second_qa_act11, 2ndQa.act_12 as second_qa_act12, 2ndQa.act_13 as second_qa_act13, 2ndQa.act_14 as second_qa_act14, 2ndQa.act_15 as second_qa_act15,
                        col_student.id as studentId, col_student.student_id as studentNo
                        
                        FROM grading_senior as 1stWw INNER JOIN col_subject_enrolled ON 1stWw.enrollee_id = col_subject_enrolled.subject_enrolled_ID 
                        INNER JOIN col_student ON col_subject_enrolled.si_ID = col_student.student_id
                        LEFT JOIN grading_senior as 1stPt ON 1stWw.enrollee_id = 1stPt.enrollee_id AND 1stWw.subject_id = 1stPt.subject_id AND 1stWw.quarter = 1stPt.quarter AND 1stPt.grade_source = :performance AND 1stWw.school_year = 1stPt.school_year
                        LEFT JOIN grading_senior as 1stQa ON 1stWw.enrollee_id = 1stQa.enrollee_id AND 1stWw.subject_id = 1stQa.subject_id AND 1stWw.quarter = 1stQa.quarter AND 1stQa.grade_source = :quarterly AND 1stWw.school_year = 1stQa.school_year
                        LEFT JOIN grading_senior as 2ndWw ON 1stWw.enrollee_id = 2ndWw.enrollee_id AND 1stWw.subject_id = 2ndWw.subject_id AND 2ndWw.quarter = :second AND 2ndWw.grade_source = :written AND 1stWw.school_year = 2ndWw.school_year
                        LEFT JOIN grading_senior as 2ndPt ON 1stWw.enrollee_id = 2ndPt.enrollee_id AND 1stWw.subject_id = 2ndPt.subject_id AND 2ndPt.quarter = :second AND 2ndPt.grade_source = :performance AND 1stWw.school_year = 2ndPt.school_year
                        LEFT JOIN grading_senior as 2ndQa ON 1stWw.enrollee_id = 2ndQa.enrollee_id AND 1stWw.subject_id = 2ndQa.subject_id AND 2ndQa.quarter = :second AND 2ndQa.grade_source = :quarterly AND 1stWw.school_year = 2ndQa.school_year
                        
                        WHERE 1stWw.subject_id = :subjectId AND 1stWw.school_year = :currentSchoolYear AND 1stWw.quarter = :quarter AND 1stWw.grade_source = :gradeSource
                        ORDER BY col_student.lname ASC");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':currentSchoolYear',  $currenSchoolYear);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':performance', $performance);
        $this->db->bind(':quarterly', $quarterly);
        $this->db->bind(':second', $second);

        $this->db->bind(':written', $written);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //get enrolled college student
    public function getEnrolledCollegeStudents($subjectId, $semName, $semTerm)
    {
        $this->db->query("SELECT * FROM col_subject_enrolled
                        INNER JOIN col_semester ON col_subject_enrolled.sem_ID = col_semester.sem_ID 
                        INNER JOIN col_student ON col_subject_enrolled.si_ID = col_student.student_id
                        WHERE col_subject_enrolled.subject_sched_ID = :subjectId AND col_semester.sem_NAME = :semName AND col_semester.sem_TERM = :semTerm AND col_subject_enrolled.subject_enrolled_id NOT IN (SELECT grading_college.enrollee_id FROM grading_college WHERE grading_college.subject_id = :subjectId and grading_college.school_year = :semName AND grading_college.sem_name = :semTerm) ORDER BY col_student.lname ASC");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':semName', $semName);
        $this->db->bind(':semTerm', $semTerm);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //College
    public function addCollegeStudentRecords($enrolleeID, $subjectID, $instructorId, $currenSchoolYear, $subjectTerm)
    {
        $totalCount = 24;
        $count = 0;
        $quarter = 'prelim';
        $gradeSource = 'attendance';

        while ($count < $totalCount) {
            $this->db->query("INSERT INTO grading_college (enrollee_id, subject_id, instructor_id, quarter, grade_source, school_year, sem_name) VALUES(:enrolleeId, :subjectId, :instructorId, :quarter, :grade_source, :currentSchoolYear, :subjectTerm)");
            $this->db->bind(':enrolleeId', intval($enrolleeID));
            $this->db->bind(':subjectId', intval($subjectID));
            $this->db->bind(':instructorId', intval($instructorId));
            $this->db->bind(':quarter', $quarter);
            $this->db->bind(':grade_source', $gradeSource);
            $this->db->bind(':currentSchoolYear', $currenSchoolYear);
            $this->db->bind(':subjectTerm', $subjectTerm);

            if ($this->db->execute()) {
                $count = $count + 1;

                switch ($count) {
                    case 1:
                        $quarter = 'midterm';
                        break;
                    case 2:
                        $quarter = 'semi-finals';
                        break;
                    case 3:
                        $quarter = 'finals';
                        break;
                    case 4:
                        $quarter = 'prelim';
                        $gradeSource = 'recitation';
                        break;
                    case 5:
                        $quarter = 'midterm';
                        $gradeSource = 'recitation';
                        break;
                    case 6:
                        $quarter = 'semi-finals';
                        $gradeSource = 'recitation';
                        break;
                    case 7:
                        $quarter = 'finals';
                        $gradeSource = 'recitation';
                        break;
                    case 8:
                        $quarter = 'prelim';
                        $gradeSource = 'quiz';
                        break;
                    case 9:
                        $quarter = 'midterm';
                        $gradeSource = 'quiz';
                        break;
                    case 10:
                        $quarter = 'semi-finals';
                        $gradeSource = 'quiz';
                        break;
                    case 11:
                        $quarter = 'finals';
                        $gradeSource = 'quiz';
                        break;
                    case 12:
                        $quarter = 'prelim';
                        $gradeSource = 'assignment';
                        break;
                    case 13:
                        $quarter = 'midterm';
                        $gradeSource = 'assignment';
                        break;
                    case 14:
                        $quarter = 'semi-finals';
                        $gradeSource = 'assignment';
                        break;
                    case 15:
                        $quarter = 'finals';
                        $gradeSource = 'assignment';
                        break;
                    case 16:
                        $quarter = 'prelim';
                        $gradeSource = 'project';
                        break;
                    case 17:
                        $quarter = 'midterm';
                        $gradeSource = 'project';
                        break;
                    case 18:
                        $quarter = 'semi-finals';
                        $gradeSource = 'project';
                        break;
                    case 19:
                        $quarter = 'finals';
                        $gradeSource = 'project';
                        break;
                    case 20:
                        $quarter = 'prelim';
                        $gradeSource = 'exam';
                        break;
                    case 21:
                        $quarter = 'midterm';
                        $gradeSource = 'exam';
                        break;
                    case 22:
                        $quarter = 'semi-finals';
                        $gradeSource = 'exam';
                        break;
                    case 23:
                        $quarter = 'finals';
                        $gradeSource = 'exam';
                        break;
                    case 24:
                        return true;
                        break;
                }
            } else {
                return false;
            }
        }
    }

    //get Sr students
    public function getCollegeStudentsBysubjects($subjectId, $currentSchoolYear, $quarter, $gradeSource, $currentSem)
    {
        $this->db->query("SELECT * FROM grading_college INNER JOIN col_subject_enrolled ON grading_college.enrollee_id = col_subject_enrolled.subject_enrolled_ID
                        INNER JOIN col_student ON col_subject_enrolled.si_ID = col_student.student_id 
                        WHERE subject_Id = :subjectId AND school_year = :currentSchoolYear AND quarter = :quarter And grade_source = :gradeSource AND sem_name = :currentSem ORDER BY col_student.lname ASC");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':currentSchoolYear', $currentSchoolYear);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function removeCollegeStudent($jrGradeId, $subjectIds, $currentSchoolYear, $currentSem)
    {
        $this->db->query("DELETE FROM grading_college WHERE enrollee_id = :jrGradeId AND subject_id = :subjectIds AND school_year = :currentSchoolYear AND sem_name = :currentSem");
        $this->db->bind(':jrGradeId', $jrGradeId);
        $this->db->bind(':subjectIds', $subjectIds);
        $this->db->bind(':currentSchoolYear', $currentSchoolYear);
        $this->db->bind(':currentSem', $currentSem);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRemoveStudentsInfo($jrGradeId)
    {
        $this->db->query("SELECT *,col_student.id as stud FROM col_subject_enrolled INNER JOIN col_student ON col_subject_enrolled.si_ID = col_student.student_id
                        INNER JOIN col_curriculum ON col_student.curr_id = col_curriculum.id
                        INNER JOIN col_program ON col_curriculum.program_id = col_program.id
                        WHERE col_subject_enrolled.subject_enrolled_ID = :jrGradeId");
        $this->db->bind(':jrGradeId', $jrGradeId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function draftCurrentStudentNow($programId,  $jrGradeId, $studentId, $instructorId, $subjectIds, $subjectName, $subjectDes, $subjectYear, $courseCode, $draftStat, $remarks, $currenSchoolYear, $currentTerm)
    {
        $this->db->query("INSERT INTO grading_higher_final (program_id, student_id, student_no, instructor_id, sched_id, subject_name, subject_description, year_level, course, file_grade, grade_remarks, school_year, semester, show_date_id) 
                        VALUES(:programId, :jrGradeId, :studentId, :instructorId, :subjectIds, :subjectName, :subjectDes, :subjectYear, :courseCode, :draftStat, :remarks, :currenSchoolYear, :currentTerm, 0)");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':jrGradeId', $jrGradeId);
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':instructorId', $instructorId);
        $this->db->bind(':subjectIds', $subjectIds);
        $this->db->bind(':subjectName', $subjectName);
        $this->db->bind(':subjectDes', $subjectDes);
        $this->db->bind(':subjectYear', $subjectYear);
        $this->db->bind(':courseCode', $courseCode);
        $this->db->bind(':draftStat', $draftStat);
        $this->db->bind(':remarks', $remarks);
        $this->db->bind(':currenSchoolYear', $currenSchoolYear);
        $this->db->bind(':currentTerm', $currentTerm);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //get college summary
    public function getCollegeSummary($subjectId, $currenSchoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'attendance';
        $recitation = 'recitation';
        $quiz = 'quiz';
        $project = 'project';
        $assignment = 'assignment';
        $exam = 'exam';
        $midterm = 'midterm';
        $semis = 'semi-finals';
        $finals = 'finals';



        $this->db->query("SELECT *,preRe.act_1 as prelim_re_act1, preRe.act_2 as prelim_re_act2, preRe.act_3 as prelim_re_act3, preRe.act_4 as prelim_re_act4, preRe.act_5 as prelim_re_act5,
                        preRe.act_6 as prelim_re_act6, preRe.act_7 as prelim_re_act7, preRe.act_8 as prelim_re_act8, preRe.act_9 as prelim_re_act9, preRe.act_10 as prelim_re_act10,
                        preRe.act_11 as prelim_re_act11, preRe.act_12 as prelim_re_act12, preRe.act_13 as prelim_re_act13, preRe.act_14 as prelim_re_act14, preRe.act_15 as prelim_re_act15,
                        preQu.act_1 as prelim_qu_act1, preQu.act_2 as prelim_qu_act2, preQu.act_3 as prelim_qu_act3, preQu.act_4 as prelim_qu_act4, preQu.act_5 as prelim_qu_act5,
                        preQu.act_6 as prelim_qu_act6, preQu.act_7 as prelim_qu_act7, preQu.act_8 as prelim_qu_act8, preQu.act_9 as prelim_qu_act9, preQu.act_10 as prelim_qu_act10,
                        preQu.act_11 as prelim_qu_act11, preQu.act_12 as prelim_qu_act12, preQu.act_13 as prelim_qu_act13, preQu.act_14 as prelim_qu_act14, preQu.act_15 as prelim_qu_act15,
                        preAt.act_1 as prelim_at_act1, preAt.act_2 as prelim_at_act2, preAt.act_3 as prelim_at_act3, preAt.act_4 as prelim_at_act4, preAt.act_5 as prelim_at_act5,
                        preAt.act_6 as prelim_at_act6, preAt.act_7 as prelim_at_act7, preAt.act_8 as prelim_at_act8, preAt.act_9 as prelim_at_act9, preAt.act_10 as prelim_at_act10,
                        preAt.act_11 as prelim_at_act11, preAt.act_12 as prelim_at_act12, preAt.act_13 as prelim_at_act13, preAt.act_14 as prelim_at_act14, preAt.act_15 as prelim_at_act15,
                        prePr.act_1 as prelim_pr_act1, prePr.act_2 as prelim_pr_act2, prePr.act_3 as prelim_pr_act3, prePr.act_4 as prelim_pr_act4, prePr.act_5 as prelim_pr_act5,
                        prePr.act_6 as prelim_pr_act6, prePr.act_7 as prelim_pr_act7, prePr.act_8 as prelim_pr_act8, prePr.act_9 as prelim_pr_act9, prePr.act_10 as prelim_pr_act10,
                        prePr.act_11 as prelim_pr_act11, prePr.act_12 as prelim_pr_act12, prePr.act_13 as prelim_pr_act13, prePr.act_14 as prelim_pr_act14, prePr.act_15 as prelim_pr_act15,
                        preAs.act_1 as prelim_as_act1, preAs.act_2 as prelim_as_act2, preAs.act_3 as prelim_as_act3, preAs.act_4 as prelim_as_act4, preAs.act_5 as prelim_as_act5,
                        preAs.act_6 as prelim_as_act6, preAs.act_7 as prelim_as_act7, preAs.act_8 as prelim_as_act8, preAs.act_9 as prelim_as_act9, preAs.act_10 as prelim_as_act10,
                        preAs.act_11 as prelim_as_act11, preAs.act_12 as prelim_as_act12, preAs.act_13 as prelim_as_act13, preAs.act_14 as prelim_as_act14, preAs.act_15 as prelim_as_act15,
                        preEx.act_1 as prelim_ex_act1, preEx.act_2 as prelim_ex_act2, preEx.act_3 as prelim_ex_act3, preEx.act_4 as prelim_ex_act4, preEx.act_5 as prelim_ex_act5,
                        preEx.act_6 as prelim_ex_act6, preEx.act_7 as prelim_ex_act7, preEx.act_8 as prelim_ex_act8, preEx.act_9 as prelim_ex_act9, preEx.act_10 as prelim_ex_act10,
                        preEx.act_11 as prelim_ex_act11, preEx.act_12 as prelim_ex_act12, preEx.act_13 as prelim_ex_act13, preEx.act_14 as prelim_ex_act14, preEx.act_15 as prelim_ex_act15,

                        midRe.act_1 as midterm_re_act1, midRe.act_2 as midterm_re_act2, midRe.act_3 as midterm_re_act3, midRe.act_4 as midterm_re_act4, midRe.act_5 as midterm_re_act5,
                        midRe.act_6 as midterm_re_act6, midRe.act_7 as midterm_re_act7, midRe.act_8 as midterm_re_act8, midRe.act_9 as midterm_re_act9, midRe.act_10 as midterm_re_act10,
                        midRe.act_11 as midterm_re_act11, midRe.act_12 as midterm_re_act12, midRe.act_13 as midterm_re_act13, midRe.act_14 as midterm_re_act14, midRe.act_15 as midterm_re_act15,
                        midQu.act_1 as midterm_qu_act1, midQu.act_2 as midterm_qu_act2, midQu.act_3 as midterm_qu_act3, midQu.act_4 as midterm_qu_act4, midQu.act_5 as midterm_qu_act5,
                        midQu.act_6 as midterm_qu_act6, midQu.act_7 as midterm_qu_act7, midQu.act_8 as midterm_qu_act8, midQu.act_9 as midterm_qu_act9, midQu.act_10 as midterm_qu_act10,
                        midQu.act_11 as midterm_qu_act11, midQu.act_12 as midterm_qu_act12, midQu.act_13 as midterm_qu_act13, midQu.act_14 as midterm_qu_act14, midQu.act_15 as midterm_qu_act15,
                        midAt.act_1 as midterm_at_act1, midAt.act_2 as midterm_at_act2, midAt.act_3 as midterm_at_act3, midAt.act_4 as midterm_at_act4, midAt.act_5 as midterm_at_act5,
                        midAt.act_6 as midterm_at_act6, midAt.act_7 as midterm_at_act7, midAt.act_8 as midterm_at_act8, midAt.act_9 as midterm_at_act9, midAt.act_10 as midterm_at_act10,
                        midAt.act_11 as midterm_at_act11, midAt.act_12 as midterm_at_act12, midAt.act_13 as midterm_at_act13, midAt.act_14 as midterm_at_act14, midAt.act_15 as midterm_at_act15,
                        midPr.act_1 as midterm_pr_act1, midPr.act_2 as midterm_pr_act2, midPr.act_3 as midterm_pr_act3, midPr.act_4 as midterm_pr_act4, midPr.act_5 as midterm_pr_act5,
                        midPr.act_6 as midterm_pr_act6, midPr.act_7 as midterm_pr_act7, midPr.act_8 as midterm_pr_act8, midPr.act_9 as midterm_pr_act9, midPr.act_10 as midterm_pr_act10,
                        midPr.act_11 as midterm_pr_act11, midPr.act_12 as midterm_pr_act12, midPr.act_13 as midterm_pr_act13, midPr.act_14 as midterm_pr_act14, midPr.act_15 as midterm_pr_act15,
                        midAs.act_1 as midterm_as_act1, midAs.act_2 as midterm_as_act2, midAs.act_3 as midterm_as_act3, midAs.act_4 as midterm_as_act4, midAs.act_5 as midterm_as_act5,
                        midAs.act_6 as midterm_as_act6, midAs.act_7 as midterm_as_act7, midAs.act_8 as midterm_as_act8, midAs.act_9 as midterm_as_act9, midAs.act_10 as midterm_as_act10,
                        midAs.act_11 as midterm_as_act11, midAs.act_12 as midterm_as_act12, midAs.act_13 as midterm_as_act13, midAs.act_14 as midterm_as_act14, midAs.act_15 as midterm_as_act15,
                        midEx.act_1 as midterm_ex_act1, midEx.act_2 as midterm_ex_act2, midEx.act_3 as midterm_ex_act3, midEx.act_4 as midterm_ex_act4, midEx.act_5 as midterm_ex_act5,
                        midEx.act_6 as midterm_ex_act6, midEx.act_7 as midterm_ex_act7, midEx.act_8 as midterm_ex_act8, midEx.act_9 as midterm_ex_act9, midEx.act_10 as midterm_ex_act10,
                        midEx.act_11 as midterm_ex_act11, midEx.act_12 as midterm_ex_act12, midEx.act_13 as midterm_ex_act13, midEx.act_14 as midterm_ex_act14, midEx.act_15 as midterm_ex_act15,

                        semRe.act_1 as semis_re_act1, semRe.act_2 as semis_re_act2, semRe.act_3 as semis_re_act3, semRe.act_4 as semis_re_act4, semRe.act_5 semis_re_act5,
                        semRe.act_6 as semis_re_act6, semRe.act_7 as semis_re_act7, semRe.act_8 as semis_re_act8, semRe.act_9 as semis_re_act9, semRe.act_10 as semis_re_act10,
                        semRe.act_11 as semis_re_act11, semRe.act_12 as semis_re_act12, semRe.act_13 as semis_re_act13, semRe.act_14 as semis_re_act14, semRe.act_15 as semis_re_act15,
                        semQu.act_1 as semis_qu_act1, semQu.act_2 as semis_qu_act2, semQu.act_3 as semis_qu_act3, semQu.act_4 as semis_qu_act4, semQu.act_5 as semis_qu_act5,
                        semQu.act_6 as semis_qu_act6, semQu.act_7 as semis_qu_act7, semQu.act_8 as semis_qu_act8, semQu.act_9 as semis_qu_act9, semQu.act_10 as semis_qu_act10,
                        semQu.act_11 as semis_qu_act11, semQu.act_12 as semis_qu_act12, semQu.act_13 as semis_qu_act13, semQu.act_14 as semis_qu_act14, semQu.act_15 as semis_qu_act15,
                        semAt.act_1 as semis_at_act1, semAt.act_2 as semis_at_act2, semAt.act_3 as semis_at_act3, semAt.act_4 as semis_at_act4, semAt.act_5 as semis_at_act5,
                        semAt.act_6 as semis_at_act6, semAt.act_7 as semis_at_act7, semAt.act_8 as semis_at_act8, semAt.act_9 as semis_at_act9, semAt.act_10 as semis_at_act10,
                        semAt.act_11 as semis_at_act11, semAt.act_12 as semis_at_act12, semAt.act_13 as semis_at_act13, semAt.act_14 as semis_at_act14, semAt.act_15 as semis_at_act15,
                        semPr.act_1 as semis_pr_act1, semPr.act_2 as semis_pr_act2, semPr.act_3 as semis_pr_act3, semPr.act_4 as semis_pr_act4, semPr.act_5 as semis_pr_act5,
                        semPr.act_6 as semis_pr_act6, semPr.act_7 as semis_pr_act7, semPr.act_8 as semis_pr_act8, semPr.act_9 as semis_pr_act9, semPr.act_10 as semis_pr_act10,
                        semPr.act_11 as semis_pr_act11, semPr.act_12 as semis_pr_act12, semPr.act_13 as semis_pr_act13, semPr.act_14 as semis_pr_act14, semPr.act_15 as semis_pr_act15,
                        semAs.act_1 as semis_as_act1, semAs.act_2 as semis_as_act2, semAs.act_3 as semis_as_act3, semAs.act_4 as semis_as_act4, semAs.act_5 as semis_as_act5,
                        semAs.act_6 as semis_as_act6, semAs.act_7 as semis_as_act7, semAs.act_8 as semis_as_act8, semAs.act_9 as semis_as_act9, semAs.act_10 as semis_as_act10,
                        semAs.act_11 as semis_as_act11, semAs.act_12 as semis_as_act12, semAs.act_13 as semis_as_act13, semAs.act_14 as semis_as_act14, semAs.act_15 as semis_as_act15,
                        semEx.act_1 as semis_ex_act1, semEx.act_2 as semis_ex_act2, semEx.act_3 as semis_ex_act3, semEx.act_4 as semis_ex_act4, semEx.act_5 as semis_ex_act5,
                        semEx.act_6 as semis_ex_act6, semEx.act_7 as semis_ex_act7, semEx.act_8 as semis_ex_act8, semEx.act_9 as semis_ex_act9, semEx.act_10 as semis_ex_act10,
                        semEx.act_11 as semis_ex_act11, semEx.act_12 as semis_ex_act12, semEx.act_13 as semis_ex_act13, semEx.act_14 as semis_ex_act14, semEx.act_15 as semis_ex_act15,

                        finRe.act_1 as finals_re_act1, finRe.act_2 as finals_re_act2, finRe.act_3 as finals_re_act3, finRe.act_4 as finals_re_act4, finRe.act_5 finals_re_act5,
                        finRe.act_6 as finals_re_act6, finRe.act_7 as finals_re_act7, finRe.act_8 as finals_re_act8, finRe.act_9 as finals_re_act9, finRe.act_10 as finals_re_act10,
                        finRe.act_11 as finals_re_act11, finRe.act_12 as finals_re_act12, finRe.act_13 as finals_re_act13, finRe.act_14 as finals_re_act14, finRe.act_15 as finals_re_act15,
                        finQu.act_1 as finals_qu_act1, finQu.act_2 as finals_qu_act2, finQu.act_3 as finals_qu_act3, finQu.act_4 as finals_qu_act4, finQu.act_5 as finals_qu_act5,
                        finQu.act_6 as finals_qu_act6, finQu.act_7 as finals_qu_act7, finQu.act_8 as finals_qu_act8, finQu.act_9 as finals_qu_act9, finQu.act_10 as finals_qu_act10,
                        finQu.act_11 as finals_qu_act11, finQu.act_12 as finals_qu_act12, finQu.act_13 as finals_qu_act13, finQu.act_14 as finals_qu_act14, finQu.act_15 as finals_qu_act15,
                        finAt.act_1 as finals_at_act1, finAt.act_2 as finals_at_act2, finAt.act_3 as finals_at_act3, finAt.act_4 as finals_at_act4, finAt.act_5 as finals_at_act5,
                        finAt.act_6 as finals_at_act6, finAt.act_7 as finals_at_act7, finAt.act_8 as finals_at_act8, finAt.act_9 as finals_at_act9, finAt.act_10 as finals_at_act10,
                        finAt.act_11 as finals_at_act11, finAt.act_12 as finals_at_act12, finAt.act_13 as finals_at_act13, finAt.act_14 as finals_at_act14, finAt.act_15 as finals_at_act15,
                        finPr.act_1 as finals_pr_act1, finPr.act_2 as finals_pr_act2, finPr.act_3 as finals_pr_act3, finPr.act_4 as finals_pr_act4, finPr.act_5 as finals_pr_act5,
                        finPr.act_6 as finals_pr_act6, finPr.act_7 as finals_pr_act7, finPr.act_8 as finals_pr_act8, finPr.act_9 as finals_pr_act9, finPr.act_10 as finals_pr_act10,
                        finPr.act_11 as finals_pr_act11, finPr.act_12 as finals_pr_act12, finPr.act_13 as finals_pr_act13, finPr.act_14 as finals_pr_act14, finPr.act_15 as finals_pr_act15,
                        finAs.act_1 as finals_as_act1, finAs.act_2 as finals_as_act2, finAs.act_3 as finals_as_act3, finAs.act_4 as finals_as_act4, finAs.act_5 as finals_as_act5,
                        finAs.act_6 as finals_as_act6, finAs.act_7 as finals_as_act7, finAs.act_8 as finals_as_act8, finAs.act_9 as finals_as_act9, finAs.act_10 as finals_as_act10,
                        finAs.act_11 as finals_as_act11, finAs.act_12 as finals_as_act12, finAs.act_13 as finals_as_act13, finAs.act_14 as finals_as_act14, finAs.act_15 as finals_as_act15,
                        finEx.act_1 as finals_ex_act1, finEx.act_2 as finals_ex_act2, finEx.act_3 as finals_ex_act3, finEx.act_4 as finals_ex_act4, finEx.act_5 as finals_ex_act5,
                        finEx.act_6 as finals_ex_act6, finEx.act_7 as finals_ex_act7, finEx.act_8 as finals_ex_act8, finEx.act_9 as finals_ex_act9, finEx.act_10 as finals_ex_act10,
                        finEx.act_11 as finals_ex_act11, finEx.act_12 as finals_ex_act12, finEx.act_13 as finals_ex_act13, finEx.act_14 as finals_ex_act14, finEx.act_15 as finals_ex_act15,

                        col_curriculum.id as curriculumId, col_curriculum.program_id as programId, col_student.id as studentId, col_student.student_id as studentNo, col_program.code as studentCourse
                        
                        
                        FROM grading_college as preAt INNER JOIN col_subject_enrolled ON preAt.enrollee_id = col_subject_enrolled.subject_enrolled_ID 
                        INNER JOIN col_student ON col_subject_enrolled.si_ID = col_student.student_id
                        INNER JOIN col_curriculum ON col_student.curr_id = col_curriculum.id
                        INNER JOIN col_program ON col_curriculum.program_id = col_program.id
                        LEFT JOIN grading_college as preRe ON preAt.enrollee_id = preRe.enrollee_id AND preAt.subject_id = preRe.subject_id AND preAt.quarter = preRe.quarter AND preRe.grade_source = :recitation AND preAt.school_year = preRe.school_year AND preAt.sem_name = preRe.sem_name
                        LEFT JOIN grading_college as preQu ON preAt.enrollee_id = preQu.enrollee_id AND preAt.subject_id = preQu.subject_id AND preAt.quarter = preQu.quarter AND preQu.grade_source = :quiz AND preAt.school_year = preQu.school_year AND preAt.sem_name = preQu.sem_name
                        LEFT JOIN grading_college as prePr ON preAt.enrollee_id = prePr.enrollee_id AND preAt.subject_id = prePr.subject_id AND preAt.quarter = prePr.quarter AND prePr.grade_source = :project AND preAt.school_year = prePr.school_year AND preAt.sem_name = prePr.sem_name
                        LEFT JOIN grading_college as preAs ON preAt.enrollee_id = preAs.enrollee_id AND preAt.subject_id = preAs.subject_id AND preAt.quarter = preAs.quarter AND preAs.grade_source = :assignment AND preAt.school_year = preAs.school_year AND preAt.sem_name = preAs.sem_name
                        LEFT JOIN grading_college as preEx ON preAt.enrollee_id = preEx.enrollee_id AND preAt.subject_id = preEx.subject_id AND preAt.quarter = preEx.quarter AND preEx.grade_source = :exam AND preAt.school_year = preEx.school_year AND preAt.sem_name = preEx.sem_name

                        LEFT JOIN grading_college as midAt ON preAt.enrollee_id = midAt.enrollee_id AND preAt.subject_id = midAt.subject_id AND midAt.quarter = :midterm AND midAt.grade_source = :gradeSource AND preAt.school_year = midAt.school_year AND preAt.sem_name = midAt.sem_name
                        LEFT JOIN grading_college as midRe ON preAt.enrollee_id = midRe.enrollee_id AND preAt.subject_id = midRe.subject_id AND midRe.quarter = :midterm AND midRe.grade_source = :recitation AND preAt.school_year = midRe.school_year AND preAt.sem_name = midRe.sem_name
                        LEFT JOIN grading_college as midQu ON preAt.enrollee_id = midQu.enrollee_id AND preAt.subject_id = midQu.subject_id AND midQu.quarter = :midterm AND midQu.grade_source = :quiz AND preAt.school_year = midQu.school_year AND preAt.sem_name = midQu.sem_name
                        LEFT JOIN grading_college as midPr ON preAt.enrollee_id = midPr.enrollee_id AND preAt.subject_id = midPr.subject_id AND midPr.quarter = :midterm AND midPr.grade_source = :project AND preAt.school_year = midPr.school_year AND preAt.sem_name = midPr.sem_name
                        LEFT JOIN grading_college as midAs ON preAt.enrollee_id = midAs.enrollee_id AND preAt.subject_id = midAs.subject_id AND midAs.quarter = :midterm AND midAs.grade_source = :assignment AND preAt.school_year = midAs.school_year AND midAs.sem_name = preAs.sem_name
                        LEFT JOIN grading_college as midEx ON preAt.enrollee_id = midEx.enrollee_id AND preAt.subject_id = midEx.subject_id AND midEx.quarter = :midterm AND midEx.grade_source = :exam AND preAt.school_year = midEx.school_year AND preAt.sem_name = midEx.sem_name

                        LEFT JOIN grading_college as semAt ON preAt.enrollee_id = semAt.enrollee_id AND preAt.subject_id = semAt.subject_id AND semAt.quarter = :semis AND semAt.grade_source = :gradeSource AND preAt.school_year = semAt.school_year AND preAt.sem_name = semAt.sem_name
                        LEFT JOIN grading_college as semRe ON preAt.enrollee_id = semRe.enrollee_id AND preAt.subject_id = semRe.subject_id AND semRe.quarter = :semis AND semRe.grade_source = :recitation AND preAt.school_year = semRe.school_year AND preAt.sem_name = semRe.sem_name
                        LEFT JOIN grading_college as semQu ON preAt.enrollee_id = semQu.enrollee_id AND preAt.subject_id = semQu.subject_id AND semQu.quarter = :semis AND semQu.grade_source = :quiz AND preAt.school_year = semQu.school_year AND preAt.sem_name = semQu.sem_name
                        LEFT JOIN grading_college as semPr ON preAt.enrollee_id = semPr.enrollee_id AND preAt.subject_id = semPr.subject_id AND semPr.quarter = :semis AND semPr.grade_source = :project AND preAt.school_year = semPr.school_year AND preAt.sem_name = semPr.sem_name
                        LEFT JOIN grading_college as semAs ON preAt.enrollee_id = semAs.enrollee_id AND preAt.subject_id = semAs.subject_id AND semAs.quarter = :semis AND semAs.grade_source = :assignment AND preAt.school_year = semAs.school_year AND midAs.sem_name = semAs.sem_name
                        LEFT JOIN grading_college as semEx ON preAt.enrollee_id = semEx.enrollee_id AND preAt.subject_id = semEx.subject_id AND semEx.quarter = :semis AND semEx.grade_source = :exam AND preAt.school_year = semEx.school_year AND preAt.sem_name = semEx.sem_name

                        LEFT JOIN grading_college as finAt ON preAt.enrollee_id = finAt.enrollee_id AND preAt.subject_id = finAt.subject_id AND finAt.quarter = :finals AND finAt.grade_source = :gradeSource AND preAt.school_year = finAt.school_year AND preAt.sem_name = finAt.sem_name
                        LEFT JOIN grading_college as finRe ON preAt.enrollee_id = finRe.enrollee_id AND preAt.subject_id = finRe.subject_id AND finRe.quarter = :finals AND finRe.grade_source = :recitation AND preAt.school_year = finRe.school_year AND preAt.sem_name = finRe.sem_name
                        LEFT JOIN grading_college as finQu ON preAt.enrollee_id = finQu.enrollee_id AND preAt.subject_id = finQu.subject_id AND finQu.quarter = :finals AND finQu.grade_source = :quiz AND preAt.school_year = finQu.school_year AND preAt.sem_name = finQu.sem_name
                        LEFT JOIN grading_college as finPr ON preAt.enrollee_id = finPr.enrollee_id AND preAt.subject_id = finPr.subject_id AND finPr.quarter = :finals AND finPr.grade_source = :project AND preAt.school_year = finPr.school_year AND preAt.sem_name = finPr.sem_name
                        LEFT JOIN grading_college as finAs ON preAt.enrollee_id = finAs.enrollee_id AND preAt.subject_id = finAs.subject_id AND finAs.quarter = :finals AND finAs.grade_source = :assignment AND preAt.school_year = finAs.school_year AND midAs.sem_name = finAs.sem_name
                        LEFT JOIN grading_college as finEx ON preAt.enrollee_id = finEx.enrollee_id AND preAt.subject_id = finEx.subject_id AND finEx.quarter = :finals AND finEx.grade_source = :exam AND preAt.school_year = finEx.school_year AND preAt.sem_name = finEx.sem_name

                        
                        WHERE preAt.subject_id = :subjectId AND preAt.school_year = :currentSchoolYear AND preAt.quarter = :quarter AND preAt.grade_source = :gradeSource AND preAt.sem_name = :currentSem
                        ORDER BY col_student.lname ASC");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':currentSchoolYear',  $currenSchoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':recitation', $recitation);
        $this->db->bind(':quiz', $quiz);
        $this->db->bind(':project', $project);
        $this->db->bind(':assignment', $assignment);
        $this->db->bind(':exam', $exam);
        $this->db->bind(':midterm', $midterm);
        $this->db->bind('semis', $semis);
        $this->db->bind(':finals', $finals);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //getStudents Data
    public function getAllStudentsKinder()
    {
        $this->db->query("SELECT *,student_info.last_name as lastName, student_info.first_name as firstName, student_info.middle_name as middleName, student_info.id as infoId FROM student_info INNER JOIN student_accounts ON student_info.account_id = student_accounts.id ORDER BY student_info.last_name");

        $row = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getFilteredStudents($txtSearch)
    {
        $this->db->query("SELECT *,student_info.last_name as lastName, student_info.first_name as firstName, student_info.middle_name as middleName, student_info.id as infoId FROM student_info 
                        INNER JOIN student_accounts ON student_info.account_id = student_accounts.id 
                        WHERE student_info.last_name LIKE :txtSearch ORDER BY student_info.last_name");
        $this->db->bind(':txtSearch', $txtSearch);

        $row = $this->db->resultSet();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAllStudentsKinder12($infoId)
    {
        $this->db->query("SELECT *,student_info.last_name as lastName, student_info.first_name as firstName, student_info.middle_name as middleName, student_info.id as infoId, student_info.address as siAdd FROM student_info 
                        INNER JOIN student_accounts ON student_info.account_id = student_accounts.id
                        INNER JOIN student_families ON student_info.id = student_families.student_info_id 
                        WHERE student_info.id = :infoId");
        $this->db->bind(':infoId', $infoId);

        $row = $this->db->single();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getKinder1($studentId)
    {
        $level = 'kinder_1';
        $this->db->query("SELECT * FROM grading_junior_finals WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getKinder1s($studentId)
    {
        $level = 'kinder_1';
        $this->db->query("SELECT DISTINCT school_year as schoolYear1, grading_junior_school.school_name as school FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear1 = '';
            $row->school = '';
            return $row;
        }
    }

    public function getKinder2($studentId)
    {
        $level = 'kinder_2';
        $this->db->query("SELECT * FROM grading_junior_finals WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getKinder2s($studentId)
    {
        $level = 'kinder_2';
        $this->db->query("SELECT DISTINCT school_year as schoolYear1, grading_junior_school.school_name as school FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear1 = '';
            $row->school = '';
            return $row;
        }
    }

    public function getGrade1($studentId)
    {
        $level = '1';
        $this->db->query("SELECT * FROM grading_junior_finals WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getGrade1s($studentId)
    {
        $level = '1';
        $this->db->query("SELECT DISTINCT school_year as schoolYear1, grading_junior_school.school_name as school FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear1 = '';
            $row->school = '';
            return $row;
        }
    }

    public function getGrade2($studentId)
    {
        $level = '2';
        $this->db->query("SELECT * FROM grading_junior_finals WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getGrade2s($studentId)
    {
        $level = '2';
        $this->db->query("SELECT DISTINCT school_year as schoolYear1, grading_junior_school.school_name as school FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear1 = '';
            $row->school = '';
            return $row;
        }
    }

    public function getGrade3($studentId)
    {
        $level = '3';
        $this->db->query("SELECT * FROM grading_junior_finals WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getGrade3s($studentId)
    {
        $level = '3';
        $this->db->query("SELECT DISTINCT school_year as schoolYear1, grading_junior_school.school_name as school FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear1 = '';
            $row->school = '';
            return $row;
        }
    }

    public function getGrade4($studentId)
    {
        $level = '4';
        $this->db->query("SELECT * FROM grading_junior_finals WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getGrade4s($studentId)
    {
        $level = '4';
        $this->db->query("SELECT DISTINCT school_year as schoolYear1, grading_junior_school.school_name as school FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear1 = '';
            $row->school = '';
            return $row;
        }
    }

    public function getGrade5($studentId)
    {
        $level = '5';
        $this->db->query("SELECT * FROM grading_junior_finals WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getGrade5s($studentId)
    {
        $level = '5';
        $this->db->query("SELECT DISTINCT school_year as schoolYear1, grading_junior_school.school_name as school FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear1 = '';
            $row->school = '';
            return $row;
        }
    }

    public function getGrade6($studentId)
    {
        $level = '6';
        $this->db->query("SELECT * FROM grading_junior_finals WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getGrade6s($studentId)
    {
        $level = '6';
        $this->db->query("SELECT DISTINCT school_year as schoolYear1, grading_junior_school.school_name as school FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear1 = '';
            $row->school = '';
            return $row;
        }
    }

    public function getGrade7($studentId)
    {
        $level = '7';
        $this->db->query("SELECT * FROM grading_junior_finals WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getGrade7s($studentId)
    {
        $level = '7';
        $this->db->query("SELECT DISTINCT school_year as schoolYear1, grading_junior_school.school_name as school FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear1 = '';
            $row->school = '';
            return $row;
        }
    }

    public function getGrade8($studentId)
    {
        $level = '8';
        $this->db->query("SELECT * FROM grading_junior_finals WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getGrade8s($studentId)
    {
        $level = '8';
        $this->db->query("SELECT DISTINCT school_year as schoolYear1, grading_junior_school.school_name as school FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear1 = '';
            $row->school = '';
            return $row;
        }
    }

    public function getGrade9($studentId)
    {
        $level = '9';
        $this->db->query("SELECT * FROM grading_junior_finals WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getGrade9s($studentId)
    {
        $level = '9';
        $this->db->query("SELECT DISTINCT school_year as schoolYear1, grading_junior_school.school_name as school FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear1 = '';
            $row->school = '';
            return $row;
        }
    }

    public function getGrade10($studentId)
    {
        $level = '10';
        $this->db->query("SELECT * FROM grading_junior_finals WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getGrade10s($studentId)
    {
        $level = '10';
        $this->db->query("SELECT DISTINCT school_year as schoolYear1, grading_junior_school.school_name as school FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId AND grade_level = :level");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':level', $level);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear1 = '';
            $row->school = '';
            return $row;
        }
    }

    public function getAllSeniorHighRecordStudent()
    {
        $this->db->query("SELECT *,col_student.id as infoId FROM col_student INNER JOIN col_curriculum ON col_student.curr_id = col_curriculum.id
                        INNER JOIN col_program ON col_curriculum.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_program_category.cat_name = 'Senior High School' ORDER BY col_student.lname");
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAllSeniorHighRecordStudentLast($lastName)
    {
        $this->db->query("SELECT *,col_student.id as infoId FROM col_student INNER JOIN col_curriculum ON col_student.curr_id = col_curriculum.id
                        INNER JOIN col_program ON col_curriculum.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_program_category.cat_name = 'Senior High School' AND col_student.lname = :lastName ORDER BY col_student.lname");
        $this->db->bind(':lastName', $lastName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSelectedSeniorRecord($infoId)
    {
        $this->db->query("SELECT *,col_program.description as progDes, col_program.code as progCode FROM col_student INNER JOIN col_curriculum ON col_student.curr_id = col_curriculum.id
                        INNER JOIN col_program ON col_curriculum.program_id = col_program.id WHERE col_student.id = :infoId");
        $this->db->bind(':infoId', $infoId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAllHigherStudentNameRecords()
    {
        $this->db->query("SELECT *,col_student.id as infoId, col_program.code as progCode FROM col_student INNER JOIN col_curriculum ON col_student.curr_id = col_curriculum.id
                        INNER JOIN col_program ON col_curriculum.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_program_category.cat_name != 'Senior High School' ORDER BY col_student.lname LIMIT 100");

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function searchHigherListByLastName($searchField)
    {
        $this->db->query("SELECT *,col_student.id as infoId, col_program.code as progCode FROM col_student INNER JOIN col_curriculum ON col_student.curr_id = col_curriculum.id
                        INNER JOIN col_program ON col_curriculum.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_program_category.cat_name != 'Senior High School' AND col_student.lname LIKE :searchField ORDER BY col_student.lname LIMIT 100");
        $this->db->bind(':searchField', $searchField);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSelectedHigherRecord($infoId)
    {
        $this->db->query("SELECT *,col_program.description as progDes, col_program.code as progCode FROM col_student INNER JOIN col_curriculum ON col_student.curr_id = col_curriculum.id
                        INNER JOIN col_program ON col_curriculum.program_id = col_program.id WHERE col_student.id = :infoId");
        $this->db->bind(':infoId', $infoId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getHigherStudentsInfo($infoId)
    {
        $this->db->query("SELECT * FROM col_student INNER JOIN col_curriculum ON col_student.curr_id = col_curriculum.id 
                        INNER JOIN col_program ON col_curriculum.program_id = col_program.id WHERE col_student.id = :infoId");
        $this->db->bind(':infoId', $infoId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}
