<?php
$page_title = "NEWS";
include "header.php";
?>

<?php
// Assume you have already established the database connection
include "connection.php";

$query = "SELECT * FROM categories";
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($category_id, $category_name);

while($stmt->fetch()) {
    echo "<a href='news_list.php?category_id=$category_id'>$category_name</a><br>";
}

$stmt->close();
$conn->close();

?>

<?php
include "footer.php";
?>