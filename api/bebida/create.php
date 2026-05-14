<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
 
include_once '../../config/Database.php';
include_once '../../models/Bebida.php';
 
// Instanciar o banco de dados e conectar
$database = new Database();
$db = $database->getConnection();
 
// Instanciar o objeto Bebida
$bebida = new Bebida($db);
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Obter os dados postados
        $data = json_decode(file_get_contents("php://input"));
 
        // Verificar se os dados não estão vazios
        if (
            !empty($data->nome) &&
            !empty($data->categoria) &&
            !empty($data->tamanho)&&
            !empty($data->valor)
        ) {
            // Atribuir os valores ao objeto bebida
            $bebida->nome = $data->nome;
            $bebida->categoria = $data->categoria;
            $bebida->tamanho = $data->tamanho;
            $bebida->valor = $data->valor;
 
            // Criar a bebida
            if ($bebida->create()) {
           header("HTTP/1.1 201 Created");
                // Resposta de sucesso
                echo json_encode(
                    array('Mensagem' => 'Bebida Criada com Sucesso')
                );
            } else {
                header("HTTP/1.1 503 Service Unavailable");
                // Resposta de erro
                echo json_encode(
                    array('Mensagem' => 'Nao foi possivel criar a Bebida')
                );
            }
        } else {
            header("HTTP/1.1 400 Bad Request");
            // Resposta se dados estiverem incompletos
            echo json_encode(
                array('Mensagem' => 'Dados Incompletos. Nao foi possivel criar a Bebida.')
            );
        }
    } catch (Exception $e) {
        echo json_encode(array("erro" => $e->getMessage()));
    }
} else {
header("HTTP/1.1 400 Bad Request");
    echo json_encode(array("erro" => "Método não suportado!"));
}