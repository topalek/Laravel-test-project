<h2>new Bid was registered:</h2>

<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Subject</th>
        <th scope="col">Message</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">File</th>
        <th scope="col">Date</th>
    </tr>
    </thead>
    <tbody>
    <tr class="bg-success text-white">
        <td>{{$bid->id}}</td>
        <td>{{$bid->subject}}</td>
        <td>{{$bid->message}}</td>
        <td>{{$bid->user->name}}</td>
        <td>{{$bid->user->email}}</td>
        <td>
            @if($bid->file)
                <img src="{{url($bid->file)}}"  alt=""/>
            @else
                no file attached
            @endif
        </td>
        <td>
            {{$bid->created_at}}
        </td>
    </tr>
    </tbody>
</table>
