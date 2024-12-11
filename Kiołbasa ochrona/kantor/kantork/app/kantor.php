<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$x = isset($_REQUEST['x']) ? $_REQUEST['x'] : '';
$y = isset($_REQUEST['y']) ? $_REQUEST['y'] : '';
$operation = isset($_REQUEST['op']) ? $_REQUEST['op'] : '';

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

//domyślnie pokazuj wstęp strony (tytuł i tło)
$hide_intro = false;

// sprawdzenie, czy parametry zostały przekazane - jeśli nie to wyświetl widok bez obliczeń
if ( isset($_REQUEST['x']) && isset($_REQUEST['y']) && isset($_REQUEST['op']) ) {
	//nie pokazuj wstępu strony gdy tryb obliczeń (aby nie trzeba było przesuwać)
	$hide_intro = true;

	$infos [] = 'Przekazano parametry.';
		

	// sprawdzenie, czy potrzebne wartości zostały przekazane
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
}

// 4. Wywołanie widoku, wcześniej ustalenie zawartości zmiennych elementów szablonu

$page_title = 'Przykład 03';
$page_description = 'Najprostsze szablonowanie oparte na budowaniu widoku poprzez dołączanie kolejnych części HTML zdefiniowanych w różnych plikach .php';
$page_header = 'Proste szablony';
$page_footer = 'przykładowa tresć stopki wpisana do szablonu z kontrolera';

include 'kantor_view.php';