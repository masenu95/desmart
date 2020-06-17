
@extends('layouts.admin')

@section('contents')
<section id="main-content" style="background: #f4f7f6">
    <section class="wrapper">
        <div class="block-header">
                    <div class="list-display-box">
                                        <table id="dt-page" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="th-sm">No:</th>
                                                    <th class="th-sm">Full Name </th>
                                                    <th class="th-sm">Email </th>
                                                    <th class="th-sm">Phone</th>
                                                    <th class="th-sm">Role </th>
                                                    <th class="th-sm">Register date </th>
                                                    <th class="th-sm">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                            <td>{{++$i}}</td>
                                                            <td style="text-transform: capitalize">{{ $user->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->phone}}</td>
                                                            <td>{{ $user->role->name}}</td>
                                                            <td>{{ $user->created_at}}</td>
                                                            <td id="{{ $user->id }}">
                                                            @if($user->role_id==1)
                                                            Admin
                                                            @elseif($user->role_id==2)
                                                            Moderator <a style="color: #f71735;font-weigh:bolder" href="#" onclick="make({{ $user->id }},'{{$user->name}}','admin')">Make Admin</a>
                                                            @else
                                                            <a style="color: #f71735;font-weigh:bolder" href="#" onclick="make({{ $user->id }},'{{$user->name}}','admin')">Make Admin</a>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;<a style="color: #41ead4;font-weigh:bolder"  href="#" onclick="make({{ $user->id }},'{{$user->name}}','moderator')">Make Moderator</a>
                                                            @endif
                                                            </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>

                                        </table>
                                        <script>
                                            function make(ids,name,role){
                                                event.preventDefault();
                                                id='#'+ids;
                                                var result=confirm('Are you sure you want to make '+ name +' Admin');
                                                if(result){
                                                var token = '{{ Session::token() }}';
                                                var url = '{{ url('/admin') }}';

                                                $.ajax({
                                                        method:'POST',
                                                        url:url,
                                                        data:{user:ids,_token: token,roles:role},
                                                        success:
                                                        function(result){
                                                            if(result['success']=='admin'){
                                                                var position ='Admin';
                                                            }else if(result['success']=='moderator'){
                                                                var position ='Moderator';
                                                            }
                                                            $(id).empty();
                                                            $(id).text(position);
                                                            }
                                                        });

                                            }
                                            }

                                        </script>
                    </div>
        </div>
    </section>
</section>
@endsection

