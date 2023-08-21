@extends('layouts.app')

@section('content')
    <div class="create-items">
        <div class="form">
            <form action="/recipes/{{$recipe->rid}}" method="POST">
                @csrf
                @method('PUT')
                <div class="input-form">
                    <label for="rname">レシピ名</label>
                    <input name="rname">
                </div> 
                <div class="input-form">
                    <label for="serving">レシピ対応人数</label>
                    <input name="serving">
                </div>
                <div class="input-form">
                    <label for="image">イメージ（要編集）</label>
                    <input name="image">
                </div>
                <div class="input-form">
                    <label for="rcomment">レシピコメント</label>
                    <textarea name="rcomment"></textarea>
                </div>
                <div class="input-form">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection