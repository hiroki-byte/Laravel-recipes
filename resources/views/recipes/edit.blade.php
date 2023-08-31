@extends('layouts.app')

@section('content')
    @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
    @endif
    @if ($errors->any())
        @if($errors->has('rname') || $errors->has('serving') || $errors->has('image') || $errors->has('rcomment'))
            <div class="alert alert-danger">
        @else
            <div>
        @endif
            <ul>
                @foreach ($errors->all() as $error)
                    @if ($error !== $errors->first('iid.*') && $error !== $errors->first('amount.*') && $error !== $errors->first('steps_comment.*'))
                        <li>{{ $error }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        @if ($errors->has('iid.*'))
            <div class="alert alert-danger">
                {{ $errors->first('iid.*') }}
            </div>
        @endif
        @if ($errors->has('amount.*'))
            <div class="alert alert-danger">
                {{ $errors->first('amount.*') }}
            </div>
        @endif
        @if ($errors->has('steps_comment.*'))
            <div class="alert alert-danger">
                {{ $errors->first('steps_comment.*') }}
            </div>
        @endif
    @endif
    <div class="create-items">
        <div class="form">
            <form action="/recipes/{{$recipe->rid}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4 col-8">
                    <label for="rname" class="form-label">レシピ名※必須</label>
                    <input type="text" id="rname" name="rname" class="form-control" value="{{$recipe->rname}}">
                </div> 
                <div class="mb-4 col-8">
                    <label for="image" class="form-label">料理の写真</label><br>
                    <input type="file" name="image" accept="image/png,image/jpeg,image/gif" class="form-control">
                </div>
                <div class="mb-4 col-8">
                    <label for="rcomment" class="form-label">レシピ紹介文</label><br>
                    <textarea name="rcomment" class="form-control">{{$recipe->rcomment}}</textarea>
                </div>
                <div class="mb-4 col-5">
                    <label for="serving" class="form-label">レシピ対応人数(何人分)※必須,半角数字のみ</label>
                    <input type="text" id="serving" name="serving" placeholder="2" class="form-control" value="{{$recipe->serving}}">
                </div>

                <div class="row  mb-2">
                <label for="serving" class="form-label">材料名※必須</label>
                <hr class="my-2 --bs-border-color border-2">
                    @foreach($materials as $material)
                    
                        <div class="col-5 mb-2">
                            <input type="text" name="sIname[]" placeholder="材料名を入力" class="form-control">
                        </div>
                        <div class="col-3 ml-auto">
                            <button class="btn btn-outline-primary" name="searchInameButton[]" type="button">検索</button>
                        </div>
                        <div class="col-4">
                        </div>
                    
                        <div class="col-5 mb-2">
                            <select class="form-select" id="iname" name="iname[]">
                            <option value="" disabled selected hidden>検索した材料を選択</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="miname[]" value="{{$material->iname}}" class="form-control">
                            <input type="hidden" name="iid[]" value="{{$material->iid}}">
                        </div>
                        <div class="col-2">
                            <input type="text" name="amount[]" placeholder="200(g)" class="form-control" value="{{$material->amount}}">
                        </div>
                        <div class="col-1">
                        </div>
                        <hr class="my-2 --bs-border-color border-2">
                    @endforeach
                </div>

                <div id="form-container"></div>            
                <div class=" mb-4 col-2">
                    <button type="button" class="form-control btn btn-light btn-outline-dark" id="add-form-button">+ 追加</button>
                </div>  


                
                    <label for="serving" class="form-label">作り方</label>
                    <hr class="my-2 --bs-border-color border-2">
                    @foreach($steps as $step)
                        <div class="row  mb-2 no-gutters">
                            <div class="col-1">
                                <label for="htmake" class="form-label">{{$step->no}}:</label>
                            </div>
                            <div class="col-6">
                                <textarea name="steps_comment[]" class="form-control">{{$step->steps_comment}}</textarea>
                            </div>
                            <div class="col-5"></div>
                        </div>
                        <hr class="my-2 --bs-border-color border-2">
                    @endforeach
                
                <div id="steps-container"></div>
                <div class=" mb-4 col-2">
                    <button type="button" class="form-control btn btn-light btn-outline-dark" id="add-steps-button">+ 手順を追加</button>
                </div>  
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="form-control btn btn-success" name="publish_flg" value="0">レシピを公開する</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="form-control btn btn-secondary" name="publish_flg" value="1">下書き保存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection