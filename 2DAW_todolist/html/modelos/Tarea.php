<?php

    namespace Modelos;

    use Database\Database;

/**
 * Modelo TAREA
 */
class Tarea 
{
    # propiedades del modelo (atributos de la tabla)
    private int $idTar;
    private int $idLis;
    private string $fecha;
    private string $texto;
    private int $completada;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->idTar;
    }

    /**
     * @return int
     */
    public function getIdLis(): int
    {
        return $this->idLis;
    }

    /**
     * @return string
     */
    public function getFecha(): string
    {
        return $this->fecha;
    }

    /**
     * @return string
     */
    public function getTexto(): string
    {
        return $this->texto;
    }

    /**
     * @return int
     */
    public function getCompletada(): int
    {
        return $this->completada;
    }

    /**
     * @param string $fecha
     * @return void
     */
    public function setFecha(string $fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param string $texto
     * @return void
     */
    public function setTexto(string $texto)
    {
        $this->texto = $texto;
    }

    /**
     * @param int $completada
     * @return void
     */
    public function setCompletada(int $completada)
    {
        $this->completada = $completada;
    }

    /**
     * @return void
     */
    public function update(): void
    {
        $sql = "UPDATE tarea SET fecha=:fecha, texto=:texto, completada=:completada WHERE idTar = :id;";
        Database::init()->prepare($sql)->query([
            ":id" => $this->idTar,
            ":fecha" => $this->fecha,
            ":texto" => $this->texto,
            ":completada" => $this->completada
        ]);
    }

    /**
     * Inserta un registro en la BD
     * @param int $idLis
     * @param string $fecha
     * @param string $texto
     * @param int $completada
     * @return void
     */
    public static function save(int $idLis, string $fecha, string $texto, int $completada): void
    {
        $sql = "INSERT INTO tarea (idLis, fecha, texto, completada) VALUES (:idLis, :fecha, :texto, :completada);";
        Database::init()->prepare($sql)->query([
            ":idLis" => $idLis,
            ":fecha" => $fecha,
            ":texto" => $texto,
            ":completada" => $completada
        ]);
    }

    /**
     * Borra un registro TAREA de la base de datos
     * @return void
     */
    public static function delete(int $id): void
    {
        $sql = "DELETE FROM tarea WHERE idTar = :id;";
        Database::init()->prepare($sql)->query([":id" => $id]);
    }

    /**
     * @param integer $id
     * @return Tarea
     */
    public static function getById(int $id): Tarea
    {
        $sql = "SELECT * FROM tarea WHERE idTar = :id;";
        return Database::init()->prepare($sql)
                               ->query([":id" => $id])
                               ->one("Modelos\\Tarea");
    }

    /**
     * Recupera todos los registros de la tabla TAREA
     * @return array
     */
    public static function list(): array
    {
        return Database::init()->prepare("SELECT * FROM tarea;")
                               ->query()
                               ->all("Modelos\\Tarea");
    }
        /**
     * Recupera todas las tareas asociadas a una lista específica
     * @param int $idLis
     * @return array
     */
    public static function listByListaId(int $idLis): array
    {
        $sql = "SELECT * FROM tarea WHERE idLis = :idLis;";
        return Database::init()->prepare($sql)
                               ->query([":idLis" => $idLis])
                               ->all("Modelos\\Tarea");
    }

    public static function complete(int $id): void
    {
        $sql = "UPDATE tarea SET completada = 1 WHERE idTar = :id;";
        Database::init()->prepare($sql)->query([":id" => $id]);
    }

    public static function uncomplete(int $id): void
    {
        $sql = "UPDATE tarea SET completada = 0 WHERE idTar = :id;";
        Database::init()->prepare($sql)->query([":id" => $id]);
    }

    public static function completeAll(int $idLis): void
    {
        $sql = "UPDATE tarea SET completada = 1 WHERE idLis = :idLis;";
        Database::init()->prepare($sql)->query([":idLis" => $idLis]);
    }
}