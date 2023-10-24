<?php

$con = mysqli_connect("localhost","root","","megaasia");
/*$con = mysqli_connect("localhost","may28tso","4pjunQ~[Zt","may28tso_postulacionMasiva");*/

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}
