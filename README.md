**1. Run docker compose**

```bash
docker-compose up
```

**2. Make protobuf files**

```bash
docker-compose exec php-fpm composer gen-proto
```

**3. Install dependencies**

```bash
docker-compose exec php-fpm composer install
```

**Send message**

```bash
docker-compose exec php-fpm bin/console app:send-message message_text
```

**Get messages**

```bash
docker-compose exec php-fpm bin/console messenger:consume async
```