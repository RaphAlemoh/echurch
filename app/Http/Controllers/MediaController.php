<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Media::all();
        return view('media.index')->with(compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('media.create');
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

        $media = new Media;
        $media->title = $request->title;
        $media->information = $request->information;
        $media->url = $request->url;
        $media->user_id = auth()->user()->id;
        if($request->confirmed == 'on'){
            $media->status = true;
        }
        $check_if_stream_exist = Media::where('status', true)->get();
        if(count($check_if_stream_exist) > 0){
            foreach ($check_if_stream_exist as $stream) {
                Media::where(['status' => true, 'id' => $stream->id])->update(['status' => false]);
            }
        }
        $media->save();
        if($media){
            return redirect()->back()->with('success_msg', 'Media uploaded successfully!');
        }else{
            return redirect()->back()->withErrors('Media not uploaded!');
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
        $media = Media::find($id);
        return view('media.show')->with(compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $media = Media::find($id);
        return view('media.edit')->with(compact(['media']));
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
        $media = Media::find($id);
        
        $this->validate($request,[
            'title' => 'required|string',
            'information' => 'required|string|max:255',
            'url' => 'required|url'
        ]);

        $data['title'] = $request->title;
        $data['information'] = $request->information;
        $data['url'] = $request->url;
        $data['user_id'] = auth()->user()->id;
        $media->update($data);
        if($media){
            return redirect()->back()->with('success_msg', 'Media updated successfully!');
        }else{
            return redirect()->back()->withErrors('Media not update!');
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
        $media = Media::find($id); 
        if ($media->delete())
        {
            return redirect('medias');
        }  
    }



    public function media(){
        $media = Media::where('status', true)->first();
        return view('media.media')->with(compact('media'));
    }
}
