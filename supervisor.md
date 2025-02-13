## **Passo 1: Instalar o Supervisor**

1. **Atualize os pacotes do sistema:**
   ```bash
   sudo apt update && sudo apt upgrade -y
   ```

2. **Instale o Supervisor:**
   ```bash
   sudo apt install supervisor -y
   ```

3. **Verifique se o Supervisor está em execução:**
   ```bash
   sudo systemctl status supervisor
   ```

   Você deve ver o serviço ativo. Caso não esteja, inicie-o:
   ```bash
   sudo systemctl start supervisor
   sudo systemctl stop supervisor
   sudo systemctl enable supervisor
   ```

---

## **Passo 2: Configurar o Supervisor para o Laravel**

### Exemplo: Configurar para rodar a fila do Laravel (`queue:work`)

1. **Crie um arquivo de configuração do Supervisor para o Laravel:**
   ```bash
   sudo nano /etc/supervisor/conf.d/laravel-worker.conf
   ```

2. **Adicione a configuração abaixo ao arquivo:**
   ```ini
   [program:laravel-worker]
   process_name=%(program_name)s_%(process_num)02d
   command=php /caminho/para/seu/projeto/artisan queue:work --queue=chat  --tries=3
   autostart=true
   autorestart=true
   user=www-data
   numprocs=1
   redirect_stderr=true
   stdout_logfile=/caminho/para/seu/projeto/storage/logs/worker.log
   stopwaitsecs=3600
   ```
   ```ini
   [program:laravel-worker]
   process_name=%(program_name)s_%(process_num)02d
   command=php /caminho/para/seu/projeto/artisan queue:work --queue=normal --sleep=10 --tries=3
   autostart=true
   autorestart=true
   user=www-data
   numprocs=1
   redirect_stderr=true
   stdout_logfile=/caminho/para/seu/projeto/storage/logs/worker.log
   stopwaitsecs=3600
   ```

   **Explicação:**
   - `command`: O comando que o Supervisor deve executar.
   - `autostart`: Inicia automaticamente o processo ao carregar o Supervisor.
   - `autorestart`: Reinicia o processo caso ele falhe.
   - `user`: Define o usuário que executará o comando. Geralmente `www-data` para servidores web.
   - `stdout_logfile`: Define o arquivo de log para registrar as saídas.

3. **Salve e feche o arquivo (CTRL+O, ENTER, CTRL+X).**

---

## **Passo 3: Carregar e iniciar a configuração**

1. **Atualize as configurações do Supervisor:**
   ```bash
   sudo supervisorctl reread
   sudo supervisorctl update
   ```

2. **Inicie o programa configurado:**
   ```bash
   sudo supervisorctl start laravel-worker:*
   ```

3. **Verifique se está rodando:**
   ```bash
   sudo supervisorctl status
   ```

---

## **Passo 4: Gerenciar o Supervisor**

Comandos úteis para gerenciar o Supervisor:
- **Ver status de processos:**
  ```bash
  sudo supervisorctl status
  ```

- **Parar um processo:**
  ```bash
  sudo supervisorctl stop laravel-worker:*
  ```

  php artisan websockets:serve --host 0.0.0.0 --port 6000

- **Reiniciar um processo:**
  ```bash
  sudo supervisorctl restart laravel-worker:*
  ```

- **Ver logs:**
  ```bash
  tail -f /caminho/para/seu/projeto/storage/logs/worker.log
  ```

---

## **Passo 5: Verificar o funcionamento**

1. Certifique-se de que o Laravel está processando as filas:
   - Adicione tarefas à fila no Laravel.
   - Monitore o log configurado em `stdout_logfile`.

2. Caso encontre problemas:
   - Verifique os logs do Supervisor:
     ```bash
     sudo cat /var/log/supervisor/supervisord.log
     ```
   - Certifique-se de que as permissões estão corretas para o usuário `www-data`.

---

Este setup deve garantir que o Supervisor gerencie o comando do Laravel automaticamente. Se precisar de ajuda adicional, é só avisar! 😊