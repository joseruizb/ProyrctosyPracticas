var prov = document.getElementById("prov");

prov.onchange = function(){
    var prov = this.options[this.selectedIndex].value;

    var ruta = "consulta_municipios.php?prov="+prov;
    location = ruta;

}