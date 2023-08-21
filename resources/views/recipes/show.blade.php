@extends('layouts.app')

@section('content')
    <table>
        <tr>
            <th>レシピID</th>
            <th>レシピ名</th>
            <th>イメージ</th>
            <th>レシピ対応人数</th>
            <th>レシピコメント</th>
        </tr>

        <tr>
            <td>{{$recipe -> rid}}</td>
            <td>{{$recipe -> rname}}</td>
            <td>{{$recipe -> serving}}</td>
            <td>{{$recipe -> image}}</td>
            <td>{{$recipe -> rcomment}}</td>
        </tr>
    </table>
    <a href="/recipes/{{$recipe->rid}}/edit">Edit</a>

    <form action="/recipes/{{$recipe->rid}}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="delete">
        <input type="submit" name="" value="Delete">
    </form>

    <a href="/recipes"> Back to index</a>
@endsection