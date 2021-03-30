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
    public function delete() {
        $stmt = $this->getConnection()->prepare( "DELETE FROM users WHERE id=10");
        $result = $stmt->execute();
    }
}
?>