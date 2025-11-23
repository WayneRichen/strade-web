<x-filament-panels::page>
    <form wire:submit="submit" class="space-y-6">
        {{-- 這行會把 Wizard + 所有欄位畫出來 --}}
        {{ $this->form }}

        {{-- 送出按鈕（預設會在 Wizard 下方） --}}
        <x-filament::button type="submit">
            送出
        </x-filament::button>
    </form>

    {{-- 如果你的表單裡有用到 Actions，記得留這個 --}}
    <x-filament-actions::modals />
</x-filament-panels::page>
