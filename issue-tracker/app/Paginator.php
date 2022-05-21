<?php

namespace App;

use App\Route;

class Paginator
{
    private $leight;
    private $linksData;
    private $activePage;
    private $pagesCount;

    public function __construct(int $itemCount, $activePage = 1, int $perPage = 3, int $leight = 2)
    {
        $this->activePage = $activePage ?: 1;
        $this->perPage = $perPage;
        $this->leight = $leight;
        $this->pagesCount = (int)($itemCount / $perPage + ($itemCount % $perPage ? 1 : 0));
        $this->calculateLinksData();
    }

    public function getBootstrapLinks(): ?string
    {
        if ($this->pagesCount < 1) return null; 
        $uri = $_SERVER['REQUEST_URI'];
        if (strpos($uri, '?'))
            $uri = substr($uri, 0, strrpos($uri, '?'));
        $unsetPage = ['page' => null];
        //будут проблемы с переходом например на https
        $adress = 'http://' . Route::modifyActiveUrlQueryParams($unsetPage);
        if ($this->pagesCount) {
            $result = "<ul class=\"pagination justify-content-center mt-2 mb -2\">\n";
            foreach ($this->linksData as $link) {
                $active = $link['active'] ? 'active' : null;
                $literal = $link['literal'];
                if (!empty($link['link'])) {
                    $query = empty($_GET) ? "page=$link[link]" : "&page=$link[link]";
                    $href = 'href = "' . $adress . $query . "\"";
                } else
                    $href = null;
                $result = $result . "<li class=\"page-item $active\"><a class=\"page-link\"$href>$literal</a></li>\n";
            }
            $result = $result . "</ul>\n";
        }
        return $result;
    }

    public function getPagesCount() : int 
    {
        return $this->pagesCount;
    }
  
    private function calculateLinksData(): void
    {
        $this->linksData = [];
        $this->setLinkPrev()
            ->setFirsPageLink()
            ->setleftLinks()
            ->setActivePageLink()
            ->setRightLinks()
            ->setLastPageLink()
            ->setLinkNext();
    }

    private function setLinkPrev()
    {
        if ($this->activePage > 1) {
            array_push($this->linksData, [
                'literal' => '&laquo;',
                'link' => $this->activePage - 1,
            ]);
        }
        return $this;
    }

    private function setFirsPageLink()
    {
        if ($this->activePage > 1) {
            array_push($this->linksData, [
                'literal' => 1,
                'link' => 1,
            ]);
        }
        return $this;
    }

    private function setLinkNext()
    {
        if ($this->activePage < $this->pagesCount) {
            array_push($this->linksData, [
                'literal' => '&raquo;',
                'link' => $this->activePage + 1,
            ]);
        }
        return $this;
    }

    private function setLastPageLink()
    {
        if ($this->activePage < $this->pagesCount) {
            array_push($this->linksData, [
                'literal' => $this->pagesCount,
                'link' => $this->pagesCount,
            ]);
        }
        return $this;
    }

    private function setDots()
    {
        array_push($this->linksData, [
            'literal' => '...',
        ]);
    }

    private function setPageLink($number)
    {
        array_push($this->linksData, [
            'literal' => $number,
            'link' => $number,
        ]);
    }

    private function setActivePageLink()
    {
        array_push($this->linksData, [
            'literal' => $this->activePage,
            'link' => $this->activePage,
            'active' => true,
        ]);
        return $this;
    }

    private function setLeftLinks()
    {
        $leight = $this->leight;
        if (($startLink = $this->activePage - $leight) > 1)
            $this->setDots();
        else $startLink = 2;

        while ($startLink < $this->activePage) {
            $this->setPageLink($startLink++);
        }
        return $this;
    }

    private function setRightLinks()
    {
        $leight = $this->leight;
        $nextPage = $this->activePage;
        while (++$nextPage < $this->pagesCount && $leight-- > 0) {
            $this->setPageLink($nextPage);
        }
        if ($nextPage < $this->pagesCount)
            $this->setDots();
        return $this;
    }
}
