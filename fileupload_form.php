<?php
if (isset($_GET["error"])) {
        echo '<p class="fs-2 text-white">';
        echo "Das hat leider nicht funktioniert!<br>";
        switch ($_GET["error"]) {

            case "wrongfiletype":
                echo "Bitte nur *.jpg oder *.jpeg hochladen!";
                break;
            case "oversized":
                echo "Bitte Datei auf höchstens 15 MB verkleinern!";
                break;
?>

<div class="container mt-5 text-dark bg-dark bg-opacity-75 rounded text-white" style="--bs-bg-opacity: 0.9!important;">
<h2>News erstellen</h2>
    <form action="./utils/newsinc.php" method="post" enctype="multipart/form-data">
        <div class="mb-3 mx-2 px-2">
            <label for="newsTitle" class="form-label text-left">Bitte Titel eingeben*:</label>
            <input type="text"  name="newsTitle" id="newsTitle" value="' . @$_POST["newsTitle"] . '" class="form-control " required>
        </div>
        <div class="mb-3 mx-2 px-2">
            <label for="newsText" class="form-label">Bitte Artikeltext (max.2000 Zeichen) eingeben*:</label>
            <textarea class="form-control" name="newsText" id="newsText" value="' . @$_POST['newsText'] . '" rows="6" required></textarea>
        </div>
        <div class="mb-3 mx-2 px-2">
            <label for="imgUpload" class="form-label">Bitte passendes Bild (.jpg oder .png für den Artikel hochladen.</label>
            <input class="form-control" type="file" id="imgUpload" name="imgUpload" accept="image/*" >
        </div>
        <div class="mb-3">
            <button class="btn btn-dark border" name="newsSubmit" type="submit">Beitrag abschicken</button>
        </div>
    </form>
</div>
