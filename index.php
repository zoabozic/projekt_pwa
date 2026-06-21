<?php
include 'connect.php';
define('UPLPATH', 'images/');
$page_title = 'Naslovnica';
include 'header.php';
?>

  <section class="category-section" id="rubrika-sport">
    <header>
      <h2>Sport</h2>
    </header>
    <div class="card-grid">
      <?php
      $query  = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='sport' ORDER BY id DESC LIMIT 3";
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

  <section class="category-section" id="rubrika-kultura">
    <header>
      <h2>Kultura</h2>
    </header>
    <div class="card-grid">
      <?php
      $query  = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='kultura' ORDER BY id DESC LIMIT 3";
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
