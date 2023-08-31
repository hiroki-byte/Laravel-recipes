document.getElementById('add-form-button').addEventListener('click', function() {
    // 新しいフォーム要素を作成
    var formElement = document.createElement('div');
    formElement.classList.add('row','mb-2');

    var nestedElement1 = document.createElement('div');
    nestedElement1.classList.add('col-5','mb-2');
    nestedElement1.innerHTML = `
    <input type="text" name="sIname[]" placeholder="材料名を入力" class="form-control">
    `;

    var nestedElement2 = document.createElement('div');
    nestedElement2.classList.add('col-3','ml-auto');
    nestedElement2.innerHTML = `
    <button class="btn btn-outline-primary" name="searchInameButton[]" type="button">検索</button>
    `;

    var nestedElement3 = document.createElement('div');
    nestedElement3.classList.add('col-4');
    nestedElement3.innerHTML = ``;

    var nestedElement4 = document.createElement('div');
    nestedElement4.classList.add('col-5','mb-2');
    nestedElement4.innerHTML = `
    <select class="form-select" name="iname[]">
        <option value="" disabled selected hidden>検索した材料を選択</option>
    </select>
    `;

    var nestedElement5 = document.createElement('div');
    nestedElement5.classList.add('col-4');
    nestedElement5.innerHTML = `
    <input type="text" name="miname[]" placeholder="選択した材料" class="form-control">
    <input type="hidden" name="iid[]" value="">
    `;

    var nestedElement6 = document.createElement('div');
    nestedElement6.classList.add('col-2');
    nestedElement6.innerHTML = `
    <input type="text" name="amount[]" placeholder="分量を入力(g)" class="form-control">
    `;
    
    var nestedElement7 = document.createElement('div');
    nestedElement7.innerHTML = `
    <hr class="my-2 --bs-border-color border-2">
    `;

    formElement.appendChild(nestedElement1);
    formElement.appendChild(nestedElement2);
    formElement.appendChild(nestedElement3);
    formElement.appendChild(nestedElement4);
    formElement.appendChild(nestedElement5);
    formElement.appendChild(nestedElement6);
    formElement.appendChild(nestedElement7);
  
    // フォームを追加する要素に新しいフォームを追加
    var formContainer = document.getElementById('form-container');
    formContainer.appendChild(formElement);
    
    const selectIname = formElement.querySelector('select[name="iname[]"]');
    const inputIname = formElement.querySelector('input[name="miname[]"]');
    const hiddenInputIid = formElement.querySelector('input[name="iid[]"]');
    
    selectIname.addEventListener('change', function() {
        // プルダウンリストで選択した内容をテキストフォームに表示する処理
        const selectedOption = selectIname.options[selectIname.selectedIndex];
        if (selectedOption.value !== "") {
            inputIname.value = selectedOption.innerText;
            hiddenInputIid.value = selectedOption.value;
        } else {
            inputIname.value = "";
            hiddenInputIid.value = "";
        }
    });

    const searchButtons = formElement.querySelectorAll('[name="searchInameButton[]"]');
    searchButtons.forEach((searchButton, index) => {
        searchButton.addEventListener('click', function() {

            const searchInames = formElement.querySelectorAll('[name="sIname[]"]');
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
                const ingredientsId = formElement.querySelectorAll('[name="iname[]"]');
                ingredientsId.forEach(ingredientsId => {
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
                });
            }) 
            .catch(error => {
                alert("検索に失敗しました。キーワードを変えて再度検索してください。");
            })
        });
    });


});