DROP SCHEMA IF EXISTS math_game;
CREATE SCHEMA IF NOT EXISTS math_game;
USE math_game;

CREATE TABLE games (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(200) NOT NULL,
    telefone VARCHAR(16) NOT NULL,
    acertos INT NOT NULL DEFAULT 0,
    data_game DATETIME NOT NULL DEFAULT NOW()
);

# INSERT INTO games(nome, email, telefone, acertos) VALUE ('ADMIN', 'adm@adm.adm', '(00) 9 0000-0000', 15);