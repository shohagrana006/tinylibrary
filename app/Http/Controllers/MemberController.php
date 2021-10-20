<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\MemberValidationRequest;
use Image;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.member.index',[
            'members' => Member::latest()->get(),
        ]);
    }
    public function post(MemberValidationRequest $request){
        $member_id = Member::insertGetId($request->except('_token') + [
            'created_at' => Carbon::now(),
        ]);

        if ($request->hasFile('image')) {
            $givenPhoto    = $request->file('image');
            $fileName      = $member_id.'.'.$givenPhoto->getClientOriginalExtension();
            $uploaded_path = "public/upload/image/".$fileName;
            Image::make($givenPhoto)->save(base_path($uploaded_path), 50);
            Member::find($member_id)->update([
                'image' => $fileName,
            ]);
        }
        return back()->with('success', __('Member Insert Successfully'));
    }

    public function edit($id){    
        return view('admin.member.edit',[
            'member' => Member::where('id', $id)->first(),
        ]);
    }

    public function update(Request $request, $id)
    {  
         
      
         Member::find($id)->update([
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'address'=> $request->address
        ]);
         if ($request->hasFile('image')) {
                $givenPhoto    = $request->file('image');
                $fileName      = $id.'.'.$givenPhoto->getClientOriginalExtension();
                $uploaded_path = "public/upload/image/".$fileName;
                
                $find_id = Member::where('id',$id)->first();
                if ( $find_id['image'] != 'default.png') {
                    if (isset($find_id['image'])) {
                        unlink(base_path($uploaded_path));
                    } 
                }
             
                Image::make($givenPhoto)->save(base_path($uploaded_path), 50);

                Member::where('id', $id)->update([
                    'image' => $fileName,
                ]);

        }

         return redirect('member')->with('success', __($request->name." member successfully Update!!"));
    }


    public function delete($id){
        Member::find($id)->delete();
        return redirect('member')->with('delete', __("Member Delete successfully!!"));
    }

}
