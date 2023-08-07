<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>pagination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body >
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


<?php

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=sonatrach_trc_db;",$username,$password);
  

$resultp=5;

$results=$database->prepare("select * from candidat");
$results->execute();
$results=$results->rowCount();

if(!isset($_GET['page'])){
    $page=1;

}else{
    $page=$_GET['page'];

}

$totalPages= ceil($results /  $resultp);







$resultdb=$database->prepare("SELECT * from candidat LIMIT " . $resultp. " OFFSET " .($page-1)*$resultp );
$resultdb->execute();
foreach($resultdb  AS $result)
{
    echo '<div class="shadow shadow-hover p-3 mb-3 contanier m-auto" style="text-align:center; max-width:700px;">'. $result['nom'] . '</div>';
}




    echo'<main class=" contanier m-auto" style="text-align:center; max-width:700px;">';
    echo'<ul class="pagination justify-content-center">';

    $previouspage= $page - 1;
    echo'<li class="page-item">
    <a class="page-link" 
  
    href="index1.php?page='.$previouspage.'"> previous </a></li>';


    for( $count=1 ; $count<=$totalPages; ++$count){
   
    if($page == $count){
        echo' <li class="page-item contanier m-auto">';
       
        echo '<a class="  page-link contanier m-auto" style="color:black;" href="index1.php?page='.$count.'">'.$count.'</a> ';
        echo' </li>';
    }else{
        echo' <li class="page-item contanier m-auto">';
        echo '<a  class=" page-link contanier m-auto" 
        href="index1.php?page='.$count.'">'.$count.'</a> ';
        echo' </li>';
    }
   
   }
   $nextpage= $page + 1;
   echo'<li class="page-item">
   <a class="page-link" 
  
      href="index1.php?page='.$nextpage.'"> Next </a></li>';


   echo'</ul>';
   echo'</main>';












?>