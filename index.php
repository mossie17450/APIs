<?php
require_once("./api.php");
//echo "coucou!";
//routage et demande?
try{
if(!empty($_GET['demande'])){
	//echo"teste";
	$url= explode("/", filter_var($_GET['demande'],FILTER_SANITIZE_URL));
	//print_r($url);
	switch($url[0]){
		case "expertises": //echo "expertises";
			if(empty($url[1])){
				getExpertises();
			}
		break;
		case "expertise": //echo "expertise";
			if(!empty($url[1])){
				getExpertiseById($url[1]);
			}
				else{
					throw new Exception ("renseigner le numero de l'expertise, svp!");
				}
		break;
		case "expert": //echo "expertise";
			if(!empty($url[1])){
				getExpertById($url[1]);
			}
				else{
					throw new Exception ("renseigner le numero de l'expertise, svp!");
				}
		break;
		default:throw new Exception("La demande n'est pas valide, vérifiez l'url.");
		
	}
	
}
	else{
		throw new Exception("probleme de recuperation de données.");
	}
} catch(Exception $e){
	$erreur =[
	"message"=> $e->getMessage(),
	"code"=> $e->getCode()
	];
	
	print_r($erreur);	
}

?>