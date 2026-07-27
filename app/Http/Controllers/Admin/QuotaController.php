<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quota;
use Illuminate\Http\Request;

class QuotaController extends Controller
{
    public function index()
    {
        $currentYear = date('Y');

        // Ensure 12 months exist for the current year
        for ($i = 1; $i <= 12; $i++) {
            $monthString = $currentYear.'-'.str_pad($i, 2, '0', STR_PAD_LEFT);
            Quota::firstOrCreate(
                ['month' => $monthString],
                ['quota_magang' => 0, 'quota_penelitian' => 0] // we keep quota_penelitian as 0 so it doesn't break DB if not nullable
            );
        }

        // Get all quotas for the current year, order by month
        $quotas = Quota::where('month', 'like', $currentYear.'-%')->orderBy('month', 'asc')->get();

        return view('admin.quotas.index', compact('quotas', 'currentYear'));
    }

    public function update(Request $request, Quota $quota)
    {
        $request->validate([
            'quota_magang' => 'required|integer|min:0',
        ]);

        $quota->update($request->only(['quota_magang']));

        return redirect()->route('quotas.index')->with('success', 'Jumlah kuota magang berhasil diperbarui.');
    }
}
