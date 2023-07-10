let alturas = [1.1, 1.2, 1.3, 1.4, 1.5, 1.6, 1.7, 1.8, 1.9, 2]
let contador = 0;

for (let i = 0; i < alturas.length; i++){
    if (alturas[i] > 1.8){
        contador++
    }
        
}

document.write("Las alturas analizadas son: [" + alturas + "]<br><br>")

document.write("Hay " + contador + " alturas mayores de 1.80 metros.")