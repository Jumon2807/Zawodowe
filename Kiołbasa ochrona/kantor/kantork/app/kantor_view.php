<?php require_once dirname(__FILE__) .'/../config.php';?>

<?php //góra strony z szablonu 
include _ROOT_PATH.'/templates/top.php';
?>

<h2 class="content-head is-center">Prosty kalkulator</h2>

<div class="pure-g">
<div class="l-box-lrg pure-u-1 pure-u-med-2-5">
<form action="<?php print(_APP_URL);?>/app/kantor.php" method="post">
	<label for="kwota">Kwota: </label>
	<input id="kwota" type="text" name="kwota" value="<?php isset($kwota)?print($kwota):" "; ?>" /><br />
	
	<label for="kurs">Kurs: </label>
	<input id="kurs" type="text" name="kurs" value="<?php isset($kurs)?print($kurs):" "; ?>" /><br />
	<label >Operacja: </label><br>
	<input type="radio" name="op" id='op' value="pln_na_eur"><label>pln na eur</label><br />
	<input type="radio" name="op" id='op' value="eur_na_pln"><label>eur na pln</label><br />
	<input type="submit" id="btn"value="Oblicz"  />
</form>	

</div>

<div class="l-box-lrg pure-u-1 pure-u-med-3-5">

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
	echo '<h4>Wystąpiły błędy: </h4>';
	echo '<ol class="err">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php
//wyświeltenie listy informacji, jeśli istnieją
if (isset($infos)) {
	if (count ( $infos ) > 0) {
	echo '<h4>Informacje: </h4>';
	echo '<ol class="inf">';
		foreach ( $infos as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
	<h4>Wynik</h4>
	<p class="res">
<?php print($result); ?>
	</p>
<?php } ?>

</div>
</div>

<?php //dół strony z szablonu 
include _ROOT_PATH.'/templates/bottom.php';
?>