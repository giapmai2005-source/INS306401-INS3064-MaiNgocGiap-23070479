<?php
// utils.php

// Sanitize input data
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Validate string length
function validateLength($str, $min, $max) {
    $length = strlen($str);
    return ($length >= $min && $length <= $max);
}

// Validate password
// Conditions:
// - Length >= 8
// - At least 1 special character
function validatePassword($pass) {
    if (strlen($pass) < 8) {
        return false;
    }

    // Check special character
    if (!preg_match('/[\W]/', $pass)) {
        return false;
    }

    return true;
}
?>
