<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Audit;
use App\Models\AuditChecker;
use Illuminate\Http\Request;

class AuditCheckerController extends Controller
{
    public function index(Request $request)
    {
        $query = Audit::query();

        // Tambahkan filter jika ada inputan dari request
        if ($request->filled('tanggal_audit')) {
            $query->whereDate('created_at', $request->tanggal_audit);
        }

        if ($request->filled('id_user')) {
            $query->where('id_user', $request->id_user);
        }

        if ($request->filled('storage')) {
            $query->where('storage', $request->storage);
        }

        // Ambil semua data audit (terfilter atau tidak)
        $audits = $query->orderBy('created_at', 'desc')->get();

        // Tambahkan status apakah sudah disimpan
        foreach ($audits as $audit) {
            $audit->sudah_disimpan = AuditChecker::where('id_audit', $audit->id)->exists();
        }

        $users = User::all();
        $storages = Audit::select('storage')->distinct()->pluck('storage');

        return view('admin.audit-checker.index', compact('audits', 'users', 'storages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|integer',
            'id_audit' => 'required|exists:audits,id',
            'produk' => 'required|string',
            'dus' => 'required|numeric',
            'btl' => 'required|numeric',
            'kotak' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        AuditChecker::create($request->all());

        return redirect()->route('auditchecker.index')->with('success', 'Data AuditChecker berhasil ditambahkan.');
    }

    public function edit(AuditChecker $auditchecker)
    {
        $audits = Audit::all();
        return view('audit_checkers.edit', compact('auditchecker', 'audits'));
    }

    public function update(Request $request, AuditChecker $auditchecker)
    {
        $request->validate([
            'id_user' => 'required|integer',
            'id_audit' => 'required|exists:audits,id',
            'produk' => 'required|string',
            'dus' => 'required|numeric',
            'btl' => 'required|numeric',
            'kotak' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $auditchecker->update($request->all());

        return redirect()->route('auditchecker.index')->with('success', 'Data AuditChecker berhasil diupdate.');
    }

    public function destroy(AuditChecker $auditchecker)
    {
        $auditchecker->delete();
        return redirect()->route('auditchecker.index')->with('success', 'Data AuditChecker berhasil dihapus.');
    }

    public function storeFromTable(Request $request)
    {
        $auditId = $request->audit_id;

        AuditChecker::create([
            'id_user' => auth()->id(),
            'id_audit' => $auditId,
            'produk' => Audit::find($auditId)->barang,
            'dus' => $request->input("dus.$auditId"),
            'btl' => $request->input("btl.$auditId"),
            'kotak' => 0,
            'total' => ($request->input("dus.$auditId") + $request->input("btl.$auditId")),
        ]);

        return redirect()->route('auditchecker.index')->with('success', 'Data berhasil disimpan.');
    }

}
