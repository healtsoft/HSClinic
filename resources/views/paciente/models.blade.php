@extends('layouts.app')

@section('botones')
    <a href="{{ route('paciente.create') }}" class="btn btn-primary mr-2 text-white">Crear Paciente</a>
@endsection

@section('content')
<div class="sketchfab-embed-wrapper">
  <iframe title="A 3D model" width="640" height="480" src="https://sketchfab.com/models/0e9ade8d5f9443d39abd44fb05e1608d/embed?autostart=1&amp;ui_controls=1&amp;ui_infos=1&amp;ui_inspector=1&amp;ui_stop=1&amp;ui_watermark=1&amp;ui_watermark_link=1" frameborder="0" allow="autoplay; fullscreen; vr" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
  <p style="font-size: 13px; font-weight: normal; margin: 5px; color: #4A4A4A;">
</div>
    @include('paciente.create')
@endsection

@section('scripts')

<script src="{{ asset('js/signature_pad.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

@endsection