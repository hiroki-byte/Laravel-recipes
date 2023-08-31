<!-- 親テンプレート'layouts.app'内に表示するための記述 -->
@extends('layouts.app') 

@section('content')
    <x-alert type="success" :session="session('recipe_success')"/>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($recipes as $recipe)
        <div class="col">
            <div class="card shadow-sm">
                <a href="/recipes/{{$recipe->rid}}">
                    <img src="{{ Storage::url($recipe->image) }}"  alt="Image" class="img-fluid img-thumbnail">
                </a>
            </div>
            <div class="card-body">
                <p class="card-text">{{$recipe->rname}}</p>
            </div>
        </div>
        @endforeach
    </div>
@endsection