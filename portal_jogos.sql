CREATE DATABASE portal_jogos;
USE portal_jogos;

CREATE TABLE usuarios (
id_user INT (10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
usuario VARCHAR (50) NOT NULL UNIQUE,
senha VARCHAR (100) NOT NULL,
cad_valido BIT NOT NULL, /* 0 para false e 1 para true*/
administrador BIT NOT NULL /* 0 para false e 1 para true*/
);

UPDATE usuarios SET cad_valido = 1, administrador = 1 WHERE usuario = 'admin@gmail.com.br';

CREATE TABLE pontos_jogos (
id_jogada INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fk_usuario VARCHAR(50) NOT NULL REFERENCES usuarios (usuario),
nome_jogo VARCHAR(50) NOT NULL,
pontos INT NOT NULL DEFAULT 0
);

SELECT * FROM usuarios;
SELECT * FROM pontos_jogos;
DROP TABLE usuarios;
DROP TABLE pontos_jogos;