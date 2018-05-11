<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <script src="../../js/app.js" defer></script>
  <title>Sheeps sacrifice</title>
</head>
<body>
  <div id="sheep" class="container">
    <span>Дни:</span><div class='counter'></div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Все</th>
          <th scope="col">Живые</th>
          <th scope="col">Мертвые</th>
          <th scope="col">Самый населенный загон</th>
          <th scope="col">Менее населенный загон</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="sheep in sheeps">
          <td>{{ $sheeps }}</td>
          <td>{{ $sheepActive }}</td>
          <td>{{ $sheepDie }}</td>
          <td>{{ $corralMax }}</td>
          <td>{{ $corralMin }}</td>
        </tr>
      </tbody>
    </table>
  </div>
<script>
  var count = 0
  var isInitialize = document.cookie.search('init=') != -1
  if (isInitialize) {
    dateStart = +document.cookie.match(/init=(.*?);/)[1]
    console.log(dateStart);
    dateEnd = new Date().getTime()
    console.log(dateEnd);
    count = Math.floor((dateEnd - dateStart) / 10000)
    console.log(count);
  } else {
    var date = new Date().getTime()
    document.cookie = "init=" + date
  }
  setInterval(function () {
    if (!(count % 10)) {
      fetch("/api/delete", {
        method: "PUT"
      }).then(function (response) {
        response.json().then(function (json) {
          console.log(json);
        });
      });
    }

    fetch("/api/sheep", {
      method: "POST"
    }).then(function (response) {
      response.json().then(function (json) {
        console.log(json)
      })
    })

    document.querySelector('.counter').innerText = ++count
  }, 10000)
</script>
</body>
</html>
