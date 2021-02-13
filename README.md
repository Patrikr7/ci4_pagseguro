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

2º Após ter feito a configuração do banco de dados, abra seu terminal e acesse o projeto. Em seguida execute os comandos abaixo:
 ```bash
 // Migra todas as tabelas já prontas
 php spark migrate
 ```
 - Em seguida:
  ```bash
  // Irá popular as tabelas do banco de dados
  php spark db:seed ProductsSeeder
  ```
  
3º No arquivo 'app/Views/web/cart.php' alterar o input email para o email do 'Comprador de Testes':
```bash
<input type="email" class="form-control" id="input-email" name="email" value="email-comprador-de-teste@sandbox.pagseguro.com.br">
```
4º Caso necessite usar o próprio servidor interno do framework, abre o terminal e digite o comando abaixo:
 ```bash
 php spark serve
 ```
 - Após este comando, acesse o projeto assim http://localhost:8080
 
5º Acesse a página sandbox do PagSeguro para fazer as configurações:
- https://sandbox.pagseguro.uol.com.br/vendedor/configuracoes.html
    * Notificação de Transações: Essa configuração permite que seu sistema seja avisado sempre que uma transação muda de estado.
        * Url do projeto, exemplo: http://localhost:8080/notification
    * Página de redirecionamento: Ao final do pagamento você pode configurar uma página para redirecionarmos o seu cliente.
        *   A. Página fixa de redirecionamento
            * Url do projeto, exemplo: http://localhost:8080/transacao
        *   B. Redirecionamento com o código da transação
            * Ao redirecionar o cliente para sua página, já podemos enviar o código da transação no PagSeguro, você pode escolher qual será o nome desse parâmetro. (Escolha o parâmetro: transaction_id)
         
6º Os dados do comprador de teste está na página: 
- https://sandbox.pagseguro.uol.com.br/comprador-de-testes.html

7º As transações:
- https://sandbox.pagseguro.uol.com.br/transacoes.html

Este projeto foi desenvolvido seguindo as aulas do canal Dicas Codeigniter no Youtube e acrescentando algumas melhorias.