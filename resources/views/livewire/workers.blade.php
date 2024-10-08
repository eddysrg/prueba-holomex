<?php

use Livewire\Volt\Component;
use App\Models\Worker;
use App\Notifications\NewWorker;


new class extends Component {

    public $workers, $workerId;

    public $workerData = [
        'name' => '',
        'lastname' => '',
        'work' => '',
        'age' => '',
    ];

    public function mount()
    {
        $this->workers = Worker::get(); 
    }

    public function rules()
    {
        return [
            'workerData.name' => 'required',
            'workerData.lastname' => 'required',
            'workerData.work' => 'required',
            'workerData.age' => 'required',
        ];
    }

    public function createWorker()
    {
        $this->cleanForm();
        $this->dispatch('open-modal', 'editModal');
    }

    public function store()
    {
        $this->validate();
        Worker::updateOrCreate(['id' => $this->workerId], [
            'name' => $this->workerData['name'],
            'lastname' => $this->workerData['lastname'],
            'work' => $this->workerData['work'],
            'age' => $this->workerData['age']
        ]);

        $this->dispatch('close-modal', 'editModal');

        $message = $this->workerId ? "Registro actualizado correctamente" : "Registro creado correctamente";
        auth()->user()->notify(new NewWorker($message));

        $this->workers = Worker::get();
        $this->cleanForm();


        $this->dispatch('show-alert');
    }

    public function cleanForm()
    {
        $this->workerData = [
            'name' => '',
            'lastname' => '',
            'work' => '',
            'age' => '',
        ];

        $this->workerId = null;
    }

    public function edit($id) 
    {
        $this->dispatch('open-modal', 'editModal');
        $worker = Worker::findOrFail($id);
        $this->workerId = $id;
        $this->workerData = [
            'name' => $worker->name,
            'lastname' => $worker->lastname,
            'work' => $worker->work,
            'age' => $worker->age,
        ];
    }

}; ?>

<div>
    <h1 class="text-center text-2xl uppercase font-semibold">CRUD REGISTROS</h1>

    <div class="flex justify-center mt-10">
        <button class="px-5 py-2 bg-blue-400 text-white rounded" wire:click='createWorker'>Crea un registro</button>
    </div>

    <div>
        <div
            class="border border-zinc-300 grid grid-cols-5 justify-items-center py-4 mx-10 mt-10 rounded font-semibold">
            <h3>Nombre</h3>
            <h3>Apellido</h3>
            <h3>Trabajo</h3>
            <h3>Edad</h3>
            <h3>Editar</h3>
        </div>

        @foreach ($workers as $worker)
        <div class="grid grid-cols-5 place-items-center py-3 mx-10">
            <p>{{$worker->name}}</p>
            <p>{{$worker->lastname}}</p>
            <p>{{$worker->work}}</p>
            <p>{{$worker->age}}</p>
            <button wire:click='edit({{$worker->id}})' class="px-5 py-2 bg-yellow-500 rounded text-white">
                Editar
            </button>
        </div>
        @endforeach
    </div>

    <div x-data="{ showAlert: false}"
        x-on:show-alert.window="showAlert = true; setTimeout(() => showAlert = false, 3000)">

        <p x-show="showAlert" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2" style="display: none"
            class="bg-green-400 text-green-900 text-xl border border-green-600 fixed bottom-10 left-8 p-8">
            {{auth()->user()->unreadNotifications[0]['data']['message']}}
        </p>
    </div>



    <x-modal class="p-6" name="editModal" :show="false" maxWidth="lg">
        <div>
            <h2 class="text-center uppercase font-semibold mb-10">{{$workerId ? 'Actualizar Registro' : 'Crear nuevo
                Registro'}}</h2>

            <form wire:submit='store' class="space-y-5">
                <div class="flex flex-col gap-2">
                    <label class="uppercase text-sm font-semibold" for="name">Nombre</label>
                    <input class="rounded border border-zinc-300" id="name" name="name" wire:model='workerData.name'
                        type="text">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-sm font-semibold" for="lastname">Apellidos</label>
                    <input class="rounded border border-zinc-300" wire:model='workerData.lastname' id="lastname"
                        name="lastname" type="text">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-sm font-semibold" for="work">Profesión</label>
                    <input class="rounded border border-zinc-300" wire:model='workerData.work' id="work" name="work"
                        type="text">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="uppercase text-sm font-semibold" for="age">Edad</label>
                    <input class="rounded border border-zinc-300" wire:model='workerData.age' id="age" name="age"
                        type="number" name="" id="">
                </div>

                <button class="mt-5 bg-blue-500 p-3 rounded text-white">{{$workerId ? 'Actualizar' :
                    'Registrar'}}</button>
            </form>
        </div>
    </x-modal>



</div>