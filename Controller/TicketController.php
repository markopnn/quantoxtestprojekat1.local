<?php

include_once "Model/Ticket.php";

class TicketController {

    public function create() {

        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        $created_at = date('Y/m/d H:i:s');
        $created_by = (int)$_SESSION['id_role'];

        $create = new Ticket();
        $result = $create->createTicket($name,$description,$created_at,$created_by);

    }

    public function update() {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $id_ticket = $_POST['id_ticket'];
        $update = new Ticket();
        $update->updateTicket($name,$description,$id_ticket);
    }

    /**
     * @param $id
     */
    public function delete($id) {
        $ticket = new Ticket();
        $result = $ticket->deleteTicket($id);
    }
}