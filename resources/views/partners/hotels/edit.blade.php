<x-layout :pageTitle="$pageTitle">
    <div class="bg-white rounded-sm w-full p-5">
        <h1>update hotel</h1>
        <form action="/dashboard/hotels/update/p/{{ $data->id }}" method="post" enctype="multipart/form-data" >
            @if (session()->has('message'))
                <div class="border btn text-green-900 border-green-600 bg-green-200">
                    <p>The operation was successful.</p>
                </div>
            @endif
             
            @csrf
            @method('PUT')
            <div class="grid grid-cols-3 p-4 gap-3">
                <div class="input-span">
                    <span >name</span>
                    <input type="text" name="name" value="{{ $data->name }}" >
                    @error('name')
                        <span class="text-sm text-red-500 font-extralight">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-span col-span-1">
                    <span>type</span>
                    <input  type="text" name="type" value="{{ $data->type }}">
                     @error('type')
                        <span class="text-sm text-red-500 font-extralight">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-span col-span-1">
                    <span>location {{ $data->location }}</span>
                    <input  type="text" name="location" value="{{ $data->location }}"  >
                    @error('location')
                        <span class="text-sm text-red-500 font-extralight">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-span col-span-3">
                    <span>description</span>
                    <textarea name="description"  rows="10">{{ $data->description }}</textarea>
                    @error('description')
                        <span class="text-sm text-red-500 font-extralight">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-span col-span-2">
                    <span>uplaod picture</span>
                    <div class="flex flex-row items-center">
                        <label class="btn btn-primary" for="file">uplaod 1</label>
                        <input  type="file" class="border-none" name="picture" accept="image/*" id="file">
                        @error('picture')
                        <span class="text-sm text-red-500 font-extralight">{{ $message }}</span>
                    @enderror
                    </div>
                </div>
                <div class="input-span col-span-1">
                    <img src="{{ $data->image_url }}" width="150" alt="" srcset="">
                </div>

                <div class="input-span col-span-1">
                    <span>phone</span>
                    <input type="tel" name="phone" value="{{ $data->phone }}">
                    @error('phone')
                        <span class="text-sm text-red-500 font-extralight">{{ $message }}</span>
                    @enderror
                </div>
               
                <div class="input-span col-span-1">
                    <span>average price</span>
                    <input  type="number" name="average_price" value="{{ $data->average_price }}">
                    @error('average_price')
                        <span class="text-sm text-red-500 font-extralight">{{ $message }}</span>
                    @enderror
                </div>

                 <div class="input-span col-span-1">
                    <span>website url</span>
                    <input type="url" name="website_url" value="{{ $data->website_url }}">
                    @error('website_url')
                        <span class="text-sm text-red-500 font-extralight">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-span col-span-1">
                    <span>google maps url</span>
                    <input  type="url" name="google_maps_url" value="{{ $data->google_maps_url }}">
                      @error('google_maps_url')
                        <span class="text-sm text-red-500 font-extralight">{{ $message }}</span>
                    @enderror
                </div>

                <div class=" col-span-3 p-5">
                    <button class="btn btn-primary" type="submit">submit</button>
                </div>

            </div>
        </form>

    </div>
</x-layout>