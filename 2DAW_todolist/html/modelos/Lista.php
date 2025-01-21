<?php

    require_once "database/Database.php" ;

    /**
     * Modelo LISTA
     */

    class Lista 
    {
        # propiedades del modelo (atributos de la tabla)
        private int $idLis ;
        private string $nombre ;

         /**         
         * @return string
         */
        public function getId(): int
        {
            return $this->idLis ;
        }

        /**         
         * @return string
         */
        public function getNombre(): string 
        {
            return $this->nombre ;
        }

        /**
         * @param string $nombre
         * @return void
         */
        public function setNombre(string $nombre) 
        {
            $this->nombre = $nombre ;
        }        

        /**
         * @return void
         */
        public function update(): void
        {
            $sql = "UPDATE lista SET nombre=:nom WHERE idLis = :id ;" ;
            Database::init()->prepare($sql)->query([":id"  => $this->idLis, 
                                                    ":nom" => $this->nombre]) ;
        }

        /**
         * Inserta un registro en la BD        
         * @param string $nombre
         * @return void
         */
        public static function save(string $nombre): void 
        {
            $sql = "INSERT INTO lista (nombre) VALUES (:nom) ;" ;
            Database::init()->prepare($sql)->query([":nom" => $nombre]) ;
        }

        /**
         * Borra un registro LISTA de la base de datos
         * @return void
         */
        public static function delete(int $id): void 
        {
            $sql = "DELETE FROM lista WHERE idLis = :id ;" ;
            Database::init()->prepare($sql)->query([":id" => $id]) ;
        }

        /**
         * @param integer $id
         * @return Lista
         */
        public static function getById(int $id): Lista
        {
            $sql = "SELECT * FROM lista WHERE idLis = :id;" ;
            return Database::init()->prepare($sql)
                                   ->query([":id" => $id])
                                   ->one("Lista") ;
        }

        /**
         * Recupera todos los registros de la tabla LISTA         
         * @return array
         */
        public static function list(): array 
        {    
            #$db = new Database(new MYSQLIConnection) ;
            return Database::init()->prepare("SELECT * FROM lista ;")
                                   ->query()
                                   ->all("Lista") ;
        }
    }
    

