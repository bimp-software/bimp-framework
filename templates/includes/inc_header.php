<!DOCTYPE html>
<html lang="<?php echo SITE_LANG; ?>">
<head>
    <base href="<?php echo BASEPATH; ?>">

    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php echo isset($d->title) ? $d->title.' - '.get_sitename() : 'Bienvenido - '.get_sitename(); ?></title>
    
    <link rel="shortcut icon" href="<?php echo FAVICON ?>icono-bimp.png">

    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

    <meta name="description" content="<?php  echo isset($d->description) ? $d->description : '-'; ?>">

    <meta http-equiv="cache-control" content="no-store, no-cache, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    
    <link rel="stylesheet" href="<?php echo CSS ?>style.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
</head>

<body <?php echo isset($d->backgraund) ? 'class="'.$d->backgraund.'"'  : ''; ?>>
    <?php  $slug = isset($d->slug) ? $d->slug : 'home'; ?>