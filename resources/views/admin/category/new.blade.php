@extends('layouts.admin')

@section('contents')
<section id="main-content" style="background: #f4f7f6">
    <section class="wrapper">
        <div class="block-header">
            <div class="list-display-box">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                                <h1 style="margin-top:20px;margin-bottom:40px">
                                    Enter new Product Category
                                </h1>
                            <form method="POST" action="{{ route('Category.store') }}" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control"  aria-describedby="titleHelp" placeholder="Enter Product Category">
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong><i style="color: red">{{ $errors->first('name') }}</i></strong>
                                            </span>
                                        @endif
                                </div>

                                <button type="submit" class="butn-submit">Add category</button>


                            </form>
                        </div>
                     </div>
                </div>
        </div>
    </section>
</section>
@endsection
