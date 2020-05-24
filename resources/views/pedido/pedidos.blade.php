pedidos











<script>

refresh();


function refresh(tipo)
  {
    $.ajax({
      url:"/getPedidos",
      method:"get",
      data:{'tipo': tipo},
      dataType:"json",
      success:function(data)
      {/*
        var html = '';
        for(var count = 0; count < data.length; count++)
        {
          html += '<option value="'+data[count]+'">'+data[count]+'</option>';
        }*/false
        alert(data);



      }
    })
  }


  </script>
