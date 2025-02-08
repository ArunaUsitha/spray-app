<?php

namespace App\Services\Interfaces;


interface MachineServiceInterface {
    public function listMachines();
    public function showMachine($id);
    public function storeMachine(array $data);
    public function editMachine($id, array $data);
    public function removeMachine($id);
}
