<div class="content-wrapper">

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">

            FICHA EPIDEMIOLÓGICA Y SOLICITUD DE ESTUDIOS DE LABORATORIO COVID-19

          </h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></li>

            <li class="breadcrumb-item active">Nueva Ficha Epidemiológica COVID-19</li>

          </ol>

        </div>

      </div>

    </div>

  </div>
  
  <section class="content">

    <form id="fichaEpidemiologicaCentro">

      <div class="form-row">

        <div class="form-inline col-md-10">

          Todos los campos con <span class="text-danger mx-2 font-weight-bold"> * </span> son obligatorios

        </div>

      </div>

      <!--=============================================
      SECCION 1. DATOS DEL ESTABLECIMIENTO NOTIFICADOR
      =============================================--> 

      <?php

        $item = "id";
        $valor = $_GET["idFicha"];

        $ficha = ControladorFichas::ctrMostrarFichas($item, $valor);

        /*=============================================
        TRAEMOS LOS DATOS DE ESTABLECIMIENTO
        =============================================*/

        $valor = $ficha["id_establecimiento"];

        $establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

        /*=============================================
        TRAEMOS LOS DATOS DE CONSULTORIO
        =============================================*/

        $valor = $ficha["id_consultorio"];

        $consultorios = ControladorConsultorios::ctrMostrarConsultorios($item, $valor);

       /*=============================================
        TRAEMOS LOS DATOS DE DEPARTAMENTO
        =============================================*/
        
        $valor = $ficha["id_departamento"];

        $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

        /*=============================================
        TRAEMOS LOS DATOS DE LOCALIDAD
        =============================================*/

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

              <label class="m-0 font-weight-normal" for="nuevoEstablecimiento">Establecimiento de Salud<span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm" name="nuevoEstablecimiento" id="nuevoEstablecimiento">
                <option value="<?= $establecimientos['id']?>"><?= $establecimientos["nombre_establecimiento"]?></option>
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

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoCodEstablecimiento">Cod. Estab</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoCodEstablecimiento" id="nuevoCodEstablecimiento" value="<?= $ficha['cod_establecimiento'] ?>">

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoConsultorio">Consultorio</label>
              <select class="form-control form-control-sm" name="nuevoConsultorio" id="nuevoConsultorio" disabled>
                <option value="<?= $consultorios['id']?>"><?= $consultorios["nombre_consultorio"]?></option>
                <?php 

                  $item = null;
                  $valor = null;

                  $consultorios = ControladorConsultorios::ctrMostrarConsultorios($item, $valor);

                  foreach ($consultorios as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_consultorio"].'</option>';
                  } 

                ?>
              </select>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoRedSalud">Red de Salud<span class="text-danger font-weight-bold"> *</span></label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoRedSalud" id="nuevoRedSalud" value="<?= $ficha['red_salud'] ?>">

            </div>
            
          </div>

          <div class="form-row">

              <div class="form-group col-md-3">

                <label class="m-0 font-weight-normal" for="nuevoDepartamento">Departamento<span class="text-danger font-weight-bold"> *</span></label>
                <select class="form-control form-control-sm" name="nuevoDepartamento" id="nuevoDepartamento">
                  <option value="">Elegir...</option>
                  <?php 

                    $item = null;
                    $valor = null;

                    $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

                    foreach ($departamentos as $key => $value) {
                      
                      echo '<option value="'.$value["id"].'">'.$value["nombre_depto"].'</option>';
                    }
                     
                  ?>
                </select>

              </div>

              <div class="form-group col-md-3">

                <label class="m-0 font-weight-normal" for="nuevoLocalidad">Localidad<span class="text-danger font-weight-bold"> *</span></label>
                <select class="form-control form-control-sm" name="nuevoLocalidad" id="nuevoLocalidad" required>
                  <option value="">Elegir...</option>
                  <?php 

                    $item = null;
                    $valor = null;

                    $localidades = ControladorLocalidades::ctrMostrarLocalidades($item, $valor);

                    foreach ($localidades as $key => $value) {
                      
                      echo '<option value="'.$value["id"].'">'.$value["nombre_localidad"].'</option>';
                    } 
                  ?>
                </select>

              </div>

              <div class="form-group col-md-3">

                <label class="m-0 font-weight-normal" for="nuevoFechaNotificacion">Fecha de Notificación<span class="text-danger font-weight-bold"> *</span></label>
                <input type="date" class="form-control form-control-sm" name="nuevoFechaNotificacion" id="nuevoFechaNotificacion">

              </div>

              <div class="form-group col-md-2">

                <label class="m-0 font-weight-normal" for="nuevoSemEpidemiologica">Sem. Epidemiológica</label>
                <input type="number" class="form-control form-control-sm" name="nuevoSemEpidemiologica" id="nuevoSemEpidemiologica">

              </div>
            
          </div>

          <div class="form-row">
            
            <label class="m-0 font-weight-normal col-md-3" for="nuevoBusquedaActiva">Caso identificado por búsqueda activa<span class="text-danger font-weight-bold"> *</span></label> 
            <select class="form-control form-control-sm col-md-2" name="nuevoBusquedaActiva" id="nuevoBusquedaActiva">
              <option value="">Elegir...</option>
              <option value="SI">SI</option>
              <option value="NO">NO</option>
            </select>

          </div>
          
        </div>

       <!--  <div class="card-footer">
          
          <div class="float-right">

            <input type="hidden" id="idFicha" value="<?= $_GET["idFicha"] ?>">

            <button type="button" class="btn btn-primary btnGuardar">

              <i class="fas fa-save"></i>
              Guardar

            </button>

          </div>

        </div> -->

      </div>

      <!--=============================================
      SECCION 2. IDENTIFICACION DEL CASO/PACIENTE
      =============================================--> 

      <div class="card mb-0">
        
        <div class="card-header bg-dark py-1 text-center">

          <span>2. IDENTIFICACION DEL CASO/PACIENTE</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">
            
            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoCodAsegurado">Cod. Asegurado<span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm" id="nuevoCodAsegurado" name="nuevoCodAsegurado" data-toggle="modal" data-target="#modalCodAsegurado" data-dismiss="modal">

                <option value="">Seleccione Asegurado</option>

              </select>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoCodAfiliado">Cod. Afiliado</label>
              <input type="text" class="form-control form-control-sm" name="nuevoCodAfiliado" id="nuevoCodAfiliado" readonly>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoCodEmpleador">Cod. Empleador</label>
              <input type="text" class="form-control form-control-sm" name="nuevoCodEmpleador" id="nuevoCodEmpleador" readonly>

            </div>

            <div class="form-group col-md-6">

              <label class="m-0 font-weight-normal" for="nuevoNombreEmpleador">Nombre Empleador(s)</label>
              <input type="text" class="form-control form-control-sm" name="nuevoNombreEmpleador" id="nuevoNombreEmpleador" readonly>

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoPaternoPaciente">Ap. Paterno</label>
              <input type="text" class="form-control form-control-sm" name="nuevoPaternoPaciente" id="nuevoPaternoPaciente" readonly>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoMaternoPaciente">Ap. Materno</label>
              <input type="text" class="form-control form-control-sm" name="nuevoMaternoPaciente" id="nuevoMaternoPaciente" readonly>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoNombrePaciente">Nombre(s)</label>
              <input type="text" class="form-control form-control-sm" name="nuevoNombrePaciente" id="nuevoNombrePaciente" readonly>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoSexoPaciente">Sexo<span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm" name="nuevoSexoPaciente" id="nuevoSexoPaciente">
                <option value="">Elegir...</option>
                <option value="F">FEMENINO</option>
                <option value="M">MASCULINO</option>
              </select>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoNroDocumentoPaciente">Nro. Documento<span class="text-danger font-weight-bold"> *</span></label>
              <input class="form-control form-control-sm" name="nuevoNroDocumentoPaciente" id="nuevoNroDocumentoPaciente">

            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoFechaNacPaciente">Fecha de Nacimiento</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaNacPaciente" id="nuevoFechaNacPaciente" readonly>

            </div>

            <div class="form-group col-md-1">

              <label class="m-0 font-weight-normal" for="nuevoEdadPaciente">Edad</label>
              <input type="text" class="form-control form-control-sm" name="nuevoEdadPaciente" id="nuevoEdadPaciente" readonly>

            </div>

            <div class="form-group col-md-4">

              <label class="m-0 font-weight-normal" for="nuevoDepartamentoPaciente">Lugar de residencia, Departamento<span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm" name="nuevoDepartamentoPaciente" id="nuevoDepartamentoPaciente">
                <option value="">Elegir...</option>
                <?php 

                  $item = null;
                  $valor = null;

                  $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

                  foreach ($departamentos as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_depto"].'</option>';
                  }
                   
                ?>
              </select>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoLocalidadPaciente">Localidad<span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm" name="nuevoLocalidadPaciente" id="nuevoLocalidadPaciente">
                <option value="">Elegir...</option>
                <?php 

                  $item = null;
                  $valor = null;

                  $localidades = ControladorLocalidades::ctrMostrarLocalidades($item, $valor);

                  foreach ($localidades as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_localidad"].'</option>';
                  } 
                ?>
              </select>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoPaisPaciente">País<span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm" name="nuevoPaisPaciente" id="nuevoPaisPaciente">
                <option value="">Elegir...</option>
                <?php 

                  $item = null;
                  $valor = null;

                  $paises = ControladorPaises::ctrMostrarPaises($item, $valor);

                  foreach ($paises as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre_pais"].'</option>';
                  } 
                ?>
              </select>

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoZonaPaciente">Zona</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoZonaPaciente" id="nuevoZonaPaciente">

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoCallePaciente">Calle</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoCallePaciente" id="nuevoCallePaciente">

            </div>

            <div class="form-group col-md-1">

              <label class="m-0 font-weight-normal" for="nuevoNroCallePaciente">Nro. Calle</label>
              <input type="number" class="form-control form-control-sm mayuscula" name="nuevoNroCallePaciente" id="nuevoNroCallePaciente">

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoTelefonoPaciente">Teléfono</label>
              <input type="text" class="form-control form-control-sm" name="nuevoTelefonoPaciente" id="nuevoTelefonoPaciente" data-inputmask="'mask': '9{7,8}'">

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-inline col-md-12">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoNombreApoderado">Si es menor de edad Nombre del Padre/Madre o apoderado</label>
              <input type="text" class="form-control form-control-sm col-md-4 mr-2 mayuscula" name="nuevoNombreApoderado" id="nuevoNombreApoderado">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoTelefonoApoderado">Teléfono Apoderado</label>
              <input type="text" class="form-control form-control-sm" name="nuevoTelefonoApoderado" id="nuevoTelefonoApoderado" data-inputmask="'mask': '9{7,8}'">

            </div>

          </div>
          
        </div>

        <!-- <div class="card-footer">
            
          <div class="float-right">

            <button type="button" class="btn btn-primary btnGuardar" disabled>

              <i class="fas fa-save"></i>
              Guardar

            </button>

          </div>

        </div> -->

      </div>

      <!--=============================================
      SECCION 3. ANTECEDENTES EPIDEMIOLOGICOS
      =============================================-->  

      <div class="card mb-0">
        
        <div class="card-header bg-dark py-1 text-center">

          <span>3. ANTECEDENTES EPIDEMIOLOGICOS</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">

            <div class="form-group col-md-3">
            
              <label class="m-0 font-weight-normal col-md-5" for="nuevoAntOcupacion">Ocupación<span class="text-danger font-weight-bold"> *</span></label> 
              <input list="ocupacion" class="form-control form-control-sm mayuscula" id="nuevoAntOcupacion" name="nuevoAntOcupacion" required>
              <datalist id="ocupacion">
                <option value="PERSONAL DE SALUD"></option>
                <option value="PERSONAL DE LABORATORIO"></option>
              </datalist>           

            </div>

            <div class="form-group col-md-4">

              <label class="m-0 font-weight-normal" for="nuevoAntVacunaInfluenza">Antecedentes de vacunación para influenza<span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm col-md-5" name="nuevoAntVacunaInfluenza" id="nuevoAntVacunaInfluenza" required>
                <option value="">Elegir...</option>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
              </select>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaVacunaInfluenza">Fecha de Vacunación</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaVacunaInfluenza" id="nuevoFechaVacunaInfluenza" readonly>

            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-5">

              <label class="m-0" for="nuevoViajeRiesgo">¿Tuvo un viaje a un lugar de riesgo dentro o fuera del pais?<span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm col-md-4" name="nuevoViajeRiesgo" id="nuevoViajeRiesgo" required>
                  <option value="">Elegir...</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
              </select>

            </div>

            <div class="form-group col-md-4">

              <label class="m-0 font-weight-normal" for="nuevoPaisCiudadRiesgo">¿Dondé (país y ciudad)?</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoPaisCiudadRiesgo" id="nuevoPaisCiudadRiesgo" readonly>

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoFechaRetorno">Fecha de retorno de Viaje</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaRetorno" id="nuevoFechaRetorno" placeholder="dd-mm-yyyy" value="" min="1997-01-01" max="2030-12-31" readonly>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoEmpresaVuelo">Empresa</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoEmpresaVuelo" id="nuevoEmpresaVuelo" readonly>

            </div>

            <div class="form-group col-md-1">

              <label class="m-0 font-weight-normal" for="nuevoNroVuelo">N° vuelo</label>
              <input type="text" class="form-control form-control-sm" name="nuevoNroVuelo" id="nuevoNroVuelo" readonly>

            </div>

            <div class="form-group col-md-1">

              <label class="m-0 font-weight-normal" for="nuevoNroAsiento">N° Asiento</label>
              <input type="text" class="form-control form-control-sm" name="nuevoNroAsiento" id="nuevoNroAsiento" readonly>

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-8">

              <label class="m-0" for="nuevoContactoCovid">¿Tuvo contacto con un caso confirmado de COVID-19 en los 14 días previos al inicio de sintomas, en domicilio o establecimiento de salud?<span class="text-danger"> *</span></label>
              <select class="form-control form-control-sm col-md-4" name="nuevoContactoCovid" id="nuevoContactoCovid" required>
                  <option value="">Elegir...</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
              </select>

            </div>

            <div class="form-group col-md-2 pt-4">

              <label class="m-0 font-weight-normal" for="nuevoFechaContactoCovid">Fecha de Contacto</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaContactoCovid" id="nuevoFechaContactoCovid" readonly>

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-5">

              <label class="m-0 font-weight-normal" for="nuevoNombreContactoCovid">Nombre y Apellido (del caso positivo)</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoNombreContactoCovid" id="nuevoNombreContactoCovid" placeholder="APELLIDOS Y NOMBRE(S)" readonly>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoTelefonoContactoCovid">Teléfono (del caso positivo)</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoTelefonoContactoCovid" id="nuevoTelefonoContactoCovid" data-inputmask="'mask': '9{7,8}'" readonly>

            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-12 m-0">
            
              <label class="m-0 ">Lugar de contacto con el caso positivo:</label>

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-2">
            
              <label class="m-0 font-weight-normal" for="nuevoPaisContactoCovid">País</label> 
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoPaisContactoCovid" name="nuevoPaisContactoCovid" readonly>       

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoDepartamentoContactoCovid">Departamento/Estado</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoDepartamentoContactoCovid" id="nuevoDepartamentoContactoCovid" readonly>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoLocalidadContactoCovid">Localidad</label>
               <input type="text" class="form-control form-control-sm mayuscula" name="nuevoLocalidadContactoCovid" id="nuevoLocalidadContactoCovid" readonly>

            </div>

          </div>
          
        </div>

        <!-- <div class="card-footer">
            
          <div class="float-right">

            <button type="button" class="btn btn-primary btnGuardar" disabled>

              <i class="fas fa-save"></i>
              Guardar

            </button>

          </div>

        </div> -->

      </div>

      <!--=============================================
      SECCION 4. DATOS CLINICOS
      =============================================-->   

      <div class="card mb-0">
        
        <div class="card-header bg-dark py-1 text-center">

          <span>4. DATOS CLINICOS</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">

            <div class="form-inline col-md-4">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoFechaInicioSintomas">Fecha de inicio de síntomas<span class="text-danger font-weight-bold"> *</span></label>
              <input type="date" class="form-control form-control-sm" id="nuevoFechaInicioSintomas" name="nuevoFechaInicioSintomas" placeholder="dd-mm-yyyy" value="" max="2030-12-31"> 

            </div>

          </div>

          <div class="form-row">
            
            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoMalestares" value="TOS SECA" id="nuevoMalestaresTos">
              <label class="font-weight-normal" for="nuevoMalestaresTos">Tos seca</label>

            </div>

            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoMalestares" value="FIEBRE" id="nuevoMalestaresFiebre">
              <label class="font-weight-normal" for="nuevoMalestaresFiebre">Fiebre</label>

            </div>

            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoMalestares" value="MALESTAR GENERAL" id="nuevoMalestaresGeneral">
              <label class="font-weight-normal" for="nuevoMalestaresGeneral">Malestar General</label>

            </div>

            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoMalestares" value="CEFALEA" id="nuevoMalestaresCefalea">
              <label class="font-weight-normal" for="nuevoMalestaresCefalea">Cefalea</label>

            </div>

            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoMalestares" value="DIFICULTAD RESPIRATORIA" id="nuevoMalestaresDifRespiratoria">
              <label class="font-weight-normal" for="nuevoMalestaresDifRespiratoria">Dificultad Respiratoria</label>

            </div>

            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoMalestares" value="MIALGIAS" id="nuevoMalestaresMialgias">
              <label class="font-weight-normal" for="nuevoMalestaresMialgias">Mialgias</label>

            </div>

            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoMalestares" value="DOLOR DE GARGANTA" id="nuevoMalestaresDolorGaraganta">
              <label class="font-weight-normal" for="nuevoMalestaresDolorGaraganta">Dolor de garganta</label>

            </div>

            <div class="icheck-silver mr-4">

              <input type="checkbox" name="nuevoMalestares" value="PÉRDIDA O DISMINUCIÓN DEL SENTIDO DEL OLFATO" id="nuevoMalestaresPerdOlfato">
              <label class="font-weight-normal" for="nuevoMalestaresPerdOlfato">Pérdida y/o disminución del sentido del olfato</label>

            </div>

            <div class="icheck-silver mr-4">

              <input type="checkbox" name="nuevoMalestares" value="PÉRDIDA O DISMINUCIÓN DEL SENTIDO DEL GUSTO" id="nuevoMalestaresPerdGusto">
              <label class="font-weight-normal" for="nuevoMalestaresPerdGusto">Pérdida y/o disminución del sentido del gusto</label>

            </div>

            <div class="icheck-silver mr-4">

              <input type="checkbox" name="nuevoMalestares" value="ASINTOMÁTICO" id="nuevoMalestaresAsintomatico">
              <label class="font-weight-normal" for="nuevoMalestaresAsintomatico">Asintomático</label>

            </div>

            <div class="form-inline col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoMalestaresOtros">Otros</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoMalestaresOtros" name="nuevoMalestaresOtros"> 

            </div>

          </div>  

          <div class="form-row">
            
            <div class="form-group col-md-6">

              <label class="m-0" for="nuevoEstadoPaciente">Estado actual del paciente (al momento del reporte)<span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm col-md-4" name="nuevoEstadoPaciente" id="nuevoEstadoPaciente">
                  <option value="">Elegir...</option>
                  <option value="LEVE">LEVE</option>
                  <option value="GRAVE">GRAVE</option>
                  <option value="FALLECIDO">FALLECIDO</option>
              </select>

            </div>

            <div class="form-inline col-md-4 pt-2">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoFechaDefuncion">Fecha de defunción</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaDefuncion" id="nuevoFechaDefuncion" readonly="">

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-2">
            
              <label class="m-0" for="nuevoDiagnosticoClinico">Diagnostico clínico<span class="text-danger font-weight-bold"> *</span></label> 
              <input list="diagnosticoClinico" class="form-control form-control-sm mayuscula" id="nuevoDiagnosticoClinico" name="nuevoDiagnosticoClinico">
              <datalist id="diagnosticoClinico">
                <option value="IRA"></option>
                <option value="IRAG"></option>
                <option value="NEUMONIA"></option>
              </datalist>           

            </div>

          </div>
          
        </div>

        <!-- <div class="card-footer">
              
          <div class="float-right">

            <button type="button" class="btn btn-primary btnGuardar" disabled>

              <i class="fas fa-save"></i>
              Guardar

            </button>

          </div>

        </div> -->

      </div>

      <!--=============================================
      SECCION 5. DATOS EN CASO DE HOSPITALIZACIÓN Y/O AISLAMIENTO
      =============================================--> 

      <div class="card mb-0">
        
        <div class="card-header bg-dark py-1 text-center">

          <span>5. DATOS EN CASO DE HOSPITALIZACIÓN Y/O AISLAMIENTO</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaAislamiento">Fecha de Aislamiento</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaAislamiento" id="nuevoFechaAislamiento">

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoLugarAislamiento">Lugar de Aislamiento</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoLugarAislamiento" id="nuevoLugarAislamiento">

            </div>

            <div class="form-group col-md-2">
              
            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaInternacion">Fecha de Internación</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaInternacion" id="nuevoFechaInternacion">

            </div>

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoEstablecimientoInternacion">Establecimiento de salud de internación</label>
              <input type="text" class="form-control form-control-sm mayuscula" name="nuevoEstablecimientoInternacion" id="nuevoEstablecimientoInternacion">

            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="m-0" for="nuevoVentilacionMecanica">Ventilación mecánica<span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm col-md-6" name="nuevoVentilacionMecanica" id="nuevoVentilacionMecanica">
                  <option value="">Elegir...</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
              </select>

            </div>

            <div class="form-group col-md-3">

              <label class="m-0" for="nuevoTerapiaIntensiva">Terapia intensiva<span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm col-md-6" name="nuevoTerapiaIntensiva" id="nuevoTerapiaIntensiva">
                  <option value="">Elegir...</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
              </select>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaIngresoUTI">Fecha de Ingreso a UTI</label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaIngresoUTI" id="nuevoFechaIngresoUTI" placeholder="dd-mm-yyyy" value="" max="2030-12-31">

            </div>

          </div>
          
        </div>

        <!-- <div class="card-footer">
                
          <div class="float-right">

            <button type="button" class="btn btn-primary btnGuardar" disabled>

              <i class="fas fa-save"></i>
              Guardar

            </button>

          </div>

        </div> -->

      </div>

      <!--=============================================
      SECCION 6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO
      =============================================--> 

      <div class="card mb-0">
        
        <div class="card-header bg-dark py-1 text-center">

          <span>6. ENFERMEDADES DE BASE O CONDICIONES DE RIESGO</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">

            <label class="my-0 mr-2 font-weight-normal" for="enfEstado"><span class="text-danger font-weight-bold"> *</span></label>
            
            <div class="icheck-silver icheck-inline">
              <input type="radio" id="presenta" name="enfEstado" value="PRESENTA">
              <label for="presenta">Presenta</label>
            </div>

            <div class="icheck-silver icheck-inline">
              <input type="radio" id="noPresenta" name="enfEstado" value="NO PRESENTA">
              <label for="noPresenta">No presenta</label>
            </div>

          </div>

          <div class="form-row">
            
            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoEnfRiesgo" value="HIPERTENSIÓN ARTERIAL" id="nuevoHipertensionArterial" disabled>
              <label class="font-weight-normal" for="nuevoHipertensionArterial">Hipertensión Arterial</label>

            </div>

            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoEnfRiesgo" value="OBESIDAD" id="nuevoObesidad"  disabled>
              <label class="font-weight-normal" for="nuevoObesidad">Obesidad</label>

            </div>

            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoEnfRiesgo" value="DIABETES GENERAL" id="nuevoDiabetes" disabled>
              <label class="font-weight-normal" for="nuevoDiabetes">Diabetes General</label>

            </div>

            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoEnfRiesgo" value="EMBARAZO" id="nuevoEmbarazo" disabled>
              <label class="font-weight-normal" for="nuevoEmbarazo">Embarazo</label>

            </div>

            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoEnfRiesgo" value="ENFERMEDADES CARDIACA" id="nuevoEnfCardiaca" disabled>
              <label class="font-weight-normal" for="nuevoEnfCardiaca">Enfermedades cardiaca</label>

            </div>

            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoEnfRiesgo" value="ENFERMEDAD RESPIRATORIA" id="nuevoEnfRespiratoria" disabled>
              <label class="font-weight-normal" for="nuevoEnfRespiratoria">Enfermedad respiratoria</label>

            </div>

            <div class="icheck-silver mr-5">

              <input type="checkbox" name="nuevoEnfRiesgo" value="ENFERMEDADES RENAL CRÓNICA" id="nuevoEnfRenalCronica" disabled>
              <label class="font-weight-normal" for="nuevoEnfRenalCronica">Enfermedades Renal Crónica</label>

            </div>

            <div class="form-inline col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoEnfRiesgoOtros">Otros</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoEnfRiesgoOtros" name="nuevoEnfRiesgoOtros" readonly> 

            </div>

          </div>        
          
        </div>

        <!-- <div class="card-footer">
                  
          <div class="float-right">

            <button type="button" class="btn btn-primary btnGuardar" disabled>

              <i class="fas fa-save"></i>
              Guardar

            </button>

          </div>

        </div> -->

      </div>

      <!--=============================================
      SECCION 7. DATOS DE PERSONAS CON LAS QUE EL CASO SOSPECHOSO ESTUVO EN CONTACTO
      =============================================--> 

      <div class="card mb-0">
        
        <div class="card-header bg-dark py-1 text-center">

          <span>7. DATOS DE PERSONAS CON LAS QUE EL CASO SOSPECHOSO ESTUVO EN CONTACTO (desde el inicio de los sintomas)</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">
            
            <button class="btn btn-primary mb-2" id="btnAgregarPersonaContacto" data-toggle="modal" data-target="#modalNuevoPersonaContacto">

              <i class="fas fa-plus"></i>
              Agregar

            </button>

          </div>  

          <div class="form-row table-responsive">

            <table class="table table-bordered table-hover" id="tablaPersonasContactos">
              
              <thead>

                <tr>
                  <th width="400px">NOMBRES Y APELLIDOS</th>
                  <th width="250px">RELACIÓN</th>
                  <th width="100px">EDAD</th>
                  <th width="200px">TELEFÓNO</th>
                  <th width="250px">DIRECCIÓN</th>
                  <th width="200px">FECHA CONTACTO</th>
                  <th width="250px">LUGAR DE CONTACTO</th>
                  <th></th>
                </tr>

              </thead>

              <tbody>

                <tr>
        
                </tr>

              </tbody>

            </table>

          </div> 
          
        </div>

      </div>

      <!--=============================================
      SECCION 8. LABORATORIO
      =============================================-->  

      <div class="card mb-0 fichaEpidemiologicaLaboratorio">
        
        <div class="card-header bg-dark py-1 text-center">

          <span>8. LABORATORIO</span>
          
        </div>

        <div class="card-body">

          <div class="form-row">

            <div class="form-group col-md-3">

              <label class="m-0 font-weight-normal" for="nuevoEstadoMuestra">Se tomó muestra para Laboratorio <span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm col-md-6" name="nuevoEstadoMuestra" id="nuevoEstadoMuestra" readonly>
                  <option value="">Elegir...</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
              </select>

            </div>

            <div class="form-group col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoLugarMuestra">Lugar de toma de muestra<span class="text-danger font-weight-bold"> *</span></label>
              <select class="form-control form-control-sm" name="nuevoLugarMuestra" id="nuevoLugarMuestra" readonly>
                <option value="">Elegir...</option>
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
            
              <label class="m-0" for="nuevoTipoMuestra">Tipo de muestra tomada<span class="text-danger font-weight-bold"> *</span></label> 
              <input list="tipoMuestra" class="form-control form-control-sm mayuscula" id="nuevoTipoMuestra" name="nuevoTipoMuestra" readonly>
              <datalist id="tipoMuestra">
                <option value="ASPIRADO"></option>
                <option value="LAVADO BRONCO ALVELAR"></option>
                <option value="HISOPADO NASOFARÍNGEO"></option>
                <option value="HISOPADO COMBINADO"></option>
              </datalist>           

            </div>

            <div class="form-group col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoNombreLaboratorio">Nombre de Lab. que procesara la muestra</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoNombreLaboratorio" name="nuevoNombreLaboratorio" readonly> 

            </div>
            
          </div>

          <div class="form-row">

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaMuestra">Fecha de toma de muestra<span class="text-danger font-weight-bold"> *</span></label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaMuestra" id="nuevoFechaMuestra" readonly>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoFechaEnvio">Fecha de Envío<span class="text-danger"> *</span></label>
              <input type="date" class="form-control form-control-sm" name="nuevoFechaEnvio" id="nuevoFechaEnvio" readonly>

            </div>

            <div class="form-group col-md-2">

              <label class="m-0 font-weight-normal" for="nuevoCodLaboratorio">Cod. Laboratorio<span class="text-danger font-weight-bold"> *</span></label>
              <input type="text" class="form-control form-control-sm" name="nuevoCodLaboratorio" id="nuevoCodLaboratorio" readonly>

            </div>

            <div class="form-group col-md-4">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoResponsableMuestra">Responsable de Toma de Muestra<span class="text-danger font-weight-bold"> *</span></label>

              <input type="text" class="form-control form-control-sm mayudcula" name="nuevoResponsableMuestra" id="nuevoResponsableMuestra" readonly>

              <!-- <select class="form-control form-control-sm" name="nuevoResponsableMuestra" id="nuevoResponsableMuestra">
              <option value="">Elegir...</option>
              <?php 

                // $item = null;
                // $valor = null;

                // $paises = ControladorResponsablesMuestras::ctrMostrarResponsablesMuestras($item, $valor);

                // foreach ($paises as $key => $value) {
                  
                //   echo '<option value="'.$value["id"].'">'.$value["paterno_responsable"].' '.$value["materno_responsable"].' '.$value["nombre_responsable"].'</option>';
                // } 
              ?>
              </select> -->

            </div>

          </div>

          <div class="form-row">
            
            <div class="form-group col-md-12">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoObsMuestra">Observaciones</label>
              <input type="text" class="form-control form-control-sm" id="nuevoObsMuestra" name="nuevoObsMuestra" readonly> 

            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-4">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoResultadoLaboratorio">Resultados Laboratorio<span class="text-danger font-weight-bold"> *</span></label>
            
              <div class="icheck-danger icheck-inline">
                <input type="radio" name="nuevoResultadoLaboratorio" id="positivo" value="POSITIVO" disabled>
                <label for="positivo">
                  POSITIVO
                </label>
              </div>
              <div class="icheck-success icheck-inline">
                <input type="radio" name="nuevoResultadoLaboratorio" id="negativo" value="NEGATIVO" disabled>
                <label for="negativo">
                  NEGATIVO
                </label>
              </div>        

            </div>

            <div class="form-group col-md-3">

              <label class="my-0 mr-2 font-weight-normal" for="nuevoFechaResultado">Fecha de Resultado<span class="text-danger font-weight-bold"> *</span></label>
              <input type="date" class="form-control form-control-sm" id="nuevoFechaResultado" name="nuevoFechaResultado" readonly> 

            </div>

          </div>        

        </div>

        <!-- <div class="card-footer">

          <div class="float-right">

            <button type="button" class="btn btn-primary btnGuardar" disabled>

              <i class="fas fa-save"></i>
              Guardar

            </button>

          </div>
          
        </div> -->

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

            <!-- <div class="form-group col-md-2">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoPaternoNotif">Ap. Paterno</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoPaternoNotif" name="nuevoPaternoNotif"> 

            </div>

            <div class="form-group col-md-2">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoMaternoNotif">Ap. Materno</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoMaternoNotif" name="nuevoMaternoNotif"> 

            </div>

            <div class="form-group col-md-3">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoNombreNotif">Ap. Nombre(s)<span class="text-danger font-weight-bold"> *</span></label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoNombreNotif" name="nuevoNombreNotif"> 

            </div>

            <div class="form-group col-md-2">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoTelefonoNotif">Tel. cel</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoTelefonoNotif" name="nuevoTelefonoNotif" data-inputmask="'mask': '9{7,8}'"> 

            </div>

            <div class="form-group col-md-3">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoCargoNotif">Cargo</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoCargoNotif" name="nuevoCargoNotif"> 

            </div> -->

            <div class="form-group col-md-2">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoPaternoNotif">Ap. Paterno</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoPaternoNotif" name="nuevoPaternoNotif" value="<?= $persona_notificador['paterno_notificador'] ?>"> 

            </div>

            <div class="form-group col-md-2">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoMaternoNotif">Ap. Materno</label>
              <input type="text" class="form-control form-control-sm mayuscula" id="nuevoMaternoNotif" name="nuevoMaternoNotif" value="<?= $persona_notificador['materno_notificador'] ?>">

            </div>

            <div class="form-group col-md-3">
            
              <label class="my-0 mr-2 font-weight-normal" for="nuevoNombreNotif">Ap. Nombre(s)<span class="text-danger font-weight-bold"> *</span></label>
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

        <div id="tblAfiliadosSIAISFichas" class="mt-4">   

                  
        </div>

      </div>

    </div>

  </div>

</div>


<!--=====================================
MODAL AGREGAR NUEVA PERSONA CONTACTO
======================================-->

<div id="modalNuevoPersonaContacto" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="agregarPersonaContacto" aria-hidden="true">

  <div class="modal-dialog modal-lg" role="document">

    <form id="nuevoPersonaContacto"> 

      <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-gradient-info">

          <h5 class="modal-title" id="agregarPersonaContacto">Agrega Nueva Persona</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="form-row">

            Campos Obligatorios<h5 class="text-danger"> *</h5>
            
          </div>
          
          <div class="form-row">

            <!-- ENTRADA PARA EL APELLIDO PATERNO -->
            
            <div class="form-group col-md-4">
              
              <label  for="nuevoPaternoContacto">Apellido Paterno</label>
              <input type="text" class="form-control mayuscula" id="nuevoPaternoContacto" name="nuevoPaternoContacto">

            </div>

            <!-- ENTRADA PARA EL APELLIDO MATERNO -->
          
            <div class="form-group col-md-4">
            
              <label for="nuevoMaternoContacto">Apellido Materno</label>
              <input type="text" class="form-control mayuscula" id="nuevoMaternoContacto" name="nuevoMaternoContacto">

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
          
            <div class="form-group col-md-4">
              
              <label for="nuevoNombreContacto">Nombre(s)<span class="text-danger"> *</span></label>
              <input type="text" class="form-control mayuscula" id="nuevoNombreContacto" name="nuevoNombreContacto">

            </div>

          </div>
          
          <div class="form-row">

            <!-- ENTRADA PARA LA RELACIÓN -->
            
            <div class="form-group col-md-4">
              
              <label for="nuevoRelacionContacto">Relación<span class="text-danger"> *</span></label>
              <input type="text" class="form-control mayuscula" id="nuevoRelacionContacto" name="nuevoRelacionContacto">

            </div>

            <!-- ENTRADA PARA LA EDAD -->
            
            <div class="form-group col-md-2">
              
              <label for="nuevoEdadContacto">Edad</label>
              <input type="number" class="form-control" id="nuevoEdadContacto" name="nuevoEdadContacto">

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group col-md-4">
              
              <label for="nuevoTelefonoContacto">Teléfono</label>
              <input type="text" class="form-control" id="nuevoTelefonoContacto" name="nuevoTelefonoContacto" data-inputmask="'mask': '9{7,8}'">

            </div>

          </div>  

          <div class="form-row">

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group col-md-4">
              
              <label for="nuevaDireccionContacto">Dirección</label>
              <input type="text" class="form-control mayuscula" id="nuevaDireccionContacto" name="nuevaDireccionContacto">

            </div>

            <!-- ENTRADA PARA LA FECHA CONTACTO -->
            
            <div class="form-group col-md-3">
              
              <label for="nuevoFechaContacto">Fecha Contacto<span class="text-danger"> *</span></label>
              <input type="date" class="form-control" id="nuevoFechaContacto" name="nuevoFechaContacto">

            </div>

            <!-- ENTRADA PARA EL LUGAR CONTACTO -->
            
            <div class="form-group col-md-4">
              
              <label for="nuevoLugarContacto">Lugar de Contacto</label>
              <input type="text" class="form-control mayuscula" id="nuevoLugarContacto" name="nuevoLugarContacto">

            </div>

          </div>  

        </div>

       <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-primary" id="guardarPersonaContacto">

            <i class="fas fa-save"></i>
            Agregar Persona

          </button>

        </div>

      </div>

    </form>

  </div>

</div>

<!--=====================================
MODAL EDITAR  PERSONA CONTACTO
======================================-->

<div id="modalEditarPersonaContacto" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editarPersonaContacto" aria-hidden="true">

  <div class="modal-dialog modal-lg" role="document">

    <form id="guardarEditarPersonaContacto">

      <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-gradient-info">

          <h5 class="modal-title" id="editarPersonaContacto">Editar Persona</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="form-row">

            Campos Obligatorios<h5 class="text-danger"> *</h5>
            
          </div>
          
          <div class="form-row">

            <!-- ENTRADA PARA EL APELLIDO PATERNO -->
            
            <div class="form-group col-md-4">
              
              <label  for="editarPaternoContacto">Apellido Paterno</label>
              <input type="text" class="form-control mayuscula" id="editarPaternoContacto" name="editarPaternoContacto">

            </div>

            <!-- ENTRADA PARA EL APELLIDO MATERNO -->
          
            <div class="form-group col-md-4">
            
              <label for="editarMaternoContacto">Apellido Materno</label>
              <input type="text" class="form-control mayuscula" id="editarMaternoContacto" name="editarMaternoContacto">

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
          
            <div class="form-group col-md-4">
              
              <label for="editarNombreContacto">Nombre(s)<span class="text-danger"> *</span></label>
              <input type="text" class="form-control mayuscula" id="editarNombreContacto" name="editarNombreContacto">

            </div>

          </div>
          
          <div class="form-row">

            <!-- ENTRADA PARA LA RELACIÓN -->
            
            <div class="form-group col-md-4">
              
              <label for="editarRelacionContacto">Relación<span class="text-danger"> *</span></label>
              <input type="text" class="form-control mayuscula" id="editarRelacionContacto" name="editarRelacionContacto">

            </div>

            <!-- ENTRADA PARA LA EDAD -->
            
            <div class="form-group col-md-2">
              
              <label for="editarEdadContacto">Edad</label>
              <input type="number" class="form-control" id="editarEdadContacto" name="editarEdadContacto">

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group col-md-4">
              
              <label for="editarTelefonoContacto">Teléfono</label>
              <input type="text" class="form-control" id="editarTelefonoContacto" name="editarTelefonoContacto" data-inputmask="'mask': '9{7,8}'">

            </div>

          </div>  

          <div class="form-row">

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group col-md-4">
              
              <label for="editarDireccionContacto">Dirección</label>
              <input type="text" class="form-control mayuscula" id="editarDireccionContacto" name="editarDireccionContacto">

            </div>

            <!-- ENTRADA PARA LA FECHA CONTACTO -->
            
            <div class="form-group col-md-3">
              
              <label for="editarFechaContacto">Fecha Contacto<span class="text-danger"> *</span></label>
              <input type="date" class="form-control" id="editarFechaContacto" name="editarFechaContacto">

            </div>

            <!-- ENTRADA PARA EL LUGAR CONTACTO -->
            
            <div class="form-group col-md-4">
              
              <label for="editarLugarContacto">Lugar de Contacto</label>
              <input type="text" class="form-control mayuscula" id="editarLugarContacto" name="editarLugarContacto">

            </div>

          </div>  

        </div>

       <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="editarIdPersonaContacto" value="">

          <button type="button" class="btn btn-default float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-primary" id="btnModificarPersonaContacto">

            <i class="fas fa-save"></i>
            Guardar Cambios

          </button>

        </div>

      </div>

    </form>

  </div>

</div>