@extends('layouts.admin')

@section('contents')


        <div class="block-header">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="bg-blue box text-center">
                        <div class="body">
                            <div class="p-15 text-light">
                                <h3>15,000</h3>
                                <span>Visitor's</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="bg-red box text-center">
                        <div class="body">
                            <div class="p-15 text-light">
                                <h3>{{ $userCount ?? 0 }}</h3>
                                <span>Registered user's</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="bg-turqu box text-center">
                        <div class="body">
                            <div class="p-15 text-light">
                                <h3>{{ $productCount ?? 0 }}</h3>
                                <span>Products</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="bg-yellow box text-center">
                        <div class="body">
                            <div class="p-15 text-light">
                                <h3>{{ $postCount ?? 0 }}</h3>
                                <span>Forum's Discussion</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row space-down">
            <div class="col-lg-8 col-md-8 cl-sm-12">
                <div class="element-style table-padding">
                    <h5>Product subcategories</h5>
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm dash-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="th-sm">Subcategory

                                </th>
                                <th class="th-sm">Category

                                </th>
                                <th class="th-sm">Createdby

                                </th>
                                <th class="th-sm">Created at

                                </th>
                                <th class="th-sm">Status

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategories as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @if($item->confirmed==1)
                                    Visible
                                    @elseif($item->confirmed==0)
                                    Not Visible
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>
            <div class="col-lg-4 col-md-4 cl-sm-12 ">
                 <!-- CALENDAR-->
            <div id="calendar" class="mb">
                <div class="panel green-panel no-margin">
                  <div class="panel-body">
                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                      <div class="arrow"></div>
                      <h3 class="popover-title" style="disadding: none;"></h3>
                      <div id="date-popover-content" class="popover-content"></div>
                    </div>
                    <div id="my-calendar"></div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <br>
@endsection
