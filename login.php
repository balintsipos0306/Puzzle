<?php
    session_start();

    $uname = $_POST["username"];
    $pword = $_POST["password"];
    $pw = hash('sha256',$pword);
    function kapcsolodas ($kapcsolati_szoveg, $felhasznalonev = 'balintsipos', $jelszo = 'mQYMKbrjz179Yxn6'){
        $pdo = new PDO($kapcsolati_szoveg, $felhasznalonev, $jelszo);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    };
    $kapcsolat = kapcsolodas('mysql:host=mysql.caesar.elte.hu;dbname=balintsipos','balintsipos', 'mQYMKbrjz179Yxn6');
    $stmt = $kapcsolat->prepare("SELECT * FROM users");
    $result = $stmt->execute([]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //bejelentkezés        
    $isloggedin = false;
    foreach($rows as $data){
        if ($data["name"] == $uname && $data["password"] == $pw){
            $isloggedin = true;
        }
    } 

    if($isloggedin){
        $_SESSION['uname'] = $uname;
        session_write_close();
        header("Location: ../home.php");
        exit();
    }
    else{
        header("Location: ../index.html");
        exit();
    }

?>
