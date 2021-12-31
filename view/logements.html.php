<?php ob_start() ?>

<p class="text-center">Notre sélection de logements</p>

<table class="table table-hover text-center">
    <thead class="table-primary">
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Adresse</th>
            <th scope="col">Ville</th>
            <th scope="col">Code Postal</th>
            <th scope="col">Surface</th>
            <th scope="col">Prix</th>
            <th scope="col">Photo</th>
            <th scope="col">Type</th>
            <th scope="col">Description</th>
            <th scope="col" colspan="3">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logements as $logement) : ?>
            <tr>
                <td><?= $logement->getTitre(); ?></td>
                <td><?= $logement->getAdresse(); ?></td>
                <td><?= $logement->getVille(); ?></td>
                <td><?= $logement->getCp(); ?></td>
                <td><?= $logement->getSurface(); ?></td>
                <td><?= $logement->getPrix(); ?>€</td>
                <td><?php
                    $photo = $logement->getPhoto();
                    if ($photo) {
                        echo "<img src='" . URL . $photo . "' alt='Photo de " . $logement->getTitre() . "' class='container img-responsive' style='width:50%;height:50%'></td>";
                    } else {
                        echo "Pas de photo";
                    } ?>
                <td><?= $logement->getType(); ?></td>
                <td><?php
                    $descr = $logement->getDescription();
                    if ($descr) {
                        $size = strlen($descr);
                        $maxSize = 10;
                        if ($size > $maxSize) {
                            $end = $size - $maxSize;
                            $short = substr($descr, 0, -$end) . '...';
                            echo $short;
                        } else {
                            echo $descr;
                        }
                    } else {
                        echo "-";
                    } ?></td>
                <td><a href="<?= URL ?>logements/edit/<?= $logement->getId() ?>"><i class="fas fa-edit"></i></a></td>
                <td>
                    <form action="<?= URL ?>logements/delete/<?= $logement->getId() ?>" method="POST" onsubmit="return confirm('Etes-vous certain de vouloir supprimer ce logement?')">
                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
                <td><a href="<?= URL ?>logements/details/<?= $logement->getId() ?>"><i class="fas fa-info-circle"></i></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
<a href="<?= URL ?>logements/add" class="btn btn-success w-25 d-block m-auto">Ajouter un logement</a>

<?php
$content = ob_get_clean();
$title = "Liste de logements";
require_once "base.html.php";
?>