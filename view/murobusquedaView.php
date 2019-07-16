<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/muro.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <title>Muro</title>
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
              <a href="<?php echo $helper->url('perfil','index');?>" class="text-nav"><span ><?php if(isset($UsuarioNombre)){echo $UsuarioNombre;}?></span></a> 
        </div>
        <div class="colum-barra">
             <a href="<?php echo $helper->url('muro','renderPublicacion');?>" class="text-nav"><span >Muro</span></a>
        </div>
        <div class="colum-barra">
            <a href="" class="img-hover"><img src="img/friends.svg" alt="Amistad" width="40" height="40" ></a>
            
        </div>
        <div class="colum-barra">
            <form action="<?php echo $helper->url('Muro','CerrarSecion'); ?>" method="Post">
                <input type="submit" value="Cerrar Sesión" name="cerrar" class="btn-cerrar">
            </form>
        </div>
        
     </section>

     <?php
     
     if(isset($mensaje)){

          echo "<h1 class='text-not-user'>$mensaje</h1>";


     }
     
     if(isset($rowsUsuarios)){

     while($obj=$rowsUsuarios->fetch_object()) {
       
        echo "<div class='conteiner-perfilUsuario'>
        <img src=".$obj->imagen_perfil." alt='logo' class='logo-user-busqueda'><span class='text-user'>".$obj->nombre.' '.$obj->apellido."</span><br> 
                    <form action=";echo $helper->url('perfil','renderPerfilUser');echo" method='POST'>
                    <input  name='id_usuario' type='hidden' value=".$obj->id_usuario.">
                    <input type='submit' value='VerPerfil'  class='btn-perfil'>
                    </form> 
                </div>";
 
     }
     
    }


     if(isset($relaciones)){

        while($obj=$relaciones->fetch_object()) {
       
            echo "<div class='conteiner-solicitud'>
            <img src='img/vale.jpg' alt='logo' class='logo-user-busqueda'><span class='text-user'>".$obj->nombre.' '.$obj->apellido." Quiere Ser Tu Amigo</span><br> 
                        <form action=";echo $helper->url('perfil','AceptarOCancelarRelacion');echo" method='POST'>
                        <input  name='id_usuario_solicita' type='hidden' value=".$obj->id_usuario_solicita.">
                        <input type='submit' value='Cancelar' name='Cancelar'  class='btn-Cancelar'><input type='submit' value='Aceptar' name='Aceptar' class='btn-Aceptar'>
                        </form>
                    </div><hr class='separacion'>";
     
         }


     }

     if(isset($alerta)){


       echo "<h1 class='text-not-user'>$alerta</h1>";

     }


     ?>
     </body>
<script  src="js/muro.js"></script> 
</html> 