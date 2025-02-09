<?php

namespace App\Repositories;

use App\Models\Machine;
use App\Models\MachineOperation;
use App\Models\MachineReset;
use App\Models\User;
use App\Repositories\Interfaces\MachineOperationRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MachineOperationRepository implements MachineOperationRepositoryInterface
{
    public function getOperationsByMachineId($machineId) {
        return MachineOperation::where('machine_id', $machineId)->orderBy('created_at', 'desc')->get();
    }

    public function addOperation(MachineOperation $machineOperation): bool
    {
        return $machineOperation->save();
    }

    public function resetMachineOperations(Machine $machine, User $user): bool
    {
        try {
            DB::beginTransaction();

            //add a new reset record to machineOperations table
            $machineOperation = new MachineOperation([
                'machine_id' => $machine->id,
                'user_id' => $user->id,
                'operation_hours' => 0,
                'operation_date' => today()
            ]);

            $machineOperation->save();

            //last machine record
            $lastMachineOperation = MachineOperation::where('machine_id', $machine->id)
                ->where('operation_hours', '>', 0)
                ->latest('created_at')
                ->first();

            // Add new record to Machine Reset table to save reset snapshot
            $machineReset = new MachineReset([
                'machine_id' => $machine->id,
                'user_id' =>  $user->id,
                'reset_date' => today(),
                'operation_hours_before_reset' => $lastMachineOperation->operation_hours
            ]);

            $machineReset->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

}
