<?php
/*
*	The MIT License (MIT)

*	Copyright (c) <2013 - 2014> <Filipe Marques - eagle.software3@gmail.com>

*	Permission is hereby granted, free of charge, to any person obtaining a copy
*	of this software and associated documentation files (the "Software"), to deal
*	in the Software without restriction, including without limitation the rights
*	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
*	copies of the Software, and to permit persons to whom the Software is
*	furnished to do so, subject to the following conditions:

*	The above copyright notice and this permission notice shall be included in
*	all copies or substantial portions of the Software.

*	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
*	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
*	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
*	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
*	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
*	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
*	THE SOFTWARE.
*
*/

if(dir("config")){
    require_once ("gravatar/grafunc.php");
    require_once ("database/connect.php");
    require_once ("functions/process.php");
    require_once ("functions/sessions.php");
}else{
    die("Not found the directorys!");
}

// accessing $files associative array
// example: $files["header"];
$files = array(
	"yourclass" => require_once("classes/yourclass.php"),
	"header" => "require_once(\"hf/header.php\")",
	"footer" => "require_once(\"hf/footer.php\")",
	"css" => "resources/css/bootstrap.min.css",
	"css-theme" => "resources/css/bootstrap-theme.css",
	"js" => "resources/js/bootstrap.min.js",
	"pt" => require_once("lang/pt.php"),
	"es" => require_once("lang/es.php"),
	"fr" => require_once("lang/fr.php"),
	"us" => require_once("lang/us.php"),
	"uk" => require_once("lang/uk.php"),
	"br" => require_once("lang/br.php")
);

?>
