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
   I have used MySQL for this project. Create a new database in your local MySQL server (for example, `sembark`). 
   Then in your `.env` file, update the DB credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sembark
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

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
