    @php
        $color=explode(',',$product->color);
        $size=explode(',',$product->size);
    @endphp

<div class="row p-3 mt-3">
    <div class="col-lg-4 ml-3">
        <img src="{{ asset('admin/product-images/'.$product->thumbnail) }}" alt="" height="70%" width="70%">
    </div>
    <div class="col-lg-6">
        <h4 class="quick_product_name"> {{ $product->name }}</h4>
        <div class="d-flex">
            <p> {{ $product->category->category_name }}</p>
            <p class="px-2">></p>
            <p> {{ $product->subcategory->subcategory_name }} </p>
        </div>
        <p style="margin-top:-13px;margin-bottom: 5px;">brand: {{ $product->brand->brand_name }} </p>

        @if ($product->stock_quantity<1)
            <div class="badge badge-danger" style="margin-top:-8px"> Stock out </div>
        @else
            <div class="badge badge-success" style="margin-top:-8px"> Stock Available </div>
        @endif


        @if ($product->discount_price==null)
            <h4 class="text-danger" style="margin-top: 20px;">{{ $currency_symbol->currency }} {{ $product->selling_price }}</h4>

        @else
            <div class="product_price" style="margin-top: 20px">
                <del class="text-danger">{{ $currency_symbol->currency }}{{ $product->selling_price }}</del>
                {{ $currency_symbol->currency }} {{ $product->discount_price }}
            </div>
        @endif



        <div class="row py-2">
            @isset($product->size)
                <div class="col-lg-4">
                    <span for="size">Pick Size</span>
                    <select name="size" class="custom-select" style="min-width: 100px;margin: 5px 0;">
                        @foreach ($size as $row)
                            <option value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset


            @isset($product->size)
                <div class="col-lg-4">
                    <span for="size">Pick Color</span>
                    <select name="size" class="custom-select" style="min-width: 100px;margin: 5px 0;">
                        @foreach ($color as $colors)
                            <option value="{{ $colors }}">{{ $colors }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset
        </div>
        @if ($product->stock_quantity<1)
            <span class="text-danger"> Stock Out</span>
        @else
            <button class="btn btn-sm btn-outline-info my-3"> add to Cart</button>
        @endif




    </div>
</div>
