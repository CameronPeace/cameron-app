<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiServiceException;
use App\Services\ApiService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{
    /**
     * Retrieve top theater data.
     */
    public function topTheaters(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'fromDate' => 'required|date_format:Y-m-d H:i:s',
                'toDate' => 'required|date_format:Y-m-d H:i:s',
                'queryLimit' => 'required|integer',
            ]);

            $apiService = new ApiService();

            $topTheaters = $apiService->getTopTheaters($validated['fromDate'], $validated['toDate'], $validated['queryLimit']);

            return response()->json($topTheaters, 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        } catch (ApiServiceException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['message' => 'An unexpected error occurred.', 'error' => $e->getMessage()], 500);
        }
    }
}
