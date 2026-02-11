export function updateCart(productId, quantity) {
    fetch('/cart/update', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({ id: productId, quantity: quantity })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: { message: data.message || 'An error occurred', type: 'error' }
            }));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        window.dispatchEvent(new CustomEvent('notify', {
            detail: { message: 'An error occurred. Please try again.', type: 'error' }
        }));
    });
}

export function removeFromCart(productId) {
    if (!confirm('Are you sure you want to remove this item?')) {
        return;
    }

    fetch('/cart/remove', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({ id: productId })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            window.dispatchEvent(new CustomEvent('notify', {
                detail: { message: data.message || 'An error occurred', type: 'error' }
            }));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        window.dispatchEvent(new CustomEvent('notify', {
            detail: { message: 'An error occurred. Please try again.', type: 'error' }
        }));
    });
}

// Make it available globally
window.updateCart = updateCart;
window.removeFromCart = removeFromCart;
