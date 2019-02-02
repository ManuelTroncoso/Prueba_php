<?php

    class Cliente {
        //Atributos
        public $nombre;
        public $apellido;
        public $pais;
        public $lenguaje;
        //Constructor
        public function __construct($nombre, $apellido, $pais){
        
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->pais = $pais;
            //llamamos a la funcion curl. En esta está el idioma.
            $this->lenguaje = $this->obtenerCURL();
        }
        //Esta función te obtiene el curl
        public function obtenerCURL(){
            $url="https://restcountries.eu/rest/v2/name/".$this->pais;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL,$url);
            $resultado = curl_exec($ch);
            curl_close($ch);
            $resultado = json_decode($lenguaje);
            $lenguaje = ($resultado[0]->languages[0]->iso639_1);      
            return $lenguaje;
        }
    }

    class Calendario {
        //Esta funcion te crea una cita.
        public function crearCita($fecha, $cliente){
            $fechaActual = date("Y");
            $tratarFechas = new DateTime($fecha);
            $fechaCitas = $tratarFechas->format('Y');

            try{
                if($fechaActual == $fechaCitas){
                    $archivo = "datos.txt";

                    $fp = fopen($archivo, "a"); 
                    fwrite($fp, $cliente->nombre." ".$cliente->apellido.";$fecha\n"); 
                    fclose($fp);
                }else {
                    throw new Exception("Año no válido");
                }
    
            }catch(Exception $error) {
                echo $error->getMessage();
            }

        }

        //En este archivo te devuelve las citas que tenemos.
        public function obtenerCitas(){
            $archivo = file("datos.txt");
            $arrayDatos = array();
            $hoy = date("Y-m");
            $i = 0;

            foreach($archivo as $indice => $valor){
                $datosCliente = explode(';',$valor);
                $fecha = new DateTime($datosCliente[1]);
                $diaSemana = date('N', strtotime($datosCliente[1]));
                $AnnoCita = $fecha->format('Y-m');
                //Se asegura que la cita es de  Lunes a Viernes y no fines de semana
                if($hoy == $AnnoCita && $diaSemana <= 5){
                    //Creacion de array.
                    $arrayDatos[$i] = array();
                    $arrayDatos[$i]['Cliente'] = $datosCliente[0];
                    $arrayDatos[$i]['Cita'] = $datosCliente[1];
                    $i++;
                }
            }
            echo "<pre>";
            print_r($arrayDatos);
        }
    }

   
    $nombre = $_POST["nombre"];
    $apellido = $_POST['apellido'];
    $pais = $_POST['pais'];
    $fecha = $_POST["fecha"];

    $cliente = new Cliente($nombre,$apellido,$pais);
    $cita = new Calendario();

    $cita->crearCita($fecha, $cliente);
    $cita->obtenerCitas();
    header("location: index.php");
?>