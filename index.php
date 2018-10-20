<?php
$mail = isset($_REQUEST['mail']) ? $_REQUEST['mail'] : NULL;

        $obj = new stdClass();
        $obj->Exito = FALSE;
        $obj->Mensaje = "No se envio el mail";

if($mail !=null){
    echo "Se busca a: " .$mail . "<br>";
    try {

                //CREO INSTANCIA DE PDO, INDICANDO ORIGEN DE DATOS, USUARIO Y CONTRASEÑA
                $usuario='root';
                $clave='';
                $obj->Mensaje = $mail. " No existe en la tabla!";


                $objetoPDO = new PDO('mysql:host=localhost;dbname=usuarios_db;charset=utf8', $usuario, $clave);

                $sentencia = $objetoPDO->prepare('SELECT * FROM usuarios');
            
                $sentencia->execute();

              //  var_dump($sentencia);
                
              //  var_dump($sentencia->fetchAll());

                while($fila = $sentencia->fetch()){
                    if($fila["mail"] == $mail){
                        $obj->Exito = TRUE;
                        $obj->Mensaje = $mail. " Existe en la tabla!";
                        break;
                    }
                    //var_dump($fila);
                }



                
            } catch (PDOException $e) {

                $obj->Exito = FALSE;
                $obj->Mensaje = "Error!!!\n" . $e->getMessage();
            }

}
       
        echo json_encode($obj);