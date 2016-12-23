<?php

require("Collection.php");

$db = new PDO("mysql:host=localhost;dbname=test", "root", "");

$a = $db->query("SELECT * FROM articles");
$a = $a->fetchAll(PDO::FETCH_OBJ);

$articles = new Collection($a);

$articles = $articles->filter(function ($article) {
  return $article->id > 1;
});

var_dump($articles->last());
