document.addEventListener("DOMContentLoaded", function() {
    loadProducts("trending-products", [
        { title: "Tree pot", image: "path/to/image1.jpg", price: "$25" },
        { title: "Fashion set", image: "path/to/image2.jpg", price: "$35" }
    ]);
    loadProducts("popular-products", [
        { title: "Juice Drinks", image: "path/to/image3.jpg", price: "$45" },
        { title: "Package", image: "path/to/image4.jpg", price: "$50" }
    ]);
    loadProducts("recommended-products", [
        { title: "Bottle", image: "path/to/image5.jpg", price: "$100" },
        { title: "Medicine", image: "path/to/image6.jpg", price: "$200" }
    ]);
});

function loadProducts(containerId, products) {
    const container = document.getElementById(containerId);
    products.forEach(product => {
        container.innerHTML += `
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="product-thumb">
                    <img src="${product.image}" class="img-fluid product-image" alt="${product.title}">
                    <div class="product-info">
                        <h5>${product.title}</h5>
                        <p>${product.price}</p>
                    </div>
                </div>
            </div>`;
    });
}
