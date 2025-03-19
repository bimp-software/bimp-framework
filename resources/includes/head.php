<!doctype html>
<html lang="<?= get_bimp_lang(); ?>">
  <head>

    <meta charset="utf-8">

    <title><?= isset($build->title) ? $build->title : 'Bienvenido - '.get_sitename(); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php require_once INCLUDES.'styles.php'; ?>

    
</head>

<body>
<?php $slug = isset($build->slug) ? $build->slug : 'home'; ?>