<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Karyawan;
use App\Models\PermintaanBarang;
use App\Models\PermintaanBarangDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermintaanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ambil semua data last lalu bagi menjadi 10 data setiap page
        $permintaan =  PermintaanBarang::select(
            'permintaan_barang.id',
            'permintaan_barang.nik',
            'karyawan.nama as nama_karyawan',
            'departemen.nama_departemen as departemen',
            'permintaan_barang.tanggal',
            'permintaan_barang.status',
            'permintaan_barang.keterangan',
            'permintaan_barang.processed_by',
            'permintaan_barang.processed_at'
        )
            ->join('karyawan', 'permintaan_barang.nik', '=', 'karyawan.nik')
            ->join('departemen', 'karyawan.departemen_id', '=', 'departemen.id')
            ->orderBy('permintaan_barang.id', 'desc')
            ->paginate(10);

        return view('permintaan_barang.list', compact('permintaan'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $karyawan = Karyawan::where('status', 1)->get();
        $barang = Barang::where('status', 1)->get();
        $nik =  Auth::user()->nik;
        return view('permintaan_barang.add', compact('karyawan', 'barang', 'nik'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi data
        $request->validate([
            'nik' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'string', 'max:50'],
            // 'barang' => ['required', 'array'],
            // 'barang.*.kode_barang' => ['required', 'string', 'max:255'],
            // 'barang.*.jumlah' => ['required', 'integer'],
            // 'keterangan' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            // menjalankan fungsi insert pada table permintaan barang
            $pb = PermintaanBarang::create([
                'nik' => $request->nik,
                'tanggal' => $request->tanggal,
                'keterangan' => $request->keterangan,
                'created_at' => Carbon::now('Asia/Jakarta')
            ]);

            // jika data permintaan barang berhasil di insert
            if ($pb) {
                // looping data barang
                foreach ($request->barang as $key => $value) {
                    // menjalankan fungsi insert pada table detail permintaan barang
                    $detail = PermintaanBarangDetail::create([
                        'permintaan_barang_id' => $pb->id,
                        'kode_barang' => $value['kode_barang'],
                        'jumlah' => $value['kuantiti'],
                        'keterangan' => $value['keterangan'],
                        'created_at' => Carbon::now('Asia/Jakarta')
                    ]);

                    // kurangi stock barang
                    $barang = Barang::where('kode_barang', $value['kode_barang'])->first();
                    $barang->stock = $barang->stock - $value['kuantiti'];
                    $barang->save();
                }

                // response jika berhasil
                return response()->json(['success' => 'Successfully create new permintaan barang']);
            } else {
                return response()->json(['error' => 'Failed to create new permintaan barang']);
            }
        } catch (\Throwable $th) {
            // jika terjadi error
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pb = PermintaanBarang::select(
            'permintaan_barang.id',
            'permintaan_barang.nik',
            'karyawan.nama as nama_karyawan',
            'departemen.nama_departemen as departemen',
            'permintaan_barang.tanggal',
            'permintaan_barang.status',
            'permintaan_barang.keterangan',
            DB::raw('(select karyawan.nama as nama_karyawan from karyawan where karyawan.nik = permintaan_barang.processed_by) as processed_by'),
            'permintaan_barang.processed_at'
        )
            ->join('karyawan', 'permintaan_barang.nik', '=', 'karyawan.nik')
            ->join('departemen', 'karyawan.departemen_id', '=', 'departemen.id')
            ->where('permintaan_barang.id', $id)
            ->firstOrFail();

        // jika ada data permintaan barang
        if ($pb) {
            $barang = PermintaanBarangDetail::select(
                'permintaan_barang_detail.id',
                'permintaan_barang_detail.kode_barang',
                'barang.nama_barang',
                'permintaan_barang_detail.jumlah',
                'satuan_barang.nama_satuan as satuan',
            )
                ->join('barang', 'permintaan_barang_detail.kode_barang', '=', 'barang.kode_barang')
                ->join('satuan_barang', 'barang.satuan_id', '=', 'satuan_barang.id')
                ->where('permintaan_barang_detail.permintaan_barang_id', $id)
                ->get();
        } else {
            return response()->json(['error' => 'Data Not Found']);
        }

        // buka halaman view permintaan barang_show dengan mengirim datanya
        return response()->json(['data' => $pb, 'barang' => $barang]);
    }

    public function getKaryawanById($id)
    {
        $karyawan = Karyawan::select(
            'id',
            'nik',
            'nama',
            'departemen_id',
            'departemen.nama_departemen as departemen'
        )
            ->join('departemen', 'karyawan.departemen_id', '=', 'departemen.id')
            ->where('nik', $id)
            ->first();
        return response()->json($karyawan);
    }

    public function getBarangById($id)
    {
        $barang = Barang::select(
            'kode_barang',
            'nama_barang',
            'lokasi_barang.nama_lokasi as lokasi',
            'stock',
            'satuan_barang.nama_satuan as satuan',
            'status'
        )
            ->join('lokasi_barang', 'barang.lokasi_id', '=', 'lokasi_barang.id')
            ->join('satuan_barang', 'barang.satuan_id', '=', 'satuan_barang.id')
            ->where('kode_barang', $id)
            ->first();
        return response()->json($barang);
    }

    public function proses(Request $request)
    {
        // validasi data
        $request->validate([
            'id' => ['required', 'string', 'max:255'],
            'status' => ['required', 'integer'],
            'keterangan' => ['nullable', 'string', 'max:255'],
        ]);
        $nik =  Auth::user()->nik;
        try {
            // menjalankan fungsi update pada table permintaan barang
            $pb = PermintaanBarang::where('id', $request->id)
                ->update([
                    'status' => $request->status,
                    'keterangan' => $request->keterangan,
                    'processed_by' => $nik,
                    'processed_at' => Carbon::now('Asia/Jakarta')
                ]);

            // jika data permintaan barang berhasil di update
            if ($pb) {
                // update stock barang
                $barang = PermintaanBarangDetail::where('permintaan_barang_id', $request->id)->get();
                foreach ($barang as $key => $value) {
                    $barang = Barang::where('kode_barang', $value['kode_barang'])->first();
                    if ($request->status == 2) { // Ditolak
                        $barang->stock = $barang->stock + $value['jumlah'];
                        $barang->save();
                    }
                }

                // response jika berhasil
                return response()->json(['success' => 'Successfully update permintaan barang']);
            } else {
                return response()->json(['error' => 'Failed to update permintaan barang']);
            }
        } catch (\Throwable $th) {
            // jika terjadi error
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function print($id)
    {
        $permintaan = PermintaanBarang::select(
            'permintaan_barang.id',
            'permintaan_barang.nik',
            'karyawan.nama as nama_karyawan',
            'departemen.nama_departemen as departemen',
            'permintaan_barang.tanggal',
            'permintaan_barang.status',
            'permintaan_barang.keterangan',
            DB::raw('(select karyawan.nama as nama_karyawan from karyawan where karyawan.nik = permintaan_barang.processed_by) as processed_by'),
            'permintaan_barang.processed_at'
        )
            ->join('karyawan', 'permintaan_barang.nik', '=', 'karyawan.nik')
            ->join('departemen', 'karyawan.departemen_id', '=', 'departemen.id')
            ->where('permintaan_barang.id', $id)
            ->firstOrFail();

        // jika ada data permintaan barang
        if ($permintaan) {
            $barang = PermintaanBarangDetail::select(
                'permintaan_barang_detail.id',
                'permintaan_barang_detail.kode_barang',
                'barang.nama_barang',
                'permintaan_barang_detail.jumlah',
                'satuan_barang.nama_satuan as satuan',
            )
                ->join('barang', 'permintaan_barang_detail.kode_barang', '=', 'barang.kode_barang')
                ->join('satuan_barang', 'barang.satuan_id', '=', 'satuan_barang.id')
                ->where('permintaan_barang_detail.permintaan_barang_id', $id)
                ->get();

            return view('permintaan_barang.print', compact('permintaan', 'barang'));
        } else {
            return response()->json(['error' => 'Data Not Found']);
        }
    }
}
