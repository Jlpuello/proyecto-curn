<?php 

$codigoP = (isset($_POST['CodigoP_txt'])) ?$_POST['CodigoP_txt']:"" ;
$nombreP = (isset($_POST['NomP_txt'])) ?$_POST['NomP_txt']:"" ;



$codigoA= (isset($_POST['NomD_txt'])) ?$_POST['NomD_txt']:"" ;



$accion =  (isset($_POST['accion'])) ?$_POST['accion']:"" ;

include ('conexion/conexion.php');

$accionAgregar=$accionCancelar="disabled";
$accionseleccionar="";
switch($accion){
   
    case "btnAgregar" :
        
        $sentencia=$pdo->prepare("INSERT INTO alumnoProyecti( cod_proyecto, cod_alumno ) 
        VALUES (:cod_proyecto, :cod_alumno ) ");
        
        $sentencia->bindParam(':cod_proyecto',$codigoP);
        $sentencia->bindParam(':cod_alumno',$codigoA);

        $sentencia->execute();

        header('Location: asigalumno.php');

    break;


    case "SeleccionarP":
        
            $accionAgregar=$accionCancelar="";
            $accionseleccionar="disabled";
              
    break;

    case "btnCancelar" :
        header('Location: asigalumno.php');
       
    break; 
}

$sentencia = $pdo->prepare("SELECT * FROM `proyectos` ");
$sentencia->execute();
$listaProyectos= $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $pdo->prepare("SELECT alumnos.nombres, alumnos.apellidos , alumnos.carrera, alumnos.semestre
        FROM alumnoProyecti
        INNER JOIN alumnos ON alumnoProyecti.cod_alumno=alumnos.cod_estudiante;");
        $sentencia->execute();
        $listaAlumnos= $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>


    <form method="post" action="">
    <input type="hidden" class="form-control" value="<?php echo $codigoP ?>" name="CodigoP_txt" placeholder="" id="CodigoP_txt" require="">
    <div class="form-group col-md-6">
      <label for="">Nombre del Proyecto</label>
      <input type="text" class="form-control" value="<?php echo $nombreP ?>"  name="NomP_txt" required placeholder="" id="NomP_txt" require="">
    </div>
    <div class="form-group col-md-6">
            <input type="hidden" class="form-control" value="<?php echo $codigoD ?>" name="CodigoD_txt" required  placeholder="" id="CodigoD_txt" require="">
     
            <label for="">Codigo Alumno:</label>
            <input type="text" class="form-control" value="<?php echo $codigoA ?>" name="NomD_txt" required  placeholder="" id="NomD_txt" require="">
            </div> 
            <br>
          
            <br>
            <div class="col-md-6" >
            <button value="btnAgregar" <?php echo $accionAgregar; ?>  class="btn btn-success" type="submit" name="accion">Agregar</button>
            <button value="btnCancelar" <?php echo $accionCancelar; ?> class="btn btn-primary" type="submit" name="accion">Cancelar</button>
            </div>
           
    </form>

<br>
    <div class="row">

    <div class="col-md-6">

              
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                            <tr>
                            
                                
                                <th>Nombre</th>
                                <th>Linea Investigacion</th>
                                <th>Fecha Inicio</th>
                                
                            
                                <th>campus</th>
                                <th>Estado Proyecto</th>
                                
                                <th></th>
                            </tr>
                            </thead>
                        <?php foreach($listaProyectos as $docente) { ?>
                            <tr>
                            
                                <td><?php echo $docente['nombre'] ?></td>
                                <td><?php echo $docente['lineaInvestigacion'] ?></td>
                                <td><?php echo $docente['fechaInicio'] ?></td>
                                
                                
                                <td><?php echo $docente['campus'] ?></td>
                                <td><?php echo $docente['estadoProyecto'] ?></td>
                                
                                
                                <td>
                                
                                
                                <form action="" method="post">
                                <input type="hidden" name="CodigoP_txt" value="<?php echo $docente['cod_proyecto'] ?>">
                                <input type="hidden" name="NomP_txt" value="<?php echo $docente['nombre'] ?>">
                              
                                
                                <button value="SeleccionarP" <?php echo $accionseleccionar; ?> type="submit" class="btn btn-success" name="accion"><i class="far fa-check-circle"></i></button>
                                

                                </form>


                                </td>
                            </tr>
                        <?php }?>
                        </table>
                    </div>

    <div class="col-md-6" >
           
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

    </div>
            
