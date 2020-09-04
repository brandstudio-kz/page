<?php

namespace BrandStudio\Page;

use BrandStudio\Publishable\Interfaces\Publishable;
use BrandStudio\Identifiable\Interfaces\Identifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\Sluggable;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\SluggableScopeHelpers;
use BrandStudio\Page\Facades\TemplateManager;
use BrandStudio\Publishable\Traits\Publishable as PublishableTrait;
use BrandStudio\Identifiable\Traits\Identifiable as IdentifiableTrait;

class Page extends Model implements Publishable, Identifiable
{
    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;
    use PublishableTrait, IdentifiableTrait;

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
                'source' => 'name',
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
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
