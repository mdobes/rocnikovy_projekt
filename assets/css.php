<?php

header("Content-Type: text/css");

include('css/bootstrap.css');
include('css/font-awesome.css');

if (!isset($_GET['admin'])) {
    include('css/style.css');
} else {
    include('css/sb-admin.css');
    include('css/datatables.css');
}