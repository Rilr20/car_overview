<?php

$pageReference = $_GET["page"] ?? "index";

$base = basename(__FILE__, ".php");


$pages = [
    "index" => [
        "title" => "Home",
        "file" => __DIR__ . "/view/home.php",
    ],
    "cars" => [
        "title" => "Search",
        "file" => __DIR__ . "/view/search.php",
    ],
    "car-detail" => [
        "title" => "title", 
        "file" => __DIR__ . "/view/car-detail.php",
        "hidden" => true
    ],
    "about" => [
        "title" => "About",
        "file" => __DIR__ . "/view/about.php",
    ],
];

$page = $pages[$pageReference] ?? null;

$title = $page["title"] ?? "404";
$title .= " | car.rilr20.me";

// Render the page
require __DIR__ . "/view/header.php";
require __DIR__ . "/view/multipage.php";
require __DIR__ . "/view/footer.php";
