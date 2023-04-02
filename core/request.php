<?php

namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $posation = strpos($path, '?');

        if ($posation === false) {
            return $path;
        }
        return substr($path, 0, $posation);
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }

    public function isPut()
    {
        return $this->method() === 'put';
    }

    public function ispatch()
    {
        return $this->method() === 'patch';
    }

    public function isdelete()
    {
        return $this->method() === 'delete';
    }


    public function getBody()
    {
        $body = [];

        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() === 'put') {
            parse_str(file_get_contents('php://input'), $_PUT);

            foreach ($_PUT as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() === 'patch') {
            parse_str(file_get_contents('php://input'), $_PATCH);

            foreach ($_PATCH as $key => $value) {
                $body[$key] = $value;
            }
        }

        if ($this->method() === 'delete') {
            parse_str(file_get_contents('php://input'), $_DELETE);

            foreach ($_DELETE as $key => $value) {
                $body[$key] = $value;
            }
        }

        return $body;
    }
}
