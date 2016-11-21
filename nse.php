<?php
$path = http://172.20.17.98/;
$mysqli = new mysqli($path, "root", "root", "phppbl");
//$mysqli->query("CREATE TABLE DAW2.ALUMNE (id integer primary key,
//nom VARCHAR(20))");
//$mysqli->query("INSERT INTO DAW2.ALUMNE VALUES(1,'SERGI')");
$resultat= $mysqli->query("SELECT * FROM phppbl.alumne");

$fila = $resultat->fetch_assoc();
echo htmlentities($fila['nom']);

?>