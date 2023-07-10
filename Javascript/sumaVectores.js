function sumarVector(vector){
    let suma = 0

    for (let i = 0; i < vector.length; i++) {
        suma += vector[i]
    }

    return suma
}

let vector1 = [19, 3294, 13 ,2134 ,1344, 1 ,14]
let vector2 = [17, 3194, 3 ,234 ,1344, 2 ,224]

document.write("El vector 1 es: [" + vector1 + "] y su suma acumulada: " + sumarVector(vector1) + "<br>")
document.write("El vector 2 es: [" + vector2 + "] y su suma acumulada: " + sumarVector(vector2) + "<br><br>")

sumarVector(vector1) > sumarVector(vector2) ? document.write("El vector 1 es mayor.") : document.write("El vector 2 es mayor.")