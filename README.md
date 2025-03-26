# ROYAL FIT GYM APP

This is a web application for Royal Fitgym and fitness.

## System Requirements

-   PHP version: PHP 8.4.x
-   Composer Version: 2.x.x
-   Node Version: 22.x.x
-   MySql Version: 8.x.x

## Technology Stack

-   Framework: [Laravel 12](https://laravel.com/)
-   Database: [MySql 8](https://www.mysql.com/)
-   Frontend: [Tailwind CSS 4](https://tailwindcss.com/)
-   Frontend plugin: [Daisy UI 5](https://daisyui.com/)
-   Frontend component: [Flowbite 3](https://flowbite.com/)
-   Backend: [Livewire 3](https://livewire.laravel.com/)

## Installation

1. Clone the repository

```bash
git clone https://github.com/manasama77/gym.git
```

2. Enter the project directory

```bash
cd gym
```

3. Install dependencies

```bash
composer install
```

4. Install npm dependencies

```bash
npm install
```

5. Generate application key

```bash
php artisan key:generate
```

6. Create Symlink

```bash
php artisan storage:link
```

7. Copy .env.example file

```bash
cp .env.example .env
```

8. Run migrations

```bash
php artisan migrate --seed
```

9. Start the server

```bash
composer run dev
```

## Manual Run Task Schedule to Check Expired Memberships

To check expired memberships manually, follow these steps:

1. Open Table `membership` in your database

2. Update the `expired_date` column of the expired memberships to `date before today`

3. Run the following command:

```bash
php artisan expired
```

## Have Questions?

If you have any questions or feedback, please open an issue in the [GitHub repository](https://github.com/manasama77/gym/issues) or send an email to [adam.pm77@gmail.com](mailto:adam.pm77@gmail.com). Need fast support? Contact us on [WhatsApp](https://wa.me/6282114578976).
