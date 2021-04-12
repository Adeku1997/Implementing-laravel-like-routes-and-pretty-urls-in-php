<?php
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    die($_SERVER['REQUEST_METHOD'] . ' method is not allowed');
}