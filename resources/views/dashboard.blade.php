<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <label for="my-modal" class="btn btn-xs float-right mb-5">Añadir</label>
                        <table class="table w-full" id="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Vence</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <th>{{ $cliente->id }}</th>
                                        <th>{{ $cliente->nombre }}</th>
                                        <th>{{ $cliente->telefono }}</th>
                                        <?php
                                            $venceEn    =   (strtotime($cliente->vence)-strtotime(date('Y-m-d')));
                                            $venceEn    =   intval($venceEn/86400);
                                        ?>
                                        <th>
                                            {{ $venceEn }} {{ ($venceEn == 1 ? 'día' : 'días') }}
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" onclick="deleteItem({{ $cliente->id }})" class="w-5 float-right mr-3 cursor-pointer"><title>trash-can-outline</title><path d="M9,3V4H4V6H5V19A2,2 0 0,0 7,21H17A2,2 0 0,0 19,19V6H20V4H15V3H9M7,6H17V19H7V6M9,8V17H11V8H9M13,8V17H15V8H13Z" /></svg>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <input type="checkbox" id="my-modal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Añadir nuevo usuario</h3>
            <form method="POST" action="{{ route('add') }}">
                @csrf
                <div class="flex justify-center gap-3 mt-2">
                    <input type="text" name="nombre" placeholder="Nombre" class="input input-bordered input-md w-full max-w-xs" required />
                    <input type="text" name="telefono" placeholder="Teléfono" class="input input-bordered input-md w-full max-w-xs" required />
                    <input type="number" name="vence" placeholder="Vencimiento" class="input input-bordered input-md w-full max-w-xs" required />
                </div>
                <div class="modal-action">
                    <label for="my-modal" class="btn btn-xs btn-warning">Cancelar</label>
                    <button type="submit" class="btn btn-xs mx-auto">Añadir</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function deleteItem(id) {
            if(confirm('¿Seguro que deseas eliminarlo?'))
                location.href='http://127.0.0.8/eliminar-cliente/'+id;
        }
    </script>
</x-app-layout>
