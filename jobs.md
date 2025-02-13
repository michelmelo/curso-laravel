### **1. Configurando MySQL para Filas**

#### **Passo 1: Configurar o Driver de Filas para MySQL**

No Laravel, o MySQL pode ser usado como sistema de filas sem nenhuma instalação adicional. Primeiro, configure o driver no arquivo `.env`:

```env
QUEUE_CONNECTION=database
```

---

#### **Passo 2: Criar a Tabela de Jobs**

O Laravel já tem uma migration padrão para a tabela de jobs. Rode o seguinte comando para criá-la no banco de dados:

```bash
php artisan queue:table
php artisan migrate
```

Esse comando cria uma tabela chamada `jobs` no banco de dados. Essa tabela armazenará as tarefas pendentes de execução.

---

### **2. Criar um Job**

Use o Artisan para criar um job:

```bash
php artisan make:job ProcessaEnvio
```

Isso criará o arquivo `app/Jobs/ProcessaEnvio.php`.

Abra o arquivo e defina a lógica do job. Exemplo:

```php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessaEnvio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $dados;

    /**
     * Cria uma nova instância do job.
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Executa o job.
     */
    public function handle()
    {
        // Lógica para processar o envio
        \Log::info('Processando envio: ' . json_encode($this->dados));
    }
}
```

---

### **3. Adicionar Prioridades às Filas**

Para usar filas de prioridade, você pode definir diferentes **nomes de filas** e despachar jobs para elas.

#### Exemplo de despachar para a fila **normal**:
```php
use App\Jobs\ProcessaEnvio;

// Dados a serem processados
$dados = ['email' => 'user@example.com', 'nome' => 'Usuário'];

// Despacha para a fila normal
ProcessaEnvio::dispatch($dados)->onQueue('normal');
```

#### Exemplo de despachar para a fila **urgente**:
```php
use App\Jobs\ProcessaEnvio;

// Dados a serem processados
$dados = ['email' => 'admin@example.com', 'nome' => 'Administrador'];

// Despacha para a fila urgente
ProcessaEnvio::dispatch($dados)->onQueue('urgente');
```

---

### **4. Processar as Filas**

No MySQL, os jobs são processados na ordem em que entram na tabela `jobs`, mas você pode dar prioridade à fila **urgente** antes da fila **normal** ao rodar os workers.

#### **Worker para processar somente a fila urgente**:
```bash
php artisan queue:work --queue=urgente
```

#### **Worker para processar somente a fila normal**:
```bash
php artisan queue:work --queue=normal
```

#### **Worker para processar ambas as filas com prioridade para urgente**:
```bash
php artisan queue:work --queue=urgente,normal
```

Com isso, os jobs na fila `urgente` serão processados antes dos jobs na fila `normal`.

---

### **5. Monitorar as Filas no MySQL**

Os jobs ficam armazenados na tabela `jobs`. Você pode monitorar os seguintes estados:

- **Jobs pendentes**: Estão na tabela `jobs`.
- **Jobs processados com sucesso**: Movidos para a tabela `jobs` de histórico (se configurado).
- **Jobs com falha**: Estão na tabela `failed_jobs`.

Para criar a tabela de jobs com falhas, execute:

```bash
php artisan queue:failed-table
php artisan migrate
```

Agora, qualquer job que falhar será armazenado na tabela `failed_jobs`.

---

### **6. Testar o Sistema**

1. Crie jobs para ambas as filas (exemplo: dispare vários envios usando `ProcessaEnvio`).
2. Execute workers para as filas `urgente` e `normal`.
3. Verifique o comportamento: a fila `urgente` deve ser processada antes da `normal`.

---

### **7. Configurações Opcionais**

#### Retentativas de Jobs com Falha:
No MySQL, você pode configurar quantas vezes um job deve ser tentado antes de falhar. Isso pode ser configurado diretamente no worker:

```bash
php artisan queue:work --tries=3
php artisan queue:restart
```

#### Timeout de Processamento:
Se o job exceder o tempo máximo permitido, ele será marcado como falha:

```bash
php artisan queue:work --timeout=90
```

---

Com isso, você está pronto para usar o sistema de filas no Laravel com MySQL e diferentes prioridades. 🎉
