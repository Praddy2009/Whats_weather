
<?php
    $weather="";
    $warning="";
    if(isset($_POST['city'])){
        $string =str_replace(' ','',$_POST['city']);

        
        $file_headers=@get_headers("https://www.weather-forecast.com/locations/".$string."/forecasts/latest");
        if($file_headers[0]=='HTTP/1.0 404 Not Found'){
            $warning="Invalid Input! Try Again";
        }
        else{
            $forecastPage=file_get_contents("https://www.weather-forecast.com/locations/".$string."/forecasts/latest");
            $pageArray=explode('(1–3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">',$forecastPage);
            if(sizeof($pageArray) >1){
            $message=explode('</span></p></td>',$pageArray[1]);
            if(sizeof($message)>1){
            $weather= $message[0];
            }
            else{
                $warning="Invalid Input! Try Again";
            }
            }
            else{
                $warning="Invalid Input! Try Again";
            }
        }
    }


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Weather App</title>
  </head>
  
  <body bodybackground="noaa-SLDSYepv0n8-unsplash (2).jpg" class="img-fluid" alt="Responsive image">
       <div class="container">

        <div class="absolute"> 
        <h1 class="text-white font_style">What's the Weather?</h1>
        <br>
        <h5 class="text-white font_style">Enter name of the city</h5>
        <form method="post">
            <div class="form-group m-group col-md-6">
                <input name="city" type="text" class="form-control" id="formGroupExampleInput" placeholder="Eg. London, Tokyo" value ="<?php 
                if(isset($_POST['city']))
                echo $_POST['city']?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div id="tets" class="form-group col-md-6">
        <?php  
            if($weather){

                echo '<div class="alert alert-success" role="alert">
                '.$weather.'
              </div>';
            }
            else if($warning){

                echo '<div class="alert alert-warning" role="alert">
                '.$warning.'
              </div>';
            }
            
        ?>
        </div>
        </div>
        </div> 
        <footer class="page-footer font-small blue pt-4 text-white">
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a id="linking" href="https://praddy2009.github.io/web-developments/Resume%20site/Home.html"> Praddyum Verma</a>
        </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>