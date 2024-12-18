<?php
// process_review.php

// Database connection
$host = '127.0.0.1';
$dbname = 'review_systems';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $review = htmlspecialchars($_POST['review']);

        // Insert data into the database
        $stmt = $pdo->prepare("INSERT INTO reviews (name, email, review) VALUES (:name, :email, :review)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':review', $review);
        $stmt->execute();

        echo "<div class='success'>Thank you for your review!</div>";
    }
} catch (PDOException $e) {
    echo "<div class='error'>Error: " . $e->getMessage() . "</div>";
}
?>

