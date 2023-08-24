<?php
// Assume you have already established the database connection
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $category = $_POST["category"];
    $content = $_POST["content"];
    $author = $_POST["author"];
    $publication_date = date("Y-m-d H:i:s"); // Current date and time

    //convert user added newline to html br tag. Helps in formatting user data
    $content = nl2br($content);

    //getting category_id from category
    $category_query = "SELECT id FROM categories where name= ?";
    $stmt = $conn->prepare($category_query);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $stmt->bind_result($category_id);
    $stmt->fetch();
    $stmt->close();

    $query = "INSERT INTO news_articles (title,category_id , content, author, publication_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sisss", $title,$category_id, $content, $author, $publication_date);

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

<?php
$page_title = "Add news";
include "header.php";
?>
    <h2>Submit your article</h2>

    <form action="news_insert.php" method="POST">
        <fieldset>
            <legend>article:</legend>
            Title: <br>
            <input type="text" name="title" required>
            <br>
            <?php
            //make a connection to the database
            include "connection.php";

            $query = "SELECT name as category_name FROM categories";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->bind_result($category_name);

            echo "Category: <br>";
            echo "<select name='category' id='' required>";
            echo "<option value='' disabled hidden selected>Choose here</option>";
            while($stmt->fetch()) {
                echo "<option value='$category_name'>$category_name</option>";
            }

            echo "</select><br>";
            $stmt->close();
            $conn->close();

            ?>

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

<?php
include "footer.php";
?>