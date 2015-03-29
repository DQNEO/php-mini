<?php
use Symfony\Component\HttpFoundation\Response;

class WAF
{
    private $actions;
    private $get;
    public $mg;
    private $pathinfo;

    private $db;
    
    public function __construct()
    {
        $this->get = $get = $_GET;
        if (isset($_SERVER['REQUEST_URI'])) {
            $this->pathinfo = $_SERVER['REQUEST_URI'];
        } else {
            $this->pathinfo = '/';
        }

        $this->db = new Model;
    }

    public function param($key)
    {
        if (!isset($this->get[$key])) {
            throw new InvalidArgumentException("$key is not given");
        }
        return $this->get[$key];
    }

    public function get($path, $callback)
    {
        $this->actions['get'][$path] = $callback;
    }

    public function getDB()
    {
        return $this->db;
    }

    public function run()
    {
        foreach ($this->actions['get'] as $route => $ctl) {
            if ($route === $this->pathinfo) {
                $response = $ctl();
                $response->send();
                return;
            }

            if (strpos($route, '{id}') === false) {
                continue;
            }

            $regex = str_replace('{id}', '(\d+)', $route);
            if (preg_match('|'.$regex.'|', $this->pathinfo, $matches)) {
                $arg = $matches[1];
                $response = $ctl($arg);
                $response->send();
                return;
            }
        }

        $response = new Response('Not Found', 404, ['Content-Type' => 'text/plain']);
        $response->send();
        return;
    }
}
