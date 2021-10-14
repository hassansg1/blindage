@foreach($items as $item)
    <tr id="{{ $item->id }}">
        <td colspan="1"><input type="checkbox" name="select_row" value="{{ $item->id }}" id="select_check_{{ $item->id }}" class= "select_row"></td>
        <td  onclick="location.href='{{ route($route.'.show',$item->id) }}'">{{ $item->sku }}</td>
        <td  onclick="location.href='{{ route($route.'.show',$item->id) }}'">{{ $item->name }}</td>
        <td  onclick="location.href='{{ route($route.'.show',$item->id) }}'">{{ isset($item->productCategory->name)?$item->productCategory->name:'' }}</td>
        <td  onclick="location.href='{{ route($route.'.show',$item->id) }}'">{{ isset($item->productBrand->name)?$item->productBrand->name:'' }}</td>
        <td  onclick="location.href='{{ route($route.'.show',$item->id) }}'">{{ $item->size }}</td>
        <td  onclick="location.href='{{ route($route.'.show',$item->id) }}'">{{ $item->count }}</td>
        <td  onclick="location.href='{{ route($route.'.show',$item->id) }}'">{{ $item->retail_price }}</td>
        <td>
            @include('components.edit_delete_button')
        </td>
    </tr>
@endforeach
