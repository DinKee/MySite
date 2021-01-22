<?php
    $id = $_GET['id'];
    require_once("dbconnect.inc");

    $sql = "DELETE FROM member WHERE m_id = $id";

    if (mysqli_query($link, $sql)) {

        mysqli_close($link);
        header('Location: member.php'); //If book.php is your main page where you list your all records
        exit;
    } else {
        echo "Error deleting record";
        echo $id;
    }
?>