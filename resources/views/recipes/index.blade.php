<!-- 親テンプレート'layouts.app'内に表示するための記述 -->
@extends('layouts.app') 

@section('content')
    @foreach($recipes as $recipe)
        <!-- 3つのアイテムごとに新しいrowを開始 -->
        @if($loop->iteration % 3 == 1)
            <div class="row">
        @endif
        <div class ="col" style="overflow: hidden; width:400px; height:400px;">
            <div class="mb-1"><a href="/recipes/{{$recipe->rid}}"><img src="{{ Storage::url($recipe->image) }}" class="img-fluid rounded"></a></div>
            <div class="col=12 text-start"><h2>{{$recipe->rname}}</h2></div>
         </div>
        <!-- 3つのアイテムごとにrowを閉じる -->
        @if($loop->iteration % 3 == 0 || $loop->last)
            </div> 
        @endif
    @endforeach
    <a href="/recipes/create">Create</a>
@endsection