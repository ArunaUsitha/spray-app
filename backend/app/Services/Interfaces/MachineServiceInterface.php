<?php

namespace App\Services\Interfaces;


use App\Http\Requests\MachineRequest;

interface MachineServiceInterface {
    public function listMachines();
    public function showMachine($id);
    public function storeMachine(MachineRequest $machineRequest);
    public function editMachine($id, MachineRequest $machineRequest);
    public function removeMachine($id);
}
