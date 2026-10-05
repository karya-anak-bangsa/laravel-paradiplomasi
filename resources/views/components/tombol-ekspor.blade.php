{{-- $modul: case App\Enums\ModulDiplomasi atau App\Enums\TipeMitra, atau model App\Models\Mitra (riwayat diplomasi satu mitra di halaman profil) — ketiganya punya urlEkspor() --}}
{{-- $judul: judul dropdown. --}}
{{-- Ekspor parsial: tabel di kartu yang sama wajib punya kolom checkbox (<x-pilih-semua /> di thead, <x-pilih-baris :id="$item->getKey()" /> di tiap baris). Pilihan dikirim sebagai query "pilih", dibaca trait MengunduhEkspor. Kartu tanpa table.datatable (mis. profil mitra) otomatis tanpa ekspor parsial. --}}
@props(['modul', 'judul' => 'Sesuai Filter Yang Aktif'])

@php
    // Filter yang sedang aktif ikut dibawa ke tombol ekspor, supaya isi file
    // sama dengan tabel yang sedang dilihat. Index mitra tidak punya filter.
    $filterAktif = array_filter(request()->only(['status', 'tahun']));
@endphp

<div class="dropdown" data-ekspor-pilih>
    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
        <i class="fa-solid fa-download me-2"></i>Ekspor
        <span class="badge bg-blue text-blue-fg ms-2 d-none" data-ekspor-jumlah></span>
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <span class="dropdown-header" data-ekspor-judul>{{ $judul }}</span>
        <a class="dropdown-item" href="{{ $modul->urlEkspor('excel', $filterAktif) }}" data-ekspor-tautan>
            <i class="fa-solid fa-file-excel text-green me-2"></i>Excel (.xlsx)
        </a>
        <a class="dropdown-item" href="{{ $modul->urlEkspor('pdf', $filterAktif) }}" data-ekspor-tautan>
            <i class="fa-solid fa-file-pdf text-red me-2"></i>PDF (.pdf)
        </a>
        <div class="dropdown-divider d-none" data-ekspor-batal-pemisah></div>
        <button type="button" class="dropdown-item d-none" data-ekspor-batal>
            <i class="fa-solid fa-xmark text-secondary me-2"></i>Batalkan semua pilihan
        </button>
    </div>
</div>

@once
    @push('scripts')
        <script>
            // Ekspor parsial: pilihan disimpan di Set (bukan di DOM) karena
            // DataTables hanya menggambar satu halaman — pilihan di halaman
            // lain harus tetap ikut terekspor. Tanpa pilihan = ekspor semua.
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('[data-ekspor-pilih]').forEach(function(menu) {
                    const tabel = menu.closest('.card').querySelector('table.datatable');
                    const dt = tabel && tabel.instanceDataTable;
                    if (!dt) return;

                    const terpilih = new Set();
                    const semua = tabel.querySelector('.pilih-semua');
                    const tautan = menu.querySelectorAll('[data-ekspor-tautan]');
                    const urlDasar = Array.from(tautan, (a) => a.getAttribute('href'));
                    const jumlah = menu.querySelector('[data-ekspor-jumlah]');
                    const judul = menu.querySelector('[data-ekspor-judul]');
                    const judulAwal = judul.textContent;
                    const batal = menu.querySelector('[data-ekspor-batal]');
                    const batalPemisah = menu.querySelector('[data-ekspor-batal-pemisah]');

                    // Checkbox baris yang cocok dengan pencarian aktif, di SEMUA halaman.
                    const kotakTercari = () => dt.rows({ search: 'applied' }).nodes().toArray()
                        .map((tr) => tr.querySelector('.pilih-baris')).filter(Boolean);

                    function perbarui() {
                        const n = terpilih.size;
                        const kotak = kotakTercari();
                        const dipilih = kotak.filter((k) => terpilih.has(k.value)).length;

                        if (semua) {
                            semua.checked = kotak.length > 0 && dipilih === kotak.length;
                            semua.indeterminate = dipilih > 0 && dipilih < kotak.length;
                        }

                        tautan.forEach(function(a, i) {
                            const url = new URL(urlDasar[i], window.location.origin);
                            if (n) url.searchParams.set('pilih', Array.from(terpilih).join(','));
                            a.setAttribute('href', url.toString());
                        });

                        jumlah.textContent = n;
                        jumlah.classList.toggle('d-none', n === 0);
                        judul.textContent = n ? n + ' Data Terpilih' : judulAwal;
                        batal.classList.toggle('d-none', n === 0);
                        batalPemisah.classList.toggle('d-none', n === 0);
                    }

                    // Samakan centang di halaman yang sedang tampil dengan Set.
                    function gambarUlang() {
                        tabel.querySelectorAll('.pilih-baris').forEach((k) => {
                            k.checked = terpilih.has(k.value);
                        });
                        perbarui();
                    }

                    tabel.addEventListener('change', function(e) {
                        if (e.target.classList.contains('pilih-baris')) {
                            e.target.checked ? terpilih.add(e.target.value) : terpilih.delete(e.target.value);
                            perbarui();
                        } else if (e.target === semua) {
                            kotakTercari().forEach((k) => {
                                semua.checked ? terpilih.add(k.value) : terpilih.delete(k.value);
                            });
                            gambarUlang();
                        }
                    });

                    batal.addEventListener('click', function() {
                        terpilih.clear();
                        gambarUlang();
                    });

                    dt.on('draw', gambarUlang);
                    gambarUlang();
                });
            });
        </script>
    @endpush
@endonce
