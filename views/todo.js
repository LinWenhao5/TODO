fetch('/todo/json')
  .then(function(response) {
    return response.json();
  })
  .then(function(json) {
    for (let i = 0; i < json.length; i++) {
      console.log(json[0].status);
      var element = document.createElement("LI")
      complete_link = document.createElement('a');
      edit_link = document.createElement('a');
      if (json[0].status == 1) {
        complete_link.setAttribute('href', `/Todo/complete/${json[i].id}`);
        var complete_text = document.createTextNode('complete')
      } else {
        complete_link.setAttribute('href', `/Todo/delete/${json[i].id}`);
        var complete_text = document.createTextNode('delete')
      }
      edit_link.setAttribute('href', `/Todo/edit_page/${json[i].id}`);
      var edit_text = document.createTextNode('edit')
      var litext = document.createTextNode(`${json[i].description}(${json[i].num}) `);
      element.appendChild(litext);
      complete_link.appendChild(complete_text);
      edit_link.appendChild(edit_text);
      document.getElementById("myList").appendChild(element);
      element.appendChild(complete_link);
      element.appendChild(edit_link);
    }
  });


