@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Input Audit Checker</h2>

    <!-- Form Pencarian Audit -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Cari Data Audit</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('auditchecker.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="tanggal_audit" class="form-label">Tanggal Audit</label>
                        <input type="date" class="form-control" name="tanggal_audit" value="{{ request('tanggal_audit') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="id_user" class="form-label">Siapa Yang Audit</label>
                        <select class="form-select" name="id_user">
                            <option value="">-- Pilih User --</option>
                            @foreach($auditors as $auditor)
                                <option value="{{ $auditor }}" {{ request('id_user') == $auditor ? 'selected' : '' }}>
                                    {{ $auditor }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="storage" class="form-label">Storage</label>
                        <select class="form-select" name="storage">
                            <option value="">-- Pilih Storage --</option>
                            @foreach($storages as $storage)
                                <option value="{{ $storage }}" {{ request('storage') == $storage ? 'selected' : '' }}>
                                    {{ $storage }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ route('auditchecker.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data Audit dari hasil filter -->
    <form action="{{ route('auditchecker.storeFromTable') }}" method="POST">
        @csrf
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Storage</th>
                    <th>Produk</th>
                    <th>Dus</th>
                    <th>Botol</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($audits as $index => $audit)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $audit->storage }}</td>
                        <td>{{ $audit->barang }}</td>
                        <td>
                            <input type="number" class="form-control" name="dus[{{ $audit->id }}]">
                        </td>
                        <td>
                            <input type="number" class="form-control" name="btl[{{ $audit->id }}]">
                        </td>
                        <td>
                            @if($audit->sudah_disimpan)
                                <button class="btn btn-sm btn-secondary" disabled>Sudah Disimpan</button>
                            @else
                                <button type="submit" name="audit_id" value="{{ $audit->id }}" class="btn btn-sm btn-success">Simpan</button>
                            @endif
                        </td>                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data audit ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </form>
</div>
@endsection
