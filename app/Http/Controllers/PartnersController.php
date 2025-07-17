<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurants;
use App\Models\Hotels;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PartnersController extends Controller
{
    //for Restaurants ////////////////////////////////////////////////////////////////////////////////
    public function index_restaurants(){
        return view('partners.restaurants.index',[
            'pageTitle'=>'restaurants',
            'data'=>Restaurants::get()
        ]);
    }
    public function add_restaurants(){
        return view('partners.restaurants.add',[
            'pageTitle'=>'restaurants'
        ]);
    }
    public function post_restaurants(Request $request){
       $FormFielde=$request->validate([
        'name'              =>'required|string|min:3|max:255',
        'type'              =>'required|string|min:3|max:255',
        'location'          =>'required|string|min:3|max:255',
        'description'       =>'required|string|min:10|max:1000',
        'phone'             =>'nullable|string|min:8|max:20',
        'open_time'         =>'nullable|date_format:H:i',
        'close_time'        =>'nullable|date_format:H:i|after:open_time',
        'average_price'     =>'nullable|numeric|min:0|max:100000',
        'website_url'       =>'nullable|string|max:255',
        'google_maps_url'   =>'nullable|string|max:255',
       ]);
       $imagePath = null;
       if($request->hasFile('picture')){
        $imagePath=$request->file('picture')->store('pictures','public');
       }
       $FormFielde['image_url']=$imagePath ? asset('storage/' . $imagePath) : null;
       Restaurants::create($FormFielde);
       return back()->with('message','succes');
    }

    public function  delete_restaurants($id){
        $restaurant=Restaurants::FindOrFail($id);
         if ($restaurant->image_url) {
            $imagePath = str_replace('/storage/', '', parse_url($restaurant->image_url, PHP_URL_PATH));
            Storage::disk('public')->delete($imagePath);
        }
        $restaurant->delete();
        return back()->with('message','sucess');
    }
    public function edit_restaurants($id)
    {
        return view('partners.restaurants.edit',[
            'pageTitle'=>'restaurants',
            'data'=>Restaurants::FindOrFail($id)
        ]);
    }

    public function update_restaurants(Request $request,$id)
    {
        $restaurant=Restaurants::FindOrFail($id);
        $FormFielde=$request->validate([
            'name'              =>'required|string|min:3|max:255',
            'type'              =>'required|string|min:3|max:255',
            'location'          =>'required|string|min:3|max:255',
            'description'       =>'required|string|min:10|max:1000',
            'phone'             =>'nullable|string|min:8|max:20',
            'average_price'     =>'nullable|numeric|min:0|max:100000',
            'website_url'       =>'nullable|string|max:255',
            'google_maps_url'   =>'nullable|string|max:255',
        ]);
         $FormFielde['open_time'] = $request->open_time
            ? Carbon::parse($request->open_time)->format('H:i')
            : null;
             $FormFielde['close_time'] = $request->close_time
            ? Carbon::parse($request->close_time)->format('H:i')
            : null;
        if($request->hasFile('picture')){
            if ($restaurant->image_url) {
                $imagePath = str_replace('/storage/', '', parse_url($restaurant->image_url, PHP_URL_PATH));
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath=$request->file('picture')->store('pictures','public');
            $FormFielde['image_url']=asset('storage/' . $imagePath);
        }else{
            $FormFielde['image_url']=$restaurant->image_url;
        }
        $restaurant->update($FormFielde);
        return back()->with('message','succes');

    }






    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function index_hotels(){
        return view('partners.hotels.index',[
            'pageTitle'=>'restaurants',
            'data'=>Hotels::get()
        ]);
    }
    public function add_hotels(){
        return view('partners.hotels.add',[
            'pageTitle'=>'hotel'
        ]);
    }
    public function post_hotels(Request $request){
       $FormFielde=$request->validate([
        'name'              =>'required|string|min:3|max:255',
        'type'              =>'required|string|min:3|max:255',
        'location'          =>'required|string|min:3|max:255',
        'description'       =>'required|string|min:10|max:1000',
        'phone'             =>'nullable|string|min:8|max:20',
        'average_price'     =>'nullable|numeric|min:0|max:100000',
        'website_url'       =>'nullable|string|max:255',
        'google_maps_url'   =>'nullable|string|max:255',
       ]);
       $imagePath = null;
       if($request->hasFile('picture')){
        $imagePath=$request->file('picture')->store('pictures','public');
       }
       $FormFielde['image_url']=$imagePath ? asset('storage/' . $imagePath) : null;
       Hotels::create($FormFielde);
       return back()->with('message','succes');
    }

    public function  delete_hotels($id){
        $hotel=Hotels::FindOrFail($id);
         if ($hotel->image_url) {
            $imagePath = str_replace('/storage/', '', parse_url($hotel->image_url, PHP_URL_PATH));
            Storage::disk('public')->delete($imagePath);
        }
        $hotel->delete();
        return back()->with('message','sucess');
    }
    public function edit_hotels($id)
    {
        return view('partners.hotels.edit',[
            'pageTitle'=>'hotels',
            'data'=>Hotels::FindOrFail($id)
        ]);
    }

    public function update_hotels(Request $request,$id)
    {
        $hotel=Hotels::FindOrFail($id);
        $FormFielde=$request->validate([
            'name'              =>'required|string|min:3|max:255',
            'type'              =>'required|string|min:3|max:255',
            'location'          =>'required|string|min:3|max:255',
            'description'       =>'required|string|min:10|max:1000',
            'phone'             =>'nullable|string|min:8|max:20',
            'average_price'     =>'nullable|numeric|min:0|max:100000',
            'website_url'       =>'nullable|string|max:255',
            'google_maps_url'   =>'nullable|string|max:255',
        ]);
        if($request->hasFile('picture')){
            if ($hotel->image_url) {
                $imagePath = str_replace('/storage/', '', parse_url($hotel->image_url, PHP_URL_PATH));
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath=$request->file('picture')->store('pictures','public');
            $FormFielde['image_url']=asset('storage/' . $imagePath);
        }else{
            $FormFielde['image_url']=$hotel->image_url;
        }
        $hotel->update($FormFielde);
        return back()->with('message','succes');

    }

    public function index(){
        return [
            'restaurants'=>Restaurants::get(),
            'hotels'=>Hotels::get()
        ] ;
    }

}
