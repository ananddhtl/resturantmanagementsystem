<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function __invoke(Request $request)
    {
        $tables = Table::query()->get();
        return response()->json(['message' => '', 'tables' => $tables], 200);
    }
}
