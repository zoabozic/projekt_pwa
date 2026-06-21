<?php
include 'connect.php';
define('UPLPATH', 'images/');

$poruka = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title    = mysqli_real_escape_string($dbc, $_POST['title']);
    $about    = mysqli_real_escape_string($dbc, $_POST['about']);
    $content  = mysqli_real_escape_string($dbc, $_POST['content']);
    $category = mysqli_real_escape_string($dbc, $_POST['category']);
    $date     = date('d.m.Y.');
    $archive  = isset($_POST['archive']) ? 1 : 0;
    $picture  = isset($_FILES['pphoto']['name']) ? $_FILES['pphoto']['name'] : '';

    if (!empty($picture)) {
        move_uploaded_file($_FILES['pphoto']['tmp_name'], UPLPATH . $picture);
    }

    $query = "INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva)
              VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";

    if (mysqli_query($dbc, $query)) {
        $poruka = 'Vijest je uspješno spremljena.';
    } else {
        $poruka = 'Greška prilikom spremanja: ' . mysqli_error($dbc);
    }
}

$page_title = 'Unos vijesti';
include 'header.php';
?>

  <h1>Unos nove vijesti</h1>

  <?php if ($poruka): ?>
    <p class="form-message"><?php echo htmlspecialchars($poruka); ?></p>
  <?php endif; ?>

  <form name="unos" enctype="multipart/form-data" action="unos.php" method="POST">

    <div class="form-item">
      <label for="title">Naslov vijesti</label>
      <div class="form-field">
        <input type="text" id="title" name="title" class="form-field-textual" required autofocus>
      </div>
    </div>

    <div class="form-item">
      <label for="about">Kratki sažetak vijesti (do 50 znakova)</label>
      <div class="form-field">
        <textarea id="about" name="about" cols="30" rows="4" class="form-field-textual" maxlength="50" required></textarea>
      </div>
    </div>

    <div class="form-item">
      <label for="content">Sadržaj vijesti</label>
      <div class="form-field">
        <textarea id="content" name="content" cols="30" rows="10" class="form-field-textual" required></textarea>
      </div>
    </div>

    <div class="form-item">
      <label for="category">Kategorija vijesti</label>
      <div class="form-field">
        <select id="category" name="category" class="form-field-textual">
          <option value="sport">Sport</option>
          <option value="kultura">Kultura</option>
        </select>
      </div>
    </div>

    <div class="form-item">
      <label for="pphoto">Slika</label>
      <div class="form-field">
        <input type="file" id="pphoto" name="pphoto" accept="image/jpeg,image/png,image/gif">
      </div>
    </div>

    <div class="form-item">
      <label class="checkbox-label">
        <input type="checkbox" name="archive"> Spremi u arhivu (ne prikazuj na stranici)
      </label>
    </div>

    <div class="form-item">
      <button type="reset">Poništi</button>
      <button type="submit">Pošalji</button>
    </div>

  </form>

<?php
mysqli_close($dbc);
include 'footer.php';
?>
