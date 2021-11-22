fetch('/todo/json')
  .then(function(response) {
    return response.json();
  })
  .then(function(json) {
    console.log(json);
    document.querySelector('input[type="text"]').setAttribute('value', json[0].description);
    document.querySelector('input[type="number"]').setAttribute('value', json[0].num);
    document.querySelector('input[type="hidden"]').setAttribute('value', json[0].id);
    document.querySelector('label').innerText = `id:${json[0].id}`;
  });


