<div>
    <x-mary-card title="{{ $title ?? 'title' }}" subtitle="{{ $sub_title ?? 'title' }}" shadow separator>
        <x-slot:menu>
            <x-mary-button wire:click='openModalCreate' responsive icon="o-plus" label="Nueva tarea"
                class="text-white bg-sky-500" />
        </x-slot:menu>
        <div class="grid grid-cols-4 grid-rows-1 gap-1">
            <div>
                <x-mary-stat title="Paquetes" description="Paquetes pendientes de envio" value="44" icon="m-archive-box"
                    tooltip="Paquetes" />
            </div>
            <div>
                <x-mary-stat title="Monto apertura" description="This month" value="12" icon="o-arrow-trending-up"
                    tooltip="Ops!" />
            </div>
            <div>
                <x-mary-stat title="Ingresos" description="Boletas, Facturas y ticket" value="12"
                    icon="o-arrow-trending-up" class="text-green-500" color="text-green-500"
                    tooltip="Total entradas de dinero" />
            </div>
            <div>
                <x-mary-stat title="Egresos" description="Pagos y salidas" value="123" icon="o-arrow-trending-down"
                    class="text-red-500" color="text-red-500" tooltip="Total salidas de dinero" />
            </div>
        </div>
    </x-mary-card>
    <div class="grid grid-cols-4 space-x-2">
        <div class="grid col-span-4 pt-2">
            <x-mary-card shadow separator>

                <x-mary-table :headers="$headers" :rows="$tasks" with-pagination per-page="perPage"
                    :per-page-values="[5, 20, 10, 50]">

                    @scope('actions', $task)
                    <nobr>
                        <x-mary-button icon="s-pencil-square" wire:click="update({{ $task->id }})" spinner
                            class="btn-sm" />
                        <x-mary-button icon="o-trash" wire:click="delete({{ $task->id }})"
                            wire:confirm.prompt="Estas seguro?\n\nEscribe 'DELETE' para confirmar|DELETE" spinner
                            class="btn-sm" />
                    </nobr>
                    @endscope
                </x-mary-table>
            </x-mary-card>
        </div>
    </div>
    <x-mary-modal wire:model="modalTaskEdit" persistent class="backdrop-blur" box-class="max-h-full max-w-128 ">
        <x-mary-icon name="s-envelope" class="text-green-500 text-md"
            label="EDITAR TAREA" />
        <x-mary-form wire:submit="edit">
            <div class="border border-green-500 rounded-lg">
                <div class="grid grid-cols-4 p-2">
                    <div class="grid col-span-4 pt-2">
                        <x-mary-input label="Code" inline wire:model.live='taskForm.code'  />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        <x-mary-input label="Titulo" inline wire:model.live='taskForm.title' />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        <x-mary-textarea label="Description" inline wire:model.live='taskForm.description'
                            placeholder="Descripcion" rows="3" />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        @php
                        $status = [
                        ['id'=> 'PENDIENTE' , 'name' => 'PENDIENTE'],
                        ['id'=> 'PROGRESO', 'name' => 'PROGRESO'],
                        ['id'=> 'COMPLETADO', 'name' => 'COMPLETADO'],
                        ]
                        @endphp
                        <x-mary-select label="Tipo" icon="o-user" :options="$status" wire:model.live="taskForm.status"
                            inline />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        @php
                        $priorities = [
                        ['id'=> 'ALTA' , 'name' => 'ALTA'],
                        ['id'=> 'MEDIA', 'name' => 'MEDIA'],
                        ['id'=> 'MEDIA', 'name' => 'BAJA'],
                        ]
                        @endphp
                        <x-mary-select label="Tipo" icon="o-user" :options="$priorities"
                            wire:model.live="taskForm.priority" inline />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        <x-mary-datetime label="Finaliza" wire:model.live="taskForm.finality" icon="o-calendar" />
                    </div>
                </div>
                <x-slot:actions>
                    <x-mary-button label="Cancel" @click="$wire.modalTaskEdit = false" class="bg-red-500" />
                    <x-mary-button type="submit" spinner="{{ !isset($taskFormary->transportista) ? 'create' : 'edit' }}"
                        label="Save" class="bg-blue-500" />
                </x-slot:actions>
            </div>
        </x-mary-form>
    </x-mary-modal>
    <x-mary-modal wire:model="modalTaskCreate" persistent class="backdrop-blur" box-class="max-h-full max-w-128 ">
        <x-mary-icon name="s-envelope" class="text-green-500 text-md"
            label="CREAR TAREA'" />
        <x-mary-form wire:submit="create">
            <div class="border border-green-500 rounded-lg">
                <div class="grid grid-cols-4 p-2">
                    <div class="grid col-span-4 pt-2">
                        <x-mary-input label="Code" inline wire:model.live='taskForm.code'  />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        <x-mary-input label="Titulo" inline wire:model.live='taskForm.title' />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        <x-mary-textarea label="Description" inline wire:model.live='taskForm.description'
                            placeholder="Descripcion" rows="3" />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        @php
                        $status = [
                        ['id'=> 'PENDIENTE' , 'name' => 'PENDIENTE'],
                        ['id'=> 'PROGRESO', 'name' => 'PROGRESO'],
                        ['id'=> 'COMPLETADO', 'name' => 'COMPLETADO'],
                        ]
                        @endphp
                        <x-mary-select label="Tipo" icon="o-user" :options="$status" wire:model.live="taskForm.status"
                            inline />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        @php
                        $priorities = [
                        ['id'=> 'ALTA' , 'name' => 'ALTA'],
                        ['id'=> 'MEDIA', 'name' => 'MEDIA'],
                        ['id'=> 'MEDIA', 'name' => 'BAJA'],
                        ]
                        @endphp
                        <x-mary-select label="Tipo" icon="o-user" :options="$priorities"
                            wire:model.live="taskForm.priority" inline />
                    </div>
                    <div class="grid col-span-4 pt-2">
                        <x-mary-datetime label="Finaliza" wire:model.live="taskForm.finality" icon="o-calendar" />
                    </div>
                </div>
                <x-slot:actions>
                    <x-mary-button label="Cancel" @click="$wire.modalTaskCreate = false" class="bg-red-500" />
                    <x-mary-button type="submit" spinner="{{ !isset($taskFormary->transportista) ? 'create' : 'edit' }}"
                        label="Save" class="bg-blue-500" />
                </x-slot:actions>
            </div>
        </x-mary-form>
    </x-mary-modal>
</div>