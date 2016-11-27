<?php

namespace App\Modules\Subscription\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Subscription\HoldingRequest;
use App\Http\Controllers\Controller;
use App\Holding;

class HoldingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Subscription::holdings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Subscription::holdings.partials.modals.create-holding');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HoldingRequest $request)
    {
        if( \Request::ajax() ):
            
            Holding::create($request->all());
        
                return \Response::json(1);
        endif;

        return redirect()->route('subscription.holdings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Holding $holding)
    {
        return view('Subscription::holdings.partials.modals.show-holding', compact('holding'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  model  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Holding $holding)
    {
        return view('Subscription::holdings.partials.modals.edit-holding', compact('holding'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HoldingRequest $request, Holding $holding)
    {
        if( \Request::ajax() ):
            $holding->update($request->all());
        
                return \Response::json(1);

        endif;
    }
    
    public function destroy(Holding $holding)
    {
            try {
                
                $holding->delete();
                
            } catch (\Exception $e) {
                abort(500);
            }

        return \Response::json(1);
    }
    
    /**
     * Select data from load.
     *
     * @param  Illuminate\Http\Request  $request
     * @return array
     */
    public function load(Request $request)
    {
        $filter   = getFilterValues( $request->input('filter') );
        $skip     = $request->input('skip');
        $pageSize = $request->input('pageSize');
        $sort     = getSortValues( $request->input('sort') );

        $result = \App\Models\Dao\HoldingDAO::getHoldingsForGrid($filter, $skip, $pageSize, $sort);
  
        return ['data' => $result['result'], 'total' => $result['count']];
    }
}
