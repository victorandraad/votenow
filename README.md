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


# Documentação do Sistema VoteNow

Esta documentação conta a história do sistema VoteNow, em três grandes partes, mostrando o que foi feito e como cada parte mudou.

## Parte 1 - Funcionando, Mas Sem Estilo

Na primeira parte, o sistema estava funcionando, mas não tinha cores bonitas ou imagens. Tudo estava muito simples, como uma página sem desenhos.

**O que foi Feito:**

- Fizemos o sistema funcionar para que as pessoas pudessem votar.
- Criamos o botão para entrar e sair do sistema.
- Fizemos todas as partes importantes funcionarem, mesmo sem ter aparência bonita.

**Testes que Fizemos:**

- Verificamos se as pessoas conseguiam entrar e sair do sistema sem problemas.
- Testamos se as pessoas conseguiam criar salas de votação e votar.

**Resultados:**

- Tudo estava funcionando, mas não era bonito nem fácil de usar.

## Parte 2 - Ficou Bonito e Mais Fácil de Usar

Na segunda parte, deixamos o sistema mais bonito. Adicionamos cores e fizemos tudo ficar mais organizado.

**O que foi Feito:**

- Colocamos estilos e cores no sistema para ele ficar mais amigável e fácil de entender.
- Organizamos os arquivos para que tudo ficasse mais arrumado.

**Testes que Fizemos:**

- Vimos se as cores e os desenhos apareciam bem em diferentes tamanhos de tela.
- Testamos se era fácil para as pessoas clicarem nos botões e usarem o sistema.
- Conferimos se o sistema estava usando as configurações certas para funcionar.

**Resultados:**

- O sistema ficou mais bonito e as pessoas acharam mais fácil de usar.
- Alguns ícones não apareciam direito, mas isso foi anotado para ser consertado.

## Parte 3 - Ajustando o Design e Adicionando o Modo Escuro

Agora estamos na terceira parte, onde estamos fazendo o modo escuro e deixando o design ainda melhor. Ainda estamos trabalhando nessa parte.

**O que Estamos Fazendo:**

- Adicionando um modo escuro, para que as pessoas possam escolher entre fundo claro ou escuro.
- Ajustando as páginas para que fiquem bonitas e funcionem bem em diferentes aparelhos.
- Consertando problemas que achamos enquanto testávamos.

**Bug Encontrado:**

- Durante os testes, vimos que, depois de votar, as pessoas eram levadas direto para a página de resultados, sem poder votar em outras coisas. Isso foi consertado.

**Testes que Fizemos:**

- Testamos se tudo estava alinhado e funcionando em celulares, computadores e tablets.
- Verificamos o problema de votar e ser levado para outra página.
- Conferimos se as coisas novas que adicionamos não causaram problemas.

**Resultados:**

- O design melhorou muito, mas ainda precisamos consertar o bug da votação.
- O modo escuro ainda está sendo feito e precisa de mais testes.

---

Esta documentação mostra como o sistema VoteNow foi mudando, começando com uma versão simples, depois ficando mais bonito e, agora, ganhando ainda mais melhorias no design. Tudo foi feito para garantir que o sistema seja estável e fácil para as pessoas usarem.
