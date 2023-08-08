<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use Illuminate\Http\Request;
use Illuminate\Http\Response;




class ListController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }


    public function home(Request $request): Response
    {
        $query = Lists::query();
        $date = $request->data_filter;
        $lists = Lists::all();
        return response()->view('home', compact('lists'));
    }

    public function task(Request $request)
    {
        $list = new Lists();
        $list->task = $request->task;
        $list->date = $request->date;

        if (strtotime($list->date) < time()) {
            $list->status = "Missed";
        } else {
            $list->status = "Pending";
        }

        $list->save();
        return back();
    }

    public function filterStatus(Request $request)
    {
        $status = $request->query('date_filter', 'all');

        if ($status === 'pending') {
            $lists = Lists::where('status', 'Pending')->get();
        } elseif ($status === 'completed') {
            $lists = Lists::where('status', 'Completed')->get();
        } elseif ($status === 'missed') {
            $lists = Lists::where('status', 'Missed')->get();
        } else {
            $lists = Lists::all();
        }

        return view('welcome', compact('lists'));
    }





    public function done($id)
    {
        $list = Lists::find($id);
        $list->status = 'Completed';
        $list->update();
        return back();
    }

    public function destroy($id)
    {
        $data = Lists::where('id', $id)->first();
        $data->delete();
        return redirect()->back();
    }
}
