@extends('layouts.main')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Card list</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#"  class="btn btn-default btn-sm btn-create-card" data-toggle="modal" data-target="#modal-create-card">Yeni</a>
                        </li>
                    </ol>
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
                                        <th>Card no</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cards as $count => $card)
                                        @include('card/parts/table_tr')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('card/modals/create_modal')
@include('card/modals/edit_modal')

@include('message/success')
@include('message/error')

<script type="text/javascript">var baseUrl = "{{ url('') }}";</script>
<script src="{{ asset('js/card.js') }}"></script>

@endsection