<div>
    <input type="text" wire:model.debounce.500ms="name">
    <input type="number" wire:model="a">
    <input type="number" wire:model="b">
    Hello name: {{ $name }} {{  $a + $b }}
</div>
