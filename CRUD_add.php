<?php
	$NomeLista = $_GET["NomeLista"];
	$Html = $_GET["Html"];
	$Arvore = $_GET["Arvore"];
	echo $Arvore . "<br>";
	echo $Html . "<br>";
	include "connection.php";
	// Teste de existÍncia
	$sql = "SELECT NomeLista, Html FROM Task WHERE NomeLista = ? ";
	$params = array(
		$NomeLista
		);
	$sth = $conn->prepare($sql);
	$sth->execute($params);
	// Dados
	$data = [
			'NomeLista' => $NomeLista,
			'Html' => $Html,
			'Arvore' => $Arvore
		];
	
	if( $row = $sth->fetch() ){
		echo  "[{\"Id\":\"EXISTE\"}, {\"NomeLista\":\"" . $row['NomeLista'] . "\"}, {\"Html\":\"" . $row['Html'] . "\"}, {\"Arvore\":\"" . $row['Arvore'] . "\"}]";
		$sql = "UPDATE Task SET Html = :Html, Arvore = :Arvore WHERE NomeLista = :NomeLista ";
		$sth = $conn->prepare($sql);
		$sth->execute($data);			
		} else {
		echo  "[{\"Id\":\"novo\"}, {\"NomeLista\":\"" . $NomeLista . "\"}, {\"Html\":\"" . $Html . "\"}]";
		$sql = "INSERT INTO Task (NomeLista, Html, Arvore ) VALUES (:NomeLista, :Html, :Arvore)";
		$sth = $conn->prepare($sql);
		$sth->execute($data);
		}
		
?>