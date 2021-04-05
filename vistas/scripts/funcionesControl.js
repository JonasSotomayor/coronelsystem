const controlTexto= (e)=> {
    tecla=e.key
   
    // El pattern que vamos a comprobar
    const pattern = new RegExp('^[A-ZÁ-Ú. ]+$', 'i');
    if (pattern.test(tecla) || tecla=='Backspace' || tecla=='Tab' || tecla=='ArrowLeft' || tecla=='ArrowRight' || tecla=='Control') {
        return true
    } else {
        return false
    }
}

const capitalizarPalabras=(texto)=>{
    return texto.replace(/\b\w/g, l => l.toUpperCase())
}

const controlNumero=(e)=>{
    tecla=e.key
    console.log(tecla)
    // El pattern que vamos a comprobar
    const pattern = new RegExp('^[0-9.,]+$', 'i');
    if (pattern.test(tecla) || tecla=='Backspace' || tecla=='Tab' || tecla=='ArrowLeft' || tecla=='ArrowRight' || tecla=='Control') {
        return true
    } else {
        return false
    }
}
const controlNumeroRuc=(e)=>{
    tecla=e.key
    console.log(tecla)
    // El pattern que vamos a comprobar
    const pattern = new RegExp('^[0-9-]+$', 'i');
    if (pattern.test(tecla) || tecla=='Backspace' || tecla=='Tab' || tecla=='ArrowLeft' || tecla=='ArrowRight' || tecla=='Control') {
        return true
    } else {
        return false
    }
}

const controlNumeroPuro=(e)=>{
    tecla=e.key
    console.log(tecla)
    // El pattern que vamos a comprobar
    const pattern = new RegExp('^[0-9]+$', 'i');
    if (pattern.test(tecla) || tecla=='Backspace' || tecla=='Tab' || tecla=='ArrowLeft' || tecla=='ArrowRight' || tecla=='Control') {
        return true
    } else {
        return false
    }
}
const controlTextoyNumero= (e)=> {
    tecla=e.key
    // El pattern que vamos a comprobar
    const pattern = new RegExp('^[A-Z0-9Á-Ú. ////]+$', 'i');
    if (pattern.test(tecla) || tecla=='Backspace' || tecla=='Tab' || tecla=='ArrowLeft' || tecla=='ArrowRight' || tecla=='Control') {
        return true
    } else {
        return false
    }
}

const controlNumeroCelular=(e)=>{
    tecla=e.key
    console.log(tecla)
    // El pattern que vamos a comprobar
    const pattern = new RegExp('^[0-9+()]+$', 'i');
    if (pattern.test(tecla) || tecla=='Backspace' || tecla=='Tab' || tecla=='ArrowLeft' || tecla=='ArrowRight' || tecla=='Control') {
        return true
    } else {
        return false
    }
}

const controlCorreo=(correo)=>{
    //tecla=e.key
    console.log(correo)
    // El pattern que vamos a comprobar
    //const pattern = new RegExp('/^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/', 'i');
    var reLargo =/^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/

    if (reLargo.test(correo)) {
        return true
    } else {
        return false
    }
}


/*const controlLongitudyLatitud= (e)=> {
    tecla=e.key
    //console.log(tecla)
    // El pattern que vamos a comprobar
    const pattern = new RegExp('^[0-9.,-]+$', 'i');

    if (pattern.test(tecla) || tecla=='Backspace' || tecla=='Tab' || tecla=='ArrowLeft' || tecla=='ArrowRight'  || tecla=='Control') {
        console.log(tecla)
        return true
    } else {
        return false
    }
    
}*/

///formatear en mil cualquier numero
const formatearMiljs=(input)=>{
    //console.warn(input)
    /*let num
    if (input!=null) {
        let num=desformatearformatearMiljs(input);
    }*/
    num=input
    //console.log(num);
    num=desformatearformatearMiljs(num)
    if (num>0) {
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\,?)(\d{3})/g,'$1,');
        num = num.split('').reverse().join('').replace(/^[\,]/,'');
        return num;
    }else{
        desformatearformatearMiljs(num)
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\,?)(\d{3})/g,'$1,');
        num = num.split('').reverse().join('').replace(/^[\,]/,'');
        return num;
    }
    
  }
  const desformatearformatearMiljs=(input)=>{
      input=String(input)
      cadena='';
      for(i=0; i<input.length; i++){
          if(input[i]!=',')
          cadena+=input[i]
      }
     return cadena;
  }

  
const paginacionTabla=(paginaActual,totalPagina,tabla,accionFunccion)=>{
    document.getElementById(tabla).innerHTML=''
    
    document.getElementById(tabla).innerHTML+='<li class="page-item"><button class="page-link" onclick="'+accionFunccion+'('+1+')" aria-label="Anterior"><span aria-hidden="true">&laquo;</span><span class="sr-only">Anterior</span></button></li>'
    
    if(totalPagina>5){
        if(paginaActual<3){
            for(i=1;i<=5;i++) {
                if (i==paginaActual) {
                    document.getElementById(tabla).innerHTML+='<li class="page-item active"><button class="page-link" onclick="'+accionFunccion+'('+i+')">'+i+'</button></li>';
                }else{
                    document.getElementById(tabla).innerHTML+='<li class="page-item"><button class="page-link" onclick="'+accionFunccion+'('+i+')">'+i+'</button></li>';
                }
            }
        }else if(paginaActual>(totalPagina-5)){
            for(i=(totalPagina-5);i<=totalPagina;i++) {
                if (i==paginaActual) {
                    document.getElementById(tabla).innerHTML+='<li class="page-item active"><button class="page-link" onclick="'+accionFunccion+'('+i+')">'+i+'</button></li>';
                }else{
                    document.getElementById(tabla).innerHTML+='<li class="page-item"><button class="page-link" onclick="'+accionFunccion+'('+i+')">'+i+'</button></li>';
                }
            }
        }else{
            for(i=(paginaActual-2);i<=(paginaActual+2);i++) {
                if (i==paginaActual) {
                    document.getElementById(tabla).innerHTML+='<li class="page-item active"><button class="page-link" onclick="'+accionFunccion+'('+i+')">'+i+'</button></li>';
                }else{
                    document.getElementById(tabla).innerHTML+='<li class="page-item"><button class="page-link" onclick="'+accionFunccion+'('+i+')">'+i+'</button></li>';
                }
            }
        }
    }else{
        for(i=1;i<=totalPagina;i++) {
            if (i==paginaActual) {
                document.getElementById(tabla).innerHTML+='<li class="page-item active"><button class="page-link" onclick="'+accionFunccion+'('+i+')">'+i+'</button></li>';
            }else{
                document.getElementById(tabla).innerHTML+='<li class="page-item"><button class="page-link" onclick="'+accionFunccion+'('+i+')">'+i+'</button></li>';
            }
        };
    }
    document.getElementById(tabla).innerHTML+='<li class="page-item"><button class="page-link" onclick="'+accionFunccion+'('+totalPagina+')" aria-label="Siguiente"><span aria-hidden="true">&raquo;</span><span class="sr-only">Siguiente</span></button></li>'
}
