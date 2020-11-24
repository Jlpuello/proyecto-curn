<?php
require('fpdf/fpdf.php');
require('conexion/conexion.php');
$codProyecto = (isset($_POST['codigo_txt'])) ?$_POST['codigo_txt']:"" ; 

class PDF extends FPDF
    {
    function Header()
    {
    

        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // titulo
        $this->cell(60);
        $this->Cell(70,10,'Reporte del Proyecto',1,0,'C');
        // Salto de línea
        $this->Ln(20);
    }

    function Footer()
    {
        // Posición a 1,5 cm del final
        $this->SetY(-15);
        // Arial itálica 8
        $this->SetFont('Arial','I',8);
        // Color del texto en gris
        $this->SetTextColor(128);
        // Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
    }
    }

    $consulta=" ";



    $sentencia = $pdo->prepare("SELECT alumnoProyecti.cod_alumno, alumnos.nombres, alumnos.apellidos , alumnos.carrera, alumnos.semestre
    FROM alumnoProyecti
    INNER JOIN alumnos ON alumnoProyecti.cod_alumno=alumnos.cod_estudiante
    WHERE alumnoProyecti.cod_proyecto=$codProyecto;");
    $sentencia->execute();
    $listaAlumnos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia = $pdo->prepare("SELECT docentes.cod_docente, docentes.nombre , docentes.apellido , roldocente.rol FROM roldocente INNER JOIN docentes
    ON roldocente.cod_profesor=docentes.cod_docente WHERE roldocente.cod_proyecto=$codProyecto;");
    $sentencia->execute();
    $listaDocentes = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $sentencia = $pdo->prepare("SELECT proyectos.cod_proyecto, proyectos.nombre, proyectos.lineaInvestigacion, docentes.nombre as nombreDocente, proyectos.cod_docente, proyectos.fechaInicio, proyectos.fechaEntrega, proyectos.fechaActualizacion, proyectos.campus, proyectos.estadoProyecto
    FROM proyectos INNER JOIN docentes
    ON proyectos.cod_docente=docentes.cod_docente WHERE proyectos.cod_proyecto=$codProyecto;");
    $sentencia->execute();
    $listaProyecto = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);

    $pdf->Cell(67,10,'Grupo de Investigacion',1,1,'C');

    $pdf->cell(20, 10, 'codigo', 1, 0, 'c', 0);
    $pdf->cell(47, 10, 'Nombre', 1, 0, 'c', 0);
    $pdf->cell(53, 10, 'Apellidos', 1, 0, 'c', 0);
    $pdf->cell(65, 10, 'Carrera', 1, 0, 'c', 0);
    $pdf->cell(10, 10, 'sem', 1, 1, 'c', 0);

    foreach($listaAlumnos as  $row){




        $pdf->cell(20, 10, $row['cod_alumno'], 1, 0, 'c', 0);
        $pdf->cell(47, 10, $row['nombres'], 1, 0, 'c', 0);
        $pdf->cell(53, 10, $row['apellidos'], 1, 0, 'c', 0);
        $pdf->cell(65, 10, $row['carrera'], 1, 0, 'c', 0);
        $pdf->cell(10, 10, $row['semestre'], 1, 1, 'c', 0);
    

    }

    $pdf->Ln(10);
    $pdf->Cell(67,10,'Rol de Docentes',1,1,'C');

    $pdf->cell(20, 10, 'codigo', 1, 0, 'c', 0);
    $pdf->cell(47, 10, 'Nombre', 1, 0, 'c', 0);
    $pdf->cell(47, 10, 'Apellido', 1, 0, 'c', 0);
    $pdf->cell(30, 10, 'rol', 1, 1, 'c', 0);

    foreach($listaDocentes as $row){

        $pdf->cell(20, 10, $row['cod_docente'], 1, 0, 'c', 0);
        $pdf->cell(47, 10, $row['nombre'], 1, 0, 'c', 0);
        $pdf->cell(47, 10, $row['apellido'], 1, 0, 'c', 0);
        $pdf->cell(30, 10, $row['rol'], 1, 1, 'c', 0);

    }

    $pdf->Ln(10);

    foreach($listaProyecto as $row){

        $pdf->cell(50, 10, 'Codigo Del Proyecto', 1, 0, 'c', 0);
        $pdf->cell(60, 10, $row['cod_proyecto'], 1, 1, 'c', 0);

    

        $pdf->cell(50, 10, 'Nombre', 1, 0, 'c', 0);
        $pdf->cell(60, 10, 'Linea De Investigaciopn', 1, 0, 'c', 0);
        $pdf->cell(47, 10, 'Nombre del Docente', 1, 0, 'c', 0);
        $pdf->cell(30, 10, 'Codigo', 1, 1, 'c', 0);
        $pdf->cell(50, 10, $row['nombre'], 1, 0, 'c', 0);
        $pdf->cell(60, 10, $row['lineaInvestigacion'], 1, 0, 'c', 0);
        $pdf->cell(47, 10, $row['nombreDocente'], 1, 0, 'c', 0);
        $pdf->cell(30, 10, $row['cod_docente'], 1, 1, 'c', 0);

        $pdf->Ln(10);

        $pdf->cell(35, 10, 'Fecha de Inicio', 1, 0, 'c', 0);
        $pdf->cell(50, 10, 'Fecha de Entrega ', 1, 0, 'c', 0);
        $pdf->cell(70, 10, 'Fecha de la Ultima Actulizacion ', 1, 1, 'c', 0);
        $pdf->cell(35, 10, $row['fechaInicio'], 1, 0, 'c', 0);
        $pdf->cell(50, 10, $row['fechaEntrega'], 1, 0, 'c', 0);
        $pdf->cell(70, 10,'', 1, 1, 'c', 0);

    

        $pdf->cell(35, 10, 'Campus', 1, 0, 'c', 0);
        $pdf->cell(50, 10, 'Estado Del Proyecto ', 1, 1, 'c', 0);
        $pdf->cell(35, 10, $row['campus'], 1, 0, 'c', 0);
        $pdf->cell(50, 10, $row['estadoProyecto'], 1, 1, 'c', 0);

    }

    $pdf->Output();
?>