<?php

$codigo = (isset($_POST['Codigo_txt'])) ?$_POST['Codigo_txt']:"" ;

$nombre = (isset($_POST['Nom_txt'])) ?$_POST['Nom_txt']:"" ;
$apellido = (isset($_POST['Ape_txt'])) ?$_POST['Ape_txt']:"" ;

$correo = (isset($_POST['Correo_txt'])) ?$_POST['Correo_txt']:"" ;

$titulo = (isset($_POST['Titulo_txt'])) ?$_POST['Titulo_txt']:"" ;
$area = (isset($_POST['Area_txt'])) ?$_POST['Area_txt']:"" ;

$accion =  (isset($_POST['accion'])) ?$_POST['accion']:"" ;

$accionAgregar="";
$accionModificar=$accionEliminar=$accionCancelar="disabled";
$mostrarModal = false ;

include ('conexion/conexion.php');

switch($accion){

    case "btnAgregar" :
        
        $sentencia=$pdo->prepare("INSERT INTO docentes(cod_docente, nombre, apellido, correo, titulo, area) 
        VALUES (:cod_docente, :nombre, :apellido, :correo, :titulo, :area) ");
        
        $sentencia->bindParam(':cod_docente',$codigo);
        $sentencia->bindParam(':nombre',$nombre);
        $sentencia->bindParam(':apellido',$apellido);
        $sentencia->bindParam(':correo',$correo);
        $sentencia->bindParam(':titulo',$area);
        $sentencia->bindParam(':area',$titulo);

        $sentencia->execute();

        header('Location: docente.php');

    break;

    case "btnModificar" :

        $sentencia=$pdo->prepare("UPDATE docentes SET 
         
        nombre=:nombre ,
        apellido=:apellido ,
        correo = :correo , 
        titulo=:titulo , area = :area WHERE 
        cod_docente=:cod_docente"); 
        
        
        $sentencia->bindParam(':cod_docente',$codigo);
        $sentencia->bindParam(':nombre',$nombre);
        $sentencia->bindParam(':apellido',$apellido);
        $sentencia->bindParam(':correo',$correo);
        $sentencia->bindParam(':titulo',$titulo);
        $sentencia->bindParam(':area',$area);

        $sentencia->execute();

        header('Location: docente.php');

      
    break;

    case "btnEliminar" :

        $sentencia=$pdo->prepare("DELETE FROM docentes WHERE cod_docente=:cod_docente"); 
        $sentencia->bindParam(':cod_docente',$codigo);
        $sentencia->execute();

        header('Location: docente.php');

        
    break;

    case "btnCancelar" :
        header('Location: alumno.php');
       
    break; 

    case "Seleccionar":
        $accionAgregar="disabled";
        $accionModificar=$accionEliminar=$accionCancelar="";
        $mostrarModal = true ;
        
    break;

}

        $sentencia = $pdo->prepare("SELECT * FROM `docentes` ");
        $sentencia->execute();
        $listaDocentes= $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<br>

<form action="" method="post">
<!-- Button trigger modal -->
<button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Agregar Docente+
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Docentes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      
            <label for="">Codigo Docente:</label>
            <input type="text" class="form-control" name="Codigo_txt" required value="<?php echo $codigo ;?>" placeholder="" id="Codigo_txt" require="">
     
            <label for="">Nombre(s):</label>
            <input type="text" class="form-control" name="Nom_txt" required value="<?php echo $nombre ;?>"  placeholder="" id="Nom_txt" require="">
            <br>
            <label for="">Apellido:</label>
            <input type="text" class="form-control" name="Ape_txt"  required value="<?php echo $apellido;?>" placeholder="" id="Ape_txt" require="">
           
                     
            
                     
            <label for="">Correo:</label>
            <input type="email" class="form-control" name="Correo_txt" required value="<?php echo $correo ;?>" placeholder="" id="Correo_txt" require="">            
             
            
            
            
            <label for="">Titulo:</label>
            <input type="text" class="form-control" name="Titulo_txt"  required value="<?php echo $titulo ;?>" placeholder="" id="Titulo_txt" require="">            
            
            
            <label for="">Area:</label>
            <input type="text" class="form-control" name="Area_txt"  required value="<?php echo $area ;?>" placeholder="" id="Area_txt" require="">   
           
            

            <br>
        
      </div>
      <div class="modal-footer">

      <button value="btnAgregar" <?php echo $accionAgregar; ?> class="btn btn-success" type="submit" name="accion">Agregar</button>
            <button value="btnModificar" <?php echo $accionModificar; ?> class="btn btn-warning" type="submit" name="accion">Modificar</button>
            <button value="btnEliminar" <?php echo $accionEliminar; ?> class="btn btn-danger" type="submit" name="accion">Eliminar</button>
            <button value="btnCancelar" <?php echo $accionCancelar; ?> class="btn btn-primary" type="submit" name="accion">Cancelar</button>
          
      </div>
    </div>
  </div>
</div>

</form>

<br>

<div class="row col-md-12">
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                   
                    <th>Codigo</th>
                    <th>Nombre(s)</th>
                    <th>Apellido(s)</th>
                    <th>Coreo</th>
                    <th>Titulo</th>
                    <th>Area</th>
                    <th></th>
                </tr>
                </thead>
            <?php foreach($listaDocentes as $docente) { ?>
                <tr>
                   
                    <td><?php echo $docente['cod_docente'] ?></td>
                    <td><?php echo $docente['nombre'] ?></td>
                    <td><?php echo $docente['apellido'] ?></td>
                    <td><?php echo $docente['correo'] ?></td>
                    <td><?php echo $docente['titulo'] ?></td>
                    <td><?php echo $docente['area'] ?></td>
                    <td>
                    
                    
                    
                    <form action="" method="post">

                    <input type="hidden" name="Codigo_txt" value="<?php echo $docente['cod_docente'] ?>">
                    <input type="hidden" name="Nom_txt" value="<?php echo $docente['nombre'] ?>">
                    <input type="hidden" name="Ape_txt" value="<?php echo $docente['apellido'] ?>">
                    <input type="hidden" name="Correo_txt" value="<?php echo $docente['correo'] ?>" >
                    <input type="hidden" name="Titulo_txt" value="<?php echo $docente['titulo'] ?>">
                    <input type="hidden" name="Area_txt" value="<?php echo $docente['area'] ?>">

                    <button value="Seleccionar" type="submit" class="btn btn-success" name="accion"><i class="far fa-check-circle"></i></button>
                    
                    </form>


                    </td>
                </tr>
            <?php }?>
            </table>
        </div>

<?php if($mostrarModal){?>
<script src="js/vistas.js">
  

  $("#exampleModal").modal('show');

  
  


</script>


<?php 

} ?>

