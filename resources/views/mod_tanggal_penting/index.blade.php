@extends('template.app')

{{-- content --}}
@section('nav-kegiatan', 'active')
@section('page-header')
    <x-page-header
        title="Kalender Acara DKI">
    </x-page-header>
@endsection

{{-- content --}}
@section('page-content')

    <div class="row row-cards mb-4">

        {{-- kalender --}}
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div id="calendar-tanggal-penting"></div>
                </div>
            </div>
            {{-- card --}}
        </div>
        {{-- col kalender --}}

        {{-- informasi lainnya --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Agenda Mendatang</h3>
                </div>
                <div id="agenda-mendatang-list" class="list-group list-group-flush">
                    {{-- diisi otomatis lewat JS berdasarkan data acara yang belum terlaksana --}}
                </div>
                <div class="card-body" id="agenda-mendatang-kosong" style="display: none;">
                    <p class="text-secondary mb-0">Tidak ada agenda yang akan datang.</p>
                </div>
            </div>
            {{-- card --}}
        </div>
        {{-- col informasi lainnya --}}

    </div>
    {{-- row --}}

@endsection

@push('scripts')
    <script src="{{ asset('template-backend/tabler-core-1.4.0/dist/libs/fullcalendar/index.global.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar-tanggal-penting');
            var agendaListEl = document.getElementById('agenda-mendatang-list');
            var agendaKosongEl = document.getElementById('agenda-mendatang-kosong');
            var currentYear = new Date().getFullYear();
            var namaBulanSingkat = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

            // TODO: data placeholder - nanti diganti hasil rekap Acara DKI dari sumber data resmi.
            // Contoh sengaja dibatasi pada bulan Agustus - Oktober, dengan variasi:
            // acara 1 hari, acara beberapa hari (banner merah), dan beberapa acara dalam 1 hari yang sama.
            var acaraDkiEvents = [

                // ---------- AGUSTUS ----------
                {
                    title: 'Rapat Koordinasi Persiapan HUT RI',
                    start: new Date(currentYear, 7, 5, 9, 0), // 5 Agustus
                    end: new Date(currentYear, 7, 5, 11, 0),
                },
                {
                    // acara ke-2 di tanggal yang sama (5 Agustus)
                    title: 'Audiensi Delegasi Singapura',
                    start: new Date(currentYear, 7, 5, 13, 0), // 5 Agustus
                    end: new Date(currentYear, 7, 5, 14, 30),
                },
                {
                    // acara 1 hari
                    title: 'Upacara Peringatan HUT Kemerdekaan RI',
                    start: new Date(currentYear, 7, 17, 7, 0), // 17 Agustus
                    end: new Date(currentYear, 7, 17, 9, 0),
                },
                {
                    // acara beberapa hari
                    title: 'Pameran Investasi dan Kerja Sama Jakarta',
                    start: new Date(currentYear, 7, 20, 9, 0), // 20 - 22 Agustus
                    end: new Date(currentYear, 7, 22, 17, 0),
                    color: 'var(--tblr-red)',
                    backgroundColor: 'var(--tblr-red-lt)',
                    borderColor: 'var(--tblr-red-200)',
                },

                // ---------- SEPTEMBER ----------
                {
                    title: 'Rapat Pimpinan Biro KSD',
                    start: new Date(currentYear, 8, 3, 10, 0), // 3 September
                    end: new Date(currentYear, 8, 3, 12, 0),
                },
                {
                    // acara ke-2 di tanggal yang sama (3 September)
                    title: 'Kunjungan Kerja Wakil Gubernur',
                    start: new Date(currentYear, 8, 3, 14, 0), // 3 September
                    end: new Date(currentYear, 8, 3, 16, 0),
                },
                {
                    // acara beberapa hari
                    title: 'Forum Kerja Sama Regional ASEAN',
                    start: new Date(currentYear, 8, 15, 9, 0), // 15 - 17 September
                    end: new Date(currentYear, 8, 17, 17, 0),
                    color: 'var(--tblr-red)',
                    backgroundColor: 'var(--tblr-red-lt)',
                    borderColor: 'var(--tblr-red-200)',
                },
                {
                    // acara 1 hari
                    title: 'Evaluasi Program Kerja Sama Semester II',
                    start: new Date(currentYear, 8, 25, 9, 0), // 25 September
                    end: new Date(currentYear, 8, 25, 11, 0),
                },

                // ---------- OKTOBER ----------
                {
                    // acara 1 hari
                    title: 'Sosialisasi Kebijakan Gubernur',
                    start: new Date(currentYear, 9, 2, 13, 0), // 2 Oktober
                    end: new Date(currentYear, 9, 2, 15, 0),
                },
                {
                    // acara beberapa hari
                    title: 'Kunjungan Kenegaraan Delegasi Jepang',
                    start: new Date(currentYear, 9, 10, 9, 0), // 10 - 12 Oktober
                    end: new Date(currentYear, 9, 12, 17, 0),
                    color: 'var(--tblr-red)',
                    backgroundColor: 'var(--tblr-red-lt)',
                    borderColor: 'var(--tblr-red-200)',
                },
                {
                    title: 'Rapat Evaluasi Akhir Tahun Anggaran',
                    start: new Date(currentYear, 9, 20, 9, 30), // 20 Oktober
                    end: new Date(currentYear, 9, 20, 11, 0),
                },
                {
                    // acara ke-2 di tanggal yang sama (20 Oktober)
                    title: 'Audiensi Komunitas Diaspora Indonesia',
                    start: new Date(currentYear, 9, 20, 13, 0), // 20 Oktober
                    end: new Date(currentYear, 9, 20, 14, 0),
                },
            ];

            // ---------- render kalender ----------
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                firstDay: 1,
                events: acaraDkiEvents,
            });

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                firstDay: 1,
                events: acaraDkiEvents,

                // hanya tampilkan judul acara, tanpa jam mulai
                displayEventTime: false,

                // batasi jumlah baris acara per kotak tanggal, sisanya
                // dilipat jadi link "+N lainnya" (popover) supaya tinggi
                // kotak tanggal tetap presisi/rata, baik ada acara maupun tidak
                dayMaxEventRows: 1,
                moreLinkText: function(n) {
                    return '+' + n + ' lainnya';
                },
            });

            calendar.render();

            // ---------- render daftar agenda yang belum terlaksana ----------
            function formatTanggalSingkat(tanggal) {
                return tanggal.getDate() + ' ' + namaBulanSingkat[tanggal.getMonth()];
            }

            function formatRentangTanggal(acara) {
                var mulai = acara.start;
                var selesai = acara.end || acara.start;
                var satuHari = mulai.toDateString() === selesai.toDateString();

                if (satuHari) {
                    return formatTanggalSingkat(mulai);
                }

                return formatTanggalSingkat(mulai) + ' - ' + formatTanggalSingkat(selesai);
            }

            function buatItemAgenda(acara) {
                var item = document.createElement('div');
                item.className = 'list-group-item';

                var wrapper = document.createElement('div');
                wrapper.className = 'd-flex align-items-center justify-content-between';

                var judul = document.createElement('span');
                judul.className = 'text-body text-truncate flex-fill';
                judul.textContent = acara.title;

                var tanggal = document.createElement('span');
                tanggal.className = 'badge bg-primary-lt text-nowrap';
                tanggal.textContent = formatRentangTanggal(acara);

                wrapper.appendChild(judul);
                wrapper.appendChild(tanggal);
                item.appendChild(wrapper);

                return item;
            }

            var sekarang = new Date();
            var agendaBelumTerlaksana = acaraDkiEvents
                .filter(function(acara) {
                    var selesai = acara.end || acara.start;
                    return selesai >= sekarang;
                })
                .sort(function(a, b) {
                    return a.start - b.start;
                })
                .slice(0, 6); // batasi 6 agenda terdekat

            if (agendaBelumTerlaksana.length === 0) {
                agendaKosongEl.style.display = 'block';
            } else {
                agendaBelumTerlaksana.forEach(function(acara) {
                    agendaListEl.appendChild(buatItemAgenda(acara));
                });
            }
        });
    </script>
@endpush
