##1. Run docker compose

```bash
docker-compose up
```
##2. Install dependencies

```bash
docker-compose exec php-fpm composer install
```

##3. Make protobuf files

```bash
docker-compose exec php-fpm gen-proto
```

##Send message

```bash
docker-compose exec php-fpm bin/console app:send-message message_text
```

##Get messages

```bash
docker-compose exec php-fpm bin/console messenger:consume async
```