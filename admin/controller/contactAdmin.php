<?php 
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/const.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/shared/php/controller/userInfo.php");

    //function used to know if the current user is an admin
	function isAnAdmin(){
        $username = getDBUserName($_SESSION[CONST_SESSION_EMAIL]);
        $email = $_SESSION[CONST_SESSION_EMAIL];
        $firstname = getFirstnameID($_SESSION[CONST_SESSION_EMAIL]);
        $lastname = getLastnameID($_SESSION[CONST_SESSION_EMAIL]);
        
        $conn = getPDO();
    
        // PREPARED QUERY - select all infos in admin table
        $querystring = "SELECT * FROM admin";
        $query = $conn->prepare( $querystring );
        $query->execute();

        $isAdmin = 0;
        while ($row = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            if($row[1] == $username and $row[2] == $email and $row[3] == $firstname and $row[4] == $lastname)
                $isAdmin = 1;
        }

        if($isAdmin == 1)
            return 1;
        else    
            return 0;
    
        closePDO($conn);
    }
?>