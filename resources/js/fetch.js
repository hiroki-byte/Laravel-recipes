document.querySelectorAll('[name="searchInameButton[]"]').forEach((button, index) => {
    button.addEventListener('click', () => {
    // const searchIname = document.getElementById('sIname').value;
    
    const searchInames = document.querySelectorAll('[name="sIname[]"]');
    const searchIname = searchInames[index].value;

    fetch('/show_all?query=' + encodeURIComponent(searchIname), {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',  // CSRFトークンの認証をバイパスするために追加
        },
    })
    //fetchの返り値はPromiseインスタンス
    //.thenでPromiseを参照
    .then((response) => response.json())//responseプロパティの値をjsonに変換
    .then(res => {
        const ingredientsIds = document.querySelectorAll('[name="iname[]"]');
        const ingredientsId = ingredientsIds[index];
        ingredientsId.innerHTML = '';
        const option = document.createElement('option');
        option.value = '';
        option.innerText = '材料を選択';
        option.setAttribute('disabled', 'disabled');
        option.setAttribute('selected', 'selected');
        option.setAttribute('hidden', 'hidden');
        ingredientsId.appendChild(option);
        // 取得したレコードをeachで順次取り出す
        res.forEach(elm =>{ 
            const option = document.createElement('option');
            option.value = elm['iid'];
            option.innerText = elm['iname'];
            // <select>要素に<option>要素を追加
            ingredientsId.appendChild(option);
            // forEach　は　phpの繰り返し処理 resに存在する配列の数だけ繰り返します
            // resと区別するため繰り返し処理中では連想配列の値は"elm"という配列名に代入して利用していきます
            // "elm"は"element"の略称です　エレメント（要素）とは「HTMLタグ」で囲んだ情報の単位を示します
        });
    }) 
    .catch(error => {
        alert("検索に失敗しました。キーワードを変えて再度検索してください。");
    })
}

// 最後に関数を実行します

// functionを動かす条件として”ボタンを押した場合”などの条件がない場合は
// ブラウザが更新されるとコードが上から順に、つまりHTMLとjavascriptが読み込まれるため
// indexAllは自動で実行されることになります

    
    
    );
});
