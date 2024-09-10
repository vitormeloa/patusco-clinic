<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Services\AppointmentService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class AppointmentController extends Controller
{
    use ApiResponse;

    protected AppointmentService $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }

    public function index(): JsonResponse
    {
        $appointments = $this->appointmentService->getAppointments();
        return $this->success($appointments);
    }

    public function store(CreateAppointmentRequest $request): JsonResponse
    {
        Gate::authorize('create', Appointment::class);
        $appointment = $this->appointmentService->createAppointment($request->validated());
        return $this->created($appointment);
    }


    public function update(UpdateAppointmentRequest $request, Appointment $appointment): JsonResponse
    {
        Gate::authorize('update', $appointment);
        $appointment = $this->appointmentService->updateAppointment($appointment, $request->validated());
        return $this->updated($appointment);
    }

    public function destroy(Appointment $appointment): JsonResponse
    {
        Gate::authorize('delete', $appointment);
        $this->appointmentService->deleteAppointment($appointment);
        return $this->deleted();
    }
}
