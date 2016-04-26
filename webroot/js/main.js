

//Función ejemplo de llamada ajax. Listado de Roles.

function rolesList(){
    $.ajax({
        type: "POST",
        url: "/crossfit/roles/",
        beforeSend: function() {
             alert('before send');
             },
        success: function(data){
           $('.content-wrapper').html(data);
        }
    });
}