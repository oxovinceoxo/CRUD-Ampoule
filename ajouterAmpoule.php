<?php

$title = "liste des ampoules -";
ob_start();

//COONEXION A LE BASE de DONNÉES
$user = "root";
$pass = "";
//Essaie de te connecter
try {
    $BD = new PDO("mysql:host=localhost;dbname=ecommerce;charset=utf8", $user, $pass);
    //Fonction static de la classe PDO pour debug la connexion en cas d'erreur
    $BD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die("Erreur de connexion a PDO MySQL :" . $exception->getMessage());
}

//condition if else

if(isset($_POST['date_changement']) && !empty($_POST['date_changement'])){
    $date_changement = ($_POST['date_changement']);
}else{
    echo "merci de bien remplir le champ de la date";
}

if(isset($_POST['etage']) && !empty($_POST['etage'])){
    $etage = htmlspecialchars(strip_tags($_POST['etage']));
//htmlspecialchars pour ne pas rentrer des synbole et strip_tags pour interdir les balises
}else{
    echo "merci de bien remplir le champ de l'étage";
}

if(isset($_POST['position_ampoule']) && !empty($_POST['position_ampoule'])){
    $position_ampoule = ($_POST['position_ampoule']);
}else{
    echo "merci de bien remplir le champ de la position de l'ampoule";
}

if(isset($_POST['prix_ampoule']) && !empty($_POST['prix_ampoule'])){
    $prix_ampoule = ($_POST['prix_ampoule']);
}else{
    echo "merci de bien remplir le champ du prix";
}


// requete SQL 
$sql = "INSERT INTO ampoules (date_changement, etage, position_ampoule, prix_ampoule) VALUES (?,?,?,?)";

$request = $BD->prepare($sql);
$request->bindParam(1,$date_changement);
$request->bindParam(2,$etage);
$request->bindParam(3,$position_ampoule);
$request->bindParam(4,$prix_ampoule);

$resultat = $request->execute(array($date_changement, $etage, $position_ampoule, $prix_ampoule));

if($resultat){
    echo "Le produit est bien ajouté";
    header("Location:http://localhost/CRUD%20Ampoules/listeAmpoule.php");
}
?>


<?php
$content = ob_get_clean();
require "template.php";
?>