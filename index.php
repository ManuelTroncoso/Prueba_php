<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="index.css">
  <link rel="stylesheet" href="index.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script>
    //Esta funcion te manda los datos al php
    $('#mandar').click(function () {
      var url = "clases.php";

      $.ajax({
        type: "POST",
        url: url,
        data: $("#formulario").serialize(),
        success: function (data) {

          $('#resp').html(data);

        }
      });
    });

    function Mostrar() {
      //Esta funcion te muestra los datos
      $.ajax({
        url: "datos.txt",
        dataType: "text",
        success: function (data) {
          var contenido = data;
          var todosDatos = data.split('\n');

          if (todosDatos.length > 1) {
            for (var i = 0; i < todosDatos.length - 1; i++) {
              var array1 = todosDatos[i].split(';');
              var dato1 = array1[0].split(' ');
              $('.table tbody:last').after('<tr><td>' + dato1[0] + '</td><td>' + dato1[1] + '</td><td>' + array1[1] + '</td></tr>');
            }
          } else {
            var array1 = contenido.split(';');
            var dato1 = array1[0].split(' ');
            $('.table tbody:last').after('<tr><td>' + dato1[0] + '</td><td>' + dato1[1] + '</td><td>' + array1[1] + '</td></tr>');
          }

        }
      });

    }

  </script>
</head>

<body>
  <div class="row">
    <div class="col-sm-3">
      <!-- botones para añadir datos o ver los datos -->
      <div class="text-center " id="botones">
      <button type="button" data-toggle="modal" data-target="#exampleModalCenter">
        Nueva cita
      </button>

      <button type="button" onclick="Mostrar()">Obtener cita</button>
      </div>
      <!-- modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Datos del formulario</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <form class="form-signin" method="post" action="clases.php">
                <label>Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required autofocus> <br>
                <label>Apellido</label>
                <input type="text" id="apellido" name="apellido" placeholder="Apellido" required><br>
                <label>Pais</label>
                <input type="text" id="pais" name="pais" placeholder="Pais" required> <br>
                <br>
                <p>Fecha cita</p>
                <input type="date" id="fecha" name="fecha" placeholder="Pais" required>
                <br>
                <div class="modal-footer">
                  <button id="mandar" class="btn btn-primary">Save changes</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- tabla -->
    <div class="col-sm-9">
      <table class="table" id="table">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Pais</th>
          </tr>
        </thead>
        <tbody id="tabletbody">

        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
</body>

</html>