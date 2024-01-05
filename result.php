<?php
    function kapcsolodas ($kapcsolati_szoveg, $felhasznalonev = 'balintsipos', $jelszo = 'mQYMKbrjz179Yxn6'){
        $pdo = new PDO($kapcsolati_szoveg, $felhasznalonev, $jelszo);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    };

    $kapcsolati_szoveg = "mysql:host=mysql.caesar.elte.hu;dbname=balintsipos;";
    $kapcsolat = kapcsolodas($kapcsolati_szoveg,'balintsipos', 'mQYMKbrjz179Yxn6');
    
    $stmt = $kapcsolat->prepare("SELECT * FROM result ORDER BY moves ASC");
    $result = $stmt->execute([]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="score.css">
    <title>Puzzle-Scoreboard</title>
</head>
<body>
    <div class="cim">
        <h1>Puzzle - Toplista</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">Sorrend</div>
            <div class="col">Név</div>
            <div class="col">Lépések száma</div>
        </div>
        <?php
            $players = 1;

            foreach($rows as $data){
                echo '
                <div class="row">
                    <div class="col">'.$players.'</div>
                    <div class="col">'.$data["username"].'</div>
                    <div class="col">'.$data["moves"].'</div>
                </div>';
                $players++;
            }
        ?>
    </div>

    <a class="btn btn-primary" role="button" href="home.php">Vissza a játékhoz</a>

    
</body>
</html>