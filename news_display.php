<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php" id="top">Home</a>
</body>
</html>

<?php
// Assume you have already established the database connection

include "connection.php";

$query = "SELECT article_id, title, content, author, publication_date FROM news_articles ORDER BY publication_date DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . $row["title"] . "</h2>";
        echo "<p>By " . $row["author"] . " on " . $row["publication_date"] . "</p>";
        echo "<p>" . $row["content"] . "</p>";
        echo "<hr>";
    }
} else {
    echo "No news articles found.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
</head>
<body>
    <a href="#top">
        Move to top of the page.
    </a>
</body>
</html>