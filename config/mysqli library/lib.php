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

/*
 * USE THIS AS YOU WANT
 * JUST UNCOMMENT, COPY TO WHATEVER FILE YOU WANT TO PERFORM WHAT OPERATION
 * YOU WANT, IT'S UP TO YOU!
 * IF YOU COPY TO ANOTHER FILE, JUST REQUIRE THE FILE connect.php
 * 
 */

//echo 'Sucess!';
//
// $db->method();
// $db->propertie;
//

/*
// inserting data in database table
if (isset($_GET['name'])){
    echo $name = $db->real_escape_string(trim($_GET['name']));
    if (!($insert = $db->query("INSERT INTO users(nome,morada,pais,situacao) VALUES ('{$name}','Tondela','Portugal','empregado')"))){
        echo "Insert operation failed: (" . $db->errno . ") " . $db->error;
        $db->close();
    }  else {
        echo("Sucess!");
        $db->close();
    }
}

// selecting data in database table
if (($result = $db->query("SELECT * FROM users"))){
    if (($count = $result->num_rows)){
        echo '<p>', $count ,'</p>';
        
        while($row = $result->fetch_object()){
            echo $row->nome, ' ', $row->morada, ' ', $row->pais, ' ', $row->situacao, '<br>';
        }
        $result->free();
        $result->close();
        $db->close();
    }
}  else {
    echo 'No were found in the table!';
    $db->close();
}

// updating data in database table
if (!($db->query("UPDATE users SET pais='Spain' WHERE id=3"))){
    echo "Update operation failed: (" . $db->errno . ") " . $db->error;
    $db->close();
}  else {
    echo $db->affected_rows;
    $db->close();
}

// deleting data in database table
if (!($db->query("DELETE FROM users WHERE id=2"))){
    echo "Delete operation failed: (" . $db->errno . ") " . $db->error;
    $db->close();
}  else {
    echo $db->affected_rows;
    $db->close();
}

*/
?>
