<?php
namespace App\Repositories\Interfaces;

use App\Models\Machine;
interface MachineRepositoryInterface
{
    public function getAllMachines();
    public function getMachineById($id);
    public function createMachine(array $data);
    public function updateMachine($id, array $data);
    public function deleteMachine($id);
}
