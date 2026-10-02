{{--
    Filter dashboard tanpa muat ulang halaman.

    Saat dropdown `select[data-dashboard-filter]` berubah, URL yang sama diambil
    ulang lewat fetch dengan parameter baru, lalu HANYA kartu pemiliknya
    (`data-kartu` = id kartu) yang diganti. Halaman tidak di-refresh dan posisi
    scroll tidak berubah. Controller tidak tahu-menahu: ia tetap merender
    seluruh halaman seperti biasa, dan kartu yang dibutuhkan diambil dari
    hasilnya.

    Karena kartu diganti, script yang menghidupkannya (grafik, modal) tidak
    boleh hanya jalan sekali saat halaman dimuat. Tiap kartu mendaftarkan
    fungsi init-nya lewat Dashboard.daftar(idKartu, (el) => {...}); fungsi itu
    dipanggil saat halaman dimuat dan setiap kali kartunya diganti, dan boleh
    mengembalikan fungsi pembersih (mis. chart.destroy()). Data kartu dibaca
    dari <script type="application/json" data-kartu-data> di dalam kartunya,
    sehingga ikut berganti bersama kartu.

    Berkas ini harus di-@include SEBELUM kartu-kartu dashboard.
--}}
@push('styles')
    <style>
        .kartu-memuat {
            opacity: .55;
            pointer-events: none;
            transition: opacity .15s;
        }
    </style>
@endpush

@push('scripts')
    <script>
        window.Dashboard = {
            init: {},
            bersih: {},
            daftar(id, fn) {
                this.init[id] = fn;
            },
            // Data JSON milik kartu (lihat data-kartu-data di tiap kartu).
            data(el) {
                return JSON.parse(el.querySelector('script[data-kartu-data]').textContent);
            },
            jalankan(id) {
                const el = document.getElementById(id);
                if (!el || !this.init[id]) return;
                this.bersih[id]?.();
                this.bersih[id] = this.init[id](el) ?? null;
            },
        };

        document.addEventListener('DOMContentLoaded', function() {
            Object.keys(Dashboard.init).forEach((id) => Dashboard.jalankan(id));

            const permintaan = {};

            document.addEventListener('change', async function(e) {
                const pilih = e.target.closest('select[data-dashboard-filter]');
                if (!pilih) return;

                const id = pilih.dataset.kartu;
                const nama = pilih.name;
                // Keadaan filter kartu lain dibaca dari URL sekarang, bukan dari
                // hidden input, supaya selalu yang terbaru.
                const url = new URL(location.href);
                if (pilih.value === '') {
                    url.searchParams.delete(nama);
                } else {
                    url.searchParams.set(nama, pilih.value);
                }

                const lama = document.getElementById(id);
                permintaan[id]?.abort();
                const kendali = permintaan[id] = new AbortController();
                lama.classList.add('kartu-memuat');

                try {
                    const res = await fetch(url, {
                        headers: {'X-Requested-With': 'XMLHttpRequest'},
                        credentials: 'same-origin',
                        signal: kendali.signal,
                    });
                    // Sesi habis -> server mengalihkan ke login; jangan ditempel ke dashboard.
                    if (!res.ok || res.redirected) throw new Error('gagal');

                    const dokumen = new DOMParser().parseFromString(await res.text(), 'text/html');
                    const baru = dokumen.getElementById(id);
                    if (!baru) throw new Error('kartu tidak ditemukan');

                    Dashboard.bersih[id]?.();
                    Dashboard.bersih[id] = null;
                    lama.replaceWith(baru);
                    Dashboard.jalankan(id);
                    history.replaceState(null, '', url);

                    // Kartu diganti, jadi fokus keyboard dikembalikan ke dropdown barunya.
                    baru.querySelector('select[data-dashboard-filter]')?.focus({preventScroll: true});
                } catch (galat) {
                    if (galat.name === 'AbortError') return;
                    // Cadangan: muat ulang biasa ke kartu yang sama.
                    location.assign(url + '#' + id);
                }
            });
        });
    </script>
@endpush
