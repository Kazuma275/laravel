<?php

require_once "BaseController.php";
require_once __DIR__ . '/../modelos/Lista.php';
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
            // Verifica que los datos del formulario se pasen antes de guardarlos
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
            # si estoy recibiendo información POST y solo deseas actualizar el texto
            if (isset($_POST["nombre"])) {
                $tarea->setTexto($_POST["nombre"]);
                $tarea->update(); # tell don't ask
    
                # redirigir a la pantalla principal
                die(header("location: http://localhost"));
            } else {
                # Manejo de error si falta el dato del formulario
                die("Error: Falta el dato del formulario.");
            }
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

        /**
     * Completa todas las tareas de una lista
     * @return void
     */
    public function completeAll(): void 
    {
        $idLis = $_GET['id'];
        Tarea::completeAll($idLis);
        header("location: /tareas/$idLis");
        exit();
    }
        /**
     * Descompleta una tarea
     * @return void
     */
    public function uncomplete(): void 
    {
        $tarea = Tarea::getById($_GET["id"]);
        Tarea::uncomplete($_GET["id"]);
        header("Location: /tareas/" . $tarea->getIdLis());
        exit();
    }
}