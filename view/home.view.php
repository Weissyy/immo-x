<?php ob_start()?>

<p class="text-center">Bienvenue</p>

<?php
    $content = ob_get_clean();
    $title = "Bienvenue chez Immo-X";
    require_once "base.html.php";
?>