# http-quantoxtestprojekat1.local

1) First of all, you need to have php and sql installed on your computer

2) Install composer

3) When you do all that, run the command 'composer update' , to install all the necessary packages

4) Edit .env file with your parameters

5) In  vendor/composer/autoload_classmap.php add line code
   'MigrationCommand' => $baseDir . '/Commands/MigrationCommand.php',
   'SeederCommand' => $baseDir . '/Commands/SeederCommand.php',
   
   In vendor/composer/autoload_static.php in public static $classMap add lince code
   'MigrationCommand' => __DIR__ . '/../..' . '/Commands/MigrationCommand.php',
   'SeederCommand' => __DIR__ . '/../..' . '/Commands/SeederCommand.php',

to register migration and seeder commands in your vendor file

6) Run command 'php migrate migrate:run' for migration

7) Run command 'php seeder seeder:run' for insert data to your database
    Admin user
    email: admin@gmail.com 
    password: admin
   
    Manager user
    email: manager@gmail.com
    password: manager
   
