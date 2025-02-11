<?php

namespace App\Services\Interfaces;


use App\Http\Requests\MachineRequest;

interface MachineServiceInterface {
    /**
     * @return mixed
     */
    public function listMachines(): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function showMachine($id): mixed;

    /**
     * @param MachineRequest $machineRequest
     * @return mixed
     */
    public function storeMachine(MachineRequest $machineRequest): mixed;

    /**
     * @param $id
     * @param MachineRequest $machineRequest
     * @return mixed
     */
    public function editMachine($id, MachineRequest $machineRequest): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function removeMachine($id): mixed;
}
