<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/moderador.css">
    <title>Moderador</title>
</head>
<body>
    <!-- NAV -->
    
    <section class="nav-container">
            <div class="colum"><img src="img/logoSolo.svg" alt="logo" width="50" height="50"></div>
            <div></div>
            <div class="colum">
                 
                  <a href="" class="text-nav"><span ><?php if(isset($UsuarioNick)){echo $UsuarioNick;}?></span></a> 
            </div>
           <div class="colum-barra">
                <form action="<?php echo $helper->url('muromoderador','CerrarSecion'); ?>">
                    <input type="submit" value="Cerrar Sesión" name="cerrar" class="btn-cerrar">
                </form>
            </div>
            
         </section>
         <!-- Fin Nav -->
         <!-- lista denuncia publicacion -->
         <div class="cajapublicacion">
          <span class="titulopublicaciones">Publicaciones Denunciadas</span>
      <section class="publicaciondenuncia-container">
             <div><img src="../imagenes/Martin_Colombo.png" alt="foto" class="imagen-denuncia"></div>
             <div><span class="nombre-denuncia">Franco Martin Colombo</span><br>
                  <span class="text-denuncia">Denuncia la publicacion de: </span><br>
                   <span class="descripcion-denuncia">Nombre:Valeria Alejandra Veneciano </span><br>
                    <span class="descripcion-denuncia"> Motivo:mal vocabulario. </span><br>
                   <span class="descripcion-denuncia"> Fecha de la denuncia: 10/06/2019. </span><br>
                <form action="" method="POST">
                    <input type="submit" value="Moderar" name="moderar" class="btn-moderar">
                </form>
            </div>        
                  
        </section> 
        <section class="publicaciondenuncia-container">
                <div><img src="../imagenes/Martin_Colombo.png" alt="foto" class="imagen-denuncia"></div>
                <div><span class="nombre-denuncia">Franco Martin Colombo</span><br>
                     <span class="text-denuncia">Denuncia la publicacion de: </span><br>
                      <span class="descripcion-denuncia">Nombre:Valeria Alejandra Veneciano </span><br>
                       <span class="descripcion-denuncia"> Motivo:mal vocabulario. </span><br>
                      <span class="descripcion-denuncia"> Fecha de la denuncia: 10/06/2019. </span><br>
                   <form action="" method="POST">
                       <input type="submit" value="Moderar" name="moderar" class="btn-moderar">
                   </form>
               </div>        
                     
           </section>
           <section class="publicaciondenuncia-container">
                <div><img src="../imagenes/Martin_Colombo.png" alt="foto" class="imagen-denuncia"></div>
                <div><span class="nombre-denuncia">Franco Martin Colombo</span><br>
                     <span class="text-denuncia">Denuncia la publicacion de: </span><br>
                      <span class="descripcion-denuncia">Nombre:Valeria Alejandra Veneciano </span><br>
                       <span class="descripcion-denuncia"> Motivo:mal vocabulario. </span><br>
                      <span class="descripcion-denuncia"> Fecha de la denuncia: 10/06/2019. </span><br>
                   <form action="" method="POST">
                       <input type="submit" value="Moderar" name="moderar" class="btn-moderar">
                   </form>
               </div>        
                     
           </section>   
           <section class="publicaciondenuncia-container">
                <div><img src="../imagenes/Martin_Colombo.png" alt="foto" class="imagen-denuncia"></div>
                <div><span class="nombre-denuncia">Franco Martin Colombo</span><br>
                     <span class="text-denuncia">Denuncia la publicacion de: </span><br>
                      <span class="descripcion-denuncia">Nombre:Valeria Alejandra Veneciano </span><br>
                       <span class="descripcion-denuncia"> Motivo:mal vocabulario. </span><br>
                      <span class="descripcion-denuncia"> Fecha de la denuncia: 10/06/2019. </span><br>
                   <form action="" method="POST">
                       <input type="submit" value="Moderar" name="moderar" class="btn-moderar">
                   </form>
               </div>        
                     
           </section>             
          
            
        </div>    
         <!-- Fin lista denuncia publicacion -->  
          <!-- lista denuncia comentario  -->
         <div class="comentariodenuncia">
                <span class="titulopublicaciones">Comentario Denunciadas</span>
                <section class="publicaciondenuncia-container">
                        <div><img src="../imagenes/Martin_Colombo.png" alt="foto" class="imagen-denuncia"></div>
                        <div><span class="nombre-denuncia">Franco Martin Colombo</span><br>
                             <span class="text-denuncia">Denuncia la publicacion de: </span><br>
                              <span class="descripcion-denuncia">Nombre:Valeria Alejandra Veneciano </span><br>
                               <span class="descripcion-denuncia"> Motivo:mal vocabulario. </span><br>
                              <span class="descripcion-denuncia"> Fecha de la denuncia: 10/06/2019. </span><br>
                           <form action="" method="POST">
                               <input type="submit" value="Moderar" name="moderar" class="btn-moderar">
                           </form>
                       </div>        
                             
                   </section>   
                   <section class="publicaciondenuncia-container">
                        <div><img src="../imagenes/Martin_Colombo.png" alt="foto" class="imagen-denuncia"></div>
                        <div><span class="nombre-denuncia">Franco Martin Colombo</span><br>
                             <span class="text-denuncia">Denuncia la publicacion de: </span><br>
                              <span class="descripcion-denuncia">Nombre:Valeria Alejandra Veneciano </span><br>
                               <span class="descripcion-denuncia"> Motivo:mal vocabulario. </span><br>
                              <span class="descripcion-denuncia"> Fecha de la denuncia: 10/06/2019. </span><br>
                           <form action="" method="POST">
                               <input type="submit" value="Moderar" name="moderar" class="btn-moderar">
                           </form>
                       </div>        
                             
                   </section>  
                   <section class="publicaciondenuncia-container">
                        <div><img src="../imagenes/Martin_Colombo.png" alt="foto" class="imagen-denuncia"></div>
                        <div><span class="nombre-denuncia">Franco Martin Colombo</span><br>
                             <span class="text-denuncia">Denuncia la publicacion de: </span><br>
                              <span class="descripcion-denuncia">Nombre:Valeria Alejandra Veneciano </span><br>
                               <span class="descripcion-denuncia"> Motivo:mal vocabulario. </span><br>
                              <span class="descripcion-denuncia"> Fecha de la denuncia: 10/06/2019. </span><br>
                           <form action="" method="POST">
                               <input type="submit" value="Moderar" name="moderar" class="btn-moderar">
                           </form>
                       </div>        
                             
                   </section> 
                   <section class="publicaciondenuncia-container">
                        <div><img src="../imagenes/Martin_Colombo.png" alt="foto" class="imagen-denuncia"></div>
                        <div><span class="nombre-denuncia">Franco Martin Colombo</span><br>
                             <span class="text-denuncia">Denuncia la publicacion de: </span><br>
                              <span class="descripcion-denuncia">Nombre:Valeria Alejandra Veneciano </span><br>
                               <span class="descripcion-denuncia"> Motivo:mal vocabulario. </span><br>
                              <span class="descripcion-denuncia"> Fecha de la denuncia: 10/06/2019. </span><br>
                           <form action="" method="POST">
                               <input type="submit" value="Moderar" name="moderar" class="btn-moderar">
                           </form>
                       </div>        
                             
                   </section>   


         </div>       
                     
                                      
                          
        
       
        
         
   
    
</body>
</html>