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
class Migration extends Database {
    public function create() {
       $table ="create table users
        (
            id  int auto_increment primary key,
            email varchar(255) not null,
            password varchar(255) not null,
            id_role  int null
        );
        create table tickets
        (
            id int auto_increment primary key,
            name text null,
            description text null,
            created_at  datetime null,
            created_by  int  null
        );
        create table roles
        (
            id int auto_increment primary key,
            name varchar(20) not null
        );
        ";
       try {
           $this->getConnection()->query($table);
       }catch (PDOException $ex) {

       }
    }
}
?>