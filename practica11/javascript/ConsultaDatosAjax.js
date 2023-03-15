
var xhr = new  XMLHttpRequest();
var prov = document.getElementById("prov");
var munic = document.getElementById("munic");

prov.onchange = function(){
    var prov = this.options[this.selectedIndex].value;

    xhr.open("POST","./dameMunicipios.php?prov="+prov);


    console.log(xhr.responseText)

    var ruta = "consulta_por_datos_ajax.php?prov="+prov;
    location = ruta;

}


munic.onchange = function(){
    var munic = this.options[this.selectedIndex].value;

    var ruta = "consulta_por_datos_ajax.php?prov="+prov.options[prov.selectedIndex].value+"&munic="+munic;
    location = ruta;

}