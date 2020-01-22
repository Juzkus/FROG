<?php

include_once "include.php";
include_once "lib/parsedown/Parsedown.php";

$pd = new Parsedown();
$markup = $pd->text("## Some Heading");
echo $markup;
?>