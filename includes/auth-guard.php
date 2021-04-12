<?php
if(!isset($_SESSION['user'])){
    redirectTo('login');
}
