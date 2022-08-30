# Dependências
- PHP >= 8.0 (8.1 Recomendado)
- Docker
- docker-compose
- `Visual Studio Code` com extensão de containers remotos (Opcional) .


## Execução
A fim de rodar o presente projeto, execute os seguintes comandos em ordem

- `docker run --rm --interactive --tty --volume $PWD:/app composer install`
- `./vendor/bin/sail/up`
- `./vendor/bin/sail artisan migrate:fresh --seed` (Apenas na primeira vez que for executar o projeto)