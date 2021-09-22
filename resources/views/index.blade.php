<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('styles/loading.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
</head>
<body>
    <p id="loaderDiv"></p>
    <ul id="tes" style="color: red">
        <div id="data"></div>
    </ul>

    <script>

    var root = 'https://indonesia-covid-19.mathdro.id/api/provinsi/';
    var historyData;

    /* $.ajax({
    url: root,
    method: 'GET',  
    beforeSend: function() {
        $("#loaderDiv").show();
    },
    success: function(data) {
        $("#loaderDiv").hide(1000);
    }
    }).then(function(data) {
    
    resultData = data.data;
    for (let i = 0; i < 10; i++) {
        document.getElementById("data").innerHTML += `
        <div class="data__card">
            <li class="region">${resultData[i]['provinsi']}</li> <br>
            <li class="covid-data">Positif Covid: ${resultData[i]['kasusPosi']}</li> <br>
            <li class="covid-data">Sembuh Covid: ${resultData[i]['kasusSemb']}</li> <br>
            <li class="covid-data">Meninggal Covid: ${resultData[i]['kasusMeni']}</li> <br>
        </div>`;
        
    }

    for (const i in historyData) {
        document.getElementById("tes").innerHTML += `<li>${historyData[i]['countryRegion']}</li> <br> `;
    }

    console.log(historyData);
    }) */

    fetch(root, {
    headers: {
        'Accept': 'application/json'
    }
    })
    .then(res => res.json())
    .then(function(data) {
        resultData = data.data;
        for (let i = 0; i < 10; i++) {
        document.getElementById("data").innerHTML += `
        <div class="data__card">
            <li class="region">${resultData[i]['provinsi']}</li> <br>
            <li class="covid-data">Positif Covid: ${resultData[i]['kasusPosi']}</li> <br>
            <li class="covid-data">Sembuh Covid: ${resultData[i]['kasusSemb']}</li> <br>
            <li class="covid-data">Meninggal Covid: ${resultData[i]['kasusMeni']}</li> <br>
        </div>`;
    }});
    </script>
</body>
</html>