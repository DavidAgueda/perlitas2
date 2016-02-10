<?php
	try {
		$dbh = new PDO('mysql:host=localhost;dbname=france','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		$stmt= $dbh->prepare("SELECT COUNT(ville_id) FROM villes_france_free");

		$dbh->beginTransaction();
		var_dump($stmt->execute());
		$count=$stmt->fetchColumn();
		$dbh->commit();

		$dbh=null;
	} catch (Exception $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		die();
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Formulaire</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
            <p>este ejemplo esta hecho con jpChart</p>
            <p>otra libreria interante es pchart</p>
            <p><a href="http://pchart.sourceforge.net/screenshots.php">pchart</a></p>
            <p>es mucho mas bonita</p>
		<section> 
			<fieldset><legend>TOTAL</legend>
				Total de ville : <h2><?php echo $count ?></h2>
			</fieldset>
		</section>
		<img src="graph.php" />
	</body>
</html>