@props(['name', 'age'])

<form method="GET" action="{{ url()->full() }}">
    {{ url()->full() }} <br>
    Name: <input type="text" name="name" value="{{ $name ?? '' }}">
    <button type="submit">Submit</button>
</form>

<form method="GET" action="{{ url()->full() }}">
    {{ url()->full() }} <br>
    Age: <input type="number" name="age" value="{{ $age ?? '' }}">
    <button type="submit">Submit</button>
</form>