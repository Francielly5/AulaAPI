<?php
// CRIAÇÃO ROTA GETALL.PHP
 
// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// Incluir arquivos de banco de dados e modelo
include_once '../../config/Database.php';
include_once '../../models/Pizza.php';
 
// Instanciar o objeto Database e obter a conexão
$database = new Database();
$db = $database->getConnection();
 
// Instanciar o objeto Pizza
$pizza = new Pizza($db);
 



// try{ colocar para demonstrar erro com coluna errada mas lá no método read em pizza
    // Chamar o método read() para buscar as pizzas

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $stmt = $pizza->getall();
    $num = $stmt->rowCount();
 
    // Verificar se mais de 0 registros foram encontrados
    if ($num > 0) {
        // Array de pizzas
        $pizzas_arr = array();
 
        // Percorrer o resultado da consulta
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // A função extract transforma $row['nome'] em apenas $nome
            extract($row);

            //Um array que representará um assoc com um elemento(cada pizza)
            $pizza_item = array(
                "id" => $idPizza,
                "nome" => $nome,
                "ingredientes" => $ingredientes,
                "valor" => $valor
            );
 
            array_push($pizzas_arr, $pizza_item); //formato assoc
        }
 
        // Definir o código de resposta como 200 OK

        //versão atual : http_response_code(200); 
        
        //VERSÃO ANTIGA UTILIZANDO ABAIXO:
     header("http/1.1 200 OK");
 
        // Mostrar os dados das pizzas em formato JSON
        echo json_encode($pizzas_arr);
    } else {
        // Se nenhuma pizza for encontrada, definir o código de resposta como 404 Not Found
     
        //versão atual: http_response_code(404);

        //VERSÃO ANTIGA SENDO UTILIZADA ABAIXO: 
        header("http/1.1 404 Not found");
 
        // Informar ao usuário que nenhuma pizza foi encontrada
        echo json_encode(
            array("message" => "Nenhuma pizza encontrada.")
        );
    }

    } else{
 
    // Se o método HTTP não for GET, definir o código de resposta como 405 Method Not Allowed
    header("HTTP/1.1 405 Method Not Allowed");
 
    // Informar ao usuário que o método não é permitido
    echo json_encode(
        array("message" => "Método não permitido. Use GET.")
    );
 
}
// }
// catch (Exception $e) {
//  echo json_encode(array("erro" => $e->getMessage()));
// }