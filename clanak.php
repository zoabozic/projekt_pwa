<?php
include 'connect.php';
define('UPLPATH', 'images/');

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$query  = "SELECT * FROM vijesti WHERE id=$id LIMIT 1";
$result = mysqli_query($dbc, $query) or die('Greška u upitu prema bazi.');
$row    = mysqli_fetch_array($result);

if (!$row) {
    $page_title = 'Vijest nije pronađena';
    include 'header.php';
    echo '<p>Tražena vijest ne postoji ili je uklonjena.</p>';
    mysqli_close($dbc);
    include 'footer.php';
    exit;
}

$page_title = $row['naslov'];
include 'header.php';
?>

  <p class="eyebrow"><?php echo htmlspecialchars($row['kategorija']); ?></p>

  <div class="article-layout">

    <article id="main-article">
      <header>
        <h1><?php echo htmlspecialchars($row['naslov']); ?></h1>
        <p class="article-meta">Objavljeno: <?php echo htmlspecialchars($row['datum']); ?></p>
      </header>

      <figure class="article-figure">
        <img src="<?php echo UPLPATH . htmlspecialchars($row['slika']); ?>" alt="<?php echo htmlspecialchars($row['naslov']); ?>">
      </figure>

      <span class="tag-badge"><?php echo htmlspecialchars($row['kategorija']); ?></span>

      <p><em><?php echo htmlspecialchars($row['sazetak']); ?></em></p>

      <p><?php echo nl2br(htmlspecialchars($row['tekst'])); ?></p>
    </article>

    <aside class="related">
      <h2>Slične vijesti</h2>
      <ul>
        <?php
        $kategorija_safe = mysqli_real_escape_string($dbc, $row['kategorija']);
        $query2  = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='$kategorija_safe' AND id!=$id ORDER BY id DESC LIMIT 3";
        $result2 = mysqli_query($dbc, $query2);

        if (mysqli_num_rows($result2) === 0) {
            echo '<li>Trenutno nema drugih vijesti u ovoj kategoriji.</li>';
        }

        while ($r2 = mysqli_fetch_array($result2)) {
            echo '<li>';
            echo '  <span>' . htmlspecialchars($r2['kategorija']) . '</span>';
            echo '  <a href="clanak.php?id=' . $r2['id'] . '">' . htmlspecialchars($r2['naslov']) . '</a>';
            echo '</li>';
        }
        ?>
      </ul>
    </aside>

  </div>

<?php
mysqli_close($dbc);
include 'footer.php';
?>
