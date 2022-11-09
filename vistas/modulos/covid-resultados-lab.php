<div class="content-wrapper">

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">

            Listado de Afiliados con Resultados de Laboratorio COVID-19

          </h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></li>

            <li class="breadcrumb-item active">Covid-19 Resultados</li>

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

                  <label>Fecha de Resultado</label>

                  <div class="input-group">
                  
                    <input type="date" class="form-control" id="fechaCovidResultados" min="2020-01-01" max="<?= date("Y-m-d") ?>">

                    <span class="input-group-btn ml-2">

                      <button type="button" class="btn btn-primary px-2 btnCovidResultados" perfilOculto="<?= $_SESSION['perfilUsuarioCOVID']; ?>" actionCovidResultados="fecha_resultado">
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
                      <th>FECHA RECEPCIÓN</th>
                      <th>FECHA MUESTRA</th>
                      <th>TIPO DE MUESTRA</th>
                      <th>MUESTRA DE CONTROL</th>
                      <th>DEPARTAMENTO</th>
                      <th>ESTABLECIMIENTO</th>
                      <th>SEXO</th>
                      <th>FECHA NACIMIENTO</th>
                      <th>TELÉFONO</th>
                      <th>EMAIL</th>
                      <th>LOCALIDAD</th>
                      <th>ZONA</th>
                      <th>DIRECCION</th>
                      <th>MÉTODO DE DIAGNÓSTICO</th>
                      <th>RESULTADO</th>
                      <th>FECHA RESULTADO</th>
                      <th>OBSERVACIONES</th>
                      <th>ACCIONES</th>
                    </tr>

                  </thead>
                  
                </table>

                <input type="hidden" value="<?= $_SESSION['perfilUsuarioCOVID']; ?>" id="perfilOculto">

                <input type="hidden" value="lab" id="actionCovidResultados">

              </div>

            </div>
            
          </div>

        </div>

      </div>

    </div>
   
  </section>
  
</div>

<?php

if (isset($_GET["eliminar"])) {
   
  $eliminarCovidResultado = new ControladorCovidResultados();
  $eliminarCovidResultado->ctrEliminarCovidResultado();

} elseif (isset($_GET["publicar"])) {

  $publicarCovidResultado = new ControladorCovidResultados();
  $publicarCovidResultado->ctrPublicarCovidResultado();

}

?>