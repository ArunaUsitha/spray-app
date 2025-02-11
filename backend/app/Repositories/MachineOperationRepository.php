<?php

namespace App\Repositories;

use App\Models\Machine;
use App\Models\MachineOperation;
use App\Models\MachineReset;
use App\Models\User;
use App\Repositories\Interfaces\MachineOperationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MachineOperationRepository implements MachineOperationRepositoryInterface
{
    public function getOperationsByMachineId($machineId)
    {
        $machine = Machine::with(['operations' => function ($query) {
            return $query->orderBy('created_at', 'desc');
        }])->findOrFail($machineId);

        $lastOperation = $machine->operations->first();
        $machine->total_operation_hours = $lastOperation ? $lastOperation->operation_hours : 0;

        return $machine;

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
                'user_id' => $user->id,
                'reset_date' => today(),
                'operation_hours_before_reset' => $lastMachineOperation->operation_hours
            ]);

            $machineReset->save();

            // Update machine table total reset hours
            $totalResetCounts = MachineReset::where('machine_id', $machine->id)->count();

            $machine = Machine::find($machine->id);
            $machine->reset_count = $totalResetCounts;
            $machine->save();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            DB::rollback();
            return false;
        }
    }

}
