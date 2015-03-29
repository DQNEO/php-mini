<?php
use Symfony\Component\HttpFoundation\Response;

class WAF
{
    private $actions;
    private $get;
    public $mg;
    private $pathinfo;

    public function __construct()
    {
        $this->get = $get = $_GET;
        if (isset($_SERVER['PATH_INFO'])) {
            $this->pathinfo = $_SERVER['PATH_INFO'];
        } else {
            $this->pathinfo = '/';
        }

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
