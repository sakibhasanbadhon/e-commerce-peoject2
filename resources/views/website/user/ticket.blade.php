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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-body">
                          <h4> submit your ticket we will reply..</h4>

                          <form action="{{ route('ticket.store') }}" method="post" enctype="multipart/form-data">
                              @csrf
                            <div class="form-group">
                              <label for="exampleInputEmail1">Subject</label>
                              <input type="text" class="form-control" name="subject" placeholder="write subject" required>
                              @error('subject')
                                  <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="review">Priority</label>
                                    <select name="priority" class="form-control w-100" >
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="service">Service</label>
                                    <select name="service" id="service" class="form-control w-100">
                                        <option value="Technical">Technical</option>
                                        <option value="Payment">Payment</option>
                                        <option value="Affiliate">Affiliate</option>
                                        <option value="return">return</option>
                                        <option value="refund">refund</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control" id="message" cols="30" rows="3"></textarea>
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
            </div>
        </div>
    </div>



<div class="container mt-4">
    @include('website.include.user.header')

    <div class="row">
      <div class="col-md-4">

        @include('website.include.user.profile')

    </div>



      <div class="col-md-8">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-between">Ticket List
                    <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">Open ticket </a>
                </h5>

                <table class="table table-striped">
                <thead>
                    <tr>
                    <th style="width: 120px" scope="col">Date</th>
                    <th scope="col">Service</th>
                    <th style="width: 200px" scope="col">Subject</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                    <tbody>

                        @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ date('d-M-Y', strtotime($ticket->created_at))}}</td>
                                <td>{{ $ticket->service }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>
                                    @if($ticket->status == 0)
                                        <span class="badge badge-warning"> Pending</span>
                                    @elseif($ticket->status == 1)
                                        <span class="badge badge-success"> Replied</span>
                                    @elseif($ticket->status == 2)
                                        <span class="badge badge-muted"> Cloded</span>
                                    @endif
                                </td>
                                <td>
                                    <a title="view ticket" href="{{ route('show.ticket',$ticket->id) }}" class="btn btn-info btn-sm"><i class=" fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
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
