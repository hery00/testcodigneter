<?php
    
    require_once("Connection.php");
    
    function checklog($pseudo,$pass)
    {
        $request="SELECT * from membre where pseudo='%s'";
        $request=sprintf($request,$pseudo);
        $result=mysqli_query(connecter(),$request);
        $n=mysqli_num_rows($result);
            if ($n==0) 
            {
                return "null";
            }
            else
            {
                $request="SELECT * from membre where pseudo='%s' and pass='%s'";
                $request=sprintf($request,$pseudo,$pass);
                $result=mysqli_query(connecter(),$request);
                $i=mysqli_num_rows($result);
                if ($i==0) 
                {
                    return "error";
                }
                else
                { 
                    $retour=mysqli_fetch_assoc($result);
                    session_start();
                    $_SESSION['idUser'] = $retour['IDUSER'];
                    $_SESSION['nom'] = $retour['NOM'];
                    mysqli_free_result($result);
                    return "success"; 
                }     
            }
    }

    function publier($id_M, $text){
        $request = sprintf('INSERT INTO publication(id_Membre, datePub, contenu) VALUES ("%d", CURRENT_TIME(), "%s") ',$id_M,$text);
        mysqli_query(connecter(),$request );
    }

    function getPublication(){
        $request= mysqli_query(Connecter(),'SELECT * FROM publication');
        $result = array();
        while ($donnee = mysqli_fetch_array($request)) {
            $result[] = $donnee;
        }

        mysqli_free_result($request);
        return $result;
    }

    function getCom($idP){
        $request = sprintf('SELECT * FROM comm_member WHERE id_P = %d', $idP);
        $req = mysqli_query(connecter(),$request);
        $result = array();
        while ($donnee = mysqli_fetch_array($req)) {
            $rs[] = $donnee;
        }

        mysqli_free_result($req);
        return $result;
    }

    function timePassed($time){
        $request = sprintf("SELECT TIMESTAMPDIFF(MINUTE, '%s', CURRENT_TIME()) as timepub", $time);
        $req = mysqli_query(connecter(), $request);
        $passed = mysqli_fetch_assoc($req);
        mysqli_free_result($req);        
        return $passed['timepub'];
    }

    function convTime($time){
        $cT = null;
        if($time < 60){
            $cT = $time ." minutes";
            if($time <= 1){
                $cT = "A l'instant";
            }
        }
        if($time > 60 && $time < 1440){
            $cT = intval($time/60) ." heures";
        }
        if($time > 1440 && $time < 43200){
            $cT = intval($time/1440) ." jours";
        }
        return $cT;
    }

?>