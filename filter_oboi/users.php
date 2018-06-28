<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
</head>

<body>

  <button onclick="loadMails()" id="button">Загрузить</button>
<input type="text" placeholder="введите email" id="checkmail">
  <script>
    function loadMails() {

      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'mails.php', true);
      xhr.send();
      xhr.onreadystatechange = function() {
        if (xhr.readyState != 4) return;
        button.innerHTML = 'Готово!';
        if (xhr.status != 200) {
        
        } else {
        var jsonResponse = JSON.parse(xhr.response);
          console.log(xhr.response);
          console.log(jsonResponse);
        }
      }
      button.innerHTML = 'Загружаю...';
      button.disabled = true;
    }
  </script>

</body>

</html>