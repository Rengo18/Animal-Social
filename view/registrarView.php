<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Red Social</title>
    <link rel="stylesheet" href="css/registrar.css">
    <link rel="stylesheet" href="css/global.css">
    <script  src="js/registrar.js"></script>
</head>
<body onload="CargarFechas();">
    
<div class="container">

        <div class="colum">
            <img src="img/logo.svg" alt="logo" width="400" height="400">
      </div>
        <div class="colum">
           <form action="<?php echo $helper->url('RegistrarUsuario','registrarUsuario');?>" method="POST" >
            <?php if(isset($_POST['registrar'])){if(isset($errorNombre)){ echo "<span class='error'>$errorNombre</span>";}}?> <?php if(isset($_POST['registrar'])){if(isset($errorApellido)){ echo "<span class='error error-right-md'>$errorApellido</span>";}}?><br>
            <input type="text" class="input-text <?php if(isset($_POST['registrar'])){if(isset($errorNombre)){echo 'error-border';}}?>" placeholder="Nombre" name="nombre" value="<?php if(isset($_POST['registrar'])){if(isset($nombre)){echo $nombre;}}?>">

           
            <input type="text" class="input-text <?php if(isset($_POST['registrar'])){if(isset($errorApellido)){echo 'error-border';}}?>" placeholder="Apellido"  name="apellido"  value="<?php if(isset($_POST['registrar'])){if(isset($apellido)){echo $apellido;}}?>"><br>

            <?php if(isset($_POST['registrar'])){if(isset($errorEmail)){ echo "<span class='error'>$errorEmail</span>";}}?><br>
            <input type="text" class="input-text <?php if(isset($_POST['registrar'])){if(isset($errorEmail)){echo 'error-border';}}?>" placeholder="Email" style="width: 509px;"  name="email"  value="<?php if(isset($_POST['registrar'])){if(isset($email)){echo $email;}}?>"><br>

            <?php if(isset($_POST['registrar'])){if(isset($errorTelefono)){ echo "<span class='error'>$errorTelefono</span>";}}?><br>
            <input type="text" class="input-text <?php if(isset($_POST['registrar'])){if(isset($errorTelefono)){echo 'error-border';}}?>" placeholder="Telefono Movil" style="width: 509px;" name="telefono" value="<?php if(isset($_POST['registrar'])){if(isset($telefono)){echo $telefono;}}?>"><br>

            <?php if(isset($_POST['registrar'])){if(isset($errorNikname)){ echo "<span class='error'>$errorNikname</span>";}}?><br>
            <input type="text" class="input-text <?php if(isset($_POST['registrar'])){if(isset($errorNikname)){echo 'error-border';}}?>" placeholder="NickName" style="width: 509px;" name="nikname" value="<?php if(isset($_POST['registrar'])){if(isset($nickName)){echo $nickName;}}?>"><br>

            <?php if(isset($_POST['registrar'])){if(isset($errorContraseña)){ echo "<span class='error'>$errorContraseña</span>";}}?><?php if(isset($_POST['registrar'])){if(isset($errorContraseñaRepetida)){ echo "<span class='error error-right-lg'>$errorContraseñaRepetida</span>";}}?><br>
            <input type="password" class="input-text <?php if(isset($_POST['registrar'])){if(isset($errorContraseña)){echo 'error-border';}}?>" placeholder="Contraseña" name="contrasena">

            
            <input type="password" class="input-text <?php if(isset($_POST['registrar'])){if(isset($errorContraseñaRepetida)){echo 'error-border';}}?>" placeholder="Repita Contraseña" name="repitecontrasena"><br>
            
            <?php if(isset($_POST['registrar'])){if(isset($errorFechaNacimiento)){ echo "<span class='error'>$errorFechaNacimiento</span>";}}?><br>
            <label for="" class="label-text">Fecha de Nacimiento</label><br>
            <span class="span-fecha">Dia</span><span class="span-fecha">Mes</span><span class="span-fecha">Año</span><br>
            <select  id="dia" name="dia" >
            </select>

            <select  id="mes" name="mes" onchange="Mesesdia();">
            </select>
            
            <select  id="año" name="año">
            </select><br><br>

            <?php if(isset($_POST['registrar'])){if(isset($errorSexo)){ echo "<span class='error'>$errorSexo</span>";}}?><br>
            <label for="" class="label-text">Genero</label><br>

            <input type="radio" class="radio-s "  name="sexo" value="Mujer" <?php if(isset($_POST['registrar'])){if(isset($sexo)&& $sexo=='Mujer'){echo 'checked';}}  ?>><label for="" class="radio-s"  >Mujer</label>

            <input type="radio" class="radio-s"  name="sexo" value="Hombre" <?php if(isset($_POST['registrar'])){if(isset($sexo)&& $sexo=='Hombre'){echo 'checked';}} ?>><label for="" class="radio-s" >Hombre</label><br>
            <hr>

            <?php if(isset($_POST['registrar'])){if(isset($erroContraseñaValidada)){ echo "<span class='error'>$erroContraseñaValidada</span>";}}?><?php if(isset($_POST['registrar'])){if(isset($errorUsuario)){ echo "<span class='error'>$errorUsuario</span>";}}?><br>
            <input type="submit" name="registrar" value="Registrar" class="btn-submit"><br>
           
           </form>
        
        </div>
</div>



</body>


</html>