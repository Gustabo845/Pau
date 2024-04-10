
0bash: line 1: tasques.php
<?php
if (PHP_SAPI === 'cli') {
	echo  "Estas en el CLI\n";
} else {
	die("Este script solo se puede ejecutar en la linea de comandos (CLI).\n");
}

$archiu_json = 'tareas.json';

function cargarTascaJSON($archiu) {
	if (file_exists($archiu)) {
		$json_data = file_get_contents($archiu);
		return json_decode($json_data, true);
	}
	return [];
}


function guardarTareasJSON($archiu, $tasca){
	$json_data = json_encode($tasca, JSON_PRETTY_PRINT);
	if (file_put_contents($archiu, $json_data) !== false) {
		echo "Les tasques s'han guardat correctament en el archiu $archiu.\n";
	} else {
		echo "Error al guardar les tasques enl $archiu.\n";
	}
}

$tasques = cargarTascaJSON($archiu);


$tasques = [];
function generarID($cadena) {
	return substr(sha1($cadena), 0, 5);
}

function afegirTasca($descripcio) {
	global $tasques;
	$id = generarID($descripcio);
	$dataAfegit = date('Y-m-d H:i:s');
	$tasques[$id] = [ 'descripcio' => $descripcio, 'dataAfegit' => $dataAfegit, 'completada' => false];
	return $id;
}

function llistarTasques() {
	global $tasques;
	echo "Tasques pendents:\n";
	foreach ($tasques as $id => $tasca) {
		echo "- $id: {$tasca['descripcio']} (Afegida el {$tasca['dataAfegit']}";
		if ($tasca['completada']) {
			echo "completada\n";
		} else {
			echo "\n";
		}
	}
}
function eliminarTasca($id) {
	global $tasques;
	if (isset($tasques[$id])) {
		unset($tasques[$id]);
		echo "La tasca $id s'ha eliminat.\n";
	} else {
		echo "No s'ha trobat cap tasca amb l'dentifcador $id.\n";
	}
}

while (true) {
	echo "Opcions:\n";
	echo "A. Afegir tasca\n";
	echo "B. llistar tasques\n";
	echo "C. Marcar tasca com a completada\n";
	echo "D. Eiminar tasca\n";
	echo "F. Sortir\n";
	$opcio = readline();

	switch ($opcio) {
		case 'A':
		case 'a':
			echo "Introdueix la descripció de la tasca: ";
			$descripcio = readline();
			$id = afegirTasca($descripcio);
			echo "S'ha afegit una nova tasca amb l'identificador $id.\n";
			$tasques[] = ['id' => $id, 'descripcio' => $descripcio, 'completada' => false];
			echo "Tasca afegida amb ID: $id\n";
			break;

		case 'B':
		case 'b':
			llistarTasques();
			break;
		case 'C':
		case 'c':
			echo "Introdueix l'identificador de la tasca a marcar com a completada: ";
			$id = readline();
			eliminarTasca($id);
			break;
		case 'D':
		case 'd':
			echo "Introdueix l'identificador de la tasca a eliminar: ";
			$id = readline();
			eliminarTasca($id);
			break;
		case 'F':
		case 'f':
			echo "Sortint del programa.\n";
			exit(0);
		default:
			echo "Opcio no valida. Si us plau, selecciona una opció del 1 al 5.\n";
			break;
	}
}
?>
