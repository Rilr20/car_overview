<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="/public/css/style.min.css">
</head>

<body>

    <header>
        <h1 class="header-title">CAR.RILR20.ME</h1>
        <nav>
            <ul>
                <?php foreach ($pages as $key => $value) : ?>
                    <?php
                    if (isset($value["hidden"]) && $value["hidden"] === true) {
                        continue;
                    }
                    ?>
                    <li class="nav-link <?= (!isset($_GET['page']) && $key === 'index') || (isset($_GET['page']) && $_GET['page'] === $key) ? ' selected' : '' ?>">
                        <a href="?page=<?= $key ?>"><?= $value["title"] ?></a>
                    </li> <?php endforeach; ?>
            </ul>
            <div class="divider"></div>
        </nav>

    </header>