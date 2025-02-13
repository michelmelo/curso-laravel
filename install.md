# Como Instalar Apache2, MySQL, PHP 8.3 e Certbot no Ubuntu

Este tutorial orienta você na instalação do Apache2, MySQL, PHP 8.3 e Certbot em um servidor Ubuntu.

## Passo 1: Atualizar o Servidor

Antes de instalar os pacotes, atualize o sistema:

```bash
sudo apt update && sudo apt upgrade -y
```

## Passo 2: Instalar o Apache2

Instale o servidor Apache2 com o seguinte comando:

```bash
sudo apt install apache2 -y
```

Habilite e inicie o serviço Apache:

```bash
sudo systemctl enable apache2
sudo systemctl start apache2
```

Verifique se o Apache está rodando:

```bash
sudo systemctl status apache2
```

## Passo 3: Instalar o MySQL

Instale o MySQL Server:

```bash
sudo apt install mysql-server -y
```

Habilite e inicie o serviço MySQL:

```bash
sudo systemctl enable mysql
sudo systemctl start mysql
```

Execute o assistente de configuração de segurança do MySQL:

```bash
sudo mysql_secure_installation
```

Siga as instruções para definir uma senha segura e configurar a segurança do banco de dados.

## Passo 4: Instalar o PHP 8.3

Primeiro, adicione o repositório necessário:

```bash
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
```

Instale o PHP 8.3 e extensões comuns:

```bash
sudo apt install php8.3 php8.3-cli php8.3-mysql php8.3-curl php8.3-xml php8.3-mbstring php8.3-zip libapache2-mod-php8.3 -y
```

Verifique a versão do PHP:

```bash
php -v
```

Reinicie o Apache para aplicar as mudanças:

```bash
sudo systemctl restart apache2
```

## Passo 5: Instalar o Certbot para SSL (Let's Encrypt)

Instale o Certbot e o módulo Apache para o Certbot:

```bash
sudo apt install certbot python3-certbot-apache -y
```

Gere um certificado SSL para o seu domínio:

```bash
sudo certbot --apache -d seu-dominio.com -d www.seu-dominio.com
```

Renovação automática do certificado:

```bash
sudo certbot renew --dry-run
```

## Conclusão

Agora você tem um servidor Apache2 com PHP 8.3, MySQL e um certificado SSL ativo. Certifique-se de testar seu ambiente e configurar permissões adequadas para segurança adicional.

