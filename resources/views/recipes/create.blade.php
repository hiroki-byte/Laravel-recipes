@extends('layouts.app')

@section('content')
    @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    @if ($error !== $errors->first('iname.*') && $error !== $errors->first('amount.*'))
                        <li>{{ $error }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        @if ($errors->has('iname.*'))
            <div class="alert alert-danger">
                {{ $errors->first('iname.*') }}
            </div>
        @endif
        @if ($errors->has('amount.*'))
            <div class="alert alert-danger">
                {{ $errors->first('amount.*') }}
            </div>
        @endif
    @endif
    <div class="create-items">
        <form action="/recipes" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 col-8">
                <label for="rname" class="form-label">レシピ名※必須</label>
                <input type="text" id="rname" name="rname" class="form-control">
            </div> 
            <div class="mb-4 col-8">
                <label for="image" class="form-label">料理の写真</label><br>
                <input type="file" name="image" accept="image/png,image/jpeg,image/gif" class="form-control">
            </div>
            <div class="mb-4 col-8">
                <label for="rcomment" class="form-label">レシピ紹介文</label><br>
                <textarea name="rcomment" class="form-control"></textarea>
            </div>
            <div class="mb-4 col-5">
                <label for="serving" class="form-label">レシピ対応人数(何人分)※必須,半角数字のみ</label>
                <input type="text" id="serving" name="serving" placeholder="2" class="form-control">
            </div>
            <div class="row  mb-2">
                <label for="serving" class="form-label">材料名※必須</label>
                <div class="col-5 mb-2">
               	    <input type="text" name="sIname" placeholder="材料名を入力" class="form-control">
                </div>
                <div class="col-3 ml-auto">
                    <button class="btn btn-outline-primary" name="searchInameButton" type="button">検索</button>
                </div>
                <div class="col-4">
                </div>
                <div class="col-5">
                    <select class="form-select" id="iname" name="iname[]">
                    <option value="" disabled selected hidden>検索した材料を選択</option>
                    </select>
                </div>
                <div class="col-4">
                    <input type="text" name="miname[]" placeholder="例：豚(かたロース)" class="form-control" readonly>
                    <input type="hidden" name="iid[]" value="">
                </div>
                <div class="col-2">
                	<input type="text" name="amount[]" placeholder="200(g)" class="form-control">
                </div>
            </div>
            <div id="form-container"></div>            
            <div class=" mb-4 col-2">
                <button type="button" class="form-control btn btn-light btn-outline-dark" id="add-form-button">+ 追加</button>
            </div>  


            <div class="row  mb-2 no-gutters">
                <label for="serving" class="form-label">作り方</label>
                <div class="col-2">
                    <label>
                        <span class="btn btn-outline-primary">
                            ＋画像
                            <input type="file" style="display:none" name="steps_image[]" accept="image/png,image/jpeg,image/gif">
                        </span>
                    </label>
                    <label for="htmake" class="form-label">　　 1:</label>
                </div>
                <div class="col-6">
                    <textarea name="steps_comment[]" class="form-control"></textarea>
                </div>
                <div class="col-4"></div>
            </div>
            <div id="steps-container"></div>            
            <div class=" mb-4 col-2">
                <button type="button" class="form-control btn btn-light btn-outline-dark" id="add-steps-button">+ 手順を追加</button>
            </div>  



            <input type="submit" class="form-control btn btn-warning" value="レシピを公開する">
        </form>
    </div>
@endsection