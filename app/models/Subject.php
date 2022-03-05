<?php

class Subject
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //get current subject Junior
    public function getCurrentSubjectsJunior($subjectId)
    {
        $this->db->query("SELECT * FROM subjects WHERE id = :subjectId");
        $this->db->bind(':subjectId', $subjectId);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
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
    public function getAssignSubjectsSrHigh($instructorId, $semName)
    {
        $this->db->query("SELECT *,col_room1.room_code as room11, col_room2.room_code as room22, col_courses.code as subjectCode, col_courses.description as subjectDes, col_courses.department_id as courseId, col_section.program_id as proId FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id 
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id 
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_terms ON col_semester.sem_TERM = col_terms.term_id
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id WHERE instructor_ID = :instructor AND col_program_category.cat_name = 'Senior High School' AND col_semester.sem_NAME = :semName ORDER BY col_semester.sem_TERM ASC");
        $this->db->bind(':instructor', $instructorId);
        $this->db->bind(':semName', $semName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //get subject College
    public function getAssignSubjectsCollege($instructorId, $schoolYear, $currentSem)
    {
        $this->db->query("SELECT *,col_room1.room_code as room11, col_room2.room_code as room22, col_courses.code as subjectCode, col_courses.description as subjectDes, col_courses.department_id as courseId, col_section.program_id as proId FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id 
                         INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                         INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                         INNER JOIN col_terms ON col_semester.sem_TERM = col_terms.term_id 
                         INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                         INNER JOIN col_program ON col_section.program_id = col_program.id
                         INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                         LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id WHERE instructor_ID = :instructor AND col_program_category.cat_name = 'College' AND col_semester.sem_NAME = :schoolYear AND col_semester.sem_TERM = :currentSem");
        $this->db->bind(':instructor', $instructorId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //get subject supplemental
    public function getAssignSubjectsSupple($instructorId, $schoolYear, $currentSem)
    {
        $this->db->query("SELECT *,col_room1.room_code as room11, col_room2.room_code as room22, col_courses.code as subjectCode, col_courses.description as subjectDes, col_courses.department_id as courseId, col_section.program_id as proId FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id 
                         INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id 
                         INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                         INNER JOIN col_terms ON col_semester.sem_TERM = col_terms.term_id 
                         INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                         INNER JOIN col_program ON col_section.program_id = col_program.id
                         INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                         LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id WHERE instructor_ID = :instructor AND col_program_category.cat_name = 'Supplemental' AND col_semester.sem_NAME = :schoolYear AND col_semester.sem_TERM = :currentSem");
        $this->db->bind(':instructor', $instructorId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //get subject graduate school
    public function getAssignSubjectsGraduaterSchool($instructorId, $schoolYear, $currentSem)
    {
        $this->db->query("SELECT *,col_room1.room_code as room11, col_room2.room_code as room22, col_courses.code as subjectCode, col_courses.description as subjectDes, col_courses.department_id as courseId, col_section.program_id as proId FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id 
                         INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id 
                         INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                         INNER JOIN col_terms ON col_semester.sem_TERM = col_terms.term_id 
                         INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                         INNER JOIN col_program ON col_section.program_id = col_program.id
                         INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                         LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id WHERE instructor_ID = :instructor AND col_program_category.cat_name = 'Graduate School' AND col_semester.sem_NAME = :schoolYear AND col_semester.sem_TERM = :currentSem");
        $this->db->bind(':instructor', $instructorId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //register junior student to instructor class record
    public function getClassRecordSubjectsJunior($instructorId, $currentSchoolYear)
    {
        $this->db->query("SELECT DISTINCT grading_junior.enrollee_id AND grading_junior.subject_id, subjects.subject_day, subjects.subject_name, subjects.subject_description, subjects.subject_grade, sections.section_name, subjects.subject_time,
                        rooms.room_name, subjects.subject_section, subjects.id as subjectId FROM grading_junior INNER JOIN subjects ON grading_junior.subject_id = subjects.id 
                        INNER JOIN sections ON subjects.subject_section = sections.id 
                        INNER JOIN rooms ON subjects.subject_venue = rooms.id WHERE grading_junior.instructor_id = :instructorId AND grading_junior.school_year = :currentSchoolYear ORDER BY subjects.subject_grade, subjects.subject_name");
        $this->db->bind(':instructorId', $instructorId);
        $this->db->bind(':currentSchoolYear', $currentSchoolYear);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //sr college supplemental, masters
    public function getSubjectNameSem($subjectId)
    {
        $this->db->query("SELECT * FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id 
                        WHERE col_course_sched.subject_sched_ID = :subjectId");
        $this->db->bind(':subjectId', $subjectId);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //register senior student to instructor class record
    public function getClassRecordSubjectsSenior($instructorId, $currentSchoolYear)
    {
        $this->db->query("SELECT DISTINCT grading_senior.enrollee_id AND grading_senior.subject_id, col_room1.room_code as room11,
                         col_room2.room_code as room22, col_courses.code as subjectCode, col_courses.description as subjectDes, col_courses.department_id as courseId, 
                         col_section.year_level as year_level, col_section.sec_code as sec_code, col_course_sched.start as start, col_course_sched.end as end,
                         col_course_sched.day as day, col_course_sched.start2 as start2, col_course_sched.end2 as end2, col_semester.sem_TERM as semTerm,
                         col_course_sched.day2 as day2, col_course_sched.subject_sched_ID as subject_sched_ID, col_semester.sem_TERM as sem_TERM FROM grading_senior 
                        INNER JOIN col_subject_enrolled ON grading_senior.enrollee_id = col_subject_enrolled.subject_enrolled_ID
                        INNER JOIN col_course_sched ON col_subject_enrolled.subject_sched_ID = col_course_sched.subject_sched_ID
                        INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID 
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id
                        WHERE grading_senior.instructor_id = :instructorId AND grading_senior.school_year = :currentSchoolYear ORDER BY col_semester.sem_TERM ASC");
        $this->db->bind(':instructorId', $instructorId);
        $this->db->bind(':currentSchoolYear', $currentSchoolYear);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //get current Subject Sr, College, Supple, Master
    public function getCurrentSubjects($subjectId)
    {
        $this->db->query("SELECT * FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        WHERE subject_sched_ID = :subjectId");
        $this->db->bind(':subjectId', $subjectId);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getCurrentSubjectsSummary($subjectId)
    {
        $this->db->query("SELECT *,col_program.code as courseCode, col_courses.code as code, col_courses.description as description FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        WHERE subject_sched_ID = :subjectId");
        $this->db->bind(':subjectId', $subjectId);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //register college student to instructor class record
    public function getClassRecordSubjectsCollege($instructorId, $currentSchoolYear, $semTerm)
    {
        $this->db->query("SELECT DISTINCT grading_college.enrollee_id AND grading_college.subject_id, col_room1.room_code as room11,
                         col_room2.room_code as room22, col_courses.code as subjectCode, col_courses.description as subjectDes, col_courses.department_id as courseId, 
                         col_section.year_level as year_level, col_section.sec_code as sec_code, col_course_sched.start as start, col_course_sched.end as end,
                         col_course_sched.day as day, col_course_sched.start2 as start2, col_course_sched.end2 as end2, col_semester.sem_TERM as semTerm,
                         col_course_sched.day2 as day2, col_course_sched.subject_sched_ID as subject_sched_ID, col_semester.sem_TERM as sem_TERM FROM grading_college 
                        INNER JOIN col_subject_enrolled ON grading_college.enrollee_id = col_subject_enrolled.subject_enrolled_ID
                        INNER JOIN col_course_sched ON col_subject_enrolled.subject_sched_ID = col_course_sched.subject_sched_ID
                        INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID 
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id
                        WHERE grading_college.instructor_id = :instructorId AND grading_college.school_year = :currentSchoolYear AND col_semester.sem_TERM = :semTerm AND col_program.prog_cat_id = 2 ORDER BY col_semester.sem_TERM ASC");
        $this->db->bind(':instructorId', $instructorId);
        $this->db->bind(':currentSchoolYear', $currentSchoolYear);
        $this->db->bind(':semTerm', $semTerm);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getClassRecordSubjectsSupplemental($instructorId, $currentSchoolYear, $semTerm)
    {
        $this->db->query("SELECT DISTINCT grading_college.enrollee_id AND grading_college.subject_id, col_room1.room_code as room11,
                         col_room2.room_code as room22, col_courses.code as subjectCode, col_courses.description as subjectDes, col_courses.department_id as courseId, 
                         col_section.year_level as year_level, col_section.sec_code as sec_code, col_course_sched.start as start, col_course_sched.end as end,
                         col_course_sched.day as day, col_course_sched.start2 as start2, col_course_sched.end2 as end2, col_semester.sem_TERM as semTerm,
                         col_course_sched.day2 as day2, col_course_sched.subject_sched_ID as subject_sched_ID, col_semester.sem_TERM as sem_TERM FROM grading_college 
                        INNER JOIN col_subject_enrolled ON grading_college.enrollee_id = col_subject_enrolled.subject_enrolled_ID
                        INNER JOIN col_course_sched ON col_subject_enrolled.subject_sched_ID = col_course_sched.subject_sched_ID
                        INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID 
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id
                        WHERE grading_college.instructor_id = :instructorId AND grading_college.school_year = :currentSchoolYear AND col_semester.sem_TERM = :semTerm AND col_program.prog_cat_id = 4 ORDER BY col_semester.sem_TERM ASC");
        $this->db->bind(':instructorId', $instructorId);
        $this->db->bind(':currentSchoolYear', $currentSchoolYear);
        $this->db->bind(':semTerm', $semTerm);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getClassRecordSubjectsMaster($instructorId, $currentSchoolYear, $semTerm)
    {
        $this->db->query("SELECT DISTINCT grading_college.enrollee_id AND grading_college.subject_id, col_room1.room_code as room11,
                         col_room2.room_code as room22, col_courses.code as subjectCode, col_courses.description as subjectDes, col_courses.department_id as courseId, 
                         col_section.year_level as year_level, col_section.sec_code as sec_code, col_course_sched.start as start, col_course_sched.end as end,
                         col_course_sched.day as day, col_course_sched.start2 as start2, col_course_sched.end2 as end2, col_semester.sem_TERM as semTerm,
                         col_course_sched.day2 as day2, col_course_sched.subject_sched_ID as subject_sched_ID, col_semester.sem_TERM as sem_TERM FROM grading_college 
                        INNER JOIN col_subject_enrolled ON grading_college.enrollee_id = col_subject_enrolled.subject_enrolled_ID
                        INNER JOIN col_course_sched ON col_subject_enrolled.subject_sched_ID = col_course_sched.subject_sched_ID
                        INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID 
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id
                        WHERE grading_college.instructor_id = :instructorId AND grading_college.school_year = :currentSchoolYear AND col_semester.sem_TERM = :semTerm AND col_program.prog_cat_id = 3 ORDER BY col_semester.sem_TERM ASC");
        $this->db->bind(':instructorId', $instructorId);
        $this->db->bind(':currentSchoolYear', $currentSchoolYear);
        $this->db->bind(':semTerm', $semTerm);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //check if sched is exist
    public function checkIfSchedIdExist($subjectId, $schoolYear, $currentSem)
    {
        $this->db->query("SELECT * FROM grading_higher_final WHERE sched_id = :subjectId AND school_year = :schoolYear AND semester = :currentSem");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return '';
        } else {
            return 'submitGrade';
        }
    }

    //load junior student subject enrolled
    public function loadSubjectJunior($studentId, $schoolYear)
    {
        $this->db->query("SELECT * FROM subjects
                        LEFT JOIN enrollees ON subjects.subject_section = enrollees.section_id
                        INNER JOIN student_info ON enrollees.enrollee_info_id = student_info.id
                        INNER JOIN student_accounts ON student_info.account_id = student_accounts.id
                        INNER JOIN school_years ON enrollees.school_year_id = school_years.id
                        INNER JOIN sections ON subjects.subject_section = sections.id
                        INNER JOIN rooms ON subjects.subject_venue = rooms.id
                        LEFT JOIN instructors ON subjects.subject_instructor = instructors.id
                        WHERE student_accounts.student_id = :studentId AND school_years.term_name = :schoolYear");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function loadSubjectSenior($studentId, $schoolYear)
    {
        $this->db->query("SELECT *,col_room1.room_code as room11, col_room2.room_code as room22, col_courses.code as subjectCode, col_courses.description as subjectDes, col_courses.department_id as courseId, col_section.program_id as proId FROM col_subject_enrolled 
                        INNER JOIN col_course_sched ON col_subject_enrolled.subject_sched_ID = col_course_sched.subject_sched_ID
                        INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id 
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_terms ON col_semester.sem_TERM = col_terms.term_id
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id
                        LEFT JOIN instructors ON col_course_sched.instructor_ID = instructors.id
                        WHERE si_ID = :studentId AND col_semester.sem_NAME = :schoolYear AND col_program_category.cat_name = 'Senior High School' ORDER BY col_semester.sem_TERM ASC");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function loadSubjectCollege($studentId, $schoolYear, $sem)
    {
        $this->db->query("SELECT *,col_room1.room_code as room11, col_room2.room_code as room22, col_courses.code as subjectCode, col_courses.description as subjectDes, col_courses.department_id as courseId, col_section.program_id as proId FROM col_subject_enrolled 
                        INNER JOIN col_course_sched ON col_subject_enrolled.subject_sched_ID = col_course_sched.subject_sched_ID
                        INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id 
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_terms ON col_semester.sem_TERM = col_terms.term_id
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id
                        LEFT JOIN instructors ON col_course_sched.instructor_ID = instructors.id
                        WHERE si_ID = :studentId AND col_semester.sem_NAME = :schoolYear AND col_program_category.cat_name = 'College' AND col_semester.sem_TERM = :sem");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':sem', $sem);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function loadSubjectSupple($studentId, $schoolYear, $sem)
    {
        $this->db->query("SELECT *,col_room1.room_code as room11, col_room2.room_code as room22, col_courses.code as subjectCode, col_courses.description as subjectDes, col_courses.department_id as courseId, col_section.program_id as proId FROM col_subject_enrolled 
                        INNER JOIN col_course_sched ON col_subject_enrolled.subject_sched_ID = col_course_sched.subject_sched_ID
                        INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id 
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_terms ON col_semester.sem_TERM = col_terms.term_id
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id
                        LEFT JOIN instructors ON col_course_sched.instructor_ID = instructors.id
                        WHERE si_ID = :studentId AND col_semester.sem_NAME = :schoolYear AND col_program_category.cat_name = 'Supplemental' AND col_semester.sem_TERM = :sem");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':sem', $sem);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function loadSubjectMaster($studentId, $schoolYear, $sem)
    {
        $this->db->query("SELECT *,col_room1.room_code as room11, col_room2.room_code as room22, col_courses.code as subjectCode, col_courses.description as subjectDes, col_courses.department_id as courseId, col_section.program_id as proId FROM col_subject_enrolled 
                        INNER JOIN col_course_sched ON col_subject_enrolled.subject_sched_ID = col_course_sched.subject_sched_ID
                        INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id 
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_terms ON col_semester.sem_TERM = col_terms.term_id
                        INNER JOIN col_room as col_room1 ON col_course_sched.room_ID = col_room1.id
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        LEFT JOIN col_room as col_room2 ON col_course_sched.room_ID2 = col_room2.id
                        LEFT JOIN instructors ON col_course_sched.instructor_ID = instructors.id
                        WHERE si_ID = :studentId AND col_semester.sem_NAME = :schoolYear AND col_program_category.cat_name = 'Graduate School' AND col_semester.sem_TERM = :sem");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':sem', $sem);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSubject11($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_higher_subjects.subject_description as sdes, grading_college_schedule_showing.show_date as showDate FROM grading_higher_subjects LEFT JOIN grading_higher_final ON grading_higher_subjects.subject_code = grading_higher_final.subject_name AND :studentNo = grading_higher_final.student_no AND 'FAILED' != grading_higher_final.grade_remarks
                        LEFT JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        WHERE grading_higher_subjects.program_id = :programId AND grading_higher_subjects.year_level = 1 AND grading_higher_subjects.semester = 1");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSubject12($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_higher_subjects.subject_description as sdes, grading_college_schedule_showing.show_date as showDate FROM grading_higher_subjects LEFT JOIN grading_higher_final ON grading_higher_subjects.subject_code = grading_higher_final.subject_name AND :studentNo = grading_higher_final.student_no AND 'FAILED' != grading_higher_final.grade_remarks
                        LEFT JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        WHERE grading_higher_subjects.program_id = :programId AND grading_higher_subjects.year_level = 1 AND grading_higher_subjects.semester = 2");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSubject21($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_higher_subjects.subject_description as sdes, grading_college_schedule_showing.show_date as showDate FROM grading_higher_subjects LEFT JOIN grading_higher_final ON grading_higher_subjects.subject_code = grading_higher_final.subject_name AND :studentNo = grading_higher_final.student_no AND 'FAILED' != grading_higher_final.grade_remarks
                        LEFT JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        WHERE grading_higher_subjects.program_id = :programId AND grading_higher_subjects.year_level = 2 AND grading_higher_subjects.semester = 1");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSubject22($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_higher_subjects.subject_description as sdes, grading_college_schedule_showing.show_date as showDate FROM grading_higher_subjects LEFT JOIN grading_higher_final ON grading_higher_subjects.subject_code = grading_higher_final.subject_name AND :studentNo = grading_higher_final.student_no AND 'FAILED' != grading_higher_final.grade_remarks
                        LEFT JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        WHERE grading_higher_subjects.program_id = :programId AND grading_higher_subjects.year_level = 2 AND grading_higher_subjects.semester = 2");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSubject23($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_higher_subjects.subject_description as sdes, grading_college_schedule_showing.show_date as showDate FROM grading_higher_subjects LEFT JOIN grading_higher_final ON grading_higher_subjects.subject_code = grading_higher_final.subject_name AND :studentNo = grading_higher_final.student_no AND 'FAILED' != grading_higher_final.grade_remarks
                        LEFT JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        WHERE grading_higher_subjects.program_id = :programId AND grading_higher_subjects.year_level = 2 AND grading_higher_subjects.semester = 3");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSubject31($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_higher_subjects.subject_description as sdes, grading_college_schedule_showing.show_date as showDate FROM grading_higher_subjects LEFT JOIN grading_higher_final ON grading_higher_subjects.subject_code = grading_higher_final.subject_name AND :studentNo = grading_higher_final.student_no AND 'FAILED' != grading_higher_final.grade_remarks
                        LEFT JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        WHERE grading_higher_subjects.program_id = :programId AND grading_higher_subjects.year_level = 3 AND grading_higher_subjects.semester = 1");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSubject32($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_higher_subjects.subject_description as sdes, grading_college_schedule_showing.show_date as showDate FROM grading_higher_subjects LEFT JOIN grading_higher_final ON grading_higher_subjects.subject_code = grading_higher_final.subject_name AND :studentNo = grading_higher_final.student_no AND 'FAILED' != grading_higher_final.grade_remarks
                        LEFT JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        WHERE grading_higher_subjects.program_id = :programId AND grading_higher_subjects.year_level = 3 AND grading_higher_subjects.semester = 2");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSubject33($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_higher_subjects.subject_description as sdes, grading_college_schedule_showing.show_date as showDate FROM grading_higher_subjects LEFT JOIN grading_higher_final ON grading_higher_subjects.subject_code = grading_higher_final.subject_name AND :studentNo = grading_higher_final.student_no AND 'FAILED' != grading_higher_final.grade_remarks
                        LEFT JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        WHERE grading_higher_subjects.program_id = :programId AND grading_higher_subjects.year_level = 3 AND grading_higher_subjects.semester = 3");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSubject41($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_higher_subjects.subject_description as sdes, grading_college_schedule_showing.show_date as showDate FROM grading_higher_subjects LEFT JOIN grading_higher_final ON grading_higher_subjects.subject_code = grading_higher_final.subject_name AND :studentNo = grading_higher_final.student_no AND 'FAILED' != grading_higher_final.grade_remarks
                        LEFT JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        WHERE grading_higher_subjects.program_id = :programId AND grading_higher_subjects.year_level = 4 AND grading_higher_subjects.semester = 1");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSubject42($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_higher_subjects.subject_description as sdes, grading_college_schedule_showing.show_date as showDate FROM grading_higher_subjects LEFT JOIN grading_higher_final ON grading_higher_subjects.subject_code = grading_higher_final.subject_name AND :studentNo = grading_higher_final.student_no AND 'FAILED' != grading_higher_final.grade_remarks
                        LEFT JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        WHERE grading_higher_subjects.program_id = :programId AND grading_higher_subjects.year_level = 4 AND grading_higher_subjects.semester = 2");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAllKinderSubject()
    {

        $this->db->query("SELECT * FROM available_subjects WHERE subject_grade = 'kinder_1' OR subject_grade = 'kinder_2' ORDER BY subject_grade");
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getJuniorHistory($id, $schoolYear)
    {
        $this->db->query("SELECT DISTINCT instructor_id,subject_id,subject_name,subject_description,grade_level,school_year FROM grading_junior_finals
                        WHERE instructor_id = :id AND school = 1 AND school_year != :schoolYear  ORDER BY school_year DESC");
        $this->db->bind(':id', $id);
        $this->db->bind(':schoolYear', $schoolYear);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getJuniorHistoryS($id, $txtSearch, $schoolYear)
    {
        $this->db->query("SELECT DISTINCT instructor_id,subject_id,subject_name,subject_description,grade_level,school_year FROM grading_junior_finals
                        WHERE instructor_id = :id AND school = 1 AND subject_name = :txtSearch AND school_year != :schoolYear ORDER BY school_year DESC");
        $this->db->bind(':id', $id);
        $this->db->bind(':txtSearch', $txtSearch);
        $this->db->bind(':schoolYear', $schoolYear);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSrHistory($id, $schoolYear, $sem)
    {
        $this->db->query("SELECT DISTINCT instructor_id, subject_id, subject_name, subject_description, subject_term, year_level, school_year FROM grading_senior_finals
                        WHERE instructor_id = :id AND school_id = 1 AND CONCAT(school_year, subject_term) != :combineSchoolSem ORDER BY school_year DESC, subject_term");
        $this->db->bind(':id', $id);
        $this->db->bind(':combineSchoolSem', $schoolYear . $sem);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSrHistoryS($id, $txtSearch, $schoolYear, $sem)
    {
        $this->db->query("SELECT DISTINCT instructor_id, subject_id, subject_name, subject_description, subject_term, year_level, school_year FROM grading_senior_finals
                        WHERE instructor_id = :id AND school_id = 1 AND subject_name = :txtSearch AND CONCAT(school_year, subject_term) != :combineSchoolSem ORDER BY school_year DESC, subject_term");
        $this->db->bind(':id', $id);
        $this->db->bind(':txtSearch', $txtSearch);
        $this->db->bind(':combineSchoolSem', $schoolYear . $sem);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getHigherHistory($id, $schoolYear, $sem)
    {
        $this->db->query("SELECT DISTINCT instructor_id, sched_id, subject_name, subject_description, year_level, school_year, semester FROM grading_higher_final
                        WHERE instructor_id = :id AND school_id = 1 AND CONCAT(school_year, semester) != :combineSchoolSem ORDER BY school_year DESC, semester");
        $this->db->bind(':id', $id);
        $this->db->bind(':combineSchoolSem', $schoolYear . $sem);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getHigherHistoryS($id, $txtSearch, $schoolYear, $sem)
    {
        $this->db->query("SELECT DISTINCT instructor_id, sched_id, subject_name, subject_description, year_level, school_year, semester FROM grading_higher_final
                        WHERE instructor_id = :id AND school_id = 1 AND subject_name = :txtSearch AND CONCAT(school_year, semester) != :combineSchoolSem ORDER BY school_year DESC, semester");
        $this->db->bind(':id', $id);
        $this->db->bind(':txtSearch', $txtSearch);
        $this->db->bind(':combineSchoolSem', $schoolYear . $sem);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSubjectsList($programId)
    {
        $this->db->query("SELECT *,grading_senior_subjects.id as recId FROM grading_senior_subjects INNER JOIN col_program ON grading_senior_subjects.program_id = col_program.id 
                        WHERE grading_senior_subjects.program_id = :programId ORDER BY grading_senior_subjects.year_level, grading_senior_subjects.semester");
        $this->db->bind(':programId', $programId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSubjectFromCourse($programId)
    {
        $this->db->query("SELECT * FROM col_courses WHERE department_id = :programId AND code NOT IN (SELECT subject_code FROM grading_senior_subjects WHERE program_id = :programId)");
        $this->db->bind(':programId', $programId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function insertSeniorSubjectsList($programId, $code, $subject, $year, $sem, $core)
    {
        $this->db->query("INSERT INTO grading_senior_subjects(program_id, subject_code, subject_description, year_level, semester, is_core)
                        VALUES(:programId, :code, :subject, :year, :sem, :core)");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':code', $code);
        $this->db->bind(':subject', $subject);
        $this->db->bind(':year', $year);
        $this->db->bind(':sem', $sem);
        $this->db->bind(':core', $core);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSeniorSubjectPattern($recId, $newYear, $newSem, $newCore)
    {
        $this->db->query("UPDATE grading_senior_subjects SET year_level = :newYear, semester = :newSem, is_core = :newCore WHERE id = :recId");
        $this->db->bind(':newYear', $newYear);
        $this->db->bind(':newSem', $newSem);
        $this->db->bind(':recId', $recId);
        $this->db->bind(':newCore', $newCore);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateHigherSubjectPattern($recId, $newYear, $newSem)
    {
        $this->db->query("UPDATE grading_higher_subjects SET year_level = :newYear, semester = :newSem WHERE id = :recId");
        $this->db->bind(':newYear', $newYear);
        $this->db->bind(':newSem', $newSem);
        $this->db->bind(':recId', $recId);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSeniorSubjectPattern($recId)
    {
        $this->db->query("DELETE FROM grading_senior_subjects WHERE id = :recId");
        $this->db->bind(':recId', $recId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteHigherSubjectPattern($recId)
    {
        $this->db->query("DELETE FROM grading_higher_subjects WHERE id = :recId");
        $this->db->bind(':recId', $recId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getSeniorSubject11($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_senior_subjects.subject_description as sDes FROM grading_senior_subjects LEFT JOIN grading_senior_finals ON grading_senior_subjects.subject_code = grading_senior_finals.subject_name AND :studentNo = grading_senior_finals.student_no
                        
                        WHERE grading_senior_subjects.program_id = :programId AND grading_senior_subjects.year_level = 1 AND grading_senior_subjects.semester = 1 AND grading_senior_subjects.is_core = 1");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSubject11App($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_senior_subjects.subject_description as sDes FROM grading_senior_subjects LEFT JOIN grading_senior_finals ON grading_senior_subjects.subject_code = grading_senior_finals.subject_name AND :studentNo = grading_senior_finals.student_no
                        
                        WHERE grading_senior_subjects.program_id = :programId AND grading_senior_subjects.year_level = 1 AND grading_senior_subjects.semester = 1 AND grading_senior_subjects.is_core = 2");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSubject11s($studentNo)
    {
        $this->db->query("SELECT DISTINCT grading_senior_finals.subject_term as term, grading_senior_finals.school_year as schoolYear, grading_senior_school.school_name as schoolName, grading_senior_finals.year_level FROM grading_senior_finals 
                        INNER JOIN grading_senior_school ON grading_senior_finals.school_id = grading_senior_school.id
                        WHERE grading_senior_finals.year_level = 1 AND grading_senior_finals.subject_term = 1 AND grading_senior_finals.student_no = :studentNo");

        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear = '';
            $row->schoolName = '';
            $row->term = '';
            return $row;
        }
    }

    public function getSeniorSubject12($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_senior_subjects.subject_description as sDes FROM grading_senior_subjects LEFT JOIN grading_senior_finals ON grading_senior_subjects.subject_code = grading_senior_finals.subject_name AND :studentNo = grading_senior_finals.student_no
                        
                        WHERE grading_senior_subjects.program_id = :programId AND grading_senior_subjects.year_level = 1 AND grading_senior_subjects.semester = 2 AND grading_senior_subjects.is_core = 1");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSubject12App($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_senior_subjects.subject_description as sDes FROM grading_senior_subjects LEFT JOIN grading_senior_finals ON grading_senior_subjects.subject_code = grading_senior_finals.subject_name AND :studentNo = grading_senior_finals.student_no
                        
                        WHERE grading_senior_subjects.program_id = :programId AND grading_senior_subjects.year_level = 1 AND grading_senior_subjects.semester = 2 AND grading_senior_subjects.is_core = 2");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSubject12s($studentNo)
    {
        $this->db->query("SELECT DISTINCT grading_senior_finals.subject_term as term, grading_senior_finals.school_year as schoolYear, grading_senior_school.school_name as schoolName, grading_senior_finals.year_level FROM grading_senior_finals 
                        INNER JOIN grading_senior_school ON grading_senior_finals.school_id = grading_senior_school.id
                        WHERE grading_senior_finals.year_level = 1 AND grading_senior_finals.subject_term = 2 AND grading_senior_finals.student_no = :studentNo");

        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear = '';
            $row->schoolName = '';
            $row->term = '';
            return $row;
        }
    }

    public function getSeniorSubject21($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_senior_subjects.subject_description as sDes FROM grading_senior_subjects LEFT JOIN grading_senior_finals ON grading_senior_subjects.subject_code = grading_senior_finals.subject_name AND :studentNo = grading_senior_finals.student_no
                        
                        WHERE grading_senior_subjects.program_id = :programId AND grading_senior_subjects.year_level = 2 AND grading_senior_subjects.semester = 1 AND grading_senior_subjects.is_core = 1");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSubject21App($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_senior_subjects.subject_description as sDes FROM grading_senior_subjects LEFT JOIN grading_senior_finals ON grading_senior_subjects.subject_code = grading_senior_finals.subject_name AND :studentNo = grading_senior_finals.student_no
                        
                        WHERE grading_senior_subjects.program_id = :programId AND grading_senior_subjects.year_level = 2 AND grading_senior_subjects.semester = 1 AND grading_senior_subjects.is_core = 2");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSubject21s($studentNo)
    {
        $this->db->query("SELECT DISTINCT grading_senior_finals.subject_term as term, grading_senior_finals.school_year as schoolYear, grading_senior_school.school_name as schoolName, grading_senior_finals.year_level FROM grading_senior_finals 
                        INNER JOIN grading_senior_school ON grading_senior_finals.school_id = grading_senior_school.id
                        WHERE grading_senior_finals.year_level = 2 AND grading_senior_finals.subject_term = 1 AND grading_senior_finals.student_no = :studentNo");

        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear = '';
            $row->schoolName = '';
            $row->term = '';
            return $row;
        }
    }

    public function getSeniorSubject22($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_senior_subjects.subject_description as sDes FROM grading_senior_subjects LEFT JOIN grading_senior_finals ON grading_senior_subjects.subject_code = grading_senior_finals.subject_name AND :studentNo = grading_senior_finals.student_no
                        
                        WHERE grading_senior_subjects.program_id = :programId AND grading_senior_subjects.year_level = 2 AND grading_senior_subjects.semester = 2 AND grading_senior_subjects.is_core = 1");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSubject22App($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_senior_subjects.subject_description as sDes FROM grading_senior_subjects LEFT JOIN grading_senior_finals ON grading_senior_subjects.subject_code = grading_senior_finals.subject_name AND :studentNo = grading_senior_finals.student_no
                        
                        WHERE grading_senior_subjects.program_id = :programId AND grading_senior_subjects.year_level = 2 AND grading_senior_subjects.semester = 2 AND grading_senior_subjects.is_core = 2");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSubject22s($studentNo)
    {
        $this->db->query("SELECT DISTINCT grading_senior_finals.subject_term as term, grading_senior_finals.school_year as schoolYear, grading_senior_school.school_name as schoolName, grading_senior_finals.year_level FROM grading_senior_finals 
                        INNER JOIN grading_senior_school ON grading_senior_finals.school_id = grading_senior_school.id
                        WHERE grading_senior_finals.year_level = 2 AND grading_senior_finals.subject_term = 2 AND grading_senior_finals.student_no = :studentNo");

        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->schoolYear = '';
            $row->schoolName = '';
            $row->term = '';
            return $row;
        }
    }

    public function getJuniorHistoryAll()
    {
        $this->db->query("SELECT DISTINCT instructor_id,subject_id,subject_name,subject_description,grade_level,school_year, last_name, first_name FROM grading_junior_finals
                        INNER JOIN instructors ON grading_junior_finals.instructor_id = instructors.id
                        WHERE school = 1  ORDER BY school_year DESC, grade_level ASC");


        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getJuniorHistoryAllS($txtSearch)
    {
        $this->db->query("SELECT DISTINCT instructor_id,subject_id,subject_name,subject_description,grade_level,school_year, last_name, first_name FROM grading_junior_finals
                        INNER JOIN instructors ON grading_junior_finals.instructor_id = instructors.id
                        WHERE school = 1 AND subject_name = :txtSearch ORDER BY school_year DESC, grade_level ASC");
        $this->db->bind(':txtSearch', $txtSearch);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function subjectNameAll($subjectId, $schoolYear)
    {
        $this->db->query("SELECT DISTINCT instructor_id,subject_id,subject_name,subject_description,grade_level,school_year FROM grading_junior_finals
                        
                        WHERE subject_id = :subjectId AND school_year = :schoolYear");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorHistoryAll()
    {
        $this->db->query("SELECT DISTINCT instructor_id,subject_id,subject_name,subject_description,school_year, last_name, first_name, year_level, subject_term FROM grading_senior_finals
                        INNER JOIN instructors ON grading_senior_finals.instructor_id = instructors.id
                        WHERE school_id = 1  ORDER BY school_year DESC, year_level ASC, subject_term ASC");


        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorHistoryAllS($txtSearch)
    {
        $this->db->query("SELECT DISTINCT instructor_id,subject_id,subject_name,subject_description,school_year, last_name, first_name, year_level, subject_term FROM grading_senior_finals
                        INNER JOIN instructors ON grading_senior_finals.instructor_id = instructors.id
                        WHERE school_id = 1 AND subject_name = :txtSearch ORDER BY school_year DESC, year_level ASC, subject_term ASC");

        $this->db->bind(':txtSearch', $txtSearch);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function subjectNameAllSr($subjectId, $schoolYear, $sem)
    {
        $this->db->query("SELECT DISTINCT instructor_id,subject_id,subject_name,subject_description,year_level,school_year FROM grading_senior_finals
                        
                        WHERE subject_id = :subjectId AND school_year = :schoolYear AND subject_term = :sem");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':sem', $sem);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function subjectNameAllHigh($subjectId, $schoolYear, $sem)
    {
        $this->db->query("SELECT DISTINCT instructor_id,sched_id,subject_name,subject_description,year_level,school_year, semester FROM grading_higher_final
                        
                        WHERE sched_id = :subjectId AND school_year = :schoolYear AND semester = :sem");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':sem', $sem);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSubjectFromCourseS($programId)
    {
        $this->db->query("SELECT * FROM col_courses WHERE department_id = :programId");
        $this->db->bind(':programId', $programId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorSubjectFinalAll($studentId)
    {
        $this->db->query("SELECT *,grading_senior_school.id as schoolId, grading_senior_finals.id as recId FROM grading_senior_finals INNER JOIN grading_senior_school ON grading_senior_finals.school_id = grading_senior_school.id
                        WHERE grading_senior_finals.student_no = :studentId ORDER BY grading_senior_finals.year_level, grading_senior_finals.subject_term, grading_senior_finals.school_year");
        $this->db->bind(':studentId', $studentId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorAvailableSubjectSched($programId, $schoolYear, $studentId)
    {
        $this->db->query("SELECT *,col_courses.code as subjectCode, col_courses.description as subjectDescription FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_section.program_id = :programId AND col_program_category.cat_name = 'Senior High School' AND col_semester.sem_NAME = :schoolYear AND col_course_sched.subject_sched_ID NOT IN (SELECT subject_sched_ID FROM col_subject_enrolled 
                        INNER JOIN col_semester ON col_subject_enrolled.sem_ID = col_semester.sem_ID WHERE col_semester.sem_NAME = :schoolYear AND col_subject_enrolled.si_ID = :studentId)");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':studentId', $studentId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getEnrolledSubjectListStudent($studentId, $schoolYear)
    {
        $this->db->query("SELECT *,col_courses.code as subjectCode, col_courses.description as subjectDescription FROM col_subject_enrolled INNER JOIN col_semester ON col_subject_enrolled.sem_ID = col_semester.sem_ID
                        INNER JOIN col_course_sched ON col_subject_enrolled.subject_sched_ID = col_course_sched.subject_sched_ID
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        WHERE col_subject_enrolled.si_ID = :studentId AND col_semester.sem_NAME = :schoolYear");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function searchSeniorSubjects($searchField, $studentId, $programId, $schoolYear)
    {
        $this->db->query("SELECT *,col_courses.code as subjectCode, col_courses.description as subjectDescription FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_section.program_id = :programId AND col_program_category.cat_name = 'Senior High School' AND col_courses.code LIKE :searchField AND col_semester.sem_NAME = :schoolYear AND col_course_sched.subject_sched_ID NOT IN (SELECT subject_sched_ID FROM col_subject_enrolled 
                        INNER JOIN col_semester ON col_subject_enrolled.sem_ID = col_semester.sem_ID WHERE col_semester.sem_NAME = :schoolYear AND col_subject_enrolled.si_ID = :studentId)");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':searchField', $searchField);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSubject11R($programId, $studentNo)
    {
        $this->db->query("SELECT *,grading_higher_subjects.subject_description as sdes, grading_college_schedule_showing.show_date as showDate FROM grading_higher_subjects LEFT JOIN grading_higher_final ON grading_higher_subjects.subject_code = grading_higher_final.subject_name AND :studentNo = grading_higher_final.student_no AND 'PASSED' = grading_higher_final.grade_remarks
                        LEFT JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        WHERE grading_higher_subjects.program_id = :programId AND grading_higher_subjects.year_level = 1 AND grading_higher_subjects.semester = 1");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':studentNo', $studentNo);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getHigherSubjectFinals()
    {
        $this->db->query("SELECT DISTINCT instructor_id, sched_id, subject_name, subject_description, year_level, school_year, semester, instructors.first_name as fname, instructors.last_name as lname FROM grading_higher_final
                        INNER JOIN instructors ON grading_higher_final.instructor_id = instructors.id WHERE school_id = 1 ORDER BY school_year DESC, semester DESC");
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getHigherSubjectFinalsS($searchField)
    {
        $this->db->query("SELECT DISTINCT instructor_id, sched_id, subject_name, subject_description, year_level, school_year, semester, instructors.first_name as fname, instructors.last_name as lname FROM grading_higher_final
                        INNER JOIN instructors ON grading_higher_final.instructor_id = instructors.id WHERE school_id = 1 AND subject_name LIKE :searchField ORDER BY school_year DESC, semester DESC");
        $this->db->bind(':searchField', $searchField);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSubjectDetails($subjectIds)
    {
        $this->db->query("SELECT * FROM col_course_sched INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id 
                        WHERE subject_sched_ID = :subjectIds");
        $this->db->bind(':subjectIds', $subjectIds);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function checkIfschedExistInFinal($subjectName, $schoolYear)
    {
        $this->db->query("SELECT * FROM grading_junior_finals WHERE subject_id = :subjectName AND school_year = :schoolYear");
        $this->db->bind(':subjectName', $subjectName);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIfSeniorSubjectExist($subjectName, $sem_name)
    {
        $this->db->query("SELECT * FROM grading_senior_finals WHERE subject_id = :subjectName AND school_year = :sem_name");
        $this->db->bind(':subjectName', $subjectName);
        $this->db->bind(':sem_name', $sem_name);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getHigherAvailableSubjectSched($programId, $schoolYear, $studentId, $sem)
    {
        $this->db->query("SELECT *,col_courses.code as subjectCode, col_courses.description as subjectDescription FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_program_category.cat_name != 'Senior High School' AND col_semester.sem_NAME = :schoolYear AND col_semester.sem_TERM = :sem AND col_course_sched.subject_sched_ID NOT IN (SELECT subject_sched_ID FROM col_subject_enrolled 
                        INNER JOIN col_semester ON col_subject_enrolled.sem_ID = col_semester.sem_ID WHERE col_semester.sem_NAME = :schoolYear AND col_subject_enrolled.si_ID = :studentId) ORDER BY col_courses.code");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':sem', $sem);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getHigherAvailableSubjectSchedS($programId, $schoolYear, $studentId, $sem, $search)
    {
        $this->db->query("SELECT *,col_courses.code as subjectCode, col_courses.description as subjectDescription FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_program_category.cat_name != 'Senior High School' AND col_semester.sem_NAME = :schoolYear AND col_semester.sem_TERM = :sem AND col_courses.code = :search AND col_course_sched.subject_sched_ID NOT IN (SELECT subject_sched_ID FROM col_subject_enrolled 
                        INNER JOIN col_semester ON col_subject_enrolled.sem_ID = col_semester.sem_ID WHERE col_semester.sem_NAME = :schoolYear AND col_subject_enrolled.si_ID = :studentId) ORDER BY col_courses.code");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':sem', $sem);
        $this->db->bind(':search', $search);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getEnrolledSubjectListStudentS($studentId, $schoolYear, $sem)
    {
        $this->db->query("SELECT *,col_courses.code as subjectCode, col_courses.description as subjectDescription FROM col_subject_enrolled INNER JOIN col_semester ON col_subject_enrolled.sem_ID = col_semester.sem_ID
                        INNER JOIN col_course_sched ON col_subject_enrolled.subject_sched_ID = col_course_sched.subject_sched_ID
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        WHERE col_subject_enrolled.si_ID = :studentId AND col_semester.sem_NAME = :schoolYear AND col_semester.sem_TERM = :sem");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':sem', $sem);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function insertHigherSubjectsList($programId, $code, $subject, $year, $sem, $units)
    {
        $this->db->query("INSERT INTO grading_higher_subjects(program_id, subject_code, subject_description, year_level, semester, units)
                        VALUES(:programId, :code, :subject, :year, :sem, :units)");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':code', $code);
        $this->db->bind(':subject', $subject);
        $this->db->bind(':year', $year);
        $this->db->bind(':sem', $sem);
        $this->db->bind(':units', $units);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getSubjectByCourseTransfer($programId)
    {
        $this->db->query("SELECT * FROM col_courses WHERE department_id = :programId");
        $this->db->bind(':programId', $programId);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
}
