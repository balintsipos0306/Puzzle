async function sendData(data, url) {
    try {
      const request = await fetch(url, {
        method: 'POST',
        body: data
      });
      const result = await request.json();
      console.log(result);
    } catch (error) {
      console.error(error);
    }
};
const form = document.getElementById('form');
const button = document.getElementById('kuld');
const szoveg = document.getElementById('elkuldve');
  
form.addEventListener('submit', function(e) {
    e.preventDefault();
    var data = new FormData(document.forms.form);
    sendData(data, 'registrate.php');
    
    
    button.disabled = true;
    szoveg.style.color = "green";
    szoveg.style.fontWeight = "bold";
    szoveg.innerHTML="Sikeres regisztráció";
});