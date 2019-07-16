let eraTitulo
 let tituloRadio = document.getElementById('titulo')
 tituloRadio.addEventListener('click',()=>{
    if(tituloRadio.checked==true && eraTitulo==true){tituloRadio.checked=false;}
    eraTitulo=tituloRadio.checked;
})
let erapalabraClave
 let palabraClaveRadio = document.getElementById('palabraClave')
 palabraClaveRadio.addEventListener('click',()=>{
    if(palabraClaveRadio.checked==true && erapalabraClave==true){palabraClaveRadio.checked=false;}
    erapalabraClave=palabraClaveRadio.checked;
})
let eraRangoFecha
let RangoFechaRadio=document.getElementById('rangoFecha')
RangoFechaRadio.addEventListener('click',()=>{
    if(RangoFechaRadio.checked==true && eraRangoFecha==true){RangoFechaRadio.checked=false;}
    eraRangoFecha=RangoFechaRadio.checked;
})
let eraPalabraClave
let palabraclave=document.getElementById('palabra-clave')
palabraclave.addEventListener('click',()=>{
    if(palabraclave.checked==true && eraPalabraClave==true){palabraclave.checked=false;}
    eraPalabraClave=palabraclave.checked;
})


function mostrarRangoFecha(){
    var fecha = document.getElementById('fechas')
    if(RangoFechaRadio.checked && eraRangoFecha!=true){
        fecha.classList.remove('not-fechas')
    }else{
        fecha.classList.add('not-fechas')
    }

}

function mostrarpalabrasclaves(){
    
    var botonPublicacion=document.getElementById('boton-publicar')
    var textpalabraclave = document.getElementById('text-palabraClave')
    var palabraclave = document.getElementById('palabra-clave')
    var add = document.getElementById('add');
    if(palabraclave.checked && eraPalabraClave!=true){
        textpalabraclave.classList.remove('palabrasClaves-not')
         add.classList.remove('add')
         add.classList.add('add-lg')
         textpalabraclave.classList.add('palabrasClaves')
         botonPublicacion.classList.add('btn-submit-publicacion')
        }else{
            add.classList.remove('add-lg')
            add.classList.add('add')
            textpalabraclave.classList.add('palabrasClaves-not')
            textpalabraclave.classList.remove('palabrasClaves')
            botonPublicacion.classList.remove('btn-submit-publicacion')
    }


}





var file = document.getElementById('file-img');
var archivo = document.getElementById('adjunto');
file.addEventListener('change', function (e) {
    var thumbnailCount=document.getElementsByClassName('thumbnail');
     console.log(thumbnailCount.length)
      if(thumbnailCount.length<=2 && file.files.length<=3 ){

        for ( var i = 0; i < file.files.length; i++ ) {
        var thumbnail_id = Math.floor( Math.random() * 30000 ) + '_' + Date.now();
        createThumbnail(file, i);
        
        
       
    }

      }else{
          alert('solo puede ingresar 3 imagenes')
          file.value='';
          document.querySelectorAll('.thumbnail').forEach(function (thumbnail) {
			thumbnail.remove();
		});
      }
    });

    var createThumbnail = function (file, iterator) {

		var thumbnail = document.createElement('div');
		thumbnail.classList.add('thumbnail');
		thumbnail.setAttribute('style', `background-image: url(${ URL.createObjectURL( file.files[iterator] ) })`);
		document.getElementById('preview-images').appendChild(thumbnail);

		
		
	}

    archivo.addEventListener('change', function (e) {

        var thumbnailCount=document.getElementsByClassName('archivo');
        if(archivo.files.length<=1 && thumbnailCount.length<=0){
            createArchivo(archivo)
        }else{
            alert('solo puede ingresar 1 archivo')
            archivo.value='';
            document.querySelectorAll('.archivo').forEach(function (thumbnail) {
              thumbnail.remove();
            });  
        }
        
      


    })


    var createArchivo = function (file) {

        var thumbnail = document.createElement('p');
        thumbnail.classList.add('archivo');
        thumbnail.innerHTML="*"+file.files[0].name;
		document.getElementById('previewArchivo').appendChild(thumbnail);

		
		
    }
    


    function CargarFechas() {
        let fecha = new Date();
       let ano = fecha.getFullYear();
 for(let i=1;i<32;i++)
     {  if(i<=9){
         document.getElementById("diaD").innerHTML += "<option value='"+0+i+"'>"+0+i+"</option>";
         document.getElementById("diaH").innerHTML += "<option value='"+0+i+"'>"+0+i+"</option>";
     }else{
         document.getElementById("diaD").innerHTML += "<option value='"+i+"'>"+i+"</option>";
         document.getElementById("diaH").innerHTML += "<option value='"+i+"'>"+i+"</option>";  
     }
 
     }
     document.getElementById("diaD").selectedIndex=-1;
     document.getElementById("diaH").selectedIndex=-1;
   
     for(let i=1;i<13;i++)
       { if(i<=9){
            document.getElementById("mesD").innerHTML += "<option value='"+0+i+"'>"+0+i+"</option>";
            document.getElementById("mesH").innerHTML += "<option value='"+0+i+"'>"+0+i+"</option>";  
       } else{
         document.getElementById("mesD").innerHTML += "<option value='"+i+"'>"+i+"</option>";
         document.getElementById("mesH").innerHTML += "<option value='"+i+"'>"+i+"</option>";  
       }
         
    
     
     }
     document.getElementById("mesD").selectedIndex=-1;
     document.getElementById("mesH").selectedIndex=-1;
 
 
     for(let i=ano;i>=1950;i--){
    
       document.getElementById("añoD").innerHTML += "<option value='"+i+"'>"+i+"</option>"; 
       document.getElementById("añoH").innerHTML += "<option value='"+i+"'>"+i+"</option>"; 
     
       
 
   }
     document.getElementById("añoD").selectedIndex=-1;
     document.getElementById("añoH").selectedIndex=-1;
 
 
     
 }
 
 
 