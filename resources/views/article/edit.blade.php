@extends('layouts.main')

@section('content')

    @push('style')
        <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    <div class="row">
        <div class="col-xl-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-white">Edit Article</h4>
                </div>
                <form action="{{ route('article.update',$article->id) }}" method="POST">@csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-control mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-control select2" name="category_id" required>
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if($category->id == $article->category_id) {{ "selected" }} @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="code" placeholder="Enter Code" name="code" value="{{ $article->code }}" required>
                                    <label for="code">Code</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ $article->name }}" required>
                                    <label for="name">Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="weight" min="0" placeholder="Enter Weight" name="weight" value="{{ $article->weight }}" required>
                                    <label for="weight">Weight (Kg's)</label>
                                </div>
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
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    @push('scripts')
        <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
    @endpush
@endsection
