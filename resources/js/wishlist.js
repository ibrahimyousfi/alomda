export function toggleWishlist(productId) {
    fetch('/wishlist/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Update Badge
        const badge = document.getElementById('wishlist-badge');
        const mobileBadge = document.getElementById('mobile-wishlist-badge');
        
        if (badge) {
            if (data.count > 0) {
                badge.classList.remove('hidden');
                badge.innerText = data.count;
            } else {
                badge.classList.add('hidden');
            }
        }
        
        if (mobileBadge) {
            if (data.count > 0) {
                mobileBadge.classList.remove('hidden');
                mobileBadge.innerText = data.count;
            } else {
                mobileBadge.classList.add('hidden');
            }
        }

        // Update Icon
        const icon = document.getElementById('wishlist-icon-' + productId);
        if (icon) {
            if (data.status === 'added') {
                icon.setAttribute('fill', 'currentColor');
                icon.classList.add('text-red-500');
                icon.classList.remove('text-gray-400');

                // Show Toast
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: { message: data.message || 'Added to wishlist', type: 'success' }
                }));
            } else {
                icon.setAttribute('fill', 'none');
                icon.classList.remove('text-red-500');
                icon.classList.add('text-gray-400');

                // Show Toast
                window.dispatchEvent(new CustomEvent('notify', {
                    detail: { message: data.message || 'Removed from wishlist', type: 'info' }
                }));
            }
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
window.toggleWishlist = toggleWishlist;
