<?php
include("Controller/TicketController.php");
include_once 'Model/Ticket.php';
include "Views/Components/Header.php";
include "Views/Components/Nav.php";

if($_SESSION['email'] == '' || $_SESSION['id_role'] == 2) {
    header('location: /');
}

$create = new TicketController();
$create->create();

if(isset($id))
{
$ticket = new Ticket();
$ticket->showTicket($id);
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="jumbotron">
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <form method="post">
                <div class="form-group">
                    <label for="email">Name of tickets:</label>
                    <input type="text" class="form-control" name="name" placeholder="Name of tickets" ">
                </div>
                <div class="form-group">
                    <label for="password">Description:</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="description" placeholder="Enter description for the tickets"></textarea>
                </div>
                <input type="hidden" class="form-control" name="id" >
                <button type="submit" name="btnCreateTickets" class="btn btn-primary">Create tickets</button>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div clas="col-lg-10">
                    <div class="col-lg-12">
                        <div class="card-deck">
                            <?php
                            $tickets = new Ticket();
                            $rows = $tickets->listTickets();
                            if($rows != NULL){
                                foreach ($rows as $row) {
                                    ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['ticket_name']; ?></h5>
                                            <p class="card-text"><?php echo $row['description']; ?></p>
                                            <p class="card-text"><small class="text-muted">Created at: <?php echo $row['created_at']; ?></small><br><small class="text-muted">Created by: <?php echo $row['email_user']; ?></small></p>
                                            <a class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal<?php echo $row['id_tickets'] ?>">Edit</a>
                                            <a href="tickets/<?php echo $row['id_tickets'] ?>/delete" class="btn btn-outline-danger" >Delete</a>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <?php
                                        $id = $row['id_tickets'];
                                        $ticket = new Ticket();
                                        $row = $ticket->showTicket($id);
                                    ?>
                                    <div class="modal fade" id="exampleModal<?php echo $row['id_tickets'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit <?php echo $row['ticket_name'] ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" class="update">
                                                        <div class="form-group">
                                                            <label for="email">Name of tickets:</label>
                                                            <input type="text" class="form-control" id="name<?php echo $row['id_tickets'] ?>" name="name" placeholder="Name of tickets" value="<?php echo $row['ticket_name']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Description:</label>
                                                            <textarea class="form-control" id="descriptionEdit<?php echo $row['id_tickets'] ?>" rows="5" name="descriptionEdit"><?php echo $row['description']; ?></textarea>
                                                        </div>
                                                        <input id="id_ticket<?php echo $row['id_tickets'] ?>" type="hidden" value="<?php echo $row['id_tickets'] ?>">
                                                        <input type="hidden" class="form-control" name="id" >
                                                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="btnEditTicket" class="btn btn-primary" onclick="edit(<?php echo $row['id_tickets'] ?>)">Edit</button>
                                                        <p id="success<?php echo $row['id_tickets'] ?>" class="mt-3" style="color:green;"></p>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }} ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        function edit(id)
        {
            // using this page stop being refreshing
            event.preventDefault();
            var formData = {
                name: $("#name"+id).val(),
                description: $("#descriptionEdit"+id).val(),
                id_ticket: $("#id_ticket"+id).val()
            };
            $.ajax({
                type: 'POST',
                url: '/tickets/edit',
                data: formData,
                success: function () {
                    document.getElementById("success"+id).innerHTML="Successeful edit ticket";
                }
            });
        }
    </script>
<?php
include "Views/Components/Footer.php";
?>
