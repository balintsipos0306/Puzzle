<?php

session_start();

function kapcsolodas ($kapcsolati_szoveg, $felhasznalonev = 'balintsipos', $jelszo = 'mQYMKbrjz179Yxn6'){
    $pdo = new PDO($kapcsolati_szoveg, $felhasznalonev, $jelszo);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
};

$kapcsolat = kapcsolodas('mysql:host=mysql.caesar.elte.hu;dbname=balintsipos','balintsipos', 'mQYMKbrjz179Yxn6');

$sql = $kapcsolat->prepare("SELECT * FROM users");
$result = $sql->execute([]);
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

$succ = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = ['success' => false];
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {

        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = hash('sha256',$_POST['password']);

        foreach($rows as $data){
            if($data['email'] == $email){
                $succ = false;
            }
            if ($data['name'] == $name){
                $succ = false;
            }
        }

        $stmt = $kapcsolat->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        
        if($succ){
        $stmt->execute([$name, $email, $password]);
        $result['success'] = true;
        }
    }
    echo json_encode($result);
    echo "Sikeres regisztráció";
}
?>