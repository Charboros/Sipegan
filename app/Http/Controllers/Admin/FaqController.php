<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('question', 'asc')->get();

        return view('admin.faqs.index', compact('faqs'));
    }

    public function store(\App\Http\Requests\FaqRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        Faq::create($validated);

        return redirect()->route('faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function update(\App\Http\Requests\FaqRequest $request, Faq $faq)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        $faq->update($validated);

        return redirect()->route('faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
