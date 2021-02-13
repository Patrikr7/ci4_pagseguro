# CI4 - Integração com PagSeguro

### **Configuração**

1º Abra o arquivo 'app/Config/Constants/Constants.php' e altere as linhas:
```bash
// BANCO DE DADOS
defined('HOSTNAME') || define('HOSTNAME', 'seu_hostname');
defined('USERNAME') || define('USERNAME', 'seu_username');
defined('PASSWORD') || define('PASSWORD', 'seu_password');
defined('DATABASE') || define('DATABASE', 'seu_database');
```
```bash
// DADOS PAGSEGURO
defined('PAG_ENV') || define('PAG_ENV', 'sandbox_ou_production');
defined('PAG_EMAIL') || define('PAG_EMAIL', 'seu_email');
defined('PAG_TOKEN') || define('PAG_TOKEN', 'seu_token_sandbox_ou_production');
```
- Primeiro bloco é a configuração do seu banco de dados e o segundo bloco é a configuração do seu PagSeguro (Sandbox ou Production).

2º Após ter feito a configuração do banco de dados, abra seu terminal e acesse o projeto. Em seguida execute os comando abaixo:
 ```bash
 // Migra todas as tabelas já prontas
 php spark migrate
 ```
 - Em seguida:
  ```bash
  // Irá popular as tabelas do banco de dados
  php spark sb:seed ProductsSeeder
  ```
  