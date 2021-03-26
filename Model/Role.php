<?php
/**
 * Class Role
 * The class use for roles.
 *
 * @package    quantoxtestprojekat1.local
 * @author     Marko Milojkovic <marko.milojkovic@quantox.com>
 *
 *
 */
class Role extends Database {

    /**
     * @return array
     */
    public function ListRoles() {
        $stmt = "SELECT * FROM roles";
        $result = $this->getConnection()->query($stmt);

        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }
}
?>