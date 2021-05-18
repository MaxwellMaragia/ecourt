<table >

    <tr>
        <td><b>Case number</b></td>
        <td>{{ $case->id }}</td>
    </tr>
    <tr>
        <td><b>Case verdict</b></td>
        <td>
            @if($case->status == '0')
                Invalid case
            @elseif($case->status == '1')
                Valid case
            @else
                Not set yet
            @endif
        </td>
    </tr>



</table>
