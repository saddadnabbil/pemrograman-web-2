<?php

class MY_Helper
{

    public function get($key)
    {
        if (isset($_GET[$key])) {
            return $_GET[$key];
        } else {
            return null;
        }

        // alternatif using method ternary
        // if(isset($_GET[$key])) return $_GET[$key]; else  return null;
    }

    public function post($key)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        } else {
            return null;
        }

        // alternatif using method ternary
        // if(isset($_POST[$key])) return $_POST[$key]; else  return null;
    }

    public function put($key)
    {
        parse_str(file_get_contents("php://input"), $_PUT);
        if (isset($_PUT[$key])) {
            return $_PUT[$key];
        } else {
            return null;
        }

        // alternatif using method ternary
        // if(isset($_PUT[$key])) return $_PUT[$key]; else  return null;
    }

    public function delete($key)
    {
        parse_str(file_get_contents("php://input"), $_DELETE);
        if (isset($_DELETE[$key])) {
            return $_DELETE[$key];
        } else {
            return null;
        }

        // alternatif using method ternary
        // if(isset($_DELETE[$key])) return $_DELETE[$key]; else  return null;
    }
}
