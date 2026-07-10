<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <header>
        <nav>
            <ul>
                <?php foreach ($pages as $key => $value) : ?>
                    <li><a href="?page=<?= $key ?>"><?= $value["title"] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>

    </header>