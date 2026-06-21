<?php
include 'connect.php';
define('UPLPATH', 'images/');

$dozvoljene_kategorije = array('sport', 'kultura');

$kategorija = isset($_GET['kategorija']) ? $_GET['kategorija'] : '';
if (!in_array($kategorija, $dozvoljene_kategorije)) {
    $kategorija = 'sport';
}

$page_title = ucfirst($kategorija);
include 'header.php';
?>

  <section class="category-section">
    <header>
      <h2><?php echo htmlspecialchars(ucfirst($kategorija)); ?></h2>
    </header>
    <div class="card-grid">
      <?php
      $kategorija_safe = mysqli_real_escape_string($dbc, $kategorija);
      $query  = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='$kategorija_safe' ORDER BY id DESC";
      $result = mysqli_query($dbc, $query) or die('Greška u upitu prema bazi.');

      if (mysqli_num_rows($result) === 0) {
          echo '<p>Trenutno nema objavljenih vijesti u ovoj kategoriji.</p>';
      }

      while ($row = mysqli_fetch_array($result)) {
          echo '<article class="card">';
          echo '  <a href="clanak.php?id=' . $row['id'] . '">';
          echo '    <img class="card-thumb" src="' . UPLPATH . htmlspecialchars($row['slika']) . '" alt="' . htmlspecialchars($row['naslov']) . '">';
          echo '    <h3>' . htmlspecialchars($row['naslov']) . '</h3>';
          echo '  </a>';
          echo '</article>';
      }
      ?>
    </div>
  </section>

<?php
mysqli_close($dbc);
include 'footer.php';
?>
