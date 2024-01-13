# phpstan-example

## Development

```bash
# Launch local server
docker-compose up -d

# Run PHPStan
docker-compose exec php vendor/bin/phpstan analyse

# Run PHPStan all level
docker-compose exec php sh ./scripts/phpstan-all-level.sh
```
