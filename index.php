<?php
require "./core/App.php";
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/main.css">
    <title>Tournament Table</title>
</head>
<body>
<table class="table" id="result-table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">City</th>
        <th scope="col">Car</th>
        <?php
        $result = App::getResultArray();
        for ($i = 1; $i <= App::getMaxAttempts($result); $i++) { ?>
            <th scope="col" onclick="sortTable(<?=$i+3?>)" class="sorted">Attempt #<?= $i ?></th>
        <?php } ?>
        <th scope="col" onclick="sortTable(<?=$i+3?>)" class="sorted">Total points</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 1;
    foreach ($result as $value) {
        ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $value['name'] ?></td>
            <td><?= $value['city'] ?></td>
            <td><?= $value['car'] ?></td>
            <?php for ($j = 0; $j < App::getMaxAttempts($result); $j++) { ?>
                <td><?= $value['attempts'][$j] ?? 0 ?></td>
            <?php } ?>
            <td><?= $value['total'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<script src="script/main.js"></script>
</body>
</html>