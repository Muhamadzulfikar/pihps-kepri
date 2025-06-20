<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CityMarketRequest;
use App\Models\City;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CityMarketCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CityMarketCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\CityMarket::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/city-markets');
        CRUD::setEntityNameStrings('Pasar Kota', 'Pasar Kota');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       $this->crud->setColumns([
           [
               'label' => 'Kota / Kabupaten',
               'name' => 'city.name',
               'type' => 'text',
           ],
           [
               'label' => 'Nama',
               'name' => 'name',
               'type' => 'text',
           ],
       ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CityMarketRequest::class);
        $this->crud->addFields([
            [
                'label' => 'Kota / Kabupaten',
                'name' => 'city_id',
                'type' => 'select_from_array',
                'options' => City::select('name', 'id')->pluck('name', 'id')->toArray(),
            ],
            [
                'label' => 'Nama',
                'name' => 'name',
                'type' => 'text',
            ]
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
