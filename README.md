<h1>Steps to run the project</h1>

1. Clone the project to the xampp/htdocs/StudentManagement folder (for windows) or /var/www/html/StudentManagement (for Linux).
2. Create a database (phpmyadmin, MySQL) with the db name as "sms_2022".
2. Open the terminal and cd into the project folder.
3. Run migrations using the command "php artisan migrate"
4. Run a databse seeder using the command "php artisan db:seed UserRoleSeeder" (For user roles)
5. Run the development server using the command "php artisan serve"
6. The project can then be accessed at http://127.0.0.1:8000 (or) localhost:8000

<h1>Points to be noted</h1>

1. The project consists of a navigation Divided into Students section, Teachers section (Add Teacher), Terms (To add the maximum number of terms).
2. In order to add marks for a student it is required to add students and the maximum number of terms (for term selection).
3. In order to add a student it is required to add teachers to add the reporting teacher.
