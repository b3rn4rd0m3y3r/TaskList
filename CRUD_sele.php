<?php
	$NomeLista = $_GET["NomeLista"];
	//$Html = $_GET["Html"];
	//$Arvore = $_GET["Arvore"];
	//echo $Arvore . "<br>";
	//echo $Html . "<br>";
	// CONEXÃO
	include "connection.php";
	// Teste de existência e leitura dos campos
	$sql = "SELECT NomeLista, Arvore, Html FROM Task WHERE NomeLista = ? ";
	$params = array(
		$NomeLista
		);
	$sth = $conn->prepare($sql);
	$sth->execute($params);
		if( $row = $sth->fetch() ){
			$pattern = '/\"/';
			$replacement = '\\"';
			$row["Html"] = preg_replace($pattern, $replacement, $row["Html"]);
			$row["Arvore"] = preg_replace($pattern, $replacement, $row["Arvore"]);
			echo  "[{\"Id\":\"EXISTE\"}, {\"NomeLista\":\"" . $row['NomeLista'] . "\"}, {\"Html\":\"" . $row['Html'] . "\"}, {\"Arvore\":\"" . $row['Arvore'] . "\"}]";
			} else {
			echo  "[{\"Id\":\"NOVO\"}]";
			}
	$conn = null;
?>