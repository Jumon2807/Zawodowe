<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Kantor</title>
</head>
<body>
    <?php 
      $kwota = isset($kwota) ? $kwota : '';
      $kurs = isset($kurs) ? $kurs : ''; 
    ?>
<div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/kantor/inna_chroniona.php" class="pure-button">kolejna chroniona strona</a>
	<a href="<?php print(_APP_ROOT); ?>/kantor/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>
<form action="<?php print(_APP_URL);?>/kantor/kantor.php" method="post">
	<label for="kwota">Kwota: </label>
	<input id="kwota" type="text" name="kwota" value="<?php isset($kwota)?print($kwota):" "; ?>" /><br />
	
	<label for="kurs">Kurs: </label>
	<input id="kurs" type="text" name="kurs" value="<?php isset($kurs)?print($kurs):" "; ?>" /><br />
	<label >Operacja: </label><br>
	<input type="radio" name="op" id='op' value="pln_na_eur"><label>pln na eur</label><br />
	<input type="radio" name="op" id='op' value="eur_na_pln"><label>eur na pln</label><br />
	<input type="submit" id="btn"value="Oblicz"  />
</form>	


<?php
  
    //wyświeltenie listy błędów, jeśli istnieją
	if (isset($messages) && count($messages) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #ff6; width:300px;">';
		foreach ( $messages as $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
?>

<?php if (isset($result)){ ?>
    <div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff9; width:300px;">
        <?php echo 'możesz kupić: '.$result . " euro/pln";
?>
    </div>
<?php } 
?>

</body>
</html>