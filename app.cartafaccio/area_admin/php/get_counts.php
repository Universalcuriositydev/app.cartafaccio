<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

include '../config.php';

$response = [];

try {
    $sql_articles = "SELECT COUNT(*) as count FROM articles";
    $result_articles = $conn->query($sql_articles);
    if (!$result_articles) {
        throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
    }
    $response['articles'] = $result_articles->fetch_assoc()['count'];

    $sql_courses = "SELECT COUNT(*) as count FROM courses";
    $result_courses = $conn->query($sql_courses);
    if (!$result_courses) {
        throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
    }
    $response['courses'] = $result_courses->fetch_assoc()['count'];

    $sql_books = "SELECT COUNT(*) as count FROM books";
    $result_books = $conn->query($sql_books);
    if (!$result_books) {
        throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
    }
    $response['books'] = $result_books->fetch_assoc()['count'];

    $sql_users = "SELECT COUNT(*) as count FROM users";
    $result_users = $conn->query($sql_users);
    if (!$result_users) {
        throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
    }
    $response['users'] = $result_users->fetch_assoc()['count'];

    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

$conn->close();
?>
