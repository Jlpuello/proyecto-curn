SELECT alumnoProyecti.cod_alumno, alumnos.nombres, alumnos.apellidos
FROM alumnoProyecti
INNER JOIN alumnos ON alumnoProyecti.cod_alumno=alumnos.cod_estudiante
WHERE alumnoProyecti.cod_proyecto=2;


SELECT docentes.nombre, roldocente.rol FROM roldocente INNER JOIN docentes
 ON roldocente.cod_profesor=docentes.cod_docente WHERE roldocente.cod_proyecto=2;

SELECT proyectos.nombre, proyectos.lineaInvestigacion, docentes.nombre, proyectos.fechaInicio, proyectos.fechaEntrega, proyectos.campus, proyectos.fechaActualizacion, proyectos.estadoProyecto
FROM proyectos INNER JOIN docentes
 ON proyectos.cod_docente=docentes.cod_docente WHERE proyectos.cod_proyecto=2;