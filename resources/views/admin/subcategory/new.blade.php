@extends('layouts.admin')

@section('contents')
<section id="main-content" style="background: #f4f7f6">
    <section class="wrapper">
        <div class="block-header">
            <div class="list-display-box">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 style="margin-top:20px;margin-bottom:40px">
                            Please enter new Product Category
                        </h1>
                        <form method="POST" action="{{ route('Subcategory.store') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <select name="category" id="category"  class="form-control" >
                                    <option>Choose Product category..</option>
                                    @foreach ($categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" name="name" class="form-control"  aria-describedby="titleHelp" placeholder="Enter Product title">
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <button type="submit" class="butn-submit">Add Product subcategory</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

@endsection
