<?php

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));

require_once "controller/LogementController.php";
$logementController = new LogementController();

if (empty($_GET['page'])) {
    require_once "view/home.view.php";
} else {
    $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
    switch ($url[0]) {
        case "accueil":
            require_once "view/home.view.php";
            break;
        case "logements":
            if (empty($url[1])) {
                $logementController->displayLogements();
            } else if ($url[1] === "add") {
                $logementController->newLogementForm();
            } else if ($url[1] === "lvalid") {
                $logementController->newLogementValidation();
            } else if ($url[1] === "edit") {
                $logementController->editLogementForm($url[2]);
            } else if ($url[1] === "editvalid") {
                $logementController->editLogementValidation();
            } else if ($url[1] === "delete") {
                $logementController->deleteLogement($url[2]);
            } else if ($url[1] === "details") {
                $logementController->detailsLogement($url[2]);
            }
            break;
    }
}
