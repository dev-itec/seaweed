<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Quiz;

class Quizes extends Component
{
    public $quizes, $name, $description, $quiz_id;
    public $isOpen = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function render()
    {
        debugbar()->info('$isOpen');
        $this->quizes = Quiz::all();
        return view('livewire.quizes');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields(){
        $this->code = '';
        $this->name = '';
        $this->quiz_id = '';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        Post::updateOrCreate(['id' => $this->quiz_id], [
            'code' => $this->code,
            'name' => $this->name
        ]);

        session()->flash('message',
            $this->quiz_id ? 'Quiz Updated Successfully.' : 'Quiz Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        $this->quiz_id = $id;
        $this->code = $quiz->code;
        $this->name = $quiz->name;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Quiz::find($id)->delete();
        session()->flash('message', 'Quiz Deleted Successfully.');
    }
}
