<?php

namespace App\Repositories;

use App\Models\Machine;
use App\Repositories\Interfaces\MachineRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MachineRepository implements MachineRepositoryInterface
{

    /**
     * Get all machines
     * @return Collection
     */
    public function getAllMachines(): Collection
    {
        return Machine::all();
    }

    public function getMachineById($id)
    {
        return Machine::findOrFail($id);
    }

    public function createMachine(array $data)
    {
       return Machine::create($data);
    }

    public function updateMachine($id, array $data)
    {
        $machine = Machine::findOrFail($id);
        $machine->update($data);
        return $machine;
    }

    public function deleteMachine($id)
    {
        return Machine::destroy($id);
    }
}
