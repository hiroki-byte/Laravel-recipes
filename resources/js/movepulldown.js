document.addEventListener('DOMContentLoaded', function() {
    const selectIname = document.querySelector('select[name="iname[]"]');
    const inputIname = document.querySelector('input[name="miname[]"]');
    const hiddenInputIid = document.querySelector('input[name="iid[]"]');

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
});
