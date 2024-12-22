const header = document.querySelector('header');

function onScroll() {
    if (window.scrollY > 0) {
        header.classList.remove('header-top');
        header.classList.add('header-scroll');
    } else {
        header.classList.add('header-top');
        header.classList.remove('header-scroll');
    }
}

function showToast(toastHTML, timeout = 5000) {
    const toastContainer = document.getElementById('toast-container');
    const toastElement = document.createElement('div');
    toastElement.innerHTML = toastHTML;
    toastContainer.appendChild(toastElement);

    toastElement.querySelector('.toast-close').addEventListener('click', function() {
        toastElement.remove();
    });

    setTimeout(() => toastElement.remove(), timeout);
}

/* Event Listeners */
function addEventListeners() {

    /* Header Element */

    const staticPages = ['/about', '/services', '/faq', '/contact'];
    const specialHeadersPaths = [...staticPages, '/login', '/register', '/admin/users'];
    if (!specialHeadersPaths.includes(window.location.pathname)) {
        // Fix header color
        window.addEventListener('scroll', onScroll); onScroll();
        document.querySelector('header').classList.add('fixed');
        document.querySelector('main').classList.add('header-fixed');
        // Fix footer color
        document.querySelector('footer').classList.remove('bg-transparent');
    }

    /* Search Bar Icons */
    if (document.querySelector('form.search-form')) {
        document.getElementById('searchSubmit').addEventListener('click', function () {
            document.getElementById('searchForm').submit();
        });

        document.getElementById('searchClear').addEventListener('click', function () {
            document.getElementById('searchInput').value = '';
        });
    }

    /* Edit Profile Page */
    if (window.location.pathname.match(/^\/profile\/\d+\/edit$/)) {
        document.getElementById('profile-picture-overlay').addEventListener('click', function () {
            document.getElementById('profile-picture-input').click();
        });

        document.getElementById('profile-picture-input').addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function () {
                    document.getElementById('profile-picture').src = reader.result;
                }
                reader.readAsDataURL(file);
            }
        });
    }

    /* TODO: AJAX Requests */

    /* Block User Request */
    document.querySelectorAll('button.block-user-button').forEach(button => {
        button.addEventListener('click', function() {
            const userID = this.dataset.userId;

            fetch(`/admin/users/${userID}/block`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.toast);
                        button.textContent = data.is_blocked ? 'Unblock' : 'Block';
                    } else {
                        alert(`Error: ${data.error}`);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });

    /* Delete User Request */
    document.querySelectorAll('button.delete-user-button').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this account?')) {
                const userID = this.dataset.userId;

                fetch(`/profile/${userID}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast(data.toast);
                            document.getElementById(`row-${data.deleted}`).remove();
                        } else {
                            alert(`Error: ${data.error}`);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    });

    /* Toggle Product Visibility Request */
    document.querySelectorAll('button.toggle-visibility-button').forEach(button => {
        button.addEventListener('click', function() {
            const productID = this.dataset.productId;

            fetch(`/admin/products/${productID}/visible`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.toast);
                        button.textContent = data.visibility ? 'Visible' : 'Invisible';
                    } else {
                        alert(`Error: ${data.error}`);
                    }
                })
                .catch(error => console.error('Error:', error));

        });
    });
}

addEventListeners();
  