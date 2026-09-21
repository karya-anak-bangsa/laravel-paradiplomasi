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
                    <h3 class="card-title">
                        <i class="fa-solid fa-calendar-days me-1"></i>
                        Agenda Mendatang
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div id="agenda-mendatang-list" class="list-group list-group-flush">
                        {{-- diisi otomatis lewat JS berdasarkan data acara yang belum terlaksana --}}
                    </div>
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
            var namaBulanSingkat = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

            // data acara DKI yang punya tanggal pelaksanaan, dikirim dari
            // TanggalPentingController berdasarkan modul Acara DKI
            var acaraDkiEvents = @json($acaraDkiEvents).map(function(acara) {
                return {
                    title: acara.title,
                    start: new Date(acara.start + 'T00:00:00'),
                    end: new Date(acara.end + 'T00:00:00'),
                };
            });

            function mulaiHariIni(tanggal) {
                return new Date(tanggal.getFullYear(), tanggal.getMonth(), tanggal.getDate());
            }

            function tambahHari(tanggal, jumlah) {
                var hasil = new Date(tanggal);
                hasil.setDate(hasil.getDate() + jumlah);
                return hasil;
            }

            // ---------- render kalender ----------
            var calendarEvents = acaraDkiEvents.map(function(acara) {
                var acaraBeberapaHari = mulaiHariIni(acara.start).getTime() !== mulaiHariIni(acara.end).getTime();

                var event = {
                    title: acara.title,
                    start: acara.start,
                    end: tambahHari(acara.end, 1), // end FullCalendar bersifat eksklusif
                    allDay: true,
                };

                // acara beberapa hari ditandai banner merah, acara 1 hari
                // memakai warna bawaan FullCalendar
                if (acaraBeberapaHari) {
                    event.color = 'var(--tblr-red)';
                    event.backgroundColor = 'var(--tblr-red-lt)';
                    event.borderColor = 'var(--tblr-red-200)';
                }

                return event;
            });

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                firstDay: 1,
                events: calendarEvents,

                // hanya tampilkan judul acara, tanpa jam mulai
                displayEventTime: false,

                // paksa semua acara (1 hari maupun beberapa hari) tampil sebagai
                // blok rata penuh, bukan list-item bertitik yang menjorok
                // (default FullCalendar beda gaya render antara keduanya)
                eventDisplay: 'block',

                // batasi jumlah baris acara per kotak tanggal, sisanya
                // dilipat jadi link "+N lainnya" (popover) supaya tinggi
                // kotak tanggal tetap presisi/rata, baik ada acara maupun tidak
                dayMaxEventRows: 3,
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

            // hitung status waktu acara relatif terhadap hari ini: sedang
            // berlangsung, hari ini, besok, atau H-berapa
            function hitungStatusAgenda(acara) {
                var hariIni = mulaiHariIni(new Date());
                var mulai = mulaiHariIni(acara.start);
                var selesai = mulaiHariIni(acara.end || acara.start);
                var selisihHari = Math.round((mulai - hariIni) / 86400000);

                if (hariIni > mulai && hariIni <= selesai) {
                    return {
                        label: 'Berlangsung',
                        badgeClass: 'bg-success-lt text-success'
                    };
                }
                if (selisihHari === 0) {
                    return {
                        label: 'Hari ini',
                        badgeClass: 'bg-success-lt text-success'
                    };
                }
                if (selisihHari === 1) {
                    return {
                        label: 'Besok',
                        badgeClass: 'bg-orange-lt text-orange'
                    };
                }
                if (selisihHari <= 3) {
                    return {
                        label: 'H-' + selisihHari,
                        badgeClass: 'bg-azure-lt text-azure'
                    };
                }
                return {
                    label: 'H-' + selisihHari,
                    badgeClass: 'bg-blue-lt text-blue'
                };
            }

            function buatItemAgenda(acara) {
                var acaraBeberapaHari = mulaiHariIni(acara.start).getTime() !==
                    mulaiHariIni(acara.end || acara.start).getTime();
                var status = hitungStatusAgenda(acara);

                var item = document.createElement('div');
                item.className = 'list-group-item';

                var wrapper = document.createElement('div');
                wrapper.className = 'd-flex align-items-center';

                // avatar ikon, warna mengikuti jenis acara (beberapa hari = merah,
                // selaras dengan banner di kalender; 1 hari = biru)
                var avatar = document.createElement('span');
                avatar.className = 'avatar me-3 ' + (acaraBeberapaHari ? 'bg-red-lt' : 'bg-blue-lt');
                avatar.innerHTML = '<i class="fa-solid ' +
                    (acaraBeberapaHari ? 'fa-calendar-week' : 'fa-calendar-day') + '"></i>';

                // judul + rentang tanggal
                var infoWrapper = document.createElement('div');
                infoWrapper.className = 'flex-fill text-truncate';

                var judul = document.createElement('div');
                judul.className = 'fw-semibold text-truncate';
                judul.textContent = acara.title;

                var tanggal = document.createElement('div');
                tanggal.className = 'text-secondary text-truncate';
                tanggal.innerHTML = formatRentangTanggal(acara);

                infoWrapper.appendChild(judul);
                infoWrapper.appendChild(tanggal);

                // badge status (H-x / Hari ini / Besok / Berlangsung)
                var badge = document.createElement('span');
                badge.className = 'badge ' + status.badgeClass + ' text-nowrap ms-2';
                badge.textContent = status.label;

                wrapper.appendChild(avatar);
                wrapper.appendChild(infoWrapper);
                wrapper.appendChild(badge);
                item.appendChild(wrapper);

                return item;
            }

            var hariIniSekarang = mulaiHariIni(new Date());
            var agendaBelumTerlaksana = acaraDkiEvents
                .filter(function(acara) {
                    var selesai = mulaiHariIni(acara.end || acara.start);
                    return selesai >= hariIniSekarang;
                })
                .sort(function(a, b) {
                    return a.start - b.start;
                })
                .slice(0, 5); // batasi 5 agenda terdekat

            agendaBelumTerlaksana.forEach(function(acara) {
                agendaListEl.appendChild(buatItemAgenda(acara));
            });
        });
    </script>
@endpush
