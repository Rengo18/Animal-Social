
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link  href="css/global.css" rel="stylesheet" type="text/css" >
    <link  rel="stylesheet" href="css/login.css">
    
    <title>login Red Social</title>
    
</head>
<body>
    
<div class="container">

        <div class="colum">
            <img src="img/logo.svg" alt="logo" width="400" height="400">
      </div>
        <div class="colum">
            <form action="<?php echo $helper->url('login','validarLogin');?>" method="Post" >
                <?php if(isset($_POST['iniciar'])){if(isset($errorNickName)){echo "<span class='error-login'>$errorNickName</span><br>"; }}?>
                <input type="text" placeholder="NickName" class="input-text  <?php if(isset($_POST['iniciar'])){if(isset($errorNickName)){ echo 'error-border';}}?>" name="nickname" value="<?php if(isset($_POST['iniciar'])){if(isset($nickname)){echo $nickname;} }  ?>">
                <hr> 
                <br>
                <?php if(isset($_POST['iniciar'])){if(isset($errorContraseña)){echo "<span class='error-login'>$errorContraseña</span><br>"; }}?>
                 <input type="password" placeholder="Contraseña" class="input-text <?php if(isset($_POST['iniciar'])){if(isset($errorContraseña)){ echo 'error-border';}}?>" name="contrasena">
                 <hr>
                 <br> 
                 <?php if(isset($_POST['iniciar'])){if(isset($mensaje)){echo "<span class='error-message'>$mensaje</span><br>"; }}?>
                 <input type="submit" class="btn-submit btn-position-iniciar" name="iniciar" value="iniciar sesión">
                 <button class="btn-submit btn-position-iniciar"><a href="<?php echo $helper->url('RegistrarUsuario','index');?>" >Registrar</a></button>
            </form>
           
            
        </div>


</div>

<?php



?>

</body>

</html>