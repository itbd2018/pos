@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <section class="content-main">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="content-header">
                    <h2 class="content-title">Password Update</h2>
                    <div class="">
                        <a href="{{ route('vendor.index') }}" class="btn btn-primary p-3" title="Vendor List"><i
                                class="fa fa-list"></i> </a>
                    </div>
                </div>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Full Name </th>
                                        <td>{{ $vendor->shop_owner_name }}</td>
                                    </tr>

                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $vendor->user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $vendor->user->email }}</td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                        <hr>
                        <!-- .row // -->
                        <div class="card-body">
                            <form action="{{ route('vendor.password.update.store', $vendor->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-warning w-100">
                                    <i class="fa fa-key"></i> Update Password
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- card body .// -->
                </div>
                <!-- card .// -->
            </div>
        </div>
    </section>
@endsection
