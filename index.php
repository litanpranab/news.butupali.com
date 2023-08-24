<?php
$page_title = "Parallel Universe";
include "header.php";
?>

<h1>Welcome to The Parallel Universe.</h1>
<?php
    date_default_timezone_set("Asia/Kolkata");
    echo "<p>". date("l h:ma") . "</p><br>";
?>

<?php
include "footer.php";
?>