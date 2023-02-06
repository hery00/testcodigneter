<?php

    sleep(2);
    header( "Content-Type: application/json"); 

    $pseudo = $_GET['pseudo'];
    $pass = $_GET['pass'];
    $retour=[];
        $request="SELECT * from membre where pseudo='%s'";
            $request=sprintf($request,$pseudo);
            $result=mysqli_query(connecter(),$request);
            $n=mysqli_num_rows($result);
                if ($n==0) 
                {
                    $retour="null";
                }
                else
                {
                    $request="SELECT * from membre where pseudo='%s' and pass='%s'";
                    $request=sprintf($request,$pseudo,$pass);
                    $result=mysqli_query(connecter(),$request);
                    $i=mysqli_num_rows($result);
                    if ($i!=0) 
                    {
                        $retour=mysqli_fetch_assoc($result);
                        session_start();
                        $retour[0] = $retour['IDUSER'];
                        $retour[1] = $retour['NOM'];
                        mysqli_free_result($result);
                    }
                    else
                    { 
                        $retour[0]="error";
                    }     
                }

    echo json_encode($retour);

?>