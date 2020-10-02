<?php

namespace BrandStudio\Page;

class Template
{

    public function preparePage($page) : array
    {
        return [
            'id' => $page->id,
            'parent_id' => $page->parent_id,
            'name' => $page->name,
            'slug' => $page->slug,
            'template' => $page->template,

            'seo_title' => $page->seo_title ?? $page->name,
            'seo_image' => $page->seo_image,
            'seo_description' => $page->seo_description,
            'seo_keywords' => $page->seo_keywords,
        ];
    }

    public static function key() : string
    {
        return strtolower(class_basename(static::class));
    }

    public static function name() : string
    {
        return trans('template.'.static::key());
    }

    public static function menu() : bool
    {
        return true;
    }

    public static function fake() : bool
    {
        return false;
    }

    public static function seo() : bool
    {
        return true;
    }



    public function columns() : array
    {
        return [];
    }

    public function allColumns() : array
    {
        if (static::fake()) {
            return [];
        }
        return array_merge($this->columns(), static::seo() ? $this->seoColumns() : []);
    }



    public function fields() : array
    {
        return [];
    }

    public function allFields() : array
    {
        if (static::fake()) {
            return [];
        }
        return array_merge($this->fields(), static::seo() ? $this->seoFields() : []);
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



    public function seoColumns() : array
    {
        return [
            [
                'name' => 'seo_title',
                'label' => trans('admin.seo_title'),
            ],
            [
                'name' => 'seo_image',
                'label' => trans('admin.seo_image'),
                'type' => 'image',
                'width' => '150px',
                'height' => 'auto',
            ],
            [
                'name' => 'seo_description',
                'label' => trans('admin.seo_description'),
                'type' => 'markdown',
            ],
            [
                'name' => 'seo_keywords',
                'label' => trans('admin.seo_keywords'),
                'type' => 'markdown',
            ],
        ];
    }

}
