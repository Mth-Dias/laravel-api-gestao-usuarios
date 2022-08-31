## Dependências
- PHP >= 8.0 (8.1 Recomendado)
- Docker
- docker-compose

## Execução
A fim de rodar o presente projeto, execute os seguintes comandos em ordem

- `docker run --rm --interactive --tty --volume $PWD:/app composer install` (Apenas na primeira vez que for executar o projeto)
- `./vendor/bin/sail/up`
- `./vendor/bin/sail artisan migrate:fresh --seed` (Apenas na primeira vez que for executar o projeto)

## Curl das Requisições
- Login:

`curl --request POST
  --url http://localhost/api/login
  --header 'Accept: application/json'
  --header 'Content-Type: multipart/form-data'
  --header 'content-type: multipart/form-data; boundary=---011000010111000001101001'
  --form email=mthdias@outlook.com
  --form password=123@Mudarr`

- Detahes da sessão:

`curl --request GET
  --url http://localhost/api/session_details
  --header 'Accept: application/json'
  --header 'Authorization: Bearer 1|fzeD8Krz0ethG4CqOu2VOHJauk1BMb4ps7q1Pfk0'`

- Logout:

`curl --request DELETE
  --url http://localhost/api/logout
  --header 'Accept: application/json'
  --header 'Authorization: Bearer 1|fzeD8Krz0ethG4CqOu2VOHJauk1BMb4ps7q1Pfk0'`

- Logout de todas as sessões:

`curl --request DELETE
  --url http://localhost/api/end_all_sessions
  --header 'Accept: application/json'
  --header 'Authorization: Bearer 1|fzeD8Krz0ethG4CqOu2VOHJauk1BMb4ps7q1Pfk0'`

- Listagem paginada de todos os usuários:

`curl --request GET
  --url 'http://localhost/api/users/?page=1'
  --header 'Accept: application/json'
  --header 'Authorization: Bearer 2|Gzz2U56MPBg0EYxAU8yArkZzmee2dRyWxy7kF4uN'`

- Criação de novo usuários:

`curl --request POST
  --url http://localhost/api/users/
  --header 'Accept: application/json'
  --header 'Authorization: Bearer 2|Gzz2U56MPBg0EYxAU8yArkZzmee2dRyWxy7kF4uN'
  --header 'Content-Type: multipart/form-data'
  --header 'content-type: multipart/form-data; boundary=---011000010111000001101001'
  --form 'name=Mateus Evair'
  --form email=mateus.evair@wivenn.com.br
  --form password=123@Mudarr
  --form password_confirmation=123@Mudarr`

- Detalhes do usuário:

`curl --request GET 
  --url http://localhost/api/users/5 
  --header 'Accept: application/json'
  --header 'Authorization: Bearer 2|Gzz2U56MPBg0EYxAU8yArkZzmee2dRyWxy7kF4uN'`

- Atualização de dados do usuário:

`curl --request PATCH
  --url http://localhost/api/users/11
  --header 'Accept: application/json'
  --header 'Authorization: Bearer 2|Gzz2U56MPBg0EYxAU8yArkZzmee2dRyWxy7kF4uN'
  --header 'Content-Type: application/json'
  --data '{
	"current_password": "123@Mudarr",
	"new_password": "123@Mudarr",
	"new_password_confirmation": "123@Mudarr"
}'`

- Deleção de usuário:

`curl --request DELETE
  --url http://localhost/api/users/7
  --header 'Accept: application/json'
  --header 'Authorization: Bearer 2|Gzz2U56MPBg0EYxAU8yArkZzmee2dRyWxy7kF4uN'`