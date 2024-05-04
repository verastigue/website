<?php 

session_start();

require("../models/InstructorModel.php");

$instructorModel = new InstructorModel($db);

require("../views/instructorpage.view.php");