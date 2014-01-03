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

require_once ("config/gravatar/grafunc.php");
require_once ("config/database/connect.php");
require_once ("config/functions/process.php");
require_once ("config/functions/sessions.php");

require_once("config/classes/yourclass.php");
require_once("config/classes/process.php");
require_once("config/classes/sessions.php");

// accessing $files associative array
// example: $files['header'];
$files = array(
	"css" => "config/resources/css/bootstrap.min.css",
	"css-theme" => "config/resources/css/bootstrap-theme.css",
	"js" => "config/resources/js/bootstrap.min.js",
	"header" => "config/hf/header.php",
	"footer" => "config/hf/footer.php",
);

/*
require_once("config/lang/pt.php");
require_once("config/lang/es.php");
require_once("config/lang/fr.php");
require_once("config/lang/us.php");
require_once("config/lang/uk.php");
require_once("config/lang/br.php");
*/

?>
