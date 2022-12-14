<?php 

require_once "controladores/template.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/empleadores.controlador.php";
require_once "controladores/asegurados.controlador.php";
require_once "controladores/departamentos.controlador.php";
require_once "controladores/localidades.controlador.php";
require_once "controladores/paises.controlador.php";
require_once "controladores/establecimientos.controlador.php";
require_once "controladores/consultorios.controlador.php";
require_once "controladores/responsables_muestras.controlador.php";
require_once "controladores/covid_resultados.controlador.php";
require_once "controladores/formulario_bajas.controlador.php";
require_once "controladores/fichas.controlador.php";
require_once "controladores/pacientes_asegurados.controlador.php";
require_once "controladores/ant_epidemiologicos.controlador.php";
require_once "controladores/datos_clinicos.controlador.php";
require_once "controladores/hospitalizaciones_aislamientos.controlador.php";
require_once "controladores/enfermedades_bases.controlador.php";
require_once "controladores/personas_notificadores.controlador.php";
require_once "controladores/laboratorios.controlador.php";
require_once "controladores/personas_contactos.controlador.php";

require_once "controladores/empleadoresSIAIS.controlador.php";
require_once "controladores/afiliadosSIAIS.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/empleadores.modelo.php";
require_once "modelos/asegurados.modelo.php";
require_once "modelos/beneficiarios.modelo.php";
require_once "modelos/departamentos.modelo.php";
require_once "modelos/localidades.modelo.php";
require_once "modelos/paises.modelo.php";
require_once "modelos/establecimientos.modelo.php";
require_once "modelos/consultorios.modelo.php";
require_once "modelos/responsables_muestras.modelo.php";
require_once "modelos/covid_resultados.modelo.php";
require_once "modelos/formulario_bajas.modelo.php";
require_once "modelos/fichas.modelo.php";
require_once "modelos/pacientes_asegurados.modelo.php";
require_once "modelos/ant_epidemiologicos.modelo.php";
require_once "modelos/datos_clinicos.modelo.php";
require_once "modelos/hospitalizaciones_aislamientos.modelo.php";
require_once "modelos/enfermedades_bases.modelo.php";
require_once "modelos/personas_notificadores.modelo.php";
require_once "modelos/laboratorios.modelo.php";
require_once "modelos/personas_contactos.modelo.php";

require_once "modelos/empleadoresSIAIS.modelo.php";
require_once "modelos/afiliadosSIAIS.modelo.php";


$template = new ControladorTemplate();
$template -> ctrTemplate();