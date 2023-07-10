class Vehiculo {
    _marca = ""
    _modelo = ""
    _anio_de_matriculacion
    _anio_de_venta
    _potencia
    _cilindrada
    _combustible

    constructor(marca, modelo, matriculacion, venta, potencia, cilin, combus) {
        this._marca = marca
        this._modelo = modelo
        this._anio_de_matriculacion = matriculacion
        this._anio_de_venta = venta
        this._potencia = potencia
        this._cilindrada = cilin
        this._combustible = combus
    }

    get anio_de_matriculacion() {
        return this._anio_de_matriculacion
    }

    set anio_de_matriculacion(valor) {
        this._anio_de_matriculacion = valor;
    }

    get marca() {
        return this._marca
    }

    get modelo() {
        return this._modelo
    }
}

function vehiculoMasAntiguo(vector) {
    let viejo = new Vehiculo
    viejo = vector[0]

    for (let i = 0; i < vector.length; i++) {
        if (vector[i].anio_de_matriculacion < viejo.anio_de_matriculacion) {
            viejo = vector[i]
        }
    }

    return viejo
}

function vehiculosAnioIntervalo(vector, inferior, superior) {
    let ajustados = new Vehiculo
    ajustados = []

    for (let i = 0; i < vector.length; i++){
        if (vector[i].anio_de_matriculacion >= inferior && 
            vector[i].anio_de_matriculacion <= superior){
            ajustados.push(vector[i])
        }
    }

    return ajustados
}

let coche1 = new Vehiculo("Ford", "Fiesta", 2010, 2019, 200, 90, 100)
let coche2 = new Vehiculo("Honda", "Civic", 2008, 2012, 150, 75, 100)
let coche3 = new Vehiculo("Kia", "Sportage", 2012, 2017, 300, 120, 100)
let coche4 = new Vehiculo("Ferrari", "LaFerrari", 2020, 2023, 250, 110, 100)

let todos_coches = [coche1, coche2, coche3, coche4]

let mas_viejo = vehiculoMasAntiguo(todos_coches)

document.write("El vehiculo mas antiguo es el " + mas_viejo.marca + " " + mas_viejo.modelo
    + " con año de matriculacion " + mas_viejo.anio_de_matriculacion + "<br><br>")

let estan_rango = vehiculosAnioIntervalo(todos_coches, 2010, 2019)

document.write("Los siguientes vehiculos fueron matriculados entre 2010 y 2019:<br>")

for (let i = 0; i < estan_rango.length; i++){
    document.write(estan_rango[i].marca + " " + estan_rango[i].modelo
    + " - " + estan_rango[i].anio_de_matriculacion + "<br>")
}