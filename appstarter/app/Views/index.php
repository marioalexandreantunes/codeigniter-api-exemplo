<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tempo <?= $location['region'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <p class="display-4 fw-lighter mt-4">Tempo para a cidade <strong> <?= $location['region'] ?></strong></p>
        <hr>
        <div class="row m-3 justify-content-center text-center">
            <p class="display-6 fw-lighter">agora</p>
            <div class="col-3 border border-primary rounded-1 text-center p-3">
                <img src="<?= $current['condition_icon']?>" alt="">
                <p class="fw-lighter"><?= $location['current_time']?></p>
                <hr class="mx-5">
                <p><?= $current['temperature']?>° max</p>
                <p><?= $current['condition']?></p>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- forecast -->
            <?php foreach($forecast as $day) : ?>
            <div class="col-2 border border-warning rounded-1 m-2 text-center p-3">
                <img src="<?= $day['condition_icon'] ?>">
                <h3 class="fw-lighter"><?= $day['condition'] ?></h3>
                <div class="text-center">
                    <p class="fw-light"><?= $day['date'] ?></p>
                </div>
                <hr class="mx-5">
                <div class="text-center">
                    <p class="fw-lighter">máxima: <?= $day['max_temp'] ?>&deg;</p>
                    <p class="fw-lighter">mínima: <?= $day['min_temp'] ?>&deg;</p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>