<?php

use Livewire\Volt\Component;
use App\Models\Worker;

new class extends Component {

    public $datos = [];
    public $dato = [];

    protected $listeners = ['editarDatos'];



    public function obtenerDatos() {
        $this->datos = Worker::all()->toArray();
    }

    public function editarDatos($dato)
    {
        $this->dato = $dato;
        dd($this->dato['id']);
    }
}; ?>

<div>

    <div class="flex justify-center mt-10">
        <button class="px-5 py-2 bg-blue-400 text-white rounded" wire:click='obtenerDatos'>Click para obtener</button>
    </div>

    <div class="border border-zinc-300 grid grid-cols-5 justify-items-center py-4 mx-10 mt-10 rounded font-semibold">
        <h3>Nombre</h3>
        <h3>Apellido</h3>
        <h3>Trabajo</h3>
        <h3>Edad</h3>
        <h3>Editar</h3>
    </div>

    @foreach ($datos as $dato)
    <div class="grid grid-cols-5 place-items-center py-3 mx-10">
        <p>{{$dato['name']}}</p>
        <p>{{$dato['lastname']}}</p>
        <p>{{$dato['work']}}</p>
        <p>{{$dato['age']}}</p>
        <button wire:click='$dispatch("editarDatos"), {dato: {{$dato}}}'
            class="px-5 py-2 bg-yellow-500 rounded text-white">
            Editar
        </button>
    </div>
    @endforeach





    <div>
        <h1 class="mb-3 uppercase font-semibold">Editar registro</h1>
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

            <button wire:model class="mt-5 bg-blue-500 p-3 rounded text-white">Registrar</button>
        </form>
    </div>
</div>