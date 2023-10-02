<?php

function getExpertises(){ 

//echo "liste des expertises";
$pdo = getconnexion();
$req= "SELECT nomExpertiseFR FROM Expertise";

$stmt = $pdo-> prepare($req);

$stmt-> execute();

$expertises = $stmt-> fetchAll(PDO::FETCH_ASSOC);

$stmt->closeCursor();

sendJSON($expertises);
	}

function getExpertiseById($id){
	//echo "expertise par id: test:OK";
$pdo = getconnexion();
$req= "SELECT nomExpertiseFR FROM Expertise WHERE idExpertise= :id";
$stmt = $pdo-> prepare($req);
$stmt ->bindValue(":id",$id,PDO::PARAM_INT);
$stmt-> execute();
$expertise = $stmt-> fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
sendJSON($expertise);	
	}

function getExpertById($id){
	//echo " à faire: liste des experts par expertises!";
	$pdo = getconnexion();
$req= "SELECT nom, prenom, idExpertise FROM Expertise join personneWCICIT ON responsable=Idpersonne WHERE idExpertise= :id";
$stmt = $pdo-> prepare($req);
$stmt ->bindValue(":id",$id,PDO::PARAM_INT);
$stmt-> execute();
$expertise = $stmt-> fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
sendJSON($expertise);	
	}

function getconnexion(){
	return new PDO("mysql:host=localhost;dbname=dev_cic", 'dev_cic', 'eooF_oQM2');	
}

function sendJSON($info){
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json");
	echo json_encode($info, JSON_UNESCAPED_UNICODE);
}

?>