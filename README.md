# ITI Blog (Laravel 12)

Simple blog application built with Laravel, Blade, and Tailwind CSS.

## Features

- Posts CRUD (create, list, show, edit, delete)
- Post author relationship (`Post` belongs to `User`)
- Comments on posts (polymorphic relation)
- Delete comments from post details page
- Pagination in posts list

## Tech Stack

- PHP `^8.2`
- Laravel `^12.0`
- MySQL/SQLite (Laravel supported databases)
- Vite + Tailwind CSS 4

## Project Structure (Important)

- `app/Http/Controllers/PostController.php`: posts CRUD
- `app/Http/Controllers/CommentController.php`: comments create/delete
- `app/Models/Post.php`: `belongsTo(User)` + `morphMany(Comment)`
- `app/Models/Comment.php`: polymorphic comment model
- `resources/views/posts/`: blade views for posts
- `routes/web.php`: web routes

## Routes

- `GET /posts` -> `posts.index`
- `GET /posts/create` -> `posts.create`
- `POST /posts` -> `posts.store`
- `GET /posts/{id}` -> `posts.show`
- `GET /posts/{id}/edit` -> `posts.edit`
- `PUT /posts/{id}` -> `posts.update`
- `DELETE /posts/{id}` -> `posts.destroy`
- `POST /posts/{post}/comments` -> `comments.store`
- `DELETE /comments/{comment}` -> `comments.destroy`

## Database

Main tables used:

- `users`
- `posts` (`author_id` FK -> `users.id`)
- `comments` (`commentable_id`, `commentable_type` for polymorphic comments)

## Setup

1. Install PHP dependencies:

```bash
composer install
```

2. Install frontend dependencies:

```bash
npm install
```

3. Create environment file and key:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your database in `.env`, then run migrations:

```bash
php artisan migrate
```

## Run Locally

Run backend server:

```bash
php artisan serve
```

Run Vite (frontend assets):

```bash
npm run dev
```

Open:

- `http://127.0.0.1:8000/posts`

## Seeding Notes

- `PostSeeder` currently has factory seeding commented out.
- `DatabaseSeeder` currently does not call additional seeders.

You can add your own seeds, then run:

```bash
php artisan db:seed
```

## Useful Commands

```bash
php artisan migrate:fresh --seed
php artisan test
npm run build
```

## License

This project is for learning/training purposes (ITI labs).
