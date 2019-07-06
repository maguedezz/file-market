@extends('emails.layouts.default')
@section('content')
    <p>Thanks for downloading <strong>{{ $sale->file->title }}</strong> From FileMarket.</p>
    <p><a href="{{ route('files.download', [$sale->file, $sale]) }}" >Download your file</a></p>
    <p>
        Or, Copy and Paste this into your browser:
        {{ route('files.download', [$sale->file, $sale]) }}
    </p>
@endsection