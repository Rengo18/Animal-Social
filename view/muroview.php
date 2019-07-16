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
              <img src=<?php if(isset($imagen_perfil)){ echo $imagen_perfil;}?> alt="" class="avatar-pequeño" width="45" height="40" >
              <a href="<?php echo $helper->url('perfil','index');?>" class="text-nav"><span ><?php if(isset($UsuarioNombre)){echo $UsuarioNombre;}?></span></a> 
        </div>
        <div class="colum-barra">
             <a href="<?php echo $helper->url('muro','renderPublicacion');?>" class="text-nav"><span >Muro</span></a>
        </div>
        <div class="colum-barra">
            <a href="<?php echo $helper->url('muro','mostrarRelaciones');?>" class="img-hover"><img src="img/friends.svg" alt="Amistad" width="40" height="40" ></a>
        </div>    
        
        <div class="colum-barra">
            <form action="<?php echo $helper->url('Muro','CerrarSecion'); ?>" method="Post">
                <input type="submit" value="Cerrar Sesión" name="cerrar" class="btn-cerrar">
            </form>
        </div>
        
     </section>
     <!-- Fin Nav -->
     <!-- Buscador left -->
     
    <form action="<?php echo $helper->url('Muro','buscarPublicacion'); ?>" method="POST" > 
   <section class="Buscardor-container">
        <div >
               <input type="search" name="buscarpost" placeholder="Buscar post" class="input-buscarpost" >
               <input type="submit" value=" " class="btn-buscarpost">
         </div>
         <div >
             <input type="radio" id="titulo" name="titulo" value="titulo" class="radio-post" ><label for="" class="text-buscadorpost">Titulo</label>
             <br>
             <input type="radio" id="palabraClave" name="palabraclave" value="palabraclave" class="radio-post" ><label for="" class="text-buscadorpost">Palabra Clave</label>
             <br>
             <input type="radio" id="rangoFecha" name="rangofecha" id="" value="rangofecha" class="radio-post" onclick="mostrarRangoFecha()"><label for="" class="text-buscadorpost">Rango de fecha</label>
             <br>
         </div>
         <div id="fechas" class="not-fechas" >
             <label for="" class="text-fecha">Desde</label ><br>
                
                 <select id="diaD" name="diaD">
                    
                 </select>
                 <select  id="mesD" name="mesD" >

                 </select>
                 <select  id="añoD" name="añoD">
                    
                 </select><br><br>
            <label for="" class="text-fecha" >Hasta</label><br>
                
                  <select  id="diaH" name="diaH">
                    
                 </select>
                 <select  id="mesH" name="mesH">
                
                 </select>
                 <select  id="añoH" name="añoH">
                     
                 </select><br><br>

         </div>
            </section>
    </form>
   <!-- FIN Buscador left -->

   


 <!-- crear publicar  -->

     <form action="<?php echo $helper->url('muro','crearPublicacion');?>" method="POST" enctype="multipart/form-data">
   
      <section class="publicacion-container ">
     
          <div >
              <span class="text-publicacion">Crear Publicacion</span>
              <select name="visibilidad" id="" class="cb-visibilidad">
                  <option value="publico">Publico</option>
                  <option value="SoloAmigos">Solo Amigos</option>
              </select>
          </div>
          <div >
          <?php if(isset($_POST['publicar'])){if(isset($errorPalabraClave)){echo "<span class='error error-right-md'>$errorPalabraClave</span>";}}?><br>
            <?php if(isset($_POST['publicar'])){if(isset($errorTitulo)){echo "<span class='error error-right-md'>$errorTitulo</span>";}}?><br>
              <input type="text" class="input-text" name="titulo" placeholder="Titulo..." value="<?php if(isset($_POST['publicar'])){if(isset($titulo)){echo $titulo; }}?>">
          </div>
          <div >
           <?php if(isset($_POST['publicar'])){if(isset($errorDescripcion)){echo "<span class='error error-right-md'>$errorDescripcion</span>";}}?><br> 
              <textarea name="descripcion"  cols="50" rows="10" placeholder="¿Que estas pensando?" class="descripcion-publicacion" ><?php if(isset($_POST['publicar'])){if(isset($descripcion)){echo $descripcion; }}?></textarea>
          </div>
          <div>
          
          <input type="radio" name="palabraclave" value="palabraclave" class="text-paalabraclave" id="palabra-clave" onclick="mostrarpalabrasclaves()"> <label for="" class="text-paalabraclave">Agregar Palabra Clave</label>
          </div>     
          
          <div class="palabrasClaves-not" id="text-palabraClave" >
              <input type="text" placeholder="#palabra1" class="input-textpalabra" name="palabra1" <?php if(isset($_POST['publicar'])){if(isset($palabraclave1)){echo 'value='.$palabraclave1; }}?> ><input type="text" placeholder="#palabra2" class="input-textpalabra" name="palabra2" <?php if(isset($_POST['publicar'])){if(isset($palabraclave2)){echo 'value='.$palabraclave2; }} ?>><input type="text" placeholder="#palabra3" class="input-textpalabra" name="palabra3" <?php if(isset($_POST['publicar'])){if(isset($palabraclave3)){echo 'value='.$palabraclave3;  }} ?>>
           </div>
           <div class="add" id="add">
           <label for="file-img" class="imgan-publicacion">
            <input type="file" id="file-img" class="input-file"  name="file-img[]" multiple><img src="img/Add-image.svg"  alt="Cargar imagen" width="30" height="30"></label>
            <label for="adjunto" class="imgan-publicacion" >  
             <input type="file" id="adjunto" class="input-file" name="adjunto"> <img src="img/adjunto.svg"   alt="adjuntar Archivo"  width="30" height="30"></label> 
          </div>
          <div id = "preview-images">
             
          </div>
          <div id="previewArchivo">
  
          </div>
          <div class="" id="boton-publicar">
              <input type="submit" class="btn-submit " name="publicar" value="Publicar">
          </div>
          <?php if(isset($_POST['publicar'])){if(isset($errorimagen)){echo "<span class='error error-right-md'>$errorimagen</span>";}}?><br>
          <?php if(isset($_POST['publicar'])){if(isset($errorArchivo)){echo "<span class='error error-right-md'>$errorArchivo</span>";}}?><br>
          
                 
 
</section> 
</form>


<!-- fin  crear publicacion -->
<!-- publicaciones -->


<?php 
 echo "<div class='pub'>";
  if(isset($publicacionesPublicas)){
  while($obj=$publicacionesPublicas->fetch_object()) {
      
    
 echo "<section class='publicado-container'>
        <div >
             <img src='$obj->imagen_perfil' alt='avatar' width='60' height='60' class='avatar-publicacion'> 
             <span class='nombre-publicacion'>".$obj->nombre." ".$obj->apellido."</span><br>
            <span class='fecha-publicado'>".$obj->fecha."</span>";
            if($id_usuario!=$obj->id_usuario){
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
        if(isset($comentarios)){
          foreach ($comentarios as $key => $value) {
            if($obj->id_post==$value->id_publicacion){
                 echo  "<div class='comentarios-container'>
                 <img src=".$value->imagen_perfil." alt='logo' class='logo-comentario'>
                   <span class='nombre-comentador'>".$value->nombre. " ".$value->apellido."</span><br>
                       <span class='fecha-comentador'>".$value->fecha."</span>
                       <p class='texto-comentador'>".$value->descripcion."</p>";
                   if($id_usuario!=$value->id_usuario){
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
        }            
       
if($id_usuario!=$obj->id_usuario){                      
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
        
        
 
              
            
    
                       
                  
                     
          
   
       }}

   
       
         
         echo "</div>";  
         
         ?>
<!-- publicaciones SoloAmigos -->
<?php 
 echo "<div class='pub'>";
  if(isset($publicacionesSoloAmigos)){
  while($obj=$publicacionesSoloAmigos->fetch_object()) {
    if($obj->id_usuario==$id_usuario){

      echo "<section class='publicado-container'>
      <div >
           <img src=".$obj->imagen_perfil." alt='avatar' width='60' height='60' class='avatar-publicacion'> 
           <span class='nombre-publicacion'>".$obj->nombre." ".$obj->apellido."</span><br>
          <span class='fecha-publicado'>".$obj->fecha."</span>";
          if($id_usuario!=$obj->id_usuario){
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
                    if($id_usuario!=$value->id_usuario){
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
if($id_usuario!=$obj->id_usuario){                      
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
    
    
    if(isset($relacionesSolicitadas)){ 
      foreach ($relacionesSolicitadas as $key => $relacionesS) {
        if($obj->id_usuario==$relacionesS->id_usuario_recibe || $obj->id_usuario==$relacionesS->id_usuario_solicita){

          echo "<section class='publicado-container'>
          <div >
               <img src=".$obj->imagen_perfil." alt='avatar' width='60' height='60' class='avatar-publicacion'> 
               <span class='nombre-publicacion'>".$obj->nombre." ".$obj->apellido."</span><br>
              <span class='fecha-publicado'>".$obj->fecha."</span>";
              if($id_usuario!=$obj->id_usuario){
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
                        if($id_usuario!=$value->id_usuario){
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
  if($id_usuario!=$obj->id_usuario){                      
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




      }}//termina el primer foreach
    if($relacionesRecibidas){ 
      foreach ($relacionesRecibidas as $key => $relacionesR) {
        if($obj->id_usuario==$relacionesR->id_usuario_solicita || $obj->id_usuario==$relacionesR->id_usuario_recibe ){

          echo "<section class='publicado-container'>
          <div >
               <img src=".$obj->imagen_perfil." alt='avatar' width='60' height='60' class='avatar-publicacion'> 
               <span class='nombre-publicacion'>".$obj->nombre." ".$obj->apellido."</span><br>
              <span class='fecha-publicado'>".$obj->fecha."</span>";
              if($id_usuario!=$obj->id_usuario){
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
                        if($id_usuario!=$value->id_usuario){
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
  if($id_usuario!=$obj->id_usuario){                      
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





        
        }}//termina el segundo foreach
              
            
    
                       
                  
                     
          
   
       }
      
      }

   
       
         
         echo "</div>";  
         
         ?>




























    <?php 
 echo "<div class='pub'>";
  if(isset($publicacionesBuscada)){
  while($obj=$publicacionesBuscada->fetch_object()) {
      
    
 echo "<section class='publicado-container'>
        <div >
             <img src=".$obj->imagen_perfil." alt='avatar' width='60' height='60' class='avatar-publicacion'> 
             <span class='nombre-publicacion'>".$obj->nombre." ".$obj->apellido."</span><br>
            <span class='fecha-publicado'>".$obj->fecha."</span>";
            if($id_usuario!=$obj->id_usuario){
           echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#Publicacion'>
           <img src='img/prohibido-mascotas.svg' alt='denunciar' class='denuncia-imagen'>
          </button>";
            }
        echo"</div>
        <div class='titulo-publicado'><span >".$obj->titulo."</span></div>
        <div class='descripcion-publicado'>
            <span >".$obj->descripcion."</span>
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
                      if($id_usuario!=$value->id_usuario){
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
if($id_usuario!=$obj->id_usuario){                      
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
        
        
 
              
            
    
                       
                  
                     
          
   
       }}

   
       
         
         echo "</div>";  
         
         ?>
    
    
  }
</body>
<script  src="js/muro.js"></script> 
</html>  

