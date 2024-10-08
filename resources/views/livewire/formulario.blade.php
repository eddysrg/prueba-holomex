<?php

use Livewire\Volt\Component;
use App\Models\Worker;

new class extends Component {

    public $dataRegister = [
        'name' => '',
        'lastname' => '',
        'work' => '',
        'age' => '',
];

    public function createRegister()
    {
        Worker::create([
            'name' => $this->dataRegister['name'],
            'lastname' => $this->dataRegister['lastname'],
            'work' => $this->dataRegister['work'],
            'age' => $this->dataRegister['age'],
    ]);
    }
    
}; ?>

<div>
    <h1 class="mb-3 uppercase font-semibold">Crear registro</h1>
    <form wire:submit='createRegister' class="space-y-5">
        <div class="flex flex-col gap-2">
            <label for="name">Nombre</label>
            <input id="name" name="name" wire:model='dataRegister.name' type="text">
        </div>

        <div class="flex flex-col gap-2">
            <label for="lastname">Apellidos</label>
            <input wire:model='dataRegister.lastname' id="lastname" name="lastname" type="text">
        </div>

        <div class="flex flex-col gap-2">
            <label for="work">Profesión</label>
            <input wire:model='dataRegister.work' id="work" name="work" type="text">
        </div>

        <div class="flex flex-col gap-2">
            <label for="age">Edad</label>
            <input wire:model='dataRegister.age' id="age" name="age" type="number" name="" id="">
        </div>

        <button class="mt-5 bg-blue-500 p-3 rounded text-white">Registrar</button>
    </form>
</div>