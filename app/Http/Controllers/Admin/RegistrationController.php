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
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('nim_nisn', 'like', "%{$search}%")
                        ->orWhere('institution', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('year'), function ($query) use ($request) {
                if ($request->filled('months') && is_array($request->months)) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->months as $month) {
                            $q->orWhere('created_at', 'like', "{$request->year}-{$month}%");
                        }
                    });
                } else {
                    $query->whereYear('created_at', $request->year);
                }
            }, function ($query) use ($request) {
                if ($request->filled('months') && is_array($request->months)) {
                    $query->where(function ($q) use ($request) {
                        foreach ($request->months as $month) {
                            $q->orWhereMonth('created_at', $month);
                        }
                    });
                }
            })
            ->when($request->filled('status') && $request->status !== 'all', function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('type') && $request->type !== 'all', function ($query) use ($request) {
                $query->where('type', $request->type);
            })
            ->orderByDesc('created_at')
            ->paginate(15)
            ->appends($request->query());

        return view('admin.registrations.index', compact('registrations'));
    }

    public function show(Registration $registration)
    {
        return view('admin.registrations.show', compact('registration'));
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak,selesai',
        ]);

        $registration->update(['status' => $request->status]);

        return back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();

        return back()->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
