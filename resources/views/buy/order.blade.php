@extends('layouts.master')

@section('content')
<div class="pagetitle">
    <h1>Make an Order</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            @include('message')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Orders</h5>

                    <form action="{{ url('combhoney/buys') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <!-- ✅ Removed Name, Contact, and Email Fields -->

                        <!-- 🔽 Multiple Product Selection -->
                        <div id="product-container">
                            <div class="row mb-3 product-item">
                                <label class="col-sm-2 col-form-label">Product <span style="color: red;">*</span></label>
                                <div class="col-sm-5">
                                    <select name="product[]" class="form-control" required>
                                        <option value="">-- Select Product --</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id_produk }}">{{ $product->nama_produk }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-1 col-form-label">Qty</label>
                                <div class="col-sm-3">
                                    <input type="text" name="quantity[]" class="form-control" required>
                                </div>

                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-success add-product">+</button>
                                </div>
                            </div>
                        </div><br>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Location <span style="color: red;">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="location" class="form-control" required><br>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Buy</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 💡 JS to Add/Remove Products Dynamically -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('product-container');

        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('add-product')) {
                const productItem = e.target.closest('.product-item');
                const clone = productItem.cloneNode(true);

                // Clear values in cloned inputs
                clone.querySelector('select').value = '';
                clone.querySelector('input[name="quantity[]"]').value = '';

                // Change "+" to "-" for removal
                clone.querySelector('.add-product').classList.remove('btn-success', 'add-product');
                clone.querySelector('button').classList.add('btn-danger', 'remove-product');
                clone.querySelector('button').textContent = '-';

                container.appendChild(clone);
            }

            if (e.target && e.target.classList.contains('remove-product')) {
                e.target.closest('.product-item').remove();
            }
        });
    });
</script>

@endsection
