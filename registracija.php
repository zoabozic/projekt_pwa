<?php
include 'connect.php';

$registriranKorisnik = false;
$poruka = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime      = trim($_POST['ime']);
    $prezime  = trim($_POST['prezime']);
    $username = trim($_POST['username']);
    $pass     = $_POST['pass'];
    $passRep  = $_POST['passRep'];

    if ($ime === '' || $prezime === '' || $username === '' || $pass === '' || $passRep === '') {
        $poruka = 'Sva polja su obavezna.';
    } elseif ($pass !== $passRep) {
        $poruka = 'Lozinke se ne podudaraju.';
    } else {
        $sql  = "SELECT id FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $poruka = 'Korisničko ime već postoji. Odaberite drugo.';
            mysqli_stmt_close($stmt);
        } else {
            mysqli_stmt_close($stmt);
            $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
            $razina = 0;

            $sql  = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($dbc);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $username, $hashedPassword, $razina);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $registriranKorisnik = true;
        }
    }
}

mysqli_close($dbc);

$page_title = 'Registracija';
include 'header.php';
?>

  <h1>Registracija korisnika</h1>

  <?php if ($registriranKorisnik): ?>

    <p class="form-message">Uspješno ste se registrirali. Sada se možete <a href="administracija.php">prijaviti</a>.</p>

  <?php else: ?>

    <?php if ($poruka): ?>
      <p class="form-message form-message-error"><?php echo htmlspecialchars($poruka); ?></p>
    <?php endif; ?>

    <form name="registracija" class="admin-form" action="registracija.php" method="POST" autocomplete="off">

      <div class="form-item">
        <label for="ime">Ime</label>
        <div class="form-field">
          <input type="text" id="ime" name="ime" class="form-field-textual" required autofocus>
        </div>
      </div>

      <div class="form-item">
        <label for="prezime">Prezime</label>
        <div class="form-field">
          <input type="text" id="prezime" name="prezime" class="form-field-textual" required>
        </div>
      </div>

      <div class="form-item">
        <label for="username">Korisničko ime</label>
        <div class="form-field">
          <input type="text" id="username" name="username" class="form-field-textual" required>
        </div>
      </div>

      <div class="form-item">
        <label for="pass">Lozinka</label>
        <div class="form-field">
          <input type="password" id="pass" name="pass" class="form-field-textual" required>
        </div>
      </div>

      <div class="form-item">
        <label for="passRep">Ponovite lozinku</label>
        <div class="form-field">
          <input type="password" id="passRep" name="passRep" class="form-field-textual" required>
        </div>
      </div>

      <div class="form-item">
        <button type="submit" id="slanje">Registriraj se</button>
      </div>

    </form>

    <script>
      document.getElementById('slanje').addEventListener('click', function (event) {
        var pass    = document.getElementById('pass').value;
        var passRep = document.getElementById('passRep').value;

        if (pass.length === 0 || passRep.length === 0 || pass !== passRep) {
          event.preventDefault();
          alert('Lozinke se ne podudaraju.');
        }
      });
    </script>

  <?php endif; ?>

<?php include 'footer.php'; ?>
