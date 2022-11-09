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

    <form id="fichaControlLab">

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

              <label class="m-0 font-weight-normal" for="nuevoEstablecimiento">Establecimiento de Salud / Centro Aislamiento</label>
              <select class="form-control form-control-sm" name="nuevoEstablecimiento" id="nuevoEstablecimiento" disabled>
                <option value="<?= $establecimientos['id']?>"><?= $establecimientos['nombre_establecimiento']?></option>
              </select>
            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoConsultorio">Consultorio</label>
              <?php

              if ($consultorios == false) {

              ?>

                <input type="text" class="form-control form-control-sm" name="nuevoConsultorio" id="nuevoConsultorio" value="" readonly>

              <?php

              } else {

              ?>

                <input type="text" class="form-control form-control-sm" name="nuevoConsultorio" id="nuevoConsultorio" value="<?= $consultorios["nombre_consultorio"]?>" readonly>

              <?php

              }

              ?>       

            </div>             
            
          </div>

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoDepartamento">Departamento</label>
              <select class="form-control form-control-sm" name="nuevoDepartamento" id="nuevoDepartamento" disabled>
                <option value="<?= $departamentos['id']?>"><?= $departamentos["nombre_depto"]?></option>
              </select>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoLocalidad">Localidad</label>
              <select class="form-control form-control-sm" name="nuevoLocalidad" id="nuevoLocalidad" disabled>
                  <option value="<?= $localidades['id']?>"><?= $localidades["nombre_localidad"]?></option>
                </select>

            </div> 

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoFechaNotificacion">Fecha de Notificación</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaNotificacion" id="nuevoFechaNotificacion" value="<?= $ficha['fecha_notificacion'] ?>" readonly>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoNroControl">Control<span class="text-danger"> *</span></label>
              <input type="text" class="form-control form-control-sm col-md-6" name="nuevoNroControl" id="nuevoNroControl" value="<?= $ficha['nro_control'] ?>" readonly>

            </div>
            
          </div>
          
        </div>

      </div>

      <!--=============================================
      SECCION 2. IDENTIFICACION DEL CASO/PACIENTE
      =============================================--> 

      <?php

        $item = "id";
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

              <label class="m-0 font-weight-normal" for="nuevoCodAsegurado">Cod. Asegurado</label>
              <input type="text" class="form-control form-control-sm" id="nuevoCodAsegurado" name="nuevoCodAsegurado" value="<?= $pacienteAsegurado['cod_asegurado']?>" readonly>

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

              <label class="m-0 font-weight-normal" for="nuevoSexoPaciente">Sexo</label>
              <?php 

                if ($pacienteAsegurado['sexo'] == "F") {

                  echo '
                    <input class="form-control form-control-sm" name="nuevoSexoPaciente" id="nuevoSexoPaciente" value="FEMENINO" readonly>';
                  
                } else {
                  
                  echo '
                    <input class="form-control form-control-sm" name="nuevoSexoPaciente" id="nuevoSexoPaciente" value="MASCULINO" readonly>';

                }

              ?> 

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoNroDocumentoPaciente">Nro. Documento</label>
              <input class="form-control form-control-sm" name="nuevoNroDocumentoPaciente" id="nuevoNroDocumentoPaciente" value="<?= $pacienteAsegurado['nro_documento'] ?>" readonly>

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

              <label class="m-0 font-weight-normal" for="nuevoTelefonoPaciente">Teléfono</label>
              <input type="text" class="form-control form-control-sm" name="nuevoTelefonoPaciente" id="nuevoTelefonoPaciente" data-inputmask="'mask': '9{7,8}'" value="<?= $pacienteAsegurado['telefono'] ?>" readonly>

            </div>

            <div class="form-group col-md-5">

              <label class="m-0 font-weight-normal" for="nuevoEmailPaciente">Email</label>
              <input type="text" class="form-control form-control-sm" name="nuevoEmailPaciente" id="nuevoEmailPaciente" data-inputmask="'alias': 'email'" inputmode="email" value="<?= $pacienteAsegurado['email'] ?>" readonly>

            </div>

          </div>
          
        </div>

      </div>

      <!--=============================================
      SECCION 3. SEGUIMIENTO
      =============================================-->  

      <?php

        $item = "id";
        $valor = $_GET["idFicha"];

        $hospitalizaciones_aislamientos = ControladorHospitalizacionesAislamientos::ctrMostrarHospitalizacionesAislamientos($item, $valor);

      ?>  

      <div class="card mb-0">
        
        <div class="card-header bg-dark py-1 text-center">

          <span>3. SEGUIMIENTO</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">
            
            <div class="form-group col-md-5">

              <label class="m-0" for="nuevoDiasNotificacion">¿Han pasado 14 días desde la notificación?<span class="text-danger"> *</span></label>
              <input type="text" class="form-control form-control-sm col-md-4" name="nuevoDiasNotificacion" id="nuevoDiasNotificacion" value="<?= $hospitalizaciones_aislamientos['dias_notificacion'] ?>" readonly>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoDiasSinSintomas">N° de días SIN sintomas</label>
              <input type="number" class="form-control form-control-sm mayuscula" name="nuevoDiasSinSintomas" id="nuevoDiasSinSintomas" value="<?= $hospitalizaciones_aislamientos['dias_sin_sintomas'] ?>" readonly>

            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaAislamiento">Fecha de Aislamiento</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaAislamiento" id="nuevoFechaAislamiento" value="<?= $hospitalizaciones_aislamientos['fecha_aislamiento'] ?>" readonly>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoLugarAislamiento">Lugar de Aislamiento</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoLugarAislamiento" id="nuevoLugarAislamiento" value="<?= $hospitalizaciones_aislamientos['lugar_aislamiento'] ?>" readonly>

            </div>

            <div class="form-group col-md-2">
              
            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaInternacion">Fecha de Internación</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaInternacion" id="nuevoFechaInternacion" value="<?= $hospitalizaciones_aislamientos['fecha_internacion'] ?>" readonly>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoEstablecimientoInternacion">Establecimiento de salud de internación</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoEstablecimientoInternacion" id="nuevoEstablecimientoInternacion" value="<?= $hospitalizaciones_aislamientos['establecimiento_internacion'] ?>" readonly>

            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaIngresoUTI">Fecha de Ingreso a UTI</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaIngresoUTI" id="nuevoFechaIngresoUTI" value="<?= $hospitalizaciones_aislamientos['fecha_ingreso_UTI'] ?>" readonly>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoLugarIngresoUTI">Lugar de UTI</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoLugarIngresoUTI" id="nuevoLugarIngresoUTI" value="<?= $hospitalizaciones_aislamientos['lugar_ingreso_UTI'] ?>" readonly>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoVentilacionMecanica">Ventilación mecánica</label>
              <input type="text" class="form-control form-control-sm col-md-6" name="nuevoVentilacionMecanica" id="nuevoVentilacionMecanica" value="<?= $hospitalizaciones_aislamientos['ventilacion_mecanica'] ?>" readonly>
            
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

                  echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIVIRAL" id="nuevoAntiviral" checked disabled>';

                  break;

                } else {

                  $j++;

                  if ($j == count($tratamiento)) {

                    echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIVIRAL" id="nuevoAntiviral" disabled>';

                  }

                }

              }
            ?>
              <!-- <input type="checkbox" name="nuevoTratamiento" value="ANTIVIRAL" id="nuevoAntiviral"> -->
              <label class="font-weight-normal" for="nuevoAntiviral">Antiviral</label>

            </div>

            <div class="icheck-silver mr-5">

            <?php 
              $j = 0;
              for($i = 0; $i < count($tratamiento); $i++) {
                
                if ($tratamiento[$i] == "ANTIBIÓTICO") {

                  echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIBIÓTICO" id="nuevoAntibiotico" checked disabled>';

                  break;

                } else {

                  $j++;

                  if ($j == count($tratamiento)) {

                    echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIBIÓTICO" id="nuevoAntibiotico" disabled>';

                  }

                }

              }
            ?>
              <!-- <input type="checkbox" name="nuevoTratamiento" value="ANTIBIÓTICO" id="nuevoAntibiotico"> -->
              <label class="font-weight-normal" for="nuevoAntibiotico">Antibiótico</label>

            </div>

            <div class="icheck-silver mr-5">

            <?php 
              $j = 0;
              for($i = 0; $i < count($tratamiento); $i++) {
                
                if ($tratamiento[$i] == "ANTIPARASITARIO") {

                  echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIPARASITARIO" id="nuevoAntiparasitario" checked disabled>';

                  break;

                } else {

                  $j++;

                  if ($j == count($tratamiento)) {

                    echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIPARASITARIO" id="nuevoAntiparasitario" disabled>';

                  }

                }

              }
            ?>
              <!-- <input type="checkbox" name="nuevoTratamiento" value="ANTIPARASITARIO" id="nuevoAntiparasitario"> -->
              <label class="font-weight-normal" for="nuevoAntiparasitario">Antiparasitario</label>

            </div>

            <div class="icheck-silver mr-5">

            <?php 
              $j = 0;
              for($i = 0; $i < count($tratamiento); $i++) {
                
                if ($tratamiento[$i] == "ANTIFLAMATORIO") {

                  echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIFLAMATORIO" id="nuevoAntiflamatorio" checked disabled>';

                  break;

                } else {

                  $j++;

                  if ($j == count($tratamiento)) {

                    echo '<input type="checkbox" name="nuevoTratamiento" value="ANTIFLAMATORIO" id="nuevoAntiflamatorio" disabled>';

                  }

                }

              }
            ?>
              <!-- <input type="checkbox" name="nuevoTratamiento" value="ANTIFLAMATORIO" id="nuevoAntiflamatorio"> -->
              <label class="font-weight-normal" for="nuevoAntiflamatorio">Antiflamatorio</label>

            </div>

            <div class="form-inline col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoTratamientoOtros">Otros</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoTratamientoOtros" name="nuevoTratamientoOtros" value="<?= $hospitalizaciones_aislamientos['tratamiento_otros'] ?>" readonly> 

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

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoEstadoMuestra">Se tomó muestra para Laboratorio </label>
              <select class="form-control form-control-sm col-md-6" name="nuevoEstadoMuestra" id="nuevoEstadoMuestra" disabled>
              <?php 

                if ($laboratorios['estado_muestra'] == "SI") {

                  echo '
                  <option value="'.$laboratorios["estado_muestra"].'">'.$laboratorios["estado_muestra"].'</option>
                  <option value="NO">NO</option>';
                  
                } else if ($laboratorios['estado_muestra'] == "NO") {
                  
                  echo '
                  <option value="SI">SI</option>
                  <option value="'.$laboratorios["estado_muestra"].'">'.$laboratorios["estado_muestra"].'</option>';

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

              <label class="m-0 font-weight-normal" for="nuevoNoTomaMuestra">¿Por qué no se tomó la muestra?</label>
              <input list="noTomaMuestra" class="form-control form-control-sm mayuscula" id="nuevoNoTomaMuestra" name="nuevoNoTomaMuestra" value="<?= $laboratorios['no_toma_muestra'] ?>" readonly>

            </div>

            <div class="form-group col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoLugarMuestra">Lugar de toma de muestra</label>
              <select class="form-control form-control-sm" name="nuevoLugarMuestra" id="nuevoLugarMuestra" disabled>
                <option value="<?= $establecimientos['id'] ?>"><?= $establecimientos['nombre_establecimiento'] ?></option>
                <?php 

                  $item = null;
                  $valor = null;

                  $establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

                  foreach ($establecimientos as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_establecimiento"].'</option>';
                  } 

                ?>
              </select> 

            </div>

            <div class="form-group col-md-3">
            
              <label class="m-0" for="nuevoTipoMuestra">Tipo de muestra tomada</label> 
              <i class="fas fa-asterisk asterisk"></i>
              <select class="form-control form-control-sm select2_dinamic" id="nuevoTipoMuestra" name="nuevoTipoMuestra" data-dropdown-css-class="select2-info" style="width: 100%;">

                <option value="<?= $laboratorios['tipo_muestra'] ?>"><?= $laboratorios['tipo_muestra'] ?></option>
                <option value="ASPIRADO">ASPIRADO</option>
                <option value="ESPUTO">ESPUTO</option>
                <option value="LAVADO BRONCO ALVELAR">LAVADO BRONCO ALVELAR</option>
                <option value="HISOPADO NASOFARÍNGEO">HISOPADO NASOFARÍNGEO</option>
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

              <label class="m-0 font-weight-normal" for="nuevoFechaEnvio">Fecha de Envío</label>
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
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoObsMuestra" name="nuevoObsMuestra" value="<?= $laboratorios['observaciones_muestra'] ?>"> 

            </div>

          </div>    

        </div>

      </div>

      <div class="card mb-0">

        <div class="card-header bg-secondary py-1 text-center">

          <span>RESULTADO</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoCodLaboratorio">Cod. Laboratorio<i class="fas fa-asterisk asterisk"></i></label>
              <input type="text" class="form-control form-control-sm" name="nuevoCodLaboratorio" id="nuevoCodLaboratorio" value="<?= $laboratorios['cod_laboratorio'] ?>">

            </div>

            <div class="form-group col-md-2 offset-md-1">

              <label class="m-0" for="nuevoMetodoDiagnostico">Mètodo de Diagnostico<i class="fas fa-asterisk asterisk"></i></label>
              <select class="form-control form-control-sm select2" name="nuevoMetodoDiagnostico" id="nuevoMetodoDiagnostico" data-dropdown-css-class="select2-info" style="width: 100%;">
                <?php 

                  if ($laboratorios['metodo_diagnostico'] == "RT-PCR EN TIEMPO REAL") {

                    echo 
                      '<option value="'.$laboratorios['metodo_diagnostico'].'">'.$laboratorios['metodo_diagnostico'].'</option>
                      <option value="RT-PCR GENEXPERT">RT-PCR GENEXPERT</option>
                      <option value="PRUEBA ANTIGÈNICA">PRUEBA ANTIGÈNICA</option>';
                    
                  } else if ($laboratorios['metodo_diagnostico'] == "RT-PCR GENEXPERT") {
                    
                    echo 
                      '<option value="'.$laboratorios['metodo_diagnostico'].'">'.$laboratorios['metodo_diagnostico'].'</option>
                      <option value="RT-PCR EN TIEMPO REAL">RT-PCR EN TIEMPO REAL</option>
                      <option value="PRUEBA ANTIGÈNICA">PRUEBA ANTIGÈNICA</option>';

                  } else if ($laboratorios['metodo_diagnostico'] == "PRUEBA ANTIGÈNICA") {

                    echo 
                      '<option value="'.$laboratorios['metodo_diagnostico'].'">'.$laboratorios['metodo_diagnostico'].'</option>
                      <option value="RT-PCR EN TIEMPO REAL">RT-PCR EN TIEMPO REAL</option>
                      <option value="RT-PCR GENEXPERT">RT-PCR GENEXPERT</option>';

                  } else {

                    echo 
                      '<option value="">Elegir...</option>
                      <option value="RT-PCR EN TIEMPO REAL">RT-PCR EN TIEMPO REAL</option>
                      <option value="RT-PCR GENEXPERT">RT-PCR GENEXPERT</option>
                      <option value="PRUEBA ANTIGÈNICA">PRUEBA ANTIGÈNICA</option>';
                  }

                ?>   
              </select>

            </div>

            <div class="form-group col-md-2 offset-md-1">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoResultadoLaboratorio">Resultados Laboratorio<i class="fas fa-asterisk asterisk"></i></label>
            
              <?php

              if ($laboratorios['resultado_laboratorio'] == "POSITIVO") {

                echo'
                <div class="icheck-danger icheck">
                  <input type="radio" name="nuevoResultadoLaboratorio" id="positivo" value="POSITIVO" checked>
                  <label for="positivo">
                    POSITIVO
                  </label>
                </div>
                <div class="icheck-success icheck">
                  <input type="radio" name="nuevoResultadoLaboratorio" id="negativo" value="NEGATIVO">
                  <label for="negativo">
                    NEGATIVO
                  </label>
                </div>';    

              } else if ($laboratorios['resultado_laboratorio'] == "NEGATIVO") {

                echo '
                <div class="icheck-danger icheck">
                  <input type="radio" name="nuevoResultadoLaboratorio" id="positivo" value="POSITIVO">
                  <label for="positivo">
                    POSITIVO
                  </label>
                </div>
                <div class="icheck-success icheck">
                  <input type="radio" name="nuevoResultadoLaboratorio" id="negativo" value="NEGATIVO" checked>
                  <label for="negativo">
                    NEGATIVO
                  </label>
                </div>';    

              } else {

                echo '
                <div class="icheck-danger icheck">
                  <input type="radio" name="nuevoResultadoLaboratorio" id="positivo" value="POSITIVO">
                  <label for="positivo">
                    POSITIVO
                  </label>
                </div>
                <div class="icheck-success icheck">
                  <input type="radio" name="nuevoResultadoLaboratorio" id="negativo" value="NEGATIVO">
                  <label for="negativo">
                    NEGATIVO
                  </label>
                </div>'; 

              }

              ?>                     

            </div>

            <div class="form-group col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoFechaResultado">Fecha de Resultado<i class="fas fa-asterisk asterisk"></i></label>
              <input type="date" class="form-control form-control-sm" id="nuevoFechaResultado" name="nuevoFechaResultado" value="<?= $laboratorios['fecha_resultado'] ?>"> 

            </div>

          </div>        

        </div>

        <div class="card-footer">

          <div class="float-right">

            <input type="hidden" id="idFicha" value="<?= $_GET["idFicha"] ?>">
            <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $_SESSION['idUsuarioCOVID'] ?>">

            <button type="button" class="btn btn-primary btnGuardarLab">

              <i class="fas fa-save"></i>
              Guardar

            </button>

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

        <div class="card-body">

          <div class="form-row">
            
            <label class="my-0 mr-2 font-weight-normal">DATOS DEL PERSONAL QUE NOTIFICA:</label>

          </div>

          <div class="form-row">

            <div class="form-group col-md-2">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoPaternoNotif">Ap. Paterno</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoPaternoNotif" name="nuevoPaternoNotif" value="<?= $persona_notificador['paterno_notificador'] ?>" readonly> 

            </div>

            <div class="form-group col-md-2">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoMaternoNotif">Ap. Materno</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoMaternoNotif" name="nuevoMaternoNotif" value="<?= $persona_notificador['materno_notificador'] ?>" readonly> 

            </div>

            <div class="form-group col-md-3">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoNombreNotif">Ap. Nombre(s)</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoNombreNotif" name="nuevoNombreNotif" value="<?= $persona_notificador['nombre_notificador'] ?>" readonly> 

            </div>

            <div class="form-group col-md-2">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoTelefonoNotif">Tel. cel</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoTelefonoNotif" name="nuevoTelefonoNotif" data-inputmask="'mask': '9{7,8}'" value="<?= $persona_notificador['telefono_notificador'] ?>" readonly> 

            </div>

            <div class="form-group col-md-3">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoCargoNotif">Cargo</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoCargoNotif" name="nuevoCargoNotif" value="<?= $persona_notificador['cargo_notificador'] ?>" readonly> 

            </div>

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
            <span aria-hidden="true">×</span>
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

        <div id="tblAfiliadosSIAISFichas">   

                  
        </div>

      </div>

    </div>

  </div>

</div>
