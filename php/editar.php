<?php
require "config.php";

$info = [];
$id = filter_input(INPUT_GET, 'id');
if($id) {
    $sql = $pdo->prepare("SELECT = FROM usuarios WHERE id = :id");
    
}