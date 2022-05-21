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
        return $this->request;
    }

    public function prepareRequst(): self
    {
        foreach ($this->request as &$req) {
            $req = str_replace('\\\\', '\\', addslashes(nl2br(htmlspecialchars(trim($req)))));
        }
        return $this;
    }

    public static function CheckPostMethod(): void
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
            throw new \Exception('нужен метод POST');
    }
}
