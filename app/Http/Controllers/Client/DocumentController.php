<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\DocumentUploadRequest;
use App\Models\Document;
use App\Models\LegalCase;
use App\Services\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    protected DocumentService $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $documents = $this->documentService->getUserDocuments($user->id);

        $sharedDocuments = Document::where('is_shared', true)
            ->where('user_id', $user->id)
            ->with('legalCase')
            ->orderByDesc('created_at')
            ->get();

        return view('client.documents.index', compact('documents', 'sharedDocuments'));
    }

    public function create()
    {
        $user = auth()->user();
        $cases = LegalCase::where('client_id', $user->id)
            ->where('status', '!=', 'closed')
            ->get();

        return view('client.documents.create', compact('cases'));
    }

    public function store(DocumentUploadRequest $request)
    {
        $user = auth()->user();

        $data = $request->validated();
        $data['is_shared'] = $request->has('is_shared');

        foreach ($request->file('documents') as $document) {
            $data['file'] = $document;
            $this->documentService->uploadDocument($data, $user->id);
        }

        return redirect()
            ->route('client.documents.index')
            ->with('success', 'Documents uploaded successfully!');
    }

    public function download(Document $document)
    {
        $this->authorize('download', $document);

        return $this->documentService->downloadDocument($document);
    }

    public function share(Document $document)
    {
        $this->authorize('update', $document);

        $this->documentService->shareDocument($document);

        return back()->with('success', 'Document shared with advocate successfully!');
    }

    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);

        $document->delete();

        return back()->with('success', 'Document deleted successfully!');
    }
}