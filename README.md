# Laravel To-Do App
A simple Laravel-based application for managing a to-do list. This project demonstrates CRUD operations and integrates basic functionality for user authentication and task management.

Features
 - Task Management: Create, read, update, and delete tasks.
 - User Authentication: Only authenticated users can manage their to-do lists.
- Task Completion Toggle: Mark tasks as completed or uncompleted with a single action.

## Installation
#### Clone the repository:

```bash
git clone https://github.com/brianlaclair/laravel-todo.git
cd laravel-todo
```

#### Install dependencies:

```bash
composer install
npm install && npm run dev
```

#### Set up the environment:

Copy .env.example to .env
```bash
cp .env.example .env
```
Configure your database settings in the .env file.

#### Run migrations:

```bash
php artisan migrate
```

Start the application:

```bash
php artisan serve
```

Open the app in your browser at http://127.0.0.1:8000.

## Usage
- Register or log in to access your to-do list.
- Add, edit, delete, or toggle tasks as needed.

## Contributing
Contributions are welcome! Feel free to fork this repository and submit a pull request with your enhancements.

## License
This project is licensed under the MIT License.