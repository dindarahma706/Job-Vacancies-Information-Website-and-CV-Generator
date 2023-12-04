## About Jobs
Jobs is a website that aims to manage any job vacancies and also generate CV. 
You can create job vacancies and can be applied by job seekers.
You also can create your CV based on template that can be chosen by yourself.
Jobs is built on Laravel 10 and you can modif this app as you want.
Feel free to make contribute to improve this project.

this is the manualbook for using jobs: 

[https://drive.google.com/file/d/1ANnn_DTRlUZWywoqLfy2QD-qZgd_YQxj/view?usp=sharing]


## Requirements

PHP >= 8.1

Composer

Xampp or other server app

### Installation

1. Open your terminal and navigate to any folder to put the project
2. clone the repository
   
   git clone [https://github.com/levina13/Jobs.git]

4. navigate to the project directory
   
   cd jobs

6. copy '.env.example file to .env and configure the database and other settings:
7. Install PHP dependencies with Composer
   
   composer install
   
9. Generate the application key:
    
    php artisan key:generate
   
11. Run Mysql server in Xampp

12. Create Database in your MySQL server with the same name as in your .env file
    
13. Migrate the database with dummy data (optional):
    
    php artisan migrate --seed
    
15. Run the Laravel development server:
    
    php artisan serve
    
17. Access the project through the browser at http://localhost:8000. 

