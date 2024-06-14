<?php

header("Content-Type: text/javascript");

include('js/jquery.js');
include('js/popper.js');
include('js/bootstrap.js');
include('js/pace.js');

if (isset($_GET['admin'])) {
    include('js/datatables.js');

    echo "CKEDITOR_BASEPATH = '/assets/js/ckeditor/';";
    include('js/ckeditor/ckeditor.js');
    include('js/admin.js');
}
