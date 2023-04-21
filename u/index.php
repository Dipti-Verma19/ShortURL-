<?php 
require "../config.php";
?>

<?php

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $select = $conn->query("select * from urls where id='$id'");
    $select->execute();

    $data = $select->fetch(PDO:: FETCH_OBJ);
    $click = $data->clicks + 1;
    $update = $conn->prepare("update urls set clicks = :clicks where id= '$id'");
    $update->execute([
        ':clicks' => $click
    ]);
    header("location: ".$data->url."");

}
?>