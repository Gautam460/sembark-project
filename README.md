# Sembark URL Shortener Assignment

Hi there! This is my submission for the Sembark URL Shortener project. It's built using Laravel.

Here is a quick guide on how to get the project up and running locally on your machine for testing.

## Prerequisites
Before you begin, just make sure you have the following installed:
- PHP (version 8.1 or higher)
- Composer
- Node & npm
- A database (I used SQLite for easy local testing, but MySQL works fine too)

## Getting Started

1. **Clone this repo**
   First, clone the repository to your local machine and navigate into it:
   ```bash
   git clone https://github.com/Gautam460/sembark-project.git
   cd sembark-project
   ```

2. **Install the dependencies**
   We need to pull in both the PHP packages and the frontend assets:
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Environment Setup**
   Copy the example environment file:
   ```bash
   cp .env.example .env
   ```
   Next, generate the app key:
   ```bash
   php artisan key:generate
   ```

   **Database Setup:**
   For a quick and easy setup without configuring a full MySQL server, you can use SQLite. Just create an empty database file:
   ```bash
   touch database/database.sqlite
   ```
   Then, update your `.env` file to use sqlite. Change the DB lines to look like this:
   ```env
   DB_CONNECTION=sqlite
   # You can comment out or remove the other DB_ variables like DB_HOST, DB_PORT etc.
   ```

4. **Run Migrations**
   Now, run the migrations to create the necessary tables (users, short_urls, etc.) in the database:
   ```bash
   php artisan migrate
   ```

5. **Start the Server!**
   Finally, boot up the local development server:
   ```bash
   php artisan serve
   ```
   The app should now be running at `http://localhost:8000`. You can open this link in your browser to test it out.

## Running Tests
If you want to run the automated tests I've included, just use the artisan command:
```bash
php artisan test
```

Let me know if you run into any issues while setting it up. Thanks!
