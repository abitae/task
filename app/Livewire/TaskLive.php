<?php

namespace App\Livewire;

use App\Livewire\Forms\TaskForm;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class TaskLive extends Component
{
    use Toast;
    use WithPagination, WithoutUrlPagination;
    public $title = 'Tareas';
    public $sub_title = 'Modulo de tareas';
    public TaskForm $taskForm;
    public int $perPage = 10;
    public $modalTaskCreate, $modalTaskEdit;
    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-blue-500 w-1'],
            ['key' => 'code', 'label' => 'Codigo', 'class' => ''],
            ['key' => 'title', 'label' => 'Titulo', 'class' => ''],
            ['key' => 'status', 'label' => 'Estado', 'class' => ''],
            ['key' => 'finality', 'label' => 'Vencimiento', 'class' => ''],
        ];
        $tasks = Task::latest()->paginate($this->perPage);
        return view('livewire.task-live', compact('tasks', 'headers'));
    }
    public function openModalCreate()
    {
        $this->taskForm->reset();
        $this->modalTaskCreate = !$this->modalTaskCreate;
    }
    public function create()
    {
        if ($this->taskForm->store()) {
            $this->success('Genial, guardado correctamente!');
        } else {
            $this->error('Error, verifique los datos!');
        }
        $this->openModalCreate();
    }
    public function update(Task $Task)
    {
        $this->modalTaskEdit = true;
        $this->taskForm->setTask($Task);
    }
    public function edit()
    {
        if ($this->taskForm->update()) {
            $this->success('Genial, guardado correctamente!');
        } else {
            $this->error('Error, verifique los datos!');
        }
        $this->modalTaskEdit = false;
    }
    public function delete(Task $task)
    {
        if ($this->taskForm->delete($task)) {
            $this->success('Genial, guardado correctamente!');
        } else {
            $this->error('Error, verifique los datos!');
        }
    }
}
