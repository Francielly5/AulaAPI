<?php

// criação da rota GETALL.PHP

// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Incluir arquivos de banco de dados e modelo
include_once '../../config/Database.php';
include_once '../../models/Pizza.php';

// Somente permitir GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(array("message" => "Método não permitido. Use GET."));
    exit;
}

// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();

// Instanciar o objeto Pizza
$pizza = new Pizza($db);

// Chamar o método read() para buscar as pizzas
$stmt = $pizza->read();
$pizzas_arr = array();

if ($stmt && $stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $pizza_item = array(
            "id" => $idPizza,
            "nome" => $nome,
            "ingredientes" => $ingredientes,
            "valor" => $valor
        );

        array_push($pizzas_arr, $pizza_item);
    }

    header("HTTP/1.1 200 OK");
    echo json_encode($pizzas_arr);
} else {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(array("message" => "Nenhuma pizza encontrada."));
}
