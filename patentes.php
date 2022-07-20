<?php include("template/navbar/navbar.php"); ?>

<?php
include("administrador/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM patente_i");
$sentenciaSQL->execute();
$listaPatentes = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($listaPatentes as $patente){ ?>
<div class="col-md-3">

    <div class="card">
        <img class="card-img-top" src="./archivos/<?php echo $patente['arch_p']; ?>" alt="">
        <div class="card-body">
            <h4 class="card-title"><?php echo $patente['denominacion_p']; ?></h4>
            <h5 class="card-title"><?php echo $patente['titular_p']; ?></h5>
            <a name="" id="" class="btn btn-primary" href="#" role="button">Ver más</a>
        </div>
    </div>
</div>
<?php }?>



<?php include("template/footer/footer.php"); ?>