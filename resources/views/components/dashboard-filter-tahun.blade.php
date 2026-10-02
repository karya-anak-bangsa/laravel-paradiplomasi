{{--
    Dropdown tahun di kanan header kartu dashboard (lebar col-lg-2). Pembungkus
    tipis untuk <x-dashboard-filter-select> — perilakunya dijelaskan di sana.

    Props:
    - name         : nama parameter query, mis. `tahun_akumulasi`
    - tahunOptions : daftar tahun (dari DashboardController)
    - anchor       : id kartu pemilik dropdown (kartu yang diganti saat berubah)
--}}
@props(['name', 'tahunOptions' => [], 'anchor'])

<x-dashboard-filter-select
    :name="$name"
    :options="collect($tahunOptions)->mapWithKeys(fn ($tahun) => [$tahun => $tahun])->all()"
    :anchor="$anchor"
    semua="Semua Tahun" />
