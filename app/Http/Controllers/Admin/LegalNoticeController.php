<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalNotice;
use App\Models\LegalCase;
use App\Models\User;
use Illuminate\Http\Request;

class LegalNoticeController extends Controller
{
    public function index(Request $request)
    {
        $query = LegalNotice::with(['legalCase', 'sender', 'recipient']);

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $notices = $query->orderByDesc('created_at')->paginate(15);

        return view('admin.legal-notices.index', compact('notices'));
    }

    public function create()
    {
        $cases = LegalCase::all();
        $users = User::with('role')->get();

        return view('admin.legal-notices.create', compact('cases', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'case_id' => ['required', 'exists:cases,id'],
            'sender_id' => ['required', 'exists:users,id'],
            'recipient_id' => ['nullable', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'notice_type' => ['required', 'string', 'max:50'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png|max:10240'],
        ]);

        $noticeData = $validated;
        unset($noticeData['file']);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('legal-notices', 'public');
            $noticeData['file_path'] = $path;
            $noticeData['original_filename'] = $request->file('file')->getClientOriginalName();
        }

        $noticeData['status'] = 'sent';
        $noticeData['sent_at'] = now();

        LegalNotice::create($noticeData);

        return redirect()->route('admin.legal-notices.index')
            ->with('success', 'Legal notice sent successfully!');
    }

    public function show(LegalNotice $legalNotice)
    {
        $legalNotice->load(['legalCase', 'sender', 'recipient']);
        $legalNotice->update(['status' => 'read', 'read_at' => now()]);

        return view('admin.legal-notices.show', compact('legalNotice'));
    }

    public function destroy(LegalNotice $legalNotice)
    {
        if ($legalNotice->file_path) {
            \Storage::disk('public')->delete($legalNotice->file_path);
        }

        $legalNotice->delete();

        return back()->with('success', 'Legal notice deleted!');
    }
}