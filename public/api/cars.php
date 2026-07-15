<?php
declare(strict_types=1);
require_once __DIR__ . '/../../src/sql/db.php';
require_once __DIR__ . "/../../src/sql/read.php";
ini_set('display_errors', '1');
error_reporting(E_ALL);

$results = Search(
        $_GET["brand"] ?? "",
        $_GET["model_year"] ?? "",
        $_GET["regNum"] ?? "",
        $_GET['limit'] ?? "",
        $conn
    );

    header("Content-Type: application/json");
    // var_dump($results);
    echo json_encode($results);
    exit;
