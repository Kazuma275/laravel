<?php

require_once "BaseController.php";
require_once __DIR__ . '/../modelos/Lista.php'; // Usa __DIR__ para obtener el directorio actual
require_once __DIR__ . '/../modelos/Tarea.php';

/**
 * Controlador TAREA
 */
class TareaController extends BaseController
{
    /**
     * Lista todas las tareas
     * @return void
     */
    public function list(): void 
    {
        $idLis = $_GET['id'];
        $lista = Lista::getById($idLis);
        $tareas = Tarea::listByListaId($idLis);
        $this->render("tareas/tareas.php.twig", ["lista" => $lista, "tareas" => $tareas]);
    }

    /**
     * Crea una nueva tarea
     * @return void
     */
    public function create(): void 
    {
        $idLis = $_GET['idLis'];
        if (empty($_POST)):
            $this->render("tareas/crear.php.twig", ["idLis" => $idLis]);
        else:
            // Verifica que los datos del formulario están presentes antes de llamar a Tarea::save
            if (isset($_POST["idLis"], $_POST["fecha"], $_POST["texto"], $_POST["completada"])) {
                Tarea::save((int)$_POST["idLis"], $_POST["fecha"], $_POST["texto"], (int)$_POST["completada"]);
                die(header("location: /tareas/$idLis"));
            } else {
                // Manejo de error si faltan datos del formulario
                die("Error: Faltan datos del formulario.");
            }
        endif;
    }

    /**
     * Actualiza una tarea existente
     * @return void
     */
    public function update(): void 
    {
        # recuperamos la tarea
        $tarea = Tarea::getById($_GET["id"]);

        if (empty($_POST)):
            $this->render("tareas/editar.php.twig", ["tarea" => $tarea]);
        else:
            # si estoy recibiendo información POST
            $tarea->setFecha($_POST["fecha"]);
            $tarea->setTexto($_POST["texto"]);
            $tarea->setCompletada($_POST["completada"]);
            $tarea->update(); # tell don't ask

            # redirigir a la pantalla principal
            die(header("location: http://localhost"));
        endif;
    }

    public function complete(): void 
    {
        $tarea = Tarea::getById($_GET["id"]);
        Tarea::complete($_GET["id"]);
        die(header("location: /tareas/" . $tarea->getIdLis()));
    }

    /**
     * Elimina una tarea existente
     * @return void
     */
    public function delete(): void 
    {
        Tarea::delete($_GET["id"]);
        die(header("location: http://localhost"));
    }
}