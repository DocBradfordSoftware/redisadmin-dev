# redisadmin-dev

### docker-compose.yaml

```yaml
version: "2"
services:
  redis:
    image: redis:alpine
    command: redis-server --appendonly yes
    volumes:
      - ./data/redis:/data
    ports:
      - "6379:6379"
    restart: always

  redisadmin:
    image: docbradfordsoftware/redisadmin-dev:1.0
    links:
      - redis:redis
    ports:
      - "8102:80"

```