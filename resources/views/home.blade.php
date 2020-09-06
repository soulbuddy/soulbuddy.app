@extends('layouts.app')

@section('content')
    <home :user="{{ Auth::user() }}"></home>
@endsection
<style>

</style>

<script>
</script>
