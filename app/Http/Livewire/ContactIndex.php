<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{
    use WithPagination;

    public $statusUpdate = false;

    protected $listeners = [
        'contactStored' => 'handleStored',
        'contactUpdated' => 'handleUpdated'
    ];

    public function render()
    {
        return view('livewire.contact-index', [
            'contacts' => Contact::latest()->paginate(5)
        ]);
    }

    public function getContact($id)
    {
        $this->statusUpdate = true;
        $contact = Contact::find($id);
        $this->emit('getContact', $contact);
    }

    public function destroy($id)
    {
        if ($id) {
            $data = Contact::find($id);
            $data->delete();
            session()->flash('message', 'Contact was deleted!');
        }
    }

    public function handleStored($contact)
    {
        // dd($contact);
        session()->flash('message', 'Contact ' . $contact['name'] . ' was stored!');
    }

    public function handleUpdated($contact)
    {
        // dd($contact);
        session()->flash('message', 'Contact ' . $contact['name'] . ' was updated!');
    }
}
