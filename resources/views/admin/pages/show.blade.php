@extends('layouts.frontend')
@section('content')

 {!! isset($page)?$page->description:$title !!}
      
@endsection