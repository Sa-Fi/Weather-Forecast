<?php
    $status="";
    $msg="";
if(isset($_POST['get_weather'])){

    $api_key = '9289ede6b6b757ec5b72213d71971d8c';
    $city_name = $_POST['location'];
    // $api_url = "https://api.openweathermap.org/data/2.5/weather?q='.$city_name'&appid='.$api_key";
    
    $api_url ="https://api.openweathermap.org/data/2.5/weather?q={$city_name}&appid={$api_key}";
    
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$api_url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result,true); 
    if($result['cod']==200){
        $status="yes";
    }else{
        $msg=$result['message'];
    }
    $timestamp = time();

}

?> 
<!doctype html>
<html lang="en">
    <head>
        <title>Weather App</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <<div class="weather-container" data-aos="fade-in"data-aos-duration="500">
        <div class="form">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" class="form-control" name="location" placeholder="Enter city" required>
                <button type="submit" class=" btn btn-outline-light mt-2" name="get_weather">Get Weather</button>
            </form>
        </div>
        <div data-aos="fade-up" data-aos-duration="2000">
        <?php if($status=="yes"){ ?>
            <div class="weather-header"><?php echo $result['name'] .",". $result['sys']['country']; ?></div>
            <img src="http://openweathermap.org/img/wn/<?php echo $result['weather']['0']['icon']; ?>@4x.png" alt="Weather Icon">
            <div class="weather-condition"><?php echo $result['weather']['0']['main']; ?></div>
            <div class="weather-details">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                        <div>Humidity</div>
                         <div><?php echo $result['main']['humidity']."%"; ?></div>
                        </div>
                        <div class="col-md-3">
                        <div>Wind</div>
                            <div><?php echo $result['wind']['speed']."m/s"; ?></div>
                        </div>
                        <div class="col-md-3">
                        <div>Temp</div>
                         <div><?php echo $result['main']['temp']-273.15."C"; ?></div>
                        </div>
                        <div class="col-md-3">
                        <div>Feels Like</div>
                          <div><?php echo $result['main']['feels_like']-273.15."C"; ?></div>
                        </div>
                        <div class="date">
                           <div>Date: <?php echo date('d M',$result['dt'])?> </div>
                         </div>
                         <!-- <div class="date">
                           <div>Sunrise: <?php echo date(['precipitation']['mode'])?> </div>
                         </div> -->
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                easing: 'ease-in-out-sine'
            });
    </script>
    </body>
</html>
