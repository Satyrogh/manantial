<html language="es">
<head>
    <title>Simula tu Préstamo</title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="estilos/estilo.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
</div>
<hr>
<div id="tituloPrestamo">
<h1 style="text-align:center">Simula tu préstamo</h1>
<p style="text-align:center; font-size:20px">Solicita tu monto indicando la cantidad de cuotas y monto.</p>
</div>
<div class="row">
  <div class="col-md">
<form id="formSimular" method="POST">
<div class="form-group">
    <label for="exampleInputEmail1">Correo Electrónico</label>
    <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Ingrese Correo">
    <small id="emailHelp" class="form-text text-muted">Tu email no será compartido con nadie</small>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Nombre completo</label>
    <input type="text" class="form-control" id="inputNombre" aria-describedby="emailHelp" placeholder="Nombres">
    <small id="emailHelp" class="form-text text-muted">Nombre y apellido</small>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Monto</label>
    <input type="number" class="form-control" name="monto" id="monto" aria-describedby="emailHelp" placeholder="Cantidad en pesos">
    <small id="emailHelp" class="form-text text-muted">Mínimo 50.000 y máximo 7.000.000</small>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Cuotas</label>
    <input type="number" class="form-control" id="inputCuotas" name="inputCuotas" aria-describedby="emailHelp" placeholder="Ingrese la cantidad de cuotas deseada">
    <small id="emailHelp" class="form-text text-muted">A mayor cantidad de cuotas, mayo interés</small>
</div>
<div class="form-check">
    <input type="checkbox" class="form-check-input" name="checkMesDeGracia">
    <label class="form-check-label" for="exampleCheck1"></label>Mes de Gracia
</div>
<div class="form-check">
    <input type="checkbox" class="form-check-input" id="checkTerminos">
    <label class="form-check-label" for="exampleCheck1"></label><a href="terminos" target="_blank">Acepto términos y condiciones</a>
</div>
  <br><button type="submit" class="btn btn-primary">Simular</button>
</form>
</div>

<div class="col-md">
<div class="body" id="resultado">
  <table border="1px" id="tblResultados">
  @if(isset($monto) && isset($cuotas))
  @switch($monto)
    @case($monto <= 500000 && $monto >= 50000)
      <?php 
        $montoMin = 50000;
        $parametros = DB::table('simulador')->select('tasa', 'notario')->where('montoMin', $montoMin)
        ->where('cuotas', $cuotas)->get();
        $tasa = $parametros[0]->tasa;
        $notario = $parametros[0]->notario;
        $totalCredito = $monto + $notario;
        $interesMensual = $tasa/12;
        $costoTotalCredito = ($tasa*$totalCredito)/100 + $totalCredito;
        $cuotaMensual = $costoTotalCredito / $cuotas;
        $interesAtraso = $cuotaMensual * 0.01;
        echo "<tr id='trMontoCredito'>";
        echo "<td>Monto de crédito: </td><td>".$monto."</td>";
        echo "</tr>";
        echo "<tr id='trNotario'>";
        echo "<td>Gastos Notariales: </td><td>".$notario."</td>";
        echo "</tr>";
        echo "<tr id='trTotalCredito'>";
        echo "<td>Total crédito: </td><td>".$totalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trTotalInteresMensual'>";
        echo "<td>Total interés Mensual: </td><td>".$interesMensual."</td>";
        echo "</tr>";
        echo "<tr id='trInteresAnual'>";
        echo "<td>Interés Anual: </td><td>".$tasa."</td>";
        echo "</tr>";
        echo "<tr id='trAtraso'>";
        echo "<td>Intereses por días de atraso: </td><td>0,01</td>";
        echo "</tr>";
        echo "<tr id='trCuotas'>";
        echo "<td>Cuotas: </td><td>".$cuotas."</td>";
        echo "</tr>";
        echo "<tr id='trCostoTotal'>";
        echo "<td>Costo Total del Crédito: </td><td>".$costoTotalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trValorCuotaMensual'>";
        echo "<td>Valor cuota Mensual: </td><td>".$cuotaMensual."</td>";
        echo "</tr>";
        echo "<tr id='trValorAtraso'>";
        echo "<td>Valor cuota, intereses por atraso diario: </td><td>".$interesAtraso."</td>";
        echo "</tr>";
        if(isset($mesGracia)){
          echo "<tr id='trMesGracia'>";
          echo "<td>Mes de Gracia: </td><td>si</td>";
          echo "</tr>";
        }
      ?>
    @break
    @case($monto >= 500001 && $monto <= 1000000)
      <?php
      $montoMin = 500001;
        $parametros = DB::table('simulador')->select('tasa', 'notario')->where('montoMin', $montoMin)
        ->where('cuotas', $cuotas)->get();
        $tasa = $parametros[0]->tasa;
        $notario = $parametros[0]->notario;
        $totalCredito = $monto + $notario;
        $interesMensual = $tasa/12;
        $costoTotalCredito = ($tasa*$totalCredito)/100 + $totalCredito;
        $cuotaMensual = $costoTotalCredito / $cuotas;
        $interesAtraso = $cuotaMensual * 0.01;
        echo "<tr id='trMontoCredito'>";
        echo "<td>Monto de crédito: </td><td>".$monto."</td>";
        echo "</tr>";
        echo "<tr id='trNotario'>";
        echo "<td>Gastos Notariales: </td><td>".$notario."</td>";
        echo "</tr>";
        echo "<tr id='trTotalCredito'>";
        echo "<td>Total crédito: </td><td>".$totalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trTotalInteresMensual'>";
        echo "<td>Total interés Mensual: </td><td>".$interesMensual."</td>";
        echo "</tr>";
        echo "<tr id='trInteresAnual'>";
        echo "<td>Interés Anual: </td><td>".$tasa."</td>";
        echo "</tr>";
        echo "<tr id='trAtraso'>";
        echo "<td>Intereses por días de atraso: </td><td>0,01</td>";
        echo "</tr>";
        echo "<tr id='trCuotas'>";
        echo "<td>Cuotas: </td><td>".$cuotas."</td>";
        echo "</tr>";
        echo "<tr id='trCostoTotal'>";
        echo "<td>Costo Total del Crédito: </td><td>".$costoTotalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trValorCuotaMensual'>";
        echo "<td>Valor cuota Mensual: </td><td>".$cuotaMensual."</td>";
        echo "</tr>";
        echo "<tr id='trValorAtraso'>";
        echo "<td>Valor cuota, intereses por atraso diario: </td><td>".$interesAtraso."</td>";
        echo "</tr>";
        if(isset($mesGracia)){
          echo "<tr id='trMesGracia'>";
          echo "<td>Mes de Gracia: </td><td>si</td>";
          echo "</tr>";
        } 
      ?>
    @break  
    @case($monto >= 1000001 && $monto <= 1500000)
      <?php
      $montoMin = 1000001;
        $parametros = DB::table('simulador')->select('tasa', 'notario')->where('montoMin', $montoMin)
        ->where('cuotas', $cuotas)->get();
        $tasa = $parametros[0]->tasa;
        $notario = $parametros[0]->notario;
        $totalCredito = $monto + $notario;
        $interesMensual = $tasa/12;
        $costoTotalCredito = ($tasa*$totalCredito)/100 + $totalCredito;
        $cuotaMensual = $costoTotalCredito / $cuotas;
        $interesAtraso = $cuotaMensual * 0.01;
        echo "<tr>";
        echo "<td>Monto de crédito: </td><td>".$monto."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Notario: </td><td>".$notario."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Total crédito: </td><td>".$totalCredito."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Total interés Mensual: </td><td>".$interesMensual."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Interés Anual: </td><td>".$tasa."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Intereses por días de atraso: </td><td>0,01</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Cuotas: </td><td>".$cuotas."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Costo Total del Crédito: </td><td>".$costoTotalCredito."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Valor cuota Mensual: </td><td>".$cuotaMensual."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Valor cuota, intereses por atraso diario: </td><td>".$interesAtraso."</td>";
        echo "</tr>";
        if(isset($mesGracia)){
          echo "<tr>";
          echo "<td>Mes de Gracia: </td><td>si</td>";
          echo "</tr>";
        }
      ?>
    @break  
    @case($monto >= 1500001 && $monto <= 2000000)
      <?php
      $montoMin = 1500001;
        $parametros = DB::table('simulador')->select('tasa', 'notario')->where('montoMin', $montoMin)
        ->where('cuotas', $cuotas)->get();
        $tasa = $parametros[0]->tasa;
        $notario = $parametros[0]->notario;
        $totalCredito = $monto + $notario;
        $interesMensual = $tasa/12;
        $costoTotalCredito = ($tasa*$totalCredito)/100 + $totalCredito;
        $cuotaMensual = $costoTotalCredito / $cuotas;
        $interesAtraso = $cuotaMensual * 0.01;
        echo "<tr id='trMontoCredito'>";
        echo "<td>Monto de crédito: </td><td>".$monto."</td>";
        echo "</tr>";
        echo "<tr id='trNotario'>";
        echo "<td>Gastos Notariales: </td><td>".$notario."</td>";
        echo "</tr>";
        echo "<tr id='trTotalCredito'>";
        echo "<td>Total crédito: </td><td>".$totalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trTotalInteresMensual'>";
        echo "<td>Total interés Mensual: </td><td>".$interesMensual."</td>";
        echo "</tr>";
        echo "<tr id='trInteresAnual'>";
        echo "<td>Interés Anual: </td><td>".$tasa."</td>";
        echo "</tr>";
        echo "<tr id='trAtraso'>";
        echo "<td>Intereses por días de atraso: </td><td>0,01</td>";
        echo "</tr>";
        echo "<tr id='trCuotas'>";
        echo "<td>Cuotas: </td><td>".$cuotas."</td>";
        echo "</tr>";
        echo "<tr id='trCostoTotal'>";
        echo "<td>Costo Total del Crédito: </td><td>".$costoTotalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trValorCuotaMensual'>";
        echo "<td>Valor cuota Mensual: </td><td>".$cuotaMensual."</td>";
        echo "</tr>";
        echo "<tr id='trValorAtraso'>";
        echo "<td>Valor cuota, intereses por atraso diario: </td><td>".$interesAtraso."</td>";
        echo "</tr>";
        if(isset($mesGracia)){
          echo "<tr id='trMesGracia'>";
          echo "<td>Mes de Gracia: </td><td>si</td>";
          echo "</tr>";
        }
      ?>
    @break  
    @case($monto >= 2000001 && $monto <= 2500000)
      <?php
      $montoMin = 2000001;
        $parametros = DB::table('simulador')->select('tasa', 'notario')->where('montoMin', $montoMin)
        ->where('cuotas', $cuotas)->get();
        $tasa = $parametros[0]->tasa;
        $notario = $parametros[0]->notario;
        $totalCredito = $monto + $notario;
        $interesMensual = $tasa/12;
        $costoTotalCredito = ($tasa*$totalCredito)/100 + $totalCredito;
        $cuotaMensual = $costoTotalCredito / $cuotas;
        $interesAtraso = $cuotaMensual * 0.01;
        echo "<tr>";
        echo "<td>Monto de crédito: </td><td>".$monto."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Notario: </td><td>".$notario."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Total crédito: </td><td>".$totalCredito."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Total interés Mensual: </td><td>".$interesMensual."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Interés Anual: </td><td>".$tasa."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Intereses por días de atraso: </td><td>0,01</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Cuotas: </td><td>".$cuotas."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Costo Total del Crédito: </td><td>".$costoTotalCredito."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Valor cuota Mensual: </td><td>".$cuotaMensual."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Valor cuota, intereses por atraso diario: </td><td>".$interesAtraso."</td>";
        echo "</tr>";
        if(isset($mesGracia)){
          echo "<tr>";
          echo "<td>Mes de Gracia: </td><td>si</td>";
          echo "</tr>";
        }
      ?>
    @break  
    @case($monto >= 2500001 && $monto <= 3000000)
      <?php
      $montoMin = 2500001;
        $parametros = DB::table('simulador')->select('tasa', 'notario')->where('montoMin', $montoMin)
        ->where('cuotas', $cuotas)->get();
        $tasa = $parametros[0]->tasa;
        $notario = $parametros[0]->notario;
        $totalCredito = $monto + $notario;
        $interesMensual = $tasa/12;
        $costoTotalCredito = ($tasa*$totalCredito)/100 + $totalCredito;
        $cuotaMensual = $costoTotalCredito / $cuotas;
        $interesAtraso = $cuotaMensual * 0.01;
        echo "<tr id='trMontoCredito'>";
        echo "<td>Monto de crédito: </td><td>".$monto."</td>";
        echo "</tr>";
        echo "<tr id='trNotario'>";
        echo "<td>Gastos Notariales: </td><td>".$notario."</td>";
        echo "</tr>";
        echo "<tr id='trTotalCredito'>";
        echo "<td>Total crédito: </td><td>".$totalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trTotalInteresMensual'>";
        echo "<td>Total interés Mensual: </td><td>".$interesMensual."</td>";
        echo "</tr>";
        echo "<tr id='trInteresAnual'>";
        echo "<td>Interés Anual: </td><td>".$tasa."</td>";
        echo "</tr>";
        echo "<tr id='trAtraso'>";
        echo "<td>Intereses por días de atraso: </td><td>0,01</td>";
        echo "</tr>";
        echo "<tr id='trCuotas'>";
        echo "<td>Cuotas: </td><td>".$cuotas."</td>";
        echo "</tr>";
        echo "<tr id='trCostoTotal'>";
        echo "<td>Costo Total del Crédito: </td><td>".$costoTotalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trValorCuotaMensual'>";
        echo "<td>Valor cuota Mensual: </td><td>".$cuotaMensual."</td>";
        echo "</tr>";
        echo "<tr id='trValorAtraso'>";
        echo "<td>Valor cuota, intereses por atraso diario: </td><td>".$interesAtraso."</td>";
        echo "</tr>";
        if(isset($mesGracia)){
          echo "<tr id='trMesGracia'>";
          echo "<td>Mes de Gracia: </td><td>si</td>";
          echo "</tr>";
        }
      ?>
    @break 
    @case($monto >= 3000001 && $monto <= 3500000)
      <?php
      $montoMin = 3000001;
        $parametros = DB::table('simulador')->select('tasa', 'notario')->where('montoMin', $montoMin)
        ->where('cuotas', $cuotas)->get();
        $tasa = $parametros[0]->tasa;
        $notario = $parametros[0]->notario;
        $totalCredito = $monto + $notario;
        $interesMensual = $tasa/12;
        $costoTotalCredito = ($tasa*$totalCredito)/100 + $totalCredito;
        $cuotaMensual = $costoTotalCredito / $cuotas;
        $interesAtraso = $cuotaMensual * 0.01;
        echo "<tr>";
        echo "<td>Monto de crédito: </td><td>".$monto."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Notario: </td><td>".$notario."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Total crédito: </td><td>".$totalCredito."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Total interés Mensual: </td><td>".$interesMensual."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Interés Anual: </td><td>".$tasa."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Intereses por días de atraso: </td><td>0,01</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Cuotas: </td><td>".$cuotas."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Costo Total del Crédito: </td><td>".$costoTotalCredito."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Valor cuota Mensual: </td><td>".$cuotaMensual."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Valor cuota, intereses por atraso diario: </td><td>".$interesAtraso."</td>";
        echo "</tr>";
        if(isset($mesGracia)){
          echo "<tr>";
          echo "<td>Mes de Gracia: </td><td>si</td>";
          echo "</tr>";
        }
      ?>
    @break 
    @case($monto >= 3500001 && $monto <= 4000000)
      <?php
      $montoMin = 3500001;
        $parametros = DB::table('simulador')->select('tasa', 'notario')->where('montoMin', $montoMin)
        ->where('cuotas', $cuotas)->get();
        $tasa = $parametros[0]->tasa;
        $notario = $parametros[0]->notario;
        $totalCredito = $monto + $notario;
        $interesMensual = $tasa/12;
        $costoTotalCredito = ($tasa*$totalCredito)/100 + $totalCredito;
        $cuotaMensual = $costoTotalCredito / $cuotas;
        $interesAtraso = $cuotaMensual * 0.01;
        echo "<tr id='trMontoCredito'>";
        echo "<td>Monto de crédito: </td><td>".$monto."</td>";
        echo "</tr>";
        echo "<tr id='trNotario'>";
        echo "<td>Gastos Notariales: </td><td>".$notario."</td>";
        echo "</tr>";
        echo "<tr id='trTotalCredito'>";
        echo "<td>Total crédito: </td><td>".$totalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trTotalInteresMensual'>";
        echo "<td>Total interés Mensual: </td><td>".$interesMensual."</td>";
        echo "</tr>";
        echo "<tr id='trInteresAnual'>";
        echo "<td>Interés Anual: </td><td>".$tasa."</td>";
        echo "</tr>";
        echo "<tr id='trAtraso'>";
        echo "<td>Intereses por días de atraso: </td><td>0,01</td>";
        echo "</tr>";
        echo "<tr id='trCuotas'>";
        echo "<td>Cuotas: </td><td>".$cuotas."</td>";
        echo "</tr>";
        echo "<tr id='trCostoTotal'>";
        echo "<td>Costo Total del Crédito: </td><td>".$costoTotalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trValorCuotaMensual'>";
        echo "<td>Valor cuota Mensual: </td><td>".$cuotaMensual."</td>";
        echo "</tr>";
        echo "<tr id='trValorAtraso'>";
        echo "<td>Valor cuota, intereses por atraso diario: </td><td>".$interesAtraso."</td>";
        echo "</tr>";
        if(isset($mesGracia)){
          echo "<tr id='trMesGracia'>";
          echo "<td>Mes de Gracia: </td><td>si</td>";
          echo "</tr>";
        }
      ?>
    @break 
    @case($monto >= 4000001 && $monto <= 4500000)
      <?php
      $montoMin = 4000001;
        $parametros = DB::table('simulador')->select('tasa', 'notario')->where('montoMin', $montoMin)
        ->where('cuotas', $cuotas)->get();
        $tasa = $parametros[0]->tasa;
        $notario = $parametros[0]->notario;
        $totalCredito = $monto + $notario;
        $interesMensual = $tasa/12;
        $costoTotalCredito = ($tasa*$totalCredito)/100 + $totalCredito;
        $cuotaMensual = $costoTotalCredito / $cuotas;
        $interesAtraso = $cuotaMensual * 0.01;
        echo "<tr>";
        echo "<td>Monto de crédito: </td><td>".$monto."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Notario: </td><td>".$notario."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Total crédito: </td><td>".$totalCredito."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Total interés Mensual: </td><td>".$interesMensual."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Interés Anual: </td><td>".$tasa."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Intereses por días de atraso: </td><td>0,01</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Cuotas: </td><td>".$cuotas."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Costo Total del Crédito: </td><td>".$costoTotalCredito."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Valor cuota Mensual: </td><td>".$cuotaMensual."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Valor cuota, intereses por atraso diario: </td><td>".$interesAtraso."</td>";
        echo "</tr>";
        if(isset($mesGracia)){
          echo "<tr>";
          echo "<td>Mes de Gracia: </td><td>si</td>";
          echo "</tr>";
        }
      ?>
    @break 
    @case($monto >= 4500001 && $monto <= 5000000)
      <?php
      $montoMin = 45000001;
        $parametros = DB::table('simulador')->select('tasa', 'notario')->where('montoMin', $montoMin)
        ->where('cuotas', $cuotas)->get();
        $tasa = $parametros[0]->tasa;
        $notario = $parametros[0]->notario;
        $totalCredito = $monto + $notario;
        $interesMensual = $tasa/12;
        $costoTotalCredito = ($tasa*$totalCredito)/100 + $totalCredito;
        $cuotaMensual = $costoTotalCredito / $cuotas;
        $interesAtraso = $cuotaMensual * 0.01;
        echo "<tr id='trMontoCredito'>";
        echo "<td>Monto de crédito: </td><td>".$monto."</td>";
        echo "</tr>";
        echo "<tr id='trNotario'>";
        echo "<td>Gastos Notariales: </td><td>".$notario."</td>";
        echo "</tr>";
        echo "<tr id='trTotalCredito'>";
        echo "<td>Total crédito: </td><td>".$totalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trTotalInteresMensual'>";
        echo "<td>Total interés Mensual: </td><td>".$interesMensual."</td>";
        echo "</tr>";
        echo "<tr id='trInteresAnual'>";
        echo "<td>Interés Anual: </td><td>".$tasa."</td>";
        echo "</tr>";
        echo "<tr id='trAtraso'>";
        echo "<td>Intereses por días de atraso: </td><td>0,01</td>";
        echo "</tr>";
        echo "<tr id='trCuotas'>";
        echo "<td>Cuotas: </td><td>".$cuotas."</td>";
        echo "</tr>";
        echo "<tr id='trCostoTotal'>";
        echo "<td>Costo Total del Crédito: </td><td>".$costoTotalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trValorCuotaMensual'>";
        echo "<td>Valor cuota Mensual: </td><td>".$cuotaMensual."</td>";
        echo "</tr>";
        echo "<tr id='trValorAtraso'>";
        echo "<td>Valor cuota, intereses por atraso diario: </td><td>".$interesAtraso."</td>";
        echo "</tr>";
        if(isset($mesGracia)){
          echo "<tr id='trMesGracia'>";
          echo "<td>Mes de Gracia: </td><td>si</td>";
          echo "</tr>";
        }
      ?>
    @break 
    @case($monto >= 5000001 && $monto <= 6000000)
      <?php
      $montoMin = 5000001;
        $parametros = DB::table('simulador')->select('tasa', 'notario')->where('montoMin', $montoMin)
        ->where('cuotas', $cuotas)->get();
        $tasa = $parametros[0]->tasa;
        $notario = $parametros[0]->notario;
        $totalCredito = $monto + $notario;
        $interesMensual = $tasa/12;
        $costoTotalCredito = ($tasa*$totalCredito)/100 + $totalCredito;
        $cuotaMensual = $costoTotalCredito / $cuotas;
        $interesAtraso = $cuotaMensual * 0.01;
        echo "<tr>";
        echo "<td>Monto de crédito: </td><td>".$monto."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Notario: </td><td>".$notario."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Total crédito: </td><td>".$totalCredito."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Total interés Mensual: </td><td>".$interesMensual."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Interés Anual: </td><td>".$tasa."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Intereses por días de atraso: </td><td>0,01</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Cuotas: </td><td>".$cuotas."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Costo Total del Crédito: </td><td>".$costoTotalCredito."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Valor cuota Mensual: </td><td>".$cuotaMensual."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Valor cuota, intereses por atraso diario: </td><td>".$interesAtraso."</td>";
        echo "</tr>";
        if(isset($mesGracia)){
          echo "<tr>";
          echo "<td>Mes de Gracia: </td><td>si</td>";
          echo "</tr>";
        }
      ?>
    @break 
    @case($monto >= 6000001 && $monto <= 7000000)
      <?php
      $montoMin = 6000001;
        $parametros = DB::table('simulador')->select('tasa', 'notario')->where('montoMin', $montoMin)
        ->where('cuotas', $cuotas)->get();
        $tasa = $parametros[0]->tasa;
        $notario = $parametros[0]->notario;
        $totalCredito = $monto + $notario;
        $interesMensual = $tasa/12;
        $costoTotalCredito = ($tasa*$totalCredito)/100 + $totalCredito;
        $cuotaMensual = $costoTotalCredito / $cuotas;
        $interesAtraso = $cuotaMensual * 0.01;
        echo "<tr id='trMontoCredito'>";
        echo "<td>Monto de crédito: </td><td>".$monto."</td>";
        echo "</tr>";
        echo "<tr id='trNotario'>";
        echo "<td>Gastos Notariales: </td><td>".$notario."</td>";
        echo "</tr>";
        echo "<tr id='trTotalCredito'>";
        echo "<td>Total crédito: </td><td>".$totalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trTotalInteresMensual'>";
        echo "<td>Total interés Mensual: </td><td>".$interesMensual."</td>";
        echo "</tr>";
        echo "<tr id='trInteresAnual'>";
        echo "<td>Interés Anual: </td><td>".$tasa."</td>";
        echo "</tr>";
        echo "<tr id='trAtraso'>";
        echo "<td>Intereses por días de atraso: </td><td>0,01</td>";
        echo "</tr>";
        echo "<tr id='trCuotas'>";
        echo "<td>Cuotas: </td><td>".$cuotas."</td>";
        echo "</tr>";
        echo "<tr id='trCostoTotal'>";
        echo "<td>Costo Total del Crédito: </td><td>".$costoTotalCredito."</td>";
        echo "</tr>";
        echo "<tr id='trValorCuotaMensual'>";
        echo "<td>Valor cuota Mensual: </td><td>".$cuotaMensual."</td>";
        echo "</tr>";
        echo "<tr id='trValorAtraso'>";
        echo "<td>Valor cuota, intereses por atraso diario: </td><td>".$interesAtraso."</td>";
        echo "</tr>";
        if(isset($mesGracia)){
          echo "<tr id='trMesGracia'>";
          echo "<td>Mes de Gracia: </td><td>si</td>";
          echo "</tr>";
        }
      ?>
    @break 
  @endswitch    
  @endif   
  </table>                                       
</div>
</div>
</div>
</body>
</html>