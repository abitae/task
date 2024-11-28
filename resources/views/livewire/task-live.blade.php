<div>
    <x-m--card title="{{ $title ?? 'title' }}" subtitle="{{ $sub_title ?? 'title' }}" shadow separator>
        <x-slot:menu>
            <x-m--button wire:click='openModal' responsive icon="o-plus" label="Nuevo transportista"
                class="text-white bg-sky-500" />
        </x-slot:menu>
        <div class="grid content-start grid-cols-4 xs:grid-cols-1">
            <x-m--stat title="Paquetes" description="Paquetes pendientes de envio" value="44" icon="m-archive-box"
                tooltip="Paquetes" />
            <x-m--stat title="Monto apertura" description="This month" value="12" icon="o-arrow-trending-up"
                tooltip="Ops!" />
            <x-m--stat title="Ingresos" description="Boletas, Facturas y ticket" value="12"
                icon="o-arrow-trending-up" class="text-green-500" color="text-green-500"
                tooltip="Total entradas de dinero" />
            <x-m--stat title="Egresos" description="Pagos y salidas" value="123" icon="o-arrow-trending-down"
                class="text-red-500" color="text-red-500" tooltip="Total salidas de dinero" />
        </div>
    </x-m--card>
    <div class="grid grid-cols-4 space-x-2">
        <div class="grid col-span-4 pt-2">
            <x-m--card shadow separator>
                @php
                    $headers = [
                        ['key' => 'id', 'label' => '#', 'class' => 'bg-blue-500 w-1'],
                        ['key' => 'name', 'label' => 'Name', 'class' => ''],
                        ['key' => 'licencia', 'label' => 'Licencia', 'class' => ''],
                        ['key' => 'dni', 'label' => 'Dni', 'class' => ''],
                        ['key' => 'tipo', 'label' => 'Tipo', 'class' => ''],
                        ['key' => 'isActive', 'label' => 'isActive', 'class' => ''],
                    ];
                    $row_decoration = [
                        'bg-red-50' => fn(App\Models\Configuration\Transportista $transportista) => !$transportista->isActive,
                    ];
                @endphp
                <x-m--table :headers="$headers" :rows="$transportistas" with-pagination per-page="perPage" :row-decoration="$row_decoration"
                    :per-page-values="[5, 20, 10, 50]">
                    @scope('cell_isActive', $stuff)
                        <button wire:click='estado({{ $stuff->id }})'
                            wire:confirm.prompt="Estas seguro de eliminar registro?\n\nEscriba 'SI' para confirmar!|SI"
                            class="flex items-center">
                            <div
                                class="h-2.5 w-2.5 rounded-full {{ $stuff->isActive ? 'bg-green-400' : 'bg-red-600' }} mr-2">
                            </div>
                            {{ $stuff->isActive ? 'Active' : 'Disabled' }}
                        </button>
                    @endscope
                    @scope('actions', $transportista)
                        <nobr>
                            <x-m--button icon="s-pencil-square" wire:click="update({{ $transportista->id }})" spinner
                                class="btn-sm" />
                            <x-m--button icon="o-trash" wire:click="delete({{ $transportista->id }})"
                                wire:confirm.prompt="Estas seguro?\n\nEscribe DELETE para confirmar|DELETE" spinner
                                class="btn-sm" />
                        </nobr>
                    @endscope
                </x-m--table>
            </x-m--card>
        </div>
    </div>
    <x-m--modal wire:model="modalTransportista" persistent class="backdrop-blur" box-class="max-h-full max-w-128 ">
        <x-m--icon name="s-envelope" class="text-green-500 text-md"
            label="{{ !isset($transportistaForm->transportista) ? 'CREAR VEHICULO' : 'EDITAR VEHICULO' }}" />
        <x-m--form wire:submit="{{ !isset($transportistaForm->transportista) ? 'create' : 'edit' }}">
            <div class="border border-green-500 rounded-lg">
                <div class="grid grid-cols-4 p-2">
                    <div class="grid col-span-4 pt-2">
                        <x-m--input label="Nombre" inline wire:model='transportistaForm.name' />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        <x-m--input label="Licencia" inline wire:model='transportistaForm.licencia' />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        <x-m--input label="DNI" inline wire:model='transportistaForm.dni' />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        @php
                            $tipos = [
                                ['id'=> 'INTERNO' ,  'name' => 'INTERNO'],
                                ['id'=> 'EXTERNO',  'name' => 'EXTERNO'],
                            ]
                        @endphp
                        <x-m--select label="Tipo" icon="o-user" :options="$tipos" wire:model="transportistaForm.tipo" inline />
                    </div>
                </div>
                <x-slot:actions>
                    <x-m--button label="Cancel" @click="$wire.modalTransportista = false" class="bg-red-500" />
                    <x-m--button type="submit" spinner="{{ !isset($transportistaForm->transportista) ? 'create' : 'edit' }}"
                        label="Save" class="bg-blue-500" />
                </x-slot:actions>
            </div>
        </x-m--form>
    </x-m--modal>
</div>
