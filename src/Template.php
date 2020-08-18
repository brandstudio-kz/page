<?php

namespace BrandStudio\Page;

class Template
{

    protected $seo = true;

    public static function key() : string
    {
        return strtolower(class_basename(static::class));
    }

    public static function name() : string
    {
        return trans('template.'.static::key());
    }


    public function fields() : array
    {
        return [];
    }

    public function allFields() : array
    {
        return array_merge($this->fields(), $this->seoFields());
    }

    public function seoFields() : array
    {
        return [
            [
                'name' => 'seo_title',
                'label' => trans('brandstudio::page.seo_title'),
                'tab' => trans('brandstudio::page.seo'),
            ],
            [
                'name' => 'seo_description',
                'label' => trans('brandstudio::page.seo_description'),
                'type' => 'textarea',
                'tab' => trans('brandstudio::page.seo'),
            ],
            [
                'name' => 'seo_keywords',
                'label' => trans('brandstudio::page.seo_keywords'),
                'type' => 'textarea',
                'hint' => trans('brandstudio::page.seo_keywords_hint'),
                'tab' => trans('brandstudio::page.seo'),
            ],
            [
                'name' => 'seo_image',
                'label' => trans('brandstudio::page.seo_image'),
                'type' => 'image',
                'upload' => true,
                'crop' => false,
                'aspect_ratio' => 0,
                'tab' => trans('brandstudio::page.seo'),
            ],
        ];
    }

}
