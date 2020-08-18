<?php

namespace BrandStudio\Page\Http\Controllers;

use BrandStudio\Page\Http\Requests\PageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use BrandStudio\Page\Facades\TemplateManager;

class PageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    public function setup()
    {
        CRUD::setModel(config('page.page_class'));
        CRUD::setRoute(config('backpack.base.route_prefix') . '/page');
        CRUD::setEntityNameStrings(trans_choice('brandstudio::page.pages', 1), trans_choice('brandstudio::page.pages', 2));
        CRUD::orderBy('status', 'desc')->orderBy('lft');
    }

    protected function setupListOperation()
    {
        CRUD::addColumns([
            [
                'name' => 'name',
                'label' => trans('brandstudio::page.name'),
            ],
            [
                'name' => 'status',
                'label' => trans('brandstudio::page.status'),
                'type' => 'select_from_array',
                'options' => config('page.page_class')::getStatusOptions(),
            ],
            [
                'name' => 'updated_at',
                'label' => trans('brandstudio::page.updated_at'),
                'type' => 'datetime',
            ],
            [
                'name' => 'created_at',
                'label' => trans('brandstudio::page.created_at'),
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(PageRequest::class);
        $template = request()->template ?? $this->crud->entry->template ?? null;

        CRUD::addFields([
            [
                'name' => 'name',
                'label' => trans('brandstudio::page.name'),
                'attributes' => [
                    'required' => true,
                ],
                'wrapperAttributes' => [
                    'class' => 'form-group col-sm-8 required',
                ]
            ],
            [
                'name' => 'status',
                'label' => trans('brandstudio::page.status'),
                'type' => 'select2_from_array',
                'options' => config('page.page_class')::getStatusOptions(),
                'wrapperAttributes' => [
                    'class' => 'form-group col-sm-4'
                ]
            ],
            [
                'name' => 'template',
                'label' => trans('brandstudio::page.template'),
                'type' => 'select2_from_array',
                'options' => TemplateManager::getTemplates(),
                'allows_null' => true,
                'value' => $template,
                'attributes' => [
                    'onchange' => "if (confirm('Обновить страницу?')) {window.location.search='template='+this.value;}",
                ],
                'wrapperAttributes' => [
                    'class' => 'form-group col-sm-12',
                ],
            ],
        ]);

        $template = TemplateManager::getTemplate($template);
        CRUD::addFields($template->allFields());
    }

    protected function setupUpdateOperation()
    {
        $entry = $this->crud->getEntry(request()->id);
        $this->setupCreateOperation();
    }

    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'name');
        CRUD::set('reorder.max_level', 1);
    }
}
