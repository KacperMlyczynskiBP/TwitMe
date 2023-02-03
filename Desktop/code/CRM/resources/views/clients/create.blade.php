@extends('layouts.crmApp')

@section('clients')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('clients.store') }}">
        @csrf
        <div class="form-style-8">
            <h2>Create client</h2>
            <label>Contact name</label>
            <input type="text" name="contact_name">
            <label>Contact email</label>
            <input type="email" name="contact_email">
            <label>Contact phone number</label>
            <input type="text" name="contact_phone_number">
            <label>Company name</label>
            <input type="text" name="company_name">
            <label>Company address</label>
            <input type="text" name="company_address">
            <label>Company city</label>
            <input type="text" name="company_city">
            <label>Company zip</label>
            <input type="text" name="company_zip">
            <label>Company vat</label>
            <input type="text" name="company_vat">
            <input type="submit" name="submit">
        </div>
    </form>
@endsection




