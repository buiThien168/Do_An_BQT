<?php

namespace App\Http\Services\Staff;

use App\Models\Work;
use App\Models\Work_propress;
use Illuminate\Support\Facades\Auth;

class StaffWorkService
{
    public function ListWork($request)
    {
        $GetWork = Work::leftJoin('users', 'users.id', 'works.user_id')
            ->leftJoin('user_infomations', 'user_infomations.id', 'users.id')
            ->leftJoin('positions', 'positions.id', 'user_infomations.positions')
            ->leftJoin('levels', 'levels.id', 'user_infomations.level')
            ->select('user_infomations.full_name', 'positions.name_position', 'works.*')
            ->orderBy('works.id', 'DESC')
            ->where('works.user_id', Auth::user()->id)
            ->where('works.deleted', 0);
        if (isset($request->keyword)) {
            $GetWork = $GetWork
                ->where('users.phone', $request->keyword)
                ->orWhere('user_infomations.full_name', $request->keyword)
                ->where('works.user_id', Auth::user()->id)
                ->where('works.deleted', 0)
                ->orWhere('user_infomations.id_number', $request->keyword)
                ->where('works.user_id', Auth::user()->id)
                ->where('works.deleted', 0);
        }
        $GetWork = $GetWork->paginate(15);
        return  $GetWork;
    }
    public function GetWork($id)
    {
        $GetWork = Work::where('id', $id)->first();
        return $GetWork;
    }
    public function GetWorkDetail($id)
    {
        $GetWorkDetail =  Work_propress::where('works', $id)->get();
        return $GetWorkDetail;
    }
    public function FinishWork($id)
    {
        $FinishWork = Work::where('id', $id)->update([
            'status' => 1,
            'updated_at'=>time(),
        ]);
        return $FinishWork;
    }
    public function PostEditWork($id, $request)
    {
        $PostEditWork = Work::where('id', $id)->update([
            'work_name' => $request->work_name,
            'note' => $request->note,
            'from' => date(strtotime($request->from)),
            'to' => date(strtotime($request->to)),
            'updated_at' => time(),
            'updater' => Auth::user()->id
        ]);
        return $PostEditWork;
    }
    public function PostUpdateProgress($id, $request)
    {
        $PostUpdateProgress = Work_propress::insert([
            'user_id' => Auth::user()->id,
            'works' => $id,
            'content' => $request->work_progress,
            'created_at' => time(),
            'created_by' => Auth::user()->id
        ]);
        return $PostUpdateProgress;
    }
}
