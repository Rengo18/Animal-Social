<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/perfil.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script  src="js/registrar.js"></script>
    <title>Perfil</title>
</head>
<body onload="CargarFechas();">
    
<!-- NAV -->
    
<section class="nav-container">
        <div class="colum"><img src="img/logoSolo.svg" alt="logo" width="50" height="50"></div>
        <div class="colum">
        <form action="<?php echo $helper->url('muro','renderUserBusqueda');?>" method="POST">
                <input type="search" placeholder="Buscar Amigo" name="nombreBuscador" class="input-search" >
                <input type="submit" value=" " class="btn-buscar" name="buscar">
                
            </form>
        </div>
        <div class="colum">
              <img src="<?php if(isset($imagen_perfil)){ echo $imagen_perfil;}?>" alt="" class="avatar-pequeño" width="45" height="40" >
              <a href="<?php echo $helper->url('perfil','index');?>" class="text-nav"><span ><?php if(isset($UsuarioNombre)){echo $UsuarioNombre;}  ?></span></a> 
        </div>
        <div class="colum-barra">
             <a href="<?php echo $helper->url('Muro','renderPublicacion'); ?>" class="text-nav"><span >Muro</span></a>
        </div>
        <div class="colum-barra">
            <a href="<?php echo $helper->url('muro','mostrarRelaciones');?>" class="img-hover"><img src="img/friends.svg" alt="Amistad" width="40" height="40" ></a>
            
        </div>
        <div class="colum-barra">
            <form action="<?php echo $helper->url('Muro','CerrarSecion'); ?>">
                <input type="submit" value="Cerrar Sesión" name="cerrar" class="btn-cerrar">
            </form>
        </div>
        
     </section>
     <!-- Fin Nav -->
<?php 
if($objt=$elusuario->fetch_object()){
 echo "<div class='elementosAEditar'>
     <p>telefono: ".$objt->telefono."</p>
    
    <p>Fecha Nacimiento : ".$objt->FechaNacimiento."</p>
    <span>imagen de Perfil:</span><br>
    <img src=".$objt->imagen_perfil." alt='avatar' class='avatar-perfil-editar' width='45' height='40' >
    </div>";}

?>
    <form action='<?php echo $helper->url('perfil','EditarPerfil');?>' method='POST' class='form-editar' enctype='multipart/form-data'>
    <h4 class='titulo-editar'>si quiere cambiar la foto de perfil seleccione 1 :)</h4>
     <?php if(isset($errorimagen)){echo "<span class='error'>$errorimagen</span>";}?>
    <input type='file' name='foto-perfil' >
    <input type='text' name='telefeno' class='input-text-editar' placeholder='telefono'>
    <label for='' class='label-text'>Fecha de Nacimiento</label><br>
      <span class='span-fecha'>Dia</span><span class='span-fecha'>Mes</span><span class='span-fecha'>Año</span><br>
      <select  id='dia' name='dia' >
      </select>
 
      <select  id='mes' name='mes' onchange='Mesesdia();'>
      </select>
             
     <select  id='año' name='año'>
     </select><br><br>
    <input type='submit' name='editar' class='btn-editar' value='editar'>
 
     </form>





   
    




    
     </body>
</html>