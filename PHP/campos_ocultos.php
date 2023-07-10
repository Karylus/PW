<?php

class ProcesarOcultos{
    private $nombre;
    private $apellido;
    private $password1;
    private $password2;
    private $genero;
    private $rangoEdad;
    private $deporte;
    private $comentarios;
    
    private $paso;

    private $_camposVacios = array();

    private $_mismaContra = false;

    private function extraeValores()
    {   /*Campos obligatorios*/
        isset($_POST["nombre"]) and trim($_POST["nombre"]) != "" ? $this->nombre = $_POST["nombre"] : $this->nombre = "";
        isset($_POST["apellido"]) and trim($_POST["apellido"]) != "" ? $this->apellido = $_POST["apellido"] : $this->apellido = "";
        isset($_POST["password1"]) and trim($_POST["password1"]) != "" ? $this->password1 = $_POST["password1"] : $this->password1 = "";
        isset($_POST["password2"]) and trim($_POST["password2"]) != "" ? $this->password2 = $_POST["password2"] : $this->password2 = "";
        isset($_POST["genero"]) and trim($_POST["genero"]) != "" ? $this->genero = $_POST["genero"] : $this->genero = "";

        /*Campos opcionales*/
        isset($_POST["deporte"]) and trim($_POST["deporte"]) != "" ? $this->deporte = $_POST["deporte"] : $this->deporte = "";
        isset($_POST["comentarios"]) and trim($_POST["comentarios"]) != "" ? $this->comentarios = $_POST["comentarios"] : $this->comentarios = "";

        if (isset($_POST["deporte"])) $this->rangoEdad = $_POST["rangoEdad"];

        /*Compruebo si los campos obligatorios estan vacios*/
        if ($this->nombre == "") array_push($this->_camposVacios, "Nombre");
        if ($this->apellido == "") array_push($this->_camposVacios, "Apellido");
        if ($this->password1 == "") array_push($this->_camposVacios, "Contraseña");
        if ($this->password2 == "") array_push($this->_camposVacios, "Contraseña2");
        if ($this->genero == "") array_push($this->_camposVacios, "Género");
    }

    public function procesar(){
        if(isset($_POST["paso"]) && $_POST["paso"] == 0){
            ?>
            <form action="campos_ocultos.php" method="POST">
                    <label for="nombre">Nombre*</label>
                    <input type="text" name="nombre" id="nombre" value="" required/>
        
                    <label for="apellido">Apellido*</label>
                    <input type="text" name="apellido" id="apellido" value="" required/>
        
                    <label for="password1">Contrase&ntilde;a*</label>
                    <input type="password" name="password1" id="password1" value="" required/>
        
                    <label for="password2">Repita la contrase&ntilde;a*</label>
                    <input type="password" name="password2" id="password2" value="" required/>
        
                    <input type="hidden" name="paso" value="1">
                    <input type="submit" value="Siguiente">
                    <input type="reset" name="bontonDeReset" id="botonDeReset" value="Vaciar formulario" />
                </form>
            <?php
            }
        
        if(isset($_POST["paso"]) && $_POST["paso"] == 1){
            $this->extraeValores();
            $this->paso = 2;
            ?>            
            <form action="campos_ocultos.php" method="POST">
                <label for="generoHombre">&iquest;Eres hombre*</label>
                <input type="radio" name="genero" id="generoHombre" value="H" />
        
                <label for="genero">... o mujer&#63;*</label>
                <input type="radio" name="genero" id="generoMujer" value="M" />


                <input type="hidden" name="nombre" value="<?= $this->nombre ?>">
                <input type="hidden" name="apellido" value="<?= $this->apellido ?>">
                <input type="hidden" name="paso" value="2">
                <input type="submit" value="Siguiente">
                <input type="reset" name="bontonDeReset" id="botonDeReset" value="Vaciar formulario" />
            </form>
            <?php
        }
        
        if(isset($_POST["paso"]) && $_POST["paso"] == 2){
            $this->extraeValores();
            $this->paso = 3;
        
            ?>
            <form action="campos_ocultos.php" method="POST">
                <label for="rangoEdad">Rango de edad</label>
                    <select name="rangoEdad" id="rangoEdad" size="1">
                        <option value="infante">Infante</option>
                        <option value="adolescente">Adolescente</option>
                        <option value="adulto">Adulto</option>
                        <option value="mayor">Mayor</option>
                    </select>

                <input type="hidden" name="nombre" value="<?= $this->nombre ?>">
                <input type="hidden" name="apellido" value="<?= $this->apellido ?>">
                <input type="hidden" name="genero" value="<?= $this->genero ?>">
                <input type="hidden" name="paso" value="3">
                <input type="submit" value="Siguiente">
                <input type="reset" name="bontonDeReset" id="botonDeReset" value="Vaciar formulario" />
            </form>
        <?php
        }
        
        if(isset($_POST["paso"]) && $_POST["paso"] == 3){
            $this->extraeValores();
            $this->paso = 4;
        
            ?>
            <form action="campos_ocultos.php" method="POST">
                <label for="deporte">&iquest;Practicas deporte&#63</label>
                <input type="checkbox" name="deporte" id="deporte" value="S&iacute;" />

                <input type="hidden" name="nombre" value="<?= $this->nombre ?>">
                <input type="hidden" name="apellido" value="<?= $this->apellido ?>">
                <input type="hidden" name="genero" value="<?= $this->genero ?>">
                <input type="hidden" name="rangoEdad" value="<?= $this->rangoEdad ?>">
                <input type="hidden" name="paso" value="4">
                <input type="submit" value="Siguiente">
                <input type="reset" name="bontonDeReset" id="botonDeReset" value="Vaciar formulario" />
            </form>
        <?php
        }
        
        
        
        if(isset($_POST["paso"]) && $_POST["paso"] == 4){
            $this->extraeValores();
            $this->paso = 5;
        
            ?>
            <form action="campos_ocultos.php" method="POST">
                <label for="comentarios">&iquest;Alg&uacute;n comentario?</label><br>
                <textarea name="comentarios" id="comentarios" rows="4" cols="50"> </textarea>

                <input type="hidden" name="nombre" value="<?= $this->nombre ?>">
                <input type="hidden" name="apellido" value="<?= $this->apellido ?>">
                <input type="hidden" name="genero" value="<?= $this->genero ?>">
                <input type="hidden" name="rangoEdad" value="<?= $this->rangoEdad ?>">
                <input type="hidden" name="deporte" value="<?= $this->deporte ?>">
                <input type="hidden" name="paso" value="5">
                <input type="submit" value="Siguiente">
                <input type="reset" name="bontonDeReset" id="botonDeReset" value="Vaciar formulario" />
            </form>
        <?php
        }
        
        if(isset($_POST["paso"]) && $_POST["paso"] == 5){
            $this->extraeValores();
            echo ("¡Gracias por rellenar el formulario!<br>");
        
            echo ("El nombre es: " . $this->nombre . "<br>");
            echo ("El apellido es: " . $this->apellido . "<br>");
            echo ("El genero es: " . $this->genero . "<br>");
            echo ("El rango de edad es: " . $this->rangoEdad . "<br>");
            echo ("¿Practica deporte?: " . ($this->deporte == "" ? "No" : "Si") . "<br>");
        
            if ($this->comentarios != "")
                echo ("El comentario es: " . $this->comentarios . "<br>");
        }
    }
}

$formulario = new ProcesarOcultos;

$formulario->procesar();
?>