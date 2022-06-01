<?php
	$NomeLista = $_GET["NomeLista"];
	$Html = $_GET["Html"];
	$Arvore = $_GET["Arvore"];
	echo $Arvore . "<br>";
	echo $Html . "<br>";
	include "connection.php";
	// Teste de existência
	$sql = "SELECT NomeLista, Html FROM Task WHERE NomeLista = ? ";
	$params = array(
		$NomeLista
		);
	$sth = $conn->prepare($sql);
	$sth->execute($params);
		if( $row = $sth->fetch() ){
			echo  "[{\"Id\":\"EXISTE\"}, {\"NomeLista\":\"" . $row['NomeLista'] . "\"}, {\"Html\":\"" . $row['Html'] . "\"}, {\"Arvore\":\"" . $row['Arvore'] . "\"}]";
			} else {
			echo  "[{\"Id\":\"NOVO\"}]";
			}
	close($conn);