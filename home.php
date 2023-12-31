<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Puzzle</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <head>
        <h1 id="counter">Puzzle</h1>
        <div id ="user">
            <img id="account" src="user.png">
            <p id="fn">Felhasznalonev</p>
        </div>
    </head>

    <div class="container">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nyertél</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                <a role="button" class="btn btn-primary" href="result.php">ScoreBorad</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type = "button" class="btn btn-primary" onclick = "refresh()" id="again"> Újra</button>
                </div>
            </div>
            </div>
        </div>
    </div>

    <main>

        <div class="baloldal" id="bal">
            
            <div class="container" id = "info">
                    <h1>Játékszabályok</h1>
                    <p>A játék során, először a darabokat kell a baloldali oszlopból kiválasztani, majd a jobb oldali cellára kattinva fogja azt beszúrni</p>
                    <p> Az oldal jobb alsó sarkán lévő "Vissza" gombbal lehet egy lépést visszavonni</p>
                    <p><strong>A játék megoldására 160 lépés áll rendelkezésedre</strong></p>
                    <h2>Sok Szerencsét!</h2>
                    <p><i><a href="https://github.com/balintsipos0306/Puzzle" target="_blank">Forráskód</a></i></p>
                    
                    <div id="buttons">
                        <a id="login" class="btn btn-danger" role="button" href="logout.php">Kilépés</a>
                    </div>
            </div>
            
            <div class="container text-center" id = "darabok">
                    <div class="row">
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="1"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="2"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="3"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="4"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="5"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="6"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="7"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="8"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="9"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="10"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="11"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="12"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="13"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="14"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="15"></div>
                        <div class="col-4 col-sm-3 col-lg-4 col-xl-6" id="16"></div>
                    </div>
            </div>

        </div>

        <div class="kirako">
            <div class="kepcontainer">
                <button type="button" id="start" onclick="start()" class="btn btn-primary btn-lg">Kezdés</button>
                <img src="tinywow_DSC_0437_35009345.webp" id="kep" alt="">
            </div>

            <table id="table" class="table">
                <tbody>
                    <tr>
                        <td id = "col11"></td>
                        <td id = "col12"></td>
                        <td id = "col13"></td>
                        <td id = "col14"></td>
                    </tr>

                    <tr>
                        <td id = "col21"></td>
                        <td id = "col22"></td>
                        <td id = "col23"></td>
                        <td id = "col24"></td>
                    </tr>

                    <tr>
                        <td id = "col31"></td>
                        <td id = "col32"></td>
                        <td id = "col33"></td>
                        <td id = "col34"></td>
                    </tr>

                    <tr>
                        <td id = "col41"></td>
                        <td id = "col42"></td>
                        <td id = "col43"></td>
                        <td id = "col44"></td>
                    </tr>

                </tbody>
              </table>

        </div>
        <button type="button" class="btn btn-secondary" id="back" onclick = "stepback()">Vissza</button>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src= "game2.js"></script>
    <script>
        var nev = "<?php echo $_SESSION['uname'] ?>"; 
        var nevmezo = document.getElementById("fn");
        nevmezo.innerHTML = nev;
    </script>

</body>
</html>