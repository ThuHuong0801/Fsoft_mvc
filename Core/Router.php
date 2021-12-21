<?php

namespace Core;

/**
 * Router
 * @param $method
 * @param $pattern
 * @param array $dest
 * eg: $this->register('get', '/users/detail/{id}, ['UserController', 'detail'])
 * eg: $this->register('get', '/users/{name}/{id}, 'delete')
 */
class Router
{
    private $routeTable = [];
    private $currentRoute = null;

    function register($method, $pattern, $dest = [])
    {
        /*
        $this->routeTable = [
            'get' => [
                'pattern1' => ['controller'=>'xxx', 'action'=>'yy', 'params'=>'zz']
            ]
        ]
        */
        if(is_array($dest))
        {
            $dest = [$dest];
        }
        $method = strtolower($method);
        $this->routeTable[$method][$pattern] = [
            'controller' => $dest[0],
            'action' => $dest[1] ?? 'index'
        ];
    }

    //match current url to route table and set current route
    private function matching()
    {
        //currentRoute = ['controller' => '', 'method' => '...', 'params'=> ['id' =>111]]
        $url = parse_url($_SERVER['REQUEST_URI']);
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $path = $url['path'];

        $patternScore = [];
        foreach ($this->routeTable[$method] as $pattern => $controller)
        {
            if($pattern === $path)
            {
                $this->currentRoute = $this->routeTable[$method][$pattern];
                break;
            }
            $patternScore[] = $this->patternScore($path, $pattern);
        }

        usort($patternScore, function ($a, $b)
        {
            if($a['score'] === $b['score'])
            {
                return count($a['params']) < count($b['params']);
            }
            return $a['score'] < $b['score'];
        });

        $this->currentRoute = $this->routeTable[$method][$patternScore[0]['pattern']];
        $this->currentRoute['params'] = $patternScore[0]['params'];
    }




    private function patternScore($path, $patternStr)
    {
        $path = explode('/',$path);
        $pattern = explode('/',$patternStr);

        if(count($path) != count($pattern))
        {
            return ['score' => 0, 'params' => [], 'pattern' => $patternStr];
        }

        $score = 0;
        $param = [];
        foreach($pattern as $i => $section)
        {
            if($path[$i] == $section)
            {
                $score += 1;
            } else
            {
                $p = $this->convertParam($section);
                if($p)
                {
                    $param[$p] = $path[$i];
                }
            }
        }
        return ['score' => $score, 'params'=>$param, 'pattern'=> $patternStr];
    }

    private function convertParam($section)
    {
        $start = substr($section, 0, 1);
        $end = substr($section, -1, 1);
        if($start == '{' && $end == '}')
        {
            return str_replace(['{', '}'], '', $section);
        }
        return '';
    }

    function getRoute()
    {
        $this->matching();
        return $this->currentRoute;
    }
}