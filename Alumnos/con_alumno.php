<?php

$codigo = (isset($_POST['Codigo_txt'])) ?$_POST['Codigo_txt']:"" ;
$cedula = (isset($_POST['Ced_txt'])) ?$_POST['Ced_txt']:"" ;
$nombre = (isset($_POST['Nom_txt'])) ?$_POST['Nom_txt']:"" ;
$apellido = (isset($_POST['Ape_txt'])) ?$_POST['Ape_txt']:"" ;
$edad = (isset($_POST['Edad_txt'])) ?$_POST['Edad_txt']:"" ;
$sexo = (isset($_POST['Sexo_txt'])) ?$_POST['Sexo_txt']:"" ;
$correo = (isset($_POST['Correo_txt'])) ?$_POST['Correo_txt']:"" ;
$telefono = (isset($_POST['Tel_txt'])) ?$_POST['Tel_txt']:"" ;
$carrera = (isset($_POST['Carrera_txt'])) ?$_POST['Carrera_txt']:"" ;
$semestre = (isset($_POST['Semestre_txt'])) ?$_POST['Semestre_txt']:"" ;

$accion =  (isset($_POST['accion'])) ?$_POST['accion']:"" ;

$accionAgregar="";
$accionModificar=$accionEliminar=$accionCancelar="disabled";
$mostrarModal = false ;

include ('conexion/conexion.php');

switch($accion){

    case "btnAgregar" :
        
        $sentencia=$pdo->prepare("INSERT INTO alumnos(cod_estudiante, cedula, nombres, apellidos, edad, sexo, correo, telefono, carrera, semestre) 
        VALUES (:cod_estudiante, :cedula, :nombres, :apellidos, :edad, :sexo, :correo, :telefono, :carrera, :semestre) ");
        
        $sentencia->bindParam(':cod_estudiante',$codigo);
        $sentencia->bindParam(':cedula',$cedula);
        $sentencia->bindParam(':nombres',$nombre);
        $sentencia->bindParam(':apellidos',$apellido);
        $sentencia->bindParam(':edad',$edad);
        $sentencia->bindParam(':sexo',$sexo);
        $sentencia->bindParam(':correo',$correo);
        $sentencia->bindParam(':telefono',$telefono);
        $sentencia->bindParam(':carrera',$carrera);
        $sentencia->bindParam(':semestre',$semestre);

        $sentencia->execute();

        header('Location: alumno.php');

    break;

    case "btnModificar" :

        $sentencia=$pdo->prepare("UPDATE alumnos SET 
        cedula=:cedula , 
        nombres=:nombres ,
        apellidos=:apellidos ,
        edad = :edad, sexo =:sexo , 
        correo = :correo , telefono=:telefono , 
        carrera=:carrera , semestre = :semestre WHERE 
        cod_estudiante=:cod_estudiante"); 
        
        
        $sentencia->bindParam(':cod_estudiante',$codigo);
        $sentencia->bindParam(':cedula',$cedula);
        $sentencia->bindParam(':nombres',$nombre);
        $sentencia->bindParam(':apellidos',$apellido);
        $sentencia->bindParam(':edad',$edad);
        $sentencia->bindParam(':sexo',$sexo);
        $sentencia->bindParam(':correo',$correo);
        $sentencia->bindParam(':telefono',$telefono);
        $sentencia->bindParam(':carrera',$carrera);
        $sentencia->bindParam(':semestre',$semestre);

        $sentencia->execute();

        header('Location: alumno.php');

      
    break;

    case "btnEliminar" :

        $sentencia=$pdo->prepare("DELETE FROM alumnos WHERE cod_estudiante=:cod_estudiante"); 
        $sentencia->bindParam(':cod_estudiante',$codigo);
        $sentencia->execute();

        header('Location: alumno.php');

        
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

    $sentencia = $pdo->prepare("SELECT * FROM `alumnos` ");
    $sentencia->execute();
    $listaAlumnos= $sentencia->fetchAll(PDO::FETCH_ASSOC);

 

?>



    
<form action="" method="post" >

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alumno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">

            <div class="form-group col-md-6">
            <label for="">Codigo Estudiante:</label>
            <input type="text" class="form-control" name="Codigo_txt" required value="<?php echo $codigo ;?>" placeholder="" id="Codigo_txt" require="">
            </div>

            <div class="form-group col-md-6">
            <label for="">Cedula:</label>
            <input type="text" class="form-control" name="Ced_txt" required value="<?php echo $cedula;?>" placeholder="" id="Ced_txt" require="">
            </div>

            <label for="">Nombre(s):</label>
            <input type="text" class="form-control" name="Nom_txt" required value="<?php echo $nombre ;?>"  placeholder="" id="Nom_txt" require="">
            <br>
            <label for="">Apellido:</label>
            <input type="text" class="form-control" name="Ape_txt"  required value="<?php echo $apellido;?>" placeholder="" id="Ape_txt" require="">
           
            <div class="form-group col-md-6">
            <br>
            <label for="">Edad:</label>
            <input type="number" class="form-control" name="Edad_txt" required value="<?php echo $edad ;?>" placeholder="" id="Edad_txt" require="">
               
            </div>
            <div class="form-group col-md-6"  >
                <br>
            <label for="">Sexo:</label>
            <select id="Sexo_txt" class="form-control" value="<?php echo $sexo ;?>" name="Sexo_txt">
            <option value="Femenino">Femenino</option>
            <option value="Masculino">Masculino</option>   
            </select>
            </div>          
            
            <div class="form-group col-md-8" >           
            <label for="">Correo:</label>
            <input type="email" class="form-control" name="Correo_txt" required value="<?php echo $correo ;?>" placeholder="" id="Correo_txt" require="">            
             
            </div> 
            <div class="form-group col-md-4">
            <label for="">Telefono:</label>
            <input type="tel" class="form-control" name="Tel_txt" required value="<?php echo $telefono ;?>"  placeholder="" id="Tel_txt" require="">            
            
            </div>
            <div class="form-group col-md-9">
            <label for="">Carrera:</label>
            <input type="text" class="form-control" name="Carrera_txt"  required value="<?php echo $carrera ;?>" placeholder="" id="Carrera_txt" require="">            
            </div>
            <div class="form-group col-md-3">
            <label for="">Semestre:</label>
            
            <select id="Semestre_txt" class="form-control" name="Semestre_txt">
                <option value="1">1</option><option value="2">2</option>
                 <option value="3">3</option><option value="4">4</option>
                <option value="5">5</option><option value="6">6</option>
                <option value="7">7</option><option value="8">8</option>
                <option value="9">9</option><option value="10">10</option>   
            </select>
            </div>

            <br>
            

        </div>
      </div>
      <div class="modal-footer">
      <br>

            <button value="btnAgregar" <?php echo $accionAgregar; ?> class="btn btn-success" type="submit" name="accion">Agregar</button>
            <button value="btnModificar" <?php echo $accionModificar; ?> class="btn btn-warning" type="submit" name="accion">Modificar</button>
            <button value="btnEliminar" <?php echo $accionEliminar; ?> class="btn btn-danger" type="submit" name="accion">Eliminar</button>
            <button value="btnCancelar" <?php echo $accionCancelar; ?> class="btn btn-primary" type="submit" name="accion">Cancelar</button>
      </div>
    </div>
  </div>
</div>

            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Agregar Estudiante +
</button>

            
           
        </form>
<br>


        <div class="row col-md-12">
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>Codigo</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Coreo</th>
                    <th>Telefono</th>
                    <th>Carrera</th>
                    <th>Semestre</th>
                    <th></th>
                </tr>
                </thead>
            <?php foreach($listaAlumnos as $alumno) { ?>
                <tr>
                    <td><?php echo$alumno['cod_estudiante'] ?> </td>
                    <td><?php echo $alumno['cedula'] ?></td>
                    <td><?php echo $alumno['nombres'] ?></td>
                    <td><?php echo $alumno['apellidos'] ?></td>
                    <td><?php echo $alumno['edad'] ?></td>
                    <td><?php echo $alumno['sexo'] ?></td>
                    <td><?php echo $alumno['correo'] ?></td>
                    <td><?php echo $alumno['telefono'] ?></td>
                    <td><?php echo $alumno['carrera'] ?></td>
                    <td><?php echo $alumno['semestre'] ?></td>
                    <td>
                    
                    
                    
                    <form action="#" method="post">

                    <input type="hidden" name="Codigo_txt" value="<?php echo $alumno['cod_estudiante'] ?>">
                    <input type="hidden" name="Ced_txt" value="<?php echo $alumno['cedula'] ?>">
                    <input type="hidden" name="Nom_txt" value="<?php echo $alumno['nombres'] ?>">
                    <input type="hidden" name="Ape_txt" value="<?php echo $alumno['apellidos'] ?>">
                    <input type="hidden" name="Edad_txt" value="<?php echo $alumno['edad'] ?>" >
                    <input type="hidden" name="Sexo_txt" value="<?php echo $alumno['sexo'] ?>" >
                    <input type="hidden" name="Correo_txt" value="<?php echo $alumno['correo'] ?>" >
                    <input type="hidden" name="Tel_txt" value="<?php echo $alumno['telefono'] ?>">
                    <input type="hidden" name="Carrera_txt" value="<?php echo $alumno['carrera'] ?>">
                    <input type="hidden" name="Semestre_txt" value="<?php echo $alumno['semestre'] ?>">

                    <button value="Seleccionar" type="submit" class="seleccionar btn btn-success" name="accion"><i class="far fa-check-circle"></i></button>
                   
                    </form>


                    </td>
                </tr>
            <?php }?>
            </table>
        </div>
        
      
              
               
     

  
