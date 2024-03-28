<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Models\Table;
use Exception;
use Illuminate\Http\Request;

class TableApiController extends BaseApiController
{
    public function __invoke(Request $request)
    {
        try {
            $tables = Table::query()->get();

            return $this->sendResponse($tables, 'All table list');
        } catch (Exception $e) {
            return $this->sendError('Something went wrong');
        }
    }
}
