@extends('layouts.main')
@section('content')
@push('style')
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
<div class="row">
    <div class="col-xl-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h4 class="text-white">Add Out Load</h4>
            </div>
            <form action="{{ route('outload.update',$outload->distributor_id) }}" method="POST">@csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" disabled value="{{ date('Y-m-d') }}">
                                <label for="dispatch_date">Current Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-control mb-3">
                                <label for="distributor_id">Distributor</label>
                                <select class="form-control select2" name="distributor_id" id="distributor_id" required>
                                    <option value="">Select a distributor</option>
                                    @foreach($distributors as $distributor)
                                        <option value="{{ $distributor->id }}" @if($distributor->id == $outload->distributor_id) {{ "selected" }} @endif>{{ $distributor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-control mb-3">
                                <label for="vendor_pool_id">Vendor Pool</label>
                                <select class="form-control select2" name="vendor_pool_id" id="vendor_pool_id" onchange="getvehicles(this.value)" required>
                                    <option value="">Select a vendor pool</option>
                                    @foreach($vendorpools as $vendorpool)
                                        <option value="{{ $vendorpool->id }}" @if($vendorpool->id == $outload->vendor_pool_id) {{ "selected" }} @endif>{{ $vendorpool->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-control mb-3">
                                <label for="vehicle_id">Vehicles</label>
                                <div id="gotVehicles">
                                    <select class="form-control select2" name="vehicle_id" id="vehicle_id" required>
                                        <option value="">Select a vehicle</option>
                                        @foreach($vehicles as $vehicle)
                                            @php $selected = ""; @endphp
                                            @foreach($vehicleDetails as $vehicleDetail)
                                                @if($vehicleDetail->vehicle_id == $vehicle->id)
                                                    @php
                                                        $selected = "selected";
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <option value="{{ $vehicle->id }}" {{ $selected }}>{{ $vehicle->maker_name.' '.$vehicle->model_number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="dispatch_date" placeholder="Enter Dispatch Date" name="dispatch_date" value="{{ !empty($outload->dispatch_date) ? $outload->dispatch_date : date('Y-m-d') }}" required>
                                <label for="dispatch_date">Dispatch Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="shipment_number" maxlength="9" minlength="9" placeholder="Enter Shipment Number" name="shipment_number"  value="{{ $outload->shipment_number }}" required>
                                <label for="shipment_number">Shipment Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="bilti_number" maxlength="5" minlength="4" placeholder="Enter Bilti Number" name="bilti_number" value="{{  $outload->bilti_number }}" required>
                                <label for="shipment_number">Bilti Number</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        @if(count($articleDetails) > 0)
                        @foreach($articleDetails as $key => $articleDetail)
                            <div class="row">
                                <div class="col-md-3 offset-md-1">
                                    <div class="form-control mb-3">
                                        <select class="form-control select2 article_id" name="article_id[]" required>
                                            <option value="">Select a article</option>
                                            @foreach($articles as $article)
                                                <option value="{{ $article->id }}" data-weight="{{ $article->weight }}" @if($article->id == $articleDetail->article_id) {{ "selected" }} @endif>{{ $article->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control weight" readonly value="{{ $articleDetail->total_weight/$articleDetail->quantity }}">
                                        <label>Weight</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control quantity" placeholder="Enter quantity" name="quantity[]" value="{{ $articleDetail->quantity }}" required>
                                        <label>Quantity</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control sub-total" readonly name="total_weight[]" value="{{ $articleDetail->total_weight }}">
                                        <label>Sub-Total</label>
                                    </div>
                                </div>
                                @if($key == 0)
                                    <div class="col-md-2">
                                        <a href="javascript:;" onclick="outloadRepeater()" class="btn btn-primary w-md"><i class="bx bx-plus"></i></a>
                                    </div>
                                @else
                                    <div class="col-md-2">
                                        <a href="javascript:;" class="btn btn-danger w-md" onclick="outloadRepeaterRemove($(this))"><i class="bx bx-trash"></i></a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        @else
                            <div class="row">
                                <div class="col-md-3 offset-md-1">
                                    <div class="form-control mb-3">
                                        <select class="form-control select2 article_id" name="article_id[]" required>
                                            <option value="">Select a article</option>
                                            @foreach($articles as $article)
                                                <option value="{{ $article->id }}" data-weight="{{ $article->weight }}">{{ $article->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control weight" readonly>
                                        <label>Weight</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control quantity" placeholder="Enter quantity" name="quantity[]" required>
                                        <label>Quantity</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control sub-total" readonly>
                                        <label>Sub-Total</label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:;" onclick="outloadRepeater()" class="btn btn-primary w-md"><i class="bx bx-plus"></i></a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div id="outloadRepeaterView"></div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 offset-md-1">

                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control total" value="{{ ($articleDetails->pluck('total_weight')->sum()) * 0.001102 }}" readonly>
                                <label>Total (Tons)</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="https://unpkg.com/imask"></script>

    <script>
        $(document).ready(function() {
            $('#distributor_id').select2();
            $('#vendor_pool_id').select2();
            $('#vehiclce_id').select2();
            $('.article_id').select2();

            $(document).on('change', '.article_id', function(){
                var weight = $(this).find('option:selected').attr('data-weight');
                $(this).closest('.row').find('.weight').val(weight+" kg");
            });

            $(document).on('keyup', '.quantity', function(){
                var qty = parseInt($(this).val());
                var weight = parseInt($(this).closest('.row').find('.weight').val());
                var sub_total = qty * weight;
                $(this).closest('.row').find('.sub-total').val(sub_total);
                var total = 0;
                $('.sub-total').each(function(index, item){
                    total += parseInt($(item).val());
                });
                totalinton = total * 0.001102;
                $('.total').val(totalinton.toFixed(2));
            });

            var element = document.getElementById('shipment_number');
            var maskOptions = {
                mask: Number,  // enable number mask
                signed: false,  // disallow negative
                min: 000000000,
                max: 999999999
            };
            var mask = IMask(element, maskOptions);

            var element1 = document.getElementById('bilti_number');
            var maskOptions1 = {
                mask: Number,  // enable number mask
                signed: false,  // disallow negative
                min: 0000,
                max: 99999
            };
            var mask = IMask(element1, maskOptions1);
        });

        function outloadRepeater(){

            var outloadRepeaterHTML = `<div class="row">
                                        <div class="col-md-3 offset-md-1">
                                            <div class="form-control mb-3">
                                                <select class="form-control select2 article_id" name="article_id[]" required>
                                                    <option value="">Select a article</option>
                                                    @foreach($articles as $article)
                                                    <option value="{{ $article->id }}" data-weight="{{ $article->weight }}">{{ $article->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control weight" readonly>
                                                <label>Weight</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control quantity" placeholder="Enter quantity" name="quantity[]" required>
                                                <label>Quantity</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control sub-total" readonly>
                                                <label>Sub-Total</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="javascript:;" class="btn btn-danger w-md" onclick="outloadRepeaterRemove($(this))"><i class="bx bx-trash"></i></a>
                                        </div>
                                    </div>`;

            $('#outloadRepeaterView').append(outloadRepeaterHTML);
            $('.article_id').select2();
        }

        function outloadRepeaterRemove(data){
            data.parent().closest('.row').remove();
        }

        function getvehicles(vendor_pool_id){
            $.ajax({
                type:"GET",
                url: "{{ url('outload/getvehicles') }}/"+vendor_pool_id,
                success:function(response){
                    var VehiclesHTML=`<select class="form-control select2" name="vehicle_id[]" id="vehicle_id" multiple="multiple" required>`;
                                        $.each(response, function (index, item) {
                                            VehiclesHTML+=`<option value="`+item.id+`">`+item.maker_name+` (`+item.model_number+`)</option>`;
                                        });
                        VehiclesHTML+=`</select>`;
                    $('#gotVehicles').empty();
                    $('#gotVehicles').html(VehiclesHTML);
                    $('#vehicle_id').select2();
                },
            });
        }
    </script>
@endpush
@endsection
