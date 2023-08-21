document.getElementById('add-steps-button').addEventListener('click', function() {
    const elementCount = 1+document.querySelectorAll('[name="steps_image[]"]').length;


    var formElement = document.createElement('div');
    formElement.classList.add('row','mb-2');

    var nestedElement1 = document.createElement('div');
    nestedElement1.classList.add('col-2');
    nestedElement1.innerHTML = `
    <label>
        <span class="btn btn-outline-primary">
            ＋画像
            <input type="file" style="display:none" name="steps_image[]" accept="image/png,image/jpeg,image/gif">
        </span>
    </label>
    <label for="htmake" class="form-label">　　 
    ` + elementCount + ':</label>';

    var nestedElement2 = document.createElement('div');
    nestedElement2.classList.add('col-6');
    nestedElement2.innerHTML = `
    <textarea name="steps_comment[]" class="form-control"></textarea>
    `;

    var nestedElement3 = document.createElement('div');
    nestedElement3.classList.add('col-4');
    nestedElement3.innerHTML = ``;
    
    formElement.appendChild(nestedElement1);
    formElement.appendChild(nestedElement2);
    formElement.appendChild(nestedElement3);
   
    // フォームを追加する要素に新しいフォームを追加
    var stepsContainer = document.getElementById('steps-container');
    stepsContainer.appendChild(formElement);
});