<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\lamaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Applicant extends Controller
{
    public function showApplicant()
    {
        $data = User::select('users.*','lamarans.cv', 'lamarans.id as id_lamaran','pekerjaans.pekerjaan')
                ->join('lamarans','lamarans.id_pelamar','=','users.id')
                ->join('lokers','lokers.id','=','lamarans.id_loker')
                ->join('pekerjaans','pekerjaans.id','=','lokers.id_pekerjaan')
                ->join('perusahaans','perusahaans.id','=','lokers.id_perusahaan')
                ->where('perusahaans.id_owner','=',Auth::user()->id)
                ->where('lamarans.status','=','0')
                ->get();
        return view('company.applicant',['applicant'=>$data]);
    }

    public function acceptApplicant($id)
    {
        $lamaran = lamaran::where('id',$id)->first();
        $lamaran->status= '1';
        $lamaran->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully accept an Applicant'
        ]);
    }
    public function rejectApplicant($id)
    {
        $lamaran = lamaran::where('id', $id)->first();
        $lamaran->status = '2';
        $lamaran->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully reject an Applicant'
        ]);
    }

    public function showAccepted()
    {
        $data = User::select('users.*', 'lamarans.cv', 'lamarans.id as id_lamaran', 'pekerjaans.pekerjaan')
        ->join('lamarans', 'lamarans.id_pelamar', '=', 'users.id')
        ->join('lokers', 'lokers.id', '=', 'lamarans.id_loker')
        ->join('pekerjaans', 'pekerjaans.id', '=', 'lokers.id_pekerjaan')
        ->join('perusahaans', 'perusahaans.id', '=', 'lokers.id_perusahaan')
        ->where('perusahaans.id_owner', '=', Auth::user()->id)
            ->where('lamarans.status', '=', '1')
            ->get();
        return view('company.accepted', ['applicant' => $data]);
    }
    public function showRejected()
    {
        $data = User::select('users.*', 'lamarans.cv', 'lamarans.id as id_lamaran', 'pekerjaans.pekerjaan')
        ->join('lamarans', 'lamarans.id_pelamar', '=', 'users.id')
        ->join('lokers', 'lokers.id', '=', 'lamarans.id_loker')
        ->join('pekerjaans', 'pekerjaans.id', '=', 'lokers.id_pekerjaan')
        ->join('perusahaans', 'perusahaans.id', '=', 'lokers.id_perusahaan')
        ->where('perusahaans.id_owner', '=', Auth::user()->id)
            ->where('lamarans.status', '=', '2')
            ->get();
        return view('company.rejected', ['applicant' => $data]);
    }
}
