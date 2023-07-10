<?php

class Calculadora {
    private $_valor1;
    private $_valor2;

    public function Suma($_valor1, $_valor2){
        return $_valor1 + $_valor2;
    }

    public function Resta($_valor1, $_valor2){
        return $_valor1 - $_valor2;
    }

    public function Multiplicacion($_valor1, $_valor2){
        return $_valor1 * $_valor2;
    }

    public function Division($_valor1, $_valor2){
        return $_valor1 / $_valor2;
    }
}

class CalculadoraAvanzada extends Calculadora {
    private $valor3;

    function __construct($valor) {
        $this->valor3 = $valor;
    }

    public function potencia() {
        return pow($this->valor3, 2);
    }

    public function raizCuadrada() {
        return sqrt($this->valor3);
    }

    public function exponencial() {
        return exp($this->valor3);
    }
}

$miCalculadora = new Calculadora;
$valor1 = 4;
$valor2 = 2;

echo "Los dos valores son: " . $valor1 . " y " . $valor2 . "<br>";

echo "La suma es: " . $miCalculadora->Suma($valor1, $valor2) . "<br>";

echo "La resta es: " . $miCalculadora->Resta($valor1, $valor2) . "<br>";

echo "La multiplicacion es: " . $miCalculadora->Multiplicacion($valor1, $valor2) . "<br>";

echo "La división es: " . $miCalculadora->Division($valor1, $valor2) . "<br><br>";

$valor3 = 3;
$miCalculadoraAvanzada = new CalculadoraAvanzada($valor3);

echo "El valor Avanzado es: " . $valor3 . "<br>";

echo "La potencia de 2 es: " . $miCalculadoraAvanzada->potencia() . "<br>";

echo "La raiz cuadrada es: " . $miCalculadoraAvanzada->raizCuadrada() . "<br>";

echo "La exponencial es es: " . $miCalculadoraAvanzada->exponencial() . "<br>";

?>