function CargarFechas() {
       let fecha = new Date();
      let ano = fecha.getFullYear();
for(let i=1;i<32;i++)
    {  if(i<=9){
        document.getElementById("dia").innerHTML += "<option value='"+0+i+"'>"+0+i+"</option>"; 6
    }else{
        document.getElementById("dia").innerHTML += "<option value='"+i+"'>"+i+"</option>"; 
    }

    }
    document.getElementById("dia").selectedIndex=-1;
  
    for(let i=1;i<13;i++)
      { if(i<=9){
           document.getElementById("mes").innerHTML += "<option value='"+0+i+"'>"+0+i+"</option>"; 
      } else{
        document.getElementById("mes").innerHTML += "<option value='"+i+"'>"+i+"</option>"; 
      }
        
   
    
    }
    document.getElementById("mes").selectedIndex=-1;


    for(let i=ano;i>=1950;i--){
   
      document.getElementById("año").innerHTML += "<option value='"+i+"'>"+i+"</option>"; 
    
      

  }
    document.getElementById("año").selectedIndex=-1;


    
}


function  Mesesdia(){
  
 

let mes= document.getElementById("mes").value;
  let dia=document.getElementById("dia").value;
 let ano=document.getElementById("año").value;
let select_dia=document.getElementById("dia");
  let cantidad_option=document.getElementById("dia").length
  
  
  for(let j=0;j<cantidad_option;j++){
    select_dia.remove(Option[j])
  }




    if(mes==04||mes==06||mes==09||mes==11){

    for(let i=1;i<31;i++)
    {  if(i<=9){
        
      
        document.getElementById("dia").innerHTML += "<option value='"+0+i+"'>"+0+i+"</option>"; 


    }else{
        
        document.getElementById("dia").innerHTML += "<option value='"+i+"'>"+i+"</option>"; 
    }
   
    } if(dia!=' '){
        if(dia==31){
             dia--
             document.getElementById("dia").value=dia
        }else{
            document.getElementById("dia").value=dia
        }
       

    }
    }else{
        for(let i=1;i<32;i++)
        {  if(i<=9){
           
            document.getElementById("dia").innerHTML += "<option value='"+0+i+"'>"+0+i+"</option>"; 
        }else{
           
            document.getElementById("dia").innerHTML += "<option value='"+i+"'>"+i+"</option>"; 
        }
    }}
     if(dia!=null){
        document.getElementById("dia").value=dia

    }
    
     


if(mes==02){
    
        for(let i=1;i<29;i++)
        {  if(i<=9){
            
            document.getElementById("dia").innerHTML += "<option value='"+0+i+"'>"+0+i+"</option>"; 
        }else{
           
            document.getElementById("dia").innerHTML += "<option value='"+i+"'>"+i+"</option>"; 
        }
    }if(dia!=null){
        if(dia>28){
            dia=28
            document.getElementById("dia").value=dia
        }else{
            document.getElementById("dia").value=dia
        }
        

     }
   
  }

}