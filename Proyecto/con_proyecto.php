<?php
 $codigo = (isset($_POST['codigo_txt'])) ?$_POST['codigo_txt']:"" ;
$nombreP = (isset($_POST['nombreP_txt'])) ?$_POST['nombreP_txt']:"" ;
$lineaInvestigacion = (isset($_POST['lineaInvestigacion_txt'])) ?$_POST['lineaInvestigacion_txt']:"" ;
$fechaInicio = (isset($_POST['fechaInicio_txt'])) ?$_POST['fechaInicio_txt']:"" ;
$fechaEntrega = (isset($_POST['fechaEntrega_txt'])) ?$_POST['fechaEntrega_txt']:"" ;
$campus = (isset($_POST['campus_txt'])) ?$_POST['campus_txt']:"" ;
$estadoProyecto = (isset($_POST['estadoProyecto_txt'])) ?$_POST['estadoProyecto_txt']:"" ;
$cod_docente = (isset($_POST['cod_docentetxt'])) ?$_POST['cod_docentetxt']:"" ;

$accionAgregar="";
$accionModificar=$accionEliminar=$accionCancelar="disabled";

$accion =  (isset($_POST['accion'])) ?$_POST['accion']:"" ;

include ('conexion/conexion.php');

  switch($accion){ 
      case "btnAgregar" :

        $sentencia=$pdo->prepare(
          "INSERT INTO proyectos(nombre, lineaInvestigacion, fechaInicio, fechaEntrega, campus, estadoProyecto, cod_docente) 
          VALUES (:nombre, :lineaInvestigacion,  :fechaInicio, :fechaEntrega, :campus, :estadoProyecto, :cod_docente)
          "
        );

        $sentencia->bindParam(':nombre',$nombreP);
        $sentencia->bindParam(':lineaInvestigacion',$lineaInvestigacion);
        $sentencia->bindParam(':fechaInicio',$fechaInicio);
        $sentencia->bindParam(':fechaEntrega',$fechaEntrega);
        $sentencia->bindParam(':campus',$campus);
        $sentencia->bindParam(':estadoProyecto',$estadoProyecto);
        $sentencia->bindParam(':cod_docente',$cod_docente);

        $sentencia->execute();

        header('Location: proyecto.php');

      break;
      case "btnCancelar" :
        header('Location: proyecto.php');
       
      break;

      case "btnModificar" :

        $sentencia=$pdo->prepare("UPDATE proyectos SET  
        nombre=:nombreP ,
        lineaInvestigacion=:lineaInvestigacion ,
        fechaInicio = :fechaInicio, fechaEntrega =:fechaEntrega , 
        campus = :campus , estadoProyecto=:estadoProyecto , 
        cod_docente=:cod_docente  WHERE 
        cod_proyecto=:cod_proyecto"); 
        
        
        $sentencia->bindParam(':cod_proyecto',$codigo);
        $sentencia->bindParam(':nombreP',$nombreP);
        $sentencia->bindParam(':lineaInvestigacion',$lineaInvestigacion);
        $sentencia->bindParam(':fechaInicio',$fechaInicio);
        $sentencia->bindParam(':fechaEntrega',$fechaEntrega);
        $sentencia->bindParam(':campus',$campus);
        $sentencia->bindParam(':estadoProyecto',$estadoProyecto);
        $sentencia->bindParam(':cod_docente',$cod_docente);
        

        $sentencia->execute();

        header('Location: proyecto.php');

      
    break;

      case "btnEliminar" :
       
        $sentencia=$pdo->prepare("DELETE FROM proyectos WHERE cod_proyecto=:cod_proyecto"); 
        $sentencia->bindParam(':cod_proyecto',$codigo);
        $sentencia->execute();

        header('Location: proyecto.php');

        
      break; 
      case "Seleccionar":
        $accionAgregar="disabled";
        $accionModificar=$accionEliminar=$accionCancelar="";
        
        
      break;
  }

  $sentencia = $pdo->prepare("SELECT * FROM `proyectos` ");
  $sentencia->execute();
  $listaProyectos= $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>


<form action="" method="post">


  <div class="form-row">

 <input type="hidden" class="form-control" value="<?php echo $codigo ?>" name="codigo_txt" placeholder="" id="codigo_xt" require="">
    <div class="form-group col-md-6">
      <label for="">Nombre del Proyecto</label>
      <input type="text" class="form-control" value="<?php echo $nombreP ?>" name="nombreP_txt" required placeholder="" id="nombreP_txt" require="">
    </div>
    <div class="form-group col-md-6">
      <label for="">Linea de Investigacion</label>
      <input type="text" class="form-control" value="<?php echo $lineaInvestigacion ?>" name="lineaInvestigacion_txt" required placeholder="" id="lineaInvestigacion_txt" require="">
    </div>
  </div>
  
  <div class="form-group">
    <label for="">Fecha de Inicio</label>
    <input type="date" class="form-control" value="<?php echo $fechaInicio ?>"  name="fechaInicio_txt" required placeholder="" id="fechaInicio_txt" require="">
  </div>

  <div class="form-group ">
    <label for="">Fecha de Entreaga</label>
    <input type="date" class="form-control" value="<?php echo $fechaEntrega ?>" name="fechaEntrega_txt" required placeholder="" id="fechaEntrega_txt" require="">
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="">Campus</label>
      <input type="text" class="form-control" value="<?php echo $campus ?>" name="campus_txt" required placeholder="" id="campus_txt" require="">
    </div>
    <div class="form-group col-md-4">
      <label for="">Estado Del Proyecto</label>
      <select id="estadoProyecto_txt" name="estadoProyecto_txt"  class="form-control">
        <option selected>En Espera</option>
        <option>Aprovado</option>
        <option>Aplazado</option>
        <option>Rechazado</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="">Codigo Del Tutor</label>
      <input type="text" class="form-control" value="<?php echo $cod_docente ?>" name="cod_docentetxt" required placeholder="" id="cod_docentetxt" require="">
    </div>
  </div>

            <button value="btnAgregar" <?php echo $accionAgregar ?> class="btn btn-success" type="submit" name="accion">Agregar</button>
            <button value="btnModificar" <?php echo $accionModificar; ?> class="btn btn-warning" type="submit" name="accion">Modificar</button>
            <button value="btnEliminar" <?php echo $accionEliminar; ?> class="btn btn-danger" type="submit" name="accion">Eliminar</button>
            <button value="btnCancelar" <?php echo $accionCancelar; ?> class="btn btn-primary" type="submit" name="accion">Cancelar</button>

</form>

<br>

<div class="row col-md-12">
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                   
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Linea Investigacion</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Actulizacion</th>
                    <th>Fecha Entreaga</th>
                    <th>campus</th>
                    <th>Estado Proyecto</th>
                    <th>Docente</th>
                    <th></th>
                </tr>
                </thead>
            <?php foreach($listaProyectos as $docente) { ?>
                <tr>
                    <td><?php echo $docente['cod_proyecto'] ?></td>
                    <td><?php echo $docente['nombre'] ?></td>
                    <td><?php echo $docente['lineaInvestigacion'] ?></td>
                    <td><?php echo $docente['fechaInicio'] ?></td>
                    <td><?php echo $docente['fechaActualizacion'] ?></td>
                    <td><?php echo $docente['fechaEntrega'] ?></td>
                    <td><?php echo $docente['campus'] ?></td>
                    <td><?php echo $docente['estadoProyecto'] ?></td>
                    <td><?php echo $docente['cod_docente'] ?></td>
                    
                    <td>
                    
                    
                    <form action="" method="post">
                    <input type="hidden" name="codigo_txt" value="<?php echo $docente['cod_proyecto'] ?>">
                    <input type="hidden" name="nombreP_txt" value="<?php echo $docente['nombre'] ?>">
                    <input type="hidden" name="lineaInvestigacion_txt" value="<?php echo $docente['lineaInvestigacion'] ?>">
                    <input type="hidden" name="fechaInicio_txt" value="<?php echo $docente['fechaInicio'] ?>">
                    <input type="hidden" name="fechaEntrega_txt" value="<?php echo $docente['fechaEntrega'] ?>">
                    <input type="hidden" name="campus_txt" value="<?php echo $docente['campus'] ?>" >
                    <input type="hidden" name="estadoProyecto_txt" value="<?php echo $docente['estadoProyecto'] ?>" >
                    <input type="hidden" name="cod_docentetxt" value="<?php echo $docente['cod_docente'] ?>" >
                    
                    
                    
                    <button value="Seleccionar" type="submit" class="btn btn-success" name="accion"><i class="far fa-check-circle"></i></button>
                    
                    </form>


                    </td>
                </tr>
            <?php }?>
            </table>
        </div>