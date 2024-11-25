<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use yajra\Datatables\Datatables;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Console\Command;


class LocalizationController extends Controller
{

    private $lang = "/chin/messages.php";
    private $file;

    private $langOp;
    private $key = 'header';
    private $value;
    public $path;

    private $arrayLang;

    public function languageChange(Request $request, $language)
    {
        App()->setLocale($language);
        session()->put('language', $language);
        return response()->json([
            'status' => 200
        ]);
    }

    public function read()
    {


    }

    public function save()
    {

        $content = "<?php\n\nreturn\n[\n";
        foreach ($this->arrayLang as $this->key => $this->value) {
            $content .= "\t'" . $this->key . "' => '" . $this->value . "',\n";
        }

        $content .= "];";

        file_put_contents($this->path, $content);
    }



    public function addFileData()
    {
        $this->path = resource_path();
        $this->path .= '/lang';
        $data = [];
        $this->path = resource_path();
        $this->path .= '/lang';
        // $defaultPath = $this->path . $this->lang;
        // $arrayLang = include($defaultPath);
        // $formatedData=[];
        // foreach($arrayLang as $key=>$data){
        //     $formatedData[]=['key'=>$key,'message'=>$data];
        // }

        // dd($formatedData);

        $data['options'] = $this->langOp = array_diff(scandir($this->path), array('.', '..'));

        return view('admin.localization')->with(['data' => $data]);
    }

    public function languageYajraTable(Request $request)
    {

        if (!empty($request->language)) {
            $this->lang = $request->language . '/messages.php';

        }

        $this->path = resource_path();
        $this->path .= '/lang/';
        $defaultPath = $this->path . $this->lang;

        $arrayLang = require($defaultPath);
        //dd($arrayLang);
        log::info($arrayLang);
        $formatedData = [];
        foreach ($arrayLang as $key => $data) {
            $formatedData[] = ['name' => $key, 'message' => $data];
        }

        // $data=User::all();
        // $data=[
        //     ['name'=>'cccc']
        // ];

        return Datatables::of($formatedData)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '  <button type="button" class="btn btn-primary editButton" id="editButton" data-key=' . $row['name'] . ' data-message=' . $row['message'] . ' data-toggle="modal" >Edit</button>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function addLocalization(Request $request)
    {

        $this->path = resource_path();
        $this->path .= '/lang/';

        $defaultPath = $this->path . $request->language . '/messages.php';

        $data = include($defaultPath);
        $key = $request->messageKey;
        $message = $request->messageData;

        $data[$key] = $message;

        $filecontent = '<?php' . "\n" . "return[" . "\n";

        foreach ($data as $key => $update) {
            $filecontent .= "'$key'" . "=>" . "'$update'" . ",\n";
        }


        $filecontent .= "];\n\n";



        $data = file_put_contents($defaultPath, $filecontent,LOCK_EX);

        if($data)
        return response()->json([
            'status' => 200
        ]);


    }
}
