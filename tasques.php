<?php
if (PHP_SAPI !== 'cli') {
    die("Este script solo se puede ejecutar en la línea de comandos (CLI).\n");
}

$archiu_json = 'tareas.json';

function cargarTareasJSON($archiu) {
    if (file_exists($archiu)) {
        $json_data = file_get_contents($archiu);
        return json_decode($json_data, true);
    }
    return [];
}

<<<<<<< HEAD
function MarcarTareas($archiu_json, $id) {
    global $tareas;
    if (isset($tareas[$id])) {
        $tareas[$id]['completada'] = true;
        guardarTareasJSON($archiu_json, $tareas);
        echo "La tarea $id se ha marcado como completada.\n";
    } else {
        echo"No se ha encontrado ninguna tarea con el identificador $id.\n";
    }
}

=======
>>>>>>> 6b3dc13e00ec486b2ff9e87f44ad4b20e119a45d
function guardarTareasJSON($archiu, $tareas){
    $json_data = json_encode($tareas, JSON_PRETTY_PRINT);
    if (file_put_contents($archiu, $json_data) !== false) {
        echo "Las tareas se han guardado correctamente en el archivo $archiu.\n";
    } else {
        echo "Error al guardar las tareas en $archiu.\n";
    }
}

$tareas = cargarTareasJSON($archiu_json);

function generarID($cadena) {
<<<<<<< HEAD
    return substr(sha1($cadena), 0, 2);
}

function afegirTarea($archiu_json, $descripcion) {
=======
    return substr(sha1($cadena), 0, 5);
}

function afegirTarea($descripcion) {
>>>>>>> 6b3dc13e00ec486b2ff9e87f44ad4b20e119a45d
    global $tareas;
    $id = generarID($descripcion);
    $dataAfegit = date('Y-m-d H:i:s');
    $tareas[$id] = [ 'descripcion' => $descripcion, 'dataAfegit' => $dataAfegit, 'completada' => false];
    guardarTareasJSON($archiu_json, $tareas);
    return $id;
}

function llistarTareas() {
    global $tareas;
    echo "Tareas pendientes:\n";
    foreach ($tareas as $id => $tarea) {
        echo "- $id: {$tarea['descripcion']} (Añadida el {$tarea['dataAfegit']})";
        if ($tarea['completada']) {
            echo " completada\n";
        } else {
            echo "\n";
        }
    }
}

<<<<<<< HEAD
function eliminarTarea( $archiu_json, $id) {
=======
function eliminarTarea($id) {
>>>>>>> 6b3dc13e00ec486b2ff9e87f44ad4b20e119a45d
    global $tareas;
    if (isset($tareas[$id])) {
        unset($tareas[$id]);
        guardarTareasJSON($archiu_json, $tareas);
        echo "La tarea $id se ha eliminado.\n";
    } else {
        echo "No se ha encontrado ninguna tarea con el identificador $id.\n";
    }
}

while (true) {
    echo "Opciones:\n";
    echo "A. Añadir tarea\n";
    echo "B. Listar tareas\n";
    echo "C. Marcar tarea como completada\n";
    echo "D. Eliminar tarea\n";
    echo "F. Salir\n";
    $opcion = readline();

    switch ($opcion) {
        case 'A':
        case 'a':
            echo "Introduce la descripción de la tarea: ";
            $descripcion = readline();
<<<<<<< HEAD
            $id = afegirTarea($archiu_json, $descripcion);
=======
            $id = afegirTarea($descripcion);
>>>>>>> 6b3dc13e00ec486b2ff9e87f44ad4b20e119a45d
            echo "Se ha añadido una nueva tarea con el identificador $id.\n";
            break;

        case 'B':
        case 'b':
            llistarTareas();
            break;

        case 'C':
        case 'c':
            echo "Introduce el identificador de la tarea a marcar como completada: ";
            $id = readline();
<<<<<<< HEAD
            MarcarTareas($archiu_json, $id);
=======
            eliminarTarea($id);
>>>>>>> 6b3dc13e00ec486b2ff9e87f44ad4b20e119a45d
            break;

        case 'D':
        case 'd':
            echo "Introduce el identificador de la tarea a eliminar: ";
            $id = readline();
<<<<<<< HEAD
            eliminarTarea($archiu_json, $id);
=======
            eliminarTarea($id);
>>>>>>> 6b3dc13e00ec486b2ff9e87f44ad4b20e119a45d
            break;

        case 'F':
        case 'f':
            echo "Saliendo del programa.\n";
            exit(0);

        default:
            echo "Opción no válida. Por favor, selecciona una opción del 1 al 5.\n";
            break;
    }
}
?>
