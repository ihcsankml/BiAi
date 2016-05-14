<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Records;
use Session;
use Validator;
use App\Http\Response;
use DB;

class ChartController extends Controller
{
    //
	public function index()
	{
		$kotaunresolved = $this->getKota();
		return view('chart', compact('kotaunresolved'));
	}

	public function kota()
	{
		$kotakomp = $this->getPerKota();
		$kotareso = $this->getPerKota1();
		return view('kota', compact('kotakomp','kotareso'));
	}

	public function getPerKota()
	{
		$komplain = DB::select(
			DB::raw( "select tanggal, count(komplain) as komplain
				from records
				where kota='jakarta'
				group by tanggal"
				)
			);

		return $komplain;
	}

	public function getPerKota1()
	{
		$resolved = DB::select(
			DB::raw( "select tanggal, count(resolved) as resolved
				from records
				where kota='jakarta' AND resolved = 1
				group by tanggal"
				)
			);

		return $resolved;
	}

	public function postUpload (Request $request)
	{
		$file = $request->file('file');
        $name = $request->file('file')->getClientOriginalName();
        $request->file('file')->move(base_path().'/public/upload/', $name);    

        if (($handle = fopen(public_path().'/upload/'.$name,'r')) !== FALSE){
            while (($data = fgetcsv($handle, 2000, ',')) !==FALSE)
            {
                if($data[1] == "Kota"){
                    // do nothing
                } else {
                    $komplain = new Records();
                    $komplain->tanggal = $data[0];
                    $komplain->kota = $data[1];
                    $komplain->komplain = $data[2];
                    $komplain->resolved = $data[3];
                    $komplain->save();
                }
            }
            fclose($handle);
            Session::flash('flash_message','Upload file berhasil');
           	$kotaunresolved = $this->getKota();
            return redirect('chart');
        }
	}

	private function getKota()
	{
		$kotaunresolved = DB::select(
			DB::raw( "select kota, count(resolved) as jumlah_komplain from records where resolved = 0 
				group by kota"
				)
			);
		return $kotaunresolved;
	}

	// private function _import_csv($path, $filename)
	// {

	// 	$csv = $path . $filename; 

	// 	//ofcourse you have to modify that with proper table and field names
	// 	$query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE biai FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' ESCAPED BY '\"' LINES TERMINATED BY '\\n' IGNORE 0 LINES (`id`, `kota`, `tanggal`, `komplain`, `resolved`)", addslashes($csv));

	// 	DB::connection()->getpdo()->exec($query);
	// 	return redirect('chart');
	// }
}
