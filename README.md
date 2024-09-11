# O Patusco - Clínica de Pets

## Descrição

Sistema desenvolvido para auxiliar na gestão de uma clínica veterinária, onde os clientes podem agendar consultas, recepcionistas podem gerenciar as consultas e médicos podem visualizar e editar consultas atribuídas a eles.

O sistema é composto por um **backend** desenvolvido em **Laravel** e um **frontend** em **Vue.js** com **Vuetify**, ambos comunicando-se através de uma API REST.

## Funcionalidades

- **Clientes**:
    - Agendar novas consultas
    - Ver suas consultas
- **Recepcionistas**:
    - Ver todas as consultas
    - Atribuir médicos às consultas
    - Editar e excluir consultas
- **Médicos**:
    - Ver as consultas atribuídas a eles
    - Editar suas consultas
- **Administração**:
    - Gerenciar todos os usuários e funções

## Tecnologias Utilizadas

### Backend (API)
- **Laravel 11**
- **Laravel Sail** (ambiente de desenvolvimento Docker)
- **Sanctum** para autenticação API
- **MySQL** (como banco de dados)

### Frontend
- **Vue.js 3**
- **Vuetify** (framework de componentes de interface)
- **Axios** para requisições HTTP

## Estrutura de Diretórios
   ```
├── patusco-api
│   ├── app
│   ├── config
│   ├── database
│   ├── routes
│   └── ...
├── patusco-frontend
│   ├── public
│   ├── src
│   ├── components
│   ├── views
│   └── ...
    ```
   ```

## Pré-requisitos

Para rodar este projeto, você precisa ter instalados:
- PHP 8.1+
- Composer
- Docker e Docker Compose
- Node.js 16+ e NPM

## Instalação e Configuração

### Configuração Automatizada

1. Clone o repositório:
    ```bash
    git clone <url>
    ```
   
2. Acesse o diretório do projeto:
    ```bash
    cd patusco-clinic
    ```

Execute o script de configuração automática que verifica e instala as dependências necessárias e prepara o ambiente:

1. Certifique-se de que o script tem permissões de execução:
   ```bash
   chmod +x setup.sh
    ```
2. Execute o script:
    ```bash
    ./setup.sh
     ```
   
### Configuração Manual
Backend (patusco-api)
1. Instale as dependências do Laravel:
    ```bash
    composer install
    ```
2. Copie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente:
    ```bash
    cp .env.example .env
    ```
3. Gere a chave de aplicação:
    ```bash
    php artisan key:generate
    ```
4. Configure o ambiente de desenvolvimento com Docker:
    ```bash
    php artisan sail:install
    ```
5. Inicie o ambiente de desenvolvimento:
    ```bash
    ./vendor/bin/sail up
    ```
6. Execute as migrações e seeders:
    ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```
Frontend (patusco-frontend)
1. Instale as dependências do Vue.js:
    ```bash
    npm install
    ```
2. Inicie o servidor de desenvolvimento:
    ```bash
    npm run dev
    ```
   
## Uso
### Backend (patusco-api)
1. Acesse a API em `http://localhost`
2. A API está protegida por autenticação Sanctum. Para acessar os endpoints da API, você precisa autenticar-se e fornecer um token de autorização nos headers da requisição.
3. Para autenticar-se, faça uma requisição POST para `http://localhost/api/login` com o email e senha de um usuário cadastrado. O token de autorização será retornado no corpo da resposta.
4. Para acessar os endpoints protegidos, adicione o token de autorização nos headers da requisição:
    ```http
    Authorization Bearer <token>
    ```
### Frontend (patusco-frontend)
1. Acesse o frontend em `http://localhost:5174`
2. O frontend é uma aplicação SPA que se comunica com a API REST do backend. Você pode navegar pelas páginas e interagir com os componentes da interface.
3. Para acessar as páginas protegidas, você precisa autenticar-se e fornecer um token de autorização. O frontend armazena o token de autorização em localStorage e o envia nos headers de todas as requisições.
4. Para autenticar-se, faça login com um usuário cadastrado. O token de autorização será armazenado em localStorage e enviado nos headers de todas as requisições.
5. Para sair, faça logout. O token de autorização será removido de localStorage.
6. O frontend é responsivo e se adapta a diferentes tamanhos de tela.

## Testes
### Backend (patusco-api)
1. Execute os testes:
    ```bash
    ./vendor/bin/sail pest
    ```