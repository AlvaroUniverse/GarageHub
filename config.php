<?php
/*
//! 1 - Necessita que tenha o próprio arquivo .env adequado ao projeto
//! 2 - Necessita ter o gerenciador de dependências Composer instalado e digitar no terminal: 'composer install' para instalar as bibliotecas que necessita para rodar o projeto

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Configurar o Banco de Dados do site

$DB_HOST = $_ENV['DB_HOST'];
$DB_USER = $_ENV['DB_USER'];
$DB_NAME = $_ENV['DB_NAME'];
$DB_PASSWORD = $_ENV['DB_PASSWORD'];
*
?>