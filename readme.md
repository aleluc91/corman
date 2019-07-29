
# CORMAN
Corman is a website for the collaborative management of scientific papers.

It allows:
* User registration with personal data, affiliation, research lines
* Public and private profiles
* Automatic search of the publications by using the dblp's API
* Grouping of a researcher's publications (e.g. by specific topic)
* Creation of collaborative groups

# REQUIREMENTS
* php 7+
* laravel 5.4+

# DATABASE CONFIGURATION
Go to the project folder, open the .ENV file and modify the following fields based on the occurrences of your database:
* DB_CONNECTION 
* DB_HOST
* DB_PORT
* DB_DATABASE 
* DB_USERNAME
* DB_PASSWORD

like this:
* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=corman
* DB_USERNAME=root
* DB_PASSWORD=root

# STARTING COMMAND
Open the command prompt and go to the project folder, and type the following commands:
* php artisan migrate
* php artisan db:seed --class=TopicsTableSeeder
* php artisan queue:work

Open a new command prompt and go to the project folder, and type the following command:
* php artisan serve

Open the browser and go to the address:
* http://localhost:8000
