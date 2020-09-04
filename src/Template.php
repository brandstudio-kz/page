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
                'label' => trans('page::admin.seo_title'),
                'type' => 'text',
                'tab' => trans('page::admin.seo'),
            ],
            [
                'name' => 'seo_description',
                'label' => trans('page::admin.seo_description'),
                'type' => 'textarea',
                'tab' => trans('page::admin.seo'),
            ],
            [
                'name' => 'seo_keywords',
                'label' => trans('page::admin.seo_keywords'),
                'type' => 'textarea',
                'hint' => trans('page::admin.seo_keywords_hint'),
                'tab' => trans('page::admin.seo'),
            ],
            [
                'name' => 'seo_image',
                'label' => trans('page::admin.seo_image'),
                'type' => 'image',
                'upload' => true,
                'crop' => false,
                'aspect_ratio' => 0,
                'tab' => trans('page::admin.seo'),
            ],
        ];
    }

}
