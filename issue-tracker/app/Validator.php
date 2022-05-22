<?php

namespace App;

class Validator
{
    protected $request;

    public function __construct(?array $request = null)
    {
        $this->request = $request ?: $_POST;
    }

    public function setRequset(array $request): void
    {
        $this->request = $request;
    }

    public function getRequest(): ?array
    {
        $this->prepareRequst();
        return $this->request;
    }

    private function prepareRequst(): self
    {
        foreach ($this->request as &$req) {
            $req = str_replace('\\\\', '\\', addslashes(htmlspecialchars(trim($req))));
        }
        return $this;
    }

    public function prepareIssueRequst(): self
    {
        $request = $this->request;
        if (empty($request['email']))
            throw new \Exception('email обязателен для заполнения');
        if (!filter_var($request['email'], FILTER_VALIDATE_EMAIL))
            throw new \Exception('некорректный email');
        $request['email'] = str_replace('<br>', '', mb_strtolower($request['email']));

        if (empty($request['name']))
            throw new \Exception('Имя обязательно для заполнения');
            $len = mb_strlen($request['name']);
        if ($len < 3 || $len > 50)      //надо бы вынести например в .env
            throw new \Exception('Имя должно содержать от 3 до 50 символов'); 
        if (preg_match('/[^\p{L}\p{N}\s]/u', $request['name'])) 
            throw new \Exception('Имя должно содержать только алфавитные символы'); 
        $request['name'] = str_replace("\n", '', ucfirst($request['name']));

        if (empty($request['title']))
            throw new \Exception('Заполните название задачи');
        if (($len = mb_strlen($request['title']) < 3) || $len > 100)      
            throw new \Exception('Название задача должно содержать от 3 до 100 символов'); 
        $request['title'] = str_replace("\n", '', $request['title']);

        $this->request = $request;
        return $this;
    }

    public static function CheckPostMethod(): void
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
            throw new \Exception('нужен метод POST');
    }

    public static function pageExist($page, $pagesCount): void
    {
        if ($pagesCount < $page || $page < 0) {
            throw new \Exception('нет такой страницы');
        }
    }

    public static function issueExist($issue): void
    {
        if (empty($issue)) {
            throw new \Exception('нет такой задачи');
        }
    }

    public static function correctUriFormat(string $uri): void
    {
        if (
            substr_count($uri, '.') !== 1 && $uri !== '/' && strpos($uri, '/?') !== 0
            or substr_count($uri, '?') > 1
        )
            throw new \Exception("Невереный формат адресса");
    }

    public static function ControllerExist(string $controller): void
    {
        if (!class_exists($controller))
            throw new \Exception("Контроллер $controller не найден");
    }

    public static function actionExist(string $controller, string $action): void
    {
        if (!method_exists($controller, $action))
        throw new \Exception("Метод $action контроллера $controller не найден");
    }
}
