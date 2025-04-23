# Controlador de Eventos

## Descrição

Este é um projeto desenvolvido em **Laravel**, onde os usuários podem:

- **Visualizar eventos** disponíveis para participação.
- **Anunciar eventos**, permitindo que outras pessoas também possam participar.

É uma plataforma simples para quem deseja organizar ou participar de eventos de diversos tipos, oferecendo uma interface intuitiva tanto para quem deseja criar eventos quanto para quem quer apenas participar deles.

## Funcionalidades

- **Cadastro de usuários** para gerenciar eventos.
- **Visualização de eventos** já criados por outros usuários.
- **Criação de novos eventos** com informações detalhadas (data, descrição, local).
- **Edição e exclusão de eventos** para quem é o criador.
- **Sistema de login** configurado com **Jetstream** para autenticação de usuários.
- **Interface amigável** baseada em **Blade**, com um design simples e eficiente.

## Tecnologias Utilizadas

- **Laravel 8+**: Framework PHP para o backend.
- **Blade**: Motor de templates para a renderização das views.
- **MySQL**: Banco de dados relacional utilizado para armazenar os dados dos usuários e eventos.
- **Bootstrap**: Framework CSS para um design simples e responsivo.
- **Jetstream**: Pacote Laravel para autenticação de usuários (login, registro, etc.).
- **Node.js**: Necessário para rodar os pacotes JavaScript e compilar as assets com **npm**.

## Pré-requisitos

Antes de rodar o projeto, você precisa ter instalado em sua máquina:

- [PHP 8.x ou superior](https://www.php.net/)
- [Composer](https://getcomposer.org/) para gerenciar as dependências do Laravel
- [Node.js e npm](https://nodejs.org/) para instalar pacotes JavaScript e compilar as assets
- [MySQL](https://www.mysql.com/) ou outro banco de dados compatível com o Laravel
