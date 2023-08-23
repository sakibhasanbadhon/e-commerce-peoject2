<style>
    .col-4 label{
        font-weight: 800;
        padding-right:5px;
    }
</style>

    <div class="row">
        <div class="col-4 d-flex">
            <label for="">Name: </label>
            <p> {{ $order->c_name }} </p>
        </div>
        <div class="col-4 d-flex">
            <label for="">Phone:</label>
            <p> {{ $order->c_phone }} </p>
        </div>
        <div class="col-4 d-flex">
            <label for="">email:</label>
            <p> {{ $order->c_email }} </p>
        </div>
    </div>

    <div class="row">
        <div class="col-4 d-flex">
            <label for=""> Country:</label>
            <p> {{ $order->c_country ?? 'N/A' }} </p>
        </div>
        <div class="col-4 d-flex">
            <label for="">City:</label>
            <p> {{ $order->c_city ?? 'N/A' }} </p>
        </div>
        <div class="col-4 d-flex">
            <label for="">Zipcode:</label>
            <p> {{ $order->c_zipcode ?? 'N/A' }} </p>
        </div>
    </div>

    <div class="row">
        <div class="col-4 d-flex">
            <label for="">Order Id:</label>
            <p> {{ $order->order_id }} </p>
        </div>
        <div class="col-4 d-flex">
            <label for="">Subtotal:</label>
            <p> {{ $order->subtotal }} {{ $currency_symbol->currency }} </p>
        </div>
        <div class="col-4 d-flex">
            <label for="">Total:</label>
            <p>
                @if ($order->main_balance==null)
                    {{ $order->total }} {{ $currency_symbol->currency }}
                @else
                    {{ $order->main_balance }} {{ $currency_symbol->currency }}
                @endif
            </p>
        </div>
    </div>

<hr>

    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>Product</th>
                <th>Size</th>
                <th>color</th>
                <th>Qty& Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order_details as $order_detail)
                <tr>
                    <td>{{ $order_detail->product_name }}</td>
                    <td>{{ $order_detail->size ?? 'N/A' }}</td>
                    <td>{{ $order_detail->color ?? 'N/A' }}</td>
                    <td>{{ $order_detail->quantity }}x{{ $order_detail->single_price }} </td>
                    <td>{{ $order_detail->subtotal_price }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <form id="status_form">
        @csrf
        <div class="card">
            <div class="card-body">
                <input type="hidden" name="view_order_id" value="{{ $order->id }}">
                <input type="hidden" name="order_email" value="{{ $order->c_email }}">
                <label for=""><strong> Order Status </strong> <small>(current update)</small>  </label>
                <select class="form-control m-auto" name="view_order_status" id="">
                    <option value="0" {{ $order->status==0 ? 'selected' : '' }}>Pending</option>
                    <option value="1" {{ $order->status==1 ? 'selected' : '' }}>Received</option>
                    <option value="2" {{ $order->status==2 ? 'selected' : '' }}>Shipped</option>
                    <option value="3" {{ $order->status==3 ? 'selected' : '' }}>Complete</option>
                    <option value="4" {{ $order->status==4 ? 'selected' : '' }}>Return</option>
                    <option value="5" {{ $order->status==5 ? 'selected' : '' }}>Cancel</option>
                </select>
                <button class="btn btn-primary btn-sm mt-2 float-right">Save</button>
            </div>

        </div>

    </form>


    <script>

    </script>




