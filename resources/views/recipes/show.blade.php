@extends('layouts.app')

@section('content')
<main class="container py-5">
    <div class="row">
        <div class="col-8">
            <h1>{{$recipe->rname}}</h1>
        </div>
        @if(Auth::user()->id === $recipe->id )
            <div class="col-4 btn-group">
                <form action="/recipes/{{$recipe->rid}}/edit">
                    @csrf
                    <button class="btn btn-secondary mr-2">編集</button>
                </form>
                <form action="/recipes/{{$recipe->rid}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                    <input type="submit" name="" class="btn btn-danger" value="削除">
                </form>
            </div>
        @endif
    </div>
    
    <hr class="my-3">

    <div class="row" data-masonry='{"percentPosition": true }'>
        <div class="col-8 col-lg-8 mb-4">
            <div class="card mb-2">
                <img src="{{ Storage::url($recipe->image) }}">
                <div class="card-body">
                    <h4 class="card-title"> レシピコメント</h4>
                    <p class="card-text">{{$recipe->rcomment}}</p>
                </div>
            </div>
        </div>
        <div class="col-4 col-lg-4 mb-4">
            <div class="mb-3">
                <h3>栄養素(1人当たり)</h3>
            </div>
            @foreach ($proteins as $protein)
                <h6>   タンパク質：{{$protein->sum_protein}}g（{{$protein->sum_protein/$recipe->serving}}g）</h6>
                <hr class="my-2">
            @endforeach
            @foreach ($fats as $fat)
                <h6>   脂質：{{$fat->sum_fat}}g（{{$fat->sum_fat/$recipe->serving}}g）</h6>
                <hr class="my-2">
            @endforeach
            @foreach ($carbos as $carbo)
                <h6>   炭水化物：{{$carbo->sum_carbo}}g（{{$carbo->sum_carbo/$recipe->serving}}g）</h6>
                <hr class="my-2">
            @endforeach
            <h6>   合計カロリー：{{$carbo->sum_carbo*4+$fat->sum_fat*9+$protein->sum_protein*4}} kcal（{{($carbo->sum_carbo*4+$fat->sum_fat*9+$protein->sum_protein*4)/$recipe->serving}}kcal）</h6>
            <hr class="my-2">
        </div>

            <div class="mb-3">
                <h3>材料（{{$recipe->serving}}人前）</h3>
            </div>
            @foreach ($materials as $material)
                <h6>   {{ $loop->index + 1 }}:{{$material->iname}} - {{$material->amount }}g</h6>
                <hr class="my-2">
            @endforeach
            <div class="mb-3">
                <h3>作り方</h3>
            </div>
            @foreach ($steps as $step)
                <h6>   {{ $step->no }},{{$step->steps_comment}}</h6>
                <hr class="my-2">
            @endforeach  
        </div>
    </div>
</main>
@endsection