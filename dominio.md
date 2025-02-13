Aqui está um tutorial passo a passo para criar um subdomínio no servidor Apache2.

---

## 🚀 Como Criar um Subdomínio no Servidor Apache2

### ✅ Passo 1: Criar o Diretório do Subdomínio

Antes de configurar o Apache, precisamos criar o diretório onde os arquivos do subdomínio ficarão armazenados.

```bash
sudo mkdir -p /var/www/meusite.com
```

```bash
git clone https://github.com/michelmelo/curso-laravel.git meusite.com
sudo chown -R $USER:$USER /var/www/meusite.com
sudo nano /etc/apache2/sites-available/meusite.com.conf
composer install
chmod -R 777 storage/ bootstrap/
```

<VirtualHost *:80>
    ServerName meusite.com
    DocumentRoot /var/www/meusite.com

    <Directory /var/www/meusite.com>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/curso_michelmelo_pt_error.log
    CustomLog ${APACHE_LOG_DIR}/curso_michelmelo_pt_access.log combined

</VirtualHost>




Agora, conceda as permissões necessárias:

```bash
sudo chown -R $USER:$USER /var/www/meusite.com
sudo chown -R www-data:www-data /var/www/meusite.com
sudo chmod -R 755 /var/www/ #opcional
```

Crie um arquivo de teste para verificar se o subdomínio funcionará:

```bash
echo "<h1>Subdomínio Funcionando!</h1>" | sudo tee /var/www/meusite.com/index.html
```

---

### ✅ Passo 2: Criar um Virtual Host no Apache

Agora, crie um novo arquivo de configuração para o subdomínio:

```bash
sudo nano /etc/apache2/sites-available/meusite.com.conf
```

Adicione o seguinte conteúdo:
meusite.com
```
<VirtualHost *:80>
    ServerName meusite.com
    ServerAlias www.meusite.com 
    ServerAdmin eu@meusite.com 
    DocumentRoot /var/www/meusite.com/public/

    <Directory /var/www/meusite.com/public/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/curso_michelmelo_pt_error.log
    CustomLog ${APACHE_LOG_DIR}/curso_michelmelo_pt_access.log combined
</VirtualHost>
```

Salve e saia (`CTRL + X`, depois `Y` e `ENTER`).

---

### ✅ Passo 3: Habilitar o Novo Virtual Host

Ative o novo site com:

```bash
sudo a2ensite meusite.com.conf
```

Reinicie o Apache para aplicar as alterações:

```bash
sudo systemctl restart apache2
```

---

### ✅ Passo 4: Configurar o DNS (Se Necessário)

Se o servidor estiver na internet, vá ao painel do seu provedor de domínio e crie um registro **A** ou **CNAME** para o subdomínio apontando para o IP do seu servidor.

---

### ✅ Passo 5: Testar o Subdomínio

Abra um navegador e acesse:

```
http://meusite.com
```

Se tudo estiver certo, verá a mensagem **"Subdomínio Funcionando!"**.

Caso esteja testando localmente, adicione o subdomínio ao arquivo `/etc/hosts`:

```bash
sudo nano /etc/hosts
```

E adicione esta linha:

```
127.0.0.1 meusite.com
```

Agora, tente acessar pelo navegador novamente.

---

### ✅ Passo 6: Configurar SSL (Opcional, mas Recomendado)

Para adicionar um certificado SSL gratuito via **Let's Encrypt**, instale o `certbot`:

```bash
sudo apt install certbot python3-certbot-apache
```

E execute:

```bash
sudo certbot
sudo certbot --apache -d meusite.com
```

Siga as instruções e pronto! 🚀

---





```bash
git clone https://github.com/michelmelo/curso-laravel.git seunome.michelmelo.pt
composer install



```