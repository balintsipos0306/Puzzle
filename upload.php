<?php
    session_start();

    function kapcsolodas ($kapcsolati_szoveg, $felhasznalonev = 'balintsipos', $jelszo = 'mQYMKbrjz179Yxn6'){
        $pdo = new PDO($kapcsolati_szoveg, $felhasznalonev, $jelszo);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $step = $_POST['steps'];

        $kapcsolat = kapcsolodas('mysql:host=mysql.caesar.elte.hu;dbname=balintsipos','balintsipos', 'mQYMKbrjz179Yxn6');

        $prev = $kapcsolat->prepare("SELECT * FROM result");
        $result = $prev->execute([]);
        $rows = $prev->fetchAll(PDO::FETCH_ASSOC);

        $tmp = 0;
        foreach($rows as $data){
            if($data["username"] == $_SESSION['uname']){
                $tmp = $data["moves"];
            }
        }


        if ($tmp == 0)
        {
            load($kapcsolat, $step);
        }
        else if ($tmp > $step){
            $stmt = $kapcsolat->prepare("UPDATE result SET moves = ? WHERE username = ?");
            $stmt->execute([$step, $_SESSION['uname']]);
        }
    }

    function load($conn,$step){
        $stmt = $conn->prepare("INSERT INTO result (username, moves) VALUES (?, ?)");
        $stmt->execute([$_SESSION['uname'], $step]);
    }
?>