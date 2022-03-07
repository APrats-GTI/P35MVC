<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <style>

        body {
            background-color: #F0F0F2;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 98vw;
            height: auto;
        }

        .items {
            background-color: #F2F2F2;
            text-align: center;
            border-radius: 3px;

            width: 75%;
            height: 75%;

            font-family: 'Lato', sans-serif;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        header {
            display: block;
            background-color: #A6A6A6;
            border-radius: 10px;
            margin: 2%;
            font-size: x-large;
            padding: 3%;
            /* border: 2px solid blue;  */
        }

        section {
            margin: 2%;
            border-radius: 10px;

            /* border: 2px solid red; */
        }

        p {
            padding: 5%;
            /* border: 2px solid yellow; */
            font-size: x-large;
        }

        hr {
            background-color: #F25C05;
            height: 2px;
        }

        .random-Words {
            margin: 3%;
        }

        button {
            margin: 3%;
            padding: 2%;
            background-color: #F27405;
            font-size: large;
            color: #F2F2F2;
            border-radius: 5px;
            font-size: large;
        }
        .map-container {
            padding: 2%;
        }

        #map {
	        height: 600px;
	        width: 100%;
            border-radius: 5px;
        }


    </style>
    <title>Geography</title>
</head>
<body>
    <div class="container">
        <div class="items">
        <header>
                <h1>Summary</h1>
        </header>
        <section>

            <hr>

            <div class="result-item">
                <?php
                     foreach ($data as $row) {
                        echo "<div>
                                    <p>$row[comunidad] : $row[provincia] : $row[municipios]</p>
                                    <input type='hidden' id='latitud' value='$row[latitud]'>
                                    <input type='hidden' id='longitud' value='$row[longitud]'> 
                                </div>";
                        // print_r($row['latitud']);
                        // echo("<br>");
                        // print_r($row['longitud']);
                    }
                ?>
            </div>
        </section>
        <div class="map-Container">
            <div id="map"></div>
        </div>
        </div>
        
        <script src="js/script.js"></script>
        <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=initMap&libraries=&v=weekly"
      async
    ></script>    
    </div>
</body>
</html>