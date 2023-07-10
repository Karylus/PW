function contar(vector){
    let recuento = {};

    for (let i = 0; i < vector.length; i++) {
        let tipo = vector[i].tagName.toLowerCase();
        recuento[tipo] = (recuento[tipo] || 0) + 1;        
    }

    return recuento
}

let elementos = document.getElementsByTagName("*")

for (let tipo in contados) {
    document.write(`${tipo}: ${contados[tipo]}` + "<br>");
}
  