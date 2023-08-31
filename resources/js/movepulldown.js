document.addEventListener('DOMContentLoaded', function() {
    const selectInames = document.querySelectorAll('select[name="iname[]"]');
    const inputInames = document.querySelectorAll('input[name="miname[]"]');
    const hiddenInputIids = document.querySelectorAll('input[name="iid[]"]');

    selectInames.forEach((selectIname, index) => {
        const inputIname = inputInames[index];
        const hiddenInputIid = hiddenInputIids[index];

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
});
