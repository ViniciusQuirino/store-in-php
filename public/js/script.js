const inputElements = document.querySelectorAll('input[data-product-id]');
const cartTotalElement = document.getElementById('cart-total');

inputElements.forEach(inputElement => {
    inputElement.addEventListener('input', function () {
        const quantidade = parseInt(inputElement.value);
        const productValue = parseFloat(inputElement.getAttribute('value-product'));
        const newTotal = isNaN(quantidade) ? 0 : quantidade * productValue;

        const productTotalElement = inputElement.closest('tr').querySelector('.product-total');
        productTotalElement.textContent = `R$ ${newTotal.toFixed(2).replace('.', ',')}`;

        // Calcular o novo total do carrinho
        let totalCarrinho = 0;
        inputElements.forEach(element => {
            const quantidadeProduto = parseInt(element.value);
            const valorProduto = parseFloat(element.getAttribute('value-product'));
            totalCarrinho += isNaN(quantidadeProduto) ? 0 : quantidadeProduto * valorProduto;
        });

        cartTotalElement.textContent = `R$ ${totalCarrinho.toFixed(2).replace('.', ',')}`;
    });
});

function updateHiddenInputValue(input) {
    const productId = input.getAttribute('data-product-id');
    document.getElementById(productId).value = productId;
    document.querySelector(`[product-id="${productId}"]`).value = input.value;
}
