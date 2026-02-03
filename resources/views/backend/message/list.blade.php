@extends('admin.admin_master')
@section('admin')
    <section class="content-main">
        <div class="content-header">
            {{--<<<<<<< Updated upstream--}}
            {{-- <h2 class="content-title">Customer List <span class="badge rounded-pill alert-success"> {{ count($customers) }} </span></h2> --}}
            <div class="col-md-10">
                <div class="">
                    <h2 class="">User Messages</h2>
                </div>
                <strong style="font-weight: bold" class="text-dark"> {{ count($items) }} Messages Found </strong>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="example" class="table table-bordered table-striped" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            {{--                            <th scope="col" class="text-end">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $key => $message)
                            <tr>
                                <td> {{ $key+1}} </td>
                                <td> {{ $message->name ?? 'No Name' }} </td>
                                <td> {{ $message->email ?? 'No Email' }} </td>
                                <td> {{ $message->subject ?? 'No Subject' }} </td>
                                <td> {{ $message->message ?? 'No Message' }} </td>
                                {{--                            <td class="text-end">--}}
                                {{--                                <a href="#" class="fa fa-list"></a>--}}
                                {{--                                <!-- dropdown //end -->--}}
                                {{--                            </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive //end -->
            </div>
            <!-- card-body end// -->
        </div>
    </section>

@endsection
