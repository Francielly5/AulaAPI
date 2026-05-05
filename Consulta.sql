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
<<<<<<< HEAD
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
=======

SELECT * FROM pizzas;

CREATE TABLE bebidas (
    idBebida INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    tamanho VARCHAR(20) NOT NULL ,
    valor DECIMAL(8,2) NOT NULL,
    categoria ENUM('ALCOOLICO', 'NAO_ALCOOLICO') NOT NULL
);

INSERT INTO bebidas (nome, tamanho, valor, categoria) VALUES
('Coca-Cola', '350ml', 6.50, 'NAO_ALCOOLICO'),
('Guaraná Antarctica', '2L', 12.00, 'NAO_ALCOOLICO'),
('Água Mineral', '500ml', 3.00, 'NAO_ALCOOLICO'),
('Heineken', '330ml', 9.00, 'ALCOOLICO'),
('Skol', 'Lata 350ml', 5.50, 'ALCOOLICO');

SELECT * FROM bebidas;
>>>>>>> c3b7d8e818d315357b736b135add9f6e3500f4ba
