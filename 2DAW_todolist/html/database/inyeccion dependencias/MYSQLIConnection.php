<?php

class PDOConnection implements DatabaseConnectorInterface
{
    public function connect(): void ;
        public function prepare(string $sql): void ;
        public function query(array $params = []): void ;
}