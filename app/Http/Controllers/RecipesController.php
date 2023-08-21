<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Material;
use App\Models\Steps;
use App\Models\Ingredients;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         //データベース内のすべてのRecipeを取得し、recipe変数に代入
         $recipes = Recipe::all();
         //'items'フォルダ内の'index'viewファイルを返す。
         // その際にview内で使用する変数を代入します。
         return view('recipes/index',['recipes' => $recipes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recipes/create');
    }

    public function showAll(Request $request)
    {
        $iname = $request->input('query');
        $ingredients = Ingredients::where('iname', 'LIKE', '%' . $iname . '%')->get();
        

        foreach($ingredients as $ingredient){
            $ingredientList[] = array(
            'iid'    => $ingredient->iid,
            'iname'  => $ingredient->iname,
            );
        }

        // echoで配列をjsonに変換しつつfetchへサーバー情報を送信する
        echo json_encode($ingredientList);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'rname.required' => 'レシピ名は必須です。',
            'serving.required' => 'レシピ対応人数は必須です。',
            'serving.integer' => 'レシピ対応人数は半角数字2文字以内で入力してください。',
            'serving.max' => 'レシピ対応人数は10人以内で入力してください。',
            'image.required' => 'レシピ画像は必須です',
            'rcomment.max' => 'レシピ紹介文は255文字以内で入力してください。',
            'amount.*.required' => '分量を入力してください。',
            'amount.*.max' => '分量は5桁以内で入力してください。',
        ];   
        $validateData = $request->validate([
            'rname' => 'required|max:50',
            'serving' => 'required|integer|max:10',
            'image' => 'required',
            'rcomment' => 'max:255',
            'iid' =>'required|array|min:1',
            'amount' =>'required|array|min:1',
        ],$messages);
        //新しいインスタンスを作成
        $recipe = new Recipe;
        $ingredients = new Ingredients;
        // フォームから送られてきたデータをそれぞれ代入
        $recipe->rname = $request->rname;
        $recipe->serving = $request->serving;
        $img = $request->file('image');
        $path = $img->store('img','public');
        $recipe->image = $path;
        $recipe->rcomment = $request->rcomment;
        // DBに保存
        $recipe->save();

        // imageからridを特定
        $recipe = Recipe::where('image', $path)->first();
        $rid = $recipe->rid;
        // formからデータの配列を受け取るときはinput();
        $iids = $request->input('iid');
        $amounts = $request->input('amount');
        // 配列の数だけ照合・追加
        foreach($iids as $index => $iid){
            if(!empty($iid) && !empty($amounts[$index])){
                $material = new Material;
                $material->rid = $rid;
                $material->iid = $iid;
                $material->amount = $amounts[$index];
                $material->save(); 
            };
        }

        $simages = $request->file('steps_image');
        $scoments = $request->input('steps_comment');
        foreach ($simages as $index => $simage) {
            $steps = new Steps;
            $steps->rid = $rid;
            $spath = $simage->store('img','public');
            $steps->steps_image = $spath;
            $steps->steps_comment = $scoments[$index];
            $steps->no = $index + 1;
            // DBに保存
            $steps->save();
            
        }



        // indexページへ遷移
        return redirect('/recipes');
    }

    /**
     * Display the specified resource.
     */
    public function show($rid)
    {
        $recipe = Recipe::find($rid);
        return view('recipes.show',['recipe' => $recipe]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($rid)
    {
        $recipe = Recipe::find($rid);
        return view('recipes.edit',['recipe' => $recipe]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$rid)
    {
        $recipe = Recipe::find($rid);
        // フォームから送られてきたデータをそれぞれ代入
        $recipe->rname = $request->rname;
        $recipe->serving = $request->serving;
        $recipe->image = $request->image;
        $recipe->rcomment = $request->rcomment;
        // DBに保存
        $recipe->save();
        // indexページへ遷移
        return redirect('/recipes/'.$rid);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rid)
    {
        $recipe = Recipe::find($rid);
        $recipe->delete();
        return redirect('/recipes');
    }
}
