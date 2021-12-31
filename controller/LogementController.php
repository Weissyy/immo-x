<?php
require_once "model/LogementManager.php";

class LogementController
{
    private $logementManager;

    public function __construct()
    {
        $this->logementManager = new LogementManager();
        $this->logementManager->loadLogements();
    }

    public function displayLogements()
    {
        $logements = $this->logementManager->getLogements();
        require_once "view/logements.html.php";
    }

    public function newLogementForm()
    {
        require_once "view/new.logement.html.php";
    }

    public function newLogementValidation()
    {
        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === 0) {
            $newfilename = $this->processFile();
            $this->logementManager->newLogementDB($_POST["titre"], $_POST["adresse"], $_POST["ville"], $_POST["cp"], $_POST["surface"], $_POST["prix"], $newfilename, $_POST["type"], $_POST["description"]);
        } else {
            $this->logementManager->newLogementDB($_POST["titre"], $_POST["adresse"], $_POST["ville"], $_POST["cp"], $_POST["surface"], $_POST["prix"], null, $_POST["type"], $_POST["description"]);
        }
        header('Location:' . URL . "logements");
    }

    public function editLogementForm($id)
    {
        $logement = $this->logementManager->getLogementById($id);
        require_once "view/edit.logement.html.php";
    }

    public function editLogementValidation()
    {

        if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === 0) {
            $newfilename = $this->processFile();
            $this->logementManager->editLogementDB($_POST['id-logement'], $_POST['titre'], $_POST['adresse'], $_POST["ville"], $_POST['cp'], $_POST['surface'], $_POST['prix'], $newfilename, $_POST['type'], $_POST['description']);
        } else {
            $this->logementManager->editLogementDB($_POST['id-logement'], $_POST['titre'], $_POST['adresse'], $_POST["ville"], $_POST['cp'], $_POST['surface'], $_POST['prix'], null, $_POST['type'], $_POST['description']);
        }
        header('Location:' . URL . 'logements');
    }

    public function deleteLogement($id)
    {
        $this->logementManager->deleteLogementDB($id);
        header('Location:' . URL . 'logements');
    }


    private function processFile()
    {
        $allowed = [
            "jpg" => "image/jpeg",
            "jpeg" => "image/jpeg",
            "png" => "image/png"
        ];

        echo "<script>console.log('bloc php');</script>";

        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {
            die("Format de fichier incorrect");
        }

        if ($filesize > 1048576) {
            die("Fichier trop volumineux");
        }

        $newname = "logement_" . time();
        $tmp = substr(__DIR__, 0, -10);
        $dir = $tmp . "view" . DIRECTORY_SEPARATOR . "img";
        $fileDestination = $dir . DIRECTORY_SEPARATOR . "$newname.$extension";
        $newfilename = "view/img/$newname.$extension";

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $fileDestination)) {
            die("L'upload a échoué");
        }

        return $newfilename;
    }

    public function detailsLogement($id){
        $logement = $this->logementManager->getLogementById($id);
        require_once "view/details.logement.html.php";
    }
}
