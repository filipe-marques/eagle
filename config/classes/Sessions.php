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


class Sessions{
	
	public function generate_new_session_id() {
    	session_regenerate_id();
	}
	
	public function user(){
		if ($_SESSION['sexo'] === 'M') {
        	$user = LABEL_USERO1;
    	} elseif ($_SESSION['sexo'] === 'F') {
        	$user = LABEL_USERO2;
    	}
    	return $user;
	}
	
	public function sexo() {
    	if ($_SESSION['sexo'] === 'M') {
        	$sex = LABEL_SEXO1;
    	} elseif ($_SESSION['sexo'] === 'F') {
        	$sex = LABEL_SEXO2;
    	}
    	return $sex;
	}
	
	public function nothing() {
    	if (empty($_SESSION['id'])) {
    	    header("Location: signin.php");
    	    exit();
    	}
	}

	public function full() {
    	if (isset($_SESSION['id'])) {
    	    header("Location: user.php?page=initial");
    	    exit();
    	}
	}

	public function is_not_admin() {
    	if ($_SESSION['prinome'] != "admin") {
    	    header("Location: user.php?page=initial");
    	    exit();
    	}
	}

	public function is_admin() {
    	if ($_SESSION['prinome'] == "admin") {
    	    header("Location: admin.php");
    	    exit();
    	}
	}
}

?>

