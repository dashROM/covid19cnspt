<div class="content-wrapper">

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">

            Resultados Covid-19

          </h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>

            <li class="breadcrumb-item active">Centro COVID</li>

          </ol>

        </div>

      </div>

    </div>

  </div>
 
  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <div class="col-12">

          <div class="card card-outline card-info">

            <div class="card-header"> 

              <div class="row right_col alert alert-info">
                
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                  <label>Fecha de Toma de Muestra</label>

                  <div class="input-group">
                  
                    <input type="date" class="form-control" id="fechaCovidResultados" min="2020-01-01" max="<?= date("Y-m-d") ?>">

                    <span class="input-group-btn ml-2">

                      <button type="button" class="btn btn-primary px-2 btnCovidResultados" perfilOculto="<?= $_SESSION['perfilUsuarioCOVID']; ?>" actionCovidResultados="fecha_muestra">
                        <i class="fas fa-search"></i> Buscar
                      </button> 

                    </span>

                    <input type="hidden" value="<?= $_SESSION['paternoUsuarioCOVID'].' '.$_SESSION['maternoUsuarioCOVID'].' '.$_SESSION['nombreUsuarioCOVID']; ?>" id="nombreUsuarioOculto">

                  </div>

                </div>    

              </div>
                     
            </div>

            <!--=====================================
            SE MUESTRA LAS TABLAS GENERADAS
            ======================================-->            

            <div class="card-body" id="resultadosCovid">

              <div class="table-responsive"> 

                <table class="table table-bordered table-striped dt-responsive table-hover" id="tablaCovidResultados" width="100%">
                  
                  <thead>
                    
                    <tr>
                      <th>COD. LAB.</th>
                      <th>COD. ASEGURADO</th>
                      <th>COD. AFILIADO</th>
                      <th>APELLIDOS Y NOMBRES</th>
                      <th>CI</th>
                      <th>FECHA RECEPCI??N</th>
                      <th>FECHA MUESTRA</th>
                      <th>TIPO DE MUESTRA</th>
                      <th>MUESTRA CONTROL</th>
                      <th>DEPARTAMENTO</th>
                      <th>ESTABLECIMIENTO</th>
                      <th>SEXO</th>
                      <th>FECHA NACIMIENTO</th>
                      <th>TEL??FONO</th>
                      <th>EMAIL</th>
                      <th>LOCALIDAD</th>
                      <th>ZONA</th>
                      <th>DIRECCION</th>
                      <th>M??TODO DE DIAGN??STICO</th>
                      <th>RESULTADO</th>
                      <th>FECHA RESULTADO</th>
                      <th>OBSERVACIONES</th>
                      <th>ACCIONES</th>
                    </tr>

                  </thead>
                  
                </table> 

                <input type="hidden" value="<?= $_SESSION['perfilUsuarioCOVID']; ?>" id="perfilOculto">

                <input type="hidden" value="centro" id="actionCovidResultados">

              </div>
                      
            </div>

          </div>

        </div>

      </div>

    </div>

  </section>
  
</div>

<!--=====================================
VENTANA MODAL PARA MOSTRAR EL FORMULARIO DE BAJA
======================================-->

<div id="modalFormBaja" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalFormBajaLabel" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data" id="formAgregarFormBaja">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-gradient-info">

          <h5 class="modal-title" id="modalFormBajaLabel">Formulario de Baja</h5>
        
          <button type="button" class="close btnCerrarReporte" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          
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
                      <p class="mb-1">DEPARTAMENTO DE AFILIACI??N</p>
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
                <th scope="row">N??mero Asegurado</th>
              </tr>

              <tr>
                <td>
                  <span id="paternoFormBaja"></span>
                </td>
                <td>
                  <span id="maternoFormBaja"></span>
                </td>
                <td>
                  <span id="nombreFormBaja"></span>
                </td>
                <td>
                  <span id="codAseguradoFormBaja"></span>
                  <input type="hidden" id="codAsegurado" value="">
                </td>
              </tr>

              <tr>
                <th colspan="3" scope="row">
                  <span>NOMBRE O RAZON SOCIAL DEL EMPLEADOR</span>

                </th>
                <th scope="row">
                  <span>N??mero Empleador</span>
                </th>
              </tr>

              <tr>
                <td colspan="3">
                  <span id="nombreEmpleadorFormBaja"></span>
                </td>
                <td>
                  <span id="codEmpleadorFormBaja"></span>
                </td>
              </tr>

              <tr>
                <td colspan="4">

                  <div class="row">

                    <div class="col-md-8 border">

                      <div class="row m-0">
                        <label>RIESGO</label>
                      </div>

                      <div class="row align-content-center m-0">

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
                        </div>

                      </div>
                      
                      <div class="form-group row m-0">
                        <label>INCAPACIDAD</label>
                      </div>

                      <div class="form-group row m-1">
                        <label class="col-form-label col-form-label-sm">DESDE</label>
                        <div class="col-md-5">
                          <input type="date" class="form-control form-control-sm" id="fechaIniFormBaja">
                        </div>
                      </div>

                       <div class="form-group row m-1">
                        <label class="col-form-label col-form-label-sm">D??AS DE INCAPACIDAD</label>
                        <div class="col-md-5">
                          <input type="text" class="form-control form-control-sm" id="diasIncapacidadFormBaja">
                        </div>
                      </div>

                      <div class="form-group row m-1">
                        <label class="col-form-label col-form-label-sm">HASTA</label>
                        <div class="col-md-5">
                          <input type="date" class="form-control form-control-sm" id="fechaFinFormBaja">
                        </div>
                      </div>

                      <div class="form-group row m-1">
                        <label class="col-form-label col-form-label-sm">Lugar Y Fecha</label>
                        <div class="col-md-4">
                          <select class="form-control form-control-sm" id="lugarFormBaja" name="lugarFormBaja" required>
                            <option value="">Elegir...</option>
                            <option value="POTOS??">POTOS??</option>
                          </select>
                        </div>
                        <div class="col-md-5">
                          <input type="date" class="form-control form-control-sm" id="fechaFormBaja" name="fechaFormBaja">
                        </div>
                      </div>

                      <div class="form-group row m-1">
                        <label class="col-form-label col-form-label-sm">CLAVE</label>
                        <div class="col-md-5">
                          <input type="text" class="form-control form-control-sm" id="claveFormBaja">
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

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="idCovidResultadoFormBaja">

          <button type="button" class="btn btn-default float-left btnCerrarFormBaja" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-primary btnAgregarFormBaja">

            <i class="fas fa-save"></i>
            Guardar

          </button>

        </div>

      </form>

    </div>

  </div>

</div>