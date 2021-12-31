<?php ob_start() ?>

<div class="form-group">
    <h2>Titre du logement</h2>
    <p>
        <?= $logement->getTitre() ?>
    </p>
</div>
<div class="form-group">
    <h2>Adresse du logement</h2>
    <p><?= $logement->getAdresse() ?></p>
</div>
<div class="form-group">
    <h2>Ville du logement</h2>
    <p><?= $logement->getVille() ?></p>
</div>
<div class="form-group">
    <h2>Code postal du logement</h2>
    <p><?= $logement->getCp() ?></p>
</div>
<div class="form-group">
    <h2>Surface du logement</h2>
    <p><?= $logement->getSurface() ?></p>
</div>
<div class="form-group">
    <h2>Prix du logement</h2>
    <p><?= $logement->getPrix() ?></p>
</div>
<div class="form-group">
    <h2>Photo du logement</h2>
    <?php
    $photo = $logement->getPhoto();
    if ($photo !== null && $photo !== "") {
        echo "<div><img class='container img-responsive' style='width:50%;height:50%' src='" . URL . $photo . "' alt='Photo de " . $logement->getTitre() . "'></div>";
    } else {
        echo "Pas de photo";
    }?>
</div>
<div class="form-group">
    <h2>Type du logement</h2>
    <p>
        <?=$logement->getType() ?>
    </p>
</div>
<div class="form-group">
    <h2>Description du logement</h2>
    <p><?php if ($logement->getDescription()) {
        echo "<p>".$logement->getDescription()."</p>";
    } else {
        echo "Pas de description";
    } ?></p>
</div>

<?php
$content = ob_get_clean();
$title = "Détails de : " . $logement->getTitre();
require_once "base.html.php";
?>