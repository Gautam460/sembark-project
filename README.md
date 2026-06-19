# Sembark URL Shortener

Here are the steps to run my project locally.

1. Clone the repo:
   ```bash
   git clone https://github.com/Gautam460/sembark-project.git
   cd sembark-project
   ```

2. Install everything:
   ```bash
   composer install
   npm install
   npm run build
   ```

3. Setup environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Database setup:
   I have used SQLite for easier testing. Just create a file for it:
   ```bash
   touch database/database.sqlite
   ```
   Then in your `.env` file, change the DB connection to sqlite:
   ```env
   DB_CONNECTION=sqlite
   ```
   (You can just delete the other DB_HOST, DB_PORT lines)

5. Run the migrations:
   ```bash
   php artisan migrate
   ```

6. Start the app:
   ```bash
   php artisan serve
   ```
   It will run on `http://localhost:8000`.

To run the tests, use:
```bash
php artisan test
```
