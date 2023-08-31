document.getElementById('add-steps-button').addEventListener('click', function() {
    const elementCount = 1+document.querySelectorAll('[name="steps_comment[]"]').length;


    var formElement = document.createElement('div');
    formElement.classList.add('row','mb-2');

    var nestedElement1 = document.createElement('div');
    nestedElement1.classList.add('col-1');
    nestedElement1.innerHTML = `
    <label for="htmake" class="form-label">
    ` + elementCount + ':</label>';

    var nestedElement2 = document.createElement('div');
    nestedElement2.classList.add('col-6');
    nestedElement2.innerHTML = `
    <textarea name="steps_comment[]" class="form-control"></textarea>
    `;

    var nestedElement3 = document.createElement('div');
    nestedElement3.classList.add('col-5');
    nestedElement3.innerHTML = ``;

    var nestedElement4 = document.createElement('div');
    nestedElement4.innerHTML = `
    <hr class="my-2 --bs-border-color border-2">
    `;
    
    formElement.appendChild(nestedElement1);
    formElement.appendChild(nestedElement2);
    formElement.appendChild(nestedElement3);
    formElement.appendChild(nestedElement4);
   
    // フォームを追加する要素に新しいフォームを追加
    var stepsContainer = document.getElementById('steps-container');
    stepsContainer.appendChild(formElement);
});