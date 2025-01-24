<?php

    namespace Controladores ;

    abstract class BaseController 
    {
        private \Twig\Environment $twig ;

        public function __construct() 
        {
            $loader = new \Twig\Loader\FilesystemLoader("vistas") ;
            $this->twig = new \Twig\Environment($loader) ;
        }

        /**
         * @param string $plantilla
         * @param array $args
         * @return void
         */
        public function render(string $plantilla, array $args = [])
        {
            echo $this->twig->render($plantilla, $args) ;
        }
    }