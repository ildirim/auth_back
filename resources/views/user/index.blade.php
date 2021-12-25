@extends('layouts.main')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name Surname</th>
                                        <th>Card no</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $count => $user)
                                        <tr>
                                            <td>{{ ++$count }}</td>
                                            <td>{{ $user->full_name }}</td>
                                            <td>{{ $user->card_no }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

@endsection