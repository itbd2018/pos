@extends('admin.admin_master')
@section('admin')
    <section class="content-main">
        <div class="content-header mx-2">
            <div class="col-md-10">
                <h2 class="content-title">Stock Product List </h2>
                <strong style="font-weight: bold" class="text-dark"> {{ count($products) }} Products Found </strong>

            </div>

            @php
                $admin = Auth::guard('admin')->user();
            @endphp
            {{-- Only show Add Product button for Admin --}}
            @if ($admin->role == 1)
                <div class="col-md-2 text-end">
                    <a href="{{ route('product.add') }}" title="Add Product" class="btn btn-primary">
                        <i class="material-icons md-plus"></i>
                    </a>
                </div>
            @endif

        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table id="example" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">Sl</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Serial Numbers</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Product Price </th>
                                <th scope="col" style="text-align: center">Quantity <br> {{ $products->sum('stock_qty') }}</th>
                                <th scope="col">Discount </th>
                                @if ($admin->role == 1)
                                    <th scope="col">Featured</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-end">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td width="15%">
                                        @if ($item->product_thumbnail)
                                            <a href="#" class="itemside">
                                                <div class="left">
                                                    <img src="{{ asset($item->product_thumbnail) }}" class="img-sm"
                                                        alt="Userpic" style="width: 80px; height: 70px;">
                                                </div>
                                            </a>
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->name_en ?? 'NULL' }}

                                    </td>

                                    {{-- <td>
                                        @if ($item->serialNumbers->count() > 0)
                                            @foreach ($item->serialNumbers as $serial)
                                                <span
                                                    style="color: {{ $serial->is_sold ? 'red' : 'green' }}; font-weight: bold; margin-right: 8px;">
                                                    {{ $serial->serial_number }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No Serial Numbers</span>
                                        @endif
                                    </td> --}}

                                    <td>
                                        {{-- Show only available serial numbers in green --}}
                                        @if ($item->serialNumbers->where('is_sold', false)->count() > 0)

                                            @foreach ($item->serialNumbers as $serial)
                                                @if ($serial->is_sold == false)
                                                    <span style="color: green; font-weight: bold; margin-right: 8px;">
                                                        {{ $serial->serial_number }}
                                                    </span>
                                                @endif
                                            @endforeach

                                        @else
                                            <span class="text-muted">No Available Serial Numbers</span>
                                        @endif
                                    </td>


                                    <td> {{ $item->category->name_en }} </td>
                                    <td> {{ $item->regular_price ?? 'NULL' }} </td>
                                    <td>
                                        @if ($item->is_varient)
                                            Varient Product
                                        @else
                                            {{ $item->stock_qty ?? 'NULL' }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->discount_price > 0)
                                            @if ($item->discount_type == 1)
                                                <i class="fa fa-minus text-danger"></i>
                                                <span class="text-danger">৳{{ $item->discount_price }} </span>
                                            @elseif($item->discount_type == 2)
                                                <span class="text-danger">{{ $item->discount_price }}% </span>
                                            @endif
                                        @else
                                            <span class="text-secondary">None</span>
                                        @endif
                                    </td>
                                    @if ($admin->role == 1)
                                        <td>
                                            @if ($item->is_featured == 1)
                                                <a href="{{ route('product.featured', ['id' => $item->id]) }}"
                                                    title="Featured Product">
                                                    <span class="feature-status"><i
                                                            class="fa-solid fa-tag text-success"></i></span>
                                                </a>
                                            @else
                                                <a href="{{ route('product.featured', ['id' => $item->id]) }}"
                                                    title="Not Featured Product"> <span class="feature-status"><i
                                                            class="fa fa-tag text-danger"></i></span></a>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($item->status == 1)
                                                <a href="#" class="product-status-toggle"
                                                    data-id="{{ $item->id }}" data-is-stock="{{ $item->is_stock }}"
                                                    data-active-url="{{ route('product.in_active', ['id' => $item->id]) }}"
                                                    data-edit-url="{{ route('product.edit', ['id' => $item->id]) }}">
                                                    <span
                                                        class="product-status badge rounded-pill alert-success">Active</span>
                                                </a>
                                            @else
                                                <a href="#" class="product-status-toggle"
                                                    data-id="{{ $item->id }}" data-is-stock="{{ $item->is_stock }}"
                                                    data-active-url="{{ route('product.active', ['id' => $item->id]) }}"
                                                    data-edit-url="{{ route('product.edit', ['id' => $item->id]) }}">
                                                    <span
                                                        class="product-status badge rounded-pill alert-danger">Disable</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" style="margin: 50% 0">
                                                <a class="btn btn-primary" href="{{ route('product.edit', $item->id) }}"
                                                    title="Publish to Website"
                                                    style="padding:12px; margin-right: 5px; border-radius: 5px"><i
                                                        class="fa fa-upload"></i></a>
                                                @if (Auth::guard('admin')->user()->role == '2')
                                                    <a class="btn btn-danger"
                                                        href="{{ route('product.delete', $item->id) }}" id="delete"
                                                        title="Delete"><i class="fa fa-trash"></i></a>
                                                @else
                                                    @if (Auth::guard('admin')->user()->role == '1' ||
                                                            in_array('4', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                                                        <a class="btn btn-danger"
                                                            href="{{ route('product.delete', $item->id) }}" id="delete"
                                                            title="Delete"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                @endif
                                            </div>
                                        </td>
                                    @endif
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

@push('footer-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.product-status-toggle').forEach(el => {
            el.addEventListener('click', function(e) {
                e.preventDefault();

                const isStock = parseInt(this.dataset.isStock);
                const editUrl = this.dataset.editUrl;
                const actionUrl = this.dataset.activeUrl;

                // Find the status badge text (Active / Disable)
                const statusText = this.querySelector('.product-status').innerText.trim();

                // If status is "Disable" AND is_stock = 1 → Show SweetAlert2
                if (statusText === 'Disable' && isStock === 1) {
                    Swal.fire({
                        title: "Stock Product",
                        text: "This product is currently in stock. Do you want to publish it on the website?",
                        icon: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, Publish Product"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = editUrl;
                        }
                    });
                }
                //If Active or not a stock product → follow normal action
                else {
                    window.location.href = actionUrl;
                }
            });
        });
    </script>
@endpush
