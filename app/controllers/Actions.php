<?php

class Actions extends Controller
{

    public function __construct()
    {
        $this->studentModel = $this->model('Student');
        $this->gradeModel = $this->model('Grade');
        $this->subjectsModel = $this->model('Subject');
        $this->schoolModel = $this->model('School');
        $this->userModel = $this->model('User');
        $this->postModel = $this->model('Post');
    }


    public function insertData()
    {

        if (isset($_POST['enrolleId'])) {

            $enrolleeID = $_POST['enrolleId'];
            $subjectID = $_POST['subjectId'];
            $instructorId = $_SESSION['id'];
            $currenSchoolYear = $_SESSION['school_year'];

            $insertStudent = $this->studentModel->addStudentRecords($enrolleeID, $subjectID, $instructorId, $currenSchoolYear);

            if ($insertStudent) {
                flash('add_student_record_success', 'Student is added to your class record');
                echo 'Student is added to your class record';
            } else {
                echo 'Failed to add student on your class record';
            }
        }
    }

    //put Sr to class record
    public function insertDataSr()
    {
        $enrolleeID = $_POST['enrolleId'];
        $subjectID = $_POST['subjectId'];
        $instructorId = $_SESSION['id'];
        $currenSchoolYear = $_SESSION['sem_name'];

        $insertStudentSr = $this->studentModel->addSrStudentRecords($enrolleeID, $subjectID, $instructorId, $currenSchoolYear);

        if ($insertStudentSr) {
            flash('add_student_record_success', 'Student is added to your class record');
            echo 'Student is added to your class record';
        } else {
            echo 'Failed to add student on your class record';
        }
    }

    public function insertDataSr2()
    {
        $enrolleeID = $_POST['enrolleId'];
        $subjectID = $_POST['subjectId'];
        $instructorId = $_SESSION['id'];
        $currenSchoolYear = $_SESSION['sem_name'];

        $insertStudentSr = $this->studentModel->addSrStudentRecords2($enrolleeID, $subjectID, $instructorId, $currenSchoolYear);

        if ($insertStudentSr) {
            flash('add_student_record_success', 'Student is added to your class record');
            echo 'Student is added to your class record';
        } else {
            echo 'Failed to add student on your class record';
        }
    }

    public function loadGradesJr()
    {
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_SESSION['school_year'];
        $subjectID = $_POST['subjectId'];

        $this->loadJrStudentsData($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter);
    }

    public function updateJrGradeTable()
    {
        $jrGradeId = $_POST['jrGradeId'];
        $activities = $_POST['activities'];
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_SESSION['school_year'];
        $subjectIds = $_POST['subjectIds'];

        $updateJrGrade = $this->gradeModel->updateJrGrade($jrGradeId, $activities);

        if ($updateJrGrade) {

            $this->loadJrStudentsData($subjectIds, $currenSchoolYear, $gradeSource, $gradeQuarter);
        } else {
            echo 'Failed to update grade';
        }
    }

    public function removeJrStudent()
    {
        $subjectIds = $_POST['subjectIds'];
        $jrGradeId = $_POST['jrGradeId'];
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_SESSION['school_year'];

        $removeJrStudentToClassRecord = $this->studentModel->removeJrStudent($jrGradeId, $subjectIds);

        if ($removeJrStudentToClassRecord) {

            $this->loadJrStudentsData($subjectIds, $currenSchoolYear, $gradeSource, $gradeQuarter);
        } else {
            echo 'Failed to remove from class record';
        }
    }

    public function addJrHighGrade()
    {
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currentSubjectId = $_POST['currentSubjectId'];
        $jrHs = $_POST['jrHs'];
        $currenSchoolYear = $_SESSION['school_year'];
        $actTrigger = $_POST['actTrigger'];
        $actName = $_POST['actName'];
        $actJrHsNo = $_POST['actJrHsNo'];
        $colId = $_POST['colId'];
        $perId = $_POST['perId'];

        switch ($actTrigger) {
            case 'add':
                $addJrHighSCore = $this->gradeModel->addJrHighGrade($currentSubjectId,  $gradeQuarter, $gradeSource, $actJrHsNo, $actName, $jrHs, $currenSchoolYear, $colId);

                if ($addJrHighSCore) {

                    $this->loadJrStudentsData($currentSubjectId, $currenSchoolYear, $gradeSource, $gradeQuarter);
                }

                break;
            case 'update':

                $updateJrHighScore = $this->gradeModel->updateJrHighGrade($jrHs, $perId, $actName);

                if ($updateJrHighScore) {

                    $this->loadJrStudentsData($currentSubjectId, $currenSchoolYear, $gradeSource, $gradeQuarter);
                }
                break;
        }
    }

    public function updateJrWs()
    {
        $newWs = $_POST['newWs'];
        $wsId = $_POST['wsId'];

        $updated_Ws = $this->gradeModel->updateJrWs($newWs, $wsId);

        if ($updated_Ws) {
            echo 'WS updated successfully';
        } else {
            echo 'WS failed to update';
        }
    }


    public function loadJrStudentsData($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter)
    {
        $gradeSet = $this->gradeModel->loadJrGrade($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter);

        $jrHighScore = $this->gradeModel->getJrHighSCore($subjectID, $gradeSource, $gradeQuarter, $currenSchoolYear);
        $dataId = 0;
        $actTotalJr = 0;
        $ps = 100;
        $wsNew = 0;
        $checkIfschedExistInFinal = $this->subjectsModel->checkIfschedExistInFinal($subjectID, $_SESSION['school_year']);
        $cheks = '';
        if ($checkIfschedExistInFinal === true) {
            $cheks = 'disabled';
        }


        if (!empty($gradeSet)) {
            $output1 = '
                        <table class="tablesgrade" id="jrTable">
                            <thead>
                                <tr>
                                    <th>Students Name</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>
                                    <th>14</th>
                                    <th>15</th>
                                    <th>Total</th>
                                    <th>PS</th>
                                    <th>WS</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="gradesHigh">
                                        <strong>Highest Posible Grade</strong>
                                    </td>
                                    <td class="jhs" data-row="1" data-column="1" data-id="';
            echo $output1;
            echo 0;
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act1Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act1Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act1 . '</strong>';
            }
            echo '</td>
                  <td data-bs-toggle="tooltip" data-bs-placement="top" title="Behavior" class="jhs" data-row="1" data-column="2" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act2Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act2Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act2 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="3" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act3Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act3Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act3 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="4" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act4Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act4Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act4 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="5" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act5Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act5Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act5 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="6" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act6Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act6Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act6 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="7" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act7Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act7Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act7 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="8" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act8Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act8Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act8 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="9" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act9Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act9Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act9 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="10" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act10Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act10Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act10 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="11" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act11Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act11Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act11 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="12" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act12Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act12Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act12 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="13" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act13Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act13Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act13 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="14" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act14Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act14Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act14 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="15" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act15Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act15Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act15 . '</strong>';
            }
            echo '</td>
                  <td>
                  <strong>';
            foreach ($jrHighScore as $jrScore) {
                $actTotalJr = $jrScore->act1 + $jrScore->act2 + $jrScore->act3 + $jrScore->act4 + $jrScore->act5 +
                    $jrScore->act6 + $jrScore->act7 + $jrScore->act8 + $jrScore->act9 + $jrScore->act10 +
                    $jrScore->act11 + $jrScore->act12 + $jrScore->act13 + $jrScore->act14 + $jrScore->act15;
            }
            if (empty($actTotalJr)) {
                $actTotalJr = 0;
                echo $actTotalJr;
            } else {
                echo $actTotalJr;
            }
            echo '</strong>
                  </td>
                  <td><strong>';
            echo $ps . '.00';
            echo ' </strong>
                  </td>
                  <td class="jhsWs"';
            echo 'data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->actWs;
            }
            echo '"
            data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"><strong>';
            foreach ($jrHighScore as $jrScore) {
                $wsNew = $jrScore->actWs;
                echo $wsNew . '%';
            }
            echo '</strong>
                  </td>
                  <td>

                  </td>
                  </tr>';



            foreach ($gradeSet as $grades) {

                $output2 = '
                                       <tr>
                                       <td data-label="Last Name">
                                        ' . $grades->last_name . ', ' . $grades->first_name . ' ' . $grades->middle_name . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act1) ? 'true' : 'false') . '" data-label="1">
                                        ' . ($grades->act_1 === '0' ? '' : $grades->act_1) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act2) ? 'true' : 'false') . '" data-label="2">
                                        ' . ($grades->act_2 === '0' ? '' : $grades->act_2) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act3) ? 'true' : 'false') . '" data-label="3">
                                       ' . ($grades->act_3 === '0' ? '' : $grades->act_3) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act4) ? 'true' : 'false') . '" data-label="4">
                                       ' . ($grades->act_4 === '0' ? '' : $grades->act_4) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act5) ? 'true' : 'false') . '" data-label="5">
                                       ' . ($grades->act_5 === '0' ? '' : $grades->act_5) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act6) ? 'true' : 'false') . '" data-label="6">
                                       ' . ($grades->act_6 === '0' ? '' : $grades->act_6) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act7) ? 'true' : 'false') . '" data-label="7">
                                       ' . ($grades->act_7 === '0' ? '' : $grades->act_7) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act8) ? 'true' : 'false') . '" data-label="8">
                                       ' . ($grades->act_8 === '0' ? '' : $grades->act_8) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act9) ? 'true' : 'false') . '" data-label="9">
                                       ' . ($grades->act_9 === '0' ? '' : $grades->act_9) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act10) ? 'true' : 'false') . '" data-label="10">
                                       ' . ($grades->act_10 === '0' ? '' : $grades->act_10) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act11) ? 'true' : 'false') . '" data-label="11">
                                       ' . ($grades->act_11 === '0' ? '' : $grades->act_11) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act12) ? 'true' : 'false') . '" data-label="12">
                                       ' . ($grades->act_12 === '0' ? '' : $grades->act_12) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act13) ? 'true' : 'false') . '" data-label="13">
                                       ' . ($grades->act_13 === '0' ? '' : $grades->act_13) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act14) ? 'true' : 'false') . '" data-label="14">
                                       ' . ($grades->act_14 === '0' ? '' : $grades->act_14) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act15) ? 'true' : 'false') . '" data-label="15">
                                       ' . ($grades->act_15 === '0' ? '' : $grades->act_15) . '
                                       </td>
                                       <td data-label="Total">
                                        <strong>';
                $output3 = intval($grades->act_1) + intval($grades->act_2) + intval($grades->act_3) + intval($grades->act_4) + intval($grades->act_5) + intval($grades->act_6) + intval($grades->act_7) + intval($grades->act_8) +
                    intval($grades->act_9) + intval($grades->act_10) + intval($grades->act_11) + intval($grades->act_12) + intval($grades->act_13) + intval($grades->act_14) + intval($grades->act_15);

                $output5 = '</strong>
                                       </td>
                                       <td data-label="PS"><strong>
                                        ' . $output3 . '.00' . '</strong>
                                       </td>
                                       <td data-label="WS"><strong>';

                if ($output3 === 0 || $actTotalJr === 0) {
                    $output7 = 0;
                } else {
                    $jrWs = ($output3 / $actTotalJr) * $wsNew;
                    $jrWsRound = round($jrWs, 2);
                    $output7 = $jrWsRound;
                }
                $output6 = '</strong>
                                       </td>
                                       <td data-label="Action">
                                           <span><button class="btn btn-info mr-1 btnsave" href="" data-id="' . $grades->g_j_id . '" role="button"><i class="far fa-save"></i></button></button><button class="btn btn-danger btndelete" href="" data-id="' . $grades->enrollee_id . '" role="button"' . $cheks . '><i class="far fa-trash-alt"></i></button></span>
                                       </td>
                                   </tr>';
                echo $output2 . $output3 . $output5 . $output7 . $output6;
            }
            $output4 = '
                            </tbody>
                        </table>     
                    </div>';
            echo $output4;
        }
    }

    //senior
    public function loadGradesSr()
    {
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_SESSION['sem_name'];
        $subjectID = $_POST['subjectId'];

        $this->loadSrStudentsData($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter);
    }

    public function loadSrStudentsData($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter)
    {
        $gradeSet = $this->gradeModel->loadSrGrade($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter);

        $jrHighScore = $this->gradeModel->getSrHighSCore($subjectID, $gradeSource, $gradeQuarter, $currenSchoolYear);
        $dataId = 0;
        $actTotalJr = 0;
        $ps = 100;
        $wsNew = 0;
        $checkIfSeniorSubjectExist = $this->subjectsModel->checkIfSeniorSubjectExist($subjectID, $_SESSION['sem_name']);
        $checkTrue = '';
        if ($checkIfSeniorSubjectExist === true) {
            $checkTrue = 'disabled';
        }
        if (!empty($gradeSet)) {
            $output1 = '
                        <table class="tablesgrade" id="jrTable">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>
                                    <th>14</th>
                                    <th>15</th>
                                    <th>Total</th>
                                    <th>PS</th>
                                    <th>WS</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="gradesHigh">
                                        <strong>Highest Posible Grade</strong>
                                    </td>
                                    <td class="shs" data-row="1" data-column="1" data-id="';
            echo $output1;
            echo 0;
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act1Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act1Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act1 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="2" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act2Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act2Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act2 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="3" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act3Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act3Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act3 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="4" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act4Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act4Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act4 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="5" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act5Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act5Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act5 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="6" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act6Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act6Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act6 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="7" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act7Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act7Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act7 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="8" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act8Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act8Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act8 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="9" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act9Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act9Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act9 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="10" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act10Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act10Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act10 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="11" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act11Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act11Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act11 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="12" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act12Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act12Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act12 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="13" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act13Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act13Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act13 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="14" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act14Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act14Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act14 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="15" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act15Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act15Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act15 . '</strong>';
            }
            echo '</td>
                  <td>
                  <strong>';
            foreach ($jrHighScore as $jrScore) {
                $actTotalJr = $jrScore->act1 + $jrScore->act2 + $jrScore->act3 + $jrScore->act4 + $jrScore->act5 +
                    $jrScore->act6 + $jrScore->act7 + $jrScore->act8 + $jrScore->act9 + $jrScore->act10 +
                    $jrScore->act11 + $jrScore->act12 + $jrScore->act13 + $jrScore->act14 + $jrScore->act15;
            }
            if (empty($actTotalJr)) {
                $actTotalJr = 0;
                echo $actTotalJr;
            } else {
                echo $actTotalJr;
            }
            echo '</strong>
                  </td>
                  <td><strong>';
            echo $ps . '.00';
            echo ' </strong>
                  </td>
                  <td class="shsWs"';
            echo 'data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->actWs;
            }
            echo '"
            data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"><strong>';
            foreach ($jrHighScore as $jrScore) {
                $wsNew = $jrScore->actWs;
                echo $wsNew . '%';
            }
            echo '</strong>
                  </td>
                  <td>

                  </td>
                  </tr>';



            foreach ($gradeSet as $grades) {

                $output2 = '
                                       <tr>
                                       <td data-label="Last Name">
                                        ' . $grades->lname . ', ' . $grades->fname . ' ' . $grades->mname . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act1) ? 'true' : 'false') . '" data-label="1">
                                        ' . ($grades->act_1 === '0' ? '' : $grades->act_1) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act2) ? 'true' : 'false') . '" data-label="2">
                                        ' . ($grades->act_2 === '0' ? '' : $grades->act_2) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act3) ? 'true' : 'false') . '" data-label="3">
                                       ' . ($grades->act_3 === '0' ? '' : $grades->act_3) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act4) ? 'true' : 'false') . '" data-label="4">
                                       ' . ($grades->act_4 === '0' ? '' : $grades->act_4) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act5) ? 'true' : 'false') . '" data-label="5">
                                       ' . ($grades->act_5 === '0' ? '' : $grades->act_5) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act6) ? 'true' : 'false') . '" data-label="6">
                                       ' . ($grades->act_6 === '0' ? '' : $grades->act_6) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act7) ? 'true' : 'false') . '" data-label="7">
                                       ' . ($grades->act_7 === '0' ? '' : $grades->act_7) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act8) ? 'true' : 'false') . '" data-label="8">
                                       ' . ($grades->act_8 === '0' ? '' : $grades->act_8) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act9) ? 'true' : 'false') . '" data-label="9">
                                       ' . ($grades->act_9 === '0' ? '' : $grades->act_9) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act10) ? 'true' : 'false') . '" data-label="10">
                                       ' . ($grades->act_10 === '0' ? '' : $grades->act_10) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act11) ? 'true' : 'false') . '" data-label="11">
                                       ' . ($grades->act_11 === '0' ? '' : $grades->act_11) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act12) ? 'true' : 'false') . '" data-label="12">
                                       ' . ($grades->act_12 === '0' ? '' : $grades->act_12) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act13) ? 'true' : 'false') . '" data-label="13">
                                       ' . ($grades->act_13 === '0' ? '' : $grades->act_13) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act14) ? 'true' : 'false') . '" data-label="14">
                                       ' . ($grades->act_14 === '0' ? '' : $grades->act_14) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act15) ? 'true' : 'false') . '" data-label="15">
                                       ' . ($grades->act_15 === '0' ? '' : $grades->act_15) . '
                                       </td>
                                       <td data-label="Total">
                                        <strong>';
                $output3 = intval($grades->act_1) + intval($grades->act_2) + intval($grades->act_3) + intval($grades->act_4) + intval($grades->act_5) + intval($grades->act_6) + intval($grades->act_7) + intval($grades->act_8) +
                    intval($grades->act_9) + intval($grades->act_10) + intval($grades->act_11) + intval($grades->act_12) + intval($grades->act_13) + intval($grades->act_14) + intval($grades->act_15);

                $output5 = '</strong>
                                       </td>
                                       <td data-label="PS"><strong>
                                        ' . $output3 . '.00' . '</strong>
                                       </td>
                                       <td data-label="WS"><strong>';

                if ($output3 === 0 || $actTotalJr === 0) {
                    $output7 = 0;
                } else {
                    $jrWs = ($output3 / $actTotalJr) * $wsNew;
                    $jrWsRound = round($jrWs, 2);
                    $output7 = $jrWsRound;
                }
                $output6 = '</strong>
                                       </td>
                                       <td data-label="Action">
                                           <span><button class="btn btn-info mr-1 btnsave" href="" data-id="' . $grades->g_s_id . '" role="button"><i class="far fa-save"></i></button></button><button class="btn btn-danger btndelete" href="" data-id="' . $grades->enrollee_id . '" role="button"' . $checkTrue . '><i class="far fa-trash-alt"></i></button></span>
                                       </td>
                                   </tr>';
                echo $output2 . $output3 . $output5 . $output7 . $output6;
            }
            $output4 = '
                            </tbody>
                        </table>     
                    </div>';
            echo $output4;
        }
    }

    public function addSrHighGrade()
    {
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currentSubjectId = $_POST['currentSubjectId'];
        $jrHs = $_POST['jrHs'];
        $currenSchoolYear = $_SESSION['sem_name'];
        $actTrigger = $_POST['actTrigger'];
        $actName = $_POST['actName'];
        $actJrHsNo = $_POST['actJrHsNo'];
        $colId = $_POST['colId'];
        $perId = $_POST['perId'];

        switch ($actTrigger) {
            case 'add':
                $addSrHighSCore = $this->gradeModel->addSrHighGrade($currentSubjectId,  $gradeQuarter, $gradeSource, $actJrHsNo, $actName, $jrHs, $currenSchoolYear, $colId);

                if ($addSrHighSCore) {

                    $this->loadSrStudentsData($currentSubjectId, $currenSchoolYear, $gradeSource, $gradeQuarter);
                }

                break;
            case 'update':

                $updateSrHighScore = $this->gradeModel->updateSrHighGrade($jrHs, $perId, $actName);

                if ($updateSrHighScore) {

                    $this->loadSrStudentsData($currentSubjectId, $currenSchoolYear, $gradeSource, $gradeQuarter);
                }
                break;
        }
    }

    public function updateSrGradeTable()
    {
        $jrGradeId = $_POST['jrGradeId'];
        $activities = $_POST['activities'];
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_SESSION['sem_name'];
        $subjectIds = $_POST['subjectIds'];

        $updateJrGrade = $this->gradeModel->updateSrGrade($jrGradeId, $activities);

        if ($updateJrGrade) {

            $this->loadSrStudentsData($subjectIds, $currenSchoolYear, $gradeSource, $gradeQuarter);
        } else {
            echo 'Failed to update grade';
        }
    }

    public function updateSrWs()
    {
        $newWs = $_POST['newWs'];
        $wsId = $_POST['wsId'];

        $updated_Ws = $this->gradeModel->updateSrWs($newWs, $wsId);

        if ($updated_Ws) {
            echo 'WS updated successfully';
        } else {
            echo 'WS failed to update';
        }
    }

    public function removeSrStudent()
    {
        $subjectIds = $_POST['subjectIds'];
        $jrGradeId = $_POST['jrGradeId'];
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_SESSION['sem_name'];

        $removeSrStudentToClassRecord = $this->studentModel->removeSrStudent($jrGradeId, $subjectIds, $currenSchoolYear);

        if ($removeSrStudentToClassRecord) {

            $this->loadSrStudentsData($subjectIds, $currenSchoolYear, $gradeSource, $gradeQuarter);
        } else {
            echo 'Failed to remove from class record';
        }
    }

    //College
    public function insertDataCol()
    {
        $enrolleeID = $_POST['enrolleId'];
        $subjectID = $_POST['subjectId'];
        $subjectTerm = $_POST['subjectSem'];
        $instructorId = $_SESSION['id'];
        $currenSchoolYear = $_SESSION['sem_name'];

        $insertStudentCol = $this->studentModel->addCollegeStudentRecords($enrolleeID, $subjectID, $instructorId, $currenSchoolYear, $subjectTerm);

        if ($insertStudentCol) {
            flash('add_student_record_success', 'Student is added to your class record');
            echo 'Student is added to your class record';
        } else {
            echo 'Failed to add student on your class record';
        }
    }

    //college grade
    public function updateCollegeGradeTable()
    {
        $jrGradeId = $_POST['jrGradeId'];
        $activities = $_POST['activities'];
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_SESSION['sem_name'];
        $currentTerm = $_SESSION['sem_termNum'];
        $subjectIds = $_POST['subjectIds'];

        $updateCollegeGrade = $this->gradeModel->updateCollegeGrade($jrGradeId, $activities);

        if ($updateCollegeGrade) {

            $this->loadCollegeStudentsData($subjectIds, $currenSchoolYear, $gradeSource, $gradeQuarter, $currentTerm);
        } else {
            echo 'Failed to update grade';
        }
    }

    public function loadGradesCollege()
    {
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_SESSION['sem_name'];
        $currentTerm = $_SESSION['sem_termNum'];
        $subjectID = $_POST['subjectId'];

        $this->loadCollegeStudentsData($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter,  $currentTerm);
    }

    public function loadCollegeStudentsData($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter,  $currentTerm)
    {
        $gradeSet = $this->gradeModel->loadCollegeGrade($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter, $currentTerm);

        $jrHighScore = $this->gradeModel->getCollegeHighSCore($subjectID, $gradeSource, $gradeQuarter, $currenSchoolYear, $currentTerm);

        $collegeActCount = $this->gradeModel->countCollegeActivity($subjectID, $gradeQuarter, $gradeSource,  $currenSchoolYear, $currentTerm);

        $dataId = 0;
        $actTotalJr = 0;
        $ps = 100;
        $wsNew = 0;

        if (!empty($gradeSet)) {
            $output1 = '
                        <table class="tablesgrade" id="jrTable">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>
                                    <th>14</th>
                                    <th>15</th>
                                    <th>Total</th>
                                    
                                    <th>CS</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="gradesHigh">
                                        <strong>Highest Posible Grade</strong>
                                    </td>
                                    <td class="chs" data-row="1" data-column="1" data-id="';
            echo $output1;
            echo 0;
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act1Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act1Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act1 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="2" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act2Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act2Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act2 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="3" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act3Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act3Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act3 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="4" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act4Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act4Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act4 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="5" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act5Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act5Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act5 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="6" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act6Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act6Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act6 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="7" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act7Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act7Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act7 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="8" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act8Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act8Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act8 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="9" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act9Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act9Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act9 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="10" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act10Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act10Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act10 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="11" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act11Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act11Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act11 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="12" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act12Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act12Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act12 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="13" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act13Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act13Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act13 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="14" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act14Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act14Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act14 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="15" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act15Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act15Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act15 . '</strong>';
            }
            echo '</td>
                  
                  <td><strong>';
            echo $collegeActCount;
            echo ' </strong>
                  </td>
                  <td class="chsWs"';
            echo 'data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->actWs;
            }
            echo '"
            data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"><strong>';
            foreach ($jrHighScore as $jrScore) {
                $wsNew = $jrScore->actWs;
                echo $wsNew . '%';
            }
            echo '</strong>
                  </td>
                  <td>

                  </td>
                  </tr>';



            foreach ($gradeSet as $grades) {

                $output2 = '
                                       <tr>
                                       <td data-label="Last Name">
                                        ' . $grades->lname . ', ' . $grades->fname . ' ' . $grades->mname . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act1) ? 'true' : 'false') . '" data-label="1">
                                        ' . ($grades->act_1 === '0' ? '' : $grades->act_1) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act2) ? 'true' : 'false') . '" data-label="2">
                                        ' . ($grades->act_2 === '0' ? '' : $grades->act_2) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act3) ? 'true' : 'false') . '" data-label="3">
                                       ' . ($grades->act_3 === '0' ? '' : $grades->act_3) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act4) ? 'true' : 'false') . '" data-label="4">
                                       ' . ($grades->act_4 === '0' ? '' : $grades->act_4) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act5) ? 'true' : 'false') . '" data-label="5">
                                       ' . ($grades->act_5 === '0' ? '' : $grades->act_5) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act6) ? 'true' : 'false') . '" data-label="6">
                                       ' . ($grades->act_6 === '0' ? '' : $grades->act_6) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act7) ? 'true' : 'false') . '" data-label="7">
                                       ' . ($grades->act_7 === '0' ? '' : $grades->act_7) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act8) ? 'true' : 'false') . '" data-label="8">
                                       ' . ($grades->act_8 === '0' ? '' : $grades->act_8) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act9) ? 'true' : 'false') . '" data-label="9">
                                       ' . ($grades->act_9 === '0' ? '' : $grades->act_9) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act10) ? 'true' : 'false') . '" data-label="10">
                                       ' . ($grades->act_10 === '0' ? '' : $grades->act_10) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act11) ? 'true' : 'false') . '" data-label="11">
                                       ' . ($grades->act_11 === '0' ? '' : $grades->act_11) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act12) ? 'true' : 'false') . '" data-label="12">
                                       ' . ($grades->act_12 === '0' ? '' : $grades->act_12) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act13) ? 'true' : 'false') . '" data-label="13">
                                       ' . ($grades->act_13 === '0' ? '' : $grades->act_13) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act14) ? 'true' : 'false') . '" data-label="14">
                                       ' . ($grades->act_14 === '0' ? '' : $grades->act_14) . '
                                       </td>
                                       <td contenteditable="' . (!empty($jrScore->act15) ? 'true' : 'false') . '" data-label="15">
                                       ' . ($grades->act_15 === '0' ? '' : $grades->act_15) . '
                                       </td>
                                       <td data-label="Total">
                                        <strong>';
                $output3 = intval($grades->act_1) + intval($grades->act_2) + intval($grades->act_3) + intval($grades->act_4) + intval($grades->act_5) + intval($grades->act_6) + intval($grades->act_7) + intval($grades->act_8) +
                    intval($grades->act_9) + intval($grades->act_10) + intval($grades->act_11) + intval($grades->act_12) + intval($grades->act_13) + intval($grades->act_14) + intval($grades->act_15);

                $output5 = '</strong>
                                       </td>
                                       
                                       <td data-label="WS"><strong>';

                if ($output3 === 0 || $collegeActCount === 0) {
                    $output7 = 0;
                } else {
                    $convertedNum  = convertToPercent($wsNew);
                    $jrWs = ($output3 / $collegeActCount) * $convertedNum;
                    $jrWsRound = round($jrWs, 2);
                    $output7 = $jrWsRound;
                }
                $output6 = '</strong>
                                       </td>
                                       <td data-label="Action">
                                           <span><button class="btn btn-info mr-1 btnsave" href="" data-id="' . $grades->g_c_id . '" role="button"><i class="far fa-save"></i></button></button><button class="btn btn-danger btndelete" href="" data-id="' . $grades->enrollee_id . '" role="button"><i class="far fa-trash-alt"></i></button></span>
                                       </td>
                                   </tr>';
                echo $output2 . $output3 . $output5 . $output7 . $output6;
            }
            $output4 = '
                            </tbody>
                        </table>     
                    </div>';
            echo $output4;
        }
    }

    public function addCollegeHighGrade()
    {
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currentSubjectId = $_POST['currentSubjectId'];
        $jrHs = $_POST['jrHs'];
        $currenSchoolYear = $_SESSION['sem_name'];
        $currentTerm = $_SESSION['sem_termNum'];
        $actTrigger = $_POST['actTrigger'];
        $actName = $_POST['actName'];
        $actJrHsNo = $_POST['actJrHsNo'];
        $colId = $_POST['colId'];
        $perId = $_POST['perId'];

        switch ($actTrigger) {
            case 'add':
                $addCollegeHighSCore = $this->gradeModel->addCollegeHighGrade($currentSubjectId,  $gradeQuarter, $gradeSource, $actJrHsNo, $actName, $jrHs, $currenSchoolYear, $colId, $currentTerm);

                if ($addCollegeHighSCore) {

                    $this->loadCollegeStudentsData($currentSubjectId, $currenSchoolYear, $gradeSource, $gradeQuarter, $currentTerm);
                }

                break;
            case 'update':

                $updateCollegeHighScore = $this->gradeModel->updateCollegeHighGrade($jrHs, $perId, $actName);

                if ($updateCollegeHighScore) {

                    $this->loadCollegeStudentsData($currentSubjectId, $currenSchoolYear, $gradeSource, $gradeQuarter, $currentTerm);
                }
                break;
        }
    }

    public function updateCollegeCLassStanding()
    {
        $newWs = $_POST['newWs'];
        $wsId = $_POST['wsId'];

        $updated_CollegeClassStanding = $this->gradeModel->updateCollegeClassStandings($newWs, $wsId);

        if ($updated_CollegeClassStanding) {
            echo 'Class standing updated successfully';
        } else {
            echo 'Class standing failed to update';
        }
    }

    public function removeCollegeStudent()
    {
        $subjectIds = $_POST['subjectIds'];
        $jrGradeId = $_POST['jrGradeId'];
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_SESSION['sem_name'];
        $currentTerm = $_SESSION['sem_termNum'];

        $removeCollegeStudentToClassRecord = $this->studentModel->removeCollegeStudent($jrGradeId, $subjectIds, $currenSchoolYear, $currentTerm);

        if ($removeCollegeStudentToClassRecord) {

            echo 'Student successfully remove from class record';
        } else {
            echo 'Failed to remove from class record';
        }
    }

    public function removeCollegeStudentDraft()
    {
        $subjectIds = $_POST['subjectIds'];
        $jrGradeId = $_POST['jrGradeId'];
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_SESSION['sem_name'];
        $currentTerm = $_SESSION['sem_termNum'];
        $subjectDes = $_POST['subjectDes'];
        $subjectName = $_POST['subjectName'];
        $draftStat = $_POST['draftStat'];
        $instructorId = $_SESSION['id'];
        $remarks = 'FAILED';

        $removeCollegeStudentToClassRecord = $this->studentModel->removeCollegeStudent($jrGradeId, $subjectIds, $currenSchoolYear, $currentTerm);

        if ($removeCollegeStudentToClassRecord) {
            $getRemoveStudentsInfo = $this->studentModel->getRemoveStudentsInfo($jrGradeId);
            $getSubjectDetails = $this->subjectsModel->getSubjectDetails($subjectIds);

            if ($getRemoveStudentsInfo) {
                $programId = $getRemoveStudentsInfo->program_id;
                $studentId = $getRemoveStudentsInfo->student_id;
                $stud = $getRemoveStudentsInfo->stud;
                $courseCode = $getRemoveStudentsInfo->code;
                $subjectYear = $getSubjectDetails->year_level;

                $draftCurrentStudentNow = $this->studentModel->draftCurrentStudentNow($programId, $stud, $studentId, $instructorId, $subjectIds, $subjectName, $subjectDes, $subjectYear, $courseCode, $draftStat, $remarks, $currenSchoolYear, $currentTerm);

                if ($draftCurrentStudentNow) {
                    echo 'Successfully drop student';
                } else {
                    echo 'Failed to drop student';
                }
            }
        } else {
            echo 'Failed to remove from class record';
        }
    }

    //submit Grades
    public function submitCollegeGrade()
    {
        $submittedInfo = $_POST['submittedInfo'];
        $subjectName = $_POST['subjectName'];
        $subjectDescription = $_POST['subjectDescription'];
        $subjectYearLevel = $_POST['subjectYearLevel'];
        $assignDate = $_POST['assignDate'];
        $schedId = $_POST['subjectId'];
        $instructorId = $_SESSION['id'];
        $schoolYear = $_SESSION['sem_name'];
        $currentTerm = $_SESSION['sem_termNum'];
        $insCount = 0;
        $reports = [];

        $inserCollegeShowDate = $this->schoolModel->inserCollegeShowDate($schedId, $schoolYear, $currentTerm, $assignDate);
        $insertedShowDateId = $inserCollegeShowDate->id;

        // foreach ($submittedInfo['programId'] as $programId) {
        //     echo $programId;
        // }

        for ($count = 0; $count < count($submittedInfo['gradeRemarks']); $count++) {
            $programId = $submittedInfo['programId'][$count];
            $studentId = $submittedInfo['studentId'][$count];
            $studentNo = $submittedInfo['studentNo'][$count];
            $finalGrade = $submittedInfo['finalGrade'][$count];
            $gradeRemarks = $submittedInfo['gradeRemarks'][$count];
            $studentName = $submittedInfo['studentName'][$count];
            $studentCourse = $submittedInfo['studentCourse'][$count];

            // echo $programId;
            // echo $studentId;
            // echo $studentNo;
            // echo $finalGrade;
            // echo $gradeRemarks;


            $insertFinalGrades = $this->gradeModel->insertFinalGrade($programId, $studentId, $studentNo, $instructorId, $schedId, $subjectName, $subjectDescription, $subjectYearLevel, $studentCourse, $finalGrade, $gradeRemarks, $schoolYear, $currentTerm, $studentName, $insertedShowDateId);

            if ($insertFinalGrades != '') {
                $insCount = $insCount + 1;
                array_push($reports, $insertFinalGrades);
            }
        }

        if ($insCount > 0) {
            $this->loadSubmittedReport($reports);
        } else {
            echo 'Grade has failed to submit';
        }
    }

    public function loadSubmittedReport($reports)
    {
        echo '<table>
                <tr>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Remarks</th>
                </tr>';
        foreach ($reports as $newReports) {
            $newestRepots = explode('.....', $newReports);

            echo '
                    <tr>
                    <td>' . $newestRepots[0] . '</td>
                    <td>' . $newestRepots[1] . '</td>
                    <td>' . $newestRepots[2] . '</td>
                    </tr>';


            // echo '<p>' . $newReports . '</p>';
        }
        echo '</table>';
    }

    public function submitJuniorGrade()
    {
        $submittedInfos = $_POST['submittedInfos'];
        $subjectName = $_POST['subjectName'];
        $subjectDescription = $_POST['subjectDescription'];
        $subjectYearLevel = $_POST['subjectYearLevel'];
        $assignDate = $_POST['assignDate'];

        $schedId = $_POST['subjectId'];
        $instructorId = $_SESSION['id'];
        $schoolYear = $_SESSION['school_year'];

        $insCount = 0;
        $reports = [];

        $inserShowDate = $this->schoolModel->insertShowGradeDate($assignDate, $schedId, $schoolYear);
        $insertedDateId = $inserShowDate->id;

        for ($count = 0; $count < count($submittedInfos['firstQg']); $count++) {
            $studentInfoId = $submittedInfos['studentInfoId'][$count];
            $studentId = $submittedInfos['studentId'][$count];
            $firstIg = $submittedInfos['firstIg'][$count];
            $firstQg = $submittedInfos['firstQg'][$count];
            $studentName = $submittedInfos['studentName'][$count];

            $insertFinalGrades = $this->gradeModel->saveJuniorFinal($studentInfoId, $studentId, $instructorId, $schedId, $subjectName, $subjectDescription, $subjectYearLevel, $firstIg, $firstQg, $insertedDateId, $schoolYear, $studentName);

            if ($insertFinalGrades != '') {
                $insCount = $insCount + 1;
                array_push($reports, $insertFinalGrades);
            }
        }

        if ($insCount > 0) {
            $this->loadSubmittedReportJr($reports);
        } else {
            echo 'Grade has failed to submit';
        }
    }

    public function loadSubmittedReportJr($reports)
    {
        echo '<table>
                <tr>
                    <th>Name</th>
                    <th>Quarter</th>
                    <th>Grade</th>
                </tr>';
        foreach ($reports as $newReports) {
            $newestRepots = explode('.....', $newReports);

            echo '
                    <tr>
                    <td>' . $newestRepots[0] . '</td>
                    <td>' . $newestRepots[1] . '</td>
                    <td>' . $newestRepots[2] . '</td>
                    </tr>';


            // echo '<p>' . $newReports . '</p>';
        }
        echo '</table>';
    }

    public function submitJuniorGrade2()
    {
        $submittedInfos = $_POST['submittedInfos'];
        $subjectName = $_POST['subjectName'];
        $subjectDescription = $_POST['subjectDescription'];
        $subjectYearLevel = $_POST['subjectYearLevel'];
        $assignDate = $_POST['assignDate'];

        $schedId = $_POST['subjectId'];
        $instructorId = $_SESSION['id'];
        $schoolYear = $_SESSION['school_year'];

        $insCount = 0;
        $reports = [];

        $updateShowDate = $this->schoolModel->updateShowGradeDate($assignDate, $schedId, $schoolYear);
        if ($updateShowDate) {

            for ($count = 0; $count < count($submittedInfos['firstQg']); $count++) {
                $studentInfoId = $submittedInfos['studentInfoId'][$count];
                $studentId = $submittedInfos['studentId'][$count];
                $firstIg = $submittedInfos['firstIg'][$count];
                $firstQg = $submittedInfos['firstQg'][$count];
                $studentName = $submittedInfos['studentName'][$count];

                $updateSecFinalGrades = $this->gradeModel->updateSecJuniorFinal($studentInfoId, $studentId, $schedId, $firstIg, $firstQg, $schoolYear, $studentName);

                if ($updateSecFinalGrades != '') {
                    $insCount = $insCount + 1;
                    array_push($reports, $updateSecFinalGrades);
                }
            }

            if ($insCount > 0) {
                $this->loadSubmittedReportJr($reports);
            } else {
                echo 'Grade has failed to submit';
            }
        }
    }

    public function submitJuniorGrade3()
    {
        $submittedInfos = $_POST['submittedInfos'];
        $subjectName = $_POST['subjectName'];
        $subjectDescription = $_POST['subjectDescription'];
        $subjectYearLevel = $_POST['subjectYearLevel'];
        $assignDate = $_POST['assignDate'];

        $schedId = $_POST['subjectId'];
        $instructorId = $_SESSION['id'];
        $schoolYear = $_SESSION['school_year'];

        $insCount = 0;
        $reports = [];

        $updateShowDate = $this->schoolModel->updateShowGradeDate($assignDate, $schedId, $schoolYear);
        if ($updateShowDate) {

            for ($count = 0; $count < count($submittedInfos['firstQg']); $count++) {
                $studentInfoId = $submittedInfos['studentInfoId'][$count];
                $studentId = $submittedInfos['studentId'][$count];
                $firstIg = $submittedInfos['firstIg'][$count];
                $firstQg = $submittedInfos['firstQg'][$count];
                $studentName = $submittedInfos['studentName'][$count];

                $updateSecFinalGrades = $this->gradeModel->updateThiJuniorFinal($studentInfoId, $studentId, $schedId, $firstIg, $firstQg, $schoolYear, $studentName);

                if ($updateSecFinalGrades != '') {
                    $insCount = $insCount + 1;
                    array_push($reports, $updateSecFinalGrades);
                }
            }

            if ($insCount > 0) {
                $this->loadSubmittedReportJr($reports);
            } else {
                echo 'Grade has failed to submit';
            }
        }
    }

    public function submitJuniorGrade4()
    {
        $submittedInfos = $_POST['submittedInfos'];
        $subjectName = $_POST['subjectName'];
        $subjectDescription = $_POST['subjectDescription'];
        $subjectYearLevel = $_POST['subjectYearLevel'];
        $assignDate = $_POST['assignDate'];

        $schedId = $_POST['subjectId'];
        $instructorId = $_SESSION['id'];
        $schoolYear = $_SESSION['school_year'];

        $insCount = 0;
        $reports = [];

        $updateShowDate = $this->schoolModel->updateShowGradeDate($assignDate, $schedId, $schoolYear);
        if ($updateShowDate) {

            for ($count = 0; $count < count($submittedInfos['fourthQg']); $count++) {
                $studentInfoId = $submittedInfos['studentInfoId'][$count];
                $studentId = $submittedInfos['studentId'][$count];
                $firstIg = $submittedInfos['fourthIg'][$count];
                $firstQg = $submittedInfos['fourthQg'][$count];
                $studentName = $submittedInfos['studentName'][$count];
                $finalGrade = $submittedInfos['finalGrade'][$count];
                $gradeRemarks = $submittedInfos['gradeRemarks'][$count];

                $updateSecFinalGrades = $this->gradeModel->updateFouJuniorFinal($studentInfoId, $studentId, $schedId, $firstIg, $firstQg, $finalGrade, $gradeRemarks, $schoolYear, $studentName);

                if ($updateSecFinalGrades != '') {
                    $insCount = $insCount + 1;
                    array_push($reports, $updateSecFinalGrades);
                }
            }

            if ($insCount > 0) {
                $this->loadSubmittedReportJr($reports);
            } else {
                echo 'Grade has failed to submit';
            }
        }
    }

    public function updateSubmitGrade()
    {
        $updateDate = $_POST['updateDate'];
        $dateId = $_POST['dateId'];

        $updateDateNow = $this->schoolModel->updateDateNow($dateId, $updateDate);

        if ($updateDateNow) {
            echo 'Date successfuly updated';
        } else {
            echo 'Failed to update date';
        }
    }

    public function submitSeniorGrade1()
    {
        $seniorGrade = $_POST['seniorGrade'];
        $subjectName = $_POST['subjectName'];
        $subjectDescription = $_POST['subjectDescription'];
        $subjectYearLevel = $_POST['subjectYearLevel'];
        $assignDate = $_POST['assignDate'];
        $subjectTerm = $_POST['subjectTerm'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $schedId = $_POST['subjectId'];
        $instructorId = $_SESSION['id'];
        $schoolYear = $_SESSION['sem_name'];
        $semLoads = $_SESSION['sem_termNum'];

        $insCount = 0;
        $reports = [];

        $inserDateshow = $this->schoolModel->inserDateshow($assignDate, $schedId, $schoolYear);
        $insertedDateId = $inserDateshow->id;

        for ($count = 0; $count < count($seniorGrade['firstQuarter']); $count++) {
            $studentId = $seniorGrade['studentId'][$count];
            $studentNo = $seniorGrade['studentNo'][$count];
            $studentName = $seniorGrade['studentName'][$count];
            $firstIg = $seniorGrade['firstIg'][$count];
            $firstQuarter = $seniorGrade['firstQuarter'][$count];


            $insertFinalGrades = $this->gradeModel->saveSeniorFinal($studentId, $studentNo, $instructorId, $schedId, $subjectName, $subjectDescription, $subjectTerm, $subjectYearLevel, $firstIg, $firstQuarter, $insertedDateId, $schoolYear, $studentName, $gradeQuarter);

            if ($insertFinalGrades != '') {
                $insCount = $insCount + 1;
                array_push($reports, $insertFinalGrades);
            }
        }

        if ($insCount > 0) {
            $this->loadSubmittedReportJr($reports);
        } else {
            echo 'Grade has failed to submit';
        }
    }

    public function submitSeniorGrade2()
    {
        $seniorGrade = $_POST['seniorGrade'];
        $subjectName = $_POST['subjectName'];
        $subjectDescription = $_POST['subjectDescription'];
        $subjectYearLevel = $_POST['subjectYearLevel'];
        $assignDate = $_POST['assignDate'];
        $subjectTerm = $_POST['subjectTerm'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $schedId = $_POST['subjectId'];
        $instructorId = $_SESSION['id'];
        $schoolYear = $_SESSION['sem_name'];
        $semLoads = $_SESSION['sem_termNum'];

        $insCount = 0;
        $reports = [];

        $updateDateshow = $this->schoolModel->updateDateshowSr($assignDate, $schedId, $schoolYear);

        if ($updateDateshow) {
            for ($count = 0; $count < count($seniorGrade['secondQuarter']); $count++) {
                $studentId = $seniorGrade['studentId'][$count];
                $studentNo = $seniorGrade['studentNo'][$count];
                $studentName = $seniorGrade['studentName'][$count];
                $secondIg = $seniorGrade['secondIg'][$count];
                $secondQuarter = $seniorGrade['secondQuarter'][$count];
                $finalGrade = $seniorGrade['finalGrade'][$count];
                $gradeRemarks = $seniorGrade['gradeRemarks'][$count];


                $updateFinalGrades = $this->gradeModel->updateSeniorFinal($studentId, $studentNo, $schedId, $secondIg, $secondQuarter, $finalGrade, $gradeRemarks, $schoolYear, $studentName, $gradeQuarter);

                if ($updateFinalGrades != '') {
                    $insCount = $insCount + 1;
                    array_push($reports,  $updateFinalGrades);
                }
            }

            if ($insCount > 0) {
                $this->loadSubmittedReportJr($reports);
            } else {
                echo 'Grade has failed to submit';
            }
        }
    }

    public function updateSubmitGradeSr()
    {
        $updateDate = $_POST['updateDate'];
        $dateId = $_POST['dateId'];

        $updateDateNow = $this->schoolModel->updateDateNowSr($dateId, $updateDate);

        if ($updateDateNow) {
            echo 'Date successfuly updated';
        } else {
            echo 'Failed to update date';
        }
    }

    public function updateSubmitGradeCollege()
    {
        $updateDate = $_POST['updateDate'];
        $dateId = $_POST['dateId'];

        $updateDateNowCollege = $this->schoolModel->updateDateNowCollege($dateId, $updateDate);

        if ($updateDateNowCollege) {
            echo 'Date successfuly updated';
        } else {
            echo 'Failed to update date';
        }
    }

    public function addNewAdmin()
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $userId = $_POST['userId'];
        $role = $_POST['role'];

        $checkAdminUserId = $this->userModel->checkAdminId($userId);

        if ($checkAdminUserId) {
            echo 'User Id is already taken';
        } else {
            $newAdminAdded = $this->userModel->addNewAdmin($fname, $lname, $userId, $role);

            if ($newAdminAdded) {
                echo 'New admin has been added';
            } else {
                echo 'Failed to add admin';
            }
        }
    }

    public function changeAdminRole()
    {
        $adminId = $_POST['adminId'];
        $role = $_POST['role'];
        $target = $_POST['target'];
        $newRole = '';

        if ($role === 'full') {
            $newRole = 'partial';
        } elseif ($role === 'partial') {
            $newRole = 'full';
        }

        $updateAdminRole = $this->userModel->updateAdminRole($adminId, $newRole, $target);

        if ($updateAdminRole) {
            echo 'Successfully change ' . $target . ' to ' . $newRole;
        } else {
            echo 'Failed to change ' . $target;
        }
    }

    public function changeAdminStatus()
    {
        $adminId = $_POST['adminId'];
        $status = $_POST['status'];
        $target = $_POST['target'];
        $newStatus = 0;
        $stats = '';
        $targets = 'status';

        if ($status == 1) {
            $newStatus = 0;
            $stats = 'inactive';
        } elseif ($status == 0) {
            $newStatus = 1;
            $stats = 'active';
        }

        $updateAdminRole = $this->userModel->updateAdminRole($adminId, $newStatus, $target);

        if ($updateAdminRole) {
            echo 'Successfully change ' . $targets . ' to ' . $stats;
        } else {
            echo 'Failed to change ' . $targets;
        }
    }

    public function deleteAdminUser()
    {
        $adminId = $_POST['adminId'];

        $deleteAdminUser = $this->userModel->deleteAdminUser($adminId);

        if ($deleteAdminUser) {
            echo 'User succeessfully deleted';
        } else {
            echo 'Failed to delete user';
        }
    }

    public function addNewRegistrar()
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $userId = $_POST['userId'];
        $department = $_POST['department'];

        $checkAvailability = $this->userModel->checkRegisrarId($userId);

        if ($checkAvailability) {
            echo 'User Id already exist';
        } else {
            $addRegistrar = $this->userModel->addRegistrar($fname, $lname, $userId, $department);

            if ($addRegistrar) {
                echo 'Successfully added new registrar';
            } else {
                echo 'Failed to add registrar';
            }
        }
    }

    public function addNewUserReg()
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $userId = $_POST['userId'];
        $role = $_POST['role'];
        $adminDepartment = $_POST['adminDepartment'];

        $checkAvailability = $this->userModel->checkRegisrarId($userId);

        if ($checkAvailability) {
            echo 'User Id already exist';
        } else {
            $addRegistrar = $this->userModel->addUserRegistrar($fname, $lname, $userId, $role, $adminDepartment);

            if ($addRegistrar) {
                echo 'Successfully added new registrar';
            } else {
                echo 'Failed to add registrar';
            }
        }
    }

    public function changeUserRegRole()
    {
        $adminId = $_POST['adminId'];
        $role = $_POST['role'];
        $target = $_POST['target'];
        $newRole = '';

        if ($role === 'full') {
            $newRole = 'partial';
        } elseif ($role === 'partial') {
            $newRole = 'full';
        }

        $updateAdminRole = $this->userModel->updateRegRole($adminId, $newRole, $target);

        if ($updateAdminRole) {
            echo 'Successfully change ' . $target . ' to ' . $newRole;
        } else {
            echo 'Failed to change ' . $target;
        }
    }

    public function changeUserStatus()
    {
        $adminId = $_POST['adminId'];
        $status = $_POST['status'];
        $target = $_POST['target'];
        $newStatus = 0;
        $stats = '';
        $targets = 'status';

        if ($status == 1) {
            $newStatus = 0;
            $stats = 'inactive';
        } elseif ($status == 0) {
            $newStatus = 1;
            $stats = 'active';
        }

        $updateAdminRole = $this->userModel->updateRegRole($adminId, $newStatus, $target);

        if ($updateAdminRole) {
            echo 'Successfully change ' . $targets . ' to ' . $stats;
        } else {
            echo 'Failed to change ' . $targets;
        }
    }

    public function deleteRegUser()
    {
        $adminId = $_POST['adminId'];

        $deleteAdminUser = $this->userModel->deleteRegUser($adminId);

        if ($deleteAdminUser) {
            echo 'User succeessfully deleted';
        } else {
            echo 'Failed to delete user';
        }
    }

    public function addNewKinderRecord()
    {
        $grades = $_POST['grades'];
        $subject = $_POST['subject'];
        $level = $_POST['level'];
        $schoolYear = $_POST['schoolYear'];
        $schoolName = $_POST['schoolName'];
        $studentId = $_POST['studentId'];
        $infoId = $_POST['infoId'];

        $extractSubject = explode(',', $subject);

        $insertKinderRecord = $this->gradeModel->insertKinderRecord(
            $infoId,
            $studentId,
            $extractSubject[0],
            $extractSubject[1],
            $level,
            $grades['fq'],
            $grades['sq'],
            $grades['tq'],
            $grades['foq'],
            $grades['finalAvg'],
            $schoolYear,
            $schoolName
        );

        if ($insertKinderRecord) {
            echo 'Successfully added new record';
        } else {
            echo 'Failed to add new record';
        }
    }

    public function insertMultyJuniorRecord()
    {
        $schoolName = $_POST['schoolName'];
        $schoolYear = $_POST['schoolYear'];
        $gradeLevel = $_POST['gradeLevel'];
        $tableData = $_POST['tableData'];
        $infoId = $_POST['infoId'];
        $studentNo = $_POST['studentNo'];
        $count = $_POST['count'];
        $insertCount = 0;

        $saveSchoolNAme = $this->schoolModel->saveSchoolName($schoolName, $studentNo, $gradeLevel);

        if ($saveSchoolNAme) {
            for ($count = 0; $count < count($tableData['final']); $count++) {
                $firstQ = $tableData['first'][$count];
                $secondQ = $tableData['second'][$count];
                $thirdQ = $tableData['third'][$count];
                $fourthQ = $tableData['fourth'][$count];
                $final = $tableData['final'][$count];
                $subject = $tableData['subject'][$count];
                $des = $tableData['description'][$count];

                $descrip = '';
                if ($des === '') {
                    $descrip = 'none';
                } else {
                    $descrip = $des;
                }

                $remarks = '';

                if ($final >= 75) {
                    $remarks = 'PASSED';
                } else {
                    $remarks = 'FAILED';
                }

                $insertJuniorDatas = $this->gradeModel->insertJuniorDatas($infoId, $studentNo, $subject, $descrip, $gradeLevel, $firstQ, $secondQ, $thirdQ, $fourthQ, $final, $remarks, $schoolYear, $saveSchoolNAme);

                if ($insertJuniorDatas === true) {
                    $insertCount = $insertCount + 1;
                }
            }
        }

        if ($insertCount != $count) {
            echo 'Failed to insert ' . $count . ' records';
        } else {
            echo 'Seccessfully inserted ' . $count . ' records';
        }
    }

    public function updateMultyJuniorRecord()
    {
        $subject = $_POST['subject'];
        $newGrade = $_POST['newGrade'];
        $schoolYear = $_POST['schoolYear'];
        $gradeLevel = $_POST['gradeLevel'];
        $recId = $_POST['recId'];

        $updateJuniorRecords = $this->gradeModel->updateMultyJuniorRecord($recId, $subject, $newGrade['first'], $newGrade['second'], $newGrade['third'], $newGrade['fourth'], $newGrade['final'], $schoolYear, $gradeLevel);

        if ($updateJuniorRecords) {
            echo 'Records successfully updated';
        } else {
            echo 'Failed to update records';
        }
    }

    public function updateJuniorSchool()
    {
        $newSchool = $_POST['newSchool'];
        $schoolId = $_POST['schoolId'];

        $updateJuniorSchool = $this->schoolModel->updateJuniorSchool($schoolId, $newSchool);

        if ($updateJuniorSchool) {
            echo 'School name successfully updated';
        } else {
            echo 'Failed to update school';
        }
    }

    public function deleteJuniorMultyRecords()
    {
        $recId = $_POST['recId'];

        $deleteJuniorMultyRecords = $this->gradeModel->deleteJuniorMultyRecords($recId);

        if ($deleteJuniorMultyRecords) {
            echo 'Record successfully deleted';
        } else {
            echo 'Failed to delete record';
        }
    }

    public function getSections()
    {
        $valueLevel = $_POST['valueLevel'];

        $getJuniorSection = $this->schoolModel->getJuniorSection($valueLevel);

        if ($getJuniorSection) {
            $this->loadSections($getJuniorSection);
        } else {
            echo '<select id="sectionSel" class="form-control">
            <option selected>Choose...</option>';
            echo '<option value="None">None</option>';
        }
    }

    public function loadSections($getJuniorSection)
    {
        echo '<select id="sectionSel" class="form-control">
        <option selected>Choose...</option>';

        foreach ($getJuniorSection as $getJuniorSection) {
            echo '<option value="' . $getJuniorSection->id . '">' . $getJuniorSection->section_name . '</option>';
        }
        echo '</select>';
    }

    public function enrollStudents()
    {
        $regNo = $_POST['regNo'];
        $gradeSection = $_POST['gradeSection'];
        $infoId = $_POST['infoId'];
        $newRegNo = '(Offline)' . $regNo;
        $status = 'enrolled';

        $enrolledOfflineJunior = $this->schoolModel->enrolledOfflineJunior($newRegNo, $gradeSection, $infoId, $_SESSION['school_year'], $status);

        if ($enrolledOfflineJunior) {
            echo 'You successfully enrolled student';
        } else {
            echo 'Failed to enroll student';
        }
    }

    public function deleteEnrollStudents()
    {
        $enrolleeId = $_POST['enrolleeId'];

        $deleteEnrolledOffline = $this->schoolModel->deleteEnrolledOffline($enrolleeId);

        if ($deleteEnrolledOffline) {
            echo 'Record successfully deleted';
        } else {
            echo 'Failed to delete record';
        }
    }

    public function getSeniorSubjectData()
    {
        $count = $_POST['count'];
        $programId = $_POST['programId'];

        $getSeniorSubjectData = $this->subjectsModel->getSeniorSubjectFromCourse($programId);

        if ($getSeniorSubjectData) {
            echo  '<tr id="rows' . $count . '">';
            echo  '<td data-label="Subject" class="colSubject"><select id="gradeLevel' . $count . '" class="form-control"><option selected>Choose...</option>';
            foreach ($getSeniorSubjectData as $getSeniorSubjectData) {
                echo '<option value="' . $getSeniorSubjectData->code . '......' . $getSeniorSubjectData->description . '">' . $getSeniorSubjectData->code . ' - ' . $getSeniorSubjectData->description . '</option>';
            }
            '</select></td>';
            echo  '<td data-label="Year Level" contenteditable="true" class="colYear"><select id="level' . $count . '" class="form-control"><option selected>Choose...</option><option value="1">First Year</option><option value="2">Second Year</option></select></td>';
            echo  '<td data-label="Semester" contenteditable="true" class="colSem"><select id="sem' . $count . '" class="form-control"><option selected>Choose...</option><option value="1">First</option><option value="2">Second</option><option value="3">Summer</option></select></td>';
            echo  '<td data-label="Core" contenteditable="true" class="colYear"><select id="isCore' . $count . '" class="form-control"><option selected>Choose...</option><option value="1">Yes</option><option value="2">No</option></select></td>';
            echo  '<td><button type="button" name="remove" data-row="rows' . $count . '" class="btn btn-danger remove"><i class="fas fa-minus"></i></button></td>';
            echo  '</tr>';
        }
    }

    public function insertSeniorSubjects()
    {
        $tableData = $_POST['tableData'];
        $programId = $_POST['programId'];
        $counter = 0;

        for ($count = 0; $count < count($tableData['sem']); $count++) {
            $subject = $tableData['subject'][$count];
            $year = $tableData['year'][$count];
            $sem = $tableData['sem'][$count];
            $core = $tableData['core'][$count];

            $splitSubject = explode('......', $subject);

            $insertSeniorSubjectsList = $this->subjectsModel->insertSeniorSubjectsList($programId, $splitSubject[0], $splitSubject[1], $year, $sem, $core);

            if ($insertSeniorSubjectsList) {
                $counter = $counter + 1;
            }
        }

        if ($counter > 0) {
            echo $counter . ' subjects has been saved';
        } else {
            echo 'Failed to save subjects';
        }
    }

    public function updateSeniorSubjectPattern()
    {
        $recId = $_POST['recId'];
        $newYear = $_POST['newYear'];
        $newSem = $_POST['newSem'];
        $newCore = $_POST['newCore'];

        $updateSeniorSubjectPattern = $this->subjectsModel->updateSeniorSubjectPattern($recId, $newYear, $newSem, $newCore);

        if ($updateSeniorSubjectPattern) {
            echo 'Record successfully updated';
        } else {
            echo 'Failed to update record';
        }
    }

    public function updateHigherSubjectPattern()
    {
        $recId = $_POST['recId'];
        $newYear = $_POST['newYear'];
        $newSem = $_POST['newSem'];


        $updateSeniorSubjectPattern = $this->subjectsModel->updateHigherSubjectPattern($recId, $newYear, $newSem);

        if ($updateSeniorSubjectPattern) {
            echo 'Record successfully updated';
        } else {
            echo 'Failed to update record';
        }
    }

    public function deleteSeniorSubjectPattern()
    {
        $recId = $_POST['recId'];

        $deleteSeniorSubjectPattern = $this->subjectsModel->deleteSeniorSubjectPattern($recId);

        if ($deleteSeniorSubjectPattern) {
            echo 'Record successfully deleted';
        } else {
            echo 'Failed to delete record';
        }
    }

    public function deleteHigherSubjectPattern()
    {
        $recId = $_POST['recId'];

        $deleteSeniorSubjectPattern = $this->subjectsModel->deleteHigherSubjectPattern($recId);

        if ($deleteSeniorSubjectPattern) {
            echo 'Record successfully deleted';
        } else {
            echo 'Failed to delete record';
        }
    }

    public function loadGradesJrAll()
    {
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_POST['schoolYear'];
        $subjectID = $_POST['subjectId'];

        $this->loadJrStudentsDataAll($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter);
    }

    public function loadJrStudentsDataAll($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter)
    {
        $gradeSet = $this->gradeModel->loadJrGrade($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter);

        $jrHighScore = $this->gradeModel->getJrHighSCore($subjectID, $gradeSource, $gradeQuarter, $currenSchoolYear);
        $dataId = 0;
        $actTotalJr = 0;
        $ps = 100;
        $wsNew = 0;

        if (!empty($gradeSet)) {
            $output1 = '
                        <table class="tablesgrade" id="jrTable">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>
                                    <th>14</th>
                                    <th>15</th>
                                    <th>Total</th>
                                    <th>PS</th>
                                    <th>WS</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="gradesHigh">
                                        <strong>Highest Posible Grade</strong>
                                    </td>
                                    <td class="jhs" data-row="1" data-column="1" data-id="';
            echo $output1;
            echo 0;
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act1Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act1Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act1 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="2" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act2Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act2Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act2 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="3" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act3Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act3Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act3 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="4" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act4Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act4Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act4 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="5" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act5Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act5Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act5 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="6" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act6Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act6Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act6 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="7" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act7Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act7Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act7 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="8" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act8Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act8Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act8 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="9" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act9Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act9Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act9 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="10" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act10Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act10Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act10 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="11" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act11Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act11Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act11 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="12" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act12Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act12Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act12 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="13" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act13Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act13Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act13 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="14" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act14Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act14Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act14 . '</strong>';
            }
            echo '</td>
                  <td class="jhs" data-row="1" data-column="15" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act15Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act15Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act15 . '</strong>';
            }
            echo '</td>
                  <td>
                  <strong>';
            foreach ($jrHighScore as $jrScore) {
                $actTotalJr = $jrScore->act1 + $jrScore->act2 + $jrScore->act3 + $jrScore->act4 + $jrScore->act5 +
                    $jrScore->act6 + $jrScore->act7 + $jrScore->act8 + $jrScore->act9 + $jrScore->act10 +
                    $jrScore->act11 + $jrScore->act12 + $jrScore->act13 + $jrScore->act14 + $jrScore->act15;
            }
            if (empty($actTotalJr)) {
                $actTotalJr = 0;
                echo $actTotalJr;
            } else {
                echo $actTotalJr;
            }
            echo '</strong>
                  </td>
                  <td><strong>';
            echo $ps . '.00';
            echo ' </strong>
                  </td>
                  <td class="jhsWs"';
            echo 'data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->actWs;
            }
            echo '"
            data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_j_h_ids_id;
            }
            echo '"><strong>';
            foreach ($jrHighScore as $jrScore) {
                $wsNew = $jrScore->actWs;
                echo $wsNew . '%';
            }
            echo '</strong>
                  </td>
                  
                  </tr>';



            foreach ($gradeSet as $grades) {

                $output2 = '
                                       <tr>
                                       <td data-label="Last Name">
                                        ' . $grades->last_name . ', ' . $grades->first_name . ' ' . $grades->middle_name . '
                                       </td>
                                       <td data-label="1">
                                        ' . ($grades->act_1 === '0' ? '' : $grades->act_1) . '
                                       </td>
                                       <td data-label="2">
                                        ' . ($grades->act_2 === '0' ? '' : $grades->act_2) . '
                                       </td>
                                       <td data-label="3">
                                       ' . ($grades->act_3 === '0' ? '' : $grades->act_3) . '
                                       </td>
                                       <td data-label="4">
                                       ' . ($grades->act_4 === '0' ? '' : $grades->act_4) . '
                                       </td>
                                       <td data-label="5">
                                       ' . ($grades->act_5 === '0' ? '' : $grades->act_5) . '
                                       </td>
                                       <td data-label="6">
                                       ' . ($grades->act_6 === '0' ? '' : $grades->act_6) . '
                                       </td>
                                       <td data-label="7">
                                       ' . ($grades->act_7 === '0' ? '' : $grades->act_7) . '
                                       </td>
                                       <td data-label="8">
                                       ' . ($grades->act_8 === '0' ? '' : $grades->act_8) . '
                                       </td>
                                       <td data-label="9">
                                       ' . ($grades->act_9 === '0' ? '' : $grades->act_9) . '
                                       </td>
                                       <td data-label="10">
                                       ' . ($grades->act_10 === '0' ? '' : $grades->act_10) . '
                                       </td>
                                       <td data-label="11">
                                       ' . ($grades->act_11 === '0' ? '' : $grades->act_11) . '
                                       </td>
                                       <td data-label="12">
                                       ' . ($grades->act_12 === '0' ? '' : $grades->act_12) . '
                                       </td>
                                       <td data-label="13">
                                       ' . ($grades->act_13 === '0' ? '' : $grades->act_13) . '
                                       </td>
                                       <td data-label="14">
                                       ' . ($grades->act_14 === '0' ? '' : $grades->act_14) . '
                                       </td>
                                       <td data-label="15">
                                       ' . ($grades->act_15 === '0' ? '' : $grades->act_15) . '
                                       </td>
                                       <td data-label="Total">
                                        <strong>';
                $output3 = intval($grades->act_1) + intval($grades->act_2) + intval($grades->act_3) + intval($grades->act_4) + intval($grades->act_5) + intval($grades->act_6) + intval($grades->act_7) + intval($grades->act_8) +
                    intval($grades->act_9) + intval($grades->act_10) + intval($grades->act_11) + intval($grades->act_12) + intval($grades->act_13) + intval($grades->act_14) + intval($grades->act_15);

                $output5 = '</strong>
                                       </td>
                                       <td data-label="PS"><strong>
                                        ' . $output3 . '.00' . '</strong>
                                       </td>
                                       <td data-label="WS"><strong>';

                if ($output3 === 0 || $actTotalJr === 0) {
                    $output7 = 0;
                } else {
                    $jrWs = ($output3 / $actTotalJr) * $wsNew;
                    $jrWsRound = round($jrWs, 2);
                    $output7 = $jrWsRound;
                }
                $output6 = '</strong>
                                       </td>
                                       
                                   </tr>';
                echo $output2 . $output3 . $output5 . $output7 . $output6;
            }
            $output4 = '
                            </tbody>
                        </table>     
                    </div>';
            echo $output4;
        }
    }

    public function loadGradesSrAll()
    {
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_POST['schoolYear'];
        $subjectID = $_POST['subjectId'];

        $this->loadSrStudentsDataall($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter);
    }

    public function loadSrStudentsDataAll($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter)
    {
        $gradeSet = $this->gradeModel->loadSrGrade($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter);

        $jrHighScore = $this->gradeModel->getSrHighSCore($subjectID, $gradeSource, $gradeQuarter, $currenSchoolYear);
        $dataId = 0;
        $actTotalJr = 0;
        $ps = 100;
        $wsNew = 0;

        if (!empty($gradeSet)) {
            $output1 = '
                        <table class="tablesgrade" id="jrTable">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>
                                    <th>14</th>
                                    <th>15</th>
                                    <th>Total</th>
                                    <th>PS</th>
                                    <th>WS</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="gradesHigh">
                                        <strong>Highest Posible Grade</strong>
                                    </td>
                                    <td class="shs" data-row="1" data-column="1" data-id="';
            echo $output1;
            echo 0;
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act1Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act1Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act1 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="2" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act2Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act2Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act2 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="3" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act3Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act3Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act3 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="4" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act4Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act4Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act4 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="5" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act5Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act5Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act5 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="6" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act6Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act6Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act6 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="7" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act7Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act7Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act7 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="8" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act8Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act8Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act8 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="9" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act9Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act9Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act9 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="10" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act10Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act10Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act10 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="11" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act11Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act11Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act11 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="12" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act12Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act12Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act12 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="13" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act13Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act13Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act13 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="14" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act14Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act14Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act14 . '</strong>';
            }
            echo '</td>
                  <td class="shs" data-row="1" data-column="15" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act15Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act15Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act15 . '</strong>';
            }
            echo '</td>
                  <td>
                  <strong>';
            foreach ($jrHighScore as $jrScore) {
                $actTotalJr = $jrScore->act1 + $jrScore->act2 + $jrScore->act3 + $jrScore->act4 + $jrScore->act5 +
                    $jrScore->act6 + $jrScore->act7 + $jrScore->act8 + $jrScore->act9 + $jrScore->act10 +
                    $jrScore->act11 + $jrScore->act12 + $jrScore->act13 + $jrScore->act14 + $jrScore->act15;
            }
            if (empty($actTotalJr)) {
                $actTotalJr = 0;
                echo $actTotalJr;
            } else {
                echo $actTotalJr;
            }
            echo '</strong>
                  </td>
                  <td><strong>';
            echo $ps . '.00';
            echo ' </strong>
                  </td>
                  <td class="shsWs"';
            echo 'data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->actWs;
            }
            echo '"
            data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_s_h_ids_id;
            }
            echo '"><strong>';
            foreach ($jrHighScore as $jrScore) {
                $wsNew = $jrScore->actWs;
                echo $wsNew . '%';
            }
            echo '</strong>
                  </td>
                  
                  </tr>';



            foreach ($gradeSet as $grades) {

                $output2 = '
                                       <tr>
                                       <td data-label="Last Name">
                                        ' . $grades->lname . ', ' . $grades->fname . ' ' . $grades->mname . '
                                       </td>
                                       <td data-label="1">
                                        ' . ($grades->act_1 === '0' ? '' : $grades->act_1) . '
                                       </td>
                                       <td data-label="2">
                                        ' . ($grades->act_2 === '0' ? '' : $grades->act_2) . '
                                       </td>
                                       <td data-label="3">
                                       ' . ($grades->act_3 === '0' ? '' : $grades->act_3) . '
                                       </td>
                                       <td data-label="4">
                                       ' . ($grades->act_4 === '0' ? '' : $grades->act_4) . '
                                       </td>
                                       <td data-label="5">
                                       ' . ($grades->act_5 === '0' ? '' : $grades->act_5) . '
                                       </td>
                                       <td data-label="6">
                                       ' . ($grades->act_6 === '0' ? '' : $grades->act_6) . '
                                       </td>
                                       <td data-label="7">
                                       ' . ($grades->act_7 === '0' ? '' : $grades->act_7) . '
                                       </td>
                                       <td data-label="8">
                                       ' . ($grades->act_8 === '0' ? '' : $grades->act_8) . '
                                       </td>
                                       <td data-label="9">
                                       ' . ($grades->act_9 === '0' ? '' : $grades->act_9) . '
                                       </td>
                                       <td data-label="10">
                                       ' . ($grades->act_10 === '0' ? '' : $grades->act_10) . '
                                       </td>
                                       <td data-label="11">
                                       ' . ($grades->act_11 === '0' ? '' : $grades->act_11) . '
                                       </td>
                                       <td data-label="12">
                                       ' . ($grades->act_12 === '0' ? '' : $grades->act_12) . '
                                       </td>
                                       <td data-label="13">
                                       ' . ($grades->act_13 === '0' ? '' : $grades->act_13) . '
                                       </td>
                                       <td data-label="14">
                                       ' . ($grades->act_14 === '0' ? '' : $grades->act_14) . '
                                       </td>
                                       <td data-label="15">
                                       ' . ($grades->act_15 === '0' ? '' : $grades->act_15) . '
                                       </td>
                                       <td data-label="Total">
                                        <strong>';
                $output3 = intval($grades->act_1) + intval($grades->act_2) + intval($grades->act_3) + intval($grades->act_4) + intval($grades->act_5) + intval($grades->act_6) + intval($grades->act_7) + intval($grades->act_8) +
                    intval($grades->act_9) + intval($grades->act_10) + intval($grades->act_11) + intval($grades->act_12) + intval($grades->act_13) + intval($grades->act_14) + intval($grades->act_15);

                $output5 = '</strong>
                                       </td>
                                       <td data-label="PS"><strong>
                                        ' . $output3 . '.00' . '</strong>
                                       </td>
                                       <td data-label="WS"><strong>';

                if ($output3 === 0 || $actTotalJr === 0) {
                    $output7 = 0;
                } else {
                    $jrWs = ($output3 / $actTotalJr) * $wsNew;
                    $jrWsRound = round($jrWs, 2);
                    $output7 = $jrWsRound;
                }
                $output6 = '</strong>
                                       </td>
                                       
                                   </tr>';
                echo $output2 . $output3 . $output5 . $output7 . $output6;
            }
            $output4 = '
                            </tbody>
                        </table>     
                    </div>';
            echo $output4;
        }
    }

    public function loadGradesCollegeAll()
    {
        $gradeSource = $_POST['gradeSource'];
        $gradeQuarter = $_POST['gradeQuarter'];
        $currenSchoolYear = $_POST['schoolYear'];
        $currentTerm = $_POST['sem'];
        $subjectID = $_POST['subjectId'];

        $this->loadCollegeStudentsDataAll($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter,  $currentTerm);
    }

    public function loadCollegeStudentsDataAll($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter,  $currentTerm)
    {
        $gradeSet = $this->gradeModel->loadCollegeGrade($subjectID, $currenSchoolYear, $gradeSource, $gradeQuarter, $currentTerm);

        $jrHighScore = $this->gradeModel->getCollegeHighSCore($subjectID, $gradeSource, $gradeQuarter, $currenSchoolYear, $currentTerm);

        $collegeActCount = $this->gradeModel->countCollegeActivity($subjectID, $gradeQuarter, $gradeSource,  $currenSchoolYear, $currentTerm);

        $dataId = 0;
        $actTotalJr = 0;
        $ps = 100;
        $wsNew = 0;

        if (!empty($gradeSet)) {
            $output1 = '
                        <table class="tablesgrade" id="jrTable">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>
                                    <th>14</th>
                                    <th>15</th>
                                    <th>Total</th>
                                    
                                    <th>CS</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="gradesHigh">
                                        <strong>Highest Posible Grade</strong>
                                    </td>
                                    <td class="chs" data-row="1" data-column="1" data-id="';
            echo $output1;
            echo 0;
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act1Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act1Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act1 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="2" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act2Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act2Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act2 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="3" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act3Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act3Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act3 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="4" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act4Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act4Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act4 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="5" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act5Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act5Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act5 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="6" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act6Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act6Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act6 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="7" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act7Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act7Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act7 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="8" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act8Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act8Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act8 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="9" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act9Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act9Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act9 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="10" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act10Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act10Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act10 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="11" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act11Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act11Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act11 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="12" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act12Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act12Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act12 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="13" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act13Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act13Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act13 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="14" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act14Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act14Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act14 . '</strong>';
            }
            echo '</td>
                  <td class="chs" data-row="1" data-column="15" data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act15Id;
            }
            echo '"data-name="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->act15Name;
            }
            echo '">';
            foreach ($jrHighScore as $jrScore) {
                echo '<strong>' . $jrScore->act15 . '</strong>';
            }
            echo '</td>
                  
                  <td><strong>';
            echo $collegeActCount;
            echo ' </strong>
                  </td>
                  <td class="chsWs"';
            echo 'data-value="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->actWs;
            }
            echo '"
            data-id="';
            foreach ($jrHighScore as $jrScore) {
                echo $jrScore->g_c_h_ids_id;
            }
            echo '"><strong>';
            foreach ($jrHighScore as $jrScore) {
                $wsNew = $jrScore->actWs;
                echo $wsNew . '%';
            }
            echo '</strong>
                  </td>
                  
                  </tr>';



            foreach ($gradeSet as $grades) {

                $output2 = '
                                       <tr>
                                       <td data-label="Last Name">
                                        ' . $grades->lname . ', ' . $grades->fname . ' ' . $grades->mname . '
                                       </td>
                                       <td data-label="1">
                                        ' . ($grades->act_1 === '0' ? '' : $grades->act_1) . '
                                       </td>
                                       <td data-label="2">
                                        ' . ($grades->act_2 === '0' ? '' : $grades->act_2) . '
                                       </td>
                                       <td data-label="3">
                                       ' . ($grades->act_3 === '0' ? '' : $grades->act_3) . '
                                       </td>
                                       <td data-label="4">
                                       ' . ($grades->act_4 === '0' ? '' : $grades->act_4) . '
                                       </td>
                                       <td data-label="5">
                                       ' . ($grades->act_5 === '0' ? '' : $grades->act_5) . '
                                       </td>
                                       <td data-label="6">
                                       ' . ($grades->act_6 === '0' ? '' : $grades->act_6) . '
                                       </td>
                                       <td data-label="7">
                                       ' . ($grades->act_7 === '0' ? '' : $grades->act_7) . '
                                       </td>
                                       <td data-label="8">
                                       ' . ($grades->act_8 === '0' ? '' : $grades->act_8) . '
                                       </td>
                                       <td data-label="9">
                                       ' . ($grades->act_9 === '0' ? '' : $grades->act_9) . '
                                       </td>
                                       <td data-label="10">
                                       ' . ($grades->act_10 === '0' ? '' : $grades->act_10) . '
                                       </td>
                                       <td data-label="11">
                                       ' . ($grades->act_11 === '0' ? '' : $grades->act_11) . '
                                       </td>
                                       <td data-label="12">
                                       ' . ($grades->act_12 === '0' ? '' : $grades->act_12) . '
                                       </td>
                                       <td data-label="13">
                                       ' . ($grades->act_13 === '0' ? '' : $grades->act_13) . '
                                       </td>
                                       <td data-label="14">
                                       ' . ($grades->act_14 === '0' ? '' : $grades->act_14) . '
                                       </td>
                                       <td data-label="15">
                                       ' . ($grades->act_15 === '0' ? '' : $grades->act_15) . '
                                       </td>
                                       <td data-label="Total">
                                        <strong>';
                $output3 = intval($grades->act_1) + intval($grades->act_2) + intval($grades->act_3) + intval($grades->act_4) + intval($grades->act_5) + intval($grades->act_6) + intval($grades->act_7) + intval($grades->act_8) +
                    intval($grades->act_9) + intval($grades->act_10) + intval($grades->act_11) + intval($grades->act_12) + intval($grades->act_13) + intval($grades->act_14) + intval($grades->act_15);

                $output5 = '</strong>
                                       </td>
                                       
                                       <td data-label="WS"><strong>';

                if ($output3 === 0 || $collegeActCount === 0) {
                    $output7 = 0;
                } else {
                    $convertedNum  = convertToPercent($wsNew);
                    $jrWs = ($output3 / $collegeActCount) * $convertedNum;
                    $jrWsRound = round($jrWs, 2);
                    $output7 = $jrWsRound;
                }
                $output6 = '</strong>
                                       </td>
                                       
                                   </tr>';
                echo $output2 . $output3 . $output5 . $output7 . $output6;
            }
            $output4 = '
                            </tbody>
                        </table>     
                    </div>';
            echo $output4;
        }
    }

    public function getSeniorSubjectDataS()
    {
        $count = $_POST['count'];
        $programId = $_POST['programId'];

        $getSeniorSubjectData = $this->subjectsModel->getSeniorSubjectFromCourseS($programId);

        if ($getSeniorSubjectData) {
            echo  '<tr id="rows' . $count . '">';
            echo  '<td data-label="Subject" class="colSubject"><select id="gradeLevel' . $count . '" class="form-control"><option selected>Choose...</option>';
            foreach ($getSeniorSubjectData as $getSeniorSubjectData) {
                echo '<option value="' . $getSeniorSubjectData->code . '......' . $getSeniorSubjectData->description . '">' . $getSeniorSubjectData->code . ' - ' . $getSeniorSubjectData->description . '</option>';
            }
            '</select></td>';


            echo '<td data-label="1/3" contenteditable="true" class="first"></td>';
            echo ' <td data-label="2/4" contenteditable="true" class="second"></td>';
            echo '<td data-label="Final" contenteditable="true" class="final"></td>';
            echo  '<td><button type="button" name="remove" data-row="rows' . $count . '" class="btn btn-danger remove"><i class="fas fa-minus"></i></button></td>';
            echo  '</tr>';
        }
    }

    public function getHigherSubjectDataS()
    {
        $count = $_POST['count'];
        $programId = $_POST['programId'];

        $getSeniorSubjectData = $this->subjectsModel->getSubjectByCourseTransfer($programId);

        if ($getSeniorSubjectData) {
            echo  '<tr id="rows' . $count . '">';
            echo  '<td data-label="Subject" class="colSubject"><select id="gradeLevel' . $count . '" class="form-control"><option selected>Choose...</option>';
            foreach ($getSeniorSubjectData as $getSeniorSubjectData) {
                echo '<option value="' . $getSeniorSubjectData->code . '......' . $getSeniorSubjectData->description . '">' . $getSeniorSubjectData->code . ' - ' . $getSeniorSubjectData->description . '</option>';
            }
            '</select></td>';




            echo '<td data-label="Final" contenteditable="true" class="final"></td>';
            echo ' <td data-label="Re-exam" contenteditable="true" class="reexam"></td>';
            echo  '<td><button type="button" name="remove" data-row="rows' . $count . '" class="btn btn-danger remove"><i class="fas fa-minus"></i></button></td>';
            echo  '</tr>';
        }
    }

    public function insertMultySeniorRecord()
    {
        $schoolName = $_POST['schoolName'];
        $schoolYear = $_POST['schoolYear'];
        $gradeLevel = $_POST['gradeLevel'];
        $tableData = $_POST['tableData'];
        $infoId = $_POST['infoId'];
        $studentNo = $_POST['studentNo'];
        $sem = $_POST['sem'];
        $count = $_POST['count'];
        $insertCount = 0;

        $saveSchoolNAme = $this->schoolModel->saveSchoolNameS($schoolName, $studentNo, $gradeLevel, $sem);

        if ($saveSchoolNAme) {
            for ($count = 0; $count < count($tableData['final']); $count++) {
                $firstQ = $tableData['first'][$count];
                $secondQ = $tableData['second'][$count];
                $final = $tableData['final'][$count];
                $subject = $tableData['subject'][$count];


                $subDescrip = explode('......', $subject);


                $remarks = '';

                if ($final >= 75) {
                    $remarks = 'PASSED';
                } else {
                    $remarks = 'FAILED';
                }

                $insertSeniorDatas = $this->gradeModel->insertSeniorDatas($infoId, $studentNo,  $subDescrip[0],  $subDescrip[1], $sem, $gradeLevel, $firstQ, $secondQ, $final, $remarks, $schoolYear, $saveSchoolNAme);

                if ($insertSeniorDatas === true) {
                    $insertCount = $insertCount + 1;
                }
            }
        }

        if ($insertCount != $count) {
            echo 'Failed to insert ' . $count . ' records';
        } else {
            echo 'Seccessfully inserted ' . $count . ' records';
        }
    }

    public function insertMultyHigherRecord()
    {
        $schoolName = $_POST['schoolName'];
        $schoolYear = $_POST['schoolYear'];

        $tableData = $_POST['tableData'];
        $infoId = $_POST['infoId'];
        $studentNo = $_POST['studentNo'];
        $sem = $_POST['sem'];
        $count = $_POST['count'];
        $insertCount = 0;
        $programId = $_POST['programId'];
        $course = $_POST['course'];

        $saveSchoolNAme = $this->schoolModel->saveSchoolNameHigh($schoolName, $studentNo, $sem);

        if ($saveSchoolNAme) {
            for ($count = 0; $count < count($tableData['final']); $count++) {

                $final = $tableData['final'][$count];
                $reexam = $tableData['reexam'][$count];
                $subject = $tableData['subject'][$count];


                $subDescrip = explode('......', $subject);


                $remarks = '';

                if (is_numeric($final)) {

                    if ($final > 3) {
                        $remarks = 'FAILED';
                    } else {
                        $remarks = 'PASSED';
                    }
                } else {
                    if ($final === 'INC') {
                        $remarks = 'INCOMPLETE';
                    } else {
                        $remarks = 'FAILED';
                    }
                }


                $insertSeniorDatas = $this->gradeModel->insertHigherDatas($programId, $infoId, $studentNo,  $subDescrip[0],  $subDescrip[1], $sem, $course, $final, $remarks, $schoolYear, $saveSchoolNAme, $reexam);

                if ($insertSeniorDatas === true) {
                    $insertCount = $insertCount + 1;
                }
            }
        }

        if ($insertCount != $count) {
            echo 'Failed to insert ' . $count . ' records';
        } else {
            echo 'Seccessfully inserted ' . $count . ' records';
        }
    }

    public function updateSeniorGradeRecordsAll()
    {
        $recId = $_POST['recId'];
        $subject = $_POST['subject'];
        $gradeLevel = $_POST['gradeLevel'];
        $sem = $_POST['sem'];
        $schoolYear = $_POST['schoolYear'];
        $grade = $_POST['grade'];

        $newSubject = explode('......', $subject);

        $first = $grade['edit13'];
        $second = $grade['edit24'];
        $final = $grade['editFinal'];

        $updateSeniorGradeRecordsAll = $this->gradeModel->updateSeniorGradeRecordsAll($recId, $newSubject[0], $newSubject[1], $sem, $gradeLevel, $first, $second, $final, $schoolYear);

        if ($updateSeniorGradeRecordsAll) {
            echo 'Record successfully updated';
        } else {
            echo 'Failed to update record';
        }
    }

    public function deleteSeniorGradeRecordsAll()
    {
        $recId = $_POST['recId'];

        $deleteSeniorGradeRecordsAll = $this->gradeModel->deleteSeniorGradeRecordsAll($recId);

        if ($deleteSeniorGradeRecordsAll) {
            echo 'Record successfully deleted';
        } else {
            echo 'Failed to delete record';
        }
    }

    public function editSchoolSeniorGradeRecordsAll()
    {
        $schoolId = $_POST['schoolId'];
        $schoolName = $_POST['schoolName'];

        $editSchoolSeniorGradeRecordsAll = $this->schoolModel->editSchoolSeniorGradeRecordsAll($schoolId, $schoolName);

        if ($editSchoolSeniorGradeRecordsAll) {
            echo 'School name successfully updated';
        } else {
            echo 'Failed to update school name';
        }
    }

    public function enrollSenior()
    {
        $schedId = $_POST['schedId'];
        $semId = $_POST['semId'];
        $studentId = $_POST['studentId'];

        $enrolledSelectedSeniorHigh = $this->schoolModel->enrolledSelectedSeniorHigh($semId, $schedId, $studentId);

        if ($enrolledSelectedSeniorHigh) {
            echo 'Subject Schedule added to enrollee student';
        } else {
            echo 'Failed to add subject to enrollee student';
        }
    }

    public function enrollDeleteSenior()
    {
        $schedId = $_POST['schedId'];

        $deleteEnrolledSenior = $this->schoolModel->deleteEnrolledSenior($schedId);

        if ($deleteEnrolledSenior) {
            echo 'Subject enrolled successfully deleted';
        } else {
            echo 'Failed to delete subject enrolled';
        }
    }

    public function enrollSearchResult()
    {
        $searchField = $_POST['searchField'];
        $studentId = $_POST['studentId'];
        $programId = $_POST['programId'];

        $searchSeniorSubjects = $this->subjectsModel->searchSeniorSubjects($searchField, $studentId, $programId, $_SESSION['sem_name']);

        if ($searchSeniorSubjects) {
            echo '<div class="table-responsive mt-2">
            <table class="tablesgrade" id="insertData">
                <thead>
                    <tr>
                        <th width="10%">Code</th>
                        <th>Subject Name</th>
                        <th width="10%">Section</th>
                        <th>Schedule</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($searchSeniorSubjects as $seniorSched) {
                echo '<tr id="rows">
                    <td data-label="Code">'
                    . $seniorSched->subjectCode . '
                    </td>
                    <td data-label="Subject Name">';
                echo $seniorSched->subjectDescription . '
                    </td>
                    <td data-label="Section">'
                    . $seniorSched->year_level . ' - ' . $seniorSched->sec_code . '
                    </td>
                    <td data-label="Schedule">'
                    . $seniorSched->day . ' (' . $seniorSched->start . ' - ' . $seniorSched->end . ')
                    </td>
                    <td data-label="Action">
                        <button type="button" class="btn btn-primary addSched" data-id="' . $seniorSched->subject_sched_ID . '" data-year="' . $seniorSched->sem_id . '"><i class="fas fa-plus"></i> Add</button>
                    </td>
                </tr>';
            }
            echo '</tbody>
            </table>
        </div>
    </div>';
        } else {
            echo '<div class="table-responsive mt-2">
            <table class="tablesgrade" id="insertData">
                <thead>
                    <tr>
                        <th width="10%">Code</th>
                        <th>Subject Name</th>
                        <th width="10%">Section</th>
                        <th>Schedule</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>';


            echo '<tr id="rows">
                   
                </tr>';

            echo '</tbody>
            </table>
            <div class="mt-2">
            <h4>No data found</h4>
            </div>
        </div>
    </div>';
        }
    }

    public function enrollSearchResultHigh()
    {
        $searchField = $_POST['searchField'];
        $studentId = $_POST['studentId'];
        $programId = $_POST['programId'];

        $searchSeniorSubjects = $this->subjectsModel->getHigherAvailableSubjectSchedS($programId, $_SESSION['sem_name'], $studentId, $_SESSION['sem_termNum'], $searchField);

        if ($searchSeniorSubjects) {
            echo '<div class="table-responsive mt-2">
            <table class="tablesgrade" id="insertData">
                <thead>
                    <tr>
                        <th width="10%">Code</th>
                        <th>Subject Name</th>
                        <th width="10%">Section</th>
                        <th>Schedule</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($searchSeniorSubjects as $seniorSched) {
                echo '<tr id="rows">
                    <td data-label="Code">'
                    . $seniorSched->subjectCode . '
                    </td>
                    <td data-label="Subject Name">';
                echo $seniorSched->subjectDescription . '
                    </td>
                    <td data-label="Section">'
                    . $seniorSched->year_level . ' - ' . $seniorSched->sec_code . '
                    </td>
                    <td data-label="Schedule">'
                    . $seniorSched->day . ' (' . $seniorSched->start . ' - ' . $seniorSched->end . ')
                    </td>
                    <td data-label="Action">
                        <button type="button" class="btn btn-primary addSched" data-id="' . $seniorSched->subject_sched_ID . '" data-year="' . $seniorSched->sem_id . '"><i class="fas fa-plus"></i> Add</button>
                    </td>
                </tr>';
            }
            echo '</tbody>
            </table>
        </div>
    </div>';
        } else {
            echo '<div class="table-responsive mt-2">
            <table class="tablesgrade" id="insertData">
                <thead>
                    <tr>
                        <th width="10%">Code</th>
                        <th>Subject Name</th>
                        <th width="10%">Section</th>
                        <th>Schedule</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>';


            echo '<tr id="rows">
                   
                </tr>';

            echo '</tbody>
            </table>
            <div class="mt-2">
            <h4>No data found</h4>
            </div>
        </div>
    </div>';
        }
    }

    public function enrollHigh()
    {
        $schedId = $_POST['schedId'];
        $semId = $_POST['semId'];
        $studentId = $_POST['studentId'];

        $enrolledSelectedSeniorHigh = $this->schoolModel->enrolledSelectedHighStudent($semId, $schedId, $studentId);

        if ($enrolledSelectedSeniorHigh) {
            echo 'Subject Schedule added to enrollee student';
        } else {
            echo 'Failed to add subject to enrollee student';
        }
    }

    public function higherStudentList()
    {
        $searchField = $_POST['searchField'];

        $searchHigherListByLastName = $this->studentModel->searchHigherListByLastName($searchField);

        if ($searchHigherListByLastName) {
            echo '<div class="table-responsive mb-5">
            <table class="tablesgrade">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Course</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>';
            foreach ($searchHigherListByLastName as $studentList) {
                echo '<tr>
                    <td data-label="Full Name">
                        <a href="' . URLROOT . '/registrars/higher_transcrip/' . $studentList->infoId . '" class="text-body font-weight-bold">' . $studentList->lname . ', ' . $studentList->fname . ' ' . $studentList->mname . '</a>
                    </td>
                    <td data-label="Course">
                        ' . $studentList->progCode . '
                    </td>
                    <td data-label="Address">
                        ' . $studentList->add1 . '

                    </td>
                    <td data-label="View Records">
                        <a class="btn btn-danger" href="' . URLROOT . '/registrars/higher_transcript/' . $studentList->infoId . '" role="button"><i class="far fa-folder-open text-light fa-lg mr-1"></i> View</a>
                    </td>
                </tr>';
            }
            echo '</tbody>
            </table>
        </div>
    </div>';
        } else {
            echo '<h5 class="ml-1 mt-3 mb-3">No student available</h5>';
        }
    }

    public function higherSubjectFinalList()
    {
        $searchField = $_POST['searchField'];
        $getHigherSubjectFinalsS = $this->subjectsModel->getHigherSubjectFinalsS($searchField);

        if ($getHigherSubjectFinalsS) {
            echo '<div class="table-responsive mb-5">
            <table class="tables">
                <thead>
                    <tr>
                        <th>Subject Name</th>
                        <th>Year Level</th>
                        <th>Sem</th>
                        <th>School Year</th>
                        <th>Instructor</th>

                        <th width="10%">View</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($getHigherSubjectFinalsS as $higherSubjects) {
                echo '<tr>
                    <td data-label="Subject">
                        <a href="' . URLROOT . '/registrars/higher_submission_list/' . $higherSubjects->sched_id . '/' . $higherSubjects->semester . '/' . $higherSubjects->school_year . '" class="text-body font-weight-bold">' . $higherSubjects->subject_name . '</a>
                    </td>
                    <td data-label="Level">
                        ' . $higherSubjects->year_level . '

                    </td>
                    <td data-label="Sem">';
                if ($higherSubjects->semester == 1) {
                    echo 'First';
                } elseif ($higherSubjects->semester == 2) {
                    echo 'Second';
                } else {
                    echo 'Summer';
                }
                echo '
                    </td>
                    <td data-label="School Year">
                        ' . $higherSubjects->school_year . '

                    </td>
                    <td data-label="Instructor">
                        ' . $higherSubjects->lname . ', ' . $higherSubjects->fname . '

                    </td>
                    <td data-label="View Student">
                        <a class="btn btn-danger" href="' . URLROOT . '/registrars/higher_submission_list/' . $higherSubjects->sched_id . '/' . $higherSubjects->semester . '/' . $higherSubjects->school_year . '" role="button"><i class="fas fa-share-square text-light fa-lg mr-1"></i> View</a>
                    </td>
                </tr>';
            }
            echo '</tbody>
            </table>
        </div>';
        } else {
            echo '<h5 class="ml-1 mt-3 mb-3">No subject match</h5>';
        }
    }

    public function editGradingHigherFinalGrade()
    {
        $studentFinalList = $_POST['studentFinalList'];
        $grade = $_POST['grade'];

        $editGradingHigherFinalGrade = $this->gradeModel->editGradingHigherFinalGrade($studentFinalList, $grade);

        if ($editGradingHigherFinalGrade) {
            echo 'Grade successfully added';
        } else {
            echo 'Failed to add grade';
        }
    }

    public function higherStudentListOffline()
    {
        $searchField = $_POST['searchField'];

        $searchHigherListByLastName = $this->studentModel->searchHigherListByLastName($searchField);

        if ($searchHigherListByLastName) {
            echo '<div class="table-responsive mb-5">
            <table class="tablesgrade">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Course</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>';
            foreach ($searchHigherListByLastName as $studentList) {
                echo '<tr>
                    <td data-label="Full Name">
                        <a href="' . URLROOT . '/registrars/higher_offline/' . $studentList->infoId . '" class="text-body font-weight-bold">' . $studentList->lname . ', ' . $studentList->fname . ' ' . $studentList->mname . '</a>
                    </td>
                    <td data-label="Course">
                        ' . $studentList->progCode . '
                    </td>
                    <td data-label="Address">
                        ' . $studentList->add1 . '

                    </td>
                    <td data-label="View Records">
                        <a class="btn btn-danger" href="' . URLROOT . '/registrars/higher_offline/' . $studentList->infoId . '" role="button"><i class="far fa-folder-open text-light fa-lg mr-1"></i> View</a>
                    </td>
                </tr>';
            }
            echo '</tbody>
            </table>
        </div>
    </div>';
        } else {
            echo '<h5 class="ml-1 mt-3 mb-3">No student available</h5>';
        }
    }

    public function getHigherSubjectData()
    {
        $count = $_POST['count'];
        $programId = $_POST['programId'];

        $getSeniorSubjectData = $this->schoolModel->getCourseSubjectAssign($programId);

        if ($getSeniorSubjectData) {
            echo  '<tr id="rows' . $count . '">';
            echo  '<td data-label="Subject" class="colSubject"><select id="gradeLevel' . $count . '" class="form-control"><option selected>Choose...</option>';
            foreach ($getSeniorSubjectData as $getSeniorSubjectData) {
                echo '<option value="' . $getSeniorSubjectData->code . '......' . $getSeniorSubjectData->description . '......' . $getSeniorSubjectData->units . '">' . $getSeniorSubjectData->code . ' - ' . $getSeniorSubjectData->description . '</option>';
            }
            '</select></td>';
            echo  '<td data-label="Year Level" contenteditable="true" class="colYear"><select id="level' . $count . '" class="form-control"><option selected>Choose...</option><option value="1">First Year</option><option value="2">Second Year</option><option value="3">Third Year</option><option value="4">Fourth Year</option></select></td>';
            echo  '<td data-label="Semester" contenteditable="true" class="colSem"><select id="sem' . $count . '" class="form-control"><option selected>Choose...</option><option value="1">First</option><option value="2">Second</option><option value="3">Summer</option></select></td>';

            echo  '<td><button type="button" name="remove" data-row="rows' . $count . '" class="btn btn-danger remove"><i class="fas fa-minus"></i></button></td>';
            echo  '</tr>';
        }
    }

    public function insertHigherSubjects()
    {
        $tableData = $_POST['tableData'];
        $programId = $_POST['programId'];
        $counter = 0;

        for ($count = 0; $count < count($tableData['sem']); $count++) {
            $subject = $tableData['subject'][$count];
            $year = $tableData['year'][$count];
            $sem = $tableData['sem'][$count];


            $splitSubject = explode('......', $subject);

            $insertSeniorSubjectsList = $this->subjectsModel->insertHigherSubjectsList($programId, $splitSubject[0], $splitSubject[1], $year, $sem, $splitSubject[2]);

            if ($insertSeniorSubjectsList) {
                $counter = $counter + 1;
            }
        }

        if ($counter > 0) {
            echo $counter . ' subjects has been saved';
        } else {
            echo 'Failed to save subjects';
        }
    }

    public function higherStudentListRecords()
    {
        $searchField = $_POST['searchField'];

        $searchHigherListByLastName = $this->studentModel->searchHigherListByLastName($searchField);

        if ($searchHigherListByLastName) {
            echo '<div class="table-responsive mb-5">
            <table class="tablesgrade">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Course</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>';
            foreach ($searchHigherListByLastName as $studentList) {
                echo '<tr>
                    <td data-label="Full Name">
                        <a href="' . URLROOT . '/registrars/higher_transfer_record/' . $studentList->infoId . '" class="text-body font-weight-bold">' . $studentList->lname . ', ' . $studentList->fname . ' ' . $studentList->mname . '</a>
                    </td>
                    <td data-label="Course">
                        ' . $studentList->progCode . '
                    </td>
                    <td data-label="Address">
                        ' . $studentList->add1 . '

                    </td>
                    <td data-label="View Records">
                        <a class="btn btn-danger" href="' . URLROOT . '/registrars/higher_transfer_record/' . $studentList->infoId . '" role="button"><i class="far fa-folder-open text-light fa-lg mr-1"></i> View</a>
                    </td>
                </tr>';
            }
            echo '</tbody>
            </table>
        </div>
    </div>';
        } else {
            echo '<h5 class="ml-1 mt-3 mb-3">No student available</h5>';
        }
    }

    public function editSchoolHigherGradeRecordsAll()
    {
        $schoolId = $_POST['schoolId'];
        $schoolName = $_POST['schoolName'];

        $updateSchoolHigher = $this->schoolModel->updateSchoolHigher($schoolId, $schoolName);

        if ($updateSchoolHigher) {
            echo 'School successfully updated';
        } else {
            echo 'Failed to update school';
        }
    }

    public function deleteHigherGradeRecordsAll()
    {
        $recId = $_POST['recId'];

        $deleteHigherGradeTransfer = $this->gradeModel->deleteHigherGradeTransfer($recId);

        if ($deleteHigherGradeTransfer) {
            echo 'Record successfully deleted';
        } else {
            echo 'Failed to delete record';
        }
    }

    public function AddPost()
    {
        $title = $_POST['title'];
        $post = $_POST['post'];

        $getPostId = $this->userModel->getPostId($_SESSION['id']);

        if ($getPostId) {
            $name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
            $nameId = $getPostId->employee_id;

            $postNow = $this->postModel->postNow($nameId, $name, $title, $post);

            if ($postNow) {
                echo 'You successfully posted';
            } else {
                echo 'Failed to post';
            }
        }
    }

    public function AddPost1()
    {
        $title = $_POST['title'];
        $post = $_POST['post'];

        $getPostId = $this->userModel->getMyId($_SESSION['id']);

        if ($getPostId) {
            $name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
            $nameId = $getPostId->student_id;

            $postNow = $this->postModel->postNow($nameId, $name, $title, $post);

            if ($postNow) {
                echo 'You successfully posted';
            } else {
                echo 'Failed to post';
            }
        }
    }

    public function DeletePost()
    {
        $id = $_POST['id'];

        $deletePost = $this->postModel->deletePost($id);

        if ($deletePost) {
            echo 'Successfully deleted post';
        } else {
            echo 'Failed to delete post';
        }
    }

    public function sortSchedule()
    {
        $searchField = $_POST['searchField'];
        $department = $_SESSION['department'];
        $newDepartment = 'Senior High School';
        $dep = '';
        $schedData = new \stdClass;
        if ($department === 'Basic Education') {
            $schedData = $this->schoolModel->getSchedDataSeniorS($newDepartment, $_SESSION['sem_name'], $searchField);
        } else {
            $schedData = $this->schoolModel->getSchedDataHigherS($newDepartment, $_SESSION['sem_name'], $_SESSION['sem_termNum'], $searchField);
        }
        if ($_SESSION['department'] === 'Basic Education') {
            $dep = 'Teacher';
        } else {
            $dep = 'Intrcuctor';
        }


        if (!empty($schedData)) {
            echo '<div class="table-responsive mb-5">
            <table class="tablesgrade">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Section</th>
                        <th>Sched1</th>
                        <th>Sched2</th>
                        <th>
                            ' . $dep . '
                        </th>
                        <th width="5%">Assign</th>
                    </tr>
                </thead>
                <tbody>';
            foreach ($schedData as $subjectSchedule) {
                $day2 = '';
                if (empty($subjectSchedule->day2)) {
                    $day2 = 'None';
                } else {
                    $day2 = $subjectSchedule->day2 . ' / ' . $subjectSchedule->start2 . ' - ' . $subjectSchedule->end2;
                }
                echo '<tr>
                    <td data-label="Code">
                        ' . $subjectSchedule->subjectCode . '
                    </td>
                    <td data-label="Description">
                        ' . $subjectSchedule->subjectDes . '
                    </td>
                    <td data-label="Section">
                        ' . $subjectSchedule->courseCode . ' - ' . $subjectSchedule->year_level . ' - ' . $subjectSchedule->sec_code . '

                    </td>
                    <td data-label="Sched1">
                        ' . $subjectSchedule->day . ' / ' . $subjectSchedule->start . ' - ' . $subjectSchedule->end . '

                    </td>
                    <td data-label="Sched2">
                        ' . $day2 . '

                    </td>
                    <td data-label="Teacher">
                        ' . $subjectSchedule->first_name . '  ' . $subjectSchedule->last_name . '

                    </td>
                    <td data-label="Assign">
                        <button class="btn btn-info addIns" href="" data-id="' . $subjectSchedule->ssId . '" role="button"><i class="far fa-user"></i></button>
                    </td>
                </tr>';
            }
            echo '</tbody>
            </table>
        </div>
    </div>';
        } else {
        }
    }

    public function getTeachersByDep()
    {
        $depId = $_POST['depId'];

        $getInstructors = $this->schoolModel->getInstructors($depId);

        if ($getInstructors) {
            echo '<div class="form-group">
            <label for="exampleInputEmail1">Teacher</label>
            <select id="teachers" class="form-control subjectSelect">
                <option selected>Choose...</option>';
            foreach ($getInstructors as $getInstructorss) {
                echo '<option value="' . $getInstructorss->id . '">' . $getInstructorss->first_name . ' ' . $getInstructorss->last_name . '</option>';
            }
            echo '</select>
            </div>';
        } else {
            echo '<div class="form-group">
            <label for="exampleInputEmail1">Teacher</label>
            <select id="teachers" class="form-control subjectSelect">
                <option selected>Choose...</option>';

            echo '</select>
            </div>';
        }
    }

    public function addTeacherTosched()
    {
        $insId = $_POST['insId'];
        $schedId = $_POST['schedId'];

        $addTeacherToSched = $this->schoolModel->addTeacherToSched($insId, $schedId);

        if ($addTeacherToSched) {
            echo 'Successfully added teacher to subject';
        } else {
            echo 'Failed to add teacher to subject';
        }
    }

    public function addNewTeacher()
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $userId = $_POST['userId'];
        $department = $_POST['department'];

        $checkEmployeeId = $this->userModel->checkEmployeeId($userId);

        if ($checkEmployeeId) {
            $addNewTeacher = $this->userModel->addNewTeacher($fname, $lname, $userId, $department);

            if ($addNewTeacher) {
                echo 'Successfully added new teacher';
            } else {
                echo 'Failed to add new teacher';
            }
        } else {
            echo 'Emplyee id already exist';
        }
    }
}
