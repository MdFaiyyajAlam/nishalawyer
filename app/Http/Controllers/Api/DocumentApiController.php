<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentApiController extends Controller
{
    public function index(Request $request)
    {
        $documents = Document::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(15);

        return DocumentResource::collection($documents);
    }

    public function show(Request $request, Document $document)
    {
        $this->authorize('view', $document);

        return new DocumentResource($document);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'document_type' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'case_id' => ['nullable', 'exists:cases,id'],
            'is_shared' => ['boolean'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png,gif,txt', 'max:10240'],
        ]);

        $file = $request->file('file');
        $path = $file->store('documents', 'public');

        $document = Document::create(array_merge($validated, [
            'user_id' => $request->user()->id,
            'filename' => basename($path),
            'original_filename' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize(),
            'is_shared' => $validated['is_shared'] ?? false,
            'shared_at' => $validated['is_shared'] ? now() : null,
        ]));

        return new DocumentResource($document);
    }

    public function download(Request $request, Document $document)
    {
        $this->authorize('view', $document);

        $path = $document->file_path;

        if (! Storage::disk('public')->exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return Storage::disk('public')->download($path, $document->original_filename);
    }

    public function destroy(Request $request, Document $document)
    {
        $this->authorize('delete', $document);

        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return response()->json(['message' => 'Document deleted successfully']);
    }
}