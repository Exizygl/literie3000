<?php
if (isset($_GET["id"])) {
    $dsn = "mysql:host=localhost;dbname=literie";
    $db = new PDO($dsn, "root", "");

    $query = $db->prepare("DELETE FROM matelas WHERE id = :id");
    $query->bindParam(":id", $_GET["id"], PDO::PARAM_INT);
    $query->execute();
    header("Location: index.php");
}else{
    header("Location: index.php");
}

?>