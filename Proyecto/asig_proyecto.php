<?php 

$codigoP = (isset($_POST['CodigoP_txt'])) ?$_POST['CodigoP_txt']:"" ;
$nombreP = (isset($_POST['NomP_txt'])) ?$_POST['NomP_txt']:"" ;

$codigoD = (isset($_POST['CodigoD_txt'])) ?$_POST['CodigoD_txt']:"" ;

$nombreD = (isset($_POST['NomD_txt'])) ?$_POST['NomD_txt']:"" ;

$rol = (isset($_POST['rol_txt'])) ?$_POST['rol_txt']:"" ;

$accion =  (isset($_POST['accion'])) ?$_POST['accion']:"" ;

include ('conexion/conexion.php');

$accionAgregar=$accionCancelar="disabled";
$accionseleccionar="";
switch($accion){
   
    case "btnAgregar" :
        
        $sentencia=$pdo->prepare("INSERT INTO roldocente( cod_profesor, cod_proyecto, rol ) 
        VALUES (:cod_profesor, :cod_proyecto, :rol ) ");
        
        $sentencia->bindParam(':cod_profesor',$codigoD);
        $sentencia->bindParam(':cod_proyecto',$codigoP);
        $sentencia->bindParam(':rol',$rol);
        

        $sentencia->execute();

        header('Location: asignacion.php');

    break;


    case "SeleccionarP":
        
            $accionAgregar=$accionCancelar="";
            $accionseleccionar="disabled";
              
    break;

    case "btnCancelar" :
        header('Location: asignacion.php');
       
    break; 
}

$sentencia = $pdo->prepare("SELECT * FROM `proyectos` ");
$sentencia->execute();
$listaProyectos= $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $pdo->prepare("SELECT roldocente.rol, docentes.nombre, docentes.apellido FROM `roldocente` INNER JOIN docentes on roldocente.cod_profesor=docentes.cod_docente");
        $sentencia->execute();
        $listadocente= $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row">  

<div class="col-md-6">
    <form method="post" action="">
        <input type="hidden" class="form-control" value="<?php echo $codigoP ?>" name="CodigoP_txt" placeholder="" id="CodigoP_txt" require="">
        <div class="form-group ">
        <label for="">Nombre del Proyecto</label>
        <input type="text" class="form-control" value="<?php echo $nombreP ?>"  name="NomP_txt" required placeholder="" id="NomP_txt" require="">
        </div>
            
            
     
            <label for="">Codigo Docente:</label>
            <input type="text" class="form-control" value="<?php echo $nombreD ?>" name="CodigoD_txt" required  placeholder="" id="CodigoD_txt" require="">
           
            <br>
           
            <select id="rol_txt" class="form-control" name="rol_txt">
            <option value="Cootutor">CooTutor</option>
            <option value="revisor">Revisor</option>
                
            </select>
           
            <br>

            <button value="btnAgregar" <?php echo $accionAgregar; ?>  class="btn btn-success" type="submit" name="accion">Agregar</button>
            <button value="btnCancelar" <?php echo $accionCancelar; ?> class="btn btn-primary" type="submit" name="accion">Cancelar</button>
          
           
    </form>
    </div>
    <div class="col-md-6">

              
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                
                    
                    <th>Nombre</th>
                    <th>Linea Investigacion</th>
                    
                    
                
                    <th>campus</th>
                    
                    
                    <th></th>
                </tr>
                </thead>
            <?php foreach($listaProyectos as $docente) { ?>
                <tr>
                
                    <td><?php echo $docente['nombre'] ?></td>
                    <td><?php echo $docente['lineaInvestigacion'] ?></td>
                
                    
                    
                    <td><?php echo $docente['campus'] ?></td>
                
                    
                    
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



</div>
<br>

<div class="col-md-6">
            
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>apellido</th>
                    <th>rol</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($listadocente as $docente) { ?>
                            <tr>
                            
                                <td><?php echo $docente['nombre'] ?></td>
                                <td><?php echo $docente['apellido'] ?></td>
                                <td><?php echo $docente['rol'] ?></td>
                                
                                
                                
                               
                            </tr>
                        <?php }?>
                </tbody>
            </table>
            </div>

</div>