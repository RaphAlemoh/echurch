<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tv;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tvs = Tv::all();
        return view('tv.index')->with(compact('tvs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tv.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|string',
            'information' => 'required|string|max:255',
            'url' => 'required|url'
        ]);

        $tv = new Tv;
        $tv->title = $request->title;
        $tv->information = $request->information;
        $tv->url = $request->url;
        $tv->user_id = auth()->user()->id;
        if($request->confirmed == 'on'){
            $tv->status = true;
        }
        $check_if_stream_exist = Tv::where('status', true)->get();
        if(count($check_if_stream_exist) > 0){
            foreach ($check_if_stream_exist as $stream) {
                Tv::where(['status' => true, 'id' => $stream->id])->update(['status' => false]);
            }
        }
        $tv->save();
        if($tv){
            return redirect()->back()->with('success_msg', 'Stream broadcasted successfully!');
        }else{
            return redirect()->back()->withErrors('Stream not broadcasted!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tv = Tv::find($id);
        return view('tv.show')->with(compact('tv'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tv = Tv::find($id);
        return view('tv.edit')->with(compact(['tv']));
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
        $tv = TV::find($id);
        
        $this->validate($request,[
            'title' => 'required|string',
            'information' => 'required|string|max:255',
            'url' => 'required|url'
        ]);

        $data['title'] = $request->title;
        $data['information'] = $request->information;
        $data['url'] = $request->url;
        $data['user_id'] = auth()->user()->id;
        if($request->confirmed == ''){
            $tv->status = false;
        }
        if($request->confirmed == 'on'){
            $tv->status = true;
        }
        $check_if_stream_exist = Tv::where('status', true)->get();
        // if(count($check_if_stream_exist) == 0 && $request->confirmed == ''){
        //     return redirect()->back()->withErrors('No stream to be broadcasted! Please set one');
        // }
        if(count($check_if_stream_exist) > 0){
            foreach ($check_if_stream_exist as $stream) {
                Tv::where(['status' => true, 'id' => $stream->id])->update(['status' => false]);
            }
        }
        $tv->update($data);
        if($tv){
            return redirect()->back()->with('success_msg', 'Streaming updated successfully!');
        }else{
            return redirect()->back()->withErrors('Streaming not update!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tv = Tv::find($id); 
        if ($tv->delete())
        {
            return redirect('tvs');
        }  
    }


    public function tv(){
        $stream = Tv::where('status', true)->first();
        return view('tv.tv')->with(compact('stream'));
    }
}
