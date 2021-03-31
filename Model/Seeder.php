<?php

include('Config/Database.php');

/**
 * Class Users
 * The class use for user information.
 *
 * @author     Marko Milojkovic <marko.milojkovic@quantox.com>
 *
 *
 */
class Seeder extends Database {
    public function insert() {
        $admin = password_hash('admin', PASSWORD_DEFAULT);
        $manager = password_hash('manager', PASSWORD_DEFAULT);
        $table ="
        INSERT INTO users (email,password,id_role) VALUES ('admin@gmail.com','$admin','1');
        INSERT INTO users (email,password,id_role) VALUES ('manager@gmail.com','$manager','2');
        INSERT INTO roles (name) VALUES ('admin');
        INSERT INTO roles (name) VALUES ('manager');
        INSERT INTO tickets (name,description,created_at,created_by) VALUES ('Ticket 1','description for ticket 1',CURRENT_TIMESTAMP ,1);
        INSERT INTO tickets (name,description,created_at,created_by) VALUES ('Ticket 2','description for ticket 2',CURRENT_TIMESTAMP ,1);
        INSERT INTO tickets (name,description,created_at,created_by) VALUES ('Ticket 3','description for ticket 3',CURRENT_TIMESTAMP ,1);
        ";
        try {
            $this->getConnection()->query($table);
        }catch (PDOException $ex) {

        }
    }
}
?>