<?php

namespace App\Http\Controllers;

use App\Models\Kuesioner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KuesionerController extends Controller
{
    public function showForm()
    {
        return view('form_kuesioner');
    }

    public function submitKuesioner(Request $request)
    {
        $this->validate($request, [
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'pendidikan'    => 'required',
            'pekerjaan'     => 'required',
            'instansi'      => 'required',
            'jenis_layanan' => 'required',
            'p1'            => 'required',
            'p2'            => 'required',
            'p3'            => 'required',
            'p4'            => 'required',
            'p5'            => 'required',
            'p6'            => 'required',
            'p7'            => 'required',
            'p8'            => 'required',
            'p9'            => 'required',
        ]);

        $input = $request->all();

        if ($request->pekerjaan_lainnya != null) {
            $input['pekerjaan'] = $request->pekerjaan_lainnya;
        }

        if ($request->saran == null) {
            $input['saran'] = '-';
        }

        Kuesioner::create($input);

        return redirect('/')->with('success', 'Data Responden Berhasil Disimpan');
    }

    public function showResponden(Request $request)
    {
        $date_filter = ($request->filled('date')) ? $request->date : null;
        $respondens = Kuesioner::when($request->filled('date'), function($query) use ($date_filter) {
                            return $query->whereDate('created_at', $date_filter);
                        })->orderby('created_at', 'desc')->get();

        $is_exist = ($respondens->count() > 0) ? true : false;

        for ($i = 1; $i <= 9; $i++) {
            for ($j = 1; $j <= 4; $j++) {
                $result["p$i"][$j] = ($is_exist) ? $respondens->where("p$i", $j)->count() : 0;
            }
        }
        
        $chart_sangat_memuaskan = 0;
        $chart_memuaskan = 0;
        $chart_tidak_memuaskan = 0;

        $respondens->map(function($responden) use (&$chart_sangat_memuaskan, &$chart_memuaskan, &$chart_tidak_memuaskan) {
            $point_responden = ($responden->p1 + $responden->p2 + $responden->p3 + $responden->p4 + $responden->p5 + $responden->p6 + $responden->p7 + $responden->p8 + $responden->p9);
            
            if ($point_responden >= 1 && $point_responden <= 12):
                $chart_tidak_memuaskan++;
            elseif ($point_responden > 12 && $point_responden <= 24):
                $chart_memuaskan++;
            else:
                $chart_sangat_memuaskan++;
            endif;
        });

        $chart = [
            'sangat_memuaskan' => $chart_sangat_memuaskan,
            'memuaskan' => $chart_memuaskan,
            'tidak_memuaskan' => $chart_tidak_memuaskan
        ];
        
        return view('responden', compact('respondens', 'result', 'chart', 'date_filter'));
    }

    public function detailResponden($kuesionerId)
    {
        $data = Kuesioner::where('id', $kuesionerId)->first();
        $data->waktu_pengisian = Carbon::parse($data->created_at)->format('d M Y H:i');
        $data->total_point = ($data->p1 + $data->p2 + $data->p3 + $data->p4 + $data->p5 + $data->p6 + $data->p7 + $data->p8 + $data->p9);
        return response()->json($data, 200);
    }
}
