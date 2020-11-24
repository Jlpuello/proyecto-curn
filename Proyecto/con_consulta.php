<?php

$codProyecto = (isset($_POST['codProyecto'])) ?$_POST['codProyecto']:"" ; 

$accionDescargar="";

$accion =  (isset($_POST['accion'])) ?$_POST['accion']:"" ;

include ('conexion/conexion.php');


switch($accion){

    case "consultar":
        
       $accionDescargar="disabled";
       

    break;

    

}
        $sentencia = $pdo->prepare("SELECT alumnos.nombres, alumnos.apellidos , alumnos.carrera, alumnos.semestre
        FROM alumnoProyecti
        INNER JOIN alumnos ON alumnoProyecti.cod_alumno=alumnos.cod_estudiante
        WHERE alumnoProyecti.cod_proyecto=$codProyecto;");
        $sentencia->execute();
        $listaAlumnos= $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $sentencia = $pdo->prepare("SELECT docentes.nombre, roldocente.rol FROM roldocente INNER JOIN docentes
        ON roldocente.cod_profesor=docentes.cod_docente WHERE roldocente.cod_proyecto=$codProyecto;");
        $sentencia->execute();
        $listadocente= $sentencia->fetchAll(PDO::FETCH_ASSOC);


        $sentencia = $pdo->prepare("SELECT  proyectos.nombre, proyectos.lineaInvestigacion, docentes.nombre  as nombreDocente  , proyectos.campus , proyectos.fechaInicio, proyectos.fechaEntrega, proyectos.estadoProyecto , proyectos.fechaActualizacion, proyectos.cod_proyecto
        FROM proyectos INNER JOIN docentes
         ON proyectos.cod_docente=docentes.cod_docente WHERE proyectos.cod_proyecto=$codProyecto;");
        $sentencia->execute();
        $listaproyecto= $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="row">
            <div class="col-md-8">
            <h5 class="text-center">Grupo de Investigacion</h5>
            </div>
            <div class="col-md-4">
                <form class="form-inline" method="post" action="">
                    <input class="form-control mr-sm-2" required require="" id="codProyecto" name="codProyecto" type="text" placeholder="Codigo Del Proyecto">
                    <button class="btn btn-success" value="btnConsultar" type="submit"><i class="fas fa-search"></i></button>
                </form>
             </div>
</div>
<br>
<div class="row">

        <div class="col-md-8" >
           
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>carrera</th>
                    <th>semestre</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($listaAlumnos as $alumno) { ?>
                            <tr>
                            
                                <td><?php echo $alumno['nombres'] ?></td>
                                <td><?php echo $alumno['apellidos'] ?></td>
                                <td><?php echo $alumno['carrera'] ?></td>
                                <td><?php echo $alumno['semestre'] ?></td>
                                
                                
                               
                            </tr>
                        <?php }?>
                </tbody>
            </table>
            </div>
            
            <div class="col-md-4">
            
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>docente</th>
                    <th>rol</th>
                
                </tr>
                </thead>
                <tbody>
                <?php foreach($listadocente as $docente) { ?>
                            <tr>
                            
                                <td><?php echo $docente['nombre'] ?></td>
                                <td><?php echo $docente['rol'] ?></td>
                                
                                
                                
                               
                            </tr>
                        <?php }?>
                </tbody>
            </table>
            </div>

</div>


<div class="row">

<div class="col-md-8">
            
    <?php foreach($listaproyecto as $proyecto) { ?>
                          
                       

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nombre Del Proyecto</th>
                    <td><?php echo $proyecto['nombre'] ?></td>

                </tr>
                <tr>
                    <th>Linea de Investigacion</th>
                    <td><?php echo $proyecto['lineaInvestigacion'] ?></td>

                </tr>
                <tr>
                    <th>Docente Tutor</th>
                    <td><?php echo $proyecto['nombreDocente'] ?></td>

                </tr>
                <tr>
                    <th>campus</th>
                    <td><?php echo $proyecto['campus'] ?></td>

                </tr>
                <tr>
                    <th>Fecha de Inicio</th>
                    <td><?php echo $proyecto['fechaInicio'] ?></td>

                </tr>
                <tr>
                    <th>Fecha de Entrega</th>
                    <td><?php echo $proyecto['fechaEntrega'] ?></td>

                </tr>
             
                </thead>
             <thead>
                    
             </thead>
            </table>
            </div>


    <div class="col-md-4">
                
        <div class="card text-center">
            <div class="card-header">
                Estado
                <br>
            </div>
            <div class="card-body">
                <br>
                <h5 class="card-title text-info"><?php echo $proyecto['estadoProyecto'] ?></h5>
                <p class="card-text">Fecha</p>
                <p><?php echo $proyecto['fechaActualizacion'] ?></p>
                <br>
            </div>
            
                <div class="card-footer text-right">
                    <br>
                   <form action="informePDF.php" method="post">
                   <input type="hidden" name="codigo_txt" value="<?php echo $proyecto['cod_proyecto'] ?>">
                   <button value="btnDescargar" class="btn btn-primary" type="submit" name="accion">Descargar</button>
                    
                    <a href="index.php" class="btn btn-primary">Salir</a>
                   </form>
                </div>
        </div>

    </div>
    <?php }?>

</div>