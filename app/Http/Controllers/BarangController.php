<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('Barang.index', compact(['barang']));
    }

    public function create()
    {
        $supplier = User::where('level','supplier')
            ->get();
        
        if ($supplier->first() === null) {
            return redirect('/barang')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Supplier Data is Empty'
                ]);

        } else {
            return view('Barang.create', compact(['supplier']));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_supplier' => 'required|max:11',
            'nama_barang' => 'required|max:50',
            'jenis' => 'required|max:25',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);

        try {
            Barang::create([
                'id_supplier' => $request->id_supplier,
                'nama_barang' => $request->nama_barang,
                'jenis' => $request->jenis,
                'stok' => $request->stok,
                'harga' => $request->harga,
            ]);

            return redirect('/barang')
                ->with('status',[
                    'type' => 'success',
                    'message' => 'Data Successfully Created'
                ]);

        } catch (\Throwable $th) {
            return redirect('/barang')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Error Store Data'
                ]);
        }
    }

    public function show($id)
    {
        $barang = Barang::find($id);
        $supplier = User::where('level','supplier')
            ->get();

        if ($barang === null) {
            return redirect('/barang')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Invalid Target Data'
                ]);

        } else if ($supplier->first() === null) {
            return redirect('/barang')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Supplier Data is Empty'
                ]);

        } else {
            return view('Barang.show', compact(['barang','supplier']));
        }
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if ($barang === null) {
            return redirect('/barang')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Invalid Target Data'
                ]);

        } else {
            $request->validate([
                'id_supplier' => 'required|max:11',
                'nama_barang' => 'required|max:50',
                'jenis' => 'required|max:25',
                'stok' => 'required|integer',
                'harga' => 'required|integer',
            ]);

            try {
                $barang->update([
                    'id_supplier' => $request->id_supplier,
                    'nama_barang' => $request->nama_barang,
                    'jenis' => $request->jenis,
                    'stok' => $request->stok,
                    'harga' => $request->harga,
                ]);

                return redirect('/barang')
                    ->with('status',[
                        'type' => 'success',
                        'message' => 'Data Successfully Updated'
                    ]);

            } catch (\Throwable $th) {
                return redirect('/barang')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Error Update Data'
                    ]);
            }
        }

    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        if ($barang === null) {
            return redirect('/barang')
                ->with('status',[
                    'type' => 'danger',
                    'message' => 'Invalid Target Data'
                ]);

        } else {
            try {
                $barang->delete();

                return redirect('/barang')
                    ->with('status',[
                        'type' => 'warning',
                        'message' => 'Data Successfully Deleted'
                    ]);

            } catch (\Throwable $th) {
                return redirect('/barang')
                    ->with('status',[
                        'type' => 'danger',
                        'message' => 'Error Destroy Data'
                    ]);
            }
        }
    }
}
