<?php ob_start() ?>

<form method="POST" action="<?= URL ?>logements/lvalid" enctype="multipart/form-data">

    <div class="form-group">
        <label for="titre">Titre du logement*</label>
        <input type="text" class="form-control" required name="titre" id="titre" placeholder="Le titre de votre logement">
    </div>
    <div class="form-group">
        <label for="adresse">Adresse du logement*</label>
        <input type="text" class="form-control" required name="adresse" id="adresse" placeholder="L'adresse de votre logement">
    </div>
    <div class="form-group">
        <label for="ville">Ville du logement*</label>
        <input type="text" class="form-control" required name="ville" id="ville" placeholder="La ville de votre logement">
    </div>
    <div class="form-group">
        <label for="cp">Code postal du logement*</label>
        <input type="number" class="form-control" required name="cp" id="cp" placeholder="Le code postal de votre logement">
    </div>
    <div class="form-group">
        <label for="surface">Surface du logement*</label>
        <input type="number" class="form-control" required name="surface" id="surface" placeholder="La surface de votre logement">
    </div>
    <div class="form-group">
        <label for="prix">Prix du logement*</label>
        <input type="number" class="form-control" required name="prix" id="prix" placeholder="Le prix de votre logement">
    </div>
    <div class="form-group">
        <label for="photo">Photo du logement</label>
        <div class="form-group">
            <input type="file" id="photo" name="photo">
        </div>
    </div>
    <div class="form-group">
        <label for="type">Type du logement*</label>
        <select name="type" id="type">
            <option value="Location">Location</option>
            <option value="Vente">Vente</option>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description du logement</label>
        <input type="text" class="form-control" name="description" id="description" placeholder="La description de votre logement">
    </div>

    <button type="submit" class="btn btn-success">Ajouter</button>
</form>
<p>Les champs marqués par une * sont obligatoires.</p>

<?php

$content = ob_get_clean();
$title = "Ajouter un logement";
require_once "base.html.php";
?>

<script>
    let inputs = document.querySelectorAll(".form-control");
    let button = document.querySelector(".btn");
    button.disabled = true;

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