<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class TaskLive extends Component
{
    use Toast;
    use WithPagination, WithoutUrlPagination;
    public $title = 'Transportistas';
    public $sub_title = 'Modulo de transportistas';
    public function render()
    {
        $task = Task::all();
        return view('livewire.task-live',compact('task'));
    }
}
