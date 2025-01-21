<?php

    # Controlador FRONTAL

    require_once "excepciones/MVCException.php" ;

    use Excepciones\MVCException;

    # echo "<pre>".print_r($datos, true)."</pre>" ;

    # Controlador Frontal
    $metodo = $_GET["op"]??"list" ;
    $modelo = $_GET["mo"]??"lista" ;

    # construimos el nombre del controlador
    $nombreControlador = "{$modelo}Controller" ;

    # importamos el controlador
    $ruta = "controladores/{$nombreControlador}.php" ;
    if (file_exists($ruta)) require_once $ruta ;
    else
        throw new MVCException("Se ha producido un fallo accediendo al controlador.") ;

    # instanciamos el controlador
    $controlador = new $nombreControlador ;

    # invocamos el método solicitado
    if (method_exists($controlador, $metodo)) $controlador->$metodo() ;
    else
        throw new MVCException("Se ha producido un fallo accediendo al controlador.") ;
