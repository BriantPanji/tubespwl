<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Deploying to Railway

This project can be deployed on Railway. Follow these steps:

### 1. Railway Project Setup
- Create a new project on Railway.
- Connect your Git repository.
- Choose to deploy from your repository.

### 2. Add a Database Service
- In your Railway project, add a PostgreSQL or MySQL database service.
- Railway will provide connection details (host, port, database name, username, password). Use these for the environment variables below.

### 3. Configure Environment Variables
Set the following environment variables in your Railway project settings:

- `APP_NAME`: Your application name (e.g., "SudutLain")
- `APP_ENV`: `production`
- `APP_KEY`: **Generate this locally** using `php artisan key:generate --show` and copy the output (it starts with `base64:`). **Do not use the default key from `.env.example` in production.**
- `APP_DEBUG`: `false` (important for production)
- `APP_URL`: The public URL Railway provides for your application (e.g., `https://your-app-name.up.railway.app`)
- `LOG_CHANNEL`: `stderr` (to see logs in Railway's log viewer)
- `RAILWAY_STATIC_URL`: If you plan to serve static assets via Railway's static serving, set this to your app's public URL. Otherwise, Laravel will serve them.
- `DB_CONNECTION`: `mysql` or `pgsql` (depending on your chosen database)
- `DB_HOST`: Hostname of your Railway database service
- `DB_PORT`: Port of your Railway database service
- `DB_DATABASE`: Database name from your Railway database service
- `DB_USERNAME`: Username for your Railway database service
- `DB_PASSWORD`: Password for your Railway database service

**Optional Session Driver (Recommended for production):**
- `SESSION_DRIVER`: `database` or `redis` (if you add a Redis service)
- `CACHE_DRIVER`: `database` or `redis`

If using `database` for sessions or cache, ensure migrations are run.

### 4. Build and Start Commands
Railway should automatically detect this is a PHP project. If you need to configure build and start commands manually:

- **Build Command**:
  ```bash
  composer install --optimize-autoloader --no-dev
  php artisan config:cache
  php artisan event:cache
  php artisan route:cache
  php artisan view:cache
  php artisan migrate --force
  ```
  (You might also add `npm install && npm run build` if you have frontend assets managed by npm/vite that need building for production)

- **Start Command** (Railway will use the `Procfile`):
  ```
  web: php artisan serve --host=0.0.0.0 --port=$PORT
  ```
  This is defined in your `Procfile`.

### 5. Deployment
- Once configured, Railway will build and deploy your application.
- Check the deployment logs on Railway for any errors.
- Access your application using the public URL provided by Railway.

### Troubleshooting
- **502 Bad Gateway**:
    - Ensure `APP_KEY` is set correctly.
    - Check application logs on Railway for startup errors.
    - Verify the `Procfile` is correct and the application binds to `0.0.0.0` and `$PORT`.
    - Ensure `bootstrap/app.php` correctly trusts proxies.
- **Database Connection Issues**: Double-check your `DB_*` environment variables against the details provided by Railway.
- **Static Assets (CSS/JS) Not Loading**:
    - Ensure `APP_URL` is set correctly.
    - If using Vite, ensure your `vite.config.js` is set up for production builds and that assets are built into the `public/build` directory (or as configured).
    - Check the `RAILWAY_STATIC_URL` if you're trying to use Railway's static file serving.
