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
    <title>Perfil</title>
</head>
<body>
    
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
if(isset($mensaje)){

  echo "<div class='mensaje-pub'><p >$mensaje</p></div>";

   }
    ?>


<?php 
 echo "<div class='pub'>";
  if(isset($rowP)){
  while($obj=$rowP->fetch_object()) {
      
    
 echo "<section class='publicado-container'>
        <div >
             <img src=".$obj->imagen_perfil." alt='avatar' width='60' height='60' class='avatar-publicacion'> 
             <span class='nombre-publicacion'>".$obj->nombre." ".$obj->apellido."</span><br>
            <span class='fecha-publicado'>".$obj->fecha."</span>";
            if($id!=$obj->id_usuario){
                echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#Publicacion'>
                <img src='img/prohibido-mascotas.svg' alt='denunciar' class='denuncia-imagen'>
               </button>";
                 }
           echo"</div>
        <div class='titulo-publicado'><span >".$obj->titulo."</span></div>
        <div class='descripcion-publicado'>
            ".$obj->descripcion."
        </div>";
        
          
        if($obj->imagen1!=null){
            if($obj->imagen2!=null&& $obj->imagen3!=null){
            echo   "<div >
                <img src=".$obj->imagen1." alt='foto1'  class='imagen-publicacion'><img src=".$obj->imagen2." alt='foto2'  class='imagen-publicacion'><br> <img src=".$obj->imagen3." alt='foto3'  class='imagen-publicacion3'> 
                </div>";}
            if($obj->imagen2!=null&& $obj->imagen3==null){
                echo    "<div >
                <img src=".$obj->imagen1." alt='foto1'  class='imagen-publicacion'><img src=".$obj->imagen2." alt='foto2'  class='imagen-publicacion'> 
                </div>";}
            if($obj->imagen2==null&& $obj->imagen3!=null){
                echo   "<div >
                <img src=".$obj->imagen1." alt='foto1'  class='imagen-publicacion'><img src=".$obj->imagen3." alt='foto2'  class='imagen-publicacion'>
                </div>";}

             if($obj->imagen2==null&& $obj->imagen3==null){
                echo   "<div >
                <img src=".$obj->imagen1." alt='foto1'  class='imagen-publicacion'><br><br><br> 
                </div>";}

            }
         if($obj->palabra_clave_1!=null){
         echo "<div class='flex-hijo'><span class='palabraclave-text'>#".$obj->palabra_clave_1."</span><span class='palabraclave-text'>#".$obj->palabra_clave_2."</span><span class='palabraclave-text'>#".$obj->palabra_clave_3."</span></div><br>";  
         }  
         if($obj->adjunto!=null){
             $nombreAdjunto=basename($obj->adjunto);
         echo  "<img src='img/adjunto.svg' alt='adjunto' class='imagen-adjunto'><a href=".$obj->adjunto." class='adjunto-text'>".$nombreAdjunto."</a>" ;
         }
         
         
        echo "<div class='comentario-container' >
              <form action="; echo $helper->url('muro','CrearComentario');echo" method='POST'>
                   <div>
                     <input id='prodId' name='idPublicacion' type='hidden' value=".$obj->id_post.">
                     <input type='text' name='comentario' placeholder='Comentar..' class='tb-comentar'><input type='submit' class='btn-comentar' value='Comentar'>
                   </div>
                  </form>";
                     
       foreach ($comentarios as $key => $value) {
               if($obj->id_post==$value->id_publicacion){
                    echo  "<div class='comentarios-container'>
                    <img src=".$value->imagen_perfil." alt='logo' class='logo-comentario'>
                      <span class='nombre-comentador'>".$value->nombre. " ".$value->apellido."</span><br>
                          <span class='fecha-comentador'>".$value->fecha."</span>
                          <p class='texto-comentador'>".$value->descripcion."</p>";
                          if($id!=$value->id_usuario){
                            echo  "<button type='button' class='btn btn-primary btn-comentario' data-toggle='modal' data-target='#Comentario'>
                            <img src='img/prohibido-mascotas.svg' alt='denunciar' class='denuncia-imagen'>
                            </button>
                         </div ><br> "; 
              echo "
                     <div class='modal fade' id='Comentario' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                       <div class='modal-dialog modal-dialog-centered' role='document'>
                         <div class='modal-content color-modal-content '>
                           <div class='modal-header color-modal-content'>
                             <h3 class='modal-title' id='exampleModalLongTitle'>Denunciar Comentario</h3>
                             <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                               <span class='letra-x' aria-hidden='true'>&times;</span>
                             </button>
                           </div>
                           <div class='modal-body'>
                            <h5>Escriba el Motivo de su denuncia</h5>
                            <form action=";echo $helper->url('muro','CrearDenuncia');echo" method='POST' class='form-denuncia'>
                                  <input  name='tipo_denuncia' type='hidden' value='comentario'>
                                 <input  name='id_comentario_denunciar' type='hidden' value=".$value->id_comentario.">
                                <textarea name='motivo'  cols='40' rows='5' placeholder='escriba su Motivo' class='descripcion-publicacion' ></textarea>
                                <input type='submit' class='btn-denuncia' value='Denunciar'>
                            </form>
                           </div>
                         </div>
                       </div>
                     </div>";           
                    
                          }
                         
                     }
                       
                   }
            if($id!=$obj->id_usuario){                      
                    echo "
                    <div class='modal fade' id='Publicacion' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                      <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content color-modal-content '>
                          <div class='modal-header color-modal-content'>
                            <h3 class='modal-title' id='exampleModalLongTitle'>Denunciar Publicacion</h3>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                              <span class='letra-x' aria-hidden='true'>&times;</span>
                            </button>
                          </div>
                          <div class='modal-body'>
                           <h5>Escriba el Motivo de su denuncia</h5>
                           <form action=";echo $helper->url('muro','CrearDenuncia');echo" method='POST' class='form-denuncia'>
                               <input  name='tipo_denuncia' type='hidden' value='publicacion'>
                                <input id='prodId' name='id_publicacion_denunciar' type='hidden' value=".$obj->id_post.">
                               <textarea name='motivo'  cols='40' rows='5' placeholder='escriba su Motivo' class='descripcion-publicacion' ></textarea>
                               <input type='submit' class='btn-denuncia' value='Denunciar'>
                           </form>
                          </div>
                        </div>
                      </div>
                    </div>";           
             }           
                  
                     echo   "</section><br>";  
            }
               
                
             
        }
          echo "</div>";  
          
         ?>

   <!-- Perfil -->
    <section class="perfil-container">
    <div >
      <img src="<?php if(isset($imagen_perfil)){ echo $imagen_perfil;}?>" alt="logo-perfil" class="foto-perfil">
      <span class="nombre-perfil"><?php if(isset($usuarioObtenido)) echo $usuarioObtenido->nombre.' '.$usuarioObtenido->apellido; ?></span></div>
    <?php
    if($id==$usuarioObtenido->id_usuario){
       echo  "<form action="; echo $helper->url('perfil','renderEditarPerfil');echo" method='POST'>
         <input type='submit' name='editar' id='editar' hidden><label for='editar'><img src='img/editar.svg' alt='editar' class='editar-imagen'></label>  
        </form>";
    }
    ?>
     <div >
    
    <span class="text-perfil">Email:</span><span class="text"><?php if(isset($usuarioObtenido)) echo $usuarioObtenido->mail; ?></span><br>
            <hr>
            
     </div>
    <div >
            <span class="text-perfil">Telefono:</span><span class="text"><?php if(isset($usuarioObtenido)) echo $usuarioObtenido->telefono; ?></span><br>
            <hr>
    </div>
    <div >
            <span class="text-perfil">Fecha de Nacimiento:</span><span class="text"><?php if(isset($usuarioObtenido)) echo $usuarioObtenido->FechaNacimiento; ?></span><br>
            <hr>
    </div>
    <?php
    
    if($id!=$usuarioObtenido->id_usuario){
        echo "<div>  
    <form action=";echo $helper->url('perfil','CrarRelacion');echo" method='POST'>
          <input  name='id_solicitud' type='hidden' value=".$usuarioObtenido->id_usuario.">
          <input type='submit' class='btn-Amistad' value='amistad'>
    </form>
    </div>";
    }
     ?>
     </section>
    
   
       
   
    
   
    
   
    
    
    



</body>
</html>
