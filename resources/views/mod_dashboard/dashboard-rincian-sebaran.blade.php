   @php
       $jumlahKota = $rincianWilayah->pluck('kota')->unique()->count();
       $jumlahKecamatan = $rincianWilayah->map(fn($baris) => $baris->kota . '|' . $baris->kecamatan)->unique()->count();
       $jumlahKelurahan = $rincianWilayah->count();
   @endphp

   <div class="card">
       <div class="card-header">
           <h3 class="card-title">
               <i class="fa-solid fa-map-location-dot me-1"></i>
               Rincian Sebaran Lokasi Kedutaan Besar
           </h3>
       </div>
       <div class="card-body">

           <div class="row row-cards">
               <div class="col-lg-3">
                   <div class="card">
                       <div class="card-body">
                           <div class="row align-items-center">
                               <div class="col-auto">
                                   <span class="avatar bg-azure-lt"><i class="fa-solid fa-city fa-lg"></i></span>
                               </div>
                               <div class="col-auto">
                                   <div class="fw-semibold">{{ $jumlahKota }} Kota</div>
                                   <div class="text-secondary">Wilayah Kota</div>
                               </div>
                           </div>
                       </div>
                       {{-- card-body --}}
                   </div>
                   {{-- card --}}
               </div>
               {{-- col --}}

               <div class="col-lg-3">
                   <div class="card">
                       <div class="card-body">
                           <div class="row align-items-center">
                               <div class="col-auto">
                                   <span class="avatar bg-teal-lt"><i class="fa-solid fa-map-location-dot fa-lg"></i></span>
                               </div>
                               <div class="col-auto">
                                   <div class="fw-semibold">{{ $jumlahKecamatan }} Kecamatan</div>
                                   <div class="text-secondary">Sebaran Kecamatan</div>
                               </div>
                           </div>
                       </div>
                       {{-- card-body --}}
                   </div>
                   {{-- card --}}
               </div>
               {{-- col --}}

               <div class="col-lg-3">
                   <div class="card">
                       <div class="card-body">
                           <div class="row align-items-center">
                               <div class="col-auto">
                                   <span class="avatar bg-orange-lt"><i class="fa-solid fa-house-chimney fa-lg"></i></span>
                               </div>
                               <div class="col-auto">
                                   <div class="fw-semibold">{{ $jumlahKelurahan }} Kelurahan</div>
                                   <div class="text-secondary">Sebaran Kelurahan</div>
                               </div>
                           </div>
                       </div>
                       {{-- card-body --}}
                   </div>
                   {{-- card --}}
               </div>
               {{-- col --}}

               <div class="col-lg-3">
                   <div class="card">
                       <div class="card-body">
                           <div class="row align-items-center">
                               <div class="col-auto">
                                   <span class="avatar bg-red-lt"><i class="fa-solid fa-landmark fa-lg"></i></span>
                               </div>
                               <div class="col-auto">
                                   <div class="fw-semibold">{{ $totalPerKelurahan }} Data</div>
                                   <div class="text-secondary">Total Mitra PNA</div>
                               </div>
                           </div>
                       </div>
                       {{-- card-body --}}
                   </div>
                   {{-- card --}}
               </div>
               {{-- col --}}

               <div class="col-lg-12">
                   <div class="table-responsive">
                       <table class="table table-vcenter table-bordered">
                           <thead>
                               <tr>
                                   <th width="20%" class="text-start">Kota</th>
                                   <th width="20%" class="text-start">Kecamatan</th>
                                   <th width="20%" class="text-end">Jumlah</th>
                                   <th width="20%" class="text-start">Kelurahan</th>
                                   <th width="20%" class="text-end">Jumlah</th>
                               </tr>
                           </thead>
                           <tbody>
                               @php
                                   $kotaSaatIni = null;
                                   $kecamatanSaatIni = null;
                               @endphp
                               @foreach ($rincianWilayah as $baris)
                                   <tr>
                                       @if ($baris->kota !== $kotaSaatIni)
                                           <td rowspan="{{ $baris->baris_kota }}" class="align-middle fw-bold">
                                               {{ $baris->kota }}
                                           </td>
                                           @php
                                               $kotaSaatIni = $baris->kota;
                                               $kecamatanSaatIni = null;
                                           @endphp
                                       @endif
                                       @if ($baris->kecamatan !== $kecamatanSaatIni)
                                           <td rowspan="{{ $baris->baris_kecamatan }}" class="align-middle text-start">
                                               {{ $baris->kecamatan }}
                                           </td>
                                           <td rowspan="{{ $baris->baris_kecamatan }}" class="align-middle text-end">
                                               <span class="badge bg-info-lt">{{ $baris->jumlah_kecamatan }}</span>
                                           </td>
                                           @php $kecamatanSaatIni = $baris->kecamatan; @endphp
                                       @endif
                                       <td class="text-start">{{ $baris->kelurahan }}</td>
                                       <td class="text-end"><span class="badge bg-info-lt">{{ $baris->jumlah_kelurahan }}</span></td>
                                   </tr>
                               @endforeach
                           </tbody>
                           <tfoot>
                               <tr>
                                   <th class="text-end"></th>
                                   <th class="text-start">Total Kedutaan Besar</th>
                                   <th class="text-end">{{ $totalPerKecamatan }}</th>
                                   <th class="text-end"></th>
                                   <th class="text-end">{{ $totalPerKelurahan }}</th>
                               </tr>
                           </tfoot>
                       </table>
                   </div>
               </div>
               {{-- col --}}
           </div>
           {{-- row --}}

       </div>
       {{-- card-body --}}
   </div>
   {{-- card --}}
