<?php

class Grade
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function loadJrGrade($subjectId, $currenSchoolYear, $gradeSource,  $quarter)
    {
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

    public function updateJrGrade($jrGradeId, $activities)
    {
        $this->db->query("UPDATE grading_junior SET act_1 = :act1, act_2 = :act2, act_3 = :act3, act_4 = :act4, act_5 = :act5,
                        act_6 = :act6, act_7 = :act7, act_8 = :act8, act_9 = :act9, act_10 = :act10, act_11 = :act11, act_12 = :act12,
                        act_13 = :act13, act_14 = :act14, act_15 = :act15 WHERE g_j_id = :jrGradeId");
        $this->db->bind(':jrGradeId', $jrGradeId);
        $this->db->bind(':act1', intval($activities['act1']));
        $this->db->bind(':act2', intval($activities['act2']));
        $this->db->bind(':act3', intval($activities['act3']));
        $this->db->bind(':act4', intval($activities['act4']));
        $this->db->bind(':act5', intval($activities['act5']));
        $this->db->bind(':act6', intval($activities['act6']));
        $this->db->bind(':act7', intval($activities['act7']));
        $this->db->bind(':act8', intval($activities['act8']));
        $this->db->bind(':act9', intval($activities['act9']));
        $this->db->bind(':act10', intval($activities['act10']));
        $this->db->bind(':act11', intval($activities['act11']));
        $this->db->bind(':act12', intval($activities['act12']));
        $this->db->bind(':act13', intval($activities['act13']));
        $this->db->bind(':act14', intval($activities['act14']));
        $this->db->bind(':act15', intval($activities['act15']));

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //ad high grade jr
    public function addJrHighGrade($subjectId, $quarter, $gradeSource, $actNo, $actName, $actScore, $schoolYear, $colId)
    {
        $this->db->query("INSERT INTO grading_junior_highest (subject_id, quarter, grade_source, act_no, act_name, act_high_score, school_year) VALUES (
                        :subjectId, :quarter, :gradeSource, :actNo, :actName, :actScore, :schoolYear)");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':actName', $actName);
        $this->db->bind(':actScore', intval($actScore['actJrHs']));
        $this->db->bind(':schoolYear', $schoolYear);

        if ($this->db->execute()) {

            switch ($colId) {
                case 0:
                    $this->db->query("INSERT INTO grading_junior_highest_ids (act_1_id) SELECT g_j_h_id FROM grading_junior_highest WHERE subject_id = :subjectId AND quarter = :quarter AND
                    grade_source = :gradeSource AND school_year = :schoolYear AND act_no = :actNo");
                    $this->db->bind(':subjectId', $subjectId);
                    $this->db->bind(':quarter', $quarter);
                    $this->db->bind(':gradeSource', $gradeSource);
                    $this->db->bind(':schoolYear', $schoolYear);
                    $this->db->bind(':actNo', $actNo);

                    if ($this->db->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                    break;
                default:
                    $activityNo = 'act_' . $actNo . '_id';
                    $this->db->query("UPDATE grading_junior_highest_ids SET $activityNo = (SELECT g_j_h_id FROM grading_junior_highest WHERE subject_id = :subjectId AND quarter = :quarter AND
                    grade_source = :gradeSource AND school_year = :schoolYear AND act_no = :actNo) WHERE g_j_h_ids_id = :g_j_h_ids");
                    $this->db->bind(':subjectId', $subjectId);
                    $this->db->bind(':quarter', $quarter);
                    $this->db->bind(':gradeSource', $gradeSource);
                    $this->db->bind(':actNo', $actNo);
                    $this->db->bind(':schoolYear', $schoolYear);
                    // $this->db->bind(':activity', 'act_' . $actNo . '_id');
                    $this->db->bind(':g_j_h_ids',  $colId);

                    if ($this->db->execute()) {
                        return true;
                    } else {
                        return false;
                    }
            }
        } else {
            return false;
        }
    }

    public function updateJrHighGrade($actScore, $gjh_id, $actName)
    {
        $this->db->query("UPDATE grading_junior_highest SET act_high_score = :actHighSCore, act_name = :actName WHERE g_j_h_id = :gjh_id");
        $this->db->bind(':actHighSCore', intval($actScore['actJrHs']));
        $this->db->bind(':gjh_id', $gjh_id);
        $this->db->bind(':actName', $actName);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getJrHighSCore($subjectName, $gradeSource, $gradeQuarter, $schoolYear)
    {
        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function updateJrWs($updateWsValue, $wsId)
    {
        $this->db->query("UPDATE grading_junior_highest_ids SET act_ws = :updateWsValue WHERE g_j_h_ids_id = :wsId");
        $this->db->bind(':wsId', $wsId);
        $this->db->bind(':updateWsValue', intval($updateWsValue['newWs1']));

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Junior 1st quarter Grade Summary
    public function juniorGradeSummaryFWW($subjectName, $schoolYear)
    {
        $gradeSource = 'written works';
        $gradeQuarter = '1st quarter';

        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function juniorGradeSummaryFPT($subjectName, $schoolYear)
    {
        $gradeSource = 'performance task';
        $gradeQuarter = '1st quarter';

        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function juniorGradeSummaryFQA($subjectName, $schoolYear)
    {
        $gradeSource = 'quarterly assessment';
        $gradeQuarter = '1st quarter';

        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    //junior 2nd quarter Grade Summary
    public function juniorGradeSummarySWW($subjectName, $schoolYear)
    {
        $gradeSource = 'written works';
        $gradeQuarter = '2nd quarter';

        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function juniorGradeSummarySPT($subjectName, $schoolYear)
    {
        $gradeSource = 'performance task';
        $gradeQuarter = '2nd quarter';

        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function juniorGradeSummarySQA($subjectName, $schoolYear)
    {
        $gradeSource = 'quarterly assessment';
        $gradeQuarter = '2nd quarter';

        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    //junior 3rd quarter Grade Summary
    public function juniorGradeSummaryTWW($subjectName, $schoolYear)
    {
        $gradeSource = 'written works';
        $gradeQuarter = '3rd quarter';

        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function juniorGradeSummaryTPT($subjectName, $schoolYear)
    {
        $gradeSource = 'performance task';
        $gradeQuarter = '3rd quarter';

        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function juniorGradeSummaryTQA($subjectName, $schoolYear)
    {
        $gradeSource = 'quarterly assessment';
        $gradeQuarter = '3rd quarter';

        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    //junior 4th quarter Grade Summary
    public function juniorGradeSummaryFOWW($subjectName, $schoolYear)
    {
        $gradeSource = 'written works';
        $gradeQuarter = '4th quarter';

        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function juniorGradeSummaryFOPT($subjectName, $schoolYear)
    {
        $gradeSource = 'performance task';
        $gradeQuarter = '4th quarter';

        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function juniorGradeSummaryFOQA($subjectName, $schoolYear)
    {
        $gradeSource = 'quarterly assessment';
        $gradeQuarter = '4th quarter';

        $this->db->query("SELECT * ,grading_junior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_junior_highest.g_j_h_id as act1Id, act2.g_j_h_id as act2Id, act3.g_j_h_id as act3Id,
                        act4.g_j_h_id as act4Id, act5.g_j_h_id as act5Id, act6.g_j_h_id as act6Id, act7.g_j_h_id as act7Id,
                        act8.g_j_h_id as act8Id, act9.g_j_h_id as act9Id, act10.g_j_h_id as act10Id, act11.g_j_h_id as act11Id,
                        act12.g_j_h_id as act12Id, act13.g_j_h_id as act13Id, act14.g_j_h_id as act14Id, act15.g_j_h_id as act15Id, 
                        grading_junior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_junior_highest_ids.act_ws as actWs FROM grading_junior_highest_ids LEFT JOIN grading_junior_highest ON grading_junior_highest_ids.act_1_id = grading_junior_highest.g_j_h_id
                        LEFT JOIN grading_junior_highest as act2 ON grading_junior_highest_ids.act_2_id = act2.g_j_h_id
                        LEFT JOIN grading_junior_highest as act3 ON grading_junior_highest_ids.act_3_id = act3.g_j_h_id
                        LEFT JOIN grading_junior_highest as act4 ON grading_junior_highest_ids.act_4_id = act4.g_j_h_id
                        LEFT JOIN grading_junior_highest as act5 ON grading_junior_highest_ids.act_5_id = act5.g_j_h_id
                        LEFT JOIN grading_junior_highest as act6 ON grading_junior_highest_ids.act_6_id = act6.g_j_h_id
                        LEFT JOIN grading_junior_highest as act7 ON grading_junior_highest_ids.act_7_id = act7.g_j_h_id
                        LEFT JOIN grading_junior_highest as act8 ON grading_junior_highest_ids.act_8_id = act8.g_j_h_id
                        LEFT JOIN grading_junior_highest as act9 ON grading_junior_highest_ids.act_9_id = act9.g_j_h_id
                        LEFT JOIN grading_junior_highest as act10 ON grading_junior_highest_ids.act_10_id = act10.g_j_h_id
                        LEFT JOIN grading_junior_highest as act11 ON grading_junior_highest_ids.act_11_id = act11.g_j_h_id
                        LEFT JOIN grading_junior_highest as act12 ON grading_junior_highest_ids.act_12_id = act12.g_j_h_id
                        LEFT JOIN grading_junior_highest as act13 ON grading_junior_highest_ids.act_13_id = act13.g_j_h_id
                        LEFT JOIN grading_junior_highest as act14 ON grading_junior_highest_ids.act_14_id = act14.g_j_h_id
                        LEFT JOIN grading_junior_highest as act15 ON grading_junior_highest_ids.act_15_id = act15.g_j_h_id
                        WHERE grading_junior_highest.school_year = :schoolYear AND grading_junior_highest.quarter = :gradeQuarter AND grading_junior_highest.grade_source = :gradeSource
                        AND grading_junior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    //senior
    public function getSrHighSCore($subjectName, $gradeSource, $gradeQuarter, $schoolYear)
    {
        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                        act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                        act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                        act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                        act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                        grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                        act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                        act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                        act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                        grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                        act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                        act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                        act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                        LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                        LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                        LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                        LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                        LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                        LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                        LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                        LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                        LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                        LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                        LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                        LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                        LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                        LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                        WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                        AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function loadSrGrade($subjectId, $currenSchoolYear, $gradeSource,  $quarter)
    {
        $this->db->query("SELECT * FROM grading_senior INNER JOIN col_subject_enrolled ON grading_senior.enrollee_id = col_subject_enrolled.subject_enrolled_ID
                        INNER JOIN col_student ON col_subject_enrolled.si_ID = col_student.student_id 
                        WHERE subject_Id = :subjectId AND school_year = :currenSchoolYear AND quarter = :quarter And grade_source = :gradeSource ORDER BY col_student.lname ASC");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':currenSchoolYear', $currenSchoolYear);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function addSrHighGrade($subjectId, $quarter, $gradeSource, $actNo, $actName, $actScore, $schoolYear, $colId)
    {
        $this->db->query("INSERT INTO grading_senior_highest (subject_id, quarter, grade_source, act_no, act_name, act_high_score, school_year) VALUES (
                        :subjectId, :quarter, :gradeSource, :actNo, :actName, :actScore, :schoolYear)");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':actName', $actName);
        $this->db->bind(':actScore', intval($actScore['actJrHs']));
        $this->db->bind(':schoolYear', $schoolYear);

        if ($this->db->execute()) {

            switch ($colId) {
                case 0:
                    $this->db->query("INSERT INTO grading_senior_highest_ids (act_1_id) SELECT g_s_h_id FROM grading_senior_highest WHERE subject_id = :subjectId AND quarter = :quarter AND
                    grade_source = :gradeSource AND school_year = :schoolYear AND act_no = :actNo");
                    $this->db->bind(':subjectId', $subjectId);
                    $this->db->bind(':quarter', $quarter);
                    $this->db->bind(':gradeSource', $gradeSource);
                    $this->db->bind(':schoolYear', $schoolYear);
                    $this->db->bind(':actNo', $actNo);

                    if ($this->db->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                    break;
                default:
                    $activityNo = 'act_' . $actNo . '_id';
                    $this->db->query("UPDATE grading_senior_highest_ids SET $activityNo = (SELECT g_s_h_id FROM grading_senior_highest WHERE subject_id = :subjectId AND quarter = :quarter AND
                    grade_source = :gradeSource AND school_year = :schoolYear AND act_no = :actNo) WHERE g_s_h_ids_id = :g_j_h_ids");
                    $this->db->bind(':subjectId', $subjectId);
                    $this->db->bind(':quarter', $quarter);
                    $this->db->bind(':gradeSource', $gradeSource);
                    $this->db->bind(':actNo', $actNo);
                    $this->db->bind(':schoolYear', $schoolYear);
                    // $this->db->bind(':activity', 'act_' . $actNo . '_id');
                    $this->db->bind(':g_j_h_ids',  $colId);

                    if ($this->db->execute()) {
                        return true;
                    } else {
                        return false;
                    }
            }
        } else {
            return false;
        }
    }

    public function updateSrHighGrade($actScore, $gjh_id, $actName)
    {
        $this->db->query("UPDATE grading_senior_highest SET act_high_score = :actHighSCore, act_name = :actName WHERE g_s_h_id = :gjh_id");
        $this->db->bind(':actHighSCore', intval($actScore['actJrHs']));
        $this->db->bind(':gjh_id', $gjh_id);
        $this->db->bind(':actName', $actName);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSrGrade($jrGradeId, $activities)
    {
        $this->db->query("UPDATE grading_senior SET act_1 = :act1, act_2 = :act2, act_3 = :act3, act_4 = :act4, act_5 = :act5,
                        act_6 = :act6, act_7 = :act7, act_8 = :act8, act_9 = :act9, act_10 = :act10, act_11 = :act11, act_12 = :act12,
                        act_13 = :act13, act_14 = :act14, act_15 = :act15 WHERE g_s_id = :jrGradeId");
        $this->db->bind(':jrGradeId', $jrGradeId);
        $this->db->bind(':act1', intval($activities['act1']));
        $this->db->bind(':act2', intval($activities['act2']));
        $this->db->bind(':act3', intval($activities['act3']));
        $this->db->bind(':act4', intval($activities['act4']));
        $this->db->bind(':act5', intval($activities['act5']));
        $this->db->bind(':act6', intval($activities['act6']));
        $this->db->bind(':act7', intval($activities['act7']));
        $this->db->bind(':act8', intval($activities['act8']));
        $this->db->bind(':act9', intval($activities['act9']));
        $this->db->bind(':act10', intval($activities['act10']));
        $this->db->bind(':act11', intval($activities['act11']));
        $this->db->bind(':act12', intval($activities['act12']));
        $this->db->bind(':act13', intval($activities['act13']));
        $this->db->bind(':act14', intval($activities['act14']));
        $this->db->bind(':act15', intval($activities['act15']));

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSrWs($updateWsValue, $wsId)
    {
        $this->db->query("UPDATE grading_senior_highest_ids SET act_ws = :updateWsValue WHERE g_s_h_ids_id = :wsId");
        $this->db->bind(':wsId', $wsId);
        $this->db->bind(':updateWsValue', intval($updateWsValue['newWs1']));

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Junior 1st quarter Grade Summary
    public function seniorGradeSummaryFWW($subjectName, $schoolYear)
    {
        $gradeSource = 'written works';
        $gradeQuarter = '1st quarter';

        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                         act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                         act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                         act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                         grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                         LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                         LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                         LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                         LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                         LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                         LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                         LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                         LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                         LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                         LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                         LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                         LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                         LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                         LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                         WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                         AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function seniorGradeSummaryFPT($subjectName, $schoolYear)
    {
        $gradeSource = 'performance task';
        $gradeQuarter = '1st quarter';

        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                         act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                         act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                         act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                         grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                         LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                         LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                         LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                         LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                         LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                         LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                         LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                         LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                         LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                         LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                         LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                         LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                         LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                         LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                         WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                         AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function seniorGradeSummaryFQA($subjectName, $schoolYear)
    {
        $gradeSource = 'quarterly assessment';
        $gradeQuarter = '1st quarter';

        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                         act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                         act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                         act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                         grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                         LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                         LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                         LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                         LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                         LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                         LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                         LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                         LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                         LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                         LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                         LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                         LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                         LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                         LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                         WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                         AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function seniorGradeSummarySWW($subjectName, $schoolYear)
    {
        $gradeSource = 'written works';
        $gradeQuarter = '2nd quarter';

        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                         act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                         act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                         act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                         grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                         LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                         LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                         LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                         LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                         LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                         LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                         LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                         LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                         LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                         LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                         LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                         LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                         LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                         LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                         WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                         AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function seniorGradeSummarySPT($subjectName, $schoolYear)
    {
        $gradeSource = 'performance task';
        $gradeQuarter = '2nd quarter';

        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                         act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                         act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                         act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                         grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                         LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                         LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                         LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                         LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                         LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                         LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                         LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                         LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                         LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                         LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                         LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                         LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                         LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                         LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                         WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                         AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function seniorGradeSummarySQA($subjectName, $schoolYear)
    {
        $gradeSource = 'quarterly assessment';
        $gradeQuarter = '2nd quarter';

        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                         act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                         act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                         act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                         grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                         LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                         LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                         LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                         LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                         LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                         LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                         LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                         LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                         LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                         LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                         LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                         LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                         LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                         LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                         WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                         AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function seniorGradeSummaryTWW($subjectName, $schoolYear)
    {
        $gradeSource = 'written works';
        $gradeQuarter = '3rd quarter';

        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                         act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                         act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                         act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                         grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                         LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                         LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                         LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                         LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                         LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                         LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                         LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                         LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                         LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                         LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                         LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                         LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                         LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                         LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                         WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                         AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function seniorGradeSummaryTPT($subjectName, $schoolYear)
    {
        $gradeSource = 'performance task';
        $gradeQuarter = '3rd quarter';

        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                         act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                         act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                         act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                         grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                         LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                         LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                         LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                         LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                         LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                         LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                         LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                         LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                         LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                         LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                         LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                         LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                         LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                         LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                         WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                         AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function seniorGradeSummaryTQA($subjectName, $schoolYear)
    {
        $gradeSource = 'quarterly assessment';
        $gradeQuarter = '3rd quarter';

        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                         act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                         act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                         act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                         grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                         LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                         LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                         LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                         LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                         LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                         LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                         LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                         LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                         LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                         LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                         LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                         LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                         LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                         LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                         WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                         AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function seniorGradeSummaryFOWW($subjectName, $schoolYear)
    {
        $gradeSource = 'written works';
        $gradeQuarter = '4th quarter';

        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                         act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                         act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                         act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                         grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                         LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                         LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                         LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                         LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                         LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                         LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                         LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                         LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                         LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                         LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                         LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                         LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                         LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                         LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                         WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                         AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function seniorGradeSummaryFOPT($subjectName, $schoolYear)
    {
        $gradeSource = 'performance task';
        $gradeQuarter = '4th quarter';

        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                         act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                         act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                         act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                         grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                         LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                         LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                         LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                         LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                         LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                         LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                         LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                         LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                         LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                         LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                         LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                         LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                         LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                         LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                         WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                         AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function seniorGradeSummaryFOQA($subjectName, $schoolYear)
    {
        $gradeSource = 'quarterly assessment';
        $gradeQuarter = '4th quarter';

        $this->db->query("SELECT * ,grading_senior_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_senior_highest.g_s_h_id as act1Id, act2.g_s_h_id as act2Id, act3.g_s_h_id as act3Id,
                         act4.g_s_h_id as act4Id, act5.g_s_h_id as act5Id, act6.g_s_h_id as act6Id, act7.g_s_h_id as act7Id,
                         act8.g_s_h_id as act8Id, act9.g_s_h_id as act9Id, act10.g_s_h_id as act10Id, act11.g_s_h_id as act11Id,
                         act12.g_s_h_id as act12Id, act13.g_s_h_id as act13Id, act14.g_s_h_id as act14Id, act15.g_s_h_id as act15Id, 
                         grading_senior_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_senior_highest_ids.act_ws as actWs FROM grading_senior_highest_ids LEFT JOIN grading_senior_highest ON grading_senior_highest_ids.act_1_id = grading_senior_highest.g_s_h_id
                         LEFT JOIN grading_senior_highest as act2 ON grading_senior_highest_ids.act_2_id = act2.g_s_h_id
                         LEFT JOIN grading_senior_highest as act3 ON grading_senior_highest_ids.act_3_id = act3.g_s_h_id
                         LEFT JOIN grading_senior_highest as act4 ON grading_senior_highest_ids.act_4_id = act4.g_s_h_id
                         LEFT JOIN grading_senior_highest as act5 ON grading_senior_highest_ids.act_5_id = act5.g_s_h_id
                         LEFT JOIN grading_senior_highest as act6 ON grading_senior_highest_ids.act_6_id = act6.g_s_h_id
                         LEFT JOIN grading_senior_highest as act7 ON grading_senior_highest_ids.act_7_id = act7.g_s_h_id
                         LEFT JOIN grading_senior_highest as act8 ON grading_senior_highest_ids.act_8_id = act8.g_s_h_id
                         LEFT JOIN grading_senior_highest as act9 ON grading_senior_highest_ids.act_9_id = act9.g_s_h_id
                         LEFT JOIN grading_senior_highest as act10 ON grading_senior_highest_ids.act_10_id = act10.g_s_h_id
                         LEFT JOIN grading_senior_highest as act11 ON grading_senior_highest_ids.act_11_id = act11.g_s_h_id
                         LEFT JOIN grading_senior_highest as act12 ON grading_senior_highest_ids.act_12_id = act12.g_s_h_id
                         LEFT JOIN grading_senior_highest as act13 ON grading_senior_highest_ids.act_13_id = act13.g_s_h_id
                         LEFT JOIN grading_senior_highest as act14 ON grading_senior_highest_ids.act_14_id = act14.g_s_h_id
                         LEFT JOIN grading_senior_highest as act15 ON grading_senior_highest_ids.act_15_id = act15.g_s_h_id
                         WHERE grading_senior_highest.school_year = :schoolYear AND grading_senior_highest.quarter = :gradeQuarter AND grading_senior_highest.grade_source = :gradeSource
                         AND grading_senior_highest.subject_id = :subjectName");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    //college
    public function getCollegeHighSCore($subjectName, $gradeSource, $gradeQuarter, $schoolYear, $currentSem)
    {
        $this->db->query("SELECT * ,grading_college_highest.act_high_score as act1, act2.act_high_score as act2, act3.act_high_score as act3,
                         act4.act_high_score as act4, act5.act_high_score as act5, act6.act_high_score as act6,
                         act7.act_high_score as act7, act8.act_high_score as act8, act9.act_high_score as act9,
                         act10.act_high_score as act10, act11.act_high_score as act11, act12.act_high_score as act12,
                         act13.act_high_score as act13, act14.act_high_score as act14, act15.act_high_score as act15,
                         grading_college_highest.g_c_h_id as act1Id, act2.g_c_h_id as act2Id, act3.g_c_h_id as act3Id,
                         act4.g_c_h_id as act4Id, act5.g_c_h_id as act5Id, act6.g_c_h_id as act6Id, act7.g_c_h_id as act7Id,
                         act8.g_c_h_id as act8Id, act9.g_c_h_id as act9Id, act10.g_c_h_id as act10Id, act11.g_c_h_id as act11Id,
                         act12.g_c_h_id as act12Id, act13.g_c_h_id as act13Id, act14.g_c_h_id as act14Id, act15.g_c_h_id as act15Id, 
                         grading_college_highest.act_name as act1Name, act2.act_name as act2Name, act3.act_name as act3Name,
                         act4.act_name as act4Name, act5.act_name as act5Name, act6.act_name as act6Name, act7.act_name as act7Name,
                         act8.act_name as act8Name, act9.act_name as act9Name, act10.act_name as act10Name, act11.act_name as act11Name,
                         act12.act_name as act12Name, act13.act_name as act13Name, act14.act_name as act14Name, act15.act_name as act15Name, grading_college_highest_ids.act_ws as actWs FROM grading_college_highest_ids LEFT JOIN grading_college_highest ON grading_college_highest_ids.act_1_id = grading_college_highest.g_c_h_id
                         LEFT JOIN grading_college_highest as act2 ON grading_college_highest_ids.act_2_id = act2.g_c_h_id
                         LEFT JOIN grading_college_highest as act3 ON grading_college_highest_ids.act_3_id = act3.g_c_h_id
                         LEFT JOIN grading_college_highest as act4 ON grading_college_highest_ids.act_4_id = act4.g_c_h_id
                         LEFT JOIN grading_college_highest as act5 ON grading_college_highest_ids.act_5_id = act5.g_c_h_id
                         LEFT JOIN grading_college_highest as act6 ON grading_college_highest_ids.act_6_id = act6.g_c_h_id
                         LEFT JOIN grading_college_highest as act7 ON grading_college_highest_ids.act_7_id = act7.g_c_h_id
                         LEFT JOIN grading_college_highest as act8 ON grading_college_highest_ids.act_8_id = act8.g_c_h_id
                         LEFT JOIN grading_college_highest as act9 ON grading_college_highest_ids.act_9_id = act9.g_c_h_id
                         LEFT JOIN grading_college_highest as act10 ON grading_college_highest_ids.act_10_id = act10.g_c_h_id
                         LEFT JOIN grading_college_highest as act11 ON grading_college_highest_ids.act_11_id = act11.g_c_h_id
                         LEFT JOIN grading_college_highest as act12 ON grading_college_highest_ids.act_12_id = act12.g_c_h_id
                         LEFT JOIN grading_college_highest as act13 ON grading_college_highest_ids.act_13_id = act13.g_c_h_id
                         LEFT JOIN grading_college_highest as act14 ON grading_college_highest_ids.act_14_id = act14.g_c_h_id
                         LEFT JOIN grading_college_highest as act15 ON grading_college_highest_ids.act_15_id = act15.g_c_h_id
                         WHERE grading_college_highest.school_year = :schoolYear AND grading_college_highest.quarter = :gradeQuarter AND grading_college_highest.grade_source = :gradeSource
                         AND grading_college_highest.subject_id = :subjectName AND grading_college_highest.current_sem = :currentSem");
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeQuarter', $gradeQuarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':subjectName', $subjectName);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return $row;
        }
    }

    public function updateCollegeGrade($jrGradeId, $activities)
    {
        $this->db->query("UPDATE grading_college SET act_1 = :act1, act_2 = :act2, act_3 = :act3, act_4 = :act4, act_5 = :act5,
                        act_6 = :act6, act_7 = :act7, act_8 = :act8, act_9 = :act9, act_10 = :act10, act_11 = :act11, act_12 = :act12,
                        act_13 = :act13, act_14 = :act14, act_15 = :act15 WHERE g_c_id = :jrGradeId");
        $this->db->bind(':jrGradeId', $jrGradeId);
        $this->db->bind(':act1', intval($activities['act1']));
        $this->db->bind(':act2', intval($activities['act2']));
        $this->db->bind(':act3', intval($activities['act3']));
        $this->db->bind(':act4', intval($activities['act4']));
        $this->db->bind(':act5', intval($activities['act5']));
        $this->db->bind(':act6', intval($activities['act6']));
        $this->db->bind(':act7', intval($activities['act7']));
        $this->db->bind(':act8', intval($activities['act8']));
        $this->db->bind(':act9', intval($activities['act9']));
        $this->db->bind(':act10', intval($activities['act10']));
        $this->db->bind(':act11', intval($activities['act11']));
        $this->db->bind(':act12', intval($activities['act12']));
        $this->db->bind(':act13', intval($activities['act13']));
        $this->db->bind(':act14', intval($activities['act14']));
        $this->db->bind(':act15', intval($activities['act15']));

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function loadCollegeGrade($subjectId, $currenSchoolYear, $gradeSource, $quarter, $currentSem)
    {
        $this->db->query("SELECT * FROM grading_college INNER JOIN col_subject_enrolled ON grading_college.enrollee_id = col_subject_enrolled.subject_enrolled_ID
                        INNER JOIN col_student ON col_subject_enrolled.si_ID = col_student.student_id 
                        WHERE subject_Id = :subjectId AND school_year = :currenSchoolYear AND quarter = :quarter And grade_source = :gradeSource AND sem_name = :currentSem ORDER BY col_student.lname ASC");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':currenSchoolYear', $currenSchoolYear);
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

    public function addCollegeHighGrade($subjectId, $quarter, $gradeSource, $actNo, $actName, $actScore, $schoolYear, $colId, $currentSem)
    {
        $this->db->query("INSERT INTO grading_college_highest (subject_id, quarter, grade_source, act_no, act_name, act_high_score, school_year, current_sem) VALUES (
                        :subjectId, :quarter, :gradeSource, :actNo, :actName, :actScore, :schoolYear, :currentSem)");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':actName', $actName);
        $this->db->bind(':actScore', intval($actScore['actJrHs']));
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);

        if ($this->db->execute()) {

            switch ($colId) {
                case 0:
                    $this->db->query("INSERT INTO grading_college_highest_ids (act_1_id) SELECT g_c_h_id FROM grading_college_highest WHERE subject_id = :subjectId AND quarter = :quarter AND
                    grade_source = :gradeSource AND school_year = :schoolYear AND act_no = :actNo");
                    $this->db->bind(':subjectId', $subjectId);
                    $this->db->bind(':quarter', $quarter);
                    $this->db->bind(':gradeSource', $gradeSource);
                    $this->db->bind(':schoolYear', $schoolYear);
                    $this->db->bind(':actNo', $actNo);

                    if ($this->db->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                    break;
                default:
                    $activityNo = 'act_' . $actNo . '_id';
                    $this->db->query("UPDATE grading_college_highest_ids SET $activityNo = (SELECT g_c_h_id FROM grading_college_highest WHERE subject_id = :subjectId AND quarter = :quarter AND
                    grade_source = :gradeSource AND school_year = :schoolYear AND act_no = :actNo AND current_sem = :currentSem) WHERE g_c_h_ids_id = :g_j_h_ids");
                    $this->db->bind(':subjectId', $subjectId);
                    $this->db->bind(':quarter', $quarter);
                    $this->db->bind(':gradeSource', $gradeSource);
                    $this->db->bind(':actNo', $actNo);
                    $this->db->bind(':schoolYear', $schoolYear);
                    // $this->db->bind(':activity', 'act_' . $actNo . '_id');
                    $this->db->bind(':g_j_h_ids',  $colId);
                    $this->db->bind(':currentSem', $currentSem);

                    if ($this->db->execute()) {
                        return true;
                    } else {
                        return false;
                    }
            }
        } else {
            return false;
        }
    }

    public function updateCollegeHighGrade($actScore, $gjh_id, $actName)
    {
        $this->db->query("UPDATE grading_college_highest SET act_high_score = :actHighSCore, act_name = :actName WHERE g_c_h_id = :gjh_id");
        $this->db->bind(':actHighSCore', intval($actScore['actJrHs']));
        $this->db->bind(':gjh_id', $gjh_id);
        $this->db->bind(':actName', $actName);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCollegeClassStandings($updateWsValue, $wsId)
    {
        $this->db->query("UPDATE grading_college_highest_ids SET act_ws = :updateWsValue WHERE g_c_h_ids_id = :wsId");
        $this->db->bind(':wsId', $wsId);
        $this->db->bind(':updateWsValue', intval($updateWsValue['newWs1']));

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //count college activity per class standing
    public function countCollegeActivity($subjectId, $quarter, $gradeSource, $currentSchoolYear, $currentSem)
    {
        $this->db->query("SELECT * FROM grading_college_highest WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :currentSchoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':currentSchoolYear', $currentSchoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //get college score summary
    //prelim attendance
    public function collegeGradeSummaryPAT($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'attendance';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryPATclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'attendance';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //prelim recitation
    public function collegeGradeSummaryPRE($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'recitation';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryPREclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'recitation';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //prelim quiz
    public function collegeGradeSummaryPQU($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'quiz';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryPQUclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'quiz';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //prelim project
    public function collegeGradeSummaryPPR($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'project';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryPPRclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'project';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //prelim assignment
    public function collegeGradeSummaryPAS($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'assignment';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryPASclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'assignment';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //prelim exam
    public function collegeGradeSummaryPEX($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'exam';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryPEXclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'prelim';
        $gradeSource = 'exam';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //midterm attendance
    public function collegeGradeSummaryMAT($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'midterm';
        $gradeSource = 'attendance';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryMATclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'midterm';
        $gradeSource = 'attendance';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //midterm recitation
    public function collegeGradeSummaryMRE($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'midterm';
        $gradeSource = 'recitation';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryMREclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'midterm';
        $gradeSource = 'recitation';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //midterm quiz
    public function collegeGradeSummaryMQU($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'midterm';
        $gradeSource = 'quiz';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryMQUclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'midterm';
        $gradeSource = 'quiz';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //midterm project
    public function collegeGradeSummaryMPR($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'midterm';
        $gradeSource = 'project';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryMPRclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'midterm';
        $gradeSource = 'project';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //midterm assignment
    public function collegeGradeSummaryMAS($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'midterm';
        $gradeSource = 'assignment';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryMASclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'midterm';
        $gradeSource = 'assignment';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //midterm exam
    public function collegeGradeSummaryMEX($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'midterm';
        $gradeSource = 'exam';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryMEXclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'midterm';
        $gradeSource = 'exam';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //semi-finals attendance
    public function collegeGradeSummarySAT($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'semi-finals';
        $gradeSource = 'attendance';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummarySATclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'semi-finals';
        $gradeSource = 'attendance';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //semi-finals recitation
    public function collegeGradeSummarySRE($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'semi-finals';
        $gradeSource = 'recitation';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummarySREclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'semi-finals';
        $gradeSource = 'recitation';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //semi-finals quiz
    public function collegeGradeSummarySQU($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'semi-finals';
        $gradeSource = 'quiz';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummarySQUclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'semi-finals';
        $gradeSource = 'quiz';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //semi-finals project
    public function collegeGradeSummarySPR($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'semi-finals';
        $gradeSource = 'project';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummarySPRclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'semi-finals';
        $gradeSource = 'project';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //semi-finals assignment
    public function collegeGradeSummarySAS($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'semi-finals';
        $gradeSource = 'assignment';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummarySASclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'semi-finals';
        $gradeSource = 'assignment';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //semi-finals exam
    public function collegeGradeSummarySEX($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'semi-finals';
        $gradeSource = 'exam';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummarySEXclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'semi-finals';
        $gradeSource = 'exam';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //finals attendance
    public function collegeGradeSummaryFAT($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'finals';
        $gradeSource = 'attendance';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryFATclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'finals';
        $gradeSource = 'attendance';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //finals recitation
    public function collegeGradeSummaryFRE($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'finals';
        $gradeSource = 'recitation';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryFREclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'finals';
        $gradeSource = 'recitation';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //finals quiz
    public function collegeGradeSummaryFQU($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'finals';
        $gradeSource = 'quiz';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryFQUclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'finals';
        $gradeSource = 'quiz';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //finals project
    public function collegeGradeSummaryFPR($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'finals';
        $gradeSource = 'project';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryFPRclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'finals';
        $gradeSource = 'project';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //finals assignment
    public function collegeGradeSummaryFAS($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'finals';
        $gradeSource = 'assignment';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryFASclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'finals';
        $gradeSource = 'assignment';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    //finals exam
    public function collegeGradeSummaryFEX($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'finals';
        $gradeSource = 'exam';
        $actNo = '1';

        $this->db->query("SELECT * FROM grading_college_highest INNER JOIN grading_college_highest_ids ON grading_college_highest.g_c_h_id =  grading_college_highest_ids.act_1_id
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND act_no = :actNo AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);
        $this->db->bind(':actNo', $actNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        return $row;
    }

    public function collegeGradeSummaryFEXclassStanding($subjectName, $schoolYear, $currentSem)
    {
        $quarter = 'finals';
        $gradeSource = 'exam';


        $this->db->query("SELECT * FROM grading_college_highest 
                        WHERE subject_id = :subjectId AND quarter = :quarter AND grade_source = :gradeSource AND school_year = :schoolYear AND current_sem = :currentSem");
        $this->db->bind(':subjectId', $subjectName);
        $this->db->bind(':quarter', $quarter);
        $this->db->bind(':gradeSource', $gradeSource);

        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentSem', $currentSem);
        $row = $this->db->resultSet();

        $actCount = $this->db->rowCount();

        return $actCount;
    }

    public function insertFinalGrade($programId, $studentId, $studentNo, $instructorId, $schedId, $subjectName, $subjectDescription, $subjectYearLevel, $studentCourse, $finalGrade, $gradeRemarks, $schoolYear, $currentTerm, $studentName, $insertedShowDateId)
    {
        $this->db->query("INSERT INTO grading_higher_final (program_id, student_id, student_no, instructor_id, sched_id, subject_name, subject_description, year_level, course, file_grade, grade_remarks, school_year, semester, show_date_id)
                    VALUES (:programId, :studentId, :studentNo, :instructorId, :schedId, :subjectName, :subjectDescription, :subjectYearLevel, :subjectCourse, :finalGrade, :gradeRemarks, :schoolYear, :currentTerm, :insertedShowDateId)");
        $this->db->bind(':programId', trim($programId));
        $this->db->bind(':studentId', trim($studentId));
        $this->db->bind(':studentNo', trim($studentNo));
        $this->db->bind(':instructorId', $instructorId);
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':subjectName', $subjectName);
        $this->db->bind(':subjectDescription', $subjectDescription);
        $this->db->bind(':subjectYearLevel', $subjectYearLevel);
        $this->db->bind(':subjectCourse', trim($studentCourse));
        $this->db->bind(':finalGrade', trim($finalGrade));
        $this->db->bind(':gradeRemarks', trim($gradeRemarks));
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':currentTerm', $currentTerm);
        $this->db->bind(':insertedShowDateId', $insertedShowDateId);

        $returnStudentReport = $studentName . '..... ' . trim($finalGrade) . '..... ' . trim($gradeRemarks);

        if ($this->db->execute()) {
            return $returnStudentReport;
        } else {
            return '';
        }
    }

    public function saveJuniorFinal($studentInfoId, $studentId, $instructorId, $subjectId, $subjectName, $subjectDes, $gradeLevel, $fig, $fqg, $showDate, $schoolYear, $studentName)
    {
        $this->db->query("INSERT INTO grading_junior_finals (student_info_id, student_id, instructor_id, subject_id, subject_name, subject_description, grade_level, fig, fqg, show_date, school_year)
                        VALUES(:studentInfoId, :studentId, :instructorId, :subjectId, :subjectName, :subjectDes, :gradeLevel, :fig, :fqg, :showDate, :schoolYear)");
        $this->db->bind(':studentInfoId', trim($studentInfoId));
        $this->db->bind(':studentId', trim($studentId));
        $this->db->bind(':instructorId', $instructorId);
        $this->db->bind(':subjectId', $subjectId);
        $this->db->bind(':subjectName', $subjectName);
        $this->db->bind(':subjectDes', $subjectDes);
        $this->db->bind(':gradeLevel', $gradeLevel);
        $this->db->bind(':fig', trim($fig));
        $this->db->bind(':fqg', trim($fqg));
        $this->db->bind(':showDate', trim($showDate));
        $this->db->bind(':schoolYear', $schoolYear);

        $returnStudentReport = $studentName . '..... ' . '1st' . '..... ' . trim($fqg);

        if ($this->db->execute()) {
            return $returnStudentReport;
        } else {
            return '';
        }
    }

    //check if sched exist in finals
    public function getStepSubmitGrades($schedId, $schoolYear)
    {
        $this->db->query("SELECT * FROM grading_junior_finals WHERE subject_id = :schedId AND school_year = :schoolYear LIMIT 1");
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            foreach ($row as $rows) {
                if ($rows->fqg != 0 && $rows->sqg == 0 && $rows->tqg == 0 && $rows->foqg == 0) {
                    return 'submit2';
                } elseif ($rows->fqg != 0 && $rows->sqg != 0 && $rows->tqg == 0 && $rows->foqg == 0) {
                    return 'submit3';
                } elseif ($rows->fqg != 0 && $rows->sqg != 0 && $rows->tqg != 0 && $rows->foqg == 0) {
                    return 'submit4';
                } elseif ($rows->fqg != 0 && $rows->sqg != 0 && $rows->tqg != 0 && $rows->foqg != 0) {
                    return '';
                }
            }
        } else {
            return 'submit1';
        }
    }

    public function updateSecJuniorFinal($studentInfoId, $studentId, $subjectId, $fig, $fqg, $schoolYear, $studentName)
    {
        $this->db->query("UPDATE grading_junior_finals SET sig = :fig, sqg = :fqg WHERE student_info_id = :studentInfoId AND student_id = :studentId AND subject_id = :subjectId AND school_year = :schoolYear");
        $this->db->bind(':studentInfoId', trim($studentInfoId));
        $this->db->bind(':studentId', trim($studentId));

        $this->db->bind(':subjectId', $subjectId);

        $this->db->bind(':fig', trim($fig));
        $this->db->bind(':fqg', trim($fqg));

        $this->db->bind(':schoolYear', $schoolYear);

        $returnStudentReport = $studentName . '..... ' . '2nd' . '..... ' . trim($fqg);

        if ($this->db->execute()) {
            return $returnStudentReport;
        } else {
            return '';
        }
    }

    public function updateThiJuniorFinal($studentInfoId, $studentId, $subjectId, $fig, $fqg, $schoolYear, $studentName)
    {
        $this->db->query("UPDATE grading_junior_finals SET tig = :fig, tqg = :fqg WHERE student_info_id = :studentInfoId AND student_id = :studentId AND subject_id = :subjectId AND school_year = :schoolYear");
        $this->db->bind(':studentInfoId', trim($studentInfoId));
        $this->db->bind(':studentId', trim($studentId));

        $this->db->bind(':subjectId', $subjectId);

        $this->db->bind(':fig', trim($fig));
        $this->db->bind(':fqg', trim($fqg));

        $this->db->bind(':schoolYear', $schoolYear);

        $returnStudentReport = $studentName . '..... ' . '3rd' . '..... ' . trim($fqg);

        if ($this->db->execute()) {
            return $returnStudentReport;
        } else {
            return '';
        }
    }

    public function updateFouJuniorFinal($studentInfoId, $studentId, $subjectId, $fig, $fqg, $finalGrade, $gradeRemarks, $schoolYear, $studentName)
    {
        $this->db->query("UPDATE grading_junior_finals SET foig = :fig, foqg = :fqg, final_grade = :finalGrade, grade_remarks = :gradeRemarks WHERE student_info_id = :studentInfoId AND student_id = :studentId AND subject_id = :subjectId AND school_year = :schoolYear");
        $this->db->bind(':studentInfoId', trim($studentInfoId));
        $this->db->bind(':studentId', trim($studentId));

        $this->db->bind(':subjectId', $subjectId);

        $this->db->bind(':fig', trim($fig));
        $this->db->bind(':fqg', trim($fqg));
        $this->db->bind(':finalGrade', trim($finalGrade));
        $this->db->bind(':gradeRemarks', trim($gradeRemarks));
        $this->db->bind(':schoolYear', $schoolYear);

        $returnStudentReport = $studentName . '..... ' . '4th' . '..... ' . trim($fqg);

        if ($this->db->execute()) {
            return $returnStudentReport;
        } else {
            return '';
        }
    }

    //get submitted grades
    public function loadJuniorGrades($studentId, $schoolYear)
    {
        $this->db->query("SELECT *,grading_junior_schedule_showing.show_date as viewDate FROM grading_junior_finals INNER JOIN grading_junior_schedule_showing ON grading_junior_finals.show_date = grading_junior_schedule_showing.id WHERE student_id = :studentId AND grading_junior_finals.school_year = :schoolYear");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        return $row;
    }

    public function countJuniorGrades($studentId, $schoolYear)
    {
        $this->db->query("SELECT *,grading_junior_schedule_showing.show_date as viewDate FROM grading_junior_finals INNER JOIN grading_junior_schedule_showing ON grading_junior_finals.show_date = grading_junior_schedule_showing.id WHERE student_id = :studentId AND grading_junior_finals.school_year = :schoolYear");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        $rowCount = $this->db->rowCount();

        if ($this->db->rowCount() > 0) {
            return $rowCount;
        } else {
            return 0;
        }
    }

    public function saveSeniorFinal($studentId, $studentNo, $instructorId, $schedId, $subjectName, $subjectDescription, $subjectTerm, $subjectYearLevel, $firstIg, $firstQuarter, $insertedDateId, $schoolYear, $studentName, $gradeQuarter)
    {
        $this->db->query("INSERT INTO grading_senior_finals (student_id, student_no, instructor_id, subject_id, subject_name, subject_description, subject_term, year_level, fig, fqg, show_date_id, school_year)
                        VALUES (:studentId, :studentNo, :instructorId, :schedId, :subjectName, :subjectDescription, :subjectTerm, :subjectYearLevel, :firstIg, :firstQuarter, :insertedDateId, :schoolYear)");
        $this->db->bind(':studentId', trim($studentId));
        $this->db->bind(':studentNo', trim($studentNo));
        $this->db->bind(':instructorId', $instructorId);
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':subjectName', $subjectName);
        $this->db->bind(':subjectDescription', $subjectDescription);
        $this->db->bind(':subjectTerm', $subjectTerm);
        $this->db->bind(':subjectYearLevel', $subjectYearLevel);
        $this->db->bind(':firstIg', trim($firstIg));
        $this->db->bind(':firstQuarter', trim($firstQuarter));
        $this->db->bind(':insertedDateId', $insertedDateId);
        $this->db->bind(':schoolYear', $schoolYear);

        $returnStudentReport = $studentName . '..... ' . $gradeQuarter . '..... ' . trim($firstQuarter);

        if ($this->db->execute()) {
            return $returnStudentReport;
        } else {
            return '';
        }
    }

    public function getStepSubmitGradesSr1($schedId, $schoolYear)
    {
        $this->db->query("SELECT * FROM grading_senior_finals WHERE subject_id = :schedId AND school_year = :schoolYear LIMIT 1");
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            foreach ($row as $rows) {
                if ($rows->fqg != 0 && $rows->sqg == 0) {
                    return 'submit2';
                } elseif ($rows->fqg != 0 && $rows->sqg != 0) {
                    return '';
                }
            }
        } else {
            return 'submit1';
        }
    }

    public function updateSeniorFinal($studentId, $studentNo, $schedId, $secondIg, $secondQuarter, $finalGrade, $gradeRemarks, $schoolYear, $studentName, $gradeQuarter)
    {
        $this->db->query("UPDATE grading_senior_finals SET sig = :secondIg, sqg = :secondQuarter, final_grade = :finalGrade, grade_remarks = :gradeRemarks
                        WHERE student_id = :studentId AND student_no = :studentNo AND subject_id = :schedId AND school_year = :schoolYear");
        $this->db->bind(':secondIg', trim($secondIg));
        $this->db->bind(':secondQuarter', trim($secondQuarter));
        $this->db->bind(':finalGrade', trim($finalGrade));
        $this->db->bind(':gradeRemarks', trim($gradeRemarks));
        $this->db->bind(':studentId', trim($studentId));
        $this->db->bind(':studentNo', trim($studentNo));
        $this->db->bind(':schedId', $schedId);
        $this->db->bind(':schoolYear', $schoolYear);

        $returnStudentReport = $studentName . '..... ' . $gradeQuarter . '..... ' . trim($secondQuarter);

        if ($this->db->execute()) {
            return $returnStudentReport;
        } else {
            return '';
        }
    }

    public function loadSeniorGrades1($studentId, $schoolYear)
    {
        $this->db->query("SELECT *,grading_senior_schedule_showing.show_date as viewDate FROM grading_senior_finals INNER JOIN grading_senior_schedule_showing ON grading_senior_finals.show_date_id = grading_senior_schedule_showing.id 
                        WHERE student_no = :studentId AND grading_senior_finals.school_year = :schoolYear AND subject_term = 1");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        return $row;
    }

    public function countSeniorGrades1($studentId, $schoolYear)
    {
        $this->db->query("SELECT *,grading_senior_schedule_showing.show_date as viewDate FROM grading_senior_finals INNER JOIN grading_senior_schedule_showing ON grading_senior_finals.show_date_id = grading_senior_schedule_showing.id 
                        WHERE student_no = :studentId AND grading_senior_finals.school_year = :schoolYear AND subject_term = 1");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        $rowCount = $this->db->rowCount();

        if ($this->db->rowCount() > 0) {
            return $rowCount;
        } else {
            return 0;
        }
    }

    public function loadSeniorGrades2($studentId, $schoolYear)
    {
        $this->db->query("SELECT *,grading_senior_schedule_showing.show_date as viewDate FROM grading_senior_finals INNER JOIN grading_senior_schedule_showing ON grading_senior_finals.show_date_id = grading_senior_schedule_showing.id 
                        WHERE student_no = :studentId AND grading_senior_finals.school_year = :schoolYear AND subject_term = 2");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        return $row;
    }

    public function countSeniorGrades2($studentId, $schoolYear)
    {
        $this->db->query("SELECT *,grading_senior_schedule_showing.show_date as viewDate FROM grading_senior_finals INNER JOIN grading_senior_schedule_showing ON grading_senior_finals.show_date_id = grading_senior_schedule_showing.id 
                        WHERE student_no = :studentId AND grading_senior_finals.school_year = :schoolYear AND subject_term = 2");
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':schoolYear', $schoolYear);

        $row = $this->db->resultSet();

        $rowCount = $this->db->rowCount();

        if ($this->db->rowCount() > 0) {
            return $rowCount;
        } else {
            return 0;
        }
    }

    public function collegeClassCard($studentNo, $schoolYear, $sem)
    {
        $this->db->query("SELECT *,grading_college_schedule_showing.show_date as viewDate, grading_higher_final.school_year as schoolYear FROM grading_higher_final INNER JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        LEFT JOIN instructors ON grading_higher_final.instructor_id = instructors.id
                        WHERE student_no = :studentNo AND grading_higher_final.school_year = :schoolYear AND grading_higher_final.semester = :sem AND grading_higher_final.school_id = 1");
        $this->db->bind(':studentNo', $studentNo);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':sem', $sem);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function collegeClassCardAll($studentNo, $schoolYear, $sem)
    {
        $combineSchoolSem = $schoolYear . $sem;
        $this->db->query("SELECT *,grading_college_schedule_showing.show_date as viewDate, grading_higher_final.school_year as schoolYear FROM grading_higher_final INNER JOIN grading_college_schedule_showing ON grading_higher_final.show_date_id = grading_college_schedule_showing.id
                        LEFT JOIN instructors ON grading_higher_final.instructor_id = instructors.id
                        WHERE student_no = :studentNo AND CONCAT(grading_higher_final.school_year, grading_higher_final.semester) != :combineSchoolSem AND grading_higher_final.school_id = 1");
        $this->db->bind(':studentNo', $studentNo);
        $this->db->bind(':combineSchoolSem', $combineSchoolSem);



        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function insertKinderRecord($infoId, $studentId, $extractSubject1, $extractSubject2, $level, $gradesfq, $gradessq, $gradestq, $gradesfoq, $gradesfa, $schoolYear, $schoolName)
    {
        $this->db->query("INSERT INTO grading_junior_finals (student_info_id, student_id, instructor_id, subject_id, subject_name, subject_description, grade_level, fig, fqg, sig, sqg, tig, tqg, foig, foqg, final_grade, grade_remarks, show_date, school_year, school)
                    VALUES(:infoId, :studentId, 0, 0, :extractSubject1, :extractSubject2, :level, 0, :gradesfq, 0, :gradessq, 0, :gradestq, 0, :gradesfoq, :gradesfa, '', 0, :schoolYear, :schoolName)");
        $this->db->bind(':infoId', $infoId);
        $this->db->bind(':studentId', $studentId);
        $this->db->bind(':extractSubject1', $extractSubject1);
        $this->db->bind(':extractSubject2', $extractSubject2);
        $this->db->bind(':level', $level);
        $this->db->bind(':gradesfq', $gradesfq);
        $this->db->bind(':gradessq', $gradessq);
        $this->db->bind(':gradestq', $gradestq);
        $this->db->bind(':gradesfoq', $gradesfoq);
        $this->db->bind(':gradesfa', $gradesfa);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':schoolName', $schoolName);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getJuniorGradeSummaryAll($infoId)
    {
        $this->db->query("SELECT *,grading_junior_finals.id as recId FROM grading_junior_finals INNER JOIN grading_junior_school ON grading_junior_finals.school = grading_junior_school.id WHERE student_id = :studentId ORDER BY grading_junior_finals.school_year");
        $this->db->bind(':studentId', $infoId);


        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function insertJuniorDatas($infoId, $studentNo, $subject, $des, $gradeLevel, $firstQ, $secondQ, $thirdQ, $fourthQ, $final, $remarks, $schoolYear, $saveSchoolNAme)
    {
        $this->db->query("INSERT INTO grading_junior_finals (student_info_id, student_id, instructor_id, subject_id, subject_name, subject_description, grade_level, fig, fqg, sig, sqg, tig, tqg, foig, foqg, final_grade, grade_remarks, show_date, school_year, school)
        VALUES(:infoId, :studentNo, 0, 0, :subject, :des, :gradeLevel, 0, :firstQ, 0, :secondQ, 0, :thirdQ, 0, :fourthQ, :final, :remarks, 0, :schoolYear, :saveSchoolNAme)");
        $this->db->bind(':infoId', $infoId);
        $this->db->bind(':studentNo', $studentNo);
        $this->db->bind(':subject', $subject);
        $this->db->bind(':des', $des);
        $this->db->bind(':gradeLevel', $gradeLevel);
        $this->db->bind(':firstQ', $firstQ);
        $this->db->bind(':secondQ', $secondQ);
        $this->db->bind(':thirdQ', $thirdQ);
        $this->db->bind(':fourthQ', $fourthQ);
        $this->db->bind(':final', $final);
        $this->db->bind(':remarks', $remarks);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':saveSchoolNAme', $saveSchoolNAme);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getJuniorFinalHistory($id, $schoolYear)
    {
        $this->db->query("SELECT * FROM grading_junior_finals INNER JOIN student_info ON grading_junior_finals.student_info_id = student_info.id
                        WHERE grading_junior_finals.subject_id = :id AND grading_junior_finals.school_year = :schoolYear ORDER BY student_info.last_name ASC");
        $this->db->bind(':id', $id);
        $this->db->bind(':schoolYear', $schoolYear);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getJuniorFinalHistoryC($id, $schoolYear)
    {
        $this->db->query("SELECT DISTINCT subject_id, school_year, grade_level, subject_name FROM grading_junior_finals 
                        WHERE subject_id = :id AND school_year = :schoolYear");
        $this->db->bind(':id', $id);
        $this->db->bind(':schoolYear', $schoolYear);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorFinalHistory($id, $sem, $schoolYear)
    {
        $this->db->query("SELECT * FROM grading_senior_finals INNER JOIN col_student ON grading_senior_finals.student_id = col_student.id
                        WHERE grading_senior_finals.subject_id = :id AND grading_senior_finals.subject_term = :sem AND grading_senior_finals.school_year = :schoolYear
                        ORDER BY col_student.lname ASC");
        $this->db->bind(':id', $id);
        $this->db->bind(':sem', $sem);
        $this->db->bind(':schoolYear', $schoolYear);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getSeniorFinalHistoryC($id, $sem, $schoolYear)
    {
        $this->db->query("SELECT DISTINCT subject_id, subject_name, subject_description, year_level FROM grading_senior_finals
                        WHERE grading_senior_finals.subject_id = :id AND grading_senior_finals.subject_term = :sem AND grading_senior_finals.school_year = :schoolYear");
        $this->db->bind(':id', $id);
        $this->db->bind(':sem', $sem);
        $this->db->bind(':schoolYear', $schoolYear);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getHighFinalHistory($id, $sem, $schoolYear)
    {
        $this->db->query("SELECT *,grading_higher_final.id as gId FROM grading_higher_final INNER JOIN col_student ON grading_higher_final.student_id = col_student.id
                        WHERE grading_higher_final.sched_id = :id AND grading_higher_final.semester = :sem AND grading_higher_final.school_year = :schoolYear
                        ORDER BY col_student.lname ASC");
        $this->db->bind(':id', $id);
        $this->db->bind(':sem', $sem);
        $this->db->bind(':schoolYear', $schoolYear);
        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getHighFinalHistoryC($id, $sem, $schoolYear)
    {
        $this->db->query("SELECT DISTINCT sched_id, subject_name, subject_description, year_level FROM grading_higher_final
                        WHERE grading_higher_final.sched_id = :id AND grading_higher_final.semester = :sem AND grading_higher_final.school_year = :schoolYear");
        $this->db->bind(':id', $id);
        $this->db->bind(':sem', $sem);
        $this->db->bind(':schoolYear', $schoolYear);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function updateMultyJuniorRecord($recId, $subject, $first, $second, $third, $fourth, $final, $schoolYear, $gradeLevel)
    {
        $this->db->query("UPDATE grading_junior_finals SET subject_name = :subject, fqg = :first, sqg = :second, tqg = :third, foqg = :fourth,
                        final_grade = :final, school_year = :schoolYear, grade_level = :gradeLevel WHERE id = :recId");
        $this->db->bind(':subject', $subject);
        $this->db->bind(':first', intval($first));
        $this->db->bind(':second', intval($second));
        $this->db->bind(':third', intval($third));
        $this->db->bind(':fourth', intval($fourth));
        $this->db->bind(':final', intval($final));
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':gradeLevel', $gradeLevel);
        $this->db->bind(':recId', $recId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteJuniorMultyRecords($recId)
    {
        $this->db->query("DELETE FROM grading_junior_finals WHERE id = :recId");
        $this->db->bind(':recId', $recId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertSeniorDatas($infoId, $studentNo,  $subjectCode,  $subjectName, $sem, $gradeLevel, $firstQ, $secondQ, $final, $remarks, $schoolYear, $saveSchoolNAme)
    {
        $this->db->query("INSERT INTO grading_senior_finals (student_id, student_no, instructor_id, subject_id, subject_name, subject_description, subject_term, year_level, fig, fqg, sig, sqg, final_grade, grade_remarks, show_date_id, school_year, school_id)
        VALUES(:infoId, :studentNo, 0, 0, :subjectCode, :subjectName, :sem, :gradeLevel, 0, :firstQ, 0, :secondQ, :final, :remarks, 0, :schoolYear, :saveSchoolNAme)");
        $this->db->bind(':infoId', $infoId);
        $this->db->bind(':studentNo', $studentNo);
        $this->db->bind(':subjectCode', $subjectCode);
        $this->db->bind(':subjectName', $subjectName);
        $this->db->bind(':sem', $sem);
        $this->db->bind(':gradeLevel', $gradeLevel);
        $this->db->bind(':firstQ', $firstQ);
        $this->db->bind(':secondQ', $secondQ);
        $this->db->bind(':final', $final);
        $this->db->bind(':remarks', $remarks);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':saveSchoolNAme', $saveSchoolNAme);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSeniorGradeRecordsAll($recId, $SubjectCode, $newSubject, $sem, $gradeLevel, $first, $second, $final, $schoolYear)
    {
        $this->db->query("UPDATE grading_senior_finals SET subject_name = :SubjectCode, subject_description = :newSubject, subject_term = :sem, year_level = :gradeLevel,
                        fqg = :first, sqg = :second, final_grade = :final, school_year = :schoolYear WHERE id = :recId");
        $this->db->bind(':SubjectCode', $SubjectCode);
        $this->db->bind(':newSubject', $newSubject);
        $this->db->bind(':sem', $sem);
        $this->db->bind(':gradeLevel', $gradeLevel);
        $this->db->bind(':first', $first);
        $this->db->bind(':second', $second);
        $this->db->bind(':final', $final);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':recId', $recId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSeniorGradeRecordsAll($recId)
    {
        $this->db->query("DELETE FROM grading_senior_finals WHERE id = :recId");
        $this->db->bind(':recId', $recId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllGradesTorS($studentId)
    {
        $this->db->query("SELECT DISTINCT student_no, semester, school_year, grading_college_school.school_name, grading_higher_final.school_id FROM grading_higher_final 
                        INNER JOIN grading_college_school ON grading_higher_final.school_id = grading_college_school.id
                        WHERE student_no = :studentId ORDER BY school_year ASC, semester ASC");
        $this->db->bind(':studentId', $studentId);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAllGradesTor($studentId)
    {
        $this->db->query("SELECT *,grading_higher_final.semester as sem FROM grading_higher_final 
                        INNER JOIN grading_higher_subjects ON grading_higher_final.subject_name = grading_higher_subjects.subject_code AND grading_higher_final.program_id = grading_higher_subjects.program_id
                        WHERE student_no = :studentId ORDER BY school_year DESC");
        $this->db->bind(':studentId', $studentId);

        $row = $this->db->resultSet();

        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function editGradingHigherFinalGrade($studentFinalList, $grade)
    {
        $this->db->query("UPDATE grading_higher_final SET completed = :grade WHERE id = :studentFinalList");
        $this->db->bind(':grade', $grade);
        $this->db->bind(':studentFinalList', $studentFinalList);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insertHigherDatas($programId, $infoId, $studentNo,  $subjectName,  $subjectDescription, $sem, $course, $final, $remarks, $schoolYear, $saveSchoolNAme, $reexam)
    {
        $this->db->query("INSERT INTO grading_higher_final (program_id, student_id, student_no, instructor_id, sched_id, subject_name, subject_description, year_level, course, file_grade, grade_remarks, school_year, semester, show_date_id, school_id, completed)
                        VALUES(:programId, :infoId, :studentNo, 0, 0, :subjectName, :subjectDescription, 0, :course, :final, :remarks, :schoolYear, :sem, 0, :saveSchoolNAme, :reexam)");
        $this->db->bind(':programId', $programId);
        $this->db->bind(':infoId', $infoId);
        $this->db->bind(':studentNo', $studentNo);
        $this->db->bind(':subjectName', $subjectName);
        $this->db->bind(':subjectDescription', $subjectDescription);
        $this->db->bind(':course', $course);
        $this->db->bind(':final', $final);
        $this->db->bind(':remarks', $remarks);
        $this->db->bind(':schoolYear', $schoolYear);
        $this->db->bind(':sem', $sem);
        $this->db->bind(':saveSchoolNAme', $saveSchoolNAme);
        $this->db->bind(':reexam', $reexam);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteHigherGradeTransfer($recId)
    {
        $this->db->query("DELETE FROM grading_higher_final WHERE id = :recId");
        $this->db->bind(':recId', $recId);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
