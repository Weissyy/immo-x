<?php
require_once "model/Manager.php";
require_once "model/Logement.php";

class LogementManager extends Manager
{
    private $logements;

    public function addLogement($logement)
    {
        $this->logements[] = $logement;
    }

    public function getLogements()
    {
        return $this->logements;
    }

    public function loadLogements()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM logement");
        $req->execute();
        $mesLogements = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($mesLogements as $logement) {
            $l = new Logement($logement["id_logement"], $logement["titre"], $logement["adresse"], $logement["ville"], $logement["cp"], $logement["surface"], $logement["prix"], $logement["photo"], $logement["type"], $logement["description"]);
            $this->addLogement($l);
        }
    }

    public function newLogementDB($titre, $adresse, $ville, $cp, $surface, $prix, $photo, $type, $description)
    {
        $req = "INSERT INTO logement (titre, adresse, ville, cp, surface, prix, photo, type, description) VALUES (:titre, :adresse, :ville, :cp, :surface, :prix, :photo, :type, :description)";
        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":titre", $titre, PDO::PARAM_STR);
        $statement->bindValue(":adresse", $adresse, PDO::PARAM_STR);
        $statement->bindValue(":ville", $ville, PDO::PARAM_STR);
        $statement->bindValue(":cp", $cp, PDO::PARAM_INT);
        $statement->bindValue(":surface", $surface, PDO::PARAM_INT);
        $statement->bindValue(":prix", $prix, PDO::PARAM_INT);
        $statement->bindValue(":photo", $photo, PDO::PARAM_STR);
        $statement->bindValue(":type", $type, PDO::PARAM_STR);
        $statement->bindValue(":description", $description, PDO::PARAM_STR);
        $result = $statement->execute();
        $statement->closeCursor();

        if ($result) {
            $logement = new Logement($this->getBdd()->lastInsertId(), $titre, $adresse, $ville, $cp, $surface, $prix, $photo, $type, $description);
            $this->addLogement($logement);
        }
        echo ("console.log('logement manager')");
    }

    public function getLogementById($id)
    {
        foreach ($this->logements as $logement) {
            if ($logement->getId() == $id) {
                return $logement;
            }
        }
    }

    public function editLogementDB($id, $titre, $adresse, $ville, $cp, $surface, $prix, $photo, $type, $description)
    {
        if ($photo === null || $photo === "") {
            $req = "UPDATE logement SET titre=:titre, adresse=:adresse, ville=:ville, cp=:cp, surface=:surface, prix=:prix, type=:type, description=:description WHERE id_logement=:id";
            $statement = $this->getBdd()->prepare($req);
            $statement->bindValue(":id", $id, PDO::PARAM_INT);
            $statement->bindValue(":titre", $titre, PDO::PARAM_STR);
            $statement->bindValue(":adresse", $adresse, PDO::PARAM_STR);
            $statement->bindValue(":ville", $ville, PDO::PARAM_STR);
            $statement->bindValue(":cp", $cp, PDO::PARAM_INT);
            $statement->bindValue(":surface", $surface, PDO::PARAM_INT);
            $statement->bindValue(":prix", $prix, PDO::PARAM_INT);
            $statement->bindValue(":type", $type, PDO::PARAM_STR);
            $statement->bindValue(":description", $description, PDO::PARAM_STR);
            $result = $statement->execute();
            $statement->closeCursor();
        } else {
            $req = "UPDATE logement SET titre=:titre, adresse=:adresse, ville=:ville, cp=:cp, surface=:surface, prix=:prix, photo=:photo, type=:type, description=:description WHERE id_logement=:id";
            $statement = $this->getBdd()->prepare($req);
            $statement->bindValue(":id", $id, PDO::PARAM_INT);
            $statement->bindValue(":titre", $titre, PDO::PARAM_STR);
            $statement->bindValue(":adresse", $adresse, PDO::PARAM_STR);
            $statement->bindValue(":ville", $ville, PDO::PARAM_STR);
            $statement->bindValue(":cp", $cp, PDO::PARAM_INT);
            $statement->bindValue(":surface", $surface, PDO::PARAM_INT);
            $statement->bindValue(":prix", $prix, PDO::PARAM_INT);
            $statement->bindValue(":photo", $photo, PDO::PARAM_STR);
            $statement->bindValue(":type", $type, PDO::PARAM_STR);
            $statement->bindValue(":description", $description, PDO::PARAM_STR);
            $result = $statement->execute();
            $statement->closeCursor();
        }

        if ($result) {
            $this->getLogementById($id)->setTitre($titre);
            $this->getLogementById($id)->setAdresse($adresse);
            $this->getLogementById($id)->setVille($ville);
            $this->getLogementById($id)->setCp($cp);
            $this->getLogementById($id)->setSurface($surface);
            $this->getLogementById($id)->setPrix($prix);
            if ($photo !== null && $photo !== "") {
                $this->getLogementById($id)->setPhoto($photo);
            }
            $this->getLogementById($id)->setType($type);
            $this->getLogementById($id)->setDescription($description);
        }
    }

    public function deleteLogementDB($id)
    {
        $req = "DELETE FROM logement WHERE id_logement=:id";
        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":id", $id, PDO::PARAM_INT);
        $result = $statement->execute();
        $statement->closeCursor();

        if ($result) {
            $logement = $this->getLogementById($id);
            unset($logement);
        }
    }
}
