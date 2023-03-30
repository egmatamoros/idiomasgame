<?php
$palabras = file('palabras.txt', FILE_IGNORE_NEW_LINES);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $palabrasAlAzar = [];
  while (count($palabrasAlAzar) < 7) {
    $randomIndex = rand(0, count($palabras) - 1);
    $palabraAlAzar = explode(':', $palabras[$randomIndex]);
    $palabra1 = trim($palabraAlAzar[0]);
    $palabra2 = trim($palabraAlAzar[1]);
	$palabrasAlAzar[] = ['english' => $palabra1, 'spanish' => $palabra2];
  }
  header('Content-Type: application/json');
  echo json_encode(['palabras' => $palabrasAlAzar]);
}