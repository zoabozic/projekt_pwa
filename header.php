<?php

$current_file = basename($_SERVER['PHP_SELF']);
$current_kat  = isset($_GET['kategorija']) ? $_GET['kategorija'] : '';
?>
<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' — Glasnik' : 'Glasnik'; ?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Gasoek+One&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="images/megaphone-icon-3d-png.png">
</head>
<body>

  <header id="site-header">
    <div class="masthead">
      <span class="masthead-date"><?php echo date('d.m.Y.'); ?></span>
      <span class="site-logo">Glasnik</span>
    </div>
    <nav class="site-nav">
      <ul>
        <li>
          <a class="nav-link<?php echo $current_file === 'index.php' ? ' is-active' : ''; ?>" href="index.php">Home</a>
        </li>
        <li>
          <a class="nav-link<?php echo ($current_file === 'kategorija.php' && $current_kat === 'sport') ? ' is-active' : ''; ?>" href="kategorija.php?kategorija=sport">Sport</a>
        </li>
        <li>
          <a class="nav-link<?php echo ($current_file === 'kategorija.php' && $current_kat === 'kultura') ? ' is-active' : ''; ?>" href="kategorija.php?kategorija=kultura">Kultura</a>
        </li>
        <li>
          <a class="nav-link<?php echo $current_file === 'unos.php' ? ' is-active' : ''; ?>" href="unos.php">Unos vijesti</a>
        </li>
        <li>
          <a class="nav-link<?php echo $current_file === 'administracija.php' ? ' is-active' : ''; ?>" href="administracija.php">Administracija</a>
        </li>
        <li>
          <a class="nav-link<?php echo $current_file === 'registracija.php' ? ' is-active' : ''; ?>" href="registracija.php">Registracija</a>
        </li>
      </ul>
    </nav>
  </header>

  <main>
