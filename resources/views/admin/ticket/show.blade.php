@extends('layouts.admin')
@section('styles')
<style>

</style>
@endsection

@section('content')

<div class="container">
    <div class="container-fluid">
        <div class="row p-3" style="background: #d9ebfb">
            <div class="col-8">
                <h3>Your Ticket Details</h3> <hr>
                <strong class="text-muted"> User: {{ $show->user->name }} </strong> <br>
                <strong class="text-muted"> Subject: {{ $show->subject }} </strong> <br>
                <strong class="text-muted"> Service: {{ $show->service }} </strong> <br>
                <strong class="text-muted"> Priority: {{ $show->priority }}</strong> <br>
                <strong class="text-muted"> Message: {{ $show->message }}</strong>
            </div>
            <div class="col-4 pt-4">
                <a href="{{ asset('admin/ticket-image/'.$show->image) }}" target="_blank">
                    <img src="{{ asset('admin/ticket-image/'.$show->image) }}" height="80" weight="80" alt="">
                </a>
            </div>
        </div>

    </div>
</div>

<div class="container mt-3">


        <div class="row">
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head text-white" style="background-color:#374f65 !important">
                        <div class="ibox-title">Reply Ticket Message</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse text-white"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link text-white"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ route('admin.reply.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="">Product Code</label>
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="3" required></textarea>
                                    <input type="hidden" name="ticket_id" value="{{ $show->id }}">
                                </div>
                                <div class="col-sm-12">
                                    <label for="">Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                                </div>

                            </div>
                            <div class="">
                                <button class="btn btn-info">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head text-white" style="background-color:#374f65 !important">
                        <div class="ibox-title">All Replies</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse text-white"><i class="fa fa-minus"></i></a>
                            <a class="fullscreen-link text-white"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body" style="padding: 15px;height: 400px; overflow: scroll;">

                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-user"> </i> {{ Auth::user()->name }}
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                </blockquote>
                            </div>
                        </div>

                        <div class="card mt-1 ml-5">
                            <div class="card-header">
                                <span class="float-right"><i class="fa fa-user"> </i> {{ Auth::user()->name }}</span>
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                </blockquote>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
            <input type="submit" class="btn btn-success" value="submit">


</div>



@endsection

@push('scripts')
    <script>



        $(document).on('change','#subcategory_id',function (e) {
            e.preventDefault();
            // alert('ok')
            var categoryId = $(this).val();
            $.ajax({
                url: "{{ route('admin.product.childCat') }}",
                type: "post",
                data: {_token:_token,data_id:categoryId},
                dataType: 'json',
                success: function (response) {
                    $('#child_category_id').html(response);
                }
            });

        });



        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="file" name="images[]" placeholder="Enter subject" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Remove</button></td></tr>'
                );
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>

@endpush
