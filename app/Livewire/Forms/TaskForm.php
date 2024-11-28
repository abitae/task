<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use App\Traits\LogCustom;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskForm extends Form
{
    use LogCustom;
    public ?Task $task;
    #[Validate('required|min:4|unique:tasks')]
    public $code = '';
    #[Validate('required')]
    public $title = '';
    #[Validate('required')]
    public $description = '';
    #[Validate('required')]
    public $status = '';
    #[Validate('required')]
    public $priority = '';
    #[Validate('required')]
    public $finality = '';
    public function setTask(Task $task)
    {
        $this->task = $task;
        $this->code = $task->code;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->status = $task->status;
        $this->priority = $task->priority;
        $this->finality = $task->finality;
    }
    public function store()
    {
        try {
            $this->validate();
            $task = Task::create($this->validate());
            $this->infoLog('task store ' . Auth::user()->name);
            return true;
        } catch (\Exception $e) {
            $this->errorLog('task store', $e);
            return false;
        }
    }
    public function update()
    {
        try {
            $task = Task::find($this->task->id);
            $task->update(
                [
                    'title' => $this->title,
                    'description' => $this->description,
                    'status' => $this->status,
                    'priority' => $this->priority,
                    'finality' => $this->finality,
                ]
            );

            $this->infoLog('task update ' . Auth::user()->name);
            return true;

        } catch (\Exception $e) {
            $this->errorLog('task update', $e);
            return false;
        }
    }
    public function delete(Task $task)
    {
        try {
            $task->delete();
            $this->infoLog('task delete ' . Auth::user()->name);
            return true;
        } catch (\Exception $e) {
            $this->errorLog('Transportista delete', $e);
            return false;
        }
    }
}
