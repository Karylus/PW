function mayorQue(numero){
    function comparar(compara) {
        return compara > numero
    }

    return comparar
}

let mayorQue4 = mayorQue(4)

document.write("El número 6 es mayor que 4: " + mayorQue4(6) + "<br>")
document.write("El número 2 es mayor que 4: " + mayorQue4(2))