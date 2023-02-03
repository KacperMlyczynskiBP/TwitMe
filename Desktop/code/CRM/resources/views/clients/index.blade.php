@extends('layouts.crmApp')

@section('clientsIndex')
    <div class="form-style-8">
        <h2><a href="{{ route('clients.create') }}">Create Clients</a></h2>
        <div class="table">
            <div class="table-header">
                <div class="header__item"><a>Company</a></div>
                <div class="header__item"><a>VAT</a></div>
                <div class="header__item"><a>Address</a></div>
            </div>
            <div class="table-content">
                @foreach($clients as $client)
                    <div class="table-row">
                        <div class="table-data">{{$client->company_name}}</div>
                        <div class="table-data">{{$client->company_vat}}</div>
                        <div class="table-data">{{$client->company_address}}</div>
                        <div>
                            <td rowspan="2">
                                <a href="{{ route('clients.edit', ['client'=>$client]) }}">Edit</a>
                                <a href="{{ route('clients.destroy', ['client'=>$client]) }}">Delete</a>
                            </td>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div>{{$clients->links()}}</div>
    </div>
@endsection
