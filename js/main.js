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
            $("#target_input_id").val(formData);
        }
    });
}
function del(id)
{
    $.ajax({
        type: 'GET',
        url: '/tickets/'+id+'/delete',
        success: function () {
            $("#card-deck").load(location.href+" #card-deck>*","");
            $('#success').show();
            document.getElementById("success").innerHTML="Successeful delete ticket";
        }
    });
}

function create()
{
    // using this page stop being refreshing
    event.preventDefault();
    var formData = {
        name: $("#nameTicket").val(),
        description: $("#descriptionTicket").val()
    };
    if(formData['name'] == '')
    {
        $("#nameTicket").css("border", "1px solid red");
    }else {
        $.ajax({
            type: 'POST',
            url: '/tickets',
            data: formData,
            success: function () {
                $("#card-deck").load(location.href+" #card-deck>*","");
                $('#success').show();
                document.getElementById("success").innerHTML="Successeful create ticket";
            }
        });
    }
}