<?php
$citis = file_get_contents("http://api.boxberry.de/json.php?token=12396.rzpqbfca&method=ListCities");
print_r(json_decode($citis)) ;