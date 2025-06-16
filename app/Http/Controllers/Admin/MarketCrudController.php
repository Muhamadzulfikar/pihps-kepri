<?php

namespace App\Http\Controllers\Admin;

use App\Enums\CityEnum;
use App\Enums\InflationStatusEnum;
use App\Enums\MarketEnum;
use App\Http\Requests\MarketRequest;
use App\Models\Commodity;
use App\Models\InflationHistory;
use App\Models\Market;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Prologue\Alerts\Facades\Alert;

class MarketCrudController extends CrudController
{
    use CreateOperation {
        store as traitStore;
    }
    use UpdateOperation {
        update as traitUpdate;
    }
    use DeleteOperation;

    protected Commodity $commodity;
    protected string $marketType;

    public function setup(): void
    {
        $this->commodity = Commodity::find(Route::getCurrentRoute()->parameter('commodity_uuid'));
        $this->marketType = Route::getCurrentRoute()->parameter('market_type');
        $this->crud->setModel(Market::class);
        $this->crud->setRoute("admin/commodities/{$this->marketType}/{$this->commodity->uuid}/markets");
        $this->crud->setEntityNameStrings('Pasar', 'Pasar');
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }

    protected function setupCreateOperation(): void
    {
        $this->crud->setValidation(MarketRequest::class);
        $this->crud->addFields([
            [
                'name' => 'commodity_uuid',
                'type' => 'hidden',
                'value' => $this->commodity->uuid,
            ],
            [
                'label' => 'Komoditas',
                'name' => 'commodity_name',
                'type' => 'text',
                'value' => $this->commodity->name->readableText(),
                'attributes' => ['readonly' => 'readonly'],
            ],
            [
                'label' => 'Nama',
                'name' => 'name',
                'type' => 'enum',
                'options' => MarketEnum::toArrayWithReadableText(),
            ],
            [
                'label' => 'Kota / Kabupaten',
                'name' => 'city',
                'type' => 'enum',
                'options' => CityEnum::toArrayWithReadableText(),
            ],
            [
                'label' => 'Harga',
                'name' => 'price',
                'type' => 'number',
                'prefix' => 'Rp.',
                'suffix' => 'Kg',
            ],
            [
                'label' => 'Tanggal',
                'name' => 'start_date',
                'type' => 'date',
            ],
        ]);

        $this->crud->removeSaveActions(['save_and_edit', 'save_and_new']);
        $this->crud->addSaveActions([
            [
                'name' => 'save',
                'button_text' => 'Save and Back',
            ],
        ]);
    }

    public function store(): RedirectResponse
    {
        $request = $this->crud->validateRequest();

        DB::beginTransaction();

        try {
            $response = $this->traitStore();
            $this->countInflation($this->crud->entry);

        } catch (Exception $exception) {
            Alert::error($exception->getMessage())->flash();
            return redirect()->back()->withErrors($exception->getMessage())->withInput($request->all());
        }

        DB::commit();

        return $response;
    }

    public function update(): RedirectResponse
    {
        $request = $this->crud->validateRequest();

        DB::beginTransaction();

        try {
            $response = $this->traitUpdate();
            $this->countInflation($this->crud->entry);

        } catch (Exception $exception) {
            Alert::error($exception->getMessage())->flash();
            return redirect()->back()->withErrors($exception->getMessage())->withInput($request->all());
        }

        DB::commit();

        return $response;
    }

    private function countInflation(Market $market): void
    {
        $markets = Market::where('commodity_uuid', $market->commodity_uuid)->get();

        $fiveLatestDates = $markets->sortBydesc('start_date')->unique('start_date')->take(5)->pluck('start_date')->sort()->values();

        foreach ($fiveLatestDates as $index => $fiveLatestDate) {
            $averageAllToday = collect();

            foreach (CityEnum::cases() as $cityEnum) {
                $marketCity = $markets->where('city', $cityEnum)->where('start_date', $fiveLatestDate);
                $averageToday = $marketCity->average('price');

                $averageAllToday->push(['averageByCity' => $averageToday]);
            }

            $averageAllToday = $averageAllToday->average('averageByCity');

            $inflation = 0;
            $percentage = 0;

            if (isset($fiveLatestDates[$index - 1])) {
                $yesterday = $fiveLatestDates[$index - 1];
                $averageYesterday = InflationHistory::where('commodity_uuid', $market->commodity_uuid)
                    ->where('start_date', $yesterday)
                    ->value('average');

                if (!is_null($averageYesterday)) {
                    $inflation = $averageAllToday - $averageYesterday;
                    $percentage = $averageYesterday != 0 ? ($inflation / $averageYesterday) * 100 : 0;
                }
            }


            $status = match (true) {
                $inflation > 0 => InflationStatusEnum::Naik,
                $inflation < 0 => InflationStatusEnum::Turun,
                default => InflationStatusEnum::Tetap,
            };

            InflationHistory::updateOrCreate(
                [
                    'commodity_uuid' => $market->commodity_uuid,
                    'start_date' => $fiveLatestDate,
                ],
                [
                    'commodity_uuid' => $market->commodity_uuid,
                    'average' => $averageAllToday,
                    'inflation' => $inflation,
                    'percentage' => $percentage,
                    'start_date' => $fiveLatestDate,
                    'status' => $status,
                ]
            );
        }
    }
}
