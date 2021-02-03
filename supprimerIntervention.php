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

// 2 la requete SQL pour supprimer l'element
$sql = "DELETE FROM ampoules WHERE id_ampoule = ?";
// 3 la requete php preparée (connexion a la base de donnée et recup la variable sql )
$supprimer = $BD->prepare($sql);
$id_supprimer = $_GET['supprimerID'];
// 4 je bind (lier) les élements en l'occurrence il y en que 1 
$supprimer->bindParam(1, $id_supprimer);
// 5 j'execute la raquete
$resultat = $supprimer->execute();

if($resultat){
    
    header("Location:http://localhost/CRUD%20Ampoules/listeAmpoule.php");
}else{
    echo "ERREUR L'ELEMENT NE PEUT PAS ETRE SUPPRIME";
}

?>

<?php
$content = ob_get_clean();
require "template.php";
?>