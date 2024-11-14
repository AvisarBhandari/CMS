<?php
include '../db_connect.php';

// Fetch total courses
$totalCoursesQuery = "SELECT COUNT(*) AS total_courses FROM courses";
$totalCoursesResult = $conn->query($totalCoursesQuery);
$totalCoursesRow = $totalCoursesResult->fetch_assoc();
$totalCourses = $totalCoursesRow['total_courses'];

// Fetch active courses
$activeCoursesQuery = "SELECT COUNT(*) AS active_courses FROM courses WHERE status = 'active'";
$activeCoursesResult = $conn->query($activeCoursesQuery);
$activeCoursesRow = $activeCoursesResult->fetch_assoc();
$activeCourses = $activeCoursesRow['active_courses'];

// Fetch inactive courses
$inactiveCoursesQuery = "SELECT COUNT(*) AS inactive_courses FROM courses WHERE status = 'inactive'";
$inactiveCoursesResult = $conn->query($inactiveCoursesQuery);
$inactiveCoursesRow = $inactiveCoursesResult->fetch_assoc();
$inactiveCourses = $inactiveCoursesRow['inactive_courses'];

// Output the result as JSON
echo json_encode([
    'total_courses' => $totalCourses,
    'active_courses' => $activeCourses,
    'inactive_courses' => $inactiveCourses
]);

$conn->close();


