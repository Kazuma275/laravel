<?php

    # Controlador FRONTAL
    require_once 'vendor/autoload.php' ;
    
    use Exception\MVCException;
    # echo "<pre>".print_r($datos, true)."</pre>" ;
    
    # Controlador Frontal
    $metodo = $_GET["op"]??"list" ;
    $modelo = $_GET["mo"]??"lista" ;
    
    # construimos el nombre del controlador
    $nombreControlador = "{$modelo}Controller" ;
    
    # importamos el controlador
    $ruta = "controladores/{$nombreControlador}.php" ;

    if (file_exists($ruta)) {

    $namespaceClass = "Controladores\\{$nombreControlador}" ;
    } else
        throw new MVCException("Se ha producido un fallo accediendo al controlador.") ;

    # instanciamos el controlador
    $controlador = new $namespaceClass ;

    # invocamos el método solicitado
    if (method_exists($controlador, $metodo)) $controlador->$metodo() ;
    else
        throw new MVCException("Se ha producido un fallo accediendo al controlador.") ;