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

    public function create(){
        $query = 'INSERT INTO ' . $this->tabela . ' SET nome = :nome, categoria = :categoria, tamanho = :tamanho, valor = :valor';
 
        // Preparar a query
        $stmt = $this->conn->prepare($query);
 
        // Limpar os dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));
        $this->tamanho = htmlspecialchars(strip_tags($this->tamanho));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
 
        // Vincular os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':tamanho', $this->tamanho);
        $stmt->bindParam(':valor', $this->valor);
 
        // Executar a query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function update() {
        // Query de atualização
        $query = 'UPDATE ' . $this->tabela . ' SET nome=:nome, categoria=:categoria,tamanho=:tamanho, valor=:valor WHERE idBebidas=:id';
 
        // Preparar a query
        $stmt = $this->conn->prepare($query);
 
        // Limpar os dados
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));
        $this->tamanho = htmlspecialchars(strip_tags($this->tamanho));
        $this->valor = htmlspecialchars(strip_tags($this->valor));
        $this->idBebidas = htmlspecialchars(strip_tags($this->idBebidas));
 
        // Vincular os parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':tamanho', $this->tamanho);
        $stmt->bindParam(':valor', $this->valor);
        $stmt->bindParam(':id', $this->idBebidas);
 
        // Executar a query
        if($stmt->execute()) {
            return true;
        }
     
        return false;
    }
 
 public function delete() {
        $query = 'DELETE FROM ' . $this->tabela . ' WHERE idBebidas=:id';
 
        // Preparar a query
        $stmt = $this->conn->prepare($query);
 
        // Limpar os dados
        $this->idBebidas = htmlspecialchars(strip_tags($this->idBebidas));
 
        // Vincular os parâmetros
        $stmt->bindParam(':id', $this->idBebidas);
 
        // Executar a query
        if ($stmt->execute()) {
            return $stmt->rowCount() > 0;
        }
     
        return false;
    }
}

