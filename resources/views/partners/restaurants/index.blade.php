<x-layout :pageTitle="$pageTitle">
    <div class="bg-white rounded-sm w-full p-5">
        @if (session()->has('message'))
                <div class="border btn text-green-900 border-green-600 bg-green-200">
                    <p>The operation was successful.</p>
                </div>
            @endif
        <div class="p-4">
            <a href="/dashboard/restaurants/add" class="btn btn-primary">add restaurant</a>
        </div>
        <hr/>
        <div class="p-4">
            <h2 class=" font-bold py-3">list of restaurants </h2>

            @if (count($data)>0)
                <table class="table">
                    <thead>
                        <tr >
                            <td >id</td>
                            <td>name</td>
                            <td>location</td>
                            <td>tools</td>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i=0;$i<count($data);$i++ )
                            <tr class='@if ($i%2===0) bg-gray-200 @endif'>
                                
                                <td >#{{$data[$i]['id']}}</td>
                                <td>{{$data[$i]['name']}}</td>
                                <td>{{$data[$i]['location']}}</td>
                                <td>
                                    <div class="w-full flex justify-center gap-3">
                                            <a href="/dashboard/restaurants/edit/{{ $data[$i]['id'] }}" class="btn-sm btn-primary" type="submit">edit</a>
                                        <form method="post" action="/dashboard/restaurants/add/p/{{ $data[$i]['id'] }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-sm btn-danger">delete</button>
                                        </form>
                                        
                                    </div>
                                </td>
                            </tr>
                        @endfor
                        
                    </tbody>
                </table>
            @else
                <div class="p-5 text-center align-baseline">
                    <p>There is nothing</p>
                </div>
            @endif
        </div>

    </div>
</x-layout>