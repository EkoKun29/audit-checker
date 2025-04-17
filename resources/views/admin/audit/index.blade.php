@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Data Audit</h5>
        <div class="card-body">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createAuditModal">Tambah Audit</button>

            <table class="table datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User ID</th>
                        <th>Storage</th>
                        <th>Barang</th>
                        <th>Dus</th>
                        <th>Btl</th>
                        <th>Total</th>
                        <th>Total Real</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php $no =1; ?>
                <tbody>
                    @foreach($audits as $audit)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $audit->id_user }}</td>
                        <td>{{ $audit->storage }}</td>
                        <td>{{ $audit->barang }}</td>
                        <td>{{ $audit->dus }}</td>
                        <td>{{ $audit->btl }}</td>
                        <td>{{ $audit->total }}</td>
                        <td>{{ $audit->total_real }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAuditModal{{ $audit->id }}">Edit</button>
                            <form action="{{ route('audit.destroy', $audit->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit Audit -->
                    <div class="modal fade" id="editAuditModal{{ $audit->id }}" tabindex="-1" aria-labelledby="editAuditModalLabel{{ $audit->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="{{ route('audit.update', $audit->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editAuditModalLabel{{ $audit->id }}">Edit Data Audit #{{ $audit->id }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row g-3">
                                        <div class="col-md-6">
                                            <label for="id_user" class="form-label">User ID</label>
                                            <input type="number" class="form-control" name="id_user" value="{{ $audit->id_user }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="storage" class="form-label">Storage</label>
                                            <input type="text" class="form-control" name="storage" value="{{ $audit->storage }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="barang" class="form-label">Barang</label>
                                            <input type="text" class="form-control" name="barang" value="{{ $audit->barang }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="dus" class="form-label">Dus</label>
                                            <input type="number" class="form-control" name="dus" value="{{ $audit->dus }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="btl" class="form-label">Btl</label>
                                            <input type="number" class="form-control" name="btl" value="{{ $audit->btl }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="total" class="form-label">Total</label>
                                            <input type="number" class="form-control" name="total" value="{{ $audit->total }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="total_real" class="form-label">Total Real</label>
                                            <input type="number" class="form-control" name="total_real" value="{{ $audit->total_real }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    @if($audits->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data Audit.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Audit -->
<div class="modal fade" id="createAuditModal" tabindex="-1" aria-labelledby="createAuditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('audit.store') }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createAuditModalLabel">Tambah Data Audit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row g-3">
            <div class="col-md-6">
                <label for="id_user" class="form-label">User ID</label>
                <input type="number" class="form-control" name="id_user" required>
            </div>
            <div class="col-md-6">
                <label for="storage" class="form-label">Storage</label>
                <input type="text" class="form-control" name="storage" required>
            </div>
            <div class="col-md-6">
                <label for="barang" class="form-label">Barang</label>
                <input type="text" class="form-control" name="barang" required>
            </div>
            <div class="col-md-4">
                <label for="dus" class="form-label">Dus</label>
                <input type="number" class="form-control" name="dus" required>
            </div>
            <div class="col-md-4">
                <label for="btl" class="form-label">Btl</label>
                <input type="number" class="form-control" name="btl" required>
            </div>
            <div class="col-md-4">
                <label for="total" class="form-label">Total</label>
                <input type="number" class="form-control" name="total" required>
            </div>
            <div class="col-md-4">
                <label for="total_real" class="form-label">Total Real</label>
                <input type="number" class="form-control" name="total_real" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </div>
    </form>
  </div>
</div>
@endsection