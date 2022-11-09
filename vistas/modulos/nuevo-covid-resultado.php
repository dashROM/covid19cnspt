<div class="content-wrapper">

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">

            Nuevo Registro COVID-19

          </h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></li>

            <li class="breadcrumb-item active">Nuevo Registro COVID-19</li>

          </ol>

        </div>

      </div>

    </div>

  </div>
  
  <section class="content">

    <div class="container-fluid">

      <form role="form" method="post" enctype="multipart/form-data" class="formularioNuevoRegCovid19">

        <div class="row">     

          <div class="col-md-12 col-xs-12">
            
            <div class="card card-outline card-info">

              <div class="card-header">

              <?php 
               
                $item1 = null;
                $item2 = "idafiliacion";
                $valor = $_GET["idAfiliado"];

                $afiliados = ControladorAfiliadosSIAIS::ctrMostrarAfiliadosSIAIS($item1, $item2, $valor);
                
              ?>  
                
                <!-- <p><b>Matricula: </b><?= $afiliados['pac_numero_historia'] ?></p>
                <p><b>Nombre o Razón Social del Empleador: </b><?= $afiliados['emp_nombre'] ?></p>
                <p><b>Nro. Empleador: </b><?= $afiliados['emp_nro_empleador'] ?></p> -->

              </div>

              <div class="card-body">

                <div class="form-inline col-md-12 mb-2">

                  Todos los campos con<i class="fas fa-asterisk asterisk mr-1"></i>son obligatorios

                </div>

                <!--=============================================
                SECCION PARA DATOS PERSONALES
                =============================================-->

                <div class="col-md-12 callout callout-info">

                  <p class="font-weight-bold">DATOS PERSONALES</p>

                  <div class="row">

                    <div class="form-group col-md-4">
                      <label for="nuevoPaterno">Apellido Paterno</label>
                      <input type="text" class="form-control form-control-sm mayuscula" id="nuevoPaterno" name="nuevoPaterno" value="<?= rtrim($afiliados['pac_primer_apellido']) ?>" readonly required>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="nuevoMaterno">Apellido Materno</label>
                      <input type="text" class="form-control form-control-sm mayuscula" id="nuevoMaterno" name="nuevoMaterno" value="<?= rtrim($afiliados['pac_segundo_apellido']) ?>" readonly required>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="nuevoNombre">Nombre</label>
                      <input type="text" class="form-control form-control-sm mayuscula" id="nuevoNombre" name="nuevoNombre" value="<?= rtrim($afiliados['pac_nombre']) ?>" readonly required>
                    </div>

                  </div>

                  <div class="row">

                    <div class="form-group col-md-4">
                      <label for="nuevoDocumentoCI">Nro. CI</label><i class="fas fa-asterisk asterisk"></i>
                      <input type="text" class="form-control form-control-sm" id="nuevoDocumentoCI" name="nuevoDocumentoCI" required pattern="[A-Za-z0-9-]+" title="Solo deben ir letras y números en el campo">
                    </div>

                    <div class="form-group col-md-4">
                      <label for="nuevoSexo">Sexo</label><i class="fas fa-asterisk asterisk"></i>
                      <select class="form-control form-control-sm select2" id="nuevoSexo" name="nuevoSexo" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                        <option value="">Elegir...</option>
                        <option value="F">FEMENINO</option>
                        <option value="M">MASCULINO</option>
                      </select>
                    </div>

                    <div class="form-group col-md-4">
                      <label for="nuevaFechaNacimiento">Fecha de Nacimiento</label>
                      <input type="date" class="form-control form-control-sm" id="nuevaFechaNacimiento" name="nuevaFechaNacimiento" value="<?= $afiliados['pac_fecha_nac'] ?>" readonly>
                    </div>

                  </div>

                  <div class="row">

                    <div class="form-group col-md-4">
                      <label for="nuevoTelefono">Teléfono o Celular</label>
                      <input type="text" class="form-control form-control-sm" id="nuevoTelefono" name="nuevoTelefono" data-inputmask="'mask': '9{7,8}'" pattern="[0-9]{7,8}+" title="Solo deben ir números en el campo">
                    </div>

                    <div class="form-group col-md-8">
                      <label for="nuevoEmail">Em@il</label>
                       <input type="text" class="form-control form-control-sm" id="nuevoEmail" name="nuevoEmail" data-inputmask="'alias': 'email'" inputmode="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Introduzca formato de email válido">
                    </div>

                  </div>

                  <div class="row">

                    <div class="form-group col-md-4">
                      <label for="nuevaLocalidad">Localidad</label><i class="fas fa-asterisk asterisk"></i>
                      <select class="form-control form-control-sm select2" id="nuevaLocalidad" name="nuevaLocalidad" data-dropdown-css-class="select2-info" style="width: 100%;" required>
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
                      <label for="nuevaZona">Zona</label><i class="fas fa-asterisk asterisk"></i>
                      <input type="text" class="form-control form-control-sm mayuscula" id="nuevaZona" name="nuevaZona" required pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ .-]+" title="Solo deben ir letras y números en el campo">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="nuevaCalle">Calle</label><i class="fas fa-asterisk asterisk"></i>
                      <input type="text" class="form-control form-control-sm mayuscula" id="nuevaCalle" name="nuevaCalle" required pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ .-]+" title="Solo deben ir letras y números en el campo">
                    </div>

                    <div class="form-group col-md-2">
                      <label for="nuevoNroCalle">Nro</label>
                      <input type="text" class="form-control form-control-sm" id="nuevoNroCalle" name="nuevoNroCalle" pattern="[a-zA-Z0-9 .-/]+" title="Caracteres no admitidos">
                    </div>

                  </div>

                </div>

                <!-- FIN DATOS PERSONALES -->

                <!--=============================================
                SECCION PARA DATOS LABORALES
                =============================================-->

                <div class="col-md-12 callout callout-info">

                  <p class="font-weight-bold">DATOS LABORALES</p>

                  <div class="row">

                    <div class="form-group col-md-3">
                      <label for="nuevoMatricula">Matrícula / Cod. Asegurado</label>
                      <input type="text" class="form-control form-control-sm mayuscula" id="nuevoMatricula" name="nuevoMatricula" readonly required>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="nuevoNroEmpleador">Nro. Empleador:</label>
                      <input type="text" class="form-control form-control-sm mayuscula" id="nuevoNroEmpleador" name="nuevoNroEmpleador" readonly required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="nuevoRazonSocial">Nombre o Razón Social</label>
                      <input type="text" class="form-control form-control-sm mayuscula" id="nuevoRazonSocial" name="nuevoRazonSocial" readonly required>
                    </div>

                  </div>

                </div>

                <!-- FIN DATOS LABORALES -->

                <!--=============================================
                SECCION PARA DATOS DE LABORATOTIO
                =============================================-->

                <div class="col-md-12 callout callout-info">

                  <p class="font-weight-bold">DATOS LABORATORIO</p> 

                  <div class="row">

                    <div class="form-group col-md-3">
                      <label for="nuevaFechaMuestra">Fecha Toma de Muestra</label><i class="fas fa-asterisk asterisk"></i>
                      <input type="date" class="form-control form-control-sm" id="nuevaFechaMuestra" name="nuevaFechaMuestra" required>
                    </div>
                    
                    <div class="form-group col-md-3">
                      <label for="nuevaMuestraControl">Muestra de Control</label><i class="fas fa-asterisk asterisk"></i>
                      <select class="form-control form-control-sm select2" id="nuevaMuestraControl" name="nuevaMuestraControl" data-dropdown-css-class="select2-info" style="width: 100%;" required>
                        <option value="">Elegir...</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</o ption>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
              
                      <label for="nuevoTipoMuestra">Tipo de muestra tomada</label><i class="fas fa-asterisk asterisk"></i>

                      <select class="form-control form-control-sm select2_dinamic" id="nuevoTipoMuestra" name="nuevoTipoMuestra" data-dropdown-css-class="select2-info" style="width: 100%;">

                        <option value=""></option>
                        <option value="ASPIRADO">ASPIRADO</option>
                        <option value="ESPUTO">ESPUTO</option>
                        <option value="LAVADO BRONCO ALVELAR">LAVADO BRONCO ALVELAR</option>
                        <option value="HISOPADO NASOFARÍNGEO">HISOPADO NASOFARÍNGEO</option>
                        <option value="HISOPADO COMBINADO">HISOPADO COMBINADO</option>

                      </select>
                
                    </div> 

                    <div class="form-group col-md-3">
                      <label for="nuevaFechaRecepcion">Fecha Recepción</label><i class="fas fa-asterisk asterisk"></i>
                      <input type="date" class="form-control form-control-sm" id="nuevaFechaRecepcion" name="nuevaFechaRecepcion" required>
                    </div>         

                  </div>

                  <div class="row">

                    <div class="form-group col-md-6">

                      <div class="icheck-primary d-inline">
                        <input type="radio" name="tipoLaboratorio" checked id="interno" value="INTERNO">
                        <label for="interno">
                          Laboratorio Interno
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" name="tipoLaboratorio" id="externo" value="EXTERNO">
                        <label for="externo">
                          Laboratorio Externo
                        </label>
                      </div>    

                    </div>

                  </div>

                  <div class="row">

                    <div class="form-group col-md-2">
                      <label for="nuevoCodLab">Cód. Lab.</label><i class="fas fa-asterisk asterisk"></i>
                      <input type="text" class="form-control form-control-sm mayuscula" id="nuevoCodLab" name="nuevoCodLab" required pattern="[a-zA-Z0-9]+" title="Solo deben ir letras y números en el campo">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="nuevoNombreLab">Nombre Lab.</label>
                      <input type="text" class="form-control form-control-sm mayuscula" id="nuevoNombreLab" name="nuevoNombreLab" pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ .-]+" title="Solo deben ir letras y números en el campo">
                    </div>

                    <div class="form-group col-md-3">
                      <label for="nuevoDepartamento">Departamento</label><i class="fas fa-asterisk asterisk"></i>
                      <select class="form-control form-control-sm select2" id="nuevoDepartamento" name="nuevoDepartamento" data-dropdown-css-class="select2-info" style="width: 100%;" required>
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
                    
                    <div class="form-group col-md-4">
                      <label for="nuevoEstablecimiento">Establecimiento</label><i class="fas fa-asterisk asterisk"></i>
                      <select class="form-control form-control-sm select2" id="nuevoEstablecimiento" name="nuevoEstablecimiento" data-dropdown-css-class="select2-info" style="width: 100%;" required>
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

                  </div>

                </div>

                <!-- FIN DATOS DE LABORATORIO -->

                <!--=============================================
                SECCION PARA DATOS DE RESULTADO DE LABORATORIO
                =============================================-->

                <div class="col-md-12 callout callout-info">

                  <p class="font-weight-bold">RESULTADO LABORATORIO</p>

                  <div class="row">

                    <div class="form-group col-md-3">

                      <label class="m-0" for="nuevoMetodoDiagnostico">Método de Diagnostico<i class="fas fa-asterisk asterisk"></i></label>
                      <select class="form-control form-control-sm select2" name="nuevoMetodoDiagnostico" id="nuevoMetodoDiagnostico" data-dropdown-css-class="select2-info" style="width: 100%;">
                        <option value="">Elegir...</option>
                        <option value="RT-PCR EN TIEMPO REAL">RT-PCR EN TIEMPO REAL</option>
                        <option value="RT-PCR GENEXPERT">RT-PCR GENEXPERT</option>
                        <option value="PRUEBA ANTIGÉNICA">PRUEBA ANTIGÉNICA</option>';
    
                      </select>

                    </div>

                    <div class="form-group col-md-3 text-center clearfix">

                      <label>Resultados Laboratorio<br>Covid-19</label>
            
                      <div class="icheck-danger">
                        <input type="radio" name="nuevoResultado" id="radio1" value="POSITIVO">
                        <label for="radio1">
                          POSITIVO
                        </label>
                      </div>
                      <div class="icheck-success">
                        <input type="radio" name="nuevoResultado" checked id="radio2" value="NEGATIVO">
                        <label for="radio2">
                          NEGATIVO
                        </label>
                      </div>                   

                    </div>

              
                    <div class="form-group col-md-3">
                      <label for="nuevaFechaResultado">Fecha del Resultado</label><i class="fas fa-asterisk asterisk"></i>
                      <input type="date" class="form-control form-control-sm" id="nuevaFechaResultado" name="nuevaFechaResultado" required>
                    </div>

                    <div class="form-group col-md-3 observacion">
                      <label for="nuevaObservacion">Observaciones</label>
                      <textarea class="form-control form-control-sm mayuscula" id="nuevaObservacion" name="nuevaObservacion" placeholder="Ingresar observaciones (Opcional)" rows="3" pattern="[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ .-(),/#]+" title="Caracteres no admitidos"></textarea>
                    </div>

                  </div>

                </div>

                <!-- FIN DATOS RESULTADO DE LABORATORIO -->  

              </div> 

              <div class="card-footer">

                <div class="float-right">

                  <input type="hidden" id="codAfiliado" name="codAfiliado" value="<?= rtrim($afiliados['pac_codigo']) ?>">

                  <input type="hidden" id="codAsegurado" name="codAsegurado" value="<?= rtrim($afiliados['pac_numero_historia']) ?>">

                  <input type="hidden" id="codEmpleador" name="codEmpleador" value="<?= $afiliados['emp_nro_empleador'] ?>">

                  <input type="hidden" id="idAfiliado" name="idAfiliado" value="<?= $_GET['idAfiliado'] ?>">

                  <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $_SESSION['idUsuarioCOVID'] ?>">
                    
                  <button type="submit" class="btn btn-primary btnGuardar">

                    <i class="fas fa-save"></i>
                    Guardar Resultado

                  </button>

                </div>

              </div> 

            </div> 

          </div>
 
        </div>

      </form>

      <?php

      $guardarCovidResultado = new ControladorCovidResultados();
      $guardarCovidResultado -> ctrCrearCovidResultado();

      ?>    

    </div> 

  </section>
  
</div>