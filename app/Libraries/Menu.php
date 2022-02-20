<?php


namespace App\Libraries;


class Menu
{
    protected $menu_open;
    protected $menu_item;
    protected $menu_close;

    protected $child_open;
    protected $child_first_item;
    protected $child_open_item;
    protected $child_item;
    protected $child_close_item;
    protected $child_close;

    protected $deep_open;
    protected $deep_first_item;
    protected $deep_open_item;
    protected $deep_item;
    protected $deep_close_item;
    protected $deep_close;

    protected $menu_html;
    protected $locale;

    public function __construct($params)
    {
        $this->menu_html = '';
        $this->locale = service('request')->getLocale();
        $this->menu_open = $params['menu_open'] ?? '<nav id="cve_default_nav_wrap"><ul>';
        $this->menu_item = $params['menu_item'] ?? '<li><a href="%s">%s</a></li>';
        $this->menu_close = $params['menu_close'] ?? '</ul></nav>';

        $this->child_open = $params['child_open'] ?? '<li>';
        $this->child_first_item = $params['child_first_item'] ?? '<a href="%s">%s</a>';
        $this->child_open_item = $params['child_open_item'] ?? '<ul>';
        $this->child_item = $params['child_item'] ?? $this->menu_item;
        $this->child_close_item = $params['child_close_item'] ?? '</ul>';
        $this->child_close = $params['child_close'] ?? '</li>';

        $this->deep_open = $params['deep_open'] ?? $this->child_open;
        $this->deep_first_item = $params['deep_first_item'] ?? $this->child_first_item;
        $this->deep_open_item = $params['deep_open_item'] ?? $this->child_open_item;
        $this->deep_item = $params['deep_item'] ?? $this->child_item;
        $this->deep_close_item = $params['deep_close_item'] ?? $this->child_close_item;
        $this->deep_close = $params['deep_close'] ?? $this->child_close;
    }

    public function generator($data, $index = 0)
    {
        $this->menu_html .= $this->menu_open;
        while ($index < count($data)){
            if ($this->isChildren($data[$index])){
                $this->childrenGenerator($data[$index]);
            }else{
                $this->item($data[$index]);
            }

            $index++;
        }
        $this->menu_html .= $this->menu_close;
    }

    public function childrenGenerator($data, $index = 0, $deep = false)
    {
        $this->menu_html .= $deep ? $this->deep_open : $this->child_open;
        if ($deep){
            $this->item($data, $this->deep_first_item);
        }else{
            $this->item($data, $this->child_first_item);
        }
        $this->menu_html .= $deep ? $this->deep_open_item : $this->child_open_item;
        while ($index < count($data->children)){
            $children = $data->children[$index];
            if ($this->isChildren($children)){
                $this->childrenGenerator($children, 0, true);
            }else{
                $this->item($children, $this->child_item);
            }
            $index++;
        }
        $this->menu_html .= $deep ? $this->deep_close_item : $this->child_close_item;
        $this->menu_html .= $deep ? $this->deep_close : $this->child_close;    }

    public function item($data = null, $tag = null)
    {
        $tag = is_null($tag) ? $this->menu_item : $tag;

        if ($data->module == 'content'){
            if ($content = cve_post($data->id)){
                $this->menu_html .= sprintf($tag, cve_post_link($content), cve_post_title($content));
            }
        }elseif($data->module == 'category'){
            if ($category = cve_category($data->id)){
                $this->menu_html .= sprintf($tag, cve_cat_link($category), cve_cat_title($category));
            }
        }elseif($data->module == 'custom'){
            $title = $this->locale . 'title';
            $url = $this->locale . 'url';
            $this->menu_html .= sprintf($tag, $data->$url, $data->$title);
        }
    }

    public function isChildren($data)
    {
        if (isset($data->children) && count($data->children) > 0){
            return true;
        }
        return false;
    }

    public function render()
    {
        return $this->menu_html;
    }
}
