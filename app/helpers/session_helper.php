<?php
session_start();

// Flash message helper
// EXAMPLE - flash('register_success', 'You are now registered');
// DISPLAY IN VIEW - echo flash('register_success');
function flash($name = '', $message = '', $class = 'alert alert-success')
{
  if (!empty($name)) {
    if (!empty($message) && empty($_SESSION[$name])) {
      if (!empty($_SESSION[$name])) {
        unset($_SESSION[$name]);
      }

      if (!empty($_SESSION[$name . '_class'])) {
        unset($_SESSION[$name . '_class']);
      }

      $_SESSION[$name] = $message;
      $_SESSION[$name . '_class'] = $class;
    } elseif (empty($message) && !empty($_SESSION[$name])) {
      $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
      echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
      unset($_SESSION[$name]);
      unset($_SESSION[$name . '_class']);
    }
  }
}

//Set if user is logged-in
function isLoggedIn($acLevel)
{
  if (!isset($_SESSION['id']) || $_SESSION['access_level'] != $acLevel) {
    return true;
  } else {
    return false;
  }
}

function setSessionPage($sessioName, $sessionValue)
{
  if (isset($_SESSION[$sessioName])) {
    unset($_SESSION[$sessioName]);
    $_SESSION[$sessioName] = $sessionValue;
  } else {
    $_SESSION[$sessioName] = $sessionValue;
  }
}

function isSessionPageSet($sessioName)
{
  if (empty($_SESSION[$sessioName])) {
    unset($_SESSION[$sessioName]);
    return true;
  }
}

function sessionPageUnset()
{
  if (isset($_SESSION['instructorID'])) {
    unset($_SESSION['instructorID']);
  }
  if (isset($_SESSION['myClassPage1'])) {
    unset($_SESSION['myClassPage1']);
  }
}

// function pageSessionChecker($sessioName)
// {
//   if (!isset($_SESSION[$sessioName])) {
//     return true;
//   } else {
//     return false;
//   }
// }

function transmuteGrade($initialGrade)
{
  $transmutedGrade = 0;

  if ($initialGrade === 100) {
    $transmutedGrade = 100;
  } elseif ($initialGrade <= 99.99 && $initialGrade >= 98.40) {
    $transmutedGrade = 99;
  } elseif ($initialGrade <= 98.39 && $initialGrade >= 96.80) {
    $transmutedGrade = 98;
  } elseif ($initialGrade <= 96.79 && $initialGrade >= 95.20) {
    $transmutedGrade = 97;
  } elseif ($initialGrade <= 95.19 && $initialGrade >= 93.60) {
    $transmutedGrade = 96;
  } elseif ($initialGrade <= 93.59 && $initialGrade >= 92.00) {
    $transmutedGrade = 95;
  } elseif ($initialGrade <= 91.99 && $initialGrade >= 90.40) {
    $transmutedGrade = 94;
  } elseif ($initialGrade <= 90.39 && $initialGrade >= 88.80) {
    $transmutedGrade = 93;
  } elseif ($initialGrade <= 88.79 && $initialGrade >= 87.20) {
    $transmutedGrade = 92;
  } elseif ($initialGrade <= 87.19 && $initialGrade >= 85.60) {
    $transmutedGrade = 91;
  } elseif ($initialGrade <= 85.59 && $initialGrade >= 84.00) {
    $transmutedGrade = 90;
  } elseif ($initialGrade <= 83.99 && $initialGrade >= 82.40) {
    $transmutedGrade = 89;
  } elseif ($initialGrade <= 82.39 && $initialGrade >= 80.80) {
    $transmutedGrade = 88;
  } elseif ($initialGrade <= 80.79 && $initialGrade >= 79.20) {
    $transmutedGrade = 87;
  } elseif ($initialGrade <= 79.19 && $initialGrade >= 77.60) {
    $transmutedGrade = 86;
  } elseif ($initialGrade <= 77.59 && $initialGrade >= 76.00) {
    $transmutedGrade = 85;
  } elseif ($initialGrade <= 75.99 && $initialGrade >= 74.40) {
    $transmutedGrade = 84;
  } elseif ($initialGrade <= 74.39 && $initialGrade >= 72.80) {
    $transmutedGrade = 83;
  } elseif ($initialGrade <= 72.79 && $initialGrade >= 71.20) {
    $transmutedGrade = 82;
  } elseif ($initialGrade <= 71.19 && $initialGrade >= 69.60) {
    $transmutedGrade = 81;
  } elseif ($initialGrade <= 69.59 && $initialGrade >= 68.00) {
    $transmutedGrade = 80;
  } elseif ($initialGrade <= 67.99 && $initialGrade >= 66.40) {
    $transmutedGrade = 79;
  } elseif ($initialGrade <= 66.39 && $initialGrade >= 64.80) {
    $transmutedGrade = 78;
  } elseif ($initialGrade <= 64.79 && $initialGrade >= 63.20) {
    $transmutedGrade = 77;
  } elseif ($initialGrade <= 63.19 && $initialGrade >= 61.60) {
    $transmutedGrade = 76;
  } elseif ($initialGrade <= 61.59 && $initialGrade >= 60.00) {
    $transmutedGrade = 75;
  } elseif ($initialGrade <= 59.99 && $initialGrade >= 56.00) {
    $transmutedGrade = 74;
  } elseif ($initialGrade <= 55.99 && $initialGrade >= 52.00) {
    $transmutedGrade = 73;
  } elseif ($initialGrade <= 51.99 && $initialGrade >= 48.00) {
    $transmutedGrade = 72;
  } elseif ($initialGrade <= 47.99 && $initialGrade >= 44.00) {
    $transmutedGrade = 71;
  } elseif ($initialGrade <= 43.99 && $initialGrade >= 40.00) {
    $transmutedGrade = 70;
  } elseif ($initialGrade <= 39.99 && $initialGrade >= 36.00) {
    $transmutedGrade = 69;
  } elseif ($initialGrade <= 35.99 && $initialGrade >= 32.00) {
    $transmutedGrade = 68;
  } elseif ($initialGrade <= 31.99 && $initialGrade >= 28.00) {
    $transmutedGrade = 67;
  } elseif ($initialGrade <= 27.99 && $initialGrade >= 24.00) {
    $transmutedGrade = 66;
  } elseif ($initialGrade <= 23.99 && $initialGrade >= 20.00) {
    $transmutedGrade = 65;
  } elseif ($initialGrade <= 19.99 && $initialGrade >= 16.00) {
    $transmutedGrade = 64;
  } elseif ($initialGrade <= 15.99 && $initialGrade >= 12.00) {
    $transmutedGrade = 63;
  } elseif ($initialGrade <= 11.99 && $initialGrade >= 8.00) {
    $transmutedGrade = 62;
  } elseif ($initialGrade <= 7.99 && $initialGrade >= 4.00) {
    $transmutedGrade = 61;
  } elseif ($initialGrade <= 3.99 && $initialGrade >= 0) {
    $transmutedGrade = 60;
  }

  return $transmutedGrade;
}

function finalGradeRemarks($finalGrade)
{
  $gradeRemarks = '';
  if ($finalGrade >= 75.00) {
    $gradeRemarks = 'PASSED';
  } elseif ($finalGrade < 75.00) {
    $gradeRemarks = 'FAILED';
  }
  return $gradeRemarks;
}

function convertToPercent($num)
{
  $percentNum = $num / 100;

  return $percentNum;
}

function convertCollegeGrade($average)
{
  $convertedCollegeAverage = 0;

  if ($average == 100) {
    $convertedCollegeAverage = 1.0;
  } elseif ($average <= 99 && $average >= 98) {
    $convertedCollegeAverage = 1.1;
  } elseif ($average == 97) {
    $convertedCollegeAverage = 1.2;
  } elseif ($average <= 96 && $average >= 95) {
    $convertedCollegeAverage = 1.3;
  } elseif ($average == 94) {
    $convertedCollegeAverage = 1.4;
  } elseif ($average == 93) {
    $convertedCollegeAverage = 1.5;
  } elseif ($average == 92) {
    $convertedCollegeAverage = 1.6;
  } elseif ($average == 91) {
    $convertedCollegeAverage = 1.7;
  } elseif ($average <= 90 && $average >= 89) {
    $convertedCollegeAverage = 1.8;
  } elseif ($average == 88) {
    $convertedCollegeAverage = 1.9;
  } elseif ($average == 87) {
    $convertedCollegeAverage = 2.0;
  } elseif ($average == 86) {
    $convertedCollegeAverage = 2.1;
  } elseif ($average == 85) {
    $convertedCollegeAverage = 2.2;
  } elseif ($average <= 84 && $average >= 83) {
    $convertedCollegeAverage = 2.3;
  } elseif ($average == 82) {
    $convertedCollegeAverage = 2.4;
  } elseif ($average == 81) {
    $convertedCollegeAverage = 2.5;
  } elseif ($average == 80) {
    $convertedCollegeAverage = 2.6;
  } elseif ($average == 79) {
    $convertedCollegeAverage = 2.7;
  } elseif ($average <= 78 && $average >= 77) {
    $convertedCollegeAverage = 2.8;
  } elseif ($average == 76) {
    $convertedCollegeAverage = 2.9;
  } elseif ($average == 75) {
    $convertedCollegeAverage = 3.0;
  } elseif ($average < 75) {
    $convertedCollegeAverage = 5.0;
  }

  return $convertedCollegeAverage;
}

function finalGradeRemarksCollege($finalGrade)
{
  $gradeRemarks = '';
  if ($finalGrade <= 3.0 && $finalGrade >= 1) {
    $gradeRemarks = 'PASSED';
  } elseif ($finalGrade > 3.0) {
    $gradeRemarks = 'FAILED';
  } elseif ($finalGrade === 0) {
    $gradeRemarks = 'INCOMPLETE';
  }

  return $gradeRemarks;
}
