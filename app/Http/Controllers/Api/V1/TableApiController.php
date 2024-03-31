<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\TableReservation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableApiController extends BaseApiController
{
    public function __invoke(Request $request)
    {
        try {
            $tables = Table::query()->with('reservation')->get();

            return $this->sendResponse($tables, 'All table list');
        } catch (Exception $e) {
            dd($e->getMessage());
            return $this->sendError('Something went wrong');
        }
    }

    public function tableReservation(Request $request)
    {
        try {
            DB::beginTransaction();

            $table = Table::findOrFail($request->id);

            $table_reservation = new TableReservation([
                'user_id' => 1,
                'table_id' => $table->id,
                'date' => $request->date,
                'time' => $request->time,
                'guest_count' => $request->guest_count,
            ]);
            $table_reservation->save();

            $table->status = true;
            $table->save();

            DB::commit();
            return $this->sendResponse($table_reservation, 'Reserved Successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong');
        }
    }

    public function unReserveTable(Request $request)
    {
        try {
            DB::beginTransaction();

            $table_reservation = TableReservation::findOrFail($request->table_reservation_id);
            $table_reservation->is_complete = true;
            $table_reservation->save();

            $table = Table::findOrFail($table_reservation->table_id);
            $table->status = false;
            $table->save();

            DB::commit();
            return $this->sendResponse($table_reservation, 'UnReserved Successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->sendError('Something went wrong');
        }
    }
}
