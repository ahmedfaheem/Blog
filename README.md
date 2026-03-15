# ITI Blog (Laravel 12)

Simple blog application built with Laravel, Blade, Tailwind CSS, and a small Sanctum-protected API.

## Features

- Posts CRUD (create, list, show, edit, delete)
- Post author relationship (`Post` belongs to `User`)
- Comments on posts (polymorphic relation)
- Delete comments from post details page
- Pagination in posts list
- API endpoints for listing, showing, and creating posts
- Sanctum token authentication for protected API requests

## Tech Stack

- PHP `^8.2`
- Laravel `^12.0`
- MySQL/SQLite (Laravel supported databases)
- Vite + Tailwind CSS 4

## Project Structure (Important)

- `app/Http/Controllers/PostController.php`: posts CRUD
- `app/Http/Controllers/API/PostController.php`: API posts index/show/store
- `app/Http/Controllers/CommentController.php`: comments create/delete
- `app/Models/Post.php`: `belongsTo(User)` + `morphMany(Comment)`
- `app/Models/Comment.php`: polymorphic comment model
- `resources/views/posts/`: blade views for posts
- `routes/web.php`: web routes
- `routes/api.php`: API routes and Sanctum token endpoint

## Routes

Web routes:

- `GET /posts` -> `posts.index`
- `GET /posts/create` -> `posts.create`
- `POST /posts` -> `posts.store`
- `GET /posts/{id}` -> `posts.show`
- `GET /posts/{id}/edit` -> `posts.edit`
- `PUT /posts/{id}` -> `posts.update`
- `DELETE /posts/{id}` -> `posts.destroy`
- `POST /posts/{post}/comments` -> `comments.store`
- `DELETE /comments/{comment}` -> `comments.destroy`

API routes:

- `GET /api/posts` -> `api.posts.index`
- `GET /api/posts/{post}` -> `api.posts.show`
- `POST /api/posts` -> `api.posts.store` (`auth:sanctum` required)
- `POST /api/sanctum/token` -> issue personal access token
- `GET /api/user` -> authenticated user (`auth:sanctum` required)

Notes:

- `GET /api/posts` and `GET /api/posts/{post}` are public.
- `POST /api/posts` is protected with route middleware only for the `store` action.

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

## API Authentication

Create a Sanctum token:

```bash
curl -X POST http://127.0.0.1:8000/api/sanctum/token \
	-H "Accept: application/json" \
	-H "Content-Type: application/json" \
	-d '{
		"email": "user@example.com",
		"password": "password",
		"device_name": "postman"
	}'
```

Use the returned token to create a post:

```bash
curl -X POST http://127.0.0.1:8000/api/posts \
	-H "Accept: application/json" \
	-H "Authorization: Bearer YOUR_TOKEN" \
	-H "Content-Type: application/json" \
	-d '{
		"title": "Example post title",
		"description": "This is a sufficiently long post description that satisfies the validation rule length.",
		"author_id": 1
	}'
```

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
