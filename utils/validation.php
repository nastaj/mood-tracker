<?php
function sanitize($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

function validateRequired($value, $fieldName) {
    if (empty(trim($value))) {
        return "$fieldName is required.";
    }
    return null;
}

function validateEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Please enter a valid email address.";
    }
    return null;
}

function validateMinLength($value, $min, $fieldName) {
    if (strlen($value) < $min) {
        return "$fieldName must be at least $min characters.";
    }
    return null;
}

function validateMaxLength($value, $max, $fieldName) {
    if (strlen($value) > $max) {
        return "$fieldName must be at most $max characters.";
    }
    return null;
}

function validateNumberRange($number, $min, $max, $fieldName) {
    if (!is_numeric($number) || $number < $min || $number > $max) {
        return "$fieldName must be between $min and $max.";
    }
    return null;
}
