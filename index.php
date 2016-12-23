<?php

require("Collection.php");

$db = new PDO("mysql:host=localhost;dbname=test", "root", "");

$a = $db->query("SELECT * FROM articles");
$a = $a->fetchAll(PDO::FETCH_OBJ);

$b = $db->query("SELECT * FROM articles");
$b = $b->fetchAll(PDO::FETCH_OBJ);

$articles = new Collection($a);
$moreArticles = new Collection($b);

$articles = $articles->merge($moreArticles);

var_dump($articles);
