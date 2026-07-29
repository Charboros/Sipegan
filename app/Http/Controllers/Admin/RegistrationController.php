<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function dashboard()
    {
        $statsData = Registration::selectRaw('
            COUNT(*) as total,
            SUM(status = "menunggu") as menunggu,
            SUM(status = "diterima") as diterima,
            SUM(status = "ditolak") as ditolak,
            SUM(type = "magang") as magang,
            SUM(type = "penelitian") as penelitian
        ')->first();

        $stats = [
            'total' => $statsData->total ?? 0,
            'menunggu' => $statsData->menunggu ?? 0,
            'diterima' => $statsData->diterima ?? 0,
            'ditolak' => $statsData->ditolak ?? 0,
            'magang' => $statsData->magang ?? 0,
            'penelitian' => $statsData->penelitian ?? 0,
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function index(Request $request)
    {
        $registrations = Registration::query()
            ->filter([
                'search' => $request->search,
                'year'   => $request->year,
                'months' => $request->months,
                'status' => $request->status,
                'type'   => $request->type,
            ])
            ->orderByDesc('created_at')
            ->paginate(15)
            ->appends($request->query());

        $availableYears = Registration::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('admin.registrations.index', compact('registrations', 'availableYears'));
    }

    public function show(Registration $registration)
    {
        return view('admin.registrations.show', compact('registration'));
    }

    public function updateStatus(\App\Http\Requests\UpdateRegistrationStatusRequest $request, Registration $registration)
    {
        $validated = $request->validated();

        $registration->update(['status' => $validated['status']]);

        return back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();

        return back()->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
