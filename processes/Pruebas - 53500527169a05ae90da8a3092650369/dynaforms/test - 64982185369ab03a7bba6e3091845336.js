fetch("https://jsonplaceholder.typicode.com/todos/1")
  .then(response => response.json())
  .then(data => {
    console.log("Respuesta:", data);
  })
  .catch(error => {
    console.error("Error:", error);
  });