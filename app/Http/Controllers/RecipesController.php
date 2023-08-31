<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Material;
use App\Models\Steps;
use App\Models\Ingredients;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RecipeFormRequest;
use App\Http\Requests\UpdateFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\AuthController;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         //データベース内のすべてのRecipeを取得し、recipe変数に代入
         $recipes = Recipe::where('publish_flg', '=', '0')->get();
         //'items'フォルダ内の'index'viewファイルを返す。
         // その際にview内で使用する変数を代入します。
         return view('recipes/index',['recipes' => $recipes]);
    }

    public function search(Request $request)
    {
        $recipes = Recipe::where('publish_flg', '=', '0')
                            ->where('rname', 'like', '%' . $request->searchRname . '%')
                            ->get();             
         return view('recipes/index',['recipes' => $recipes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('recipes/create');
    }

    public function mypage()
    {
        $id = auth()->id();
        $recipes = Recipe::where('id', '=', $id)->get();            
        return view('recipes.mypage',['recipes' => $recipes]);
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
     * @param Illuminate\Http\Request\RecipeFormRequest
     * $request
     */

    public function store(RecipeFormRequest $request)
    {
        $recipe = new Recipe;
        $ingredients = new Ingredients;
        $id = auth()->id();
        $recipe->rname = $request->rname;
        $recipe->serving = $request->serving;
        $recipe->id = $id;
        $recipe->rcomment = $request->rcomment;
        $recipe->publish_flg = $request->publish_flg;
        $img = $request->file('image');
        $path = $img->store('img','public');
        $recipe->image = $path;
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

        $scomments = $request->input('steps_comment');
        foreach ($scomments as $index => $scomment) {
            if(!empty($scomment)){
                $steps = new Steps;
                $steps->rid = $rid;
                $steps->steps_comment = $scomment;
                $steps->no = $index + 1;
                // DBに保存
                $steps->save();
            }
        }
        // indexページへ遷移
        return redirect('/recipes')->with([
            'recipe_success' => 'レシピを投稿しました！'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($rid)
    {
        $recipe = Recipe::find($rid);
        $steps = Steps::where('rid', $rid)->get();
        $materials = Material::query()
                    ->select('ingredients.iname as iname', 'material.amount as amount')
                    ->join('ingredients', 'material.iid', '=', 'ingredients.iid')
                    ->where('material.rid', $rid)
                    ->orderBy('material.amount', 'desc')
                    ->get();
        $proteins = Material::query()
                    ->select(DB::raw('SUM(material.amount * ingredients.protein) / 100 as sum_protein'))
                    ->join('ingredients', 'material.iid', '=', 'ingredients.iid')
                    ->where('material.rid', $rid)
                    ->get();
        $fats = Material::query()
                    ->select(DB::raw('SUM(material.amount * ingredients.fat) / 100 as sum_fat'))
                    ->join('ingredients', 'material.iid', '=', 'ingredients.iid')
                    ->where('material.rid', $rid)
                    ->get();
        $carbos = Material::query()
                    ->select(DB::raw('SUM(material.amount * ingredients.carbo) / 100 as sum_carbo'))
                    ->join('ingredients', 'material.iid', '=', 'ingredients.iid')
                    ->where('material.rid', $rid)
                    ->get();
                    
        
        return view('recipes.show',['recipe' => $recipe ,'materials' => $materials ,'steps' => $steps ,'proteins' => $proteins , 'fats' => $fats, 'carbos' => $carbos]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($rid)
    {
        $recipe = Recipe::find($rid);
        $materials = Material::query()
                        ->select('ingredients.iname as iname', 'material.iid as iid', 'material.amount as amount')
                        ->join('ingredients', 'material.iid', '=', 'ingredients.iid')
                        ->where('material.rid', $rid)
                        ->orderBy('material.amount', 'desc')
                        ->get();
        $steps = Steps::where('rid', $rid)->get();
        return view('recipes.edit',['recipe' => $recipe , 'materials' => $materials , 'steps' => $steps]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormRequest  $request,$rid)
    {        
        $recipe = Recipe::find($rid);
        $recipe->rname = $request->rname;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $path = $img->store('img','public');
            $recipe->image = $path;
        }
        $recipe->rcomment = $request->rcomment;
        $recipe->serving = $request->serving;
        $id = auth()->id();
        $recipe->id = $id;
        $recipe->publish_flg = $request->publish_flg;
        $recipe->save();

        $mids = Material::query()
        ->select('material.mid as mid')
        ->where('material.rid', $rid)
        ->orderBy('material.mid', 'asc')
        ->get();
        $iids = $request->input('iid');
        $amounts = $request->input('amount');
        foreach($iids as $index => $iid){
            if(!empty($iid) && !empty($amounts[$index])){
                if (isset($mids[$index])) {
                    $mid = $mids[$index]->mid;
                    $material = Material::find($mid);
                }else{
                    $material = new Material;
                }
                $material->rid = $rid;
                $material->iid = $iid;
                $material->amount = $amounts[$index];
                $material->save(); 
            }else{
                if (isset($mids[$index])) {
                    $mid = $mids[$index]->mid;
                    $material = Material::find($mid);
                }else{
                    $material = new Material;
                }
                $material->delete();
            }
        }

        $sids = Steps::query()
        ->select('sid')
        ->where('rid', $rid)
        ->orderBy('sid', 'asc')
        ->get();
        $scomments = $request->input('steps_comment');
        foreach ($scomments as $index => $scomment) {
            if(!empty($scomment)){
                if (isset($sids[$index])) {
                    $sid = $sids[$index]->sid;
                    $steps = Steps::find($sid);
                }else{
                    $steps = new Steps;
                }
                $steps->rid = $rid;
                $steps->steps_comment = $scomment;
                $steps->no = $index + 1;
                // DBに保存
                $steps->save();
            }else{
                if (isset($sids[$index])) {
                    $sid = $sids[$index]->sid;
                    $steps = Steps::find($sid);
                }else{
                    $steps = new Steps;
                }
                $steps->delete();
            }
        }
        // indexページへ遷移
        return redirect('/mypage')->with([
            'recipe_success' => 'レシピ編集完了しました！'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($rid)
    {
        $recipe = Recipe::find($rid);
        $materials = Material::where('rid', $rid)->get();
        $steps = Steps::where('rid', $rid)->get();
        foreach($materials as $material){
            $material->delete();
        }
        foreach($steps as $step){
            $step->delete();
        }
        $recipe->delete();

        return redirect('/recipes');
    }
}
