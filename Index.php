<!doctype html>
<html lang="en">
  <head>
    <title>Internship Challenge Solution</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    #style{
      margin:50px;
    }
  </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <!-- <a class="navbar-brand" href="#">Navbar</a> -->
  <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
      aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavId">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Ans 1 & 2  <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="total_sale_of_each_petroleum.php">Ans No. 3</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="top3sale.php">Ans No. 4</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="avg.php">Ans No. 5</a>
      </li>
    </ul>
   
  </div>
</nav>
<?php
//echo phpinfo();

try {
    $db = new PDO('sqlite:mydb3.db');
    $db->exec("CREATE TABLE products (year INT, petroleum_product TEXT, sale INT, country TEXT)");
} catch (PDOException $e) {
    // echo $e->getMessage();
}

$url = 'https://raw.githubusercontent.com/younginnovations/internship-challenges/master/programming/petroleum-report/data.json';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$headers = ["Accept: application/json"];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$res_array = json_decode($response);
if ($response && is_array($res_array)) {
    foreach ($res_array as $res) {
        $sql = "INSERT INTO products('year','petroleum_product','sale','country')VALUES('$res->year','$res->petroleum_product','$res->sale','$res->country')";
        $db->exec($sql);
    }

    echo '<div id="style" class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Success !</strong> JSON file is successfully stored in SQLITE database.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
?>


  </body>
</html>


