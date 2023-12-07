
// $(document).ready(function () {
//     alert("sitio listo")
// })

/** sintaxis jQuery
    # : id o identificador unico

    $("identificador de elemento").evento(function(){
    [bloque de codigo]
    })
    
*/

$("#form-carga-categorias").submit(function(e){
    e.preventDefault();

    const categoria=$("#nombre-categoria").val();

    if (!$.trim(categoria)) {
        alert("Complete el nombre de la categoría");
        return false;
    }
    alert(`Formulario enviado. \nCategoria "${categoria}" Creada exitosamente. `);
    this.reset();
    return true;
});


$("#form-carga-productos").submit(function (e) {
    e.preventDefault();
    const nombre = $("#nombre-producto").val();
    const descripcion = $("#descripcion-producto").val();
    const precio = $("#precio-producto").val();
    const imagen = $("#imagen-producto").val();
    const categoria = $("#categoria-producto").val();

    const errores = [];

    if (!$.trim(nombre)){errores.push(`"Nombre"`);}
        
    if (!$.trim(descripcion))
        {errores.push(`"Descripcion"`);}
    if (!$.trim(precio))
        {errores.push(`"Precio"`);}
    if (!$.trim(imagen))
        {errores.push(`"Imagen"`);}
    if (!$.trim(categoria))
        {errores.push(`"Categoria"`);}
    
    if(errores.length){
        alert(`Debe completar ${errores.map((e)=>` \n- ${e}`)}`)
        return false
    }
alert(`Formulario enviado. \nProducto "${(nombre)}" creada exitosamente`);
this.reset();
return true;


});
