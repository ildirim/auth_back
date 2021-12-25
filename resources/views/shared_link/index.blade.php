@extends('layouts.main')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shared link</h1>
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
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Main</a>
                                    <a class="nav-item nav-link" id="nav-web-tab" data-toggle="tab" href="#nav-web" role="tab" aria-controls="nav-web" aria-selected="false">Web link</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
                                    <a class="nav-item nav-link" id="nav-document-tab" data-toggle="tab" href="#nav-document" role="tab" aria-controls="nav-document" aria-selected="false">Document</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Card no</th>
                                                            <td>{{ $card->card_no }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Web link</th>
                                                            <td>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" data-id="link"
                                                                    {{ !is_null($card->link_id) && $card->active == 'link' ? 'checked' : '' }} 
                                                                    class="custom-control-input checkbox" id="customSwitch1" id="customSwitch1" 
                                                                    {{ is_null($card->link_id) ? 'disabled' : '' }}>
                                                                    <label class="custom-control-label" for="customSwitch1"></label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Contact</th>
                                                            <td>
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox" data-id="contact"
                                                                        {{ !is_null($card->contact_id) && $card->active == 'contact' ? 'checked' : '' }} 
                                                                        class="custom-control-input checkbox"  id="customSwitch2" 
                                                                        {{ is_null($card->contact_id) ? 'disabled' : '' }}>
                                                                    <label class="custom-control-label" for="customSwitch2"></label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Document link</th>
                                                            <td>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" data-id="document"
                                                                    {{ !is_null($card->document_id) && $card->active == 'document' ? 'checked' : '' }} 
                                                                    class="custom-control-input checkbox"  id="customSwitch3" 
                                                                    {{ is_null($card->document_id) ? 'disabled' : '' }}>
                                                                    <label class="custom-control-label" for="customSwitch3"></label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-web" role="tabpanel" aria-labelledby="nav-web-tab">
                                    <form class="form" action="{{ route('storeOrUpdateWebLink') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                <span class="required">Web link</span>
                                            </label>
                                            <input type="text" class="form-control custom-req" name="name" value="{{ $webLink->name ?? '' }}" />
                                        </div>
                                        <div class="form-group">
                                            <button id="btn-store-probe" class="btn btn-sm btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <form class="form" action="{{ route('storeOrUpdateContact') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">                                            
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Full name</span>
                                                </label>
                                                <input type="text" class="form-control custom-req" name="full_name" value="{{ $contact->full_name ?? '' }}" />
                                            </div>
                                            <div class="col-3">                                            
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Photo</span>
                                                </label>
                                                <input type="file" class="form-control custom-req" name="photo" value="{{ $contact->photo ?? '' }}" />
                                            </div>
                                            @if(isset($contact->photo) && $contact->photo)
                                                <div class="col-3">
                                                    <a href="{{ 'uploads/contact/' . $contact->photo }}" target="_blank">
                                                        <img src="{{ 'uploads/contact/' . $contact->photo }}" width="75px" height="75px">
                                                    </a>                                     
                                                </div>
                                            @endif

                                            <div class="col-6">                                            
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Department</span>
                                                </label>
                                                <input type="text" class="form-control custom-req" name="department" value="{{ $contact->department ?? '' }}" />
                                            </div>
                                            <div class="col-6">                                            
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Company</span>
                                                </label>
                                                <input type="text" class="form-control custom-req" name="company" value="{{ $contact->company ?? '' }}" />
                                            </div>

                                            <div class="col-6">                                            
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Role</span>
                                                </label>
                                                <input type="text" class="form-control custom-req" name="role" value="{{ $contact->role ?? '' }}" />
                                            </div>
                                            <div class="col-6">                                            
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Email</span>
                                                </label>
                                                <input type="text" class="form-control custom-req" name="email" value="{{ $contact->email ?? '' }}" />
                                            </div>

                                            <div class="col-6">                                            
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Mobile number</span>
                                                </label>
                                                <input type="text" class="form-control custom-req" name="mobile_number" value="{{ $contact->mobile_number ?? '' }}" />
                                            </div>
                                            <div class="col-6">                                            
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Fax number</span>
                                                </label>
                                                <input type="text" class="form-control custom-req" name="fax_number" value="{{ $contact->fax_number ?? '' }}" />
                                            </div>

                                            <div class="col-6">                                            
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Address</span>
                                                </label>
                                                <input type="text" class="form-control custom-req" name="address" value="{{ $contact->address ?? '' }}" />
                                            </div>
                                            <div class="col-6">                                            
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Note</span>
                                                </label>
                                                <input type="text" class="form-control custom-req" name="note" value="{{ $contact->note ?? '' }}" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button id="btn-store-probe" class="btn btn-sm btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-document" role="tabpanel" aria-labelledby="nav-document-tab">
                                    <form class="form" action="{{ route('storeOrUpdateDocumentLink') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">                                            
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span class="required">Document</span>
                                                </label>
                                                <input type="file" class="form-control custom-req" name="name" value="{{ $documentLink->name ?? '' }}" />
                                            </div>
                                            @if(isset($documentLink->name) && $documentLink->name)
                                                <div class="col-6">
                                                    <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                        <span class="required"></span>
                                                    </label>
                                                    <a href="{{ 'uploads/document/' . $documentLink->name }}" target="_blank">
                                                        Open document
                                                    </a>                                     
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <button id="btn-store-probe" class="btn btn-sm btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('message/success')
@include('message/error')

<script type="text/javascript">var baseUrl = "{{ url('') }}";</script>
<script src="{{ asset('js/shared_link.js') }}"></script>
@endsection