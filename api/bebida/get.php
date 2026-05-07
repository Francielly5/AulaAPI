<?php
// CRIAÇÃO ROTA GET.PHP
// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Incluir arquivos de banco de dados e modelo
include_once '../../config/Database.php';
include_once '../../models/Bebida.php';

// Somente permitir GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(array("message" => "Método não permitido. Use GET."));
    exit;
}

// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();

// Instanciar o objeto Bebida
$bebida = new Bebida($db);
$bebida->idBebidas = isset($_GET['id']) ? $_GET['id'] : null;

if (!$bebida->idBebidas) {
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(array("message" => "ID da bebida não informado."));
    exit;
}

if ($bebida->get()) {
    $bebida_arr = array(
        "id" => $bebida->idBebidas,
        "nome" => $bebida->nome,
        "categoria" => $bebida->categoria,
        "tamanho" => $bebida->tamanho,
        "valor" => $bebida->valor
    );

    header("HTTP/1.1 200 OK");
    echo json_encode($bebida_arr, 128);
} else {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(array("message" => "Bebida não encontrada."));
}

?>