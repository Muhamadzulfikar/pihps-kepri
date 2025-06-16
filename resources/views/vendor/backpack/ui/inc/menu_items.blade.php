{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

@if (auth()->user()->role === 'super admin' || auth()->user()->role === 'admin')
<x-backpack::menu-item title="Komoditas Pasar Tradisional" icon="la " :link="backpack_url('commodities').'/tradisional'" />
<x-backpack::menu-item title="Komoditas Pasar Modern" icon="la " :link="backpack_url('commodities').'/modern'" />
<x-backpack::menu-item title="Komoditas Pasar Perdangan Besar" icon="la " :link="backpack_url('commodities').'/perdagangan_besar'" />
<x-backpack::menu-item title="Komoditas Pasar Produsen" icon="la " :link="backpack_url('commodities').'/produsen'" />
@endif
