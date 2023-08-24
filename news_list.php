<?php
$page_title = "news list";
include "header.php";
?>

<div id="top"></div>

<?php
//connection to database
include "connection.php";

//getting the category id thorugh get method
if(isset($_GET["category_id"])) {
    $category_id = $_GET["category_id"];
    $query = "SELECT title, content, author, publication_date FROM news_articles WHERE category_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $stmt->bind_result($title, $content, $author, $publication_date);

    echo "<section>";
    while($stmt->fetch()) {
        
        echo "<h3>$title</h3>";
        echo "<p>$publication_date by $author</p><br>";
        echo "<p>$content</p><br><br>";
    }
    echo "</section>";

    $stmt->close();
    $conn->close();

}

?>

<a href="#top">Move to Top</a>

<?php
include "footer.php"
?>