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
  
form.addEventListener('submit', function(e) {
    e.preventDefault();
    var data = new FormData(document.forms.form);
    sendData(data, 'login.php');
    // loggedin();
});

async function loggedin(){
  
  let fetchData = {
    method: 'POST',
    //body: JSON.stringify(),
    headers: new Headers({
      'Content-Type': 'application/json; charset=UTF-8'
    })
  };

  fetch('../PHP/login.php', fetchData)
    .then((response) =>{
      if(!response.ok){
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then((isloggedin) =>{
      var log = isloggedin;
      console.log(log);
    })
    .catch(error =>{
      console.error('Error during fetch operation:',error);
    })
}; 

