   @php
       $jumlahKota = $rincianWilayah->pluck('kota')->unique()->count();
       $jumlahKecamatan = $rincianWilayah->map(fn($baris) => $baris->kota . '|' . $baris->kecamatan)->unique()->count();
       $jumlahKelurahan = $rincianWilayah->count();
   @endphp

   <div class="card" id="kartu-rincian-sebaran">
       <div class="card-header">
           <h3 class="card-title">
               <i class="fa-solid fa-map-location-dot me-1"></i>
               Rincian Sebaran Lokasi Mitra Biro KSD
           </h3>
           <x-dashboard-filter-select
               name="tipe_wilayah"
               :options="$tipeWilayahOptions"
               anchor="kartu-rincian-sebaran"
               semua="Semua Mitra"
               lebar="col-lg-3" />
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
                                   <div class="text-secondary">Total Mitra</div>
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
                                               <a href="#" class="lokasi-klik" data-tingkat="kecamatan"
                                                   data-kota="{{ $baris->kota }}"
                                                   data-kecamatan="{{ $baris->kecamatan }}">{{ $baris->kecamatan }}</a>
                                           </td>
                                           <td rowspan="{{ $baris->baris_kecamatan }}" class="align-middle text-end">
                                               <span class="badge bg-info-lt">{{ $baris->jumlah_kecamatan }}</span>
                                           </td>
                                           @php $kecamatanSaatIni = $baris->kecamatan; @endphp
                                       @endif
                                       <td class="text-start">
                                           <a href="#" class="lokasi-klik" data-tingkat="kelurahan"
                                               data-kota="{{ $baris->kota }}"
                                               data-kecamatan="{{ $baris->kecamatan }}"
                                               data-kelurahan="{{ $baris->kelurahan }}">{{ $baris->kelurahan }}</a>
                                       </td>
                                       <td class="text-end"><span class="badge bg-info-lt">{{ $baris->jumlah_kelurahan }}</span></td>
                                   </tr>
                               @endforeach
                           </tbody>
                           <tfoot>
                               <tr>
                                   <th class="text-end"></th>
                                   <th class="text-start">Total Mitra</th>
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

       {{-- Data modal; dibaca skrip di bawah dan ikut berganti saat kartu diganti (lihat dashboard-ajax) --}}
       @php
           $dataModal = [
               'mitraPerLokasi' => $mitraPerLokasi,
               'labelTipe' => $labelTipeWilayah,
               'semuaTipe' => ! array_key_exists((string) request('tipe_wilayah'), $tipeWilayahOptions),
           ];
       @endphp
       <script type="application/json" data-kartu-data>
           @json($dataModal)
       </script>
   </div>
   {{-- card --}}


{{-- Modal rincian mitra per kecamatan/kelurahan. Pola modal sama dengan x-mitra-riwayat
     (modal-blur, header + tombol tutup, hr-text, datagrid) dan tabelnya sama dengan
     index modul mitra (tabel DataTable). Isinya diisi oleh skrip di bawah. --}}
<button type="button" class="d-none" id="pemicu-modal-lokasi" data-bs-toggle="modal" data-bs-target="#modal-rincian-lokasi" aria-hidden="true" tabindex="-1"></button>

<div class="modal modal-blur fade" id="modal-rincian-lokasi" tabindex="-1" role="dialog" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-lokasi-judul"></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="hr-text hr-text-start">Lokasi</div>
                <div class="datagrid align-items-center mb-3">
                    <div class="datagrid-item">
                        <div class="datagrid-title">Kota</div>
                        <div class="datagrid-content" id="modal-lokasi-kota"></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Kecamatan</div>
                        <div class="datagrid-content" id="modal-lokasi-kecamatan"></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Kelurahan</div>
                        <div class="datagrid-content" id="modal-lokasi-kelurahan"></div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Jumlah Mitra</div>
                        <div class="datagrid-content" id="modal-lokasi-jumlah"></div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-vcenter border-top" id="tabel-modal-lokasi">
                        <thead>
                            <tr>
                                <th style="width: 20%">Negara</th>
                                <th style="width: 30%">Nama Mitra</th>
                                <th style="width: 25%">Nama Diplomat</th>
                                <th style="width: 15%">Jenis Mitra</th>
                                <th data-orderable="false" style="width: 10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Klik nama kecamatan/kelurahan -> modal daftar mitra di lokasi itu.
        // Ruang lingkupnya mengikuti dropdown tipe mitra kartu ini (server-side),
        // jadi data yang dikirim sudah tersaring sesuai pilihan.
        //
        // Kartunya diganti tiap dropdown berubah (lihat dashboard-ajax), jadi
        // klik tautan dipasang ulang lewat Dashboard.daftar(), sedangkan modal
        // (di luar kartu) cukup disiapkan sekali dan membaca data terkini dari
        // variabel di bawah.
        (function() {
            let mitraPerLokasi = [];
            let labelTipe = '';
            let semuaTipe = true;

            const elemenModal = document.getElementById('modal-rincian-lokasi');
            const pemicuModal = document.getElementById('pemicu-modal-lokasi');
            const tabel = document.getElementById('tabel-modal-lokasi');
            const isi = (id, teks) => { document.getElementById(id).textContent = teks; };
            const esc = (teks) => String(teks ?? '').replace(/[&<>"']/g, (c) => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
            }[c]));
            // Dua baris (ID + EN, nama + jabatan) seperti kolom di index mitra.
            const duaBaris = (atas, bawah) => `
                <p class="fst-normal mb-0">${esc(atas) || '-'}</p>
                <small class="fst-italic text-primary mb-0">${esc(bawah) || '-'}</small>`;

            let dataTable = null;

            Dashboard.daftar('kartu-rincian-sebaran', function(kartu) {
                ({mitraPerLokasi, labelTipe, semuaTipe} = Dashboard.data(kartu));

                kartu.querySelectorAll('.lokasi-klik').forEach(function(tautan) {
                    tautan.addEventListener('click', function(e) {
                        e.preventDefault();
                        const {tingkat, kota, kecamatan, kelurahan} = tautan.dataset;

                        const cocok = mitraPerLokasi.filter((mitra) =>
                            (mitra.kota ?? '') === kota
                            && (mitra.kecamatan ?? '') === kecamatan
                            && (tingkat === 'kecamatan' || (mitra.kelurahan ?? '') === kelurahan));

                        isi('modal-lokasi-judul', `Rincian Data Mitra Biro KSD - ${labelTipe}`);
                        isi('modal-lokasi-kota', kota);
                        isi('modal-lokasi-kecamatan', kecamatan);
                        isi('modal-lokasi-kelurahan', tingkat === 'kecamatan' ? 'Seluruh kelurahan' : kelurahan);
                        isi('modal-lokasi-jumlah', `${cocok.length} data`);

                        tabel.querySelector('tbody').innerHTML = cocok.map((mitra) => `
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="flag flag-sm flag-country-${esc(mitra.kode_negara)} me-2"></span>
                                        <span class="fw-bold">${esc(mitra.nama_negara)}</span>
                                    </div>
                                </td>
                                <td>${duaBaris(mitra.nama, mitra.nama_en)}</td>
                                <td>${duaBaris(mitra.nama_diplomat, mitra.jabatan_diplomat)}</td>
                                <td>${esc(mitra.tipe)}</td>
                                <td>
                                    <div class="btn-list flex-nowrap justify-content-center">
                                        <a href="${esc(mitra.url)}" class="btn btn-icon btn-primary"><i class="fa-solid fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>`).join('');

                        // Tabler tidak mengekspos `bootstrap` sebagai global, jadi modal dibuka
                        // lewat tombol pemicu data-bs-toggle seperti modal lain di aplikasi.
                        pemicuModal.click();
                    });
                });
            });

            // DataTable dibuat setelah modal terlihat supaya lebar kolomnya terhitung benar,
            // dan dibuang saat ditutup agar klik berikutnya memulai dari tabel bersih.
            elemenModal.addEventListener('shown.bs.modal', function() {
                dataTable = new DataTable(tabel, {
                    // Kolom Jenis Mitra hanya berguna bila yang tampil campuran tipe.
                    columnDefs: [
                        {targets: 3, visible: semuaTipe},
                        {targets: -1, orderable: false},
                    ],
                    order: [],
                    pageLength: 10,
                    language: {
                        search: 'Cari:',
                        lengthMenu: 'Tampilkan _MENU_ data',
                        info: 'Menampilkan _START_ - _END_ dari _TOTAL_ data',
                        infoEmpty: 'Tidak ada data',
                        paginate: {previous: 'Sebelumnya', next: 'Berikutnya'},
                    },
                });
            });
            elemenModal.addEventListener('hidden.bs.modal', function() {
                dataTable?.destroy();
                dataTable = null;
                tabel.querySelector('tbody').innerHTML = '';
            });
        })();
    </script>
@endpush
