# Miz

A music database about bands, places, cities and organizations.

## Development

### Requirements

- PHP v8+
- Composer
- PHP CS Fixer
- Docker
- Docker Compose
- Symfony CLI
- npm

### Scripts

```bash
# Install dependencies
composer install
npm install
# Create Docker database and mailer containers
docker-compose up -d
# Migrate DB and load fixtures
symfony console doctrine:migrations:migrate
# Doctrine fixtures "classic" load fail because it tries to delete the table in an incorrect order
# See https://github.com/doctrine/DoctrineFixturesBundle/issues/370
symfony console doctrine:fixtures:load --purge-with-truncate
# Run the web server
symfony server:start
# Run Webpack to compile the assets
npm run dev-server
```

BD migrations

```bash
symfony console doctrine:migrations:migrate
```

Run tests

```bash
composer test
```
