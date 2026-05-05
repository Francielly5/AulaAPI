CREATE TABLE pizzas (
    idPizza INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    ingredientes VARCHAR(255) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
);
INSERT INTO pizzas (nome, ingredientes, valor) VALUES
('Calabresa', 'Mussarela, calabresa fatiada e cebola', 45.50),
('Mussarela', 'Mussarela e molho de tomate', 40.00),
('Frango com Catupiry', 'Frango desfiado, catupiry e mussarela', 52.90),
('Portuguesa', 'Mussarela, presunto, ovo, ervilha, cebola e calabresa', 62.90),
('Moda do Juca', 'Mussarela, peito de peru, palmito, alho poró e alcaparras', 72.50);
SELECT * FROM pizzas

--------

CREATE TABLE bebidas(
    idBebidas INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(30) NOT NULL,
    categoria VARCHAR (10) NOT NULL,
    tamanho SMALLINT NOT NULL,
    valor DECIMAL(10,3) NOT NULL
);

INSERT INTO bebidas (nome, categoria, tamanho, valor) VALUES 
('Sol', 'Com álcool','600ml', 13.00),
('Guaraná', 'Com gás','2L', 16.00),
('Água mineral', 'Sem gás', '250ml', 5.00),
('Dell Vale Laranja', 'Sem corante','200ml', 7.00),
('Gin', 'Com álcool', '350ml',18.00);