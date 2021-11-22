fetch('/Login/json')
  .then(function(response) {
    return response.json();
  })
  .then(function(json) {
    console.log(json);
    document.getElementById('title').innerText = json.title;
    document.querySelector('input[type="hidden"]').setAttribute("value", json.title);
    document.querySelector('input[type="submit"]').setAttribute("value", json.title);
    document.getElementById('link').setAttribute("href", `/login/${json.request}`);
    document.getElementById('link').innerText = json.value;
  });
