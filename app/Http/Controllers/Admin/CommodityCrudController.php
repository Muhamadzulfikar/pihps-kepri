<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CommodityCategoryEnum;
use App\Enums\CommodityEnum;
use App\Http\Requests\CommodityRequest;
use App\Models\Commodity;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class CommodityCrudController extends CrudController
{
    use ListOperation;
    use ShowOperation {
        show as traitShow;
    }
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;

    protected string $marketType;

    public function setup(): void
    {
        $this->marketType = Route::getCurrentRoute()->parameter('market_type');
        $this->crud->setModel(Commodity::class);
        $this->crud->setRoute('admin/commodities/'.$this->marketType);
        $this->crud->setEntityNameStrings('Komoditas', 'Komoditas');
    }

    protected function setupListOperation(): void
    {
        $this->crud->query->where('market_type', $this->marketType);

        $this->crud->addColumns([
            [
                'label' => 'Nama',
                'name' => 'name_text',
                'type' => 'text',
            ],
            [
                'label' => 'Kategori',
                'name' => 'category_text',
                'type' => 'text',
            ],
            [
                'label' => 'Jenis Pasar',
                'name' => 'market_text',
                'type' => 'text',
            ],
        ]);
    }

    protected function setupCreateOperation(): void
    {
        $this->crud->setValidation(CommodityRequest::class);
        $this->crud->addFields([
            [
                'label' => 'Nama',
                'name' => 'name',
                'type' => 'enum',
                'options' => CommodityEnum::toArrayWithReadableText(),
            ],
            [
                'label' => 'Kategori',
                'name' => 'category',
                'type' => 'enum',
                'options' => CommodityCategoryEnum::toArrayWithReadableText(),
            ],
            [
                'label' => 'Jenis Pasar',
                'name' => 'market_type',
                'type' => 'hidden',
                'value' => $this->marketType,
            ],
        ]);

        $this->crud->removeSaveActions(['save_and_edit', 'save_and_new', 'save_and_preview']);
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }

    protected function show($marketType, $id): View
    {
        $this->crud->setShowView('commodity.show');
        $content = $this->traitShow($id);

        return $content;
    }
}
