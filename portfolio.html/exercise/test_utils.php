<?php
// test_utils.php
require_once 'utils.php';

echo "<h2>Validation Utilities Test</h2>";

// Test sanitize()
$dirtyData = " <script>alert('XSS')</script> ";
$cleanData = sanitize($dirtyData);
echo "Sanitize Test: ";
echo ($cleanData !== $dirtyData) ? "PASS<br>" : "FAIL<br>";

// Test validateEmail()
echo "Validate Email Test 1 (valid): ";
echo validateEmail("test@example.com") ? "PASS<br>" : "FAIL<br>";

echo "Validate Email Test 2 (invalid): ";
echo !validateEmail("test@com") ? "PASS<br>" : "FAIL<br>";

// Test validateLength()
echo "Validate Length Test 1 (within range): ";
echo validateLength("Hello", 3, 10) ? "PASS<br>" : "FAIL<br>";

echo "Validate Length Test 2 (out of range): ";
echo !validateLength("Hi", 3, 10) ? "PASS<br>" : "FAIL<br>";

// Test validatePassword()
echo "Validate Password Test 1 (strong): ";
echo validatePassword("Pass@123") ? "PASS<br>" : "FAIL<br>";

echo "Validate Password Test 2 (no special char): ";
echo !validatePassword("Password123") ? "PASS<br>" : "FAIL<br>";

echo "Validate Password Test 3 (too short): ";
echo !validatePassword("Ab@1") ? "PASS<br>" : "FAIL<br>";
?>
