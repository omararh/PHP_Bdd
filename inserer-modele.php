<!DOCTYPE html >
<html>
<head>
<meta charset="UTF-8" />
<title>Saisissez les caractéristiques du modèle</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"
		enctype="application/x-www-form-urlencoded">
		<fieldset>
			<legend>
				<b>Modèle de voiture</b>
			</legend>
			<table>
				<tr>
					<td>Code :</td>
					<td><input type="text" name="id_modele" size="40" maxlength="30"/></td>
				</tr>
				<tr>
					<td>Nom du modèle :</td>
					<td><input type="text" name="modele" size="40" maxlength="30"/></td>
				</tr>
				<tr>
					<td>Carburant : <select name="carburant">
							<option value="essence">Essence</option>
							<option value="diesel">Diesel</option>
							<option value="gpl">G.P.L.</option>
							<option value="électrique">Electrique</option>
					</select></td>
				</tr>
				<tr>
					<td><input type="reset" value=" Effacer "></td>
					<td><input type="submit" value=" Envoyer "></td>
				</tr>
			</table>
		</fieldset>
	</form>
<?php
include ("connexpdo.inc.php");
$idcom = connexpdo("l3_dw_tp_php_bdd_voitures");
if (! empty($_POST['id_modele']) && ! empty($_POST['modele']) && ! empty($_POST['carburant'])) {
    try {
        $id_modele = $idcom->quote($_POST['id_modele']);
        $modele = $idcom->quote($_POST['modele']);
        $carburant = $idcom->quote($_POST['carburant']);
        $query = "INSERT INTO modele VALUES($id_modele,$modele,$carburant)";
        $nb = $idcom->exec($query);
        if ($nb != 1) {
            alert("Erreur : \"$idcom->errorCode()\"");
        } else {
            alert("Modèle bien enregistré !");
        }
    } catch (PDOException $e) {
        displayException($e);
        exit();
    }
} else {
    echo "<h3>Formulaire à compléter!</h3>";
}
?>
</body>
</html>