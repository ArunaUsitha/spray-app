<?php

namespace App\Repositories;

use App\Http\Requests\MachineRequest;
use App\Models\Machine;
use App\Repositories\Interfaces\MachineRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\UniqueConstraintViolationException;
use Throwable;

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

    public function getMachineById($id): mixed
    {
        return Machine::findOrFail($id);
    }

    public function createMachine(Machine $machine): string|bool
    {
            return $machine->save();
    }

    public function updateMachine($id, array $data): mixed
    {
        $machine = Machine::findOrFail($id);
        $machine->update($data);
        return $machine;
    }

    public function deleteMachine($id): int
    {
        return Machine::destroy($id);
    }
}
