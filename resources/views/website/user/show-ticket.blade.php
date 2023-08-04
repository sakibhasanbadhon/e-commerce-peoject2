@extends('layouts.website')
@section('styles')
    <style type="text/css" media="screen">
        .profile-image{
        position: relative;
        opacity: 1;
        display: block;
        width: 100%;
        height: auto;
        transition: .5s ease;
        backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 23%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        /*.text:hover {
        opacity: 0.3;
        }*/

        .middle:hover {
        opacity: 0.8;
        }

        .text {
        background-color: #04AA6D;
        color: white;
        font-size: 16px;
        padding: 16px 32px;
        }
        .list li{
            border-top:2px sloid rgb(14, 13, 13);
        }
    </style>
@endsection
    @section('navbar')
        {{-- @include('website.include.navbar') --}}
    @endsection

@section('content')

<div class="container mt-4">
    @include('website.include.user.header')

    <div class="row">
      <div class="col-md-4">

        @include('website.include.user.profile')

    </div>



      <div class="col-md-8">
        <div class="card p-3">
            <div class="row">
                <div class="col-8">
                    <h3>Your Ticket Details</h3>
                    <strong class="text-muted"> Subject:  {{ $ticket->subject }} </strong> <br>
                    <strong class="text-muted"> Service: {{ $ticket->service }} </strong> <br>
                    <strong class="text-muted"> Priority: {{ $ticket->priority }}</strong> <br>
                    <strong class="text-muted"> Message: {{ $ticket->message }}</strong>
                </div>
                <div class="col-4">
                    <a href="{{ asset('admin/ticket-image/'.$ticket->image) }}" target="_blank"><img src="{{ asset('admin/ticket-image/'.$ticket->image) }}" height="80" weight="80" alt=""></a>
                </div>
            </div>

        </div>

        {{-- all reply show here --}}

        <div class="card my-2">
            <strong>All reply message..</strong>
            <div class="card-body" style="padding: 15px;height: 400px; overflow: scroll;border: 1px solid #ccc;">
                @isset($reply)
                    @foreach ($reply as $item)
                        <div class="card my-2 @if ($item->user_id==0) ml-5 @endif">
                            <div class="card-header @if ($item->user_id==0) bg-info @else bg-secondary @endif">
                            <i class="fa fa-user"> </i> @if ($item->user_id==0) Admin @else {{ Auth::user()->name }} @endif
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>{{ $item->message }}</p>
                                    <footer class="blockquote-footer">{{ date('d-M-Y', strtotime($item->reply_date)) }}</footer>
                                </blockquote>
                            </div>
                        </div>
                    @endforeach
                @endisset



            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <h4> Reply message..</h4>

                <form action="{{ route('reply.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" class="form-control" id="message" cols="30" rows="3"></textarea>
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        @error('message')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message">Picture</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>

            </div>
        </div>




      </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>


    </script>

@endpush
