<div class="content-wrapper">

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">

            FICHA CONTROL Y SEGUIMIENTO <br> SOLICITUD DE ESTUDIOS DE LABORATORIO COVID-19

          </h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></li>

            <li class="breadcrumb-item active">Editar Ficha Control COVID-19</li>

          </ol>

        </div>

      </div>

    </div>

  </div>
  
  <section class="content">

    <form id="fichaControlCentro">

      <div class="form-row">

        <div class="form-inline col-md-10">

          Todos los campos con<i class="fas fa-asterisk asterisk mr-1"></i>son obligatorios

        </div>

      </div>

      <!--=============================================
      SECCION 1. DATOS DEL ESTABLECIMIENTO NOTIFICADOR
      =============================================-->  

      <?php

        $item = "id_ficha";
        $valor = $_GET["idFicha"];

        $ficha = ControladorFichas::ctrMostrarFichas($item, $valor);

        /*=============================================
        TRAEMOS LOS DATOS DE ESTABLECIMIENTO
        =============================================*/

        $item = "id";
        $valor = $ficha["id_establecimiento"];

        $establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

        /*=============================================
        TRAEMOS LOS DATOS DE CONSULTORIO
        =============================================*/

        $item = "id";
        $valor = $ficha["id_consultorio"];

        $consultorios = ControladorConsultorios::ctrMostrarConsultorios($item, $valor);

       /*=============================================
        TRAEMOS LOS DATOS DE DEPARTAMENTO
        =============================================*/

        $item = "id";
        $valor = $ficha["id_departamento"];

        $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

        /*=============================================
        TRAEMOS LOS DATOS DE LOCALIDAD
        =============================================*/

        $item = "id";
        $valor = $ficha["id_localidad"];

        $localidades = ControladorLocalidades::ctrMostrarLocalidades($item, $valor);

      ?>

      <div class="card mb-0">
        
        <div class="card-header bg-dark py-1 text-center">

          <span>1. DATOS DEL ESTABLECIMIENTO NOTIFICADOR</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">

            <div class="col-md-10">

            </div>

            <div class="form-inline col-md-2">

              <h5 class="text-dark">COD. FICHA: <?= $_GET["idFicha"] ?></h5>

            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-4">

              <label class="m-0 font-weight-normal" for="nuevoEstablecimiento">Establecimiento de Salud / Centro Aislamiento</label><i class="fas fa-asterisk asterisk mr-1"></i>
              <select class="form-control form-control-sm select2" name="nuevoEstablecimiento" id="nuevoEstablecimiento" data-dropdown-css-class="select2-info" style="width: 100%;">
                <?php

                if ($establecimientos == false) {

                ?>

                  <option value="">Elegir...</option>

                <?php   

                  $item = null;
                  $valor = null;

                  $establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

                  foreach ($establecimientos as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_establecimiento"].'</option>';

                  } 

                } else {

                ?>

                <option value="<?= $establecimientos['id']?>"><?= $establecimientos["nombre_establecimiento"]?></option>

                <?php 

                  $item = null;
                  $valor = null;

                  $establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

                  foreach ($establecimientos as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_establecimiento"].'</option>';
                  }

                } 

                ?>
              </select>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoConsultorio">Consultorio</label>
              <select class="form-control form-control-sm select2" name="nuevoConsultorio" id="nuevoConsultorio" data-dropdown-css-class="select2-info" style="width: 100%;" disabled>
                <?php

                if ($consultorios == false) {

                ?>

                  <option value="">Elegir...</option>

                <?php                

                  $item = null;
                  $valor = null;

                  $consultorios = ControladorConsultorios::ctrMostrarConsultorios($item, $valor);

                  foreach ($consultorios as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_consultorio"].'</option>';

                  } 
                  
                } else {

                ?>

                  <option value="<?= $consultorios['id']?>"><?= $consultorios["nombre_consultorio"]?></option>

                <?php 

                  $item = null;
                  $valor = null;

                  $consultorios = ControladorConsultorios::ctrMostrarConsultorios($item, $valor);

                  foreach ($consultorios as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_consultorio"].'</option>';
                  }

                } 

                ?>
              </select>

            </div>            
            
          </div>

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoDepartamento">Departamento</label><i class="fas fa-asterisk asterisk"></i>
              <select class="form-control form-control-sm select2" name="nuevoDepartamento" id="nuevoDepartamento" data-dropdown-css-class="select2-info" style="width: 100%;">
                <?php

                if ($departamentos == false) {

                ?>

                <option value="">Elegir...</option>

                <?php 

                  $item = null;
                  $valor = null;

                  $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

                  foreach ($departamentos as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_depto"].'</option>';
                    
                  }
                  
                } else {

                ?>

                <option value="<?= $departamentos['id']?>"><?= $departamentos["nombre_depto"]?></option>
                
                <?php 

                  $item = null;
                  $valor = null;

                  $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

                  foreach ($departamentos as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_depto"].'</option>';
                  }

                }
                   
                ?>
              </select>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoLocalidad">Localidad</label><i class="fas fa-asterisk asterisk mr-1"></i>
              <select class="form-control form-control-sm select2" name="nuevoLocalidad" id="nuevoLocalidad" data-dropdown-css-class="select2-info" style="width: 100%;">
                <?php

                if ($localidades == false) {

                ?>

                <option value="">Elegir...</option>

                <?php 

                  $item = null;
                  $valor = null;

                  $localidades = ControladorLocalidades::ctrMostrarLocalidades($item, $valor);

                  foreach ($localidades as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_localidad"].'</option>';
                    
                  } 
                  
                } else {

                ?>

                <option value="<?= $localidades['id']?>"><?= $localidades["nombre_localidad"]?></option>
                
                <?php 

                  $item = null;
                  $valor = null;

                  $localidades = ControladorLocalidades::ctrMostrarLocalidades($item, $valor);

                  foreach ($localidades as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_localidad"].'</option>';
                  }

                }
                 
                ?>
              </select>

            </div> 

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoFechaNotificacion">Fecha de Notificaci??n</label><i class="fas fa-asterisk asterisk mr-1"></i>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaNotificacion" id="nuevoFechaNotificacion" value="<?= $ficha['fecha_notificacion'] ?>">

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoNroControl">Control</label>
              <i class="fas fa-asterisk asterisk mr-1"></i>
              <select class="form-control form-control-sm col-md-6 select2" name="nuevoNroControl" id="nuevoNroControl" data-dropdown-css-class="select2-info" style="width: 100%;">
                <option value="<?= $ficha['nro_control'] ?>"><?= $ficha['nro_control'] ?></option>
                <?php 

                  if ($ficha['nro_control'] == "1??") {

                    echo 
                    '<option value="2??">2??</option>
                    <option value="3??">3??</option>
                    <option value="4??">4??</option>';
                    
                  } else if ($ficha['nro_control'] == "2??") {
                    
                    echo 
                    '<option value="1??">1??</option>
                    <option value="3??">3??</option>
                    <option value="4??">4??</option>';

                  } else if ($ficha['nro_control'] == "3??") {
                    
                    echo 
                    '<option value="1??">1??</option>
                    <option value="2??">2??</option>
                    <option value="4??">4??</option>';

                  } else {
                    
                    echo 
                    '<option value="1??">1??</option>
                    <option value="2??">2??</option>
                    <option value="3??">3??</option>
                    <option value="4??">4??</option>';

                  }

                ?>    
              </select>

            </div>
            
          </div>
          
        </div>

      </div>

      <!--=============================================
      SECCION 2. IDENTIFICACION DEL CASO/PACIENTE
      =============================================--> 

      <?php

        $item = "id_ficha";
        $valor = $_GET["idFicha"];

        $pacienteAsegurado = ControladorPacientesAsegurados::ctrMostrarPacientesAsegurados($item, $valor);

      ?>

      <div class="card mb-0">
        
        <div class="card-header bg-dark py-1 text-center">

          <span>2. IDENTIFICACION DEL CASO/PACIENTE</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">
            
            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoCodAsegurado">Cod. Asegurado</label><i class="fas fa-asterisk asterisk mr-1"></i>
              <select class="form-control form-control-sm" id="nuevoCodAsegurado" name="nuevoCodAsegurado" data-toggle="modal" data-target="#modalCodAsegurado" data-dismiss="modal">

                <option value="<?php echo $pacienteAsegurado['cod_asegurado']?>"><?php echo $pacienteAsegurado['cod_asegurado']?></option>

              </select>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoCodAfiliado">Cod. Afiliado</label>
              <input type="text" class="form-control form-control-sm" name="nuevoCodAfiliado" id="nuevoCodAfiliado" value="<?= $pacienteAsegurado['cod_afiliado'] ?>" readonly>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoCodEmpleador">Cod. Empleador</label>
              <input type="text" class="form-control form-control-sm" name="nuevoCodEmpleador" id="nuevoCodEmpleador" value="<?= $pacienteAsegurado['cod_empleador'] ?>" readonly>

            </div>

            <div class="form-group col-md-6">

              <label class="m-0 font-weight-normal" for="nuevoNombreEmpleador">Nombre Empleador(s)</label>
              <input type="text" class="form-control form-control-sm" name="nuevoNombreEmpleador" id="nuevoNombreEmpleador" value="<?= $pacienteAsegurado['nombre_empleador'] ?>" readonly>

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoPaternoPaciente">Ap. Paterno</label>
              <input type="text" class="form-control form-control-sm" name="nuevoPaternoPaciente" id="nuevoPaternoPaciente" value="<?= $pacienteAsegurado['paterno'] ?>" readonly>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoMaternoPaciente">Ap. Materno</label>
              <input type="text" class="form-control form-control-sm" name="nuevoMaternoPaciente" id="nuevoMaternoPaciente" value="<?= $pacienteAsegurado['materno'] ?>" readonly>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoNombrePaciente">Nombre(s)</label>
              <input type="text" class="form-control form-control-sm" name="nuevoNombrePaciente" id="nuevoNombrePaciente" value="<?= $pacienteAsegurado['nombre'] ?>" readonly>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoSexoPaciente">Sexo</label><i class="fas fa-asterisk asterisk mr-1"></i>
              <select class="form-control form-control-sm select2" name="nuevoSexoPaciente" id="nuevoSexoPaciente" data-dropdown-css-class="select2-info" style="width: 100%;">
              <?php 

                if ($pacienteAsegurado['sexo'] == "F") {

                  echo '
                  <option value="F">FEMENINO</option>
                  <option value="M">MASCULINO</option>';
                  
                } else if ($pacienteAsegurado['sexo'] == "M") {
                  
                  echo '
                  <option value="M">MASCULINO</option>
                  <option value="F">FEMENINO</option>';

                } else {

                  echo '
                  <option value="">Elegir...</option>
                  <option value="F">FEMENINO</option>
                  <option value="M">MASCULINO</option>';

                }

              ?>   
              </select>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoNroDocumentoPaciente">Nro. Documento</label><i class="fas fa-asterisk asterisk mr-1"></i>
              <input class="form-control form-control-sm" name="nuevoNroDocumentoPaciente" id="nuevoNroDocumentoPaciente" value="<?= $pacienteAsegurado['nro_documento'] ?>">

            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoFechaNacPaciente">Fecha de Nacimiento</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaNacPaciente" id="nuevoFechaNacPaciente" value="<?= $pacienteAsegurado['fecha_nacimiento'] ?>" readonly>

            </div>

            <div class="form-group col-md-1">

              <label class="m-0 font-weight-normal" for="nuevoEdadPaciente">Edad</label>
              <input type="text" class="form-control form-control-sm" name="nuevoEdadPaciente" id="nuevoEdadPaciente" value="<?= $pacienteAsegurado['edad'] ?>" readonly>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoTelefonoPaciente">Tel??fono</label>
              <input type="text" class="form-control form-control-sm" name="nuevoTelefonoPaciente" id="nuevoTelefonoPaciente" data-inputmask="'mask': '9{7,8}'" value="<?= $pacienteAsegurado['telefono'] ?>">

            </div>

            <div class="form-group col-md-5">

              <label class="m-0 font-weight-normal" for="nuevoEmailPaciente">Email</label>
              <input type="text" class="form-control form-control-sm" name="nuevoEmailPaciente" id="nuevoEmailPaciente" data-inputmask="'alias': 'email'" inputmode="email" value="<?= $pacienteAsegurado['email'] ?>">

            </div>

          </div>
          
        </div>

      </div>

      <!--=============================================
      SECCION 3. SEGUIMIENTO
      =============================================-->  

      <?php

        $item = "id_ficha";
        $valor = $_GET["idFicha"];

        $hospitalizaciones_aislamientos = ControladorHospitalizacionesAislamientos::ctrMostrarHospitalizacionesAislamientos($item, $valor);

      ?>  

      <div class="card mb-0">
        
        <div class="card-header bg-dark py-1 text-center">

          <span>3. SEGUIMIENTO</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">
            
            <div class="form-group col-md-4">

              <label class="m-0" for="nuevoDiasNotificacion">??Han pasado 14 d??as desde la notificaci??n?</label>
              <i class="fas fa-asterisk asterisk mr-1"></i>
              <select class="form-control form-control-sm select2" name="nuevoDiasNotificacion" id="nuevoDiasNotificacion" data-dropdown-css-class="select2-info" style="width: 100%;">
                <?php 

                if ($hospitalizaciones_aislamientos['dias_notificacion'] == "SI") {

                  echo 
                  '<option value="'.$hospitalizaciones_aislamientos['dias_notificacion'].'">'.$hospitalizaciones_aislamientos['dias_notificacion'].'</option>
                  <option value="NO">NO</option>';
                  
                } else if ($hospitalizaciones_aislamientos['dias_notificacion'] == "NO") {
                  
                  echo 
                  '<option value="'.$hospitalizaciones_aislamientos['dias_notificacion'].'">'.$hospitalizaciones_aislamientos['dias_notificacion'].'</option>
                  <option value="SI">SI</option>';

                } else {

                  echo 
                  '<option value="">Elegir...</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>';

                }

                ?>  
              </select>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoDiasSinSintomas">N?? de d??as SIN sintomas</label>
              <input type="number" class="form-control form-control-sm mayuscula" name="nuevoDiasSinSintomas" id="nuevoDiasSinSintomas" value="<?= $hospitalizaciones_aislamientos['dias_sin_sintomas'] ?>">

            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaAislamiento">Fecha de Aislamiento</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaAislamiento" id="nuevoFechaAislamiento" value="<?= $hospitalizaciones_aislamientos['fecha_aislamiento'] ?>">

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoLugarAislamiento">Lugar de Aislamiento</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoLugarAislamiento" id="nuevoLugarAislamiento" value="<?= $hospitalizaciones_aislamientos['lugar_aislamiento'] ?>">

            </div>

            <div class="form-group col-md-2 offset-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaInternacion">Fecha de Internaci??n</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaInternacion" id="nuevoFechaInternacion" value="<?= $hospitalizaciones_aislamientos['fecha_internacion'] ?>">

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoEstablecimientoInternacion">Establecimiento de salud de internaci??n</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoEstablecimientoInternacion" id="nuevoEstablecimientoInternacion" value="<?= $hospitalizaciones_aislamientos['establecimiento_internacion'] ?>">

            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaIngresoUTI">Fecha de Ingreso a UTI</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaIngresoUTI" id="nuevoFechaIngresoUTI" value="<?= $hospitalizaciones_aislamientos['fecha_ingreso_UTI'] ?>">

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoLugarIngresoUTI">Lugar de UTI</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoLugarIngresoUTI" id="nuevoLugarIngresoUTI" value="<?= $hospitalizaciones_aislamientos['lugar_ingreso_UTI'] ?>">

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoVentilacionMecanica">Ventilaci??n mec??nica</label><i class="fas fa-asterisk asterisk mr-1"></i>
              <select class="form-control form-control-sm select2" name="nuevoVentilacionMecanica" id="nuevoVentilacionMecanica" data-dropdown-css-class="select2-info" style="width: 100%;">
          
                <?php 

                if ($hospitalizaciones_aislamientos['ventilacion_mecanica'] == "SI") {

                  echo 
                  '<option value="'.$hospitalizaciones_aislamientos['ventilacion_mecanica'].'">'.$hospitalizaciones_aislamientos['ventilacion_mecanica'].'</option>
                  <option value="NO">NO</option>';
                  
                } else if ($hospitalizaciones_aislamientos['ventilacion_mecanica'] == "NO") {
                  
                  echo 
                  '<option value="'.$hospitalizaciones_aislamientos['ventilacion_mecanica'].'">'.$hospitalizaciones_aislamientos['ventilacion_mecanica'].'</option>
                  <option value="SI">SI</option>';

                } else {

                  echo 
                  '<option value="">Elegir...</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>';

                }

                ?>   
              </select>

            </div>

          </div>

          <div class="form-row">

          <?php

            // Descomponiendo el string de malestares
            $tratamiento = explode(",", $hospitalizaciones_aislamientos['tratamiento']);
            // var_dump($tratamiento);
            // var_dump(count($tratamiento));
          ?>

            <div class="icheck-silver mr-5">

              <label class="font-weight">Tratamiento</label>

            </div>

            <div class="icheck-silver mr-5">

            <?php 
              $j = 0;
              for($i = 0; $i < count($tratamiento); $i++) {
                
                if ($tratamiento[$i] == "ANTIVIRAL") {

                  echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIVIRAL" id="nuevoAntiviral" checked>';

                  break;

                } else {

                  $j++;

                  if ($j == count($tratamiento)) {

                    echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIVIRAL" id="nuevoAntiviral">';

                  }

                }

              }
            ?>
              
              <label class="font-weight-normal" for="nuevoAntiviral">Antiviral</label>

            </div>

            <div class="icheck-silver mr-5">

            <?php 
              $j = 0;
              for($i = 0; $i < count($tratamiento); $i++) {
                
                if ($tratamiento[$i] == "ANTIBI??TICO") {

                  echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIBI??TICO" id="nuevoAntibiotico" checked>';

                  break;

                } else {

                  $j++;

                  if ($j == count($tratamiento)) {

                    echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIBI??TICO" id="nuevoAntibiotico">';

                  }

                }

              }
            ?>
              
              <label class="font-weight-normal" for="nuevoAntibiotico">Antibi??tico</label>

            </div>

            <div class="icheck-silver mr-5">

            <?php 
              $j = 0;
              for($i = 0; $i < count($tratamiento); $i++) {
                
                if ($tratamiento[$i] == "ANTIPARASITARIO") {

                  echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIPARASITARIO" id="nuevoAntiparasitario" checked>';

                  break;

                } else {

                  $j++;

                  if ($j == count($tratamiento)) {

                    echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIPARASITARIO" id="nuevoAntiparasitario">';

                  }

                }

              }
            ?>
              
              <label class="font-weight-normal" for="nuevoAntiparasitario">Antiparasitario</label>

            </div>

            <div class="icheck-silver mr-5">

            <?php 
              $j = 0;
              for($i = 0; $i < count($tratamiento); $i++) {
                
                if ($tratamiento[$i] == "ANTIFLAMATORIO") {

                  echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIFLAMATORIO" id="nuevoAntiflamatorio" checked>';

                  break;

                } else {

                  $j++;

                  if ($j == count($tratamiento)) {

                    echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIFLAMATORIO" id="nuevoAntiflamatorio">';

                  }

                }

              }
            ?>
              
              <label class="font-weight-normal" for="nuevoAntiflamatorio">Antiflamatorio</label>

            </div>

            <div class="form-inline col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoTratamientoOtros">Otros</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoTratamientoOtros" name="nuevoTratamientoOtros" value="<?= $hospitalizaciones_aislamientos['tratamiento_otros'] ?>"> 

            </div>

          </div>
          
        </div>

      </div>

      <!--=============================================
      SECCION 4. LABORATORIO
      =============================================-->  

      <?php

        $item = "id_ficha";
        $valor = $_GET["idFicha"];

        $laboratorios = ControladorLaboratorios::ctrMostrarLaboratorios($item, $valor);

      ?>  

      <div class="card mb-0 fichaControlLaboratorio">
        
        <div class="card-header bg-dark py-1 text-center">

          <span>4. LABORATORIO</span>
          
        </div>

        <div class="card-body">

        <?php 

        if ($laboratorios['estado_muestra'] == "SI") {

          // SI SE TOMO MUESTRA PARA LABORATORIO 

        ?>

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoEstadoMuestra">Se tom?? muestra para Laboratorio <i class="fas fa-asterisk asterisk"></i></label>
              <select class="form-control form-control-sm select2" name="nuevoEstadoMuestra" id="nuevoEstadoMuestra" data-dropdown-css-class="select2-info" style="width: 100%;">

                <option value="<?= $laboratorios["estado_muestra"] ?>"><?= $laboratorios["estado_muestra"] ?></option>
                  <option value="NO">NO</option>';
  
              </select>   
            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoNoTomaMuestra">??Por qu?? no se tom?? la muestra?</label>

              <select class="form-control form-control-sm select2_dinamic mayuscula" id="nuevoNoTomaMuestra" name="nuevoNoTomaMuestra" data-dropdown-css-class="select2-info" style="width: 100%;" disabled>

                <option value="<?= $laboratorios['no_toma_muestra'] ?>"><?= $laboratorios['no_toma_muestra'] ?></option>
                <option value="RECHAZO">RECHAZO</option>
                <option value="FALTA DE INSUMOS / EPP">FALTA DE INSUMOS / EPP</option>
                <option value="FALLECIDO">FALLECIDO</option>
              </select>  

            </div>

            <div class="form-group col-md-3">
            
              <label class="m-0" for="nuevoTipoMuestra">Tipo de muestra tomada</label> 
              <i class="fas fa-asterisk asterisk"></i>
              <select class="form-control form-control-sm select2_dinamic" id="nuevoTipoMuestra" name="nuevoTipoMuestra" data-dropdown-css-class="select2-info" style="width: 100%;" required>

                <option value="<?= $laboratorios['tipo_muestra'] ?>"><?= $laboratorios['tipo_muestra'] ?></option>
                <option value="ASPIRADO">ASPIRADO</option>
                <option value="ESPUTO">ESPUTO</option>
                <option value="LAVADO BRONCO ALVELAR">LAVADO BRONCO ALVELAR</option>
                <option value="HISOPADO NASOFAR??NGEO">HISOPADO NASOFAR??NGEO</option>
                <option value="HISOPADO COMBINADO">HISOPADO COMBINADO</option>

              </select>
        
            </div>
            
          </div>

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoNombreLaboratorio">Nombre de Lab. que procesara la muestra</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoNombreLaboratorio" name="nuevoNombreLaboratorio" value="<?= $laboratorios['nombre_laboratorio'] ?>"> 

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoFechaMuestra">Fecha de toma de muestra</label>
              <i class="fas fa-asterisk asterisk"></i>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaMuestra" id="nuevoFechaMuestra" value="<?= $laboratorios['fecha_muestra'] ?>" required>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaEnvio">Fecha de Env??o</label>
              <i class="fas fa-asterisk asterisk"></i>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaEnvio" id="nuevoFechaEnvio" value="<?= $laboratorios['fecha_envio'] ?>" required>

            </div>

            <div class="form-group col-md-4">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoResponsableMuestra">Responsable de Toma de Muestra</label>
              <i class="fas fa-asterisk asterisk"></i>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoResponsableMuestra" id="nuevoResponsableMuestra" value="<?= $laboratorios['responsable_muestra'] ?>" required>

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-12">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoObsMuestra">Observaciones</label>
              <input type="text" class="form-control form-control-sm" id="nuevoObsMuestra" name="nuevoObsMuestra" value="<?= $laboratorios['observaciones_muestra'] ?>"> 

            </div>

          </div>

         <?php
           
        } else if ($laboratorios['estado_muestra'] == "NO") {

          // SI NO SE TOMO MUESTRA PARA LABORATORIO 

        ?>

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoEstadoMuestra">Se tom?? muestra para Laboratorio <i class="fas fa-asterisk asterisk"></i></label>
              <select class="form-control form-control-sm select2" name="nuevoEstadoMuestra" id="nuevoEstadoMuestra" data-dropdown-css-class="select2-info" style="width: 100%;">

                  <option value="<?= $laboratorios["estado_muestra"] ?>"><?= $laboratorios["estado_muestra"] ?></option>
                  <option value="SI">SI</option>';

              </select>   
            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoNoTomaMuestra">??Por qu?? no se tom?? la muestra?</label>
              <i class="fas fa-asterisk asterisk"></i>
              <select class="form-control form-control-sm select2_dinamic mayuscula" id="nuevoNoTomaMuestra" name="nuevoNoTomaMuestra" data-dropdown-css-class="select2-info" style="width: 100%;" required>

                <option value="<?= $laboratorios['no_toma_muestra'] ?>"><?= $laboratorios['no_toma_muestra'] ?></option>
                <option value="RECHAZO">RECHAZO</option>
                <option value="FALTA DE INSUMOS / EPP">FALTA DE INSUMOS / EPP</option>
                <option value="FALLECIDO">FALLECIDO</option>
              </select>  

            </div>

            <div class="form-group col-md-3">
            
              <label class="m-0" for="nuevoTipoMuestra">Tipo de muestra tomada</label> 
              <select class="form-control form-control-sm select2_dinamic" id="nuevoTipoMuestra" name="nuevoTipoMuestra" data-dropdown-css-class="select2-info" style="width: 100%;" disabled>

                <option value="<?= $laboratorios['tipo_muestra'] ?>"><?= $laboratorios['tipo_muestra'] ?></option>
                <option value="ASPIRADO">ASPIRADO</option>
                <option value="ESPUTO">ESPUTO</option>
                <option value="LAVADO BRONCO ALVELAR">LAVADO BRONCO ALVELAR</option>
                <option value="HISOPADO NASOFAR??NGEO">HISOPADO NASOFAR??NGEO</option>
                <option value="HISOPADO COMBINADO">HISOPADO COMBINADO</option>

              </select>
        
            </div>
            
          </div>

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoNombreLaboratorio">Nombre de Lab. que procesara la muestra</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoNombreLaboratorio" name="nuevoNombreLaboratorio" value="<?= $laboratorios['nombre_laboratorio'] ?>" readonly> 

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoFechaMuestra">Fecha de toma de muestra</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaMuestra" id="nuevoFechaMuestra" value="<?= $laboratorios['fecha_muestra'] ?>" readonly>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaEnvio">Fecha de Env??o</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaEnvio" id="nuevoFechaEnvio" value="<?= $laboratorios['fecha_envio'] ?>" readonly>

            </div>

            <div class="form-group col-md-4">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoResponsableMuestra">Responsable de Toma de Muestra</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoResponsableMuestra" id="nuevoResponsableMuestra" value="<?= $laboratorios['responsable_muestra'] ?>" readonly>

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-12">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoObsMuestra">Observaciones</label>
              <input type="text" class="form-control form-control-sm" id="nuevoObsMuestra" name="nuevoObsMuestra" value="<?= $laboratorios['observaciones_muestra'] ?>"> 

            </div>

          </div>

        <?php
           
        } else {

          // NUEVA FICHA EPIDEMIOLOGICA

        ?>

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoEstadoMuestra">Se tom?? muestra para Laboratorio</label>
              <i class="fas fa-asterisk asterisk"></i>
              <select class="form-control form-control-sm select2" name="nuevoEstadoMuestra" id="nuevoEstadoMuestra" data-dropdown-css-class="select2-info" style="width: 100%;">
              <?php 

                if ($laboratorios['estado_muestra'] == "SI") {

                  echo '
                  <option value="'.$laboratorios["estado_muestra"].'">'.$laboratorios["estado_muestra"].'</option>
                  <option value="NO">NO</option>';
                  
                } else if ($laboratorios['estado_muestra'] == "NO") {
                  
                  echo '
                  <option value="'.$laboratorios["estado_muestra"].'">'.$laboratorios["estado_muestra"].'</option>
                  <option value="SI">SI</option>';

                } else {

                  echo '
                  <option value="">Elegir...</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>';
                }

              ?>
              </select>   
            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoNoTomaMuestra">??Por qu?? no se tom?? la muestra?</label>

              <select class="form-control form-control-sm select2_dinamic mayuscula" id="nuevoNoTomaMuestra" name="nuevoNoTomaMuestra" data-dropdown-css-class="select2-info" style="width: 100%;" disabled>

                <option value="<?= $laboratorios['no_toma_muestra'] ?>"><?= $laboratorios['no_toma_muestra'] ?></option>
                <option value="RECHAZO">RECHAZO</option>
                <option value="FALTA DE INSUMOS / EPP">FALTA DE INSUMOS / EPP</option>
                <option value="FALLECIDO">FALLECIDO</option>
              </select>  

            </div>

            <div class="form-group col-md-3">
            
              <label class="m-0" for="nuevoTipoMuestra">Tipo de muestra tomada</label> 
              <select class="form-control form-control-sm select2_dinamic" id="nuevoTipoMuestra" name="nuevoTipoMuestra" data-dropdown-css-class="select2-info" style="width: 100%;" disabled>

                <option value="<?= $laboratorios['tipo_muestra'] ?>"><?= $laboratorios['tipo_muestra'] ?></option>
                <option value="ASPIRADO">ASPIRADO</option>
                <option value="ESPUTO">ESPUTO</option>
                <option value="LAVADO BRONCO ALVELAR">LAVADO BRONCO ALVELAR</option>
                <option value="HISOPADO NASOFAR??NGEO">HISOPADO NASOFAR??NGEO</option>
                <option value="HISOPADO COMBINADO">HISOPADO COMBINADO</option>

              </select>
        
            </div>
            
          </div>

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoNombreLaboratorio">Nombre de Lab. que procesara la muestra</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoNombreLaboratorio" name="nuevoNombreLaboratorio" value="<?= $laboratorios['nombre_laboratorio'] ?>" readonly> 

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoFechaMuestra">Fecha de toma de muestra</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaMuestra" id="nuevoFechaMuestra" value="<?= $laboratorios['fecha_muestra'] ?>" readonly>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaEnvio">Fecha de Env??o</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaEnvio" id="nuevoFechaEnvio" value="<?= $laboratorios['fecha_envio'] ?>" readonly>

            </div>

            <div class="form-group col-md-4">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoResponsableMuestra">Responsable de Toma de Muestra</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoResponsableMuestra" id="nuevoResponsableMuestra" value="<?= $laboratorios['responsable_muestra'] ?>" readonly>

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-12">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoObsMuestra">Observaciones</label>
              <input type="text" class="form-control form-control-sm" id="nuevoObsMuestra" name="nuevoObsMuestra" value="<?= $laboratorios['observaciones_muestra'] ?>"> 

            </div>

          </div>

        <?php

        }

        ?>       

        </div>

      </div>

      <div class="card mb-0">

        <div class="card-header bg-secondary py-1 text-center">

          <span>RESULTADO</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoCodLaboratorio">Cod. Laboratorio</label>
              <input type="text" class="form-control form-control-sm" name="nuevoCodLaboratorio" id="nuevoCodLaboratorio" value="<?= $laboratorios['cod_laboratorio'] ?>" readonly>

            </div>

            <div class="form-group col-md-2 offset-md-1">

              <label class="m-0" for="nuevoMetodoDiagnostico">M??todo de Diagnostico</label>
              <input type="text" class="form-control form-control-sm" name="nuevoMetodoDiagnostico" id="nuevoMetodoDiagnostico" value="<?= $laboratorios['metodo_diagnostico'] ?>" readonly>

            </div>

            <div class="form-group col-md-2 offset-md-1">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoResultadoLaboratorio">Resultados Laboratorio</label>

              <?php

              if ($laboratorios['resultado_laboratorio'] == "POSITIVO") {

                echo 
                '<div class="icheck-danger icheck">
                  <input type="radio" name="nuevoResultadoLaboratorio" id="positivo" value="POSITIVO" checked disabled>
                  <label for="positivo">
                    POSITIVO
                  </label>
                </div>
                <div class="icheck-success icheck">
                  <input type="radio" name="nuevoResultadoLaboratorio" id="negativo" value="NEGATIVO" disabled>
                  <label for="negativo">
                    NEGATIVO
                  </label>
                </div>';

              } else if ($laboratorios['resultado_laboratorio'] == "NEGATIVO") {

                echo 
                '<div class="icheck-danger icheck">
                  <input type="radio" name="nuevoResultadoLaboratorio" id="positivo" value="POSITIVO" disabled>
                  <label for="positivo">
                    POSITIVO
                  </label>
                </div>
                <div class="icheck-success icheck">
                  <input type="radio" name="nuevoResultadoLaboratorio" id="negativo" value="NEGATIVO" checked disabled>
                  <label for="negativo">
                    NEGATIVO
                  </label>
                </div>';

              } else {

                echo 
                '<div class="icheck-danger icheck">
                  <input type="radio" name="nuevoResultadoLaboratorio" id="positivo" value="POSITIVO" disabled>
                  <label for="positivo">
                    POSITIVO
                  </label>
                </div>
                <div class="icheck-success icheck">
                  <input type="radio" name="nuevoResultadoLaboratorio" id="negativo" value="NEGATIVO" disabled>
                  <label for="negativo">
                    NEGATIVO
                  </label>
                </div>';

              }

              ?>                     

            </div>

            <div class="form-group col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoFechaResultado">Fecha de Resultado</label>
              <input type="date" class="form-control form-control-sm" id="nuevoFechaResultado" name="nuevoFechaResultado" value="<?= $laboratorios['fecha_resultado'] ?>" readonly> 

            </div>

          </div> 

        </div>       

      </div>

      <!--=============================================
      SECCION PERSONAL QUE NOTIFICA
      =============================================-->  

      <?php

        $item = "id_ficha";
        $valor = $_GET["idFicha"];

        $persona_notificador = ControladorPersonasNotificadores::ctrMostrarPersonasNotificadores($item, $valor);

      ?>  

      <div class="card mb-0">

        <div class="card-header bg-dark py-1 text-center">

          <span>5. DATOS DEL PERSONAL QUE NOTIFICA</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">

            <div class="form-group col-md-2">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoPaternoNotif">Ap. Paterno</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoPaternoNotif" name="nuevoPaternoNotif" value="<?= $persona_notificador['paterno_notificador'] ?>"> 

            </div>

            <div class="form-group col-md-2">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoMaternoNotif">Ap. Materno</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoMaternoNotif" name="nuevoMaternoNotif" value="<?= $persona_notificador['materno_notificador'] ?>"> 

            </div>

            <div class="form-group col-md-3">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoNombreNotif">Nombre(s)</label><i class="fas fa-asterisk asterisk mr-1"></i>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoNombreNotif" name="nuevoNombreNotif" value="<?= $persona_notificador['nombre_notificador'] ?>"> 

            </div>

            <div class="form-group col-md-2">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoTelefonoNotif">Tel. cel</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoTelefonoNotif" name="nuevoTelefonoNotif" data-inputmask="'mask': '9{7,8}'" value="<?= $persona_notificador['telefono_notificador'] ?>"> 

            </div>

            <div class="form-group col-md-3">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoCargoNotif">Cargo</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoCargoNotif" name="nuevoCargoNotif" value="<?= $persona_notificador['cargo_notificador'] ?>"> 

            </div>

          </div>
          
        </div>

        <div class="card-footer">

          <div class="float-right">

            <input type="hidden" id="idFicha" value="<?= $_GET["idFicha"] ?>">

            <button type="button" class="btn btn-primary btnGuardar">

              <i class="fas fa-save"></i>
              Guardar

            </button>

          </div>
          
        </div>

      </div>

    </form>

  </section>
  
</div>


<!--=====================================
MODAL SELECCIONAR ASEGURADO
======================================-->

<div id="modalCodAsegurado" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="CodAsegurado" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header bg-gradient-info">

        <h5 class="modal-title" id="modificarUsuario">Buscar Asegurado</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="form-row">

          <div class="input-group col-md-3"></div>
          
          <div class="input-group col-md-9">

            <span class="mt-2 mr-2">Buscar:</span>
            
            <input type="text" class="form-control mr-2" id="buscardorAfiliadosFichas" placeholder="Ingrese Apellidos o Nombre(s) o Codigo Asegurado.">

            <button type="button" class="btn btn-primary px-2 btnBuscarAfiliadoFichas">
          
              <i class="fas fa-search"></i> Buscar
            
            </button>  

          </div>     

        </div>
 
        <!--=====================================
        SE MUESTRA LAS TABLAS GENERADAS
        ======================================-->            

        <div id="tblAfiliadosSIAISFichas" class="mt-4">   

                  
        </div>

      </div>

    </div>

  </div>

</div>
