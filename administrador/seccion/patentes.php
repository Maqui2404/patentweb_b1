<?php include("../template/navbar_admin.php") ?>
<?php

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtDENOMINACION = (isset($_POST['txtDENOMINACION'])) ? $_POST['txtDENOMINACION'] : "";
$txtTITULAR = (isset($_POST['txtTITULAR'])) ? $_POST['txtTITULAR'] : "";
$txtCOLABORADORES = (isset($_POST['txtCOLABORADORES'])) ? $_POST['txtCOLABORADORES'] : "";
$txtPAIS = (isset($_POST['txtPAIS'])) ? $_POST['txtPAIS'] : "";
$txtCLASIFICACION = (isset($_POST['txtCLASIFICACION'])) ? $_POST['txtCLASIFICACION'] : "";
$txtLINK = (isset($_POST['txtLINK'])) ? $_POST['txtLINK'] : "";
$txtINSTITUCION = (isset($_POST['txtINSTITUCION'])) ? $_POST['txtINSTITUCION'] : "";
$arch = (isset($_FILES['arch']['name'])) ? $_FILES['arch']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/bd.php");

switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO patente_i (denominacion_p,titular_p,colaboradores_p,pais_p,clasificacion_p,link_p,institucion_p,arch_p) VALUES (:denominacion_p,:titular_p,:colaboradores_p,:pais_p,:clasificacion_p,:link_p,:institucion_p,:arch_p);");
        $sentenciaSQL->bindParam(':denominacion_p', $txtDENOMINACION);
        $sentenciaSQL->bindParam(':titular_p', $txtTITULAR);
        $sentenciaSQL->bindParam(':colaboradores_p', $txtCOLABORADORES);
        $sentenciaSQL->bindParam(':pais_p', $txtPAIS);
        $sentenciaSQL->bindParam(':clasificacion_p', $txtCLASIFICACION);
        $sentenciaSQL->bindParam(':link_p', $txtLINK);
        $sentenciaSQL->bindParam(':institucion_p', $txtINSTITUCION);
        $sentenciaSQL->bindParam(':arch_p', $arch);
        $sentenciaSQL->execute();
        break;

    case "Modificar":
        echo "Presionado botón Modificar";
        break;

    case "Cancelar":
        echo "Presionado botón Cancelar";
        break;
    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM patente_i WHERE id_p=:id_p");
        $sentenciaSQL->bindParam(':id_p', $txtID);
        $sentenciaSQL->execute();
        $patente=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtDENOMINACION=$patente['denominacion_p'];
        $txtTITULAR=$patente['titular_p'];
        $txtCOLABORADORES=$patente['colaboradores_p'];
        $txtPAIS=$patente['pais_p'];
        $txtCLASIFICACION=$patente['clasificacion_p'];
        $txtLINK=$patente['link_p'];
        $txtINSTITUCION=$patente['institucion_p'];
        $arch=$patente['arch_p'];


        //echo "Presionado botón Seleccionar";
        break;
    case "Borrar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM patente_i WHERE id_p=:id_p");
        $sentenciaSQL->bindParam(':id_p', $txtID);

        $sentenciaSQL->execute();
        //echo "Presionado botón Borrar";
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM patente_i");
$sentenciaSQL->execute();
$listaPatentes = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>


<div class="col-md-5">

    <div class="card">
        <div class="card-header">
            Datos de Patentes
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">


                <div class="form-group">
                    <label for="txtID">ID</label>
                    <input type="text" name="txtID" value="<?php echo $txtID; ?>" class="form-control" id="txtID" placeholder="Enter ID">
                </div>


                <div class="form-group">
                    <label for="txtDENOMINACION">DENOMINACION</label>
                    <input type="text" name="txtDENOMINACION" value="<?php echo $txtDENOMINACION; ?> class="form-control" id="txtDENOMINACION" placeholder="Enter DENOMINACION">
                </div>


                <div class="form-group">
                    <label for="txtTITULAR">TITULAR</label>
                    <input type="text" name="txtTITULAR" value="<?php echo $txtTITULAR; ?> class="form-control" id="txtTITULAR" placeholder="Enter TITULAR">
                </div>


                <div class="form-group">
                    <label for="txtCOLABORADORES">COLABORADORES</label>
                    <input type="text" name="txtCOLABORADORES" value="<?php echo $txtCOLABORADORES; ?> class="form-control" id="txtCOLABORADORES" placeholder="Enter COLABORADORES">
                </div>


                <div class="form-group">
                    <label for="txtPAIS">PAIS</label>
                    <input type="text" value="<?php echo $txtPAIS; ?> name="txtPAIS" class="form-control" id="txtPAIS" placeholder="Enter PAIS">
                </div>


                <div class="form-group">
                    <label for="txtCLASIFICACION">CLASIFICACION</label>
                    <input type="text" value="<?php echo $txtCLASIFICACION; ?> name="txtCLASIFICACION" class="form-control" id="txtCLASIFICACION" placeholder="Enter CLASIFICACION">
                </div>


                <div class="form-group">
                    <label for="txtLINK">LINK</label>
                    <input type="text" value="<?php echo $txtLINK; ?> name="txtLINK" class="form-control" id="txtLINK" placeholder="Enter LINK">
                </div>


                <div class="form-group">
                    <label for="txtINSTITUCION">INSTITUCION</label>
                    <input type="text" value="<?php echo $txtINSTITUCION; ?> name="txtINSTITUCION" class="form-control" id="txtINSTITUCION" placeholder="Enter INSTITUCION">
                </div>


                <div class="form-group">
                    <label for="arch">Archivo</label>
                    <?php echo $arch; ?>
                    <input type="file" class="form-control" name="arch" id="arch" placeholder="arch">
                </div>


                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>

    </div>





</div>

<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>DENOMINACION</th>
                <th>TITULAR</th>
                <th>COLABORADORES</th>
                <th>PAIS</th>
                <th>CLASIFICACION</th>
                <th>LINK</th>
                <th>INSTITUCION</th>
                <th>ARCHIVO</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaPatentes as $patente) { ?>
                <tr>

                    <td><?php echo $patente['id_p']; ?></td>
                    <td><?php echo $patente['denominacion_p']; ?></td>
                    <td><?php echo $patente['titular_p']; ?></td>
                    <td><?php echo $patente['colaboradores_p']; ?></td>
                    <td><?php echo $patente['pais_p']; ?></td>
                    <td><?php echo $patente['clasificacion_p']; ?></td>
                    <td><?php echo $patente['link_p']; ?></td>
                    <td><?php echo $patente['institucion_p']; ?></td>
                    <td><?php echo $patente['arch_p']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID" id="image.png" value="<?php echo $patente['id_p']; ?>" />

                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />

                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />
                        </form>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php include("../template/footer_admin.php") ?>