<?php
class ProcesarFormulario
{
    public $name;
    public $apellido;
    public $genero;
    public $rangoEdad;
    public $deporte;
    public $comentarios;
    public $contrasena1;
    public $contrasena2;

    private $_camposVacios = array();

    private $_mismaContra = false;

    private function extraeValores()
    {   /*Campos obligatorios*/
        isset($_POST["nombre"]) and trim($_POST["nombre"]) != "" ? $this->name = $_POST["nombre"] : $this->name = "";
        isset($_POST["apellido"]) and trim($_POST["apellido"]) != "" ? $this->apellido = $_POST["apellido"] : $this->apellido = "";
        isset($_POST["password1"]) and trim($_POST["password1"]) != "" ? $this->contrasena1 = $_POST["password1"] : $this->contrasena1 = "";
        isset($_POST["password2"]) and trim($_POST["password2"]) != "" ? $this->contrasena2 = $_POST["password2"] : $this->contrasena2 = "";
        isset($_POST["genero"]) and trim($_POST["genero"]) != "" ? $this->genero = $_POST["genero"] : $this->genero = "";

        /*Campos opcionales*/
        isset($_POST["deporte"]) and trim($_POST["deporte"]) != "" ? $this->deporte = $_POST["deporte"] : $this->deporte = "";
        isset($_POST["comentarios"]) and trim($_POST["comentarios"]) != "" ? $this->comentarios = $_POST["comentarios"] : $this->comentarios = "";

        $this->rangoEdad = $_POST["rangoEdad"];

        /*Compruebo si los campos obligatorios estan vacios*/
        if ($this->name == "") array_push($this->_camposVacios, "Nombre");
        if ($this->apellido == "") array_push($this->_camposVacios, "Apellido");
        if ($this->contrasena1 == "") array_push($this->_camposVacios, "Contraseña");
        if ($this->contrasena2 == "") array_push($this->_camposVacios, "Contraseña2");
        if ($this->genero == "") array_push($this->_camposVacios, "Género");
    }

    public function procesar()
    {
        $this->extraeValores();

        if (isset($_POST["reset"])) {
            $this->name = "";
            $this->apellido = "";
            $this->genero = "";
            $this->rangoEdad = "";
            $this->deporte = "";
            $this->comentarios = "";
            $this->contrasena1 = "";
            $this->contrasena2 = "";

            $this->_camposVacios = array();

            $this->_mismaContra = false;
        }

        if ($this->contrasena1 == $this->contrasena2)
            $this->_mismaContra = true;
        
        if (!empty($this->_camposVacios) or !$this->_mismaContra){
            echo trim(<<<EOD
                <h1>Ejemplo de formulario</h1>
                <p>Por favor, rellene los siguientes datos y haga click en el botón Enviar.</p>
            
                <form action="procesar_formulario.php" method="post">
                    <label for="nombre">Nombre*</label>
                    <input type="text" name="nombre" id="nombre" value=$this->name >
                
                <label for="apellido">Apellido*</label>
                <input type="text" name="apellido" id="apellido" value=$this->apellido >
            
                <label for="password1">Contrase&ntilde;a*</label>
                <input type="password" name="password1" id="password1" value="" />
                    
                <label for="password2">Repita la contrase&ntilde;a*</label>
                <input type="password" name="password2" id="password2" value="" />
            EOD);
                
            echo '<input type="radio" name="genero" value="H"';
            if ($this->genero == 'H') {
                echo ' checked';
            }
            echo '> Eres hombre*';

            echo '<input type="radio" name="genero" value="M"';
            if ($this->genero == 'M') {
                echo ' checked';
            }
            echo '> ... o mujer&#63;*';
                        
            echo trim(<<<EOD
                    <label for="rangoEdad">Rango de edad</label>
                    <select name="rangoEdad" id="rangoEdad" size="1">
                        <option value="infante">Infante</option>
                        <option value="adolescente">Adolescente</option>
                        <option value="adulto">Adulto</option>
                        <option value="mayor">Mayor</option>
                    </select>
            EOD);

            echo('<label for="deporte">&iquest;Practicas deporte&#63;</label>');
            if($this->deporte == "Sí")  
                echo('<input type="checkbox" name="deporte" id="deporte" value="S&iacute;" checked />');
            
            else
                echo('<input type="checkbox" name="deporte" id="deporte" value="S&iacute;" />');
            
            echo trim(<<<EOD
                    <label for="comentarios">&iquest;Alg&uacute;n comentario?</label>
                    <textarea name="comentarios" id="comentarios" rows="4" cols="50">$this->comentarios</textarea>
            
                    <input type="submit" name="botonDeEnvio" id="botonDeEnvio" value="Enviar datos" />
                    <input type="reset" name="bontonDeReset" id="botonDeReset" value="Vaciar formulario" />
                </form><br>
            EOD);

            if(!$this->_mismaContra)
                echo("<br>Las contraseñas no coinciden");

            else {
                echo("Por favor, rellena los siguientes campos: ");

                foreach ($this->_camposVacios as $vacio) {
                    echo($vacio . " ");
                }
            }
        }

        else {
            echo ("¡Gracias por rellenar el formulario!<br>");

            echo ("El nombre es: " . $this->name . "<br>");
            echo ("El apellido es: " . $this->apellido . "<br>");
            echo ("El genero es: " . $this->genero . "<br>");
            echo ("El rango de edad es: " . $this->rangoEdad . "<br>");
            echo ("¿Practica deporte?: " . ($this->deporte == "" ? "No" : "Si") . "<br>");

            if ($this->comentarios != "")
                echo ("El comentario es: " . $this->comentarios . "<br>");
        }
    }
}

$formulario = new ProcesarFormulario;

$formulario->procesar();
?>