<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Livewire\Component;

class DepartmentShow extends Component
{
    public $showEditModal = false;
    public $confirmingDelete = false;
    public $delete_id;
    public $search;

    public Department $editing;

    public function rules()
    {
        return [
            'editing.name' => 'required',
            'editing.phone' => '',
        ];
    }

    public function makeDepartment()
    {
        return Department::make([
            'name' => '',
            'phone' => '',
        ]);
    }

    public function new()
    {
        $this->editing = $this->makeDepartment();
        $this->showEditModal = true;
    }

    public function edit($id)
    {
        $this->editing = Department::find($id);
        $this->showEditModal = true;
    }

    public function deleteConfirm($id)
    {
        $this->delete_id = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
       Department::find($this->delete_id)->delete();
       $this->confirmingDelete = false;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->showEditModal = false;
    }

    public function getRowsProperty()
    {
        $query = Department::query()
        ->when($this->search, function($query, $search){
            return $query->where('name', 'like', '%'.$search.'%');
        });

        return $query->get();
    }

    public function render()
    {
        return view('livewire.department-show', [
            'departments' => $this->rows
        ]);
    }
}
