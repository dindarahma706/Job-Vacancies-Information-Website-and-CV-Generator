<?php

namespace App\Http\Controllers\applicant;

use App\Http\Controllers\Controller;
use App\Models\cv;
use App\Models\cvHistory;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class CVController extends Controller
{
    private $dataPDF;
    public function indexCV(){
        $data = cv::select('*')->get();
        return view('applicant.cvawal',['cv'=>$data]);
    }
    public function showForm($id){
        return view('cv.form',['id'=>$id]);
    }
    public function submitCVProfile(Request $request){
        $validator = Validator::make($request->all(),[
            'first_name'=>'required|max:15',
            'last_name' => 'required|max:15',
            'email'=>'required|email',
            'phone_number'=>'required|numeric|digits_between:9,12',
            'education'=>'required',
            'address'=>'required',
            'working_experience'=>'required',
            'skill'=>'required',
            'profile'=>'required',
            'id_cv'=>'required',
        ]);
        
        if ($validator->fails()){
            return response()->json([
                'status' => 'failed',
                'error' => $validator->errors()->toJson(),
            ]);
        }
        $photo = Auth::user()->photo;
        $id_user=Auth::user()->id;
        $id=time().'cv';
        // $this->dataPDF = [
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'email' => $request->email,
        //     'phone_number' => $request->phone_number,
        //     'education' => $request->education,
        //     'address' => $request->address,
        //     'working_experience' => $request->working_experience,
        //     'skill' => $request->skill,
        //     'photo' => $photo,
        // ];
        $cvHistory=new cvHistory;
        $cvHistory->id=$id;
        $cvHistory->id_user=$id_user;
        $cvHistory->first_name= $request->first_name;
        $cvHistory->last_name = $request->last_name;
        $cvHistory->email = $request->email;
        $cvHistory->phone_number = $request->phone_number;
        $cvHistory->education = $request->education;
        $cvHistory->address = $request->address;
        $cvHistory->working_experience = $request->working_experience;
        $cvHistory->skill = $request->skill;
        $cvHistory->photo = $photo;
        $cvHistory->profile=$request->profile;
        $cvHistory->id_cv=$request->id_cv;
        $cvHistory->save();

        return response()->json([
            'status' => 'success',
            'id'=>$id,
            // '' => $validator->errors()->toJson(),
        ]);

        
    }

    public function generatePDF($id)
    {
        $data=cvHistory::select('*','users.headline')
                        ->join('users', 'users.id','=','cv_histories.id_user')
                        ->where('cv_histories.id','=',$id)
                        ->first();
        $id_cv=$data->id_cv;
        $cv=cv::select('*')
            ->where('id','=',$id_cv)
            ->first();

        
        // Validasi punyanya sendiri
        if($data->id_user==Auth::user()->id){
            $dataArray = [
                // 'title' => 'How To Create PDF File Using DomPDF In Laravel 9 - Techsolutionstuff',
                // 'date' => date('d/m/Y'),
                'user' => $data
            ];
            // return $dataArray;
            return view("cv.template.".$cv->source."",$dataArray);            
            $pdf = PDF::loadView('cv.template.creative1', $dataArray);
            return $pdf->download('itsolutionstuff.pdf');        
        }else{
            return $data;
        }
    }
}
