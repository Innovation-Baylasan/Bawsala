<h1> Show Category </h1>


<br>
<br>
<br>


<a href="{{ route('categories.index')  }}"><< Back</a>

<br>
<br>
<br>

<h3>   ID: {{ $data->id  }}</h3>
<h3>   Name: {{ $data->name  }}</h3>
<h3>   Icon: <img src="{{ URL::to('/')  }}/images/categoryIcon/{{ $data->icon  }}" alt=""></h3>
