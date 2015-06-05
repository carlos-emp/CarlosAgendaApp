<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
$todo=array();
$i=0; 
$directorio = opendir("../"); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if (is_dir($archivo))//verificamos si es o no un directorio
    {
        //echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes 
    }
    else
    {
        chmod($archivo, 0755);//el servidor le da los permisos para que pueda leer los archivos solo leer
        $pos = strpos($archivo, "Agen-");//lee solo los archivos que empiesen con PAP-E y los demas los omite
        $pos2 = strpos($archivo, ",v");//omite los archivos txt con terminacion  "v"
        $pos3 = strpos($archivo, ".lease");
        if($pos!==false&&$pos2===false&&$pos3===false){
            $campos=explode('%META:FORM{name="AgendaForm"}%',file_get_contents("../".$archivo));
            $n=count($campos);
            $campo=explode('%META:FIELD{',$campos[$n-1]);
            
            $Nombre=explode('"',$campo[1]);
            $Telefono=explode('"',$campo[2]);
            $Celular=explode('"',$campo[3]);
            $Correo=explode('"',$campo[4]);
            $Skype=explode('"',$campo[5]);
            $Calle=explode('"',$campo[6]);
            $Numero=explode('"',$campo[7]);
            $Colonia=explode('"',$campo[8]);
            


            $todo[]=array("Topico"=>utf8_encode ($archivo),"Nombre"=>utf8_encode ($Nombre[7]), "Telefono"=>utf8_encode ($Telefono[7]),"Celular"=>utf8_encode ($Celular[7]),"Correo"=>utf8_encode ($Correo[7]),"Skype"=>utf8_encode ($Skype[7]),"Calle"=>utf8_encode ($Calle[7]), "Numero"=> utf8_encode ($Numero[7]),"Colonia"=>utf8_encode ($Colonia[7]));
           
        }
    }
}
echo json_encode($todo);
?>


