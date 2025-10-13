# Projeto Laravel com Docker

## Acesso ao phpMyAdmin

Com o Docker rodando, é possível acessar o phpMyAdmin pelo link:

- [http://localhost:8075](http://localhost:8075)

**Usuário:** `root`  
**Senha:** `root`

## Acesso ao Backend

A URL base para acessar o backend é:

- [http://localhost:8005/api](http://localhost:8005/api)

## Instruções de Uso

### Subir o Container

Para iniciar o container, execute o comando:

```bash
docker compose up -d
```

### Configuração Inicial

1. **Criar o arquivo `.env`:**  
   Copie o conteúdo do arquivo `.env.example` para um novo arquivo `.env` dentro da pasta raiz do projeto.

2. **Abrir o terminal dentro do Docker:**  
   Execute o comando abaixo para acessar o terminal do container:
   
   ```bash
   docker compose exec --users 1000:1000 app sh
   ```
   
3. **Instalar as dependências:**  
   Dentro do terminal do Docker, digite o seguinte comando para instalar as dependências:
   
   ```bash
   composer update
   ```

4. **Gerar a chave da aplicação:**  
   Ainda dentro do terminal do Docker, execute:
   
   ```bash
   php artisan key:generate
   ```

5. **Rodar as migrações:**  
   No mesmo terminal, execute:
   
   ```bash
   php artisan migrate
   ```

## Observações Importantes

- Sempre execute os comandos do Docker na mesma pasta onde está localizado o arquivo `docker-compose.yml` (pasta raiz).
- Para executar comandos do Laravel é necessário acessar o terminal do container. Para isso, execute o comando:
  
  ```bash
  docker compose exec --users 1000:1000 app sh
  ```
  
