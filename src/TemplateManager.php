<?php

namespace BrandStudio\Page;

use BrandStudio\Page\Template;

class TemplateManager
{

    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getTemplates($menu = null, $seo = null) : array
    {
        $templates = [];
        $files = glob(app_path($this->config['templates_path']).'/*.php');

        foreach($files as $file) {
            $template = $this->class(basename($file));

            if ((empty($menu) || $template::menu() == $menu) && (empty($seo) || $template::seo() == $seo)) {
                $templates[$template::key()] = $template::name();
            }
        }

        return $templates;
    }

    public function getTemplate($template)
    {
        if($template) {
            $class = $this->class($template);
            return new $class;
        }
        return $this->defaultTemplate();
    }

    public function class(string $name) : string
    {
        return "\App\\{$this->config['templates_path']}\\".ucfirst(str_replace('.php', '', $name));
    }

    public function defaultTemplate() : Template
    {
        return new Template;
    }

}
