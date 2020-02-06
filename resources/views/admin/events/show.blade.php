@extends('layouts.admin')

@section('content')
    <h1> Show event </h1>

    <br>
    <br>
    <br>


    <a href="{{ route('events.index')  }}"><< Back</a>

    <br>
    <br>
    <br>

    <table class="table-auto table" border="1">
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>

        <tr>
            <td>ID</td>
            <td>{{ $event->id  }}</td>
        </tr>
        <tr>
            <td>Creator Name</td>
            <td>
                {{ $event->user->name  }}
            </td>
        </tr>
        <tr>
            <td>Entity</td>
            <td>{{ $event->entity->name }}</td>
        </tr>
        <tr>
            <td>Event Name</td>
            <td> {{ $event->event_name }} </td>
        </tr>
        <tr>
            <td>Event Picture</td>
            <td> {{ $event->event_picture }} </td>
        </tr>
        <tr>
            <td>Description</td>
            <td> {{ $event->description }} </td>
        </tr>
        <tr>
            <td>Start Date Time</td>
            <td>
                {{ $event->application_start_datetime  }}
            </td>
        </tr>
        <tr>
            <td>End Date Time</td>
            <td>
                {{ $event->application_end_datetime  }}
            </td>
        </tr>
        <tr>
            <td>Latitude</td>
            <td>
                {{ $event->latitude  }}
            </td>
        </tr>
        <tr>
            <td>Longitude</td>
            <td>
                {{ $event->longitude  }}
            </td>
        </tr>
        <tr>
            <td>Confirm</td>
            <td>
                <input type="checkbox" @if($event->confirm) checked @endif>
            </td>
        </tr>

    </table>

@endsection