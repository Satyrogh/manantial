<html language="es">
<head>
    <title>Bienvenido</title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="estilos/estilo.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript">
      function abrirVentanaUsuario(){
        $(".ventanaUsuario").slideDown("slow");
      }
      function cerrarVentanaUsuario(){
        $(".ventanaUsuario").slideUp("fast");
      }
      function abrirVentanaRegistro(){
        $(".ventanaRegistro").slideDown("slow");
      }
      function cerrarVentanaRegistro(){
        $(".ventanaRegistro").slideUp("fast");
      }
    </script>
</head>
<body style="">
<div class="header">
    <a href="/"><img src="img/Billetera.png" style="padding-left: 2%" class="headerImage"></a>
    <div class="dropdown show" id="dropdownHeader">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Visión
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
         <a class="dropdown-item" href="#">Clientes</a>
         <a class="dropdown-item" href="#">Oferta</a>
         <a class="dropdown-item" href="#">Integridad</a>
         <a class="dropdown-item" href="#">Derechos</a>
         <a class="dropdown-item" href="#">Propuesta</a>
         <a class="dropdown-item" href="#">Proceso de Petición</a>
      </div>
    </div>
    <input type="button" class="btn btn-secondary" id="btnUsuario" value="Usuario" onclick="abrirVentanaUsuario();">
  <div id="carouselSlideOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img/homeSlider/homeSlider1.jpg"  alt="First slide">
      <div class="carousel-caption">
        <h1>¿Quieres averiguar nuestras ofertas?</h1>
        <h2>Consulta aquí : <a href="simular" class="btn btn-info" role="button">Simulador</a></h2>
      </div>
    </div>
  </div>
  </div>
</div>
<div class ="ventanaUsuario">
  <h1 style="text-align: center">Inicia sesión</h1>
  <form class ="form" action="/login" method="POST">
    <div class="cerrar"><a href="javascript:cerrarVentanaUsuario();">Cerrar</a></div>
    <h2>Ingresa aquí</h2>
    <table>
      <tr>
        <td>Nombre de usuario</td>
        <hr>
        <td><input type="text" placeholder="Ingresa tu nombre" name="nombreUsuario"></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="password" placeholder="Ingresa tu contraseña" name="pwdUsuario"></td>
      </tr>
    </table>
    <p><input type="checkbox" name="chkRecordar">Recordar contraseña</p>
    <input type="submit" id="btnIngresar" value="Ingresar" >
    <button type="button" id="btnRegistrar" value="Regístrate" onclick="cerrarVentanaUsuario();abrirVentanaRegistro()">Registrarse</button>
  </form>
</div>
<div class ="ventanaRegistro">
  <h1 style="text-align: center">Registro de Usuario</h1>
  <form class ="form" action="/registro" method="POST">
    <div class="cerrar"><a href="javascript:cerrarVentanaRegistro();">Cerrar</a></div>
    <h2>Regístrate</h2>
    <table>
      <tr>
        <td>Nombre Completo</td>
        <hr>
        <td><input type="text" placeholder="Nombre real" name="regNombreC"></td>
      </tr>
      <tr>
        <td>Nombre de usuario</td>
        <td><input type="text" placeholder="Usuario" name="regNombreU"></td>
      </tr>
      <tr>
        <td>Contraseña</td>
        <td><input type="password" placeholder="Contraseña" name="regPwd"></td>
      </tr>
      <tr>
        <td>Correo Electrónico</td>
        <td><input type="Email" placeholder="Email" name="regEmail"></td>
      </tr>

    </table>
    <p><input type="checkbox" name="chkRecordar">Recordar contraseña</p>
    <input type="submit" id="btnRegistrar" value="Completar">
  </form>
</div>
</body>
</html>
