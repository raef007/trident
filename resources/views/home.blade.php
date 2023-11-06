@extends('layouts.app')

@section('content')
Dashboard (Receivables, Expenses, Job Orders, Events, Empty Units)
<user-list></user-list>
<community-list></community-list>
<unit-list :community="{{ App\Estate\Models\Community::find(1) }}"></unit-list>
<unit-details :unitid="1"></unit-details>
@endsection
