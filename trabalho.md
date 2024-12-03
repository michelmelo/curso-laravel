# **Projeto Laravel: Gestão de Empresas e Documentos**

## **Descrição Geral**
O objetivo deste projeto é criar uma aplicação web usando o framework Laravel. A aplicação terá funcionalidades básicas de autenticação, gestão de utilizadores, empresas e documentos. Os documentos devem estar associados a empresas específicas.

---

## **Requisitos do Projeto**

### **1. Configuração Inicial**
1. Configure um novo projeto Laravel usando o comando:
   ```bash
   laravel new nome-do-projeto
   ```
2. Certifique-se de que o servidor local esteja configurado para rodar o projeto:
   - **PHP**: Versão mínima 8.0.
   - **MySQL**: Base de dados para armazenar informações.
   - **Servidor Apache ou Nginx**.
3. Configure o arquivo `.env` para se conectar à sua base de dados.

### **2. Funcionalidades Necessárias**

#### **Autenticação**
1. Implemente o sistema de autenticação utilizando o comando:
   ```bash
   php artisan make:auth
   ```
2. Configure as rotas de login, registo e logout.

#### **Área de Utilizadores**
1. Após o login, o utilizador deve ser redirecionado para o **Painel do Utilizador**.
2. O Painel deve exibir:
   - O nome do utilizador.
   - Links para as seções: **Empresas** e **Documentos**.

#### **Gestão de Empresas**
1. Crie uma tabela para armazenar informações das empresas:
   - Nome da empresa.
   - Endereço.
   - Telefone.
   - Data de criação.
2. Permita que os utilizadores possam:
   - **Criar** novas empresas.
   - **Editar** informações de empresas existentes.
   - **Excluir** empresas.

#### **Gestão de Documentos**
1. Crie uma tabela para armazenar os documentos:
   - Nome do documento.
   - Descrição.
   - Caminho do arquivo (upload).
   - Empresa associada (chave estrangeira).
   - Data de criação.
2. Permita que os utilizadores possam:
   - **Adicionar** novos documentos.
   - **Editar** informações de documentos existentes.
   - **Excluir** documentos.
3. Garanta que cada documento esteja **associado a uma empresa**.

---

## **Estrutura do Banco de Dados**

### **Tabela: Users**
| Campo        | Tipo       | Descrição              |
|--------------|------------|------------------------|
| id           | Integer    | Identificador único.   |
| name         | String     | Nome do utilizador.    |
| email        | String     | E-mail do utilizador.  |
| password     | String     | Senha do utilizador.   |
| created_at   | Timestamp  | Data de criação.       |
| updated_at   | Timestamp  | Data de atualização.   |

### **Tabela: Companies**
| Campo        | Tipo       | Descrição              |
|--------------|------------|------------------------|
| id           | Integer    | Identificador único.   |
| name         | String     | Nome da empresa.       |
| address      | String     | Endereço da empresa.   |
| phone        | String     | Telefone da empresa.   |
| created_at   | Timestamp  | Data de criação.       |
| updated_at   | Timestamp  | Data de atualização.   |

### **Tabela: Documents**
| Campo        | Tipo       | Descrição              |
|--------------|------------|------------------------|
| id           | Integer    | Identificador único.   |
| name         | String     | Nome do documento.     |
| description  | Text       | Descrição do documento.|
| file_path    | String     | Caminho do arquivo.    |
| company_id   | Integer    | Empresa associada.     |
| created_at   | Timestamp  | Data de criação.       |
| updated_at   | Timestamp  | Data de atualização.   |

---

## **Entrega do Projeto**
1. O projeto deverá ser entregue via repositório GitHub.
   - Certifique-se de incluir o arquivo `README.md` explicando como configurar e rodar a aplicação.
2. O prazo final de entrega é **[data a definir]**.

---

## **Critérios de Avaliação**
1. Funcionamento correto das funcionalidades descritas.
2. Organização e clareza do código.
3. Uso adequado das ferramentas do Laravel (Eloquent, migrations, controllers, etc.).
4. Design básico e funcionalidade das interfaces (opcional).

Boa sorte com o desenvolvimento! 
