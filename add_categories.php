<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name =  $_POST["name"];

    $query = "INSERT INTO categories (name) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        echo "News category added successfully.<br>";
    } else {
        echo "Error adding news category:". $stmt->error;
    }

    $stmt->close();

}

$conn->close();

?>



<?php
$page_title = "add news";
include "header.php";
?>

    <form action="" method="POST">
        <fieldset>
            <legend>categories</legend>
            category name: <br>
            <input type="text" name="name" id="" required>
            <br>
            <input type="submit" value="Add">
        </fieldset>
    </form>

<?php
include "footer.php";
?>