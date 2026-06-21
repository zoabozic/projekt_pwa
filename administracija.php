<?php
session_start();
include 'connect.php';
define('UPLPATH', 'images/');

$loginGreska = '';

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: administracija.php');
    exit;
}

if (isset($_POST['prijava'])) {
    $unesenoIme     = $_POST['username'];
    $unesenaLozinka = $_POST['lozinka'];

    $sql  = "SELECT id, ime, prezime, korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 's', $unesenoIme);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $id, $ime, $prezime, $korisnickoIme, $lozinkaHash, $razina);
    mysqli_stmt_fetch($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0 && password_verify($unesenaLozinka, $lozinkaHash)) {
        $_SESSION['user_id']  = $id;
        $_SESSION['ime']      = $ime;
        $_SESSION['username'] = $korisnickoIme;
        $_SESSION['razina']   = (int) $razina;
    } else {
        $loginGreska = 'Korisničko ime i/ili lozinka nisu ispravni.';
    }

    mysqli_stmt_close($stmt);
}

$prijavljen = isset($_SESSION['username']);
$jeAdmin    = $prijavljen && (int) $_SESSION['razina'] === 1;
if ($jeAdmin && isset($_POST['delete'])) {
    $id   = (int) $_POST['id'];
    $sql  = "DELETE FROM vijesti WHERE id = ?";
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt) or die('Greška prilikom brisanja.');
    mysqli_stmt_close($stmt);
}

if ($jeAdmin && isset($_POST['update'])) {
    $id       = (int) $_POST['id'];
    $title    = $_POST['title'];
    $about    = $_POST['about'];
    $content  = $_POST['content'];
    $category = $_POST['category'];
    $archive  = isset($_POST['archive']) ? 1 : 0;

    if (!empty($_FILES['pphoto']['name'])) {
        $picture = $_FILES['pphoto']['name'];
        move_uploaded_file($_FILES['pphoto']['tmp_name'], UPLPATH . $picture);

        $sql  = "UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, slika=?, kategorija=?, arhiva=? WHERE id=?";
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'sssssii', $title, $about, $content, $picture, $category, $archive, $id);
    } else {
        $sql  = "UPDATE vijesti SET naslov=?, sazetak=?, tekst=?, kategorija=?, arhiva=? WHERE id=?";
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssii', $title, $about, $content, $category, $archive, $id);
    }

    mysqli_stmt_execute($stmt) or die('Greška prilikom izmjene.');
    mysqli_stmt_close($stmt);
}

$page_title = 'Administracija';
include 'header.php';
?>

  <h1>Administracija vijesti</h1>

  <?php if (!$prijavljen): ?>

    <?php if ($loginGreska): ?>
      <p class="form-message form-message-error">
        Niste registrirani ili je korisničko ime/lozinka neispravno. Molimo
        <a href="registracija.php">registrirajte se</a> ili pokušajte ponovno.
      </p>
    <?php endif; ?>

    <p>Za pristup administraciji potrebno je prijaviti se.</p>

    <form class="admin-form" action="administracija.php" method="POST" autocomplete="off">

      <div class="form-item">
        <label for="username">Korisničko ime</label>
        <div class="form-field">
          <input type="text" id="username" name="username" class="form-field-textual" required autofocus>
        </div>
      </div>

      <div class="form-item">
        <label for="lozinka">Lozinka</label>
        <div class="form-field">
          <input type="password" id="lozinka" name="lozinka" class="form-field-textual" required>
        </div>
      </div>

      <div class="form-item">
        <button type="submit" name="prijava" value="1">Prijava</button>
      </div>

    </form>

    <p>Nemate korisnički račun? <a href="registracija.php">Registrirajte se</a>.</p>

  <?php elseif (!$jeAdmin): ?>

    <p>Bok, <?php echo htmlspecialchars($_SESSION['ime']); ?>! Uspješno ste prijavljeni, ali nemate administratorska prava za pristup ovoj stranici.</p>
    <p><a href="administracija.php?logout=1">Odjava</a></p>

  <?php else: ?>

    <p>
      Prijavljeni ste kao <strong><?php echo htmlspecialchars($_SESSION['ime']); ?></strong> &middot;
      <a href="administracija.php?logout=1">Odjava</a>
    </p>
    <p>Uredite postojeće vijesti, promijenite kategoriju ili arhivu, ili ih izbrišite.</p>

    <?php
    $query  = "SELECT * FROM vijesti ORDER BY id DESC";
    $result = mysqli_query($dbc, $query) or die('Greška u upitu prema bazi.');

    while ($row = mysqli_fetch_array($result)) {
        echo '<form class="admin-form" enctype="multipart/form-data" action="administracija.php" method="POST">';

        echo '  <div class="form-item">';
        echo '    <label for="title">Naslov vijesti</label>';
        echo '    <div class="form-field">';
        echo '      <input type="text" name="title" class="form-field-textual" value="' . htmlspecialchars($row['naslov']) . '">';
        echo '    </div>';
        echo '  </div>';

        echo '  <div class="form-item">';
        echo '    <label for="about">Kratki sažetak</label>';
        echo '    <div class="form-field">';
        echo '      <textarea name="about" cols="30" rows="4" class="form-field-textual">' . htmlspecialchars($row['sazetak']) . '</textarea>';
        echo '    </div>';
        echo '  </div>';

        echo '  <div class="form-item">';
        echo '    <label for="content">Sadržaj vijesti</label>';
        echo '    <div class="form-field">';
        echo '      <textarea name="content" cols="30" rows="6" class="form-field-textual">' . htmlspecialchars($row['tekst']) . '</textarea>';
        echo '    </div>';
        echo '  </div>';

        echo '  <div class="form-item">';
        echo '    <label for="pphoto">Slika (ostavi prazno za zadržavanje postojeće)</label>';
        echo '    <div class="form-field">';
        echo '      <input type="file" name="pphoto" class="form-field-textual">';
        echo '      <img src="' . UPLPATH . htmlspecialchars($row['slika']) . '" width="100" alt="trenutna slika">';
        echo '    </div>';
        echo '  </div>';

        echo '  <div class="form-item">';
        echo '    <label for="category">Kategorija</label>';
        echo '    <div class="form-field">';
        echo '      <select name="category" class="form-field-textual">';
        echo '        <option value="sport"' . ($row['kategorija'] === 'sport' ? ' selected' : '') . '>Sport</option>';
        echo '        <option value="kultura"' . ($row['kategorija'] === 'kultura' ? ' selected' : '') . '>Kultura</option>';
        echo '      </select>';
        echo '    </div>';
        echo '  </div>';

        echo '  <div class="form-item">';
        echo '    <label class="checkbox-label">';
        echo '      <input type="checkbox" name="archive"' . ($row['arhiva'] == 1 ? ' checked' : '') . '> Arhiviraj (skrij s naslovnice)';
        echo '    </label>';
        echo '  </div>';

        echo '  <div class="form-item">';
        echo '    <input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '    <button type="submit" name="update" value="Prihvati">Spremi izmjene</button>';
        echo '    <button type="submit" name="delete" value="Izbriši" onclick="return confirm(\'Sigurno želite izbrisati ovu vijest?\');">Izbriši</button>';
        echo '  </div>';

        echo '</form>';
        echo '<hr>';
    }
    ?>

  <?php endif; ?>

<?php
mysqli_close($dbc);
include 'footer.php';
?>
