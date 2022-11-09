<div class="content-wrapper">

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">

            Reportes Ficha Epidemiológica

          </h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio"><i class="fas fa-tachometer-alt"></i> Inicio</a></li>

            <li class="breadcrumb-item active">Reportes</li>

          </ol>

        </div>

      </div>

    </div>

  </div>
 
  <section class="content">

    <div class="container-fluid">        

      <div class="card card-outline card-info">

        <div class="card-header">

          <div class="right_col alert alert-info" role="main"> 

            <div class="row">  

              <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

                <div class="form-group">
                  
                  <label>Desde</label> (<i class="fas fa-asterisk asterisk mr-1"></i>)
                  
                  <input type="date" class="form-control" id="reporteFechaInicio" min="2020-01-01" max="<?= date("Y-m-d") ?>">

                </div>

              </div>

              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                <label>Hasta </label> (<i class="fas fa-asterisk asterisk mr-1"></i>)

                <div class="input-group">
                  
                  <input type="date" class="form-control" id="reporteFechaFin" min="2020-01-01" max="<?= date("Y-m-d") ?>">

                  <span class="input-group-btn ml-2">

                    <button type="button" class="btn btn-primary px-2 btnFichaEpidemiologicaReporte">
                      <i class="fas fa-search"></i> Buscar
                    </button> 

                  </span>

                </div>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        SE MUESTRA LAS TABLAS GENERADAS
        ======================================-->            

        <div class="card-body" id="reporteFicha">   

                  
        </div>

      </div>

    </div>

  </section>
  
</div>

<!--=====================================
VENTANA MODAL PARA MOSTRAR REPORTE PDF
======================================-->

<div id="ver-pdf" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="repoteFichaEpidemiologica" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-gradient-info">

          <h5 class="modal-title" id="repoteFichaEpidemiologica">Reporte Generado</h5>
        
          <button type="button" class="close btnCerrarReporte" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          
          <div id="view_pdf">
       

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default float-left btnCerrarReporte" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

        </div>

    </div>

  </div>

</div>