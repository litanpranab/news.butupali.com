<?php
// Assume you have already established the database connection
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $author = $_POST["author"];
    $publication_date = date("Y-m-d H:i:s"); // Current date and time

    //convert user added newline to html br tag. Helps in formatting user data
    $content = nl2br($content);

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
    <title>User Post</title>
</head>

<body>
    <a href="news_display.php">
        <h1>View news</h1>
    </a>
    <h2>Submit your article</h2>

    <form action="news_insert.php" method="POST">
        <fieldset>
            <legend>article:</legend>
            Title: <br>
            <input type="text" name="title" required>
            <br>

            Content: <br>
            <textarea name="content" id="" placeholder="Type your article here..." cols="40" rows="30" required></textarea>
            <br>

            Author: <br>
            <input type="text" name="author" required>
            <br>

            <input type="submit" value="Publish">
            <input type="reset" value="Start Fresh">

        </fieldset>
    </form>
</body>

</html>