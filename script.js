document.getElementById('order-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent page reload

    const customerName = document.getElementById('customerName').value;
    const customerEmail = document.getElementById('customerEmail').value;
    const customerPhone = document.getElementById('customerPhone').value;
    const customerAddress = document.getElementById('customerAddress').value;
    const product = document.getElementById('product').value;
    const quantity = document.getElementById('quantity').value;
    const paymentMethod = document.getElementById('paymentMethod').value;
    const shippingMethod = document.getElementById('shippingMethod').value;

    console.log({
        customerName,
        customerEmail,
        customerPhone,
        customerAddress,
        product,
        quantity,
        paymentMethod,
        shippingMethod
    });

    alert("Order successfully placed!");
});