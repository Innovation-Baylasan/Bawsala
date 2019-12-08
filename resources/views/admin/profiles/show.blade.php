<h1> Show Profile </h1>


<br>
<br>
<br>


<a href="{{ route('profiles.index')  }}"><< Back</a>

<br>
<br>
<br>

<h3>   ID: {{ $data->id  }}</h3>
<h3>   ENTITY: {{ $data->entity_id  }}</h3>
<br>
COVER <img src="{{ URL::to('/')  }}/images/profiles/covers/{{ $data->cover  }}" alt="">
<br>
Logo <img src="{{ URL::to('/')  }}/images/profiles/logos/{{ $data->Logo  }}" alt="">
<br>
<h3>   Address: {{ $data->entity_id  }}</h3>
