<?php

require_once('dbcon.php');

$head = htmlspecialchars($_POST['posttitle'], ENT_HTML5, "UTF-8");
$owner = htmlspecialchars($_POST['username'], ENT_HTML5, "UTF-8");
$content = mb_convert_encoding(htmlspecialchars($_POST['postcontent'], ENT_HTML5, "UTF-8"),"UTF-8");
echo "$content";
$query = "INSERT INTO posts(heading,owner,date,content) VALUES('$head','$owner',CURRENT_TIMESTAMP,'$content');";
mysqli_query($con, $query) or die("Error posting..");
echo "<br/>Post Submitted Successfully<br/>";
header("location:studentwall.php");

/*
 */
?>


