@foreach($items as $item)
    <tr id="{{ $item->id }}">
        <td colspan="1"><input type="checkbox" name="select_row" value="{{ $item->id }}" id="select_check_{{ $item->id }}" class= "select_row"></td>
        <td  onclick="location.href='{{ route($route.'.show',$item->id) }}'"><a href="javascript:void(0);">{{ $item->service_id }}</a></td>
        <td  onclick="location.href='{{ route($route.'.show',$item->id) }}'"><a href="javascript:void(0);">{{ $item->name }}</a></td>
        <td  onclick="location.href='{{ route($route.'.show',$item->id) }}'">{{ isset($item->serviceCategory->name)?$item->serviceCategory->name:'' }}</td>
        <td  onclick="location.href='{{ route($route.'.show',$item->id) }}'">{{ $item->minutes }}</td>
        <td  onclick="location.href='{{ route($route.'.show',$item->id) }}'">{{ $item->price }}</td>
        <td>
            @include('components.edit_delete_button')
        </td>
    </tr>
@endforeach
