create view vista_afiliadosSIAIS
as
SELECT pa.idafiliacion, RTRIM(e.emp_nro_empleador) as cod_empleador, RTRIM(e.emp_nombre) as nombre_empleador, RTRIM(p.pac_numero_historia) as cod_asegurado, RTRIM(p.pac_codigo) as cod_beneficiario, RTRIM(p.pac_primer_apellido)+' '+RTRIM(p.pac_segundo_apellido)+' '+RTRIM(p.pac_nombre) as [nombre_completo], RTRIM(p.pac_fecha_nac) as fecha_nacimiento
FROM hcl_poblacion_actual p, hcl_poblacion_afiliacion pa, hcl_empleador e 
WHERE p.idpoblacion = pa.idpoblacion AND pa.idempleador = e.idempleador