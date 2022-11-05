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

### Scripts

```bash
composer install        # Install dependencies
docker-compose up -d    # Create Docker database and mailer
symfony server:start    # Run the web server
npm run dev-server      # Run Webpack to compile the assets
```

BD migrations

```bash
symfony console doctrine:migrations:migrate
```

Run tests

```bash
composer test
```
