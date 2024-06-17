<?php

declare(strict_types=1);

namespace Core\Http\ViewComponent;

use Core\Helper\Config;
use Core\Helper\Url;

/**
 * BootstrapPagination
 * -----------
 * BootstrapPagination
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Http\ViewComponent
 */
class BootstrapPagination
{
    public int $total_pages;
    public int $total_records;
    public int $per_page;
    public int $current_page;
    public int $offset;

    private string $html;
    private array $query = [];

    /**
     * __construct
     *
     * @param  mixed $total_records
     * @return void
     */
    public function __construct(int $total_records)
    {
        $this->total_records = $total_records;

        $parsed_url = Url::getParseUrl();
        if (isset($parsed_url['query'])) {
            parse_str($parsed_url["query"], $this->query);
        }

        $this->current_page = isset($this->query['page']) ? intval($this->query['page']) : 1;
        $this->per_page = isset($this->query['limit']) ? intval($this->query['limit']) : Config::get('view.pagination.per_page');
        $this->total_pages = intval($this->total_records / $this->per_page);
        if (($this->total_records % $this->per_page) > 0) {
            $this->total_pages += 1;
        }
        if($this->current_page > $this->total_pages) {
            $this->current_page = $this->total_pages;
        }
        $this->offset = ($this->current_page - 1) * $this->per_page;

        $html = $this->begin();

        if ($this->total_pages > 7) {
            if ($this->current_page === 1) {
                $html .= $this->prevButtonDisabled();
                $html .= $this->currentPageActive($this->current_page);
            } else {
                $html .= $this->prevButtonActive($this->current_page - 1);
                $html .= $this->pageButtonActive(1);
            }

            if ($this->total_pages - $this->current_page > 3) {
                if ($this->current_page > 4) {
                    $html .= $this->dotPage();
                    $html .= $this->pageButtonActive($this->current_page - 1);
                    $html .= $this->pageButtonSelected($this->current_page);
                    $html .= $this->pageButtonActive($this->current_page + 1);
                } else {
                    for ($page_no = 2; $page_no <= 5; $page_no++) {
                        if ($this->current_page === $page_no) {
                            $html .= $this->pageButtonSelected($page_no);
                        } else {
                            $html .= $this->pageButtonActive($page_no);
                        }
                    }
                }
            }

            if ($this->total_pages - $this->current_page < 4) {
                $html .= $this->dotPage();
                for ($page_no = $this->total_pages - 4; $page_no <= $this->total_pages - 1; $page_no++) {
                    if ($this->current_page === $page_no) {
                        $html .= $this->pageButtonSelected($page_no);
                    } else {
                        $html .= $this->pageButtonActive($page_no);
                    }
                }
            } else {
                $html .= $this->dotPage();
            }

            if ($this->current_page === $this->total_pages) {
                $html .= $this->pageButtonSelected($this->current_page);
                $html .= $this->nextButtonDisabled();
            } else {
                $html .= $this->pageButtonActive($this->total_pages);
                $html .= $this->nextButtonActive($this->current_page + 1);
            }
        } else {
            if ($this->current_page == 1) {
                $html .= $this->prevButtonDisabled();
            } else {
                $html .= $this->prevButtonActive($this->current_page - 1);
            }
            for ($page_no = 1; $page_no <= $this->total_pages; $page_no++) {
                if ($this->current_page === $page_no) {
                    $html .= $this->pageButtonSelected($page_no);
                } else {
                    $html .= $this->pageButtonActive($page_no);
                }
            }
            if ($this->current_page === $this->total_pages) {
                $html .= $this->nextButtonDisabled();
            } else {
                $html .= $this->nextButtonActive($this->current_page + 1);
            }
        }

        $html .= $this->end();

        $this->html = $html;
    }
    
    /**
     * begin
     *
     * @return string
     */
    private function begin(): string
    {
        return '<nav aria-label="Page navigation example"><ul class="pagination">' . PHP_EOL;
    }
    
    /**
     * end
     *
     * @return string
     */
    private function end(): string
    {
        return '</ul></nav>' . PHP_EOL;
    }    
    /**
     * currentPageActive
     *
     * @param  mixed $page_no
     * @return string
     */
    private function currentPageActive(int $page_no): string
    {
        return '<li class="page-item active" aria-current="page"><span class="page-link">' . ($page_no) . '</span></li>' . PHP_EOL;
    }    
    /**
     * prevButtonActive
     *
     * @param  mixed $page_no
     * @return string
     */
    private function prevButtonActive(int $page_no): string
    {
        $html = '<li class="page-item"><a class="page-link" href="' . $this->getUrl($page_no) . '">' . PHP_EOL;
        $html .= '<svg xmlns="http://www.w3.org/2000/svg" class="me-1 w-5 h-5 icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' . PHP_EOL;
        $html .= '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>' . PHP_EOL;
        $html .= '<polyline points="15 6 9 12 15 18"></polyline></svg><span>Prev</span></a></li>' . PHP_EOL;
        return $html;
    }
    
    /**
     * prevButtonDisabled
     *
     * @return string
     */
    private function prevButtonDisabled(): string
    {
        $html = '<li class="page-item disabled"><span class="page-link">' . PHP_EOL;
        $html .= '<svg xmlns="http://www.w3.org/2000/svg" class="me-1 w-5 h-5 icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' . PHP_EOL;
        $html .= '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>' . PHP_EOL;
        $html .= '<polyline points="15 6 9 12 15 18"></polyline></svg>Prev</span></li>' . PHP_EOL;
        return $html;
    }    
    /**
     * pageButtonActive
     *
     * @param  mixed $page_no
     * @return string
     */
    private function pageButtonActive(int $page_no): string
    {
        return '<li class="page-item"><a class="page-link" href="' . $this->getUrl($page_no) . '">' . ($page_no) . '</a></li>' . PHP_EOL;
    }    
    /**
     * dotPage
     *
     * @return string
     */
    private function dotPage(): string
    {
        return  '<li class="page-item"><span class="page-link">...</span></li>' . PHP_EOL;
    }    
    /**
     * pageButtonSelected
     *
     * @param  mixed $page_no
     * @return string
     */
    private function pageButtonSelected(int $page_no): string
    {
        return '<li class="page-item active" aria-current="page"><span class="page-link">' . ($page_no) . '</span></li>' . PHP_EOL;
    }    
    /**
     * nextButtonDisabled
     *
     * @return string
     */
    private function nextButtonDisabled(): string
    {
        $html = '<li class="page-item disabled"><span class="page-link">Next' . PHP_EOL;
        $html .= '<svg xmlns="http://www.w3.org/2000/svg" class="ms-1 w-5 h-5 icon icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' . PHP_EOL;
        $html .= '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="9 6 15 12 9 18"></polyline></svg></span></li>' . PHP_EOL;
        return $html;
    }    
    /**
     * nextButtonActive
     *
     * @param  mixed $page_no
     * @return string
     */
    private function nextButtonActive(int $page_no): string
    {
        $html = '<li class="page-item"><a class="page-link" href="' . $this->getUrl($page_no) . '"><span>Next</span>' . PHP_EOL;
        $html .= '<svg xmlns="http://www.w3.org/2000/svg" class="ms-1 w-5 h-5 icon icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">' . PHP_EOL;
        $html .= '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="9 6 15 12 9 18"></polyline></svg></a></li>' . PHP_EOL;
        return $html;
    }
    /**
     * getUrl
     *
     * @param  mixed $page_no
     * @return string
     */
    private function getUrl(int $page_no): string
    {
        $parsed_url = Url::getParseUrl();

        if ($page_no == 1) {
            unset($this->query['page']);
        } else {
            $this->query["page"] = $page_no;
        }

        $query = htmlentities(http_build_query($this->query));

        return ($query) ? $parsed_url['path'] . '?' . $query : $parsed_url['path'];
    }

    /**
     * create
     *
     * @param  mixed $total_records
     * @param  mixed $data
     * @return self
     */
    public static function create(int $total_records, array $data = []): self
    {
        return new static($total_records, $data);
    }

    /**
     * __tostring
     *
     * @return string
     */
    public function __tostring(): string
    {
        return $this->html;
    }
}
