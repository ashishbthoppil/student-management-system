<h1>Steps to run the project</h1>

1. Clone the project to the xampp/htdocs/StudentManagement folder (for windows) or /var/www/html/StudentManagement (for Linux).
2. Create a database (phpmyadmin, MySQL) with the db name as "sms_2022".
2. Open the terminal and cd into the project folder.
3. Run migrations using the command "php artisan migrate"
4. Run a databse seeder using the command "php artisan db:seed UserRoleSeeder" (For user roles)
5. Run the development server using the command "php artisan serve"
6. The project can then be accessed at http://127.0.0.1:8000 (or) localhost:8000
