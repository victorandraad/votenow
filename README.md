# VoteNow

**VoteNow** é uma aplicação para realizar votações de forma simples e prática. Com esta aplicação, os usuários podem criar e participar de enquetes em tempo real, votando em suas opções preferidas e visualizando os resultados instantaneamente.

## Funcionalidades

- Criação de enquetes com várias opções de escolha
- Participação de usuários em votações de forma simples e rápida
- Exibição de resultados em tempo real
- Interface amigável e fácil de usar

## Tecnologias Utilizadas

- **PHP**: Backend da aplicação.
- **Laravel**: Framework utilizado para gerenciar a lógica do servidor.
- **SQLite**: Banco de dados para armazenar as votações e resultados.
- **HTML/CSS/JavaScript/Blade**: Frontend para a interação com os usuários.

## Requisitos

- PHP 8.2 ou superior
- Composer
- SQLite
- Node.js (para gerenciamento de pacotes do frontend)
- Laravel (versão 8.x ou superior)

## Instalação

1. Clone este repositório:
    ```bash
    git clone https://github.com/victorandraad/votenow.git
    ```

2. Navegue até o diretório do projeto:
    ```bash
    cd votenow
    ```

3. Instale as dependências do PHP usando o Composer:
    ```bash
    composer install
    ```

4. Instale as dependências do Node.js:
    ```bash
    npm install
    ```

5. Execute as migrações do banco de dados:
    ```bash
    php artisan migrate
    ```

6. Para rodar o servidor e compilar os arquivos de estilo, execute um dos seguintes comandos:
    ```bash
    npm run build
    ```
    ou, para desenvolvimento:
    ```bash
    npm run dev
    ```

Agora, você pode acessar a aplicação no seu navegador em `http://localhost:8000`.

## Contribuições

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests.
