<?php

namespace App\Enums;

enum TipeMitra: string
{
    case KedutaanBesar          = 'Kedutaan Besar';
    case MisiAsingAsean         = 'Misi Asing untuk ASEAN';
    case MisiPermanenAsean      = 'Misi Permanen Negara ASEAN';
    case NonPNA                 = 'Non Perwakilan Negara Asing';
}
