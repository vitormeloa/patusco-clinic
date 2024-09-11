#!/bin/bash

command_exists () {
    command -v "$1" >/dev/null 2>&1 ;
}

install_package () {
    sudo apt-get install -y "$1"
}

echo "Verificando dependências..."

if ! command_exists php ; then
    echo "PHP não encontrado, instalando..."
    sudo apt-get update
    install_package php
    install_package php-cli
    install_package php-mbstring
    install_package php-xml
    install_package php-zip
fi

if ! command_exists composer ; then
    echo "Composer não encontrado, instalando..."
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
fi

if ! command_exists docker ; then
    echo "Docker não encontrado, instalando..."
    sudo apt-get update
    install_package docker.io
    sudo systemctl start docker
    sudo systemctl enable docker
fi

if ! command_exists docker-compose ; then
    echo "Docker Compose não encontrado, instalando..."
    sudo curl -L "https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
fi

if ! command_exists node ; then
    echo "Node.js não encontrado, instalando..."
    curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
    install_package nodejs
fi

if ! command_exists npm ; then
    echo "NPM não encontrado, instalando..."
    install_package npm
fi

echo "Dependências verificadas e instaladas."

echo "Configurando o backend (patusco-api)..."
cd patusco-api

if [ ! -f .env ]; then
    cp .env.example .env
fi

composer install

./vendor/bin/sail up -d

./vendor/bin/sail artisan migrate:fresh --seed

cd ..

echo "Configurando o frontend (patusco-frontend)..."
cd patusco-frontend

npm install

npm run dev

echo "Projeto configurado com sucesso!"
