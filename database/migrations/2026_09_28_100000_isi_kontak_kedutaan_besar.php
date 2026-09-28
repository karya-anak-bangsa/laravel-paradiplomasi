<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Isi email kantor, telepon kantor, dan website ke-110 kedutaan besar
     * sesuai sheet acuan Kedutaan Besar (lihat CLAUDE.md Bagian 7).
     *
     * Nilainya sama dengan KedutaanBesarPart1Seeder–Part11Seeder. Seeder
     * dipakai untuk instalasi baru; migration ini untuk database yang sudah
     * berjalan (lokal & Hostinger), yang tidak boleh di-seed ulang karena
     * seeder memakai create() (data jadi dobel) dan migrate:fresh menghapus
     * data yang diinput lewat web.
     *
     * Kolom hanya diisi bila masih kosong (NULL), sehingga isian admin lewat
     * halaman Ubah tidak tertimpa. Pada migrate:fresh --seed tabelnya masih
     * kosong saat migration ini jalan, sehingga tidak melakukan apa-apa.
     *
     * Sengaja memakai query builder, bukan model: migration harus tetap bisa
     * dijalankan walau modelnya kelak berubah.
     */
    private const KONTAK = [
        'ae' => ['email_kantor' => 'jakarta@mofa.gov.ae, jakartaemb@mofa.gov.ae', 'telepon_kantor' => '021-520-6518, 021-520-6528, 021-520-6538, 021-520-6552', 'website' => 'https://www.mofa.gov.ae/id-id/Missions/Jakarta'],
        'af' => ['email_kantor' => 'afghanembassy_jkk@yahoo.com, afghanembassy_indo@yahoo.com, jakarta.sr@mfa.gov.af', 'telepon_kantor' => '021-314-3169', 'website' => 'https://afghanembassyjakarta.id/'],
        'al' => ['email_kantor' => 'embassy.jakarta@mfa.gov.al', 'telepon_kantor' => '0819-4431-9310', 'website' => 'https://ambasadat.gov.al/indonezi/'],
        'am' => ['email_kantor' => 'armindonesiaembassy@mfa.am, armsecretariat@gmail.com', 'telepon_kantor' => '021-527-6549, 021-2967-5166, 021-2902-1521', 'website' => 'https://indonesia.mfa.am/hy/'],
        'ao' => ['email_kantor' => 'embangola@pacific.net.sg', 'telepon_kantor' => '0811-909-009', 'website' => null],
        'ar' => ['email_kantor' => 'eisia@mrecic.gov.ar, adm_eisia@mrecic.gov.ar, consulares_eisia@mrecic.gov.ar, comercial_eisia@mrecic.gov.ar', 'telepon_kantor' => '021-230-3061, 021-230-3761', 'website' => 'https://eisia.cancilleria.gob.ar/en/content/embassy'],
        'at' => ['email_kantor' => 'jakarta-ob@bmeia.gv.at', 'telepon_kantor' => '021-2355-4005', 'website' => 'https://www.bmeia.gv.at/oeb-jakarta/'],
        'au' => ['email_kantor' => 'public-affairs-jakt@dfat.gov.au', 'telepon_kantor' => '021-2550-5555', 'website' => 'https://indonesia.embassy.gov.au/jakt/home.html'],
        'az' => ['email_kantor' => 'jakarta@mission.mfa.gov.az, azemb.jak@gmail.com', 'telepon_kantor' => '021-2555-4408', 'website' => 'https://jakarta.mfa.gov.az/en'],
        'ba' => ['email_kantor' => 'amb.dzakarta@mvp.gov.ba, emb.bosnia.herzegovina@gmail.com', 'telepon_kantor' => '021-8370-3022, 021-8370-3093', 'website' => null],
        'bd' => ['email_kantor' => 'mission.jakarta@mofa.gov.bd', 'telepon_kantor' => '021-2359-9482, 021-2359-9483', 'website' => 'https://jakarta.mofa.gov.bd/'],
        'be' => ['email_kantor' => 'jakarta@diplobel.fed.be', 'telepon_kantor' => '021-316-2030', 'website' => 'https://indonesia.diplomatie.belgium.be/'],
        'bg' => ['email_kantor' => 'bgemb.jkt@centrin.net.id, bulvisa.jkt@centrin.net.id, embassy.jakarta@mfa.bg, consular.jakarta@mfa.bg', 'telepon_kantor' => '021-390-4048, 021-391-3130', 'website' => 'https://www.mfa.bg/embassies/indonesia/'],
        'bh' => ['email_kantor' => 'jakarta.mission@mofa.gov.bh, ymirianti.id@mofa.gov.bh', 'telepon_kantor' => '021-2902-1810, 021-2902-1811', 'website' => null],
        'bn' => ['email_kantor' => 'jakarta.indonesia@mfa.gov.bn, kedubesbrunei@gmail.com', 'telepon_kantor' => '021-2168-9041, 021-2168-9042', 'website' => 'https://www.mfa.gov.bn/indonesia-jakarta/theme/home.aspx'],
        'br' => ['email_kantor' => 'brasemb.jacarta@itamaraty.gov.br, embrasil@cbn.net.id', 'telepon_kantor' => '021-526-5656, 021-526-5657, 021-526-5658', 'website' => 'https://www.gov.br/mre/pt-br/embaixada-jacarta/'],
        'by' => ['email_kantor' => 'indonesia@mfa.gov.by, embassybelarusia@yahoo.co.id, id.consul@mfa.gov.by', 'telepon_kantor' => '021-525-1388, 021-525-6256', 'website' => 'https://indonesia.mfa.gov.by/en/'],
        'ca' => ['email_kantor' => 'canadianembassy.jkrta@international.gc.ca, minar.siregar@international.gc.ca, canada.jakarta@international.gc.ca', 'telepon_kantor' => '021-2550-7800', 'website' => 'https://travel.gc.ca/assistance/embassies-consulates/indonesia'],
        'ch' => ['email_kantor' => 'jak.vertretung@eda.admin.ch, jakarta@eda.admin.ch, jakarta.visa@eda.admin.ch', 'telepon_kantor' => '021-525-6061, 021-520-7451', 'website' => 'https://www.eda.admin.ch/jakarta'],
        'cl' => ['email_kantor' => 'echile.indonesia@minrel.gob.cl, emchijak@cbn.net.id', 'telepon_kantor' => '021-3199-7201, 021-3199-7202', 'website' => 'https://www.chile.gob.cl/indonesia/en'],
        'cn' => ['email_kantor' => 'chinaemb_id@mfa.gov.cn', 'telepon_kantor' => '021-576-1039, 021-576-1017, 021-576-1037, 021-576-1021, 021-576-1049, 021-576-1036, 021-576-1032, 021-576-1030', 'website' => 'http://id.china-embassy.gov.cn/eng/'],
        'co' => ['email_kantor' => 'eindonesia@cancilleria.gov.co, ejakarta@cancilleria.gov.co', 'telepon_kantor' => '021-5790-3560', 'website' => 'https://indonesia.embajada.gov.co/'],
        'cr' => ['email_kantor' => 'embcr-id@rree.go.cr', 'telepon_kantor' => '021-572-3165', 'website' => null],
        'cu' => ['email_kantor' => 'embajador@id.embacuba.cu, consul@id.embacuba.cu, secretaria@id.embacuba.cu, cubaindo@cbn.net.id', 'telepon_kantor' => '0815-1914-8957', 'website' => null],
        'cy' => ['email_kantor' => 'cyprusinjakarta@mfa.gov.cy, secretariatjakarta@mfa.gov.cy', 'telepon_kantor' => '021-2554-6251', 'website' => null],
        'cz' => ['email_kantor' => 'jakarta@mzv.gov.cz', 'telepon_kantor' => '0811-924-5663, 0811-924-5664', 'website' => 'https://mzv.gov.cz/jakarta/en/index.html'],
        'de' => ['email_kantor' => 'info@jakarta.diplo.de, l-vz1@jaka.auswaertiges-amt.de, info@jaka.diplo.de, wi-s1@jaka.diplo.de, konsulat@jaka.diplo.de', 'telepon_kantor' => '021-3985-5000, 021-3985-5144', 'website' => 'https://jakarta.diplo.de/id-en'],
        'dk' => ['email_kantor' => 'jktamb@um.dk, jktambconsular@um.dk', 'telepon_kantor' => '021-8665-5100', 'website' => 'https://indonesien.um.dk/'],
        'dz' => ['email_kantor' => 'ambaljak@cbn.net.id', 'telepon_kantor' => '021-525-4719, 021-525-4809', 'website' => 'https://emb-algeria.org/'],
        'ec' => ['email_kantor' => 'eecuindonesia@cancilleria.gob.ec', 'telepon_kantor' => '021-522-6953', 'website' => null],
        'eg' => ['email_kantor' => 'embassyofegypt.jakarta@gmail.com, egypt@indosat.net.id', 'telepon_kantor' => '021-314-3440, 021-3193-1141, 021-3193-5350', 'website' => null],
        'es' => ['email_kantor' => 'emb.yakarta@maec.es, espanyak@pacific.net.sg', 'telepon_kantor' => '021-314-2355', 'website' => 'https://www.exteriores.gob.es/Embajadas/yakarta/en/Paginas/index.aspx'],
        'et' => ['email_kantor' => 'jakarta.embassy@mfa.gov.et, ethembjakarta@gmail.com', 'telepon_kantor' => '0811-8881-2632', 'website' => null],
        'eu' => ['email_kantor' => 'delegation-indonesia@eeas.europa.eu', 'telepon_kantor' => '021-2554-6200, 021-2554-6202, 021-2554-6241, 021-2554-6218, 021-2554-6216, 021-2554-6222', 'website' => 'https://www.eeas.europa.eu/delegations/indonesia_en'],
        'fi' => ['email_kantor' => 'sanomat.jak@formin.fi', 'telepon_kantor' => '021-2939-3000, 021-576-1650', 'website' => 'https://finlandabroad.fi/web/idn/frontpage'],
        'fj' => ['email_kantor' => 'info@fijiembajak.com', 'telepon_kantor' => '021-390-2542, 021-390-2543, 021-390-2647, 021-390-2644, 021-250-6587', 'website' => 'https://fijiembajak.com/en/site/pages/home'],
        'fr' => ['email_kantor' => 'ambassadeur.jakarta-amba@diplomatie.gouv.fr, reception.jakarta-amba@diplomatie.gouv.fr, contact@ambafrance-id.org', 'telepon_kantor' => '021-2355-7600', 'website' => 'https://id.ambafrance.org/'],
        'gb' => ['email_kantor' => 'jakarta.mcs@fco.gov.uk, jakarta.smt@fcdo.gov.uk, consulate.jakarta@fco.gov.uk', 'telepon_kantor' => '021-2356-5200', 'website' => 'https://www.gov.uk/world/organisations/british-embassy-jakarta'],
        'ge' => ['email_kantor' => 'jakarta.emb@mfa.gov.ge', 'telepon_kantor' => '021-2941-0842', 'website' => 'https://indonesia.mfa.gov.ge/'],
        'gr' => ['email_kantor' => 'gremb.jrt@mfa.gr, grcon.jrt@mfa.gr', 'telepon_kantor' => '021-520-7776, 021-520-7761, 021-527-2471', 'website' => 'https://www.mfa.gr/missionsabroad/en/indonesia.html'],
        'gt' => ['email_kantor' => 'embindonesia@minex.gob.gt, embaguateindonesia@gmail.com', 'telepon_kantor' => '021-521-1077, 021-521-1078', 'website' => null],
        'hr' => ['email_kantor' => 'jakarta@mvep.hr', 'telepon_kantor' => '021-525-7611, 021-525-7822', 'website' => 'https://mvep.gov.hr/id'],
        'hu' => ['email_kantor' => 'mission.jkt@mfa.gov.hu, indsec1huemb@telkom.net', 'telepon_kantor' => '021-520-3459, 021-520-3460', 'website' => 'https://jakarta.mfa.gov.hu/eng'],
        'ie' => ['email_kantor' => 'jakartaem@dfa.ie, juni.triani@dfa.ie', 'telepon_kantor' => '021-2809-4300', 'website' => 'https://www.dfa.ie/irish-embassy/indonesia/'],
        'in' => ['email_kantor' => 'info.jakarta@mea.gov.in, admn.jakarta@mea.gov.in, amb.jakarta@mea.gov.in, amboff.india.jakarta@gmail.com', 'telepon_kantor' => '021-252-2299', 'website' => 'https://www.indianembassyjakarta.gov.in/'],
        'iq' => ['email_kantor' => 'iraqembi@rad.net.id', 'telepon_kantor' => '021-390-4067, 021-390-4068, 021-390-4069', 'website' => 'https://mofa.gov.iq/jakarta/'],
        'ir' => ['email_kantor' => 'iranembassy.jakarta@gmail.com, iranemb.jkt@mfa.gov.ir', 'telepon_kantor' => '021-3193-1378, 021-3193-1391, 021-3193-4637', 'website' => 'https://indonesia.mfa.gov.ir/'],
        'it' => ['email_kantor' => 'ambasciata.jakarta@esteri.it, jakarta.segreteria@esteri.it, consolare.jakarta@esteri.it, visa.jakarta@esteri.it', 'telepon_kantor' => '021-3193-7445, 021-3193-7440, 021-390-2451', 'website' => 'https://ambjakarta.esteri.it/it/'],
        'jo' => ['email_kantor' => 'jakarta@fm.gov.jo, jordanem@scbd.net.id', 'telepon_kantor' => '021-515-3484, 021-515-3483', 'website' => null],
        'jp' => ['email_kantor' => 'yanti@dj.mofa.go.jp, historina@dj.mofa.go.jp', 'telepon_kantor' => '021-3192-4308, 021-315-7149', 'website' => 'https://www.id.emb-japan.go.jp/'],
        'ke' => ['email_kantor' => 'jakarta@mfa.go.ke', 'telepon_kantor' => '021-2239-3200', 'website' => 'https://kenyaembassyjakarta.org/'],
        'kh' => ['email_kantor' => 'camembjkt@gmail.com, camemb.jkt@mfaic.gov.kh', 'telepon_kantor' => '021-781-2523, 021-781-2524', 'website' => null],
        'kp' => ['email_kantor' => 'mt.myohyang2018@gmail.com', 'telepon_kantor' => '021-3190-8425, 021-3190-8426, 021-3190-8436, 021-3190-8437', 'website' => null],
        'kr' => ['email_kantor' => 'koremb_in@mofa.go.kr', 'telepon_kantor' => '021-2967-2555, 021-2967-2570', 'website' => 'https://overseas.mofa.go.kr/id-id/index.do'],
        'kw' => ['email_kantor' => 'kuwaitembassy_jkt@yahoo.com, kuwait_jkt@yahoo.com', 'telepon_kantor' => '021-576-4556', 'website' => null],
        'kz' => ['email_kantor' => 'jakarta@mfa.kz', 'telepon_kantor' => '021-252-0252, 021-252-0254, 021-520-7800', 'website' => 'https://www.gov.kz/memleket/entities/mfa-jakarta?lang=en'],
        'la' => ['email_kantor' => 'laoembjktof@hotmail.com, laoprjakarta@gmail.com', 'telepon_kantor' => '021-522-9602, 021-522-9603', 'website' => null],
        'lb' => ['email_kantor' => 'jakarta.leb@gmail.com, emb.lb_jkt@yahoo.com', 'telepon_kantor' => '021-525-3074, 021-526-4306', 'website' => 'http://www.jakarta.mfa.gov.lb/indonesia/english/home'],
        'lk' => ['email_kantor' => 'slembjkt@gmail.com, slemb.jakarta@mfa.gov.lk', 'telepon_kantor' => '021-314-1018, 021-316-1886, 021-3190-2389', 'website' => 'http://srilankaembassyjakarta.com/'],
        'ly' => ['email_kantor' => 'gsplaj@cbn.net.id, safarah.libya@yahoo.com', 'telepon_kantor' => '021-5290-2983', 'website' => null],
        'ma' => ['email_kantor' => 'sifamaind@maec.gov.ma', 'telepon_kantor' => '021-520-0773, 021-520-0956', 'website' => null],
        'mm' => ['email_kantor' => 'mejakarta109@gmail.com, myanmar@cbn.net.id', 'telepon_kantor' => '021-315-8908, 021-315-9095', 'website' => null],
        'mn' => ['email_kantor' => 'jakarta@mfa.gov.mn', 'telepon_kantor' => '021-2168-4133', 'website' => 'https://www.mongolianconsulate.org/'],
        'mr' => ['email_kantor' => 'ambarimjakarta@gmail.com', 'telepon_kantor' => '021-515-2246, 021-515-2247', 'website' => null],
        'mx' => ['email_kantor' => 'embindonesia@sre.gob.mx, embmexico@gmail.com', 'telepon_kantor' => '021-2902-7285, 021-2902-7286', 'website' => 'https://embamex.sre.gob.mx/indonesia/index.php/en/'],
        'my' => ['email_kantor' => 'mwjakarta@kln.gov.my', 'telepon_kantor' => '021-522-4947', 'website' => 'https://www.kln.gov.my/web/idn_jakarta'],
        'mz' => ['email_kantor' => 'consular.jkt@embamoc-indonesia.com, mozambiquesecretary.id@gmail.com, billing.embamoc@gmail.com, mozambiqueconsular@gmail.com', 'telepon_kantor' => '021-3825-0075', 'website' => 'https://embamoc-indonesia.com/'],
        'ng' => ['email_kantor' => 'nigeria.jakarta@foreignaffairs.gov.ng, nigembjkt@yahoo.co.id, social_secretary@yahoo.com, embnig@centrin.net.id', 'telepon_kantor' => '021-526-0922, 021-526-0923, 021-5296-4261', 'website' => null],
        'nl' => ['email_kantor' => 'jak@minbuza.nl, jak-cdp@minbuza.nl', 'telepon_kantor' => '021-524-8200, 021-525-1515', 'website' => 'https://netherlandsandyou.nl/web/indonesia'],
        'no' => ['email_kantor' => 'emb.jakarta@mfa.no', 'telepon_kantor' => '021-2965-0000', 'website' => 'https://www.norway.no/en/indonesia'],
        'nz' => ['email_kantor' => 'nzembjak@cbn.net.id, nz.asean@mfat.govt.nz', 'telepon_kantor' => '021-2995-5800, 021-2995-5825', 'website' => 'https://www.mfat.govt.nz/en/countries-and-regions/asia/indonesia/new-zealand-embassy-and-mission-to-asean/'],
        'om' => ['email_kantor' => 'jakarta@mofa.gov.om, omanreps@yahoo.com, jakarta@fm.gov.om', 'telepon_kantor' => '021-3190-8653, 021-3190-8654, 021-3190-8655', 'website' => null],
        'pa' => ['email_kantor' => 'embassy@panamaembassy.net, consular@panamaembassy.net, panaemb@net2cyber.web.id, kedutaan@panamaembassy.net, msaturno@mire.gob.pa', 'telepon_kantor' => '021-570-0218, 021-571-1867', 'website' => 'https://mire.gob.pa/ministerio/embajada-y-consulado/jakarta/'],
        'pe' => ['email_kantor' => 'embaperujak@gmail.com, conperjakarta@gmail.com, khairina.embaperujak@gmail.com, embassy@embaperujak.org, consular@embaperujak.org', 'telepon_kantor' => '021-576-1820, 021-576-1821', 'website' => 'https://www.gob.pe/embajada-del-peru-en-indonesia'],
        'pg' => ['email_kantor' => 'kdujkt@cbn.net.id, pngemb.jakarta@dfa.gov.pg, inquiries.jakatar@dfa.gov.pg', 'telepon_kantor' => '021-725-1218, 021-725-1225, 021-725-1742', 'website' => 'https://www.kundu-jakarta.com/'],
        'ph' => ['email_kantor' => 'jakartape@gmail.com, jakarta.pe@dfa.gov.ph, jakartape.consular@dfa.gov.ph', 'telepon_kantor' => '021-310-0334', 'website' => 'https://jakartape.dfa.gov.ph/'],
        'pk' => ['email_kantor' => 'pakembassyjakarta@gmail.com, parepjakarta@mofa.gov.pk', 'telepon_kantor' => '021-5785-1836, 021-5785-1837', 'website' => 'https://www.pakembjakarta.com/'],
        'pl' => ['email_kantor' => 'dzakarta.amb.sekretariat@msz.gov.pl, adinda.sumono@msz.gov.pl', 'telepon_kantor' => '021-252-5938, 021-252-5939, 021-252-5940', 'website' => 'https://www.gov.pl/web/indonesia-en/embassy'],
        'ps' => ['email_kantor' => 'palembid@palestineembassyjakarta.com, palembidsec@palestineembassyjakarta.com', 'telepon_kantor' => '021-314-5444, 021-3192-3521', 'website' => null],
        'pt' => ['email_kantor' => 'sconsular.jakarta@mne.pt, jakarta@mne.pt, porembjak@cbn.net.id, portindo@cbn.net.id, portrade@cbn.net.id', 'telepon_kantor' => '021-3190-8030', 'website' => 'https://jacarta.embaixadaportugal.mne.gov.pt/en/'],
        'qa' => ['email_kantor' => 'jakarta@mofa.gov.qa, qataremj@indosat.net.id', 'telepon_kantor' => '021-5790-6560, 021-5790-6561', 'website' => 'https://jakarta.embassy.qa/en'],
        'ro' => ['email_kantor' => 'jakarta@mae.ro, romania.assistant@gmail.com', 'telepon_kantor' => '021-390-0489, 021-310-6240', 'website' => 'http://jakarta.mae.ro/'],
        'rs' => ['email_kantor' => 'embjakarta@serbian-embassy.org, secretary@serbian-embassy.org, consular.jakarta@mfa.rs, srb.emb.indonesia@mfa.rs', 'telepon_kantor' => '021-314-3560, 021-314-3720', 'website' => 'http://www.jakarta.mfa.gov.rs/'],
        'ru' => ['email_kantor' => 'rusemb.indonesia@mid.ru, asean@mid.ru', 'telepon_kantor' => '021-522-2912, 021-522-2914', 'website' => 'https://indonesia.mid.ru/id/'],
        'rw' => ['email_kantor' => 'embassy.jakarta@mfa.gov.rw', 'telepon_kantor' => '021-2359-9277', 'website' => null],
        'sa' => ['email_kantor' => 'idemb@mofa.gov.sa', 'telepon_kantor' => '021-2902-3444, 021-2809-4000, 021-2809-4073', 'website' => 'https://embassies.mofa.gov.sa/sites/Indonesia/AR/Pages/default.aspx'],
        'sb' => ['email_kantor' => 'info@siembassy.org', 'telepon_kantor' => '0856-780-8585', 'website' => null],
        'sd' => ['email_kantor' => 'sdn_indo@yahoo.com, sidahmeda@gmail.com', 'telepon_kantor' => '021-526-5085, 021-525-0486', 'website' => null],
        'se' => ['email_kantor' => 'ambassaden.jakarta@gov.se, ambassaden.jakarta-visum@gov.se', 'telepon_kantor' => '021-2553-5900', 'website' => 'https://www.swedenabroad.se/en/embassies/indonesia-jakarta/'],
        'sg' => ['email_kantor' => 'singemb_jkt@mfa.sg', 'telepon_kantor' => '021-5091-5400, 021-520-1469', 'website' => 'https://www.mfa.gov.sg/Jakarta'],
        'sk' => ['email_kantor' => 'emb.jakarta@mzv.sk', 'telepon_kantor' => '021-310-1068, 021-315-1429', 'website' => 'https://www.mzv.sk/web/jakarta'],
        'sm' => ['email_kantor' => 'asmarino@rsm-indonesia.com', 'telepon_kantor' => '021-252-6055', 'website' => 'https://rsm-indonesia.com/'],
        'so' => ['email_kantor' => 'somalirep_jkt@yahoo.com, somaliemb@indo.net.id', 'telepon_kantor' => '021-7919-2006', 'website' => null],
        'sr' => ['email_kantor' => 'amb.indonesie@gov.sr, embsurinamejakarta@gmail.com', 'telepon_kantor' => '021-720-3890', 'website' => null],
        'sy' => ['email_kantor' => 'syrembjakarta@gmail.com', 'telepon_kantor' => '021-520-4117, 021-525-5991, 021-520-1641', 'website' => null],
        'th' => ['email_kantor' => 'thaijkt@biz.net.id, consular.jkt@mfa.go.th, thaijkt@thaiembassy.co.id', 'telepon_kantor' => '021-2932-8190, 021-2932-8191, 021-2932-8192, 021-2932-8193, 021-2932-8194', 'website' => 'http://www.thaiembassyjakarta.com/en/'],
        'tl' => ['email_kantor' => 'embassyrdtl.jakarta@gmail.com, embassyrdtl.jakarta@mnec.gov.tl', 'telepon_kantor' => '021-2903-9514', 'website' => 'http://www.timorlesteembassy.org/'],
        'tn' => ['email_kantor' => 'at.jakarta@diplomatie.gov.tn, tunjakarta@gmail.com', 'telepon_kantor' => '021-5289-2328, 021-5289-2329', 'website' => null],
        'tr' => ['email_kantor' => 'embassy.jakarta@mfa.gov.tr, jakarta.embassy@mfa.gov.tr', 'telepon_kantor' => '021-525-6250, 021-526-4143, 021-522-7440', 'website' => 'https://jakarta-emb.mfa.gov.tr/Mission'],
        'tz' => ['email_kantor' => 'jakarta@nje.go.tz', 'telepon_kantor' => '021-720-2410, 021-7212-0046', 'website' => 'https://www.id.tzembassy.go.tz/'],
        'ua' => ['email_kantor' => 'emb_id@mfa.gov.ua', 'telepon_kantor' => '021-250-0801', 'website' => 'https://indonesia.mfa.gov.ua/en'],
        'us' => ['email_kantor' => 'jakartaacs@state.gov', 'telepon_kantor' => '021-3435-9000, 021-5083-1000', 'website' => 'https://id.usembassy.gov/'],
        'uy' => ['email_kantor' => 'uruindonesia@mrree.gub.uy', 'telepon_kantor' => '021-2918-3196, 021-2918-3197', 'website' => null],
        'uz' => ['email_kantor' => 'embassyuzbekistan@gmail.com, id.uzembassy@mfa.uz', 'telepon_kantor' => '021-722-9919', 'website' => 'https://uzembassy.id/'],
        'va' => ['email_kantor' => 'nuntius.jakarta@gmail.com', 'telepon_kantor' => '021-384-1142, 021-381-0736', 'website' => 'https://nunciatureindonesia.org/'],
        've' => ['email_kantor' => 'embavenezindonesia@gmail.com, evenjakt@cbn.net.id, embve.idykt@mppre.gob.ve', 'telepon_kantor' => '021-520-0801, 021-5292-2175', 'website' => null],
        'vn' => ['email_kantor' => 'jakarta@mofa.gov.vn, vietnamemb@yahoo.com', 'telepon_kantor' => '021-315-8537, 021-310-0358, 021-315-6775, 021-5793-5714, 021-5793-7715', 'website' => 'https://vietnamembassy-indonesia.org/'],
        'ye' => ['email_kantor' => 'embassyyemen.jakarta@gmail.com', 'telepon_kantor' => '021-310-8029, 021-310-8035', 'website' => null],
        'za' => ['email_kantor' => 'jakarta.political@dirco.gov.za, jakarta.consular@dirco.gov.za', 'telepon_kantor' => '021-2991-2500', 'website' => 'https://dirco1.azurewebsites.net/jakarta/'],
        'zw' => ['email_kantor' => 'zimjakarta@zimfa.gov.zw, zimjakarta@yahoo.com', 'telepon_kantor' => '021-521-0485, 021-521-0486', 'website' => null],
    ];

    public function up(): void
    {
        DB::transaction(function () {
            foreach (self::KONTAK as $kodeNegara => $kontak) {
                foreach ($kontak as $kolom => $nilai) {
                    if ($nilai === null) {
                        continue;
                    }

                    DB::table('tb_kedutaan_besar')
                        ->where('kode_negara', $kodeNegara)
                        ->whereNull($kolom)
                        ->update([$kolom => $nilai, 'updated_at' => now()]);
                }
            }
        });
    }

    /**
     * Kosongkan kembali hanya nilai yang masih sama persis dengan isian
     * migration ini — nilai yang sudah diubah admin dibiarkan.
     */
    public function down(): void
    {
        DB::transaction(function () {
            foreach (self::KONTAK as $kodeNegara => $kontak) {
                foreach ($kontak as $kolom => $nilai) {
                    if ($nilai === null) {
                        continue;
                    }

                    DB::table('tb_kedutaan_besar')
                        ->where('kode_negara', $kodeNegara)
                        ->where($kolom, $nilai)
                        ->update([$kolom => null, 'updated_at' => now()]);
                }
            }
        });
    }
};
