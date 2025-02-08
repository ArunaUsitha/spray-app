<?php
namespace App\Repositories\Interfaces;

use App\Http\Requests\MachineRequest;
use App\Models\Machine;
interface MachineRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAllMachines(): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function getMachineById($id): mixed;

    /**
     * @param Machine $machine
     * @return mixed
     */
    public function createMachine(Machine $machine): mixed;

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function updateMachine($id, array $data): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function deleteMachine($id): mixed;
}
