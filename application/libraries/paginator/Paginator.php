<?php

  class Paginator {
  
    private $base_url;
    private $total_items;
    private $page_count;
    private $current_page;
    private $config = array(
      'items_per_page' => 15,
      'links_per_page' => 10,
      'etc_text' => '...',
      'show_previous_next_links' => true,
      'previous_link_text' => 'Previous',
      'next_link_text' => 'Next',
      'show_first_last_links' => true,
      'first_link_text' => 'First',
      'last_link_text' => 'Last'
    );

    function __construct($config = array()) {
      foreach (array_keys($config) as $key) {
        $this->config[$key] = $config[$key];
      }
      $delimeter = (strpos($_SERVER['REQUEST_URI'], '&')) ? '&' : '?';
      $segments = explode($delimeter . 'page=', $_SERVER['REQUEST_URI']);
      while (count($segments) > 1) {
        array_pop($segments);
      }
      $this->base_url = $segments[0] . ((strpos($segments[0], '?')) ? '&' : '?');
    }

    public function initialize($total_items) {
      $this->total_items = $total_items;
      $this->page_count = ceil($this->total_items / $this->config['items_per_page']);
      $this->current_page = 1;
      if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $this->current_page = $_GET['page'];
        if ($_GET['page'] < 1) {
          $this->current_page = 1;
        } else if ($_GET['page'] > $this->page_count) {
          $this->current_page = $this->page_count;
        }
      }
    }

    public function paginate() {
      if ($this->page_count > 1) {
        $pagination = '<div class="pagination">';
        $pagination .= $this->first_link();
        $pagination .= $this->previous_link();
        $range = $this->determine_page_range();
        if ($range[0] > 1) {
          $pagination .= $this->etc_text();
        }
        for ($i = $range[0]; $i <= $range[1]; $i++) {
          $pagination .= ($i == $this->current_page) ? $this->current_page() : $this->page_link($i);
        }
        if ($range[1] < $this->page_count) {
          $pagination .= $this->etc_text();
        }
        $pagination .= $this->next_link();
        $pagination .= $this->last_link();
        $pagination .= '</div>';
        return $pagination;
      }
    }

    private function first_link() {
      if ($this->config['show_first_last_links']) {
        if ($this->current_page == 1) {
          return '<span class="pagination-first disabled">' . $this->config['first_link_text'] . '</span>';
        }
        return '<a href="' . $this->base_url . 'page=1" class="pagination-first">' . $this->config['first_link_text'] . '</a>';
      }
    }

    private function last_link() {
      if ($this->config['show_first_last_links']) {
        if ($this->current_page == $this->page_count) {
          return '<span class="pagination-last disabled">' . $this->config['last_link_text'] . '</span>';
        }
        return '<a href="' . $this->base_url . 'page=' . $this->page_count . '" class="pagination-last">' . $this->config['last_link_text'] . '</a>';
      }
    }

    private function previous_link() {
      if ($this->config['show_previous_next_links']) {
        if ($this->current_page == 1) {
          return '<span class="pagination-previous disabled">' . $this->config['previous_link_text'] . '</span>';
        }
        return '<a href="' . $this->base_url . 'page=' . ($this->current_page - 1) . '" class="pagination-previous">' . $this->config['previous_link_text'] . '</a>';
      }
    }

    private function next_link() {
      if ($this->config['show_previous_next_links']) {
        if ($this->current_page == $this->page_count) {
          return '<span class="pagination-next disabled">' . $this->config['next_link_text'] . '</span>';
        }
        return '<a href="' . $this->base_url . 'page=' . ($this->current_page + 1) . '" class="pagination-next">' . $this->config['next_link_text'] . '</a>';
      }
    }

    private function etc_text() {
      return '<span class="pagination-etc">' . $this->config['etc_text'] . '</span>';
    }

    private function current_page() {
      return '<em class="pagination-current">' . $this->current_page . '</em>';
    }

    private function page_link($page) {
      return '<a href="' . $this->base_url . 'page=' . $page . '" class="pagination-page">' . $page . '</a>';
    }

    private function determine_page_range() {
      $start = $this->current_page - floor($this->config['links_per_page'] / 2);
      $end = $this->current_page + floor($this->config['links_per_page'] / 2);
      if ($start < 1) {
        $start = 1;
        $end = ($this->config['links_per_page'] > $this->page_count) ? $this->page_count : $this->config['links_per_page'];
      } else if ($end > $this->page_count) {
        $end = $this->page_count;
        $start = ($this->page_count - $this->config['links_per_page'] < 1) ? 1 : $this->page_count - $this->config['links_per_page'];
      }
      return array($start, $end);
    }

  }

?>