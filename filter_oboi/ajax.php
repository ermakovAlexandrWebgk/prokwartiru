<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <title>Simple exampletitle</title>>

    <script>type="text/javascript" charset="utf-8" async defer>

        function change() {

            var res = document.getElementById("name").value;

            document.getElementById("namePlace").innerHTML = res;

        }

    </script>

<head>

<body>

    <div>

        <p>My name is <span id="namePlace">span>p>

        <input type="text" id="name" onkeyup="change()">input>

    <div>

<body>

<html>