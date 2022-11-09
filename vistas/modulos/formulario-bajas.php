<div class="content-wrapper">

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">

            Listado de Afiliados con Formulario de Incapacidad COVID-19

          </h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></li>

            <li class="breadcrumb-item active">Formulario Incapacidad</li>

          </ol>

        </div>

      </div>

    </div>

  </div>

  <section class="content">

    <div class="container-fluid">
      
      <div class="row">
        
        <div class="col-12">
           
          <div class="card">
        
            <div class="card-header">
        
              <!-- <a href="afiliadosSIAIS">

                <button class="btn btn-primary">

                  <i class="fas fa-plus"></i>
                  Agregar Nuevo Registro
                
                </button>

              </a> -->

            </div>
        
            <div class="card-body">
              
              <table class="table table-bordered table-striped dt-responsive" id="tablaFormularioBajas" width="100%">
                
                <thead>
                  
                  <tr>
                    <th>COD. LAB.</th>
                    <th>COD. ASEGURADO</th>
                    <th>APELLIDOS Y NOMBRES</th>
                    <th>NOMBRE EMPLEADOR</th>
                    <th>NRO. EMPLEADOR</th>
                    <th>RIESGO</th>
                    <th>INCAPACIDAD DESDE</th>
                    <th>INCAPACIDAD HASTA</th>
                    <th>DIAS INCAPACIDAD</th>
                    <th>LUGAR Y FECHA</th> 
                    <th>CLAVE</th>
                    <th>CÓDIGO</th>                         
                    <th>ACCIONES</th>
                  </tr>

                </thead>
                
              </table>

              <input type="hidden" value="<?php echo $_SESSION['perfilUsuarioCOVID']; ?>" id="perfilOculto">

              <input type="hidden" value="<?= $_SESSION['paternoUsuarioCOVID'].' '.$_SESSION['maternoUsuarioCOVID'].' '.$_SESSION['nombreUsuarioCOVID']; ?>" id="nombreUsuarioOculto">

            </div>
            
          </div>

        </div>

      </div>

    </div>
   
  </section>
  
</div>

<?php
   
  $eliminarFormularioBaja = new ControladorFormularioBajas();
  $eliminarFormularioBaja->ctrEliminarFormularioBaja();

?>

<!--=====================================
VENTANA MODAL PARA MOSTRAR EL FORMULARIO DE BAJA EN PDF
======================================-->

<div id="ver-pdf" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="formularioBajasPDF" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-gradient-info">

          <h5 class="modal-title" id="formularioBajasPDF">Formulario de Incapacidad Generado</h5>
        
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