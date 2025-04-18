<?php
namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index()
    {
        $audits = Audit::all();
        return view('admin.audit.index', compact('audits'));
    }

    public function create()
    {
        return view('audit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'storage' => 'required',
            'barang' => 'required',
            'dus' => 'required|integer',
            'btl' => 'required|integer',
            'total' => 'numeric',
            'total_real' => 'numeric',
        ]);

        $data = $request->all();
        $data ['total'] = $data['dus'] * $data['btl'];
        Audit::create($data);
        return redirect()->route('audit.index')->with('success', 'Data audit berhasil ditambahkan.');
    }

    public function edit(Audit $audit)
    {
        return view('audit.edit', compact('audit'));
    }

    public function update(Request $request, Audit $audit)
    {
        $request->validate([
            'id_user' => 'required',
            'storage' => 'required',
            'barang' => 'required',
            'dus' => 'required|integer',
            'btl' => 'required|integer',
            'total' => 'numeric',
            'total_real' => 'numeric',
        ]);

        $data = $request->all();
        $data ['total'] = $data['dus'] * $data['btl'];
        $audit->update($data);
        return redirect()->route('audit.index')->with('success', 'Data audit berhasil diupdate.');
    }

    public function destroy(Audit $audit)
    {
        $audit->delete();
        return redirect()->route('audit.index')->with('success', 'Data audit berhasil dihapus.');
    }
    
    //API
    public function apiIndex()
    {
        $audits = Audit::all();

        return response()->json([
            'success' => true,
            'message' => 'Data Audit',
            'data' => $audits
        ]);
    }
}

