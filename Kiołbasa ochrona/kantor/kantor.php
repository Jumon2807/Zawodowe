<?php
// KONTROLER strony kantoru
require_once dirname(__FILE__).'/../config.php';
$messages = [];
// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

include _ROOT_PATH.'/kantor/security/check.php';
// 1. pobranie parametrów

$kwota = $_REQUEST['kwota'];
$kurs = $_REQUEST['kurs'];
$operation = $_REQUEST['op'];

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($kwota) && isset($kurs) && isset($operation))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = ' Brak jednego z parametrów, wpisz prawidłowe wartości ';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if (empty($kwota)) {
	$messages[] = 'Nie podano kwoty';
}
if (empty($kurs)) {
	$messages[] = 'Nie podano kursu';
}


//nie ma sensu walidować dalej gdy brak parametrów
if (empty( $messages )) {
	
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
	if (! is_numeric( $kwota )) {
		$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $kurs )) {
		$messages [] = 'Druga wartość nie jest liczbą całkowitą';
	}	

}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $messages )) { // gdy brak błędów
	floatval($kwota);
	floatval($kurs);
	//wykonanie operacji
	switch ($operation) {
		case 'pln_na_eur' :
			$result = ($kwota / $kurs);
			$result = round($result,2);
			break;
		case 'eur_na_pln' :
			$result = ($kwota * $kurs);
			$result = round($result,2);
			break;
	}
}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'kantor_view.php';