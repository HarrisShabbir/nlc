@extends('layouts.main')

@section('content')
@push('style')
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

<div class="row">
    <div class="col-xl-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h4 class="text-white">Add In Load</h4>
            </div>
            <form action="{{ route('inload.store') }}" method="POST">@csrf
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
                        <div class="col-md-6 offset-3">
                            <div class="form-control mb-3">
                                <label for="distributor_id">Distributor</label>
                                <select class="form-control select2" name="distributor_id" id="distributor_id" required>
                                    <option value="">Select a distributor</option>
                                    @foreach($distributors as $distributor)
                                        <option value="{{ $distributor->id }}">{{ $distributor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <div class="form-control mb-3">
                                <label for="vendor_pool_id">Transporter Name</label>
                                <select class="form-control select2" name="vendor_pool_id" id="vendor_pool_id" onchange="getvehicles(this.value)" required>
                                    <option value="">Select a Transporter</option>
                                    @foreach($vendorpools as $vendorpool)
                                        <option value="{{ $vendorpool->id }}">{{ $vendorpool->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <div class="form-control mb-3">
                                <label>Vehicles</label>
                                <div id="gotVehicles">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="way_bill" placeholder="Enter Way Bill Amount" name="way_bill" required>
                                <label for="way_bill">Way Bill</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 offset-1">
                            <div class="form-control mb-3">
                                <label>Article</label>
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
                                <input type="number" class="form-control quantity" required placeholder="Enter quantity" name="quantity[]">
                                <label>Quantity</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control sub-total" readonly name="total_weight[]">
                                <label>Sub-Total</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a href="javascript:;" onclick="inloadRepeater()" class="btn btn-primary w-md"><i class="bx bx-plus"></i></a>
                        </div>
                    </div>
                    <div id="inloadRepeaterView"></div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 offset-2">

                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control total" value="0" readonly>
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

        <script>
            $(document).ready(function() {
                $('#distributor_id').select2();
                $('#vendor_pool_id').select2();
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
            });

            function inloadRepeater(){

                var inloadRepeaterHTML = `<div class="row">
                                            <div class="col-md-3 offset-1">
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
                                                    <input type="text" class="form-control sub-total" readonly name="total_weight[]">
                                                    <label>Sub-Total</label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="javascript:;" class="btn btn-danger w-md" onclick="inloadRepeaterRemove($(this))"><i class="bx bx-trash"></i></a>
                                            </div>
                                        </div>`;

                $('#inloadRepeaterView').append(inloadRepeaterHTML);
                $('.article_id').select2();
            }

            function inloadRepeaterRemove(data){
                data.parent().closest('.row').remove();
            }

            function getvehicles(vendor_pool_id){
                $.ajax({
                    type:"GET",
                    url: "{{ url('inload/getvehicles') }}/"+vendor_pool_id,
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
