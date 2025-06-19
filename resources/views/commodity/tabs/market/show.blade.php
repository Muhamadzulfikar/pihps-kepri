<a href="{{ url($crud->route.'/'.$entry->uuid.'/markets/create') }}" class="btn btn-primary rounded mb-3">Tambah Pasar</a>
<div class="table-responsive">
    <table class="table table-bordered table-vcenter">
        <thead>
        <tr class="text-center">
            <th>NO</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($entry->markets->sortByDesc('start_date') as $market)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $market->format_date }}</td>
                <td>{{ $market->cityMarket->city_market }}</td>
                <td>Rp. {{ number_format($market->price) }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <a href="{{ url($crud->route.'/'.$entry->uuid.'/markets/'.$market->id.'/edit') }}"
                           class="btn btn-warning text-black me-2" data-bs-toggle="tooltip" data-bs-placement="top"
                           data-bs-title="Edit Harga Pasar"
                        >
                            <i class="la la-edit"></i>
                        </a>
                        @include('commodity.tabs.market.buttons.delete')
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Data Tidak Ditemukan</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
