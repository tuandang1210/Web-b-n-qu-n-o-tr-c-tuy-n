
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.image-input');

    inputs.forEach(input => {
        input.addEventListener('change', function () {
            const file = this.files[0];
            const preview = this.closest('.mb-2').querySelector('.image-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    });
});


// header nav
const bar = document.getElementById('bar');
const nav = document.querySelector('.nav');

if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    });
}

const close = document.getElementById('close');
if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    });
}


// newsletter
const button = document.getElementById("button-addon2");
const emailInput = document.getElementById("emailInput");

if (button) {
    button.addEventListener("click", function () {
        const email = emailInput.value.trim();
        if (email.includes("@")) {
            alert("Valid email! Registration successful.");
        } else {
            alert("Invalid email address. It must contain '@'.");
        }
    });
}

// form-input contact
function validateForm() {
    const name = document.getElementById("nameInput").value.trim();
    const email = document.getElementById("emailInput").value.trim();
    const subject = document.getElementById("subjectInput").value.trim();
    const message = document.getElementById("messageInput").value.trim();

    if (!name || !email || !subject || !message) {
        alert("Please fill in all fields.");
        return;
    }

    if (!email.includes("@")) {
        alert("Invalid email address. It must contain '@'.");
        return;
    }
    alert("Message sent successfully!");
}

// check password regis
function checkPasswords() {
    const pw = document.getElementById('regPassword').value;
    const cpw = document.getElementById('confirmPassword').value;
    const errorDiv = document.getElementById('passwordError');

    if (pw !== cpw) {
        errorDiv.style.display = 'block';
        return false;
    } else {
        errorDiv.style.display = 'none';
        return true;
    }
}

// check login
function checkAccount() {
    const email = document.getElementById("loginEmail").value.trim();
    const pass = document.getElementById("loginPassword").value.trim();

    if (email === 'admin@email.com' && pass === 'adminpass') {
        window.location.href = "homepage.html";
        return false;
    } else {
        alert("Invalid email or password!");
        return false;
    }
}

// Product details for sproduct.html
const products = {
    f1: {
        name: "Men's Fashion T-Shirt",
        price: "$139.00",
        description: "The Gildan Ultra Cotton T-shirt is made from a substantial 6.0 oz. per sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk jersey knit provides unmatched comfort with each wear.",
        images: ["img/products/f1.jpg", "img/products/f2.jpg", "img/products/f3.jpg", "img/products/f4.jpg"],
        breadcrumb: "Home / T-Shirt"
    },
    f2: {
        name: "Men's Casual Hoodie",
        price: "$89.00",
        description: "A comfortable hoodie made from a cotton blend, ideal for casual wear with a modern slim fit.",
        images: ["img/products/f2.jpg", "img/products/f1.jpg", "img/products/f3.jpg", "img/products/f4.jpg"],
        breadcrumb: "Home / Hoodie"
    },
    f3: {
        name: "Men's Sports Tee",
        price: "$99.00",
        description: "Breathable sports tee designed for high-performance activities, made with moisture-wicking fabric.",
        images: ["img/products/f3.jpg", "img/products/f1.jpg", "img/products/f2.jpg", "img/products/f4.jpg"],
        breadcrumb: "Home / Sports"
    },
    f4: {
        name: "Men's Classic Polo",
        price: "$79.00",
        description: "A classic polo shirt made from premium cotton, perfect for both casual and semi-formal occasions.",
        images: ["img/products/f4.jpg", "img/products/f1.jpg", "img/products/f2.jpg", "img/products/f3.jpg"],
        breadcrumb: "Home / Polo"
    },
    f5: {
        name: "Men's Denim Jacket",
        price: "$129.00",
        description: "A stylish denim jacket with a relaxed fit, crafted from high-quality denim.",
        images: ["img/products/f5.jpg", "img/products/f6.jpg", "img/products/f7.jpg", "img/products/f8.jpg"],
        breadcrumb: "Home / Jacket"
    },
    f6: {
        name: "Men's Slim Fit Jeans",
        price: "$109.00",
        description: "Slim-fit jeans made from stretch denim for comfort and style.",
        images: ["img/products/f6.jpg", "img/products/f5.jpg", "img/products/f7.jpg", "img/products/f8.jpg"],
        breadcrumb: "Home / Jeans"
    },
    f7: {
        name: "Men's Casual Shirt",
        price: "$69.00",
        description: "A lightweight casual shirt, perfect for everyday wear with a relaxed fit.",
        images: ["img/products/f7.jpg", "img/products/f5.jpg", "img/products/f6.jpg", "img/products/f8.jpg"],
        breadcrumb: "Home / Shirt"
    },
    f8: {
        name: "Men's Athletic Shorts",
        price: "$59.00",
        description: "Comfortable athletic shorts designed for workouts and casual wear.",
        images: ["img/products/f8.jpg", "img/products/f5.jpg", "img/products/f6.jpg", "img/products/f7.jpg"],
        breadcrumb: "Home / Shorts"
    },
    n1: {
        name: "Women's Summer Dress",
        price: "$149.00",
        description: "A flowy summer dress made from lightweight fabric, perfect for warm weather.",
        images: ["img/products/n1.jpg", "img/products/n2.jpg", "img/products/n3.jpg", "img/products/n4.jpg"],
        breadcrumb: "Home / Dress"
    },
    n2: {
        name: "Women's Casual Top",
        price: "$79.00",
        description: "A versatile top made from soft cotton, ideal for casual outings.",
        images: ["img/products/n2.jpg", "img/products/n1.jpg", "img/products/n3.jpg", "img/products/n4.jpg"],
        breadcrumb: "Home / Top"
    },
    n3: {
        name: "Women's Yoga Leggings",
        price: "$89.00",
        description: "High-waisted yoga leggings with stretch fabric for maximum comfort.",
        images: ["img/products/n3.jpg", "img/products/n1.jpg", "img/products/n2.jpg", "img/products/n4.jpg"],
        breadcrumb: "Home / Leggings"
    },
    n4: {
        name: "Women's Denim Skirt",
        price: "$99.00",
        description: "A trendy denim skirt with a flattering fit, perfect for casual looks.",
        images: ["img/products/n4.jpg", "img/products/n1.jpg", "img/products/n2.jpg", "img/products/n3.jpg"],
        breadcrumb: "Home / Skirt"
    },
    n5: {
        name: "Women's Cardigan",
        price: "$119.00",
        description: "A cozy cardigan made from soft knit fabric, ideal for layering.",
        images: ["img/products/n5.jpg", "img/products/n6.jpg", "img/products/n7.jpg", "img/products/n8.jpg"],
        breadcrumb: "Home / Cardigan"
    },
    n6: {
        name: "Women's Sneakers",
        price: "$129.00",
        description: "Stylish sneakers with cushioned soles for all-day comfort.",
        images: ["img/products/n6.jpg", "img/products/n5.jpg", "img/products/n7.jpg", "img/products/n8.jpg"],
        breadcrumb: "Home / Shoes"
    },
    n7: {
        name: "Women's Blazer",
        price: "$159.00",
        description: "A tailored blazer for a polished and professional look.",
        images: ["img/products/n7.jpg", "img/products/n5.jpg", "img/products/n6.jpg", "img/products/n8.jpg"],
        breadcrumb: "Home / Blazer"
    },
    n8: {
        name: "Women's Tote Bag",
        price: "$99.00",
        description: "A spacious tote bag made from durable material, perfect for daily use.",
        images: ["img/products/n8.jpg", "img/products/n5.jpg", "img/products/n6.jpg", "img/products/n7.jpg"],
        breadcrumb: "Home / Bag"
    }
};

// Load product details in sproduct.html
function loadProductDetails() {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('product');
    const product = products[productId];

    if (product) {
        // Update main image
        const mainImg = document.getElementById('MainImg');
        mainImg.src = product.images[0];

        // Update small images
        const smallImgs = document.getElementsByClassName('small-img');
        for (let i = 0; i < smallImgs.length; i++) {
            smallImgs[i].src = product.images[i];
            smallImgs[i].onclick = function () {
                mainImg.src = smallImgs[i].src;
            };
        }

        // Update product details
        document.getElementById('breadcrumb').textContent = product.breadcrumb;
        document.getElementById('product-name').textContent = product.name;
        document.getElementById('product-price').textContent = product.price;
        document.getElementById('product-description').textContent = product.description;
    } else {
        // Fallback if product not found
        document.getElementById('product-name').textContent = "Product Not Found";
    }
}

// Add to cart functionality
function addToCart() {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('product');
    const product = products[productId];

    if (!product) {
        alert("Product not found!");
        return;
    }

    const size = document.getElementById('product-size').value;
    const quantity = parseInt(document.getElementById('product-quantity').value);

    if (size === "Select Size") {
        alert("Please select a size!");
        return;
    }

    if (quantity < 1) {
        alert("Please enter a valid quantity!");
        return;
    }

    // Get cart from localStorage or initialize empty array
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Check if product with same name and size exists
    const existingItem = cart.find(item => item.name === product.name && item.size === size);

    if (existingItem) {
        // Increase quantity if product exists
        existingItem.quantity += quantity;
    } else {
        // Add new product to cart
        cart.push({
            image: product.images[0],
            name: product.name,
            size: size,
            price: product.price,
            quantity: quantity
        });
    }

    // Save updated cart to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    alert("Product added to cart!");
}

// Run loadProductDetails and addToCart listener when on sproduct.html
if (window.location.pathname.includes('sproduct.html')) {
    window.onload = function () {
        loadProductDetails();
        const addToCartButton = document.getElementById('add-to-cart');
        if (addToCartButton) {
            addToCartButton.addEventListener('click', addToCart);
        }
    };
}