<!-- <div id="back"></div>

<div class="login-box">

  <div class="login-logo">

    <img src="vistas/img/cns/cns-logo.png" class="img-fluid" style="padding: 0px 50px 0px 50px">

  </div>

  <div class="card">
  
    <div class="card-body login-card-body">
      
      <p class="login-box-msg">CNS Regional Potosí | COVID-19</p>

      <form method="post">
        
        <div class="input-group mb-3">

          <input type="text" class="form-control" id="Matricula" placeholder="Ingrese Matrícula" name="loginMatricula" required>

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-user"></span>

            </div>

          </div>

        </div>

        <div class="input-group mb-3">

          <input type="text" class="form-control" id="ci" placeholder="Ingrese Nro. CI" name="loginCI" required>

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-user"></span>

            </div>

          </div>

        </div>

        <div class="input-group mb-3">

           <input type="password" class="form-control" id="password" placeholder="Ingrese Contraseña" name="loginPassword" required>

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-lock"></span>

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-4">

            <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
          
          </div>
          
        </div>

        <?php 

          // $login = new ControladorUsuarios();
          // $login -> ctrIngresoUsuario();

        ?>
      
      </form>   
      
    </div>

  </div>

</div> -->

<div class="limiter">

  <div class="container-login100" style="background-image: url('vistas/img/template/1.jpg');">

    <div class="wrap-login100">

      <form method="post" class="login100-form validate-form">

        <span class="login100-form-logo">
          <img src="vistas/img/cns/cns-logo.png">
        </span>

        <span class="login100-form-title p-b-34 p-t-27">
          CNS POTOSÍ | COVID-19
        </span>

        <div class="wrap-input100 validate-input" data-validate = "Ingrese nombre o nick de Usuario">
          <input class="input100" type="text" id="matricula" name="loginMatricula" placeholder="Ingrese Matrícula o Nick de Usuario">
          <span class="focus-input100" data-placeholder="&#xf207;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate = "Ingrese numero de CI">
          <input class="input100" type="text" id="ci" name="loginCI" placeholder="Ingrese Nro. CI">
          <span class="focus-input100" data-placeholder="&#xf20a;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Ingrese password">
          <input class="input100" type="password" id="password" name="loginPassword" placeholder="Ingrese Contraseña">
          <span class="focus-input100" data-placeholder="&#xf191;"></span>
        </div>

        <div class="container-login100-form-btn">
          <button type="submit" class="login100-form-btn">
            Ingresar
          </button>
        </div>

        <?php 

          $login = new ControladorUsuarios();
          $login -> ctrIngresoUsuario();

        ?>

        <div class="text-center p-t-90">
          <a class="txt1" href="../">
            <- Volver a la pagina Principal
          </a>
        </div>

      </form>

    </div>

  </div>
  
</div>

<div id="dropDownSelect1"></div>