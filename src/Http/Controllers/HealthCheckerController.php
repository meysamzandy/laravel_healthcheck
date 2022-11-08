<?php

namespace Laravel\Health\Http\Controllers;

use Laravel\Health\Exceptions\CheckerNotFoundException;

class HealthCheckerController
{
    public function index()
    {
        try {
            $healthManager = \HealthChecker::eagerLoader(config('health-checker'))
                ->getHealthStatus();

            return response()->json([
                'status' => 'UP',
                'health_status' => $healthManager
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'DOWN',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function show(string $checker)
    {
        try {

            $healthManager = \HealthChecker::oneLoader(config('health-checker'), $checker)
                ->getHealthStatus();

            return response()->json([
                'status' => 'UP',
                'health_status' => $healthManager
            ]);
        } catch (CheckerNotFoundException $exception) {
            return response()->json([
                'status' => 'DOWN',
                'error' => $exception->getMessage()
            ], 400);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'DOWN',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
