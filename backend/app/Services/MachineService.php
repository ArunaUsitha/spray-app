<?php

namespace App\Services;

use App\Repositories\Interfaces\MachineRepositoryInterface;
use App\Services\Interfaces\MachineServiceInterface;

class MachineService implements MachineServiceInterface
{
    public function __construct(
        protected MachineRepositoryInterface $machineRepository,
    ){}

    public function listMachines()
    {
       return $this->machineRepository->getAllMachines();
    }

    public function showMachine($id)
    {
        return $this->machineRepository->getMachineById($id);
    }

    public function storeMachine(array $data)
    {
        return $this->machineRepository->createMachine($data);
    }

    public function editMachine($id, array $data)
    {
        return $this->machineRepository->updateMachine($id, $data);
    }

    public function removeMachine($id)
    {
       return $this->machineRepository->deleteMachine($id);
    }
}
