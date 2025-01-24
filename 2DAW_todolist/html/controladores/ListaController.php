<?php

    namespace Controladores ;

    use Modelos\Lista;
    
    /**
     * Controlador LISTA
     */

    class ListaController extends BaseController
    {

        /**
         * Undocumented function
         *
         * @return void
         */
        public function list(): void 
        {
            $datos = Lista::list() ;
            $this->render("listas/listas.php.twig", ["datos" => $datos] ) ;
        }

        /**
         * @return void
         */
        public function create(): void 
        {
            if (empty($_POST)):
                $this->render("listas/crear.php.twig") ;
            else:

                Lista::save($_POST["nombre"]) ;

                # redirigir a la pantalla principal
                die(header("location: http://localhost")) ;
            endif ;
        }

        /**
         * @return never
         */
        public function update(): void 
        {
            # recuperamos la lista
            $lista = Lista::getById($_GET["id"]) ;

            if (empty($_POST)):
                $this->render("listas/editar.php.twig", ["lista" => $lista]) ;
            else :

                # si estoy recibiendo información POST
                $lista->setNombre($_POST["nombre"]) ;
                $lista->update() ; # tell don't ask

                # redirigir a la pantalla principal
                die(header("location: http://localhost")) ;

            endif ;
        }

        /**
         * @return void
         */
        public function delete(): void 
        {
            Lista::delete($_GET["id"]) ;
            die(header("location: http://localhost")) ;
        }

        
    }