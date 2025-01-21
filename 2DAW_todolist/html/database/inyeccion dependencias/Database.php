<?php

    class Database 
    {

        public function __construct(private DatabaseConnectorInterface $conexion) { }

        /**
         * @return void
         */
        public function connect(): void 
        {
            $this->conexion->connect() ;
        }

        /**
         * @return void
         */
        public function prepare(string $sql): void 
        {
            $this->conexion->prepare($sql) ;
        }

        /**
         * @return void
         */
        public function query(array $params = []): void 
        {
            $this->conexion->query($params) ;
        }


    }