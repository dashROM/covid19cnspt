<div class="content-wrapper">

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">

            Editar Formulario de Baja

          </h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></li>

            <li class="breadcrumb-item active">Editar Formulario de Baja</li>

          </ol>

        </div>

      </div>

    </div>

  </div>
  
  <section class="content">

    <div class="container-fluid">

      <form role="form" method="post" enctype="multipart/form-data" class="formularioEditarFormBaja">

        <div class="row">
        
          <!--=============================================
          SECCION PARA SUBIR LA FOTO DEL ASEGURADO
          =============================================-->       
         
          <div class="col-md-4 col-xs-12">

            <div class="card card-outline card-info">

              <div class="card-body">

              <?php 

                $item = "id";
                $valor = $_GET["idFormularioBaja"];

                $formularioBaja = ControladorFormularioBajas::ctrMostrarFormularioBajas($item, $valor);

                /*=============================================
                TRAEMOS LOS DATOS DEL AFILIADOS DE COVID RESULTADOS
                =============================================*/
                
                $itemCovidResultados = "id";
                $valorCovidResultados = $formularioBaja["id_covid_resultado"];

                $covidResultados = ControladorCovidResultados::ctrMostrarCovidResultados($itemCovidResultados, $valorCovidResultados);
                
              ?>  

                <!-- ENTRADA PARA SUBIR FOTO -->
          
                <div class="form-group">

                <?php 

                if ($formularioBaja["imagen"] == "") {
                  
                  echo '<img src="vistas/img/form_bajas/default/anonymous.png" class="img-thumbnail previsualizar" width="400px">';

                } else {

                  echo '<img src="'.$formularioBaja["imagen"].'" class="img-thumbnail previsualizar" width="400px">';
                  
                }

                ?>                 

                  <p class="help-block">Peso máximo de la imagen 2MB</p>

                  <input type="hidden" name="ImagenActual" id="ImagenActual" value="<?= $formularioBaja["imagen"] ?>">

                </div>      
                                 
              </div>
            
              <div class="card-footer">
                
                <div class="input-group mb-3">

                  <div class="input-group-prepend">
                    
                    <label class="input-group-text" for="imagenFormBaja" id="inputImagenFormBaja"><i class="fas fa-portrait"></i></label>

                  </div>
                  
                  <div class="custom-file">
                    
                    <input type="file" class="custom-file-input imagenFormBaja" name="imagenFormBaja" id="imagenFormBaja" aria-describedby="inputImagenFormBaja">

                    <label class="custom-file-label" for="imagenFormBaja" data-browse="Elegir">SUBIR IMAGEN</label>

                  </div>

                </div>

              </div> 

            </div>       

          </div>

          <!--=============================================
          SECCION PARA LA ENTRADA DE DATOS PERSONALES
          =============================================-->

          <div class="col-md-8 col-xs-12">
            
            <div class="card card-outline card-info">

              <!-- <div class="card-header">
                
                <h5>Formulario de Baja</h5>

              </div> -->

              <div class="card-body">

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col" colspan="4">

                        <div class="row">
                          <div class="col-2 text-center">
                            <img src="vistas/img/cns/cns-logo-simple.png" alt="" width="80%">
                          </div>
                          <div class="col-6 text-center">
                            <p class="mb-1">CAJA NACIONAL DE SALUD</p>
                            <p class="mb-1">DEPARTAMENTO DE AFILIACIÓN</p>
                            <p class="mb-1">CERTIFICADO DE INCAPACIDAD TEMPORAL</p>
                          </div>
                          <div class="col-4 text-right text-uppercase">
                            <p>Form AVC-09</p>
                          </div>
                        </div>

                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">AP. PATERNO</th>
                      <th scope="row">AP. MATERNO</th>
                      <th scope="row">NOMBRE</th>
                      <th scope="row">Número Asegurado</th>
                    </tr>

                    <tr>
                      <td>
                        <span id="paternoFormBaja"><?= $covidResultados["paterno"] ?></span>
                      </td>
                      <td>
                        <span id="maternoFormBaja"><?= $covidResultados["materno"] ?></span>
                      </td>
                      <td>
                        <span id="nombreFormBaja"><?= $covidResultados["nombre"] ?></span>
                      </td>
                      <td>
                        <span id="codAseguradoFormBaja"><?= $covidResultados["cod_asegurado"] ?></span>
                      </td>
                    </tr>

                    <tr>
                      <th colspan="3" scope="row">
                        <span>NOMBRE O RAZON SOCIAL DEL EMPLEADOR</span>

                      </th>
                      <th scope="row">
                        <span>Número Empleador</span>
                      </th>
                    </tr>

                    <tr>
                      <td colspan="3">
                        <span id="nombreEmpleadorFormBaja"><?= $covidResultados["nombre_empleador"] ?></span>
                      </td>
                      <td>
                        <span id="codEmpleadorFormBaja"><?= $covidResultados["cod_empleador"] ?></span>
                      </td>
                    </tr>

                    <tr>
                      <td colspan="4">

                        <div class="row">

                          <div class="col-md-8 border">

                            <div class="row m-0">
                              <label>RIESGO</label>
                            </div>

                            <div class="form-row m-0">

                            <?php

                            if ($formularioBaja['riesgo'] == "PROFESIONAL") {

                              echo '

                              <div class="icheck-primary icheck-inline">
                                <input type="radio" id="radio1" checked value="PROFESIONAL" name="riesgoFormBaja">
                                <label for="radio1">PROFESIONAL</label>
                              </div>
                              <div class="icheck-primary icheck-inline">
                                <input type="radio" id="radio2" value="ENFERMEDAD" name="riesgoFormBaja">
                                <label for="radio2">ENFERMEDAD</label>
                              </div>
                              <div class="icheck-primary icheck-inline">
                                <input type="radio" id="radio3" value="MATERNIDAD" name="riesgoFormBaja">
                                <label for="radio3">MATERNIDAD</label>
                              </div>';

                            } else if ($formularioBaja['riesgo'] == "ENFERMEDAD") {

                              echo '
                              <div class="icheck-primary icheck-inline">
                                <input type="radio" id="radio1" value="PROFESIONAL" name="riesgoFormBaja">
                                <label for="radio1">PROFESIONAL</label>
                              </div>
                              <div class="icheck-primary icheck-inline">
                                <input type="radio" id="radio2" checked value="ENFERMEDAD" name="riesgoFormBaja">
                                <label for="radio2">ENFERMEDAD</label>
                              </div>
                              <div class="icheck-primary icheck-inline">
                                <input type="radio" id="radio3" value="MATERNIDAD" name="riesgoFormBaja">
                                <label for="radio3">MATERNIDAD</label>
                              </div>';

                            } else {

                               echo '
                              <div class="icheck-primary icheck-inline">
                                <input type="radio" id="radio1" value="PROFESIONAL" name="riesgoFormBaja">
                                <label for="radio1">PROFESIONAL</label>
                              </div>
                              <div class="icheck-primary icheck-inline">
                                <input type="radio" id="radio2"  value="ENFERMEDAD" name="riesgoFormBaja">
                                <label for="radio2">ENFERMEDAD</label>
                              </div>
                              <div class="icheck-primary icheck-inline">
                                <input type="radio" id="radio3" checked value="MATERNIDAD" name="riesgoFormBaja">
                                <label for="radio3">MATERNIDAD</label>
                              </div>';

                            }

                            ?>

                            </div>
                            
                            <div class="form-group row m-0">
                              <label>INCAPACIDAD</label>
                            </div>

                            <div class="form-group row m-1">
                              <label class="col-form-label col-form-label-sm">DESDE</label>
                              <div class="col-md-5">
                                <input type="date" class="form-control form-control-sm calendarioFormBaja" id="fechaIniFormBaja" name="fechaIniFormBaja" value="<?= $formularioBaja["fecha_ini"] ?>" required>
                              </div>
                            </div>

                            <div class="form-group row m-1">
                              <label class="col-form-label col-form-label-sm">HASTA</label>
                              <div class="col-md-5">
                                <input type="date" class="form-control form-control-sm" id="fechaFinFormBaja" name="fechaFinFormBaja" value="<?= $formularioBaja["fecha_fin"] ?>" required>
                              </div>
                            </div>

                            <div class="form-group row m-1">
                              <label class="col-form-label col-form-label-sm">DÍAS DE INCAPACIDAD</label>
                              <div class="col-md-5">
                                <input type="text" class="form-control form-control-sm" id="diasIncapacidadFormBaja" name="diasIncapacidadFormBaja" value="<?= $formularioBaja["dias_incapacidad"] ?>" required>
                              </div>
                            </div>

                            <div class="form-group row m-1">
                              <label class="col-form-label col-form-label-sm">Lugar y Fecha</label>
                              <div class="col-md-4">
                                <select class="form-control form-control-sm" id="lugarFormBaja" name="lugarFormBaja" required>
                                  <option value="<?= $formularioBaja["lugar"] ?>"><?= $formularioBaja["lugar"] ?></option>
                                </select>
                              </div>
                              <div class="col-md-5">
                                <input type="date" class="form-control form-control-sm" id="fechaFormBaja" name="fechaFormBaja" value="<?= $formularioBaja["fecha"] ?>" required>
                              </div>
                            </div>

                            <div class="form-group row m-1">
                              <label class="col-form-label col-form-label-sm">CLAVE</label>
                              <div class="col-md-5">
                                <input type="text" class="form-control form-control-sm" id="claveFormBaja" name="claveFormBaja" value="<?= $formularioBaja["clave"] ?>" required>
                              </div>
                            </div>

                          </div>

                          <div class="col-md-4 border">

                            <p>Salario Bs.</p>
                            <p>Importe Subsidio</p>
                            <p>SON:</p>
                            <br>
                            <p>CERTIFICO</p>
                            <br>
                            <p class="text-center">Nombre y Firma C.N.S.</p>
                          
                          </div>

                        </div>                 

                      </td>
                     
                    </tr>

                  </tbody>

                </table>

              </div> 

              <div class="card-footer">

                <div class="float-right">

                  <input type="hidden" id="idCovidResultado" name="idCovidResultado" value="<?= $formularioBaja['id_covid_resultado'] ?>">

                  <input type="hidden" id="idFormularioBaja" name="idFormularioBaja" value="<?= $_GET['idFormularioBaja'] ?>">

                  <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $_SESSION['idUsuarioCOVID'] ?>">
                    
                  <button type="submit" class="btn btn-primary btnGuardar">

                    <i class="fas fa-save"></i>
                    Guardar Cambios

                  </button>

                </div>

              </div> 

            </div> 

          </div>
 
        </div>

      </form>

      <?php

        $editarFormularioBajas = new ControladorFormularioBajas();
        $editarFormularioBajas -> ctrEditarFormularioBaja();

      ?>    

    </div> 

  </section>
  
</div>