<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total' => Registration::count(),
            'menunggu' => Registration::where('status', 'menunggu')->count(),
            'diterima' => Registration::where('status', 'diterima')->count(),
            'ditolak' => Registration::where('status', 'ditolak')->count(),
            'magang' => Registration::where('type', 'magang')->count(),
            'penelitian' => Registration::where('type', 'penelitian')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function index(Request $request)
    {
        $query = Registration::query();

        // 1. Pencarian Global (Nama, NIM/NISN, Instansi)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim_nisn', 'like', "%{$search}%")
                  ->orWhere('institution', 'like', "%{$search}%");
            });
        }

        // 2. Filter Tahun & Bulan Pendaftaran
        if ($request->filled('year')) {
            $year = $request->year;
            if ($request->filled('months') && is_array($request->months)) {
                $query->where(function($q) use ($year, $request) {
                    foreach ($request->months as $month) {
                        $q->orWhere('created_at', 'like', "{$year}-{$month}%");
                    }
                });
            } else {
                $query->where('created_at', 'like', "{$year}-%");
            }
        } elseif ($request->filled('months') && is_array($request->months)) {
            $query->where(function($q) use ($request) {
                foreach ($request->months as $month) {
                    $q->orWhere('created_at', 'like', "%-{$month}-%");
                }
            });
        }

        // 3. Filter Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // 4. Filter Jenis
        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        $registrations = $query->orderBy('created_at', 'desc')->paginate(15)->appends($request->query());
        return view('admin.registrations.index', compact('registrations'));
    }

    public function show(Registration $registration)
    {
        return view('admin.registrations.show', compact('registration'));
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak,selesai'
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
