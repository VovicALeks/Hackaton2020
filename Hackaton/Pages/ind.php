<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include "classes/autoload.php";
session_start();
$User = new User();
var_dump($User->Get_By_ID(1));
?>
<!DOCTYPE html>
<html>
<body>
    <head>
    	<meta charset="UTF-8">
    </head>
    <form action="index.php" method="post">
    <textarea id="code" name="Code" style="width:500px;height:500px">
        using System;
        using System.Collections.Generic;
        using System.Linq;
        using System.Text.RegularExpressions;

        namespace Rextester
        {
            public class Program
            {
                public static void Main(string[] args)
                {
                    //Your code goes here
                    Console.WriteLine("Hello, world!");
                }
            }
        }      
    </textarea><br>
    <input type="text" name="element" value="WriteLine"><br>
    <label><input type="radio" name="type" value="FunctionOrKey" checked>Функция</label><br>
    <input type="submit" value="Отправить">
    </form>
</body>
</html>