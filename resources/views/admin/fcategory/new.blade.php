@extends('layouts.admin')

@section('contents')
<section id="main-content" style="background: #f4f7f6">
    <section class="wrapper">
        <div class="block-header">
            <div class="list-display-box">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h1 style="margin-top:20px;margin-bottom:40px">
                            Please enter new Forums Category
                        </h1>
                        <form id="newFcategory" method="post" action="{{route('Fcategory.store')}}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control"  aria-describedby="titleHelp" placeholder="Enter Forum Category" required>
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group">
                            <textarea class="form-control" id="caption" placeholder="enter caption" name="caption" rows="3" required></textarea>
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                            </div>
                    <button type="submit" style="background: blue;color:white" class="btn btn-primary">Save changes</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

@endsection
