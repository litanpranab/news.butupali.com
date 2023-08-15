<?php
// Assume you have already established the database connection
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $author = $_POST["author"];
    $publication_date = date("Y-m-d H:i:s"); // Current date and time

    $query = "INSERT INTO news_articles (title, content, author, publication_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $title, $content, $author, $publication_date);

    if ($stmt->execute()) {
        echo "News article added successfully.";
    } else {
        echo "Error adding news article: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adding news</title>
</head>
<body>
    <a href="index.html"><h1>Home</h1></a>
    <a href="news_display.php"><h1>view news</h1></a>
</body>
</html>
