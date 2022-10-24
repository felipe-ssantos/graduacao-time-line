CREATE SCHEMA loja_web
# Pratique Unidade 04 | Aluno: Nelson Felipe S. Santos
CREATE TABLE cidade (
    id SERIAL PRIMARY KEY,
	primeiro_nome VARCHAR(255) NOT NULL,
	ultimo_nome VARCHAR(255) NOT NULL,
	data_nascimento DATE NOT NULL
);
# Pratique Unidade 04 | Aluno: Nelson Felipe S. Santos
CREATE TABLE categoria (
    id SERIAL PRIMARY KEY,
	nome VARCHAR(255) NOT NULL UNIQUE
);
# Pratique Unidade 04 | Aluno: Nelson Felipe S. Santos
CREATE TABLE curso (
    id SERIAL PRIMARY KEY,
	nome VARCHAR(255) NOT NULL,
	categoria_id INTEGER NOT NULL REFERENCES categoria(id)
);
# Pratique Unidade 04 | Aluno: Nelson Felipe S. Santos
CREATE TABLE aluno_curso (
	aluno_id INTEGER NOT NULL REFERENCES aluno(id),
	curso_id INTEGER NOT NULL REFERENCES curso(id),
	PRIMARY KEY (aluno_id, curso_id)
);

# Pratique Unidade 04 | Aluno: Nelson Felipe S. Santos

