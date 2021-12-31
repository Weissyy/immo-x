<?php ob_start() ?>

<form method="POST" action="<?= URL ?>logements/editvalid" enctype="multipart/form-data">

    <div class="form-group">
        <label for="titre">Titre du logement*</label>
        <input type="text" class="form-control" name="titre" id="titre" value="<?= $logement->getTitre() ?>">
    </div>
    <div class="form-group">
        <label for="adresse">Adresse du logement*</label>
        <input type="text" class="form-control" name="adresse" id="adresse" value="<?= $logement->getAdresse() ?>">
    </div>
    <div class="form-group">
        <label for="ville">Ville du logement*</label>
        <input type="text" class="form-control" name="ville" id="ville" value="<?= $logement->getVille() ?>">
    </div>
    <div class="form-group">
        <label for="cp">Code postal du logement*</label>
        <input type="number" class="form-control" name="cp" id="cp" value="<?= $logement->getCp() ?>">
    </div>
    <div class="form-group">
        <label for="surface">Surface du logement*</label>
        <input type="number" class="form-control" name="surface" id="surface" value="<?= $logement->getSurface() ?>">
    </div>
    <div class="form-group">
        <label for="prix">Prix du logement*</label>
        <input type="number" class="form-control" name="prix" id="prix" value="<?= $logement->getPrix() ?>">
    </div>
    <div class="form-group">
        <?php
        $photo = $logement->getPhoto();
        if ($photo !== null && $photo !== "") {
            echo "<div><img class='container img-responsive' style='width:50%;height:50%' src='" . URL . $photo . "' alt='Photo de " . $logement->getTitre() . "'></div>";
        } ?>

        <label for="photo">Modifier la photo du logement</label>
        <div>
            <input type="file" id="photo" name="photo">
        </div>
    </div>
    <div class="form-group">
        <label for="type">Type du logement*</label>
        <select name="type" id="type">
            <?php if ($logement->getType() === 'Location') {
                echo "<option value='Location'>Location</option>
            <option value='Vente'>Vente</option>";
            } else {
                echo "<option value='Vente'>Vente</option>
            <option value='Location'>Location</option>";
            } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description du logement</label>
        <input type="text" class="form-control" name="description" id="description" value="<?= $logement->getDescription() ?>">
    </div>
    <input type="hidden" name="id-logement" value="<?= $logement->getId() ?>">
    <button type="submit" class="btn btn-success">Modifier</button>
</form>
<p>Les champs marqués par une * sont obligatoires.</p>

<?php
$content = ob_get_clean();
$title = "Modification de : " . $logement->getTitre();
require_once "base.html.php";
?>

<script>
    let inputs = document.querySelectorAll(".form-control");
    let button = document.querySelector(".btn");
    button.disabled = false;

    inputs.forEach(input => {
        input.addEventListener("change", () => {
            stateHandle();
        });
    });


    function stateHandle() {
        if (document.getElementById("titre").value === "" || document.getElementById("adresse").value === "" || document.getElementById("ville").value === "" || document.getElementById("cp").value === "" || document.getElementById("surface").value === "" || document.getElementById("prix").value === "" || document.getElementById("cp").value.length != 5 || document.getElementById("surface").value < 0 || document.getElementById("prix").value < 0 || document.getElementById("cp").value < 0 || document.getElementById("surface").value != parseInt(document.getElementById("surface").value) || document.getElementById("prix").value != parseInt(document.getElementById("prix").value)) {
            button.disabled = true;
            console.log(document.getElementById("prix").value === 11);

        } else {
            button.disabled = false;
        }
    }
</script>