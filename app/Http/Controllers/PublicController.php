<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function dashboard()
    {
        $quotas = \App\Models\Quota::orderBy('month', 'asc')->get();
        
        $quotaData = [];
        foreach ($quotas as $q) {
            $usedMagang = Registration::where('type', 'magang')
                ->whereNotIn('status', ['ditolak'])
                ->whereYear('created_at', date('Y', strtotime($q->month)))
                ->whereMonth('created_at', date('m', strtotime($q->month)))
                ->count();
                
            $quotaData[] = [
                'month' => $q->month,
                'available_magang' => max(0, $q->quota_magang - $usedMagang),
            ];
        }

        return view('public.dashboard', compact('quotaData'));
    }

    public function daftarMagang()
    {
        return view('public.daftar_magang');
    }

    public function storeMagang(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'nim_nisn' => 'required|string|max:50',
            'participant_category' => 'required|in:Sekolah Menengah Kejuruan,Perguruan Tinggi',
            'institution' => 'required|string|max:255',
            'study_program' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'address' => 'required|string',
            'magang_months' => 'required|array',
            'magang_months.*' => 'string',
            'advisor_name' => 'nullable|string|max:255',
            'advisor_phone' => 'nullable|string|max:50',
            'document' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('documents', 'public');
            $validated['document_path'] = $path;
        }

        $validated['type'] = 'magang';
        $validated['status'] = 'menunggu';
        $validated['magang_months'] = array_values($validated['magang_months']);

        Registration::create($validated);

        return redirect()->route('public.cek_status')
            ->with('success', 'Pendaftaran Magang berhasil dikirim!');
    }

    public function daftarPenelitian()
    {
        return view('public.daftar_penelitian');
    }

    public function storePenelitian(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'nim_nisn' => 'required|string|max:50',
            'institution' => 'required|string|max:255',
            'study_program' => 'required|string|max:255',
            'research_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'document' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('documents', 'public');
            $validated['document_path'] = $path;
        }

        $validated['type'] = 'penelitian';
        $validated['status'] = 'menunggu';

        Registration::create($validated);

        return redirect()->route('public.cek_status')
            ->with('success', 'Pendaftaran Penelitian berhasil dikirim!');
    }

    public function cekStatus()
    {
        return view('public.cek_status');
    }

    public function searchStatus(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nim_nisn' => 'required|string'
        ]);

        $registrations = Registration::where('email', $request->email)
                                    ->where('nim_nisn', $request->nim_nisn)
                                    ->latest()
                                    ->get();

        if ($registrations->isEmpty()) {
            return back()->with('error', 'Data pendaftaran dengan Email dan NIM/NISN tersebut tidak ditemukan.');
        }

        return view('public.cek_status', compact('registrations'));
    }
}
