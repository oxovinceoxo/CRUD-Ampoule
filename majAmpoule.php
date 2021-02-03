<?php

$title = "supprimer une intervention -";
ob_start();

// 1 COONEXION A LE BASE de DONNÉES
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




// il faut que je recupere les element du formulaire (les memes que pour ajouter un element)

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


// 2 la requete SQL pour mettre a jour l'element
$sql = "UPDATE ampoules SET date_changement = ?, etage = ?, position_ampoule = ?, prix_ampoule = ? WHERE id_ampoule = ?";
// 3 la requete php preparée (connexion a la base de donnée et recup la variable sql )
$update = $BD->prepare($sql);

// 4 je bind (lier) les élements en l'occurrence il y en que 1 
$update->bindParam(1, $date_changement);
$update->bindParam(2, $etage);
$update->bindParam(3, $position_ampoule);
$update->bindParam(4, $prix_ampoule);

$id_maj = $_GET['majID'];
// 5 j'execute la raquete
$resultat = $update->execute(array($date_changement, $etage, $position_ampoule, $prix_ampoule, $id_maj));

if($resultat){
    
    header("Location:http://localhost/CRUD%20Ampoules/listeAmpoule.php");
}else{
    echo "ERREUR L'ELEMENT NE PEUT PAS ETRE MODIFIE";
}


$content = ob_get_clean();
require "template.php";
?>