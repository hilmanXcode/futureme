<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CapsuleController extends Controller
{
    public function create()
    {
        return view('pages.dashboard.capsule.create');
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => ['required'],
            'note'          => ['required'],
            'unlock_date'   => ['required', 'date']
        ]);

        if($data['unlock_date'] <= Carbon::now()->format('Y-m-d'))
            return back()->withErrors([
                'unlock_date' => 'Tanggal pelepasan harus di masa depan.'
            ]);
        
        $insert = DB::insert("
            INSERT INTO capsules (user_id, title, note, unlock_date, created_at)
            VALUES
            (?, ?, ?, ?, ?)
        ", [Auth::user()->id, $data['title'], $data['note'], $data['unlock_date'], Carbon::now()->format('Y-m-d H:i:s')]);
        
        if($insert){
            return redirect()->route('dashboard')->with('success', 'Berhasil membuat kapsul baru');
        } else {
            echo "Internal Server Error";
            die();
        }
    }

    public function read($id)
    {
        $data = [
            'capsule' => DB::select('select * from capsules where id = ? LIMIT 1', [$id])
        ];

        if(count($data['capsule']) == 0 || $data['capsule'][0]->user_id != Auth::user()->id){
            abort('404', 'Not Found');
        }

        if($data['capsule'][0]->unlock_date > Carbon::now()->format('Y-m-d')){
            abort('403', 'Forbidden');
        } else {
            if(!$data['capsule'][0]->readed_at){
                DB::update('update capsules set readed_at = ? where id = ?', [Carbon::now()->format('Y-m-d H:i:s'), $id]);
            }

        }
        
        return view('pages.dashboard.capsule.show', $data);
    }

    public function delete($id)
    {
        $data = DB::select('select id, user_id from capsules where id = ?', [$id]);

        if(count($data) == 0){
            abort('404', 'Not Found');
        }

        if($data[0]->user_id != Auth::user()->id){
            abort('404', 'Not Found');
        }

        $delete = DB::delete('delete from capsules where id = ?', [$id]);

        if($delete){
            return redirect()->route('dashboard')->with('success', 'Berhasil menghapus kapsul');
        } else {
            echo "Internal Server Error";
            die();
        }
    }

    public function edit($id)
    {
        $data = [
            'capsule' => DB::select('select * from capsules where id = ?', [$id])
        ];
        
        if(count($data['capsule']) == 0 || $data['capsule'][0]->user_id != Auth::user()->id){
            abort('404', 'Not Found');
        }

        return view('pages.dashboard.capsule.edit', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'title'         => ['required'],
            'note'          => ['required'],
            'unlock_date'   => ['required', 'date']
        ]);
        
        $data = DB::select('select id, user_id from capsules where id = ?', [$id]);

        if(!$id || count($data) == 0 || $data[0]->user_id != Auth::user()->id){
            abort('404', 'Not Found');
        }

        if($request->unlock_date <= Carbon::now()->format('Y-m-d'))
            return back()->withErrors([
                'unlock_date' => 'Tanggal pelepasan harus di masa depan.'
            ]);

        $update = DB::update("update capsules set title = ?, note = ?, unlock_date = ? where id = ?", [$request->title, $request->note, $request->unlock_date, $id]);

        if($update){
            return redirect()->route('dashboard')->with('success', 'Berhasil memperbarui kapsul');
        } else {
            echo "Internal Server Error";
            die();
        }
    }
}
