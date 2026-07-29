<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMagangRequest;
use App\Http\Requests\StorePenelitianRequest;
use App\Models\Faq;
use App\Models\Quota;
use App\Models\Registration;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function dashboard()
    {
        $quotas = Quota::orderBy('month', 'asc')->get();

        // Optimasi: Ambil semua jumlah pendaftar per bulan dalam 1 kueri agregasi
        $usedMagangCounts = Registration::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->where('type', 'magang')
            ->whereNotIn('status', ['ditolak'])
            ->groupBy('month')
            ->pluck('total', 'month');

        $quotaData = [];
        foreach ($quotas as $q) {
            $usedMagang = $usedMagangCounts[$q->month] ?? 0;
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

    public function storeMagang(StoreMagangRequest $request)
    {
        $validated = $request->validated();

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

    public function storePenelitian(StorePenelitianRequest $request)
    {
        $validated = $request->validated();

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
            'nim_nisn' => 'required|string',
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

    public function faq(Request $request)
    {
        $query = Faq::where('is_active', true);

        // Fitur pencarian sekarang ditangani di sisi klien (Live Search Alpine.js)
        // sehingga kita memuat semua FAQ yang aktif.

        $faqs = $query->orderBy('question', 'asc')->get();

        return view('public.faq', compact('faqs'));
    }
}
