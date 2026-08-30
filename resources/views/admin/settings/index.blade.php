@extends('layouts.admin')
@section('title', 'Settings')
@section('header', 'System Settings')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-auto-hide">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.settings.bulk-update') }}">
        @csrf
        @php $groups = $settings->groupBy('group'); @endphp

        <div class="admin-card rounded-xl p-6 mb-4">
            <ul class="nav nav-tabs" role="tablist">
                @foreach ($groups as $groupName => $groupSettings)
                    <li class="nav-item">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#tab_{{ \Illuminate\Support\Str::slug($groupName) }}" type="button">
                            {{ ucfirst($groupName) }} ({{ $groupSettings->count() }})
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content pt-4">
                @foreach ($groups as $groupName => $groupSettings)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab_{{ \Illuminate\Support\Str::slug($groupName) }}">
                        @foreach ($groupSettings as $setting)
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold mb-0">{{ $setting->label ?? $setting->key }}</label>
                                    @if ($setting->description)
                                        <div><small class="text-muted">{{ $setting->description }}</small></div>
                                    @endif
                                    <div><small><code>{{ $setting->key }}</code></small></div>
                                </div>
                                <div class="col-md-8">
                                    @if ($setting->type === 'boolean')
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="settings[{{ $setting->key }}]" value="1" id="set_{{ \Illuminate\Support\Str::slug($setting->key) }}" {{ $setting->value ? 'checked' : '' }}>
                                            <label class="form-check-label" for="set_{{ \Illuminate\Support\Str::slug($setting->key) }}">Enabled</label>
                                        </div>
                                    @elseif ($setting->type === 'json')
                                        <textarea name="settings[{{ $setting->key }}]" rows="3" class="form-control font-monospace">{{ $setting->value }}</textarea>
                                    @elseif ($setting->type === 'text')
                                        <textarea name="settings[{{ $setting->key }}]" rows="3" class="form-control">{{ $setting->value }}</textarea>
                                    @elseif ($setting->type === 'integer' || $setting->type === 'float')
                                        <input type="number" step="any" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}" class="form-control">
                                    @else
                                        <input type="text" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}" class="form-control">
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <button class="btn btn-primary"><i class="bi bi-check-circle me-1"></i> Save All Settings</button>
    </form>
@endsection