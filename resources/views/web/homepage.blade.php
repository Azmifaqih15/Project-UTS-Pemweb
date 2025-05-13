<x-layout title="Homepage">

    <h1 class="text-center my-4">Selamat Datang di Shop Shoes</h1>

    <div class="d-flex justify-content-center">
        <x-card 
            image="https://cdn.shopify.com/s/files/1/0712/0397/9503/files/Velocity_Blue_Yellow_1.jpg?v=1728217709&width=1400&height=1400&crop=center" 
            title="Produk Terbaru" 
            content="Ini adalah deskripsi produk terbaru kami." 
            link="/product"
        />
    </div>

    <div class="text-center mt-4">
        <button class="btn btn-warning" onclick="showAlert()">Tampilkan Alert</button>
    </div>

    <div id="alertContainer" class="mt-3"></div>

    <script>
        function showAlert() {
            let alertDiv = document.createElement("div");
            alertDiv.className = "alert alert-success alert-dismissible fade show";
            alertDiv.role = "alert";
            alertDiv.innerHTML = `Selamat datang di website kami!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
            document.getElementById("alertContainer").appendChild(alertDiv);
        }
    </script>

    <div class="container mt-5">
        <h3 class="mb-4">Categories</h3>
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ $category['image'] }}" class="card-img-top" alt="{{ $category['name'] }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $category['name'] }}</h5>
                            <p class="card-text">{{ $category['description'] }}</p>
                            <a href="/category/{{ $category['slug'] }}" class="btn btn-primary mt-auto">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr>

        <div class="row mt-4">
        <h3>Products</h3>
        @foreach($products as $product)
        <div class="col-3">
            <div class="card">
                <img src="{{ asset($product->image_url) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ Str::limit($product->description, 50) }}</p>
                    <p class="card-text"><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                    <a href="/product/{{ $product->slug }}" class="btn btn-success">Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    </div>
</x-layout>