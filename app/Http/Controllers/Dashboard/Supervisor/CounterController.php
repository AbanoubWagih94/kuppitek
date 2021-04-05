<?php

namespace App\Http\Controllers\Dashboard\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use App\Models\CounterUsers;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counters = Counter::all();
        return view('dashboard.pages.supervisor.counter.index', ['counters' => $counters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.supervisor.counter.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'counter_number' => 'required|numeric|unique:counters'
        ]);

        $counter = Counter::create([
            'counter_number' => $request->counter_number,
        ]);
        if (!$counter) {
            session()->flash('alert_message', ['message' => "something goes wrong please try again later!", 'icon' => 'error']);
            return redirect()->back();
        }
        session()->flash('alert_message', ['message' => "New counter added", 'icon' => 'success']);

        return redirect('/dashboard/counter');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $counter = Counter::find($id);
        $users = $counter->users;
        return view('dashboard.pages.supervisor.counter.show', ['counter' => $counter, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $counter = Counter::find($id);
        return view('dashboard.pages.supervisor.counter.edit', ['counter' => $counter]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $counter = Counter::find($id);
        // $counter->counter_number = $request->counter_number;
        // $counter->save();
        if (!$counter) {
            session()->flash('alert_message', ['message' => "something goes wrong please try again later!", 'icon' => 'error']);
            return redirect()->back();
        }
        session()->flash('alert_message', ['message' => "Counter Inforamtion updated", 'icon' => 'success']);

        return redirect('/dashboard/counter');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $counter = Counter::find($id);
        if ($counter) {
            $counter->delete();
            session()->flash('alert_message', ['message' => "success", 'icon' => 'success']);
        } else {
            session()->flash('alert_message', ['message' => "Something goes wrong please try again later !", 'icon' => 'error']);
        }
        return redirect('/dashboard/counter');
    }

    public function showOpenCounterForm($id)
    {
        $counter = Counter::find($id);
        return view('dashboard.pages.supervisor.counter.open_counter', ['counter' => $counter]);
    }

    public function openCounterForm(Request $request, $id)
    {
        $request->validate([
            'start_money' => 'required'
        ]);

        $counter = Counter::find($id);
        $user = session('userLogin');
        $counter->counter_status = 1;
        $counter->save();
        $counter_user = CounterUsers::create([
            'counter_id' => $id,
            'user_id' => $user->id,
            'start_money' => $request->start_money
        ]);

        if (!($counter && $counter_user)) {
            session()->flash('alert_message', ['message' => "Something goes wrong please try again later !", 'icon' => 'error']);
        }

        session()->flash('alert_message', ['message' => "Counter Opened", 'icon' => 'success']);
        return redirect()->back();
    }
    public function closeCounterForm($id)
    {
        $counter = Counter::find($id);
        $counter->counter_status = 0;
        $counter->save();

        if (!($counter)) {
            session()->flash('alert_message', ['message' => "Something goes wrong please try again later !", 'icon' => 'error']);
        }

        session()->flash('alert_message', ['message' => "Counter Closed", 'icon' => 'success']);
        return  redirect()->back();;
    }
}
