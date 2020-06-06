

//miFecha();
load_Data('primero');
compruebaVacios();
function limpiar(){
    setTimeout(
  function()
  {
    $("#mensaje").text('');
    $("#mensaje").css("display", "none");
  }, 2000);
}

function load_Data(tipo)
  {
    $.ajax({
      url:"/search",
      method:"get",
      data:{'tipo': tipo},
      dataType:"json",
      success:function(data)
      {
        var html = '';
        for(var count = 0; count < data.length; count++)
        {
          html += '<option value="'+data[count]+'">'+data[count]+'</option>';
        }

          $('#text').html(html);
          $('#text').selectpicker('refresh');

      }
    })
  }



  function miFecha() {
  var myDate = document.getElementById('myDate');
  var today = new Date();
  myDate.value = today.toISOString().substr(0, 10);
}



function añadirPrimeros(){

    var option = document.createElement("option");
option.text = text.value;
option.value =text.value;
var select = document.getElementById("primeros");
select.appendChild(option);

compruebaVacios();

}

function añadirSegundos(){
    var option = document.createElement("option");
option.text = text.value;
option.value =text.value;
var select = document.getElementById("segundos");
select.appendChild(option);
compruebaVacios();
}

function añadirPostres(){
    var option = document.createElement("option");
option.text = text.value;
option.value =text.value;
var select = document.getElementById("postres");
select.appendChild(option);
compruebaVacios();
}

$('p').on('click', function(){
    $(this).closest("p").remove();
});

function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
}

function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
}




function compruebaVacios(){
    if (document.getElementById('primeros').options.length == 0 ){
        var option = document.createElement("option");
        option.text = "Vacio";
        option.value ="vacio";
        var select = document.getElementById("primeros");
select.appendChild(option);

    }else{
        if (document.getElementById('primeros').options.length >1 ){

        var selectobject = document.getElementById('primeros');
for (var i=0; i<selectobject.length; i++) {
    if (selectobject.options[i].value == 'vacio')
        selectobject.remove(i);
}}





         }


    if (document.getElementById('segundos').options.length == 0 ){
        var option = document.createElement("option");
        option.text = "Vacio";
        option.value ="vacio";
        var select = document.getElementById("segundos");
select.appendChild(option);
    }else{
        if (document.getElementById('segundos').options.length >1 ){

var selectobject = document.getElementById('segundos');
for (var i=0; i<selectobject.length; i++) {
if (selectobject.options[i].value == 'vacio')
selectobject.remove(i);
}}

    }







    if (document.getElementById('postres').options.length == 0 ){
        var option = document.createElement("option");
        option.text = "Vacio";
        option.value ="vacio";
        var select = document.getElementById("postres");
select.appendChild(option);
    }else{
        if (document.getElementById('postres').options.length >1 ){

var selectobject = document.getElementById('postres');
for (var i=0; i<selectobject.length; i++) {
if (selectobject.options[i].value == 'vacio')
selectobject.remove(i);
}}
    }
}





$(document).click(function(event) {
    varlistaActual= $(event.target).parent()[0].id;
});






function eliminar() {
  var x = document.getElementById(varlistaActual);


  if(x!=null){
    x.remove(x.selectedIndex);
  }
  compruebaVacios();

}



/*

$("#guardar").click(function(e) {
    e.preventDefault();
    var primeros= $("#primeros option").map(function() {return $(this).val();}).get();
var segundos= $("#primeros option").map(function() {return $(this).val();}).get();
var postres= $("#primeros option").map(function() {return $(this).val();}).get();
    $.ajax({
        type: "POST",
        url: "menu",
        data: {primeros:primeros,

        },
        success: function(result) {
            alert('ok');
        },
        error: function(result) {
            alert('error');
        }
    });
});
*/$("#guardar").click(function (e) {
    e.preventDefault();
    var primeros= $("#primeros option").map(function() {return $(this).val();}).get();
    var segundos= $("#segundos option").map(function() {return $(this).val();}).get();
    var postres= $("#postres option").map(function() {return $(this).val();}).get();
    var fecha=document.getElementById("myDate").value;
    var precio=document.getElementById("precio").value;
    var token = '{{csrf_token()}}';
    var data={
        primeros:primeros,
        _token:token,
        segundos:segundos,
        postres:postres,
        fecha:fecha,
        precio:precio};
    $.ajax({
        type: "post",
        url: "{{route('menu.store')}}",
        data: data,
        success: function (msg) {
            $("#precio").removeClass("error");
            $("#myDate").removeClass("error");
            $("#primeros").removeClass("error");
            $("#segundos").removeClass("error");
            $("#postres").removeClass("error");



           if(msg.success.includes("precio")){
            $("#mensaje").attr('class', 'alert-danger text-center');
            jQuery('.alert-danger').show();
            jQuery('.alert-danger').append('<p>'+msg.success+'</p>');
            $("#precio").addClass("error");
            document.getElementById("precio").focus()



           }else{


            if(msg.success.includes("fecha")){
                $("#mensaje").attr('class', 'alert-danger text-center');
            jQuery('.alert-danger').show();
            jQuery('.alert-danger').append('<p>'+msg.success+'</p>');
            $("#myDate").addClass("error");
            document.getElementById("myDate").focus();
            }else{



                if(msg.success.includes("primeros")){
                    $("#mensaje").attr('class', 'alert-danger text-center');
                jQuery('.alert-danger').show();
                jQuery('.alert-danger').append('<p>'+msg.success+'</p>');
                $("#primeros").addClass("error");
                document.getElementById("primeros").focus();
                }else{



                    if(msg.success.includes("segundos")){
                        $("#mensaje").attr('class', 'alert-danger text-center');
                    jQuery('.alert-danger').show();
                    jQuery('.alert-danger').append('<p>'+msg.success+'</p>');
                    $("#segundos").addClass("error");
                    document.getElementById("segundos").focus();
                    }else{


                        if(msg.success.includes("postres")){

                            $("#mensaje").attr('class', 'alert-danger text-center');
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').append('<p>'+msg.success+'</p>');
                        $("#postres").addClass("error");
                        document.getElementById("postres").focus();
                        }else{


                            $("#mensaje").attr('class', 'alert-success text-center');
                            jQuery('.alert-success').show();
                            jQuery('.alert-success').append('<p>'+msg.success+'</p>');














                        }








                    }











                }






















            }



















           }




           limpiar();



        },
        error: function (msg) {
                alert(msg.error);
        }


    });
});









//$('#precio').val('');

//$('#myDate').val()=$('#myDate').val();
