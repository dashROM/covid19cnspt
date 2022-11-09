<div class="content-wrapper">

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">

            Reportes Ficha Exportar SIVE

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

                    <button type="button" class="btn btn-primary px-2 btnDatosFichaExportarSive">
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

        <div class="card-body" id="reporteFichaSIVE">   

                  
        </div>

      </div>

    </div>

  </section>
  
</div>
