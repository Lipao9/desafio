GERENCIADOR DE REUNIÕES

Gerencie os participantes do seu evento de reuniões e coffee breaks em duas etapas diferentes.

Pré-requisitos

Antes de começar, você precisa ter o seguinte instalado no seu sistema:

 - PHP (preferencialmente versão 8.x ou superior)
 - Composer
 - MySQL (caso prefira rodar localmente) ou Docker (para rodar com contêineres)
 - Docker e Docker Compose (caso deseje usar Docker)

Como Configurar o Ambiente

1. Clonando o Repositório
   
Clone o repositório para sua máquina local:

    git clone https://github.com/seu-usuario/seu-repositorio.git
    cd seu-repositorio

2. Configuração do Arquivo .env
Copie o arquivo .env.example para um novo arquivo .env:

    cp .env.example .env

Configuração do Banco de Dados

Abra o arquivo .env e configure as variáveis de ambiente para o banco de dados.

Para uso local com MySQL, configure as variáveis conforme abaixo:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_banco
    DB_USERNAME=usuario
    DB_PASSWORD=senha

Para rodar com Docker, modifique para o seguinte:

    DB_CONNECTION=mysql
    DB_HOST=db

3. Instalar Dependências
Agora, instale as dependências do projeto:

    composer install

4. Gerar a Chave de Aplicação
Em seguida, gere a chave de aplicação do Laravel:

    php artisan key:generate

Agora sua aplicação está pronta para ser executada, seja localmente ou via Docker.

-----------------------------------------------------------------------------------

Como Rodar a Aplicação

Com Docker
Se você optar por rodar a aplicação em um ambiente Docker, siga os passos abaixo:

1. Subir o Docker: Para iniciar a aplicação e os contêineres:

   docker compose up

2. Executar as Migrações: Execute as migrações do banco de dados dentro do contêiner:

    docker compose exec app php artisan migrate

3. Popular o Banco de Dados (Opcional): Caso deseje popular o banco com dados iniciais, execute o comando:

   docker compose exec app php artisan db:seed

Localmente
Se preferir rodar a aplicação diretamente no seu ambiente local, siga os passos abaixo:

1. Executar as Migrações: Rodar as migrações do banco de dados:

    php artisan migrate

2. Popular o Banco de Dados (Opcional): Caso deseje rodar o seeder para popular o banco, use o comando:

   php artisan db:seed

3. Rodar a Aplicação Localmente: Para rodar a aplicação localmente, use o servidor embutido do Laravel:

   php artisan serve

   






