@php use App\Enums\CityEnum;use App\Enums\CommodityCategoryEnum;use App\Enums\InflationStatusEnum;use App\Enums\MarketEnum;use App\Enums\MarketTypeEnum;use Carbon\Carbon; @endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PIHPS Kepri</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.3.2/dist/css/tabler.min.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"
          integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .logo-gradient {
            background: linear-gradient(135deg, #4CAF50, #2196F3, #FF9800);
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-gradient::before {
            content: '';
            width: 28px;
            height: 28px;
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .brand-subtitle {
            font-size: 0.65rem;
            line-height: 1.1;
            color: var(--tblr-muted);
        }

        /* Map Section */
        .map-section {
            background: rgba(45, 55, 72, 0.8);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .map-content {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 20px;
            align-items: start;
        }

        .map-container {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .map-image-container {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .map-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            display: block;
        }

        .city-hotspot {
            position: absolute;
            width: 20px;
            height: 20px;
            background: rgba(255, 107, 107, 0.8);
            border: 2px solid #FF4444;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.2s ease;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .city-hotspot:hover {
            background: rgba(255, 68, 68, 1);
            transform: translate(-50%, -50%) scale(1.3);
            box-shadow: 0 0 15px rgba(255, 68, 68, 0.6);
        }

        .city-hotspot::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            background: rgba(255, 107, 107, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
            100% {
                transform: translate(-50%, -50%) scale(2);
                opacity: 0;
            }
        }

        .city-list {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        .city-list-header {
            background: rgba(0, 0, 0, 0.3);
            padding: 12px 15px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            font-weight: 600;
            font-size: 14px;
        }

        .city-list-content {
            max-height: 300px;
            overflow-y: auto;
        }

        .city-item {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            padding: 10px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 13px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .city-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .city-item:last-child {
            border-bottom: none;
        }

        .coordinate-batam {
            top: 9%;
            left: 45%;
        }

        .coordinate-pinang {
            top: 16%;
            left: 69%;
        }

        @media (max-width: 768px) {
            .map-content {
                grid-template-columns: 1fr; /* Jadi 1 kolom saja */
            }

            .map-container,
            .city-list {
                width: 100%;
            }

            .city-list {
                margin-top: 20px;
            }
        }
    </style>
</head>
<body class="text-white"
      style="background-color: #3f91cd; background-image: radial-gradient(circle, #3f91cd, #0e314b);">
<header class="navbar navbar-expand-md navbar-light bg-white border-bottom">
    <div class="container-xl">
        <!-- Brand -->
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/" class="d-flex align-items-center text-decoration-none">
                <div class="logo-gradient me-3"></div>
                <div>
                    <div class="fw-bold text-dark fs-4 lh-1">SPP KEPRI</div>
                    <div class="brand-subtitle">SATGAS PANGAN<br>POLDA KEPULAUAN<br>RIAU</div>
                </div>
            </a>
        </h1>

        <!-- Mobile toggle and other controls -->
        <div class="navbar-nav flex-row order-md-last">
            <!-- User Avatar -->
             <div class="nav-item me-3">
                 <a href="/admin" class="btn btn-dark py-1 px-4">Login</a>
             </div>

            <!-- Mobile menu button -->
            <div class="d-md-none">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav mx-md-auto"> <!-- mx-md-auto akan membuat menu ini berada di tengah untuk md ke atas -->

                </ul>
            </div>
        </div>
    </div>
</header>


<div class="container mt-3">
    <h1 class="text-center mb-5">Informasi Harga Pangan di Daerah Kepulauan Riau</h1>
    <div class="d-flex row justify-content-end">
        <form method="GET" action="{{ url('/') }}" class="col-2 mb-3">
            <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                <option value="">Kategori Komoditas</option>
                @foreach (\App\Models\CommodityCategory::select('name')->get() as $commodityCategory)
                    <option value="{{ $commodityCategory->name }}"
                        {{ request('category') === $commodityCategory->name ? 'selected' : '' }}>
                        {{ $commodityCategory->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="map-section">
        <div class="map-content">
            <!-- MAP -->
            <div class="map-container">
                <div class="map-image-container">
                    <img
                        src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/image-JJp7rr3QvwocUl4EAAOhYrhXobXcDz.png"
                        alt="Peta Kepulauan Riau" class="map-image">
                </div>
            </div>

            <div class="city-list">
                <div class="city-list-header">
                    <span>KOTA</span>
                    <span>HARGA <br>{{$category ?? ''}}</span>
                </div>
                <div class="city-list-content">
                    @foreach($cities as $city)
                        @php $avg = $markets?->whereIn('city_market_id', $cityMarkets->where('city_id', $city->id)->pluck('id')->all())->avg('price') @endphp
                        <div class="city-item">
                            <span>{{$city->name}}</span>
                            <span>Rp. {{number_format($avg ?? 0, 0, ',', '.')}}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="row border-top border-white pt-3">
        {{--Header Komoditas--}}
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h2 class="ms-3">Harga Rata-Rata dan Perubahan {{ Carbon::today()->translatedFormat('j F Y') }}</h2>
            </div>
            {{--Filter Jenis Pasar --}}
            <div class="col-md-6">
                <form method="GET" action="{{ url('/') }}" class="d-flex justify-content-end align-items-center gap-2">
                    <select name="market_type" id="marketType" class="form-select w-auto" onchange="this.form.submit()">
                        <option value="">Jenis Pasar</option>
                        @foreach (MarketTypeEnum::cases() as $type)
                            <option value="{{ $type->value }}"
                                {{ request('market_type') === $type->value ? 'selected' : '' }}>
                                {{ $type->readableText() }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            {{--Filter Jenis Pasar End--}}
        </div>
        {{--Header Komoditas End--}}

        {{--Content Komoditas--}}
        @foreach ($commodities as $commodity)
            <div class="col-6 col-md-3 col-12">
                <button type="button" data-bs-toggle="modal"
                        data-bs-target="#commodity-{{ $loop->iteration }}"
                        class="rounded border-0 p-0 text-white w-100 mb-3"
                        style="background-color: rgba(44, 62, 80, 0.4);">

                    <p class="text-center p-1 m-0 fw-bold"
                       style="background-color: #2c3e50;">
                        {{ $commodity->name }}
                    </p>

                    @php $inflationHistory = $commodity->inflationHistories->sortByDesc('start_date')->first(); @endphp
                    @if ($inflationHistory)
                        <div class="d-flex px-2 py-2 justify-content-between align-items-center"
                             style="min-height: 100px;">
                            <div class="inflation-histories me-2 flex-grow-1"
                                 id="chart-{{ $loop->iteration }}"
                                 data-histories='@json($commodity->inflationHistories)'>
                            </div>
                            <div class="text-end">
                                <h3 class="m-0 mb-1">
                                    Rp. {{ number_format($inflationHistory?->average, 0, ',', '.') }}</h3>
                                <span class="fw-medium d-block mb-1">PER Kg</span>
                                <div class="badge {{$inflationHistory->status->badgeColor()}} text-white mb-1 d-block">
                                    @if($inflationHistory->status !== InflationStatusEnum::Tetap)
                                        <small class="fw-bold">
                                            <i class="la {{$inflationHistory->status->badgeIcon()}} me-1"></i>
                                            {{ number_format($inflationHistory?->percentage ?? 0, 2) ?? '0' }}% -
                                            Rp. {{ number_format($inflationHistory?->inflation ?? 0, 0, ',', '.') }}
                                        </small>
                                    @else
                                        <small class="fw-bold">
                                            <i class="la {{$inflationHistory->status->badgeIcon()}}"></i>
                                            Harga Tetap
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="d-flex justify-content-center align-items-center" style="min-height: 100px;">
                            <p class="m-0">Belum ada data</p>
                        </div>
                    @endif
                </button>

                <div class="modal fade" id="commodity-{{$loop->iteration}}" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{$commodity->name}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                                <div class="table-responsive">
                                    @php
                                        $markets = $commodity->markets->sortBy('start_date')->values();
                                        $dates = $markets->pluck('start_date')->unique()->sort()->take(-5)->values();
                                    @endphp

                                    <table class="table table-bordered table-vcenter mt-2">
                                        <thead>
                                        <tr>
                                            <th>Nama</th>
                                            @foreach ($dates as $date)
                                                <th>{{ Carbon::parse($date)->format('d / m / Y') }}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($cities as $city)
                                            <tr>
                                                <td>{{ $city->name }}</td>
                                                @foreach ($dates as $date)
                                                    @php
                                                        $price = $markets
                                                            ->where('start_date', $date)
                                                            ->whereIn('city_market_id', $cityMarkets->where('city_id', $city->id)->pluck('id')->all())
                                                            ->avg('price') ?? 0;
                                                    @endphp
                                                    <td>Rp. {{ number_format($price, 0, ',', '.') }}</td>
                                                @endforeach
                                            </tr>

                                            @foreach ($cityMarkets as $cityMarket)
                                                @if ($cityMarket->city_id === $city->id)
                                                    <tr>
                                                        <td class="ps-4">{{ $cityMarket->name }}</td>
                                                        @foreach ($dates as $date)
                                                            @php
                                                                $price = $markets
                                                                    ->where('start_date', $date)
                                                                    ->where('city_market_id', $cityMarket->id)
                                                                    ->first()?->price ?? 0;
                                                            @endphp
                                                            <td>Rp. {{ number_format($price, 0, ',', '.') }}</td>
                                                        @endforeach
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{--Content Komoditas End--}}
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.3.2/dist/js/tabler.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    document.querySelectorAll('.inflation-histories').forEach((inflationHistory) => {
        let data = JSON.parse(inflationHistory.dataset.histories);

        // Urutkan data berdasarkan tanggal (ascending)
        data.sort((a, b) => new Date(a.start_date) - new Date(b.start_date));

        // Formatter tanggal ke format Indonesia
        function formatTanggal(dateStr) {
            const date = new Date(dateStr);
            return new Intl.DateTimeFormat('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            }).format(date);
        }

        Highcharts.chart(inflationHistory.id, {
            chart: {
                type: 'areaspline',
                backgroundColor: 'transparent',
                height: 150,
            },
            title: {text: null},
            xAxis: {
                categories: data.map(item => formatTanggal(item.start_date)), // <-- diubah di sini
                visible: false
            },
            yAxis: {
                visible: false
            },
            legend: {enabled: false},
            credits: {enabled: false},
            tooltip: {
                useHTML: true,
                backgroundColor: '#34495e',
                borderColor: '#1abc9c',
                style: {
                    color: '#fff'
                },
                formatter: function () {
                    const index = this.point.index;
                    const pointData = data[index];
                    return `
                    <b>Tanggal:</b> ${formatTanggal(pointData.start_date)}<br/>
                    <b>Harga:</b> Rp ${pointData.average}<br/>
                    <b>Perubahan:</b> ${pointData.inflation === 0 ? 0 : pointData.inflation}
                `;
                }
            },
            plotOptions: {
                areaspline: {
                    fillOpacity: 0.3,
                    lineWidth: 2,
                    marker: {
                        enabled: true,
                        radius: 5
                    }
                }
            },
            series: [{
                name: 'Harga',
                data: data.map(item => ({
                    y: item.inflation,
                    marker: {
                        fillColor: item.status === 'naik' ? 'red' : 'green',
                    }
                }))
            }]
        });
    });
</script>
</body>
</html>
