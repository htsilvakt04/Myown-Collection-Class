<?php

require("Collection.php");

$db = new PDO("mysql:host=localhost;dbname=test", "root", "");

$a = $db->query("SELECT * FROM articles");
$a = $a->fetchAll(PDO::FETCH_OBJ);

$articles = new Collection($a);

foreach($articles->all() as $article) {
  echo $article->title;
}
