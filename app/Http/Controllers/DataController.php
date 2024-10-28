<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use Illuminate\Auth\Events\Validated;
use illuminate\View;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\SpladeQueryBuilder;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {

        $data= QueryBuilder::for(Data::class)
        ->allowedSorts(['nama_lembaga'])
        ->paginate()
        ->withQueryString();
        

        return view ('data.index',[
            'data' => SpladeTable::for(Data::class)
                ->withGlobalSearch(columns: ['nama_lembaga','jenis_lembaga', 'no_oprasional'])
                ->column('nama_lembaga', sortable: true)
                ->column('jenis_lembaga')
                ->column('tahun_berdiri')
                ->column('no_oprasional')
                ->column('dikeluarkan_oleh')
                ->column('alamat')
                ->column('status')
                ->column( 'action')
                ->paginate(15)

                
                
                // ->rowLink(function(Data $data){
                //     return route('data.edit',$data);
                // })
                ->paginate(15),
        ]);
        

  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('input.data');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nama_lembaga'      => 'required|min:5',
            'jenis_lembaga'      => 'required|min:5',
            'tahun_berdiri'       => 'required|date',
            'no_oprasional'      => 'required|numeric',
            'dikeluarkan_oleh'            => 'required|min:5',
            'alamat'            => 'required|min:5',
        ]);

        data::create([
            'nama_lembaga'      => $request -> nama_lembaga,
            'jenis_lembaga'     => $request -> jenis_lembaga,
            'tahun_berdiri'     => $request -> tahun_berdiri,
            'no_oprasional'     => $request -> no_oprasional,
            'no_wa'             => $request -> no_wa,
            'dikeluarkan_oleh'  => $request -> dikeluarkan_oleh,
            'alamat'            => $request -> alamat,
            'status'            => $request -> status ?? "Belum-Tervalidasi "
        ]);
        
        Toast::title('Data Berhasi Di Input')
                        ->message('Data Telah Di Rekam, Silahkan Tunggu Pemberitahuan Dari Admin')
                        ->centerTop()
                        ->autoDismiss(3)
                        ;

        return redirect()->route('input.data');
                        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data $data)
    {
       
        return view('data.edit',[
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Data $data)
    {
        

        $data->update([
            'nama_lembaga'      => $request -> nama_lembaga,
            'jenis_lembaga'     => $request -> jenis_lembaga,
            'tahun_berdiri'     => $request -> tahun_berdiri,
            'no_oprasional'     => $request -> no_oprasional,
            'no_wa'             => $request -> no_wa,
            'dikeluarkan_oleh'  => $request -> dikeluarkan_oleh,
            'alamat'            => $request -> alamat,
            'status'            => $request -> status

        ]);

        if($data->status === 'Tervalidasi'){
            
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('form.docx');
            $alamat = $request->alamat;
            $keterangan = 'Bahwa Lembaga tersebut betul betul berdomisili '.$alamat;
            $templateProcessor->setValues(
                [
                    'nama_lembaga'      => $request -> nama_lembaga,
                    'jenis_lembaga'     => $request -> jenis_lembaga,
                    'tahun_berdiri'     => $request -> tahun_berdiri,
                    'no_oprasional'     => $request -> no_oprasional,
                    'dikeluarkan_oleh'  => $request -> dikeluarkan_oleh,
                    'alamat'            => $request -> alamat,
                    'keterangan' =>  $keterangan,
                    
                ]
                );

            // Saving the document as HTML file...
                    $pathToSave = 'hasil_surat.docx';
                    $templateProcessor->saveAs($pathToSave);

                    header("Content-Description: File Transfer");
                    header('Content-Disposition: attachment; filename=hasil_surat.docx');
                    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                    
                    



        $token = 'LuxmPHWLyjRaL2fZt1vJ';
        $no_wa = $request->no_wa;
        $nama_lembaga = $request->nama_lembaga;
        $pesan = 'Halo ' .$nama_lembaga .' Data anda telah tervalidasi , Silahkan datang ke kantor desa untuk mengambil Surat Domisili';
    
    
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('target' => $no_wa,'message' => $pesan),
        CURLOPT_HTTPHEADER => array(
            'Authorization: '. $token
        ),
        ));
   

        $response = curl_exec($curl);

        curl_close($curl);

    
        }

        
        Toast::title('Data Berhasi Di Update')
        ->message('Data Telah Di Update')
        ->centerTop()
        ->autoDismiss(3)
        ;
        return redirect()->route('data.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Data $data)
    {
        $data->delete();
        Toast::title('Data Berhasi Di Hapus')
        ->message('Data Berhasil Di Hapus')
        ->centerTop()
        ->autoDismiss(3)
        ;
        return redirect()->route('data.index');
    }
}
