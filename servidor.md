# Instalação e Configuração do laravel em um servidor

---

## 1. Atualizar o Sistema

Antes de instalar qualquer pacote, é sempre importante atualizar a lista de pacotes e os pacotes já instalados.  
**Comando:**

```bash
sudo apt update && sudo apt upgrade -y
```

- **sudo apt update:** Atualiza a lista de pacotes disponíveis a partir dos repositórios.
- **sudo apt upgrade -y:** Atualiza os pacotes instalados para as últimas versões disponíveis (o `-y` confirma automaticamente as atualizações).

---

## 2. Instalar o Apache2

O Apache2 é o servidor web que irá servir o seu projeto Laravel.  
**Comando:**

```bash
sudo apt install apache2 -y
```

- **sudo apt install apache2:** Instala o servidor web Apache2.
- **-y:** Aceita automaticamente as confirmações de instalação.

Após a instalação, pode verificar se o Apache está a funcionar, acedendo ao IP do servidor ou a `http://localhost` num navegador.

---

## 3. Instalar o PHP 8.2 e as Dependências do Laravel

Laravel necessita do PHP e de algumas extensões. Vamos instalar o PHP 8.2 e as extensões mais comuns utilizadas pelo Laravel:

**Passo 3.1: Adicionar o repositório do PHP (se necessário)**  
Em algumas distribuições, pode ser necessário adicionar um repositório que contenha o PHP 8.2:

```bash
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
```

- **software-properties-common:** Ferramenta que facilita a gestão de repositórios.
- **add-apt-repository:** Adiciona o repositório que contém versões atualizadas do PHP.
- **sudo apt update:** Atualiza a lista de pacotes para incluir os novos repositórios.

**Passo 3.2: Instalar o PHP 8.2 e extensões**  

```bash
sudo apt install php8.2 php8.2-common php8.2-cli php8.2-fpm php8.2-mbstring php8.2-xml php8.2-zip php8.2-curl php8.2-mysql -y
```

- **php8.2:** Instala o núcleo do PHP 8.2.
- **php8.2-common:** Pacotes comuns para o PHP.
- **php8.2-cli:** Instalação da interface de linha de comando do PHP.
- **php8.2-fpm:** PHP FastCGI Process Manager, útil se for usar o Nginx ou se preferir separar processos do PHP.
- **php8.2-mbstring:** Extensão para manipulação de strings multibyte.
- **php8.2-xml:** Suporte para processamento de XML.
- **php8.2-zip:** Permite a manipulação de ficheiros ZIP.
- **php8.2-curl:** Biblioteca para transferências de dados com URLs.
- **php8.2-mysql:** Extensão para interação com bases de dados MySQL.

---

## 4. Instalar o MySQL

O MySQL será utilizado para gerir a base de dados do seu projeto Laravel.  
**Comando:**

```bash
sudo apt install mysql-server -y
```

- **mysql-server:** Instala o servidor MySQL.
- **-y:** Aceita automaticamente a instalação.

Após a instalação, recomenda-se executar o script de segurança do MySQL para definir a password do root e outras configurações de segurança:

```bash
sudo mysql_secure_installation
```

Siga as instruções fornecidas pelo script, que incluem:
- Configurar a password para o usuário root (se ainda não estiver configurado).
- Remover usuários anónimos.
- Desabilitar o login remoto do usuário root.
- Remover a base de dados de teste.

---

## 5. Instalar o Composer

O Composer é o gestor de dependências do PHP e é essencial para instalar o Laravel e os seus pacotes.  
**Comandos:**

```bash
sudo apt install curl -y
curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```

- **curl -sS:** Faz download silencioso do instalador do Composer.
- **php composer-setup.php:** Executa o script de instalação do Composer.
- **--install-dir=/usr/local/bin:** Define o diretório onde o Composer será instalado, permitindo que seja executado de qualquer lugar.
- **--filename=composer:** Define o nome do executável (neste caso, `composer`).

Verifique a instalação com:

```bash
composer --version
```

---

## 6. Configurar o Projeto Laravel

**Passo 6.1: Clonar ou criar o projeto Laravel**  
Se já tiver o projeto num repositório Git, clone-o:

```bash
cd /var/www
sudo git clone <URL-do-repositório> nome-do-projeto
sudo chown -R $USER:$USER nome-do-projeto
```

- **/var/www:** Diretório comum para hospedar sites no Apache.
- **git clone:** Clona o repositório do projeto.
- **chown -R $USER:$USER nome-do-projeto:** Altera a propriedade dos ficheiros para o seu utilizador atual, facilitando edições e configurações.

Se ainda não tiver o projeto, pode criar um novo com o Composer:

```bash
composer create-project laravel/laravel nome-do-projeto
```

**Passo 6.2: Configurar as permissões**

No Laravel, é necessário que os diretórios `storage` e `bootstrap/cache` tenham permissões de escrita. Execute:

```bash
sudo chown -R www-data:www-data /var/www/nome-do-projeto/storage /var/www/nome-do-projeto/bootstrap/cache
sudo chmod -R 775 /var/www/nome-do-projeto/storage /var/www/nome-do-projeto/bootstrap/cache
```

- **www-data:** É o utilizador e grupo padrão com que o Apache corre.
- **chmod -R 775:** Dá permissões de leitura, escrita e execução ao proprietário e ao grupo, e de leitura e execução para outros.

---

## 7. Configurar o Subdomínio no Apache

Para que o seu projeto Laravel seja acedido através de um subdomínio (por exemplo, `laravel.seudominio.com`), é necessário criar um novo ficheiro de configuração para o Apache.

**Passo 7.1: Criar o ficheiro de configuração**

Crie um ficheiro de configuração para o subdomínio:

```bash
sudo nano /etc/apache2/sites-available/laravel.seudominio.com.conf
```

No editor, adicione o seguinte conteúdo:

```apacheconf
<VirtualHost *:80>
    ServerName laravel.seudominio.com
    DocumentRoot /var/www/nome-do-projeto/public

    <Directory /var/www/nome-do-projeto/public>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/laravel_error.log
    CustomLog ${APACHE_LOG_DIR}/laravel_access.log combined
</VirtualHost>
```

- **ServerName:** Define o subdomínio a ser utilizado.
- **DocumentRoot:** Define a pasta pública do Laravel, onde se encontra o ficheiro `index.php`.
- **<Directory>:** Configura permissões e permite o uso do arquivo `.htaccess` (com `AllowOverride All`).
- **ErrorLog / CustomLog:** Define onde serão guardados os logs de erro e acesso.

Guarde e feche o editor (no nano, utilize `Ctrl+O` para guardar e `Ctrl+X` para sair).

**Passo 7.2: Ativar a nova configuração e o módulo de reescrita**

Ative o novo site e o módulo `rewrite`:

```bash
sudo a2ensite laravel.seudominio.com.conf
sudo a2enmod rewrite
```

- **a2ensite:** Ativa o ficheiro de configuração do site.
- **a2enmod rewrite:** Ativa o módulo que permite reescritas de URL, essencial para o funcionamento do Laravel.

Em seguida, reinicie o Apache para aplicar as mudanças:

```bash
sudo systemctl restart apache2
```

---

## 8. Configurar a Base de Dados para o Laravel

Aceda ao MySQL para criar a base de dados e o utilizador que serão usados pelo Laravel:

```bash
sudo mysql -u root -p
```

Depois, no prompt do MySQL, execute os seguintes comandos (substitua `nomedabase`, `usuario_laravel` e `senha_segura` pelos valores desejados):

```sql
CREATE DATABASE nomedabase CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'usuario_laravel'@'localhost' IDENTIFIED BY 'senha_segura';
GRANT ALL PRIVILEGES ON nomedabase.* TO 'usuario_laravel'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

- **CREATE DATABASE:** Cria a base de dados com suporte para caracteres especiais.
- **CREATE USER:** Cria um utilizador para o Laravel.
- **GRANT ALL PRIVILEGES:** Concede todas as permissões à base de dados criada para esse utilizador.
- **FLUSH PRIVILEGES:** Atualiza os privilégios sem precisar reiniciar o MySQL.
- **EXIT:** Sai do prompt do MySQL.

Em seguida, atualize o ficheiro `.env` do Laravel (localizado na raiz do projeto) com os dados da base de dados:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nomedabase
DB_USERNAME=usuario_laravel
DB_PASSWORD=senha_segura
```

---

## 9. Finalizar a Instalação do Projeto Laravel

Para terminar a instalação, instale as dependências do projeto Laravel com o Composer:

```bash
cd /var/www/nome-do-projeto
composer install
```

Se for uma instalação nova, poderá também gerar a chave da aplicação:

```bash
php artisan key:generate
```

- **composer install:** Instala todas as dependências definidas no `composer.json`.
- **php artisan key:generate:** Gera e define a chave de encriptação da aplicação no ficheiro `.env`.

---

## Conclusão

Seguindo estes passos, instalou e configurou com sucesso:
- O Apache2 como servidor web.
- PHP 8.2 com todas as extensões necessárias para o Laravel.
- MySQL para a gestão da base de dados.
- Um subdomínio que aponta para a pasta `public` do projeto Laravel.

