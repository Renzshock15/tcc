<?php

class School
{

    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function getSchoolYear()
    {
        $this->db->query("SELECT * FROM school_years WHERE status = '1'");
        $row = $this->db->single();

        return $row;
    }

    public function getSemester()
    {
        $this->db->query("SELECT * FROM col_semester INNER JOIN col_terms ON col_semester.sem_TERM = col_terms.term_id
        WHERE col_semester.sem_status = 1 ORDER BY sem_ID DESC LIMIT 1");
        $row = $this->db->resultSet();

        return $row;
    }

    public function insertShowGradeDate($assignDate, $schedId, $schoolYear)
    {
        $this->db->query("INSERT INTO grading_junior_schedule_showing(show_date, subject_sched_id, school_year) VALUES (:assignDate, :schedId, :schoolYear)");
        $this->db->bind(':assignDate', $assignDate);
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':schoolYear', $schoolYear);

        if ($this->db->execute()) {
            $this->db->query("SELECT * FROM grading_junior_schedule_showing WHERE subject_sched_id = :schedId AND school_year = :schoolYear");
            $this->db->bind(':schedId', $schedId);
            $this->db->bind(':schoolYear', $schoolYear);

            $row = $this->db->single();

            if ($this->db->rowCount() > 0) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateShowGradeDate($assignDate, $schedId, $schoolYear)
    {
        $this->db->query("SELECT * FROM grading_junior_schedule_showing WHERE subject_sched_id = :schedId AND school_year = :schoolYear");
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            $this->db->query("UPDATE grading_junior_schedule_showing SET show_date = :assignDate WHERE id = :rowId");
            $this->db->bind(':assignDate', $assignDate);
            $this->db->bind(':rowId', $row->id);

            if ($this->db->execute()) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function getSubmitDates($schedId, $schoolYear)
    {
        $this->db->query("SELECT * FROM grading_junior_schedule_showing WHERE subject_sched_id = :schedId AND school_year = :schoolYear");
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->id = 0;
            $row->show_date = '---- -- --';
            return $row;
        }
    }

    public function updateDateNow($dateId, $updateDate)
    {
        $this->db->query("UPDATE grading_junior_schedule_showing SET show_date = :updateDate WHERE id = :dateId");
        $this->db->bind(':updateDate', $updateDate);
        $this->db->bind(':dateId', $dateId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function inserDateshow($assignDate, $schedId, $schoolYear)
    {
        $this->db->query("INSERT INTO grading_senior_schedule_showing(show_date, subject_sched_id, school_year) VALUES (:assignDate, :schedId, :schoolYear)");
        $this->db->bind(':assignDate', $assignDate);
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':schoolYear', $schoolYear);

        if ($this->db->execute()) {
            $this->db->query("SELECT * FROM grading_senior_schedule_showing WHERE subject_sched_id = :schedId AND school_year = :schoolYear");
            $this->db->bind(':schedId', $schedId);
            $this->db->bind(':schoolYear', $schoolYear);

            $row = $this->db->single();

            if ($this->db->rowCount() > 0) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function updateDateshowSr($assignDate, $schedId, $schoolYear)
    {
        $this->db->query("SELECT * FROM grading_senior_schedule_showing WHERE subject_sched_id = :schedId AND school_year = :schoolYear");
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            $this->db->query("UPDATE grading_senior_schedule_showing SET show_date = :assignDate WHERE id = :rowId");
            $this->db->bind(':assignDate', $assignDate);
            $this->db->bind(':rowId', $row->id);

            if ($this->db->execute()) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function getSubmitDatesSr($schedId, $schoolYear)
    {
        $this->db->query("SELECT * FROM grading_senior_schedule_showing WHERE subject_sched_id = :schedId AND school_year = :schoolYear");
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->id = 0;
            $row->show_date = '---- -- --';
            return $row;
        }
    }

    public function updateDateNowSr($dateId, $updateDate)
    {
        $this->db->query("UPDATE grading_senior_schedule_showing SET show_date = :updateDate WHERE id = :dateId");
        $this->db->bind(':updateDate', $updateDate);
        $this->db->bind(':dateId', $dateId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function inserCollegeShowDate($schedId, $schoolYear, $currentTerm, $assignDate)
    {
        $this->db->query("INSERT INTO grading_college_schedule_showing (show_date, subject_id, school_year, semester)
                        VALUES (:assignDate, :schedId, :schoolYear, :currentTerm)");
        $this->db->bind(':assignDate', $assignDate);
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentTerm', $currentTerm);

        if ($this->db->execute()) {
            $this->db->query("SELECT * FROM grading_college_schedule_showing WHERE subject_id = :schedId AND school_year = :schoolYear AND semester = :currentTerm");
            $this->db->bind(':schedId', $schedId);
            $this->db->bind(':schoolYear', $schoolYear);
            $this->db->bind(':currentTerm', $currentTerm);

            $row = $this->db->single();

            if ($this->db->rowCount() > 0) {
                return $row;
            } else {
                return false;
            }
        }
    }

    public function getSubmitDatesCollege($schedId, $schoolYear, $semester)
    {
        $this->db->query("SELECT * FROM grading_college_schedule_showing WHERE subject_id = :schedId AND school_year = :schoolYear AND semester = :semester");
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':semester', $semester);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            $row = new \stdClass;
            $row->id = 0;
            $row->show_date = '---- -- --';
            return $row;
        }
    }

    public function updateDateNowCollege($dateId, $updateDate)
    {
        $this->db->query("UPDATE grading_college_schedule_showing SET show_date = :updateDate WHERE id = :dateId");
        $this->db->bind(':updateDate', $updateDate);
        $this->db->bind(':dateId', $dateId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getSchoolYears()
    {
        $this->db->query("SELECT * FROM school_years");
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function saveSchoolName($schoolName, $studentNo, $gradeLevel)
    {
        $this->db->query("SELECT * FROM grading_junior_school WHERE getSchoolCode = :getSchoolCode");
        $this->db->bind(':getSchoolCode', $studentNo . $gradeLevel);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row->id;
        } else {
            $this->db->query("INSERT INTO grading_junior_school(school_name, getSchoolCode)VALUES(:schoolName, :getSchoolCode)");
            $this->db->bind(':schoolName', $schoolName);
            $this->db->bind(':getSchoolCode', $studentNo . $gradeLevel);

            if ($this->db->execute()) {
                $this->db->query("SELECT * FROM grading_junior_school WHERE getSchoolCode = :getSchoolCode");
                $this->db->bind(':getSchoolCode', $studentNo . $gradeLevel);

                $row = $this->db->single();

                if ($this->db->rowCount() > 0) {
                    return $row->id;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function updateJuniorSchool($schoolId, $newSchool)
    {
        $this->db->query("UPDATE grading_junior_school SET school_name = :newSchool WHERE id = :schoolId");
        $this->db->bind(':newSchool', $newSchool);
        $this->db->bind(':schoolId', $schoolId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getEnrolleeList($schoolYear)
    {
        $this->db->query("SELECT *,enrollees.id as enrolleeId FROM enrollees INNER JOIN student_info ON enrollees.enrollee_info_id = student_info.id
                        INNER JOIN school_years ON enrollees.school_year_id = school_years.id
                        INNER JOIN sections ON enrollees.section_id = sections.id
                        WHERE enrollees.enrollee_status = 'enrolled' AND school_years.term_name = :schoolYear ORDER BY enrollees.id DESC");
        $this->db->bind(':schoolYear', $schoolYear);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getJuniorSection($valueLevel)
    {
        $this->db->query("SELECT * FROM sections WHERE for_grade = :valueLevel");
        $this->db->bind(':valueLevel', $valueLevel);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function enrolledOfflineJunior($newRegNo, $gradeSection, $infoId, $schoolYear, $status)
    {
        $this->db->query("SELECT * FROM school_years WHERE term_name = :schoolYear");
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            $this->db->query("INSERT INTO enrollees(enrollee_info_id, enrollee_status, section_id, registration_number, school_year_id)
                            VALUES(:infoId, :status, :gradeSection, :newRegNo, :id)");
            $this->db->bind(':infoId', $infoId);
            $this->db->bind(':status', $status);
            $this->db->bind(':gradeSection', $gradeSection);
            $this->db->bind(':newRegNo', $newRegNo);
            $this->db->bind(':id', $row->id);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteEnrolledOffline($enrolleeId)
    {
        $this->db->query("DELETE FROM enrollees WHERE id = :enrolleeId");
        $this->db->bind(':enrolleeId', $enrolleeId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getSeniorStrand($academicLevel)
    {
        $this->db->query("SELECT * FROM col_program INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_program_category.cat_name = :academicLevel");
        $this->db->bind(':academicLevel', $academicLevel);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getProgram($programId)
    {
        $this->db->query("SELECT * FROM col_program WHERE id = :programId");
        $this->db->bind(':programId', $programId);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getHighSchoolYear()
    {
        $this->db->query("SELECT DISTINCT sem_NAME FROM col_semester ORDER BY sem_NAME ASC");
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function saveSchoolNameS($schoolName, $studentNo, $gradeLevel, $sem)
    {
        $this->db->query("SELECT * FROM grading_senior_school WHERE get_school_code = :code");
        $this->db->bind(':code', $studentNo . $gradeLevel . $sem);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row->id;
        } else {
            $this->db->query("INSERT INTO grading_senior_school(school_name, get_school_code) VALUES (:schoolName, :code)");
            $this->db->bind(':schoolName', $schoolName);
            $this->db->bind(':code', $studentNo . $gradeLevel . $sem);

            if ($this->db->execute()) {
                $this->db->query("SELECT * FROM grading_senior_school WHERE get_school_code = :code");
                $this->db->bind(':code', $studentNo . $gradeLevel . $sem);

                $rows = $this->db->single();

                if ($this->db->rowCount() > 0) {
                    return $rows->id;
                }
            } else {
                return false;
            }
        }
    }

    public function saveSchoolNameHigh($schoolName, $studentNo, $sem)
    {
        $this->db->query("SELECT * FROM grading_college_school WHERE school_codes = :code");
        $this->db->bind(':code', $studentNo  . $sem);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row->id;
        } else {
            $this->db->query("INSERT INTO grading_college_school(school_name, school_codes) VALUES (:schoolName, :code)");
            $this->db->bind(':schoolName', $schoolName);
            $this->db->bind(':code', $studentNo  . $sem);

            if ($this->db->execute()) {
                $this->db->query("SELECT * FROM grading_college_school WHERE school_codes = :code");
                $this->db->bind(':code', $studentNo  . $sem);

                $rows = $this->db->single();

                if ($this->db->rowCount() > 0) {
                    return $rows->id;
                }
            } else {
                return false;
            }
        }
    }

    public function editSchoolSeniorGradeRecordsAll($schoolId, $schoolName)
    {
        $this->db->query("UPDATE grading_senior_school SET school_name = :schoolName WHERE id = :schoolId");
        $this->db->bind(':schoolName', $schoolName);
        $this->db->bind(':schoolId', $schoolId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function enrolledSelectedSeniorHigh($semId, $schedId, $studentId)
    {
        $this->db->query("INSERT INTO col_subject_enrolled (sem_ID, subject_sched_ID, si_ID) VALUES (:semId, :schedId, :studentId)");
        $this->db->bind(':semId', $semId);
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':studentId', $studentId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEnrolledSenior($schedId)
    {
        $this->db->query("DELETE FROM col_subject_enrolled WHERE subject_enrolled_id = :schedId");
        $this->db->bind(':schedId', $schedId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getHigherProgram($programId)
    {
        $this->db->query("SELECT * FROM col_program WHERE id = :programId");
        $this->db->bind(':programId', $programId);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function enrolledSelectedHighStudent($semId, $schedId, $studentId)
    {
        $this->db->query("INSERT INTO col_subject_enrolled (sem_ID, subject_sched_ID, si_ID) VALUES (:semId, :schedId, :studentId)");
        $this->db->bind(':semId', $semId);
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':studentId', $studentId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getHigherCourses($condition)
    {
        $this->db->query("SELECT * FROM col_program INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_program_category.cat_name != :condition");

        $this->db->bind(':condition', $condition);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getcoursebyprogram($programId)
    {
        $this->db->query("SELECT * FROM col_program WHERE id = :programId");
        $this->db->bind(':programId', $programId);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getHigherSubjectList($programId)
    {
        $this->db->query("SELECT *,grading_higher_subjects.id as recId FROM grading_higher_subjects INNER JOIN col_program ON grading_higher_subjects.program_id = col_program.id
                        WHERE program_id = :programId ORDER BY year_level, semester");
        $this->db->bind(':programId', $programId);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getCourseSubjectAssign($programId)
    {
        $this->db->query("SELECT * FROM col_courses WHERE department_id = :programId AND code NOT IN (SELECT subject_code FROM grading_higher_subjects WHERE program_id = :programId)");
        $this->db->bind(':programId', $programId);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAllSubjectsHigherByStudent($programId)
    {
        $this->db->query("SELECT *,grading_higher_final.id as recId, grading_college_school.id as schoolId FROM grading_higher_final INNER JOIN grading_college_school ON grading_higher_final.school_id = grading_college_school.id 
                        WHERE student_no = :programId ORDER BY grading_higher_final.id");
        $this->db->bind(':programId', $programId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function updateSchoolHigher($schoolId, $schoolName)
    {
        $this->db->query("UPDATE grading_college_school SET school_name = :schoolName WHERE id = :schoolId");
        $this->db->bind(':schoolName', $schoolName);
        $this->db->bind(':schoolId', $schoolId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getSchedDataSenior($newDepartment, $schoolYear)
    {
        $this->db->query("SELECT *,col_courses.code as subjectCode, col_courses.description as subjectDes, col_program.code as courseCode, col_course_sched.subject_sched_ID as ssId FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        LEFT JOIN instructors ON col_course_sched.instructor_ID = instructors.id
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_program_category.cat_name = :newDepartment AND col_semester.sem_NAME = :schoolYear ORDER BY col_courses.code");
        $this->db->bind(':newDepartment', $newDepartment);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSchedDataHigher($newDepartment, $schoolYear, $sem)
    {
        $this->db->query("SELECT *,col_courses.code as subjectCode, col_courses.description as subjectDes, col_program.code as courseCode, col_course_sched.subject_sched_ID as ssId FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        LEFT JOIN instructors ON col_course_sched.instructor_ID = instructors.id
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_program_category.cat_name != :newDepartment AND col_semester.sem_NAME = :schoolYear AND col_semester.sem_TERM = :sem ORDER BY col_courses.code");
        $this->db->bind(':newDepartment', $newDepartment);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':sem', $sem);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSchedDataSeniorS($newDepartment, $schoolYear, $searchField)
    {
        $this->db->query("SELECT *,col_courses.code as subjectCode, col_courses.description as subjectDes, col_program.code as courseCode, col_course_sched.subject_sched_ID as ssId FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        LEFT JOIN instructors ON col_course_sched.instructor_ID = instructors.id
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_program_category.cat_name = :newDepartment AND col_semester.sem_NAME = :schoolYear AND col_courses.code LIKE :searchField ORDER BY col_courses.code");
        $this->db->bind(':newDepartment', $newDepartment);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':searchField', $searchField);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSchedDataHigherS($newDepartment, $schoolYear, $sem, $searchField)
    {
        $this->db->query("SELECT *,col_courses.code as subjectCode, col_courses.description as subjectDes, col_program.code as courseCode, col_course_sched.subject_sched_ID as ssId FROM col_course_sched INNER JOIN col_courses ON col_course_sched.subject_ID = col_courses.id
                        INNER JOIN col_section ON col_course_sched.semester_section_ID = col_section.section_id
                        LEFT JOIN instructors ON col_course_sched.instructor_ID = instructors.id
                        INNER JOIN col_semester ON col_section.sem_id = col_semester.sem_ID
                        INNER JOIN col_program ON col_section.program_id = col_program.id
                        INNER JOIN col_program_category ON col_program.prog_cat_id = col_program_category.prog_cat_id
                        WHERE col_program_category.cat_name != :newDepartment AND col_semester.sem_NAME = :schoolYear AND col_semester.sem_TERM = :sem AND col_courses.code LIKE :searchField ORDER BY col_courses.code");
        $this->db->bind(':newDepartment', $newDepartment);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':sem', $sem);
        $this->db->bind(':searchField', $searchField);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getDepartments($level)
    {
        $this->db->query("SELECT * FROM departments WHERE type = :level");
        $this->db->bind(':level', $level);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getInstructors($depId)
    {
        $this->db->query("SELECT * FROM instructors WHERE department_id = :depId");
        $this->db->bind(':depId', $depId);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function addTeacherToSched($insId, $schedId)
    {
        $this->db->query("UPDATE col_course_sched SET instructor_ID = :insId WHERE subject_sched_ID = :schedId");
        $this->db->bind(':insId', $insId);
        $this->db->bind(':schedId', $schedId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
