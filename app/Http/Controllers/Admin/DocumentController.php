<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseDocument;
use App\Models\LegalCase;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = CaseDocument::with(['case', 'uploader']);

        if ($request->filled('document_type')) {
            $query->where('document_type', $request->get('document_type'));
        }

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('original_filename', 'like', "%{$search}%");
            });
        }

        $documents = $query->orderByDesc('created_at')->paginate(15);

        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $cases = LegalCase::all();
        return view('admin.documents.create', compact('cases'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'case_id' => ['required', 'exists:cases,id'],
            'title' => ['required', 'string', 'max:255'],
            'documents.*' => ['required', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png,gif,txt', 'max:10240'],
            'document_type' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'is_public' => ['boolean'],
            'is_shared_with_client' => ['boolean'],
        ]);

        $uploadedBy = auth()->id();
        $caseId = $validated['case_id'];
        $documentType = $validated['document_type'];
        $isPublic = $validated['is_public'] ?? false;
        $isShared = $validated['is_shared_with_client'] ?? false;

        foreach ($request->file('documents') as $file) {
            $path = $file->store('case-documents', 'public');

            CaseDocument::create([
                'case_id' => $caseId,
                'uploaded_by' => $uploadedBy,
                'title' => $validated['title'],
                'filename' => basename($path),
                'original_filename' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_type' => $file->getClientOriginalExtension(),
                'file_size' => $file->getSize(),
                'document_type' => $documentType,
                'description' => $validated['description'] ?? null,
                'is_public' => $isPublic,
                'is_shared_with_client' => $isShared,
            ]);
        }

        return redirect()->route('admin.documents.index')
            ->with('success', 'Documents uploaded successfully!');
    }

    public function show(CaseDocument $document)
    {
        $document->load(['case', 'uploader']);
        return view('admin.documents.show', compact('document'));
    }

    public function download(CaseDocument $document)
    {
        $path = $document->file_path;

        if (! \Storage::disk('public')->exists($path)) {
            abort(404, 'File not found.');
        }

        return \Storage::disk('public')->download($path, $document->original_filename);
    }

    public function destroy(CaseDocument $document)
    {
        if ($document->file_path) {
            \Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return back()->with('success', 'Document deleted!');
    }
}