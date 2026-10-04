{{-- Sel checkbox per baris untuk ekspor parsial. $id: primary key baris ($item->getKey()). --}}
@props(['id'])

<td class="text-center">
    <input type="checkbox" class="form-check-input border-secondary m-0 align-middle pilih-baris" value="{{ $id }}" aria-label="Pilih baris untuk diekspor">
</td>
