@extends('layouts.app')

    @section('content')
    <x-alert type="success" :session="session('recipe_success')"/>
    <div class="nav-scroller bg-body shadow-sm">
        <nav class="nav" aria-label="Secondary navigation">
            <a class="nav-link text-success fs-4 fw-bolder" aria-current="page">{{ Auth::user()->name }} さん のマイページ</a>
        </nav>
    </div>
    <div class="my-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button
                class="nav-link active"
                id="home-tab"
                data-bs-toggle="tab"
                data-bs-target="#home"
                type="button"
                role="tab"
                aria-controls="home"
                aria-selected="true"
                >
                <h5>マイレシピ</h5>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                class="nav-link"
                id="publish-tab"
                data-bs-toggle="tab"
                data-bs-target="#publish"
                type="button"
                role="tab"
                aria-controls="publish"
                aria-selected="false"
                >
                <h5>公開中</h5>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                class="nav-link"
                id="unpublish-tab"
                data-bs-toggle="tab"
                data-bs-target="#unpublish"
                type="button"
                role="tab"
                aria-controls="unpublish"
                aria-selected="false"
                >
                <h5>下書き</h5>
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div
                class="tab-pane fade show active"
                id="home"
                role="tabpanel"
                aria-labelledby="home-tab"
            >
            <div class="my-3"></div>
            @foreach($recipes as $recipe)
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col-6">
                        <div class="card shadow-sm">
                            <a href="/recipes/{{$recipe->rid}}">
                                <img src="{{ Storage::url($recipe->image) }}"  alt="Image" class="img-fluid img-thumbnail">
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <a class="text-success fs-4 fw-bolder" href="/recipes/{{$recipe->rid}}">{{$recipe->rname}}</a><br>
                        <div class="btn-group">
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
                    </div>
                </div>
                <hr class="my-3">
                @endforeach
            </div>
            <div
                class="tab-pane fade"
                id="publish"
                role="tabpanel"
                aria-labelledby="publish-tab"
            >
            <div class="my-3"></div>
                @foreach($recipes as $recipe)
                    @if($recipe->publish_flg === 0)
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            <div class="col-6">
                                <div class="card shadow-sm">
                                    <a href="/recipes/{{$recipe->rid}}">
                                        <img src="{{ Storage::url($recipe->image) }}"  alt="Image" class="img-fluid img-thumbnail">
                                    </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <a class="text-success fs-4 fw-bolder" href="/recipes/{{$recipe->rid}}">{{$recipe->rname}}</a><br>
                                <div class="btn-group">
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
                            </div>
                        </div>
                        <hr class="my-3">
                    @endif
                @endforeach
            </div>
            <div
                class="tab-pane fade"
                id="unpublish"
                role="tabpanel"
                aria-labelledby="unpublish-tab"
            >
            
            <div class="my-3"></div>
                @foreach($recipes as $recipe)
                    @if($recipe->publish_flg === 1)
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            <div class="col-6">
                                <div class="card shadow-sm">
                                    <a href="/recipes/{{$recipe->rid}}">
                                        <img src="{{ Storage::url($recipe->image) }}"  alt="Image" class="img-fluid img-thumbnail">
                                    </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <a class="text-success fs-4 fw-bolder" href="/recipes/{{$recipe->rid}}">{{$recipe->rname}}</a><br>
                                <div class="btn-group">
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
                            </div>
                        </div>
                        <hr class="my-3">
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection