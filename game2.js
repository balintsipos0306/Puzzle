//globális változók
let kepid = undefined;
let kephelye = undefined;

//puzzle darabok random elhelyezéséhez szükséges tömb
function generateRandomList() {
  var numbers = [];  
  for (var i = 1; i <= 16; i++) {
    numbers.push(i);
  }
  for (var i = numbers.length - 1; i > 0; i--) {
    var j = Math.floor(Math.random() * (i + 1));
    var temp = numbers[i];
    numbers[i] = numbers[j];
    numbers[j] = temp;
  }
  return numbers;
};
// puzzle darabok random sorrendje
const randomList = generateRandomList();
//gomb eltűntetése, kirakó megjelenése, puzzle darabok megjelenése
async function start(){
    const gomb = document.getElementById("start");
    const kep = document.getElementById("kep");
    const table = document.getElementById("table");
    const darabtable = document.getElementById("darabok");
    const baloldal = document.getElementById("bal");
    const backbutton = document.getElementById("back");
    const szabalyok = document.getElementById("info");
    gomb.style.display="none";
    kep.style.display = "none";
    table.style.display= "block";
    darabtable.style.display = "block";
    baloldal.style.overflow = "scroll";
    backbutton.style.display = "block";
    szabalyok.style.display = "none";
    //kirako darabok random betöltése.
    for(let k = 1; k < 17; k++){
      let i = randomList[k-1];
      var element = k;
      const doboz = document.getElementById(element);
      var elem = document.createElement("img");
      var kepsrc = "szeletek/" + i + ".jpg";
      elem.setAttribute("src", kepsrc);
      var segedstr = "kep" + i;
      elem.setAttribute ("id", segedstr);
      elem.style.width= "9em";
      doboz.append(elem);
    }

    //játék menete (amíg nincs kirakva helyesen)
    for(let i=0; i< 160; i++){
      game();
    }
};


//a visszalépéshez szükséges (a előző lépés kepid, kephelye értékeit veszi fel)
var previd = [];
const state = [];
for (let i = 1;i<17;i++ ){
  state.push(0);
}

function game()
{
    //darab kiválasztás
    darabvalasztas(function(){
      //hely kiválasztás
      helykereso(function(){
        //beillesztés
        if (kepid != undefined && kephelye !=  undefined){
          beszuras();
          kepid = undefined;
          kephelye = undefined;
        }
        else{
          game();
        }
      });
    })
};
//darabkiválasztása
function darabvalasztas (next){
  //.col divek kiválasztása tömbbe
  const darabok = document.getElementsByClassName("col-sm-3 col-lg-4 col-xl-6");
  //kattintást figyelő függvény
  function kivalasztas (event){
    kepid = randomList[parseInt(event.currentTarget.id) - 1];
    
  //korábbi lépések eltárolása
  if (!previd.includes(kepid)){
    previd.push(kepid);
  }
    event.currentTarget.style.display = "none";
    for(let col of darabok){
      col.removeEventListener("click", kivalasztas);
    }
    next();
  };
  //kattintás figyelése
  for (let col of darabok){ 
    col.addEventListener("click", kivalasztas);
  };
};
function helykereso(end) {
  //cellák kiválasztása
  const darabhelye = document.querySelectorAll("td");
  //katintást figyelő függvény
  function kattintas(event) {
    kephelye = event.currentTarget.id;
    for (let td of darabhelye){
      td.removeEventListener("click", kattintas);
    };
    end();
  };
  //kattintás figyelése
  for (let td of darabhelye){
    td.addEventListener("click", kattintas);
  };
};
//kép beszúrása
  function beszuras(){
  //tag létrehozása és beállítása
  const kepkocka = document.createElement("img");
  kepkocka.style.width = "12em";
  kepkocka.style.height = "8em";
  kepkocka.style.filter = "brightness(1)";
  const kepforras = "szeletek/" + kepid + ".jpg";
  kepkocka.setAttribute("src", kepforras);
  kepkocka.setAttribute("id", kepid);
  const beszur = document.getElementById(kephelye);

  //beszúrás
  kepid = previd[previd.length-1];

  if (beszur) {
    //van e benne már kép
    const gyerek = beszur.querySelector("img");
    if(gyerek){
      //a kép id-je amit megpróbáltunk rossz helyre beszúrni
      var hibasid = previd.pop();
      let index = undefined;
      //a darabtáblázatban megkeressük a kép eredeti helyét
      for (let i = 0; i < randomList.length; i++){
        if(randomList[i] == hibasid){
          index = i+1;
        }
      }
      //újra látható lesz a darabok között
      const elem = document.getElementById(index);
      elem.style.display = "block";

      //átírjuk, hogy a state táblázatban az eredetileg ott lévő kép id-je maradjon bent (ne az amit megpróbáltunk)
      kepid = parseInt(gyerek.id);

    }
    else{
      beszur.appendChild(kepkocka);
    }
  } else {
    //lehetőleg ez az ág sosem fut le :D
    alert("Hiba: Az elem nem található!");
  }
  //state táblázat feltöltése
  switch (kephelye){
    case "col11":
      state[0] = kepid;
      break;
    case "col12":
      state[1] = kepid;
      break;
    case "col13":
      state[2] = kepid;
      break;
    case "col14":
      state[3] = kepid;
      break;
    case "col21":
      state[4] = kepid;
      break;
    case "col22":
      state[5] = kepid;
      break;
    case "col23":
      state[6] = kepid;
      break;
    case "col24":
      state[7] = kepid;
      break;
    case "col31":
      state[8] = kepid;
      break;
    case "col32":
      state[9] = kepid;
      break;
    case "col33":
      state[10] = kepid;
      break;
    case "col34":
      state[11] = kepid;
      break;
    case "col41":
      state[12] = kepid;
      break;
    case "col42":
      state[13] = kepid;
      break;
    case "col43":
      state[14] = kepid;
      break;
    case "col44":
      state[15] = kepid;
      break;
  }
  //leellenőrizzük, hogy készen van-e a kirakó
  let jo = true;
  for(let j = 1; j < 17; j++){
    if (state[j-1] != j){
      jo = false;
    }
  }
  //győzelmet jelző üzenet megjelenítése
  if (jo){
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    myModal.show();
    kesz = true;
  }
};

//oldal újratöltése
function refresh(){
  location.reload();
};

//visszalépés
function stepback(){
  //utolsó lépés id-je
  let id = previd[previd.length-1];
  let hely = undefined;
  //megkeresi hogy a kirakóban melyik cellában van az utoljára beszúrt kép
  for (let i = 0; i <state.length; i++){
    if (state[i] == id){
      hely = i;
    }
  }
  let helyid = undefined;
  //megkeresi a táblázatban lévő hely indexét
  switch(hely){
    case 0:
      helyid = "col11";
      break;
    case 1:
      helyid = "col12";
      break;
    case 2:
      helyid = "col13";
      break;
    case 3:
      helyid = "col14";
      break;
    case 4:
      helyid = "col21";
      break;
    case 5:
      helyid = "col22";
      break;
    case 6:
      helyid = "col23";
      break;
    case 7:
      helyid = "col24";
      break;
    case 8:
      helyid = "col31";
      break;
    case 9:
      helyid = "col32";
      break;
    case 10:
      helyid = "col33";
      break;
    case 11:
      helyid = "col34";
      break;
    case 12:
      helyid = "col41";
      break;
    case 13:
      helyid = "col42";
      break;
    case 14:
      helyid = "col43";
      break;
    case 15:
      helyid = "col44";
      break;
  }
  //kitörli a képet
  if (helyid != undefined){
    const kirakott = document.getElementById(helyid);
    kirakott.removeChild(kirakott.firstChild); 
  }

  //megkeresi hogy a darabok között hol volt a kép
  let index = undefined;
  for (let i = 0; i <randomList.length; i++){
    if(randomList[i] == id){
      index = i;
    }
  }
  index++;
  
  //kinullázza tömb elemét mert nem marad ott kép
  state[hely] = 0;
  
  //A darabok között újra megjelenik a kép
  const darab = document.getElementById(index);
  darab.style.display = "block";
  
  //törli az utolsó lépést mert visszavontuk
  previd.pop();
}