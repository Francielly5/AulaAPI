<?php

class Bebida{
    private $conn;
    private $tabela = 'bebidas';

    public $idBebidas;
    public $nome;
    public $categoria;
    public $tamanho;
    public $valor;

    public function __construct($db) {
        $this-> conn = $db;
    }

    public function getall(){
        //Salvando a query SQL em uma variável
        $query = "SELECT idBebidas, nome, categoria, tamanho, valor FROM " . $this->tabela;

        //Preparando a query para ser executada, usando a conexão com o banco de dados
        $stmt = $this->conn->prepare($query);

        //Executando a query no Banco de Dados
        $stmt->execute();

        //Retornando o resultado da query
        return $stmt;
    }

    public function get(){
        $query = "SELECT idBebidas, nome, categoria, tamanho, valor FROM " . $this->tabela . " WHERE idBebidas = :idBebidas LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idBebidas', $this->idBebidas, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->nome = $row['nome'];
            $this->categoria = $row['categoria'];
            $this->tamanho = $row['tamanho'];
            $this->valor = $row['valor'];
            return true;
        }

        return false;
    }
}