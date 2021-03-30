<?php

include('Config/Database.php');

/**
 * Class Ticket
 * The class use for tickets.
 *
 * @author     Marko Milojkovic <marko.milojkovic@quantox.com>
 *
 *
 */
class Ticket extends Database {
    /**
     * @return array
     */
    public function listTickets() {
        $stmt = "SELECT t.id as id_tickets,t.name as ticket_name,t.description,t.created_at,t.created_by,u.id as id_user,u.email as email_user FROM tickets t INNER JOIN users u ON t.created_by=u.id";
        $result = $this->getConnection()->query($stmt);

        if($result->rowCount() > 0){
            while($row = $result->fetch()){
                $data[] = $row;
            }
            return $data;
        }
    }

    /**
     * @param $name
     * @param $description
     * @param $created_at
     * @param $created_by
     */
    public function createTicket($name,$description,$created_at,$created_by) {
            $stmt = $this->getConnection()->prepare("INSERT INTO tickets (name,description,created_at,created_by) VALUES (:name,:description,:created_at,:created_by);");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':created_at', $created_at);
            $stmt->bindParam(':created_by', $created_by);
            $result = $stmt->execute();

            if ($result == TRUE) {
                $_SESSION['success'] = 'Successful create ticket';
            }
    }

    /**
     * @param $id
     */
    public function deleteTicket($id) {
        $stmt = $this->getConnection()->prepare( "DELETE FROM tickets WHERE id= :id");
        $stmt->bindParam(':id', $id);
        try{
            $result = $stmt->execute();
            if ($result == TRUE) {
                header('location: /tickets');
            }
        }catch (Exception $e) {
            die("Oh noes! There's an error in the query!");
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function showTicket($id) {
        $stmt = $this->getConnection()->prepare( "SELECT t.id as id_tickets,t.name as ticket_name,t.description,t.created_at,t.created_by,u.id as id_user,u.email as email_user FROM tickets t INNER JOIN users u ON t.created_by=u.id WHERE t.id=?");
        $stmt->execute(array($id));
        return  $data = $stmt->fetch();
     }

     public function updateTicket($name,$description,$id_ticket)
     {
         $stmt = $this->getConnection()->prepare( "UPDATE tickets SET name= :name, description= :description WHERE id= :id_ticket");
         $stmt->bindParam(':name', $name);
         $stmt->bindParam(':description', $description);
         $stmt->bindParam(':id_ticket', $id_ticket);
         $result = $stmt->execute();
     }
}
?>