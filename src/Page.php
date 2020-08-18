<?php

namespace BrandStudio\Page;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable as SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use BrandStudio\Page\Facades\TemplateManager;

class Page extends Model
{
    use CrudTrait;
    use SluggableTrait, SluggableScopeHelpers;

    const DRAFT     = 0;
    const PUBLISHED = 1;

    protected $table = 'pages';
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_source',
                'onUpdate' => true,
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeDraft($query)
    {
        $query->where('status', static::DRAFT);
    }

    public function scopePublished($query)
    {
        $query->where('status', static::PUBLISHED);
    }

    public function scopeFindBySlugOrFail($query, string $slug)
    {
        return $query->where('slug', $slug)->firstOrFail();
    }
    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    public static function getStatusOptions() : array
    {
        return [
            static::DRAFT => trans('brandstudio::page.draft'),
            static::PUBLISHED => trans('brandstudio::page.published'),
        ];
    }


    public function getSlugSourceAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->name;
    }


    public function template()
    {
        return TemplateManager::getTemplate($this->template);
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
