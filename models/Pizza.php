<?php

class Pizza {

    // conexão
    private $conn;

    // nome da tabela
    private $tabela = "pizzas";

    // atributos
    public $idPizza;
    public $nome;
    public $ingredientes;
    public $valor;

    // construtor
    public function __construct($db){
        $this->conn = $db;
    }

    // método READ
    public function read(){

        // query
        $query = "SELECT
                    idPizza,
                    nome,
                    ingredientes,
                    valor
                  FROM
                    " . $this->tabela;

        // prepara
        $stmt = $this->conn->prepare($query);

        // executa
        $stmt->execute();

        // retorna
        return $stmt;
    }

    // método GET (detalhar pizza por id)
    public function get(){
        $query = "SELECT
                    idPizza,
                    nome,
                    ingredientes,
                    valor
                  FROM
                    " . $this->tabela . "
                  WHERE
                    idPizza = :idPizza
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idPizza', $this->idPizza, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->nome = $row['nome'];
            $this->ingredientes = $row['ingredientes'];
            $this->valor = $row['valor'];
            return true;
        }

        return false;
    }
}
?>
